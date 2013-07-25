<?php session_start(); ?>
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
	<!-- INCLUIMOS LA CAPA PRODUCTOS -->
	<?php require_once("capaVista/product.php"); ?>
	<!-- INCLUIMOS LA CAPA PRODUCTOS -->
	<?php require_once("capaVista/catalog.php"); ?>
	<!-- INCLUIMOS EL FOOTER -->
	<?php require_once("capaVista/footer.php"); ?>
</div>
</body>

</html>