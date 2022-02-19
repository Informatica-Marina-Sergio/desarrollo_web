<?php
session_start();

class Identificacion
{

	private $con;

	function __construct()
	{
		include_once("DB.php");
		$db = new DB();
		$this->con = $db->connect();
	}


	public function registerAdmin($name, $email, $password)
	{
		$q = $this->con->query("SELECT * FROM admin WHERE email = '$email' LIMIT 1");
		if ($q->num_rows > 0) {
			return ['status' => 303, 'message' => 'Ya existe un administrador con este email en la BBDD'];
		} else {
			$password = password_hash($password, PASSWORD_BCRYPT, ["COST" => 8]);
			$q = $this->con->query("INSERT INTO `admin`(`name`, `email`, `password`) VALUES ('$name','$email','$password')");
			if ($q) {
				return ['status' => 202, 'message' => 'Administrador creado'];
			}
		}
	}

	public function loginAdmin($email, $password)
	{
		$q = $this->con->query("SELECT * FROM admin WHERE email = '$email' LIMIT 1");
		if ($q->num_rows > 0) {
			$row = $q->fetch_assoc();
			if (password_verify($password, $row['password'])) {
				$_SESSION['admin_name'] = $row['name'];
				$_SESSION['admin_id'] = $row['id'];
				return ['status' => 202, 'message' => 'Login exitoso'];
			} else {
				return ['status' => 303, 'message' => 'La contraseña no es correcta'];
			}
		} else {
			return ['status' => 303, 'message' => 'No existe un administrador con ese correo'];
		}
	}
}

if (isset($_POST['registrar_admin'])) {
	extract($_POST);
	if (!empty($name) && !empty($email) && !empty($password) && !empty($cpassword)) {
		if ($password == $cpassword) {
			$c = new Identificacion();
			$result = $c->registerAdmin($name, $email, $password);
			echo json_encode($result);
			exit();
		} else {
			echo json_encode(['status' => 303, 'message' => 'La contraseña no coincide']);
			exit();
		}
	} else {
		echo json_encode(['status' => 303, 'message' => 'No puede haber campos vacios']);
		exit();
	}
}

if (isset($_POST['login_admin'])) {
	extract($_POST);
	if (!empty($email) && !empty($password)) {
		$c = new Identificacion();
		$result = $c->loginAdmin($email, $password);
		echo json_encode($result);
		exit();
	} else {
		echo json_encode(['status' => 303, 'message' => 'No puede haber campos vacios']);
		exit();
	}
}
