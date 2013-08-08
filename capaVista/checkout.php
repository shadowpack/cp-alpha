<?php 
	@require_once("model/db_core.php");
	@require_once('capaControlador/checkOutController.php');
	$total = new checkout();
	$total->reset();
?>
<link rel="stylesheet" type="text/css" media="all" href="css/checkout.css"> 
<div class="row checkoutTop">
	<div class="col12 checkout">
		<div class="checkoutheader">
			<div class="headerTop">
				<div class="figura">1</div>
				<div class="title">Tu compra</div>
			</div>
		</div>
	</div>
</div>
<?php $total->printCheckout(); ?>
<div class="row checkoutTop">
	<div class="col12 checkout">
		<div class="checkoutheader">
			<div class="headerTop">
				<div class="figura">2</div>
				<div class="title">Otras Opciones</div>
			</div>
		</div>
	</div>
</div>
<div class="row checkoutRow">
	<div class="col12 checkout">
		<div class="checkoutDelivery">
			<div id="locationsSelect">
				<div class="radioDelivery" value="false">
					<input type="radio" name="delivery" id="NoDelivery" value="false" checked>Sin Despacho
					<input type="radio" name="delivery" id="Delivery" value="true">Con Despacho
				</div>
				<div class="locationsRadio">
					<div class="LocationTitle">Seleccione la direccion de Despacho</div>
					<div class="LocationContent">
						<select class="direccionDelivery" disabled="disabled">
							<?php $total->printLocation(); ?>
						</select>
					</div>
				</div>
				<div class="unitarioDespacho">
					<div class="unitarioDespachoTitle">Precio Unitario</div>
					<div class="unitarioDespachoContent">$ <span class="despachoUnita"><?php echo $total->getDelivery(); ?></span></div>
				</div>
				<div class="precioDelivery" id="precioDelivery">
					<div class="DeliveryTitle">Costo de Despacho</div>
					<div class="DeliveryContent">$ <span class="pagoDespacho">0</span></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- MEDIOS DE PAGO -->
<div class="row checkoutTop">
	<div class="col12 checkout">
		<div class="checkoutheader">
			<div class="headerTop">
				<div class="figura">3</div>
				<div class="title">Elige un medio de pago</div>
			</div>
		</div>
	</div>
</div>
<div class="row checkoutPagoRow">
	<div class="col12 checkout">
		<div class="checkoutFormaPago">
			<div class="FormaPagoSelect">
				<div class="SelectPago">
					<div class="credito">
						<div class="webpayCreditoImg"><img src="img/tarjeta_credito.jpg" height="100"/></div>
						<div class="Pdescription">
							<div class="titleMethod">Tarjetas de Credito</div>
							<div class="contentMethod">Paga con tus tarjetas de credito favorita. Aceptamos Visa, MasterCard, Magna, American Express o Dinners.</div>
						</div>
					</div>
					<div class="transbank">
						<div class="webpayRedCompraImg"><img src="img/red_compra.gif" height="100"/></div>
						<div class="Pdescription">
							<div class="titleMethod">Tarjetas de Debito</div>
							<div class="contentMethod">Paga con tu tarjea de debito RedCompra.</div>
						</div>
					</div>
				</div>
				<div class="PagoTotal">
					<div class="PagoTitle">Total a Pagar</div>
					<div class="PagoContent">$ <span class="pagoTotal"><?php echo number_format($total->getTotal(),0,",","."); ?></span></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
