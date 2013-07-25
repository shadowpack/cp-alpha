<?php
	@session_start();
	require_once("../capaControlador/checkOutController.php"); 
	@include("../model/db_core.php");
	if(isset($_POST['remove']))
	{
		$producto = new checkout();
		$producto->delProduct($_POST['remove']);
		$retorno["total"] = $producto->getTotal();
		if($_SESSION["CuponPerfumes-Sell"]['delivery'])
		{
			$retorno["delivery"] = $producto->getDelivery();
		}	
		else{
			$retorno["delivery"] = 0;
		}
		echo json_encode((object)$retorno);
	}
?>