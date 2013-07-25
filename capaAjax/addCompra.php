<?php
	session_start();
	if(isset($_SESSION["CuponPerfumes-Sell"][$_POST['id']]))
	{
		$_SESSION["CuponPerfumes-Sell"][$_POST['id']]++;
	}
	else
	{
		$_SESSION["CuponPerfumes-Sell"][$_POST['id']]= 1;
	}
	echo "true";
?>