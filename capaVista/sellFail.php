<link rel="stylesheet" type="text/css" media="all" href="css/sellSuccess.css"> 
<?php 
	include("capaControlador/SellResult.php");
	$data = new SellResult();
	$data_info = $data->getSellData($_POST['TBK_ORDEN_COMPRA']);
?>
<div class="row sellSuccess">
	<div class="col12 sellAll">
		<div class="sellInforme">
			<div class="Sellheader">
				Operacion Fallida
			</div>
			<div class="SellBody">
				<span class="textLineheader">La operación de compra ha fracasado, vuelva a intentarlo mas tarde. Estos son los datos de la transaccion Transbank y CuponPerfumes</span>
				<span class="textLine">Id del cliente : <?php echo $SESSION['id']; ?></span>
				<span class="textLine">Codigo de Transaccion : <?php echo $data_info['TBK_ORDEN_COMPRA']; ?></span>
				<span class="textLine">Monto de Transaccion : <?php echo $data_info['TBK_MONTO']; ?></span>
				<span class="textLine">Codigo Autorizacion Transbank : <?php echo $data_info['TBK_CODIGO_AUTORIZACION']; ?></span>
				<span class="textLine">Numero de Tarjeta : <?php echo $data_info['TBK_FINAL_NUMERO_TARJETA']; ?></span>
				<span class="textLine">Fecha de Transaccion : <?php echo $data_info['TBK_FECHA_TRANSACCION']; ?></span>
				<span class="textLine">Hora de Transaccion : <?php echo $data_info['TBK_HORA_TRANSACCION']; ?></span>
				<span class="textLine">Id Transaccion Transbank : <?php echo $data_info['TBK_ID_TRANSACCION']; ?></span>
				<span class="textLine">Tipo de Pago : <?php echo $data_info['TBK_TIPO_PAGO']; ?></span>
				<span class="textLine">Numero de Cuotas : <?php echo $data_info['TBK_NUMERO_CUOTAS']; ?></span>
				<span class="textLine">Tasa de Interes Maxima : <?php echo $data_info['TBK_TASA_INTERES_MAX']; ?></span>
				<span class="textLine">Resultado de Transaccion : <?php echo $data_info['TBK_VCI']; ?></span>
				<div class="backButonDiv">
					<div class="ButonDiv">Volver a CuponPerfumes</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$('.ButonDiv').click(function(){
		location.href="Acount.php";
	});
});
</script>
