<?php 
session_start();

class Productos
{
	
	private $con;

	function __construct()
	{
		include_once("DB.php");
		$db = new DB();
		$this->con = $db->connect();
	}

	public function getProducts(){
		$q = $this->con->query("SELECT a.id, a.name, a.price,a.qty, a.description, a.img,b.name as categoria FROM productos a JOIN tipoprenda b ON b.id = a.cat_id");
		$products = [];
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$products[] = $row;
			}
			$_DATA['products'] = $products;
		}

		$categories = [];
		$q = $this->con->query("SELECT * FROM tipoprenda");
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$categories[] = $row;
			}
			$_DATA['categories'] = $categories;
		}

		return ['status'=> 202, 'message'=> $_DATA];
	}

	public function addProduct($product_name,
								$category_id,
								$product_desc,
								$product_qty,
								$product_price,
								$file){


		$fileName = $file['name'];
		$fileNameAr= explode(".", $fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {

			if ($file['size'] > (1024 * 2)) {
				
				$uniqueImageName = time()."_".$file['name'];
				if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/product_images/".$uniqueImageName)) {
					
					$q = $this->con->query("INSERT INTO `productos`(`tipo_id`, `name`, `qty`, `price`, `description`, `img`) VALUES ('$category_id', '$product_name', '$product_qty', '$product_price', '$product_desc', '$uniqueImageName')");
					if ($q) {
						return ['status'=> 202, 'message'=> 'Producto añadido con exito'];
					}else{
						return ['status'=> 303, 'message'=> 'Error inesperado'];
					}

				}else{
					return ['status'=> 303, 'message'=> 'Error al subir la imagen'];
				}

			}else{
				return ['status'=> 303, 'message'=> 'La imágen tiene un tamaño demasiado grande'];
			}

		}else{
			return ['status'=> 303, 'message'=> 'El formato de la imágen no es valido, los formatos validos son: jpg, jpeg, png '];
		}

	}


	public function editarConImagen($pid,
										$product_name,
										$category_id,
										$product_desc,
										$product_qty,
										$product_price,
										$file){


		$fileName = $file['name'];
		$fileNameAr= explode(".", $fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
			
			if ($file['size'] > (1024 * 2)) {
				
				$uniqueImageName = time()."_".$file['name'];
				if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/product_images/".$uniqueImageName)) {
					
					$q = $this->con->query("UPDATE `productos` SET 
										`tipo_id` = '$category_id', 
										`name` = '$product_name', 
										`qty` = '$product_qty', 
										`price` = '$product_price', 
										`description` = '$product_desc', 
										`img` = '$uniqueImageName'
										WHERE id = '$pid'");
                
					if ($q) {
						return ['status'=> 202, 'message'=> 'Producto actualizado con exito'];
					}else{
						return ['status'=> 303, 'message'=> 'Error inesperado'];
					}

				}else{
					return ['status'=> 303, 'message'=> 'Error al subir la imagen'];
				}

			}else{
				return ['status'=> 303, 'message'=> 'La imágen tiene un tamaño demasiado grande'];
			}

		}else{
			return ['status'=> 303, 'message'=> 'El formato de la imágen no es valido, los formatos validos son: jpg, jpeg, png '];
		}

	}

	public function editarSinImagen($pid,
										$product_name,
										$category_id,
										$product_desc,
										$product_qty,
										$product_price){

		if ($pid != null) {
			$q = $this->con->query("UPDATE `productos` SET 
										`tipo_id` = '$category_id', 
										`name` = '$product_name', 
										`qty` = '$product_qty', 
										`price` = '$product_price', 
										`description` = '$product_desc'
										WHERE id = '$pid'");

			if ($q) {
				return ['status'=> 202, 'message'=> 'Producto actualizado con exito'];
			}else{
				return ['status'=> 303, 'message'=> 'Error inesperado'];
			}
			
		}else{
			return ['status'=> 303, 'message'=> 'El id del producto no es valido'];
		}
		
	}

	public function addCategory($name){
		$q = $this->con->query("SELECT * FROM tipoprenda WHERE name = '$name' LIMIT 1");
		if ($q->num_rows > 0) {
			return ['status'=> 303, 'message'=> 'Esta categoría ya existe'];
		}else{
			$q = $this->con->query("INSERT INTO tipoprenda (name) VALUES ('$name')");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Tipo de prenda añadido'];
			}else{
				return ['status'=> 303, 'message'=> 'Error inesperado'];
			}
		}
	}

	public function getTipo(){
		$q = $this->con->query("SELECT * FROM tipoprenda");
		$ar = [];
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$ar[] = $row;
			}
		}
		return ['status'=> 202, 'message'=> $ar];
	}

	public function deleteProduct($pid = null){
		if ($pid != null) {
			$q = $this->con->query("DELETE FROM productos WHERE id = '$pid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Producto eliminado'];
			}else{
				return ['status'=> 202, 'message'=> 'Error inesperado'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'El id del producto no es valido'];
		}

	}

	public function borrarTipo($tip = null){
		if ($tip != null) {
			$q = $this->con->query("DELETE FROM tipoprenda WHERE tipo_id = '$tip'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Tipo de prenda eliminada'];
			}else{
				return ['status'=> 202, 'message'=> 'Error inesperado'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'El id del producto no es valido'];
		}

	}
	
	

	public function actualizarTipo($post = null){
		extract($post);
		if (!empty($tipo_id) && !empty($tipo_nombre)) {
			$q = $this->con->query("UPDATE tipoprenda SET name = '$tipo_nombre' WHERE id = '$tipo_id'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Tipo de prenda actualizada'];
			}else{
				return ['status'=> 202, 'message'=> 'Error inesperado'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'El id del producto no es valido'];
		}

	}


}


if (isset($_POST['GET_PRODUCTO'])) {
	if (isset($_SESSION['admin_id'])) {
		$p = new Productos();
		echo json_encode($p->getProducts());
		exit();
	}
}


if (isset($_POST['ADD_PRODUCTO'])) {

	extract($_POST);
	if (!empty($product_name) 
	&& !empty($category_id)
	&& !empty($product_desc)
	&& !empty($product_qty)
	&& !empty($product_price)
	&& !empty($_FILES['product_image']['name'])) {
		$p = new Productos();
		$result = $p->addProduct($product_name,
								$category_id,
								$product_desc,
								$product_qty,
								$product_price,
								$_FILES['product_image']);
		
		header("Content-type: application/json");
		echo json_encode($result);
		http_response_code($result['status']);
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Revise los campos (alguno vacio)']);
		exit();
	}
}


if (isset($_POST['EDIT_PRODUCTO'])) {
	extract($_POST);
	if (!empty($pid)
	&& !empty($e_product_name) 
	&& !empty($e_category_id)
	&& !empty($e_product_desc)
	&& !empty($e_product_qty)
	&& !empty($e_product_price) ) {
		
		$p = new Productos();
		if (isset($_FILES['e_product_image']['name']) 
			&& !empty($_FILES['e_product_image']['name'])) {
			$result = $p->editarConImagen($pid,
								$e_product_name,
								$e_category_id,
								$e_product_desc,
								$e_product_qty,
								$e_product_price,
								$_FILES['e_product_image']);
		}else{
			$result = $p->editarSinImagen($pid,
								$e_product_name,
								$e_category_id,
								$e_product_desc,
								$e_product_qty,
								$e_product_price);
		}

		echo json_encode($result);
		exit();


	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Revise los campos (alguno vacio)']);
		exit();
	}



	
}


if (isset($_POST['add_tipoprenda'])) {
	if (isset($_SESSION['admin_id'])) {
		$tipo_nombre = $_POST['tipo_nombre'];
		if (!empty($tipo_nombre)) {
			$p = new Productos();
			echo json_encode($p->addCategory($tipo_nombre));
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Revise los campos (alguno vacio)']);
		}
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Session Error']);
	}
}

if (isset($_POST['GET_TIPOPRENDA'])) {
	$p = new Productos();
	echo json_encode($p->getTipo());
	exit();
	
}

if (isset($_POST['DELETE_PRODUCT'])) {
	$p = new Productos();
	if (isset($_SESSION['admin_id'])) {
		if(!empty($_POST['pid'])){
			$pid = $_POST['pid'];
			echo json_encode($p->deleteProduct($pid));
			exit();
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Id de producto invalido']);
			exit();
		}
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'La sesión no es valida']);
	}
}


if (isset($_POST['DELETE_TIPO'])) {
	if (!empty($_POST['tip'])) {
		$p = new Productos();
		echo json_encode($p->borrarTipo($_POST['tip']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Detalles no validos']);
		exit();
	}
}

if (isset($_POST['EDIT_TIPO'])) {
	if (!empty($_POST['tipo_id'])) {
		$p = new Productos();
		echo json_encode($p->actualizarTipo($_POST));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Detalles no validos']);
		exit();
	}
}
