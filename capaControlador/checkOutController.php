<?php 
@session_start();
@include("model/db_core.php");
class checkout
{
	private $db;
	function checkout(){
		$this->db = new db_core();
	}
	private function number(){
		$total = 0;
		foreach($_SESSION["CuponPerfumes-Sell"] as $key => $vector) {
			$total += $vector;
		}
		return $total;
	}
	public function getTotal(){
		$total = 0;
		foreach($_SESSION["CuponPerfumes-Sell"] as $key => $vector) {
			if($key != "delivery")
			{
				$con = $this->db->reg_one("SELECT precio_descuento FROM productos as p WHERE p.id_item='".$key."'");
				$total += $con[0]*$vector;
			}
		}
		if($_SESSION["CuponPerfumes-Sell"]['delivery'])
		{
			$con = $this->db->reg_one("SELECT value FROM settings as s WHERE s.name='delivery'");
			$total += $con['value'];
		}
		return $total;
	}
	public function printLocation(){
		$con[0] = $this->db->query("SELECT * FROM locations as l WHERE l.id_user='".$_SESSION['id']."'");
		while($con[1] = mysql_fetch_array($con[0]))
		{
			echo '<option value="'.$con[1]['id_location'].'">'.$con[1]['direccion'].','.$con[1]['comuna'].','.$con[1]['city'].'</option>';
		}
	}
	public function getDelivery(){
		$con = $this->db->reg_one("SELECT value FROM settings as s WHERE s.name='delivery'");
		/*FACTOR MULTIPLICATIVO*/
		$factor = 1; // $this->number();
		return $con[0]*$factor;
	}
	public function printCheckout(){
		$contador = 0;
		foreach($_SESSION["CuponPerfumes-Sell"] as $key => $vector) {
			if($key != "delivery")
			{
				$con = $this->db->reg_one("SELECT * FROM productos as p WHERE p.id_item='".$key."'");
				for($i=0; $i<$vector; $i++)
				{
					$contador++;
					echo '<div class="row checkoutRow">
						<div class="col1 first">&nbsp;</div>
						<div class="col10 checkout">
							<div class="checkoutBody">
								<div class="col1 first">&nbsp;</div>
								<div class="col9"><div class="precio">'.$contador." - ".$con['nombre'].'</div></div>
								<div class="col1"><div class="precio">$'.number_format($con['precio_descuento'],0,",",".").'</div></div>
								<div class="col1"><div class="imgRemove"><img src="img/carrout.jpg" height="30" width="35" alt="Eliminar" class="Eliminar" value="'.$con['id_item'].'"/></div></div>
							</div>
						</div>
						<div class="col1">&nbsp;</div>
					</div>';
				}
			}
		}
	}
	public function delProduct($id){
		$_SESSION["CuponPerfumes-Sell"][$id]--;
		if($_SESSION["CuponPerfumes-Sell"][$id] == 0)
		{
			unset($_SESSION["CuponPerfumes-Sell"][$id]);
		}
	}
}
?>