//handler de inicio
$(document).ready(function(){
	// FUNCIONES DE AGREGAR PRODUCTOS
	$(".amountUp").click(function(){
		$.ajax({
			url: "capaAjax/compraProcess.php",
			type: "POST",
			data: { 
				action:1
			},
			success: function(resultado){
				var result = JSON.parse(resultado);
				if(result.status)
				{
					$(".amountNumber").html(parseInt($(".amountNumber").html())+1);
					$(".totalValor").html(num_format(parseInt($(".precioDes").html().replace('.',''))*parseInt($(".amountNumber").html())));
					if($('.radioDelivery').val() == "true")
					{
						$('.pagoDespacho').html(num_format(parseInt($(".despachoUnita").html().replace('.',''))*parseInt($(".amountNumber").html())));
						$('.pagoTotal').html(num_format(result.total));
					}
					else
					{
						$('.pagoDespacho').html('0');
						$('.pagoTotal').html(num_format(result.total));
					}
				}
				else
				{
					alert("Existe un error al procesar la solicitud, Por favor contacte con el soporte tecnico");
				}
			}
		});
	});
	$(".amountDown").click(function(){
		if(parseInt($(".amountNumber").html()) > 1)
		{
			$.ajax({
				url: "capaAjax/compraProcess.php",
				type: "POST",
				data: { 
					action:2
				},
				success: function(resultado){
					var result = JSON.parse(resultado);
					if(result.status)
					{
						$(".amountNumber").html(parseInt($(".amountNumber").html())-1);
						$(".totalValor").html(num_format(parseInt($(".precioDes").html().replace('.',''))*parseInt($(".amountNumber").html())));
						if($('.radioDelivery').val() == "true")
						{
							$('.pagoDespacho').html(num_format(parseInt($(".despachoUnita").html().replace('.',''))*parseInt($(".amountNumber").html())));
							$('.pagoTotal').html(num_format(result.total));
						}
						else
						{
							$('.pagoDespacho').html('0');
							$('.pagoTotal').html(num_format(result.total));
						}
					}
					else
					{
						alert("Existe un error al procesar la solicitud, Por favor contacte con el soporte tecnico");
					}
				}
			});
		}
	});
	$("#Delivery").click(function(){
		$(".direccionDelivery").removeAttr('disabled');
		$.ajax({
			url: "capaAjax/compraProcess.php",
			type: "POST",
			data: {
				action:3,
				delivery: true
			},
			success: function(resultado){
				var result = JSON.parse(resultado);
				if(result.status)
				{
					$('.pagoDespacho').html(num_format(parseInt($(".despachoUnita").html().replace('.',''))*parseInt($(".amountNumber").html())));
					$('.radioDelivery').val("true");
					$('.pagoTotal').html(num_format(result.total));
				}
				else
				{
					alert("Existe un error al procesar la solicitud, Por favor contacte con el soporte tecnico");
				}
			}
		});
	});
	$("#NoDelivery").click(function(){
		$(".direccionDelivery").attr('disabled','disabled');
		$.ajax({
			url: "capaAjax/compraProcess.php",
			type: "POST",
			data: { 
				action:3,
				delivery: false
			},
			success: function(resultado){
				var result = JSON.parse(resultado);
				if(result.status)
				{
					$('.pagoDespacho').html('0');
					$('.radioDelivery').val("false");
					$('.pagoTotal').html(num_format(result.total));
				}
				else
				{
					alert("Existe un error al procesar la solicitud, Por favor contacte con el soporte tecnico");
				}
			}
		});
	});
	$(".webpayCreditoImg").click(function(){
		$.ajax({
			url: "capaAjax/processSell.php",
			type: "POST",
			data:{
				delivery: ($('.radioDelivery').val() == "true")?true:false,
				location: $(".direccionDelivery").val(),
				medio: 0
			},
			success: function(resultado){
				alert(resultado);
				var method = JSON.parse(resultado);
				var form = $("<form></form>").attr({
					"name": "frm",
					"id": "payForm",
					"action":"cgi-bin/tbk_bp_pago.cgi",
					"method":"post" 
				}).appendTo($('body'));
				// Creamos los inputs para enviar el valor
				$('<input type="hidden" name="TBK_TIPO_TRANSACCION" value="TR_NORMAL"  />').appendTo(form);
				$('<input type="hidden" name="TBK_MONTO" value="'+method.monto+'" />').appendTo(form);
				$('<input type="hidden" name="TBK_ORDEN_COMPRA" value="'+method.id_transaccion+'" />').appendTo(form);
				$('<input type="hidden" name="TBK_ID_SESION" value="'+method.id_transaccion+'" />').appendTo(form);
				$('<input type="hidden" name="TBK_URL_EXITO" value="http://www.cuponperfumes.cl/SellSuccess.php?idT=" />').appendTo(form);
				$('<input type="hidden" name="TBK_URL_FRACASO" value="http://www.cuponperfumes.cl/SellFail.php" />').appendTo(form);
				//AÑADIMOS EL FORM AL BODY
				form.submit();
			}
		});
		
	});
	$(".webpayRedCompraImg").click(function(){
		$.ajax({
			url: "capaAjax/processSell.php",
			type: "POST",
			data:{
				delivery: ($('.radioDelivery').val() == "true")?true:false,
				location: $(".direccionDelivery").val(),
				medio: 1
			},
			success: function(resultado){
				var method = JSON.parse(resultado);
				var form = $("<form></form>").attr({
					"name": "frm",
					"id": "payForm",
					"action":"cgi-bin/tbk_bp_pago.cgi",
					"method":"post" 
				}).appendTo($('body'));
				// Creamos los inputs para enviar el valor
				$('<input type="hidden" name="TBK_TIPO_TRANSACCION" value="TR_NORMAL"  />').appendTo(form);
				$('<input type="hidden" name="TBK_MONTO" value="'+method.monto+'" />').appendTo(form);
				$('<input type="hidden" name="TBK_ORDEN_COMPRA" value="'+method.id_transaccion+'" />').appendTo(form);
				$('<input type="hidden" name="TBK_ID_SESION" value="'+method.id_transaccion+'" />').appendTo(form);
				$('<input type="hidden" name="TBK_URL_EXITO" value="http://www.cuponperfumes.cl/SellSuccess.php?idT=" />').appendTo(form);
				$('<input type="hidden" name="TBK_URL_FRACASO" value="http://www.cuponperfumes.cl/SellFail.php" />').appendTo(form);
				//AÑADIMOS EL FORM AL BODY
				form.submit();
			}
		});
		
	});
	var num_format = function(num){
		var cadena = ""; var aux;  
		var cont = 1,m,k;  
		if(num<0) aux=1; else aux=0;  
		num=num.toString();  
		for(m=num.length-1; m>=0; m--){  
		 cadena = num.charAt(m) + cadena;  
		 if(cont%3 == 0 && m >aux)  cadena = "." + cadena; else cadena = cadena;  
		 if(cont== 3) cont = 1; else cont++;  
		}  
		cadena = cadena.replace(/.,/,",");  
		return cadena;
	}
});
</script>