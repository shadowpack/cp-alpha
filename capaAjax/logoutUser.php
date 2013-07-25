<?php
	session_start();
	unset($_SESSION['id']);
	unset($_SESSION['token']);
	$retorno = new stdClass();
	$retorno->status = true;
	echo json_encode($retorno);
?>
