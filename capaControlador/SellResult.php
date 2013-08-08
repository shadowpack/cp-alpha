<?php
include("model/db_core.php");
class sellResult{
	private $db;
	function sellResult(){
		$this->db = new db_core();
	}
	function getSellData($id){
		$consulta = $this->db->reg_one("SELECT * FROM transacciones_transbank AS t WHERE t.TBK_ORDEN_COMPRA='".$id."'");
		switch($consulta['TBK_RESPUESTA']){
			case 0:
				$consulta['TBK_VCI'] = "Transaccion Aprobada";
				break;
			case -1:
				$consulta['TBK_VCI'] = "Transaccion Rechazada";
				break;
			case -2:
				$consulta['TBK_VCI'] = "La transaccion debe reintentarse";
				break;
			case -3:
				$consulta['TBK_VCI'] = "Error en transaccion";
				break;
			case -4: 
				$consulta['TBK_VCI'] = "Rechazo de transaccion";
				break;
			case -5: 
				$consulta['TBK_VCI'] = "Rechazo por error de tasa";
				break;
			case -6:
				$consulta['TBK_VCI'] = "Excede cupo máximo mensual";
				break;
			case -7:
				$consulta['TBK_VCI'] = "Excede límite diario por transacción";
				break;
			case -8:
				$consulta['TBK_VCI'] = "Rubro no autorizado";
				break;
		}
		switch($consulta['TBK_TIPO_PAGO']){
			case "VD":
				$consulta['TBK_TIPO_PAGO'] = "Red Compra";
				$consulta['TBK_NUMERO_CUOTAS'] = "No Aplica";
				$consulta['TBK_TASA_INTERES_MAX'] = "No Aplica";
				break;
			case "VC":
				$consulta['TBK_TIPO_PAGO'] = "Tarjeta de Credito : Venta Con Cuotas";
				break;
			case "SI":
				$consulta['TBK_TIPO_PAGO'] = "Tarjeta de Credito : Tres Cuotas Precio Contado";
				break;
			case "S2":
				$consulta['TBK_TIPO_PAGO'] = "Tarjeta de Credito : Dos Cuotas Precio Contado";
				break;
			case "CI":
				$consulta['TBK_TIPO_PAGO'] = "Tarjeta de Credito : Cuotas Comercio";
				break;
		}
		return $consulta;
	}
}
?>