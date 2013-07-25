<?php
    require_once("model/db_core.php");
	class Producto
	{
		private $db;
		function Producto(){
			$this->db = new db_core();
		}
		public function getPhoto(){
			$consulta[0] = $this->db->query("SELECT * FROM imagenes_productos as img  INNER JOIN productos as p ON p.id_item = img.id_item WHERE img.id_item ='".$_GET['id']."'");
			$img = array();
			while ($consulta[1] = mysql_fetch_array($consulta[0])) {
				$img[] = (object)$consulta[1];
			}
			return $img;
		}
		public function getDatos(){
			$consulta[0] = $this->db->query("SELECT * FROM productos as p  WHERE p.id_item ='".$_GET['id']."'");
			return mysql_fetch_array($consulta[0]);
		}
		public function getSell(){
			$consulta[0] = $this->db->query("SELECT IFNULL(SUM(cantidad),0) FROM transacciones as p  WHERE p.id_producto ='".$_GET['id']."'");
			$sell = mysql_fetch_array($consulta[0]);
			return $sell[0];
		}
	}
?>