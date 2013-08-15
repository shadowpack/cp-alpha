<?php
class account{
	var $db;	
	function account(){
		$this->db = new db_core();
	}
	function getCupones(){
		$consulta[0] = $this->db->query("SELECT * FROM productos as p 
			LEFT JOIN transacciones ON transacciones.id_producto=p.id_item 
			INNER JOIN imagenes_productos ON imagenes_productos.id_item = p.id_item
			WHERE transacciones.id_user='".$_SESSION['id']."' AND transacciones.statusPay='1' AND p.expiracion < ".time().";");
		if(@mysql_num_rows($consulta[0] != 0))
		{
			while($consulta[1] = mysql_fetch_array($consulta[0]))
			{
				echo '<div class="lineProduct">
					<div class="lineProductImg"><img src="'.$consulta[1]['source'].'" height="100px" width="150px" /></div>
					<div class="desProductImg">
						<div class="TitleTab">Descripcion del Cupon</div>
						<div class="ContentTab">'.utf8_encode($consulta[1]['descripcion_small']).'</div>
					</div>
					<div class="expirationTime">
						<div class="TitleTab">Fecha de Expiracion</div>
						<div class="ContentTab">'.date('d/m/Y', $consulta[1]['expiracion']).'</div>
					</div>
					<div class="seeMore">
						<div class="TitleTab">Ver Cupon</div>
						<div class="ContentTab"><img class="buttonImg" id="pdf'.$consulta[1]['id_transaccion'].'" src="img/pdf.png" /></div>
					</div>
					<div class="mailCupon">
						<div class="TitleTab">Enviar a E-Mail</div>
						<div class="ContentTab"><img class="buttonImg" id="mail'.$consulta[1]['id_transaccion'].'" src="img/mail_forward.png" /></div>
					</div>
				</div>';
			}
		}
		else
		{
			echo '<div class="lineProduct">No se encuentran productos validos comprados a la fecha</div>';
		}
	}
	function getNumCupones()
	{
		return $consulta[0] = $this->db->num_one("SELECT * FROM productos as p 
			LEFT JOIN transacciones ON transacciones.id_producto=p.id_item 
			INNER JOIN imagenes_productos ON imagenes_productos.id_item = p.id_item
			WHERE transacciones.id_user='".$_SESSION['id']."' AND transacciones.statusPay='1' AND p.expiracion < ".time().";");
	}
	function changePassword(){
		$consulta = $this->db->num_one("SELECT * FROM users as u WHERE u.id_user='".$_SESSION['id']."' AND u.password='".md5($_POST['password'])."'");
		if($consulta > 0)
		{
			$this->db("UPDATE users SET users.password='".md5($_POST['newpassword'])."' WHERE users.id_user='".$_SESSION['id']."'");
			echo "true";
		}
		else
		{
			echo "ErrorPassword";
		}
	}
	function recoveryPassword($token, $password){
		$consulta = $this->db->num_one("SELECT * FROM users as u WHERE u.recoverToken='".base64_decode($token)."'");
		if($consulta > 0)
		{
			$this->db("UPDATE users SET users.password='".md5($password)."', users.token='' WHERE u.recoverToken='".base64_decode($token)."'");
			echo "true";
		}
		else
		{
			echo "ErrorToken";
		}
	}
}
?>