<?php 
	require_once('capaControlador/checkOutController.php');
	$total = new checkout();
	$_SESSION["CuponPerfumes-Sell"]['delivery'] = false;
?>
<link rel="stylesheet" type="text/css" media="all" href="css/checkout.css"> 
<div class="row checkoutRow">
	<div class="col1 first">&nbsp;</div>
	<div class="col10 checkout">
		<div class="checkoutBodyTop">
		</div>
	</div>
	<div class="col1">&nbsp;</div>
</div>
<?php $total->printCheckout(); ?>
<div class="row checkoutRow2">
	<div class="col1 first">&nbsp;</div>
	<div class="col10 checkout">
		<div class="checkoutBody">
			<div class="col1 first">&nbsp;</div>
		</div>
	</div>
	<div class="col1">&nbsp;</div>
</div>
<div class="row checkoutDel">
	<div class="col1 first">&nbsp;</div>
	<div class="col10 checkout">
		<div class="checkoutDelivery">
			<div id="locationsSelect">
				<div class="col1 first">&nbsp;</div>
				<div class="col9">
					<div class="radioDelivery">
					<input type="radio" name="delivery" id="delivery" value="false" checked>Sin Despacho
					<input type="radio" name="delivery" id="Nodelivery" value="true">Con Despacho
					</div>
				</div>
				<div class="col2"><div class="precio" id="precioDelivery">$0</div></div>
			</div>
			<!-- ACA SE ELIGE LA DIRECCION -->
			<div id="locationsDel">
				<div class="col1 first">&nbsp;</div>
				<div class="col11"><div class="textDel">Seleccione la direccion de Despacho : </div></div>
				<div class="col1 first">&nbsp;</div>
				<div class="col11">
					<div class="locationDel">
						<select class="direccionDelivery">
							<?php $total->printLocation(); ?>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col1">&nbsp;</div>
</div>
<div class="row checkoutBot">
	<div class="col1 first">&nbsp;</div>
	<div class="col10 checkout">
		<div class="checkoutFoot">
			<div class="col1">&nbsp;</div>
			<div class="col5"><div class="spanTotal">Total : $<?php echo number_format($total->getTotal(),0,",","."); ?></div></div>
			<div class="col3"><input type="radio" name="pagoOption" id="pagoOption" value="false" checked><img src="img/webpay.jpg" height="60" width="150" class="webpayImg"/></div>
			<div class="col3"><div class="btnPago">Pagar</div></div>
		</div>
	</div>
	<div class="col1">&nbsp;</div>
</div>
<script>
//handler de inicio
$(document).ready(function(){
	$("input[name='delivery']").click(function(){
		if($(this).val() == "true")
		{
			$("#locationsDel").show();
			$(".checkoutDel").css({height: '+=80px'});
			$.ajax({
				url: "capaAjax/getDelivery.php",
				type: "POST",
				data: { 
					status: "true"
				},
				success: function(resultado){
					var result = JSON.parse(resultado);
					$("#precioDelivery").html("$"+num_format(result.delivery));
					$(".spanTotal").html("Total : $"+num_format(result.total));
				}
			});
		}
		else
		{
			$("#locationsDel").hide();
			$(".checkoutDel").css({height: '-=80px'});
			$.ajax({
				url: "capaAjax/getDelivery.php",
				type: "POST",
				data: { 
					status: "false"
				},
				success: function(resultado){
					var result = JSON.parse(resultado);
					$("#precioDelivery").html("$"+num_format(result.delivery));
					$(".spanTotal").html("Total : $"+num_format(result.total));
				}
			});
		}
	});
	$('.Eliminar').click(function(){
		that = $(this);
		$.ajax({
			url: "capaAjax/removeCompra.php",
			type: "POST",
			data: { 
				remove: that.attr('value')
			},
			success: function(resultado){
				var result = JSON.parse(resultado);
				$("#precioDelivery").html("$"+num_format(result.delivery));
				$(".spanTotal").html("Total : $"+num_format(result.total));
				that.parent().parent().parent().parent().parent().remove();
			}
		});
	});
	$(".btnPago").click(function(){
		$.ajax({
			url: "capaAjax/processSell.php",
			type: "POST",
			data:{
				delivery: ($("input[name='delivery']:checked").attr('value') == "true")?true:false,
				location: $(".direccionDelivery").val()
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