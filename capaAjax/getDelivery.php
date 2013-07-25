<?php
	@session_start();
	require_once("../capaControlador/checkOutController.php"); 
	@include("../model/db_core.php");
	if($_POST['status'] == "true")
	{
		$producto = new checkout();
		$_SESSION["CuponPerfumes-Sell"]['delivery'] = true;
		$retorno["delivery"] = $producto->getDelivery();
		$retorno["total"] = $producto->getTotal();
		echo json_encode($retorno);
	}
	else
	{
		$producto = new checkout();
		$_SESSION["CuponPerfumes-Sell"]['delivery'] = false;
		$retorno["delivery"] = 0;
		$retorno["total"] = $producto->getTotal();
		echo json_encode((object)$retorno);
	}
	
?>