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


	public function register($name, $surname, $email, $phone, $dir, $password)
	{
		$q = $this->con->query("SELECT * FROM users WHERE email = '$email' LIMIT 1");
		if ($q->num_rows > 0) {
			return ['status' => 303, 'message' => 'Ya existe un usuario con este email en la BBDD'];
		} else {
			$password = password_hash($password, PASSWORD_BCRYPT, ["COST" => 8]);
			$q = $this->con->query("INSERT INTO `users`(`name`,`surname`, `email`, `pass`,`phone_number`,`address`) VALUES ('$name','$surname','$email','$password','$phone','$dir')");
			if ($q) {
				return ['status' => 202, 'message' => 'Usuario creado'];
			}
		}
	}

	public function login($email, $password)
	{
		$q = $this->con->query("SELECT * FROM users WHERE email = '$email' LIMIT 1");
		if ($q->num_rows > 0) {
			$row = $q->fetch_assoc();
			if (password_verify($password, $row['pass'])) {
				$_SESSION['user_name'] = $row['name'];
				$_SESSION['user_id'] = $row['id'];
				return ['status' => 202, 'message' => 'Login exitoso'];
			} else {
				return ['status' => 303, 'message' => 'Esta contraseña no es correcta'];
			}
		} else {
			return ['status' => 303, 'message' => 'No existe un usuario con ese correo'];
		}
	}
}

if (isset($_POST['registrar'])) {
	extract($_POST);
	if (!empty($name) && !empty($surname) && !empty($email) && !empty($phone) && !empty($dir) && !empty($password) && !empty($cpassword)) {
		if ($password == $cpassword) {
			$c = new Identificacion();
			$result = $c->register($name, $surname, $email, $phone, $dir, $password);
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

if (isset($_POST['login'])) {
	extract($_POST);
	if (!empty($email) && !empty($password)) {
		$c = new Identificacion();
		$result = $c->login($email, $password);
		echo json_encode($result);
		exit();
	} else {
		echo json_encode(['status' => 303, 'message' => 'No puede haber campos vacios']);
		exit();
	}
}
