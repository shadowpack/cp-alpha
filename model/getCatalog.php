<?php
require_once('db_core.php');
$db = new db_core();
$resultados = array();
$consulta[0] = $db->query('SELECT * FROM productos INNER JOIN imagenes_productos ON productos.id_item = imagenes_productos.id_item WHERE productos.estado = 1 AND imagenes_productos.portrait = 1');
while($consulta[1] = mysql_fetch_array($consulta[0], MYSQL_BOTH))
{
	$objeto = new stdClass();
	$result = (object)$consulta[1];
	$objeto->nombre = $result->nombre;
	$objeto->tiempo = $result->tiempoFinal;
	$objeto->precio_r = $result->precio_real;
	$objeto->precio = $result->precio_descuento;
	$objeto->cantidad = $result->cantidad_total;
	$objeto->descripcion_small = $result->descripcion_small;
	$objeto->id = $result->id_item;
	$objeto->img = $result->source;
	$resultados[] = $objeto;
}
echo json_encode($resultados);
?>