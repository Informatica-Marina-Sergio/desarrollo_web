<?php 
session_start();
/**
 * 
 */
class Cliente
{
	
	private $con;

	function __construct()
	{
		include_once("DB.php");
		$db = new DB();
		$this->con = $db->connect();
	}

	public function getCliente(){
		$query = $this->con->query("SELECT `id`, `name`, `surname`, `email`, `phone_number`, `address` FROM `users`");
		$ar = [];
		if (@$query->num_rows > 0) {
			while ($row = $query->fetch_assoc()) {
				$ar[] = $row;
			}
			return ['status'=> 202, 'message'=> $ar];
		}
		return ['status'=> 303, 'message'=> 'No hay datos de cliente'];
	}


	public function getPedidoCliente(){
		$query = $this->con->query("SELECT a.id, a.user_id ,a.product_id, a.qty, b.name FROM pedidos a JOIN productos b ON a.product_id = b.id");
		$ar = [];
		if (@$query->num_rows > 0) {
			while ($row = $query->fetch_assoc()) {
				$ar[] = $row;
			}
			return ['status'=> 202, 'message'=> $ar];
		}
		return ['status'=> 303, 'message'=> 'Aun no hay pedidos'];
	}
	

}


if (isset($_POST["GET_CLIENTE"])) {
	if (isset($_SESSION['admin_id'])) {
		$c = new Cliente();
		echo json_encode($c->getCliente());
		exit();
	}
}

if (isset($_POST["GET_PEDIDOS_CLIENTE"])) {
	if (isset($_SESSION['admin_id'])) {
		$c = new Cliente();
		echo json_encode($c->getPedidoCliente());
		exit();
	}
}


?>