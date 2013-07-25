<?php
	session_start();
	include_once('../model/db_core.php');
	$regex = "[[a-zA-Z]+\s+[#(n°)n]*\d+]";
	$direccion = preg_match($regex, $_POST['location'], $coincidencia);
	$direccion = preg_replace("[#|(n°)|n]", '', $coincidencia[0]);
	$RealDireccion = str_replace(' ', '+', $direccion).",+".str_replace(' ', '+', $_POST['comuna']).",+".str_replace(' ', '+', $_POST['city']).",+Chile";
	$resultado = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=".$RealDireccion."&sensor=true"));
	if($resultado->status == "OK")
	{
		$db = new db_core();
		$consulta = $db->query("SELECT * FROM users as u WHERE u.user='".$_POST['email']."'");
		if(mysql_num_rows($consulta) == 0)
		{
			if($db->query("INSERT INTO users (users.user,users.password,users.email,users.name,users.location,users.comuna,users.city,users.lat,users.long,users.status) VALUES ('".$_POST['email']."','".md5($_POST['password'])."','".$_POST['email']."','".$_POST['name']."','".$direccion."','".$_POST['comuna']."','".$_POST['city']."','".$resultado->results[0]->geometry->location->lat."','".$resultado->results[0]->geometry->location->lng."',0)")){
				$retorno = new stdClass();
				$retorno->status = 1;
				echo json_encode($retorno);
			}
			else
			{
				$retorno = new stdClass();
				$retorno->status = 0;
				echo json_encode($retorno);
			}
			
		}
		else
		{
			$retorno = new stdClass();
			$retorno->status = 2;
			echo json_encode($retorno);
		}
	}
	elseif($resultado->status == "ZERO_RESULTS")
	{
		$retorno = new stdClass();
		$retorno->status = 3;
		echo json_encode($retorno);
	}
	else
	{
		$retorno = new stdClass();
		$retorno->status = 4;
		echo json_encode($retorno);
	}
?>