<?php
session_cache_limiter('private');
session_start();
session_cache_expire(30);
unset($_SESSION["CuponPerfumes-Sell"]);
header("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasadaheader 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header("Pragma: no-cache");
include('model/db_core.php');
$db =  new db_core();
if(isset($_SESSION['id']))
{
	$consulta = $db->num_one("SELECT * FROM sesion_log WHERE session_log.token='".$_SESSION['token']."'"); 
	if($consulta <= 0)
	{
		header ("Location: loginreg.php?next=".dameURL());
	}
}
else
{
	header ("Location: loginreg.php?next=".dameURL());
}
function dameURL(){
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
return $url;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CuponPerfumes.cl</title>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.1.custom.min.js"></script>
<script type="text/javascript" src="capaControlador/placeholder.js"></script>
<script type="text/javascript" src="capaControlador/esentialController.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/esential.css"> 
<link rel="stylesheet" type="text/css" media="all" href="css/struct.css"> 
<script src="js/less-1.3.0.min.js" type="text/javascript"></script>
</head>
<body>
<div class="RowContainer12">
	<!-- INTEGRAMOS EL HEADER -->
	<?php require_once("capaVista/header.php"); ?>
	<div class="row">&nbsp;</div>
	<div class="row">&nbsp;</div>
	<!-- INCLUIMOS LA CAPA RESULTADO -->
	<?php require_once("capaVista/noprecontent.php"); ?>
	<?php require_once("capaVista/sellSuccess.php"); ?>
	<!-- INCLUIMOS EL FOOTER -->
	<div class="row">&nbsp;</div>
	<div class="row">&nbsp;</div>
	<?php require_once("capaVista/footer.php"); ?>
</div>
</body>

</html>