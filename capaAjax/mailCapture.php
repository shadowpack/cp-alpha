<?php
	session_start();
	include_once('../model/db_core.php');
	$db = new db_core();
	$consulta = $db->query("SELECT * FROM users as u WHERE u.email='".$_POST['email']."'");
	if(mysql_num_rows($consulta) != 0)
	{
		$consulta = $db->query("INSERT INTO users (users.email) VALUES ('".$_POST['email']."')");
		$retorno = new stdClass();
		$retorno->status = true;
		echo json_encode($retorno);
	}
	else
	{
		$retorno = new stdClass();
		$retorno->status = false;
		echo json_encode($retorno);
	}
?>