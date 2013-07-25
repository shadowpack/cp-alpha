<?php
	@session_start();
	require_once("../capaControlador/checkOutController.php");
	@include("../model/db_core.php");
	$checkout = new checkout();
	$db = new db_core();
	$db->query('INSERT INTO transacciones_transbank (TBK_MONTO) VALUES ("'.$checkout->getTotal().'")');
	$id = mysql_insert_id ();
	$retorno = array();
	$retorno['monto'] = ($_POST['delivery'] == "true")?3000:0;
	$retorno['id_transaccion'] = $id;
	foreach ($_SESSION["CuponPerfumes-Sell"] as $key => $value) {
		if($key != "delivery"){
			//COMPROBAMOS QUE HALLAN UNIDADES DISPONIBLES
			//POR HACER
			if($_POST['delivery'])
			{	
				if($db->query("INSERT INTO transacciones (id_producto,id_user,tbk_orden_compra,fecha,statusPay,cantidad,location,delivery) VALUES ('".$key."','".$_SESSION['id']."','".$id."','".time()."','0','".$value."','".$_POST['location']."','1')"))
				{
					$valor = $db->reg_one("SELECT precio_descuento FROM productos as p WHERE p.id_item='".$key."'"); 
					$retorno['monto'] += $valor[0]*$value;
				}
				
			}
			else
			{
				if($db->query("INSERT INTO transacciones (id_producto,id_user,tbk_orden_compra,fecha,statusPay,cantidad,location,delivery) VALUES ('".$key."','".$_SESSION['id']."','".$id."','".time()."','0','".$value."','','0')"))
				{
					$valor = $db->reg_one("SELECT precio_descuento FROM productos as p WHERE p.id_item='".$key."'"); 
					$retorno['monto'] += $valor[0]*$value;
				}
			}
		}
	}
	$retorno['monto'] = $retorno['monto'].".00";
	echo json_encode((object)$retorno);

?>