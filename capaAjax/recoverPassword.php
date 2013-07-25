<?php
session_start();
include_once('../model/db_core.php');
$db = new db_core();
$consulta = $db->query("SELECT * FROM users as u WHERE u.email='".$_POST['email']."' AND u.user='".$_POST['email']."'");
if(mysql_num_rows($consulta) != 0)
{
	$result = mysql_fetch_array($consulta);
	$token = generar_token();
	$db->query("UPDATE users SET users.recoverToken='".$token."' WHERE users.id_user='".$result['id_user']."'");
	$para      = $result['email'];
	$asunto    = 'CuponPerfumes - Recuperacion de Contraseña';
	$mensaje   = 'Has solicitado la recuperacion de tu contraseña\r\n
	Para continuar con el proceso ingresa en el siguiente enlace para redefinir tu contraseña\r\n
	<a href="http://www.cuponperfumes.cl/recovery.php?recovertoken='.base64_encode($token).'">http://www.cuponperfumes.cl/recovery.php?recovertoken='.base64_encode($token).'</a>" \r\n
	Cualquier problema contacta con nuestro soporte soporte@cuponperfumes.cl\r\n
	Se despide el Equipo de CuponPerfumes.cl';
	$cabeceras = 'From: noreply@cuponperfumes.cl' . "\r\n";
	@mail($para, $asunto, $mensaje, $cabeceras);
	$retorno = new stdClass();
	$retorno->status = 1;
	echo json_encode($retorno);
}
else
{
	$retorno = new stdClass();
	$retorno->status =0;
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
		$consulta = $db->query("SELECT * FROM `users` as s WHERE s.recoverToken = '".$token."'");
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
?>