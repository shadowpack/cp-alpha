<?php
@session_start();
include('db_core.php');
//rescate de datos de POST.
$TBK_RESPUESTA=$_POST["TBK_RESPUESTA"];
$TBK_ORDEN_COMPRA=$_POST["TBK_ORDEN_COMPRA"];
$TBK_MONTO=$_POST["TBK_MONTO"];
$TBK_ID_SESION=$_POST["TBK_ID_SESION"];
/****************** CONFIGURAR AQUI *******************/
//GENERA ARCHIVO PARA MAC
$filename_txt = "/home/cuponperfumes/public_html/comun/MAC01Normal".$TBK_ID_SESION.".txt";
// Ruta Checkmac
$cmdline = "/home/cuponperfumes/public_html/cgi-bin/tbk_check_mac.cgi $filename_txt";
/****************** FIN CONFIGURACION *****************/
$acepta=false;
//guarda los datos del post uno a uno en archivo para la ejecución del MAC
$fp=fopen($filename_txt,"w+");
while(list($key, $val)=each($_POST)){
fwrite($fp, "$key=$val&");
}
fclose($fp);
//Validación de respuesta de Transbank, solo si es 0 continua con la pagina de cierre
if($TBK_RESPUESTA=="0"){ $acepta=true; } else { $acepta=false; }
//validación de monto y Orden de compra
//RESCATAMOS LOS DATOS DE LA DB
$db = new db_core();
reglog("PASA LA CREACION DE ARCHIVOS");
$consulta = $db->reg_one("SELECT * FROM transacciones_transbank as t WHERE t.TBK_ORDEN_COMPRA = '".$_POST["TBK_ORDEN_COMPRA"]."'");
if ($TBK_MONTO==$consulta['TBK_MONTO']."00" && $TBK_ORDEN_COMPRA==$consulta['TBK_ORDEN_COMPRA'] && $acepta==true)
{ 
	reglog("PASA EL IF DE COMPROBACION");
	exec ($cmdline, $result, $retint);
	reglog("ANALIZAMOS LA MAC Y SU RESPUESTA ES: ".$result[0]);
	if ($result[0] =="CORRECTO") 
	{
		reglog("FUE CORRECTA LA COMPROBACION DE MAC");
		$db->query("UPDATE transacciones_transbank SET
		TBK_CODIGO_AUTORIZACION = '".$_POST['TBK_CODIGO_AUTORIZACION']."',
		TBK_FECHA_CONTABLE = '".$_POST['TBK_FECHA_CONTABLE']."',
		TBK_FECHA_TRANSACCION = '".$_POST['TBK_FECHA_TRANSACCION']."',
		TBK_FINAL_NUMERO_TARJETA = '".$_POST['TBK_FINAL_NUMERO_TARJETA']."',
		TBK_HORA_TRANSACCION = '".$_POST['TBK_HORA_TRANSACCION']."',
		TBK_ID_SESION = '".$_POST['TBK_ID_SESION']."',
		TBK_ID_TRANSACCION = '".$_POST['TBK_ID_TRANSACCION']."',
		TBK_MAC = '".$_POST['TBK_MAC']."',
		TBK_MONTO = '".$_POST['TBK_MONTO']."',
		TBK_NUMERO_CUOTAS = '".$_POST['TBK_NUMERO_CUOTAS']."',
		TBK_RESPUESTA = '".$_POST['TBK_RESPUESTA']."',
		TBK_TASA_INTERES_MAX = '".$_POST['TBK_TASA_INTERES_MAX']."',
		TBK_TIPO_PAGO = '".$_POST['TBK_TIPO_PAGO']."',
		TBK_TIPO_TRANSACCION = '".$_POST['TBK_TIPO_TRANSACCION']."',
		TBK_VCI = '".$_POST['TBK_VCI']."'
		WHERE TBK_ORDEN_COMPRA = '".$TBK_ORDEN_COMPRA."'");
		reglog("ACTUALIZAMOS EL ESTADO DE LAS TRANSACCION TRANSBANK");
		$db->query("UPDATE transacciones SET transacciones.statusPay=1 WHERE transacciones.tbk_orden_compra='".$TBK_ORDEN_COMPRA."'");
		reglog("ACTUALIZAMOS EL ESTADO DE LAS TRANSACCIONES");
		$cupon[0] = $db->query("SELECT * FROM transacciones WHERE transacciones.tbk_orden_compra='".$TBK_ORDEN_COMPRA."' AND transacciones.statusPay=1");
		while($cupon[1] = mysql_fetch_array($cupon[0]))
		{
			for($i=0;$i<$cupon[1]['cantidad'];$i++)
			{
				makeCupon($db,$cupon[1]['id_transaccion']);
			}
		}
		//BORRAMOS EL ARCHIVO
		unlink($filename_txt);
		reglog("BORRAMOS EL ARCHIVO");
		echo "ACEPTADO";
	} 
	else
	{ 
		$db->query("DELETE FROM transacciones_transbank as t WHERE t.TBK_ORDEN_COMPRA = '".$TBK_ORDEN_COMPRA."'");
		$db->query("DELETE FROM transacciones as t WHERE t.tbk_orden_compra = '".$TBK_ORDEN_COMPRA."'");
		unlink($filename_txt);
		echo "RECHAZADO";
	}
}
else
{ 
	echo "RECHAZADO";
}
function reglog($reg1 = '',$reg2 = '',$reg3 = ''){
	$reg = true;
	if($reg)
	{
		$db = new db_core();
		$db->query("INSERT INTO registro (reg1,reg2,reg3) VALUES ('".$reg1."','".$reg2."','".$reg3."')");
	}
}
function makeCupon($db,$transaccion)
{
	reglog("INTENTANDO CREAR CUPON");
	$codigo = makeCode(12);
	reglog("CODIGO CREADO");
	$db->query("INSERT INTO cupones (id_transaccion,codigo_cupon,fecha_compra,estado) VALUES ('".$transaccion."','".$codigo."', '".time()."','0')");
	reglog("CUPON INGRESADO");
	$user = $db->reg_one("SELECT * FROM users INNER JOIN transacciones ON transacciones.id_user=users.id_user WHERE transacciones.id_transaccion = '".$transaccion."'");
	$producto = $db->reg_one("SELECT * FROM productos INNER JOIN transacciones ON transacciones.id_producto=productos.id_item WHERE transacciones.id_transaccion='".$transaccion."'");
	$para      = $user['email'];
	$asunto    = 'CuponPerfumes: '.$producto['nombre'].' - Codigo : '.$codigo;
	$mensaje   = 'Estimado '.$user['name'].'<br>'.
	'Te enviamos los datos de tu cupon'.'<br>'.
	'El Codigo de tu Cupon es : '.$codigo.'<br>'.
	'Recuerda que puedes hacerlo efectivo hasta el dia '.date('d/m/Y',$producto['tiempoExpiracion']).'<br>'.
	'ATTE CuponPerfumes';
	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$cabeceras .= 'To: '.$user['name'].' <'.$para.'>' . "\r\n";
	$cabeceras .= 'From: CuponPerfumes <noreply@cuponperfumes.cl>' . "\r\n";
	reglog("ENVIANDO MAIL A ".$para);
	mail($para, $asunto, $mensaje, $cabeceras);
}
function makeCode($long){
	$patron = "0123456789abcdefghijklmnopqrstuvwxyz";
	$d = new db_core();
	while(true)
	{
		$code = "";
		for($i=0; $i<$long; $i++)
		{
			$code .= $patron[rand(0,(strlen($patron)-1))];
		}
		if(mysql_num_rows($d->query("SELECT * FROM cupones AS c WHERE c.codigo_cupon='".$code."'")) == 0)
		{
			return $code;
		}
	}
}
?>