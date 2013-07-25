<?php
	session_start();
	include_once('../model/db_core.php');
	$db = new db_core();
	$consulta = $db->query("SELECT * FROM users as u WHERE u.user='".$_POST['user']."' AND u.password='".md5($_POST['password'])."'");
	if(mysql_num_rows($consulta) != 0)
	{
		$resultado = mysql_fetch_array($consulta, MYSQL_BOTH);
		$_SESSION['id'] = $resultado['id_user'];
		$token = generar_token();
		$_SESSION['token'] = $token;
		$db->query("INSERT INTO session_log (id_user,time,ip,token) VALUES ('".$resultado['id_user']."','".time()."','".getIP()."', '".$token."')");
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
	//FUNCIONES AUXILIARES
	//METODO GENERAR TOKEN
	function generar_token()
	{
		$token;
		$db = new db_core();
		while(true)
		{
			//DEFINIMOS LA CONSTRUCCION DE UN TOKEN Y LO ITERAMOS HASTA QUE ENCONTRAMOS UNO LIBERADO
			$token = md5(rand(0,9).randomLetra().randomLetra().rand(0,9).rand(0,9).randomLetra().rand(0,9).randomLetra().rand(0,9).rand(0,9).randomLetra().rand(0,9).randomLetra().randomLetra().rand(0,9).randomLetra().rand(0,9).randomLetra().rand(0,9).rand(0,9).randomLetra().rand(0,9).rand(0,9).randomLetra().randomLetra().rand(0,9).randomLetra().rand(0,9).rand(0,9).randomLetra().rand(0,9).randomLetra().rand(0,9).rand(0,9).randomLetra().randomLetra().rand(0,9).randomLetra().rand(0,9).rand(0,9).randomLetra().rand(0,9));
			$consulta = $db->query("SELECT * FROM `session_log` as s WHERE s.token = '".$token."'");
			if(mysql_num_rows($consulta) == 0)
			{
				break;
			}
		}
		return $token;
	}
	
	//METODO LETRA ALEATORIA
	function randomLetra()
	{
		return $letraaleatoria = chr(rand(ord('a'), ord('Z')));
	}
	
	//METODO PARA DETERMINAR IP
	function getIP(){
    if( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] )) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if( isset( $_SERVER ['HTTP_VIA'] ))  $ip = $_SERVER['HTTP_VIA'];
    else if( isset( $_SERVER ['REMOTE_ADDR'] ))  $ip = $_SERVER['REMOTE_ADDR'];
    else $ip = null ;
    return $ip;
	}
?>
