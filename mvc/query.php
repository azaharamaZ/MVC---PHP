<?php 

	include "conexion.php";

	function tipoUsuario($nombre, $correo){
		$conn = crearConexion();
		if(esSuperAdmin($nombre, $correo)) {
			return "superadmin"; 
		} else {
			$sql = "SELECT full_name, email, enabled FROM user 
					WHERE full_name = :name AND email = :email";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':name', $nombre);
			$stmt->bindParam(':email', $correo);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($row) {
				if ($row['enabled'] == 0) {
					$user_type = "registrado";
				} else if ($row['enabled'] == 1) {
					$user_type = "autorizado";
				} else {
					$user_type = "registered";
				}
			} else {
				$user_type = "not registered";
			}
			cerrarConexion($conn);
			return $user_type;
		}
	}
		
	function esSuperAdmin($nombre, $correo){
		$conn = crearConexion();
		// Prepare the SQL statement to check if the user exists and is a superadmin
		$sql = "SELECT user.id FROM user INNER JOIN setup 
				ON user.id = setup.superadmin_id 
				WHERE user.full_name = :nombre AND user.email = :correo";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':correo', $correo);
		$stmt->execute();
	
		// Check if the user is a superadmin
		$is_superadmin = $stmt->rowCount() == 1;
	
		// Close the database connection
		$pdo = null;
	
		return $is_superadmin;
	}


	function getPermisos() {
		$conn = crearConexion();
		$query = "SELECT management FROM setup";
		$result = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
		
		cerrarConexion($conn);
		mysqli_free_result($result);
		return $result['management'];
	}


	function cambiarPermisos() {
		$conn = crearConexion();
		$permisos = getPermisos();
		if(($permisos == 1)) {
			$query = "UPDATE setup SET Autenticación = 0";
		} elseif (($permisos == 0)) {
			$query = "UPDATE setup SET Autenticación = 1";
		}
		$result = $conn->query($query);
		cerrarConexion($conn);
		mysqli_free_result($query);
	}


	function getCategorias() {
		try {
			$conn = crearConexion();
			$query = "SELECT id, name FROM category";
			$result = $conn->query($query);
			cerrarConexion($conn);
			$result->closeCursor();
		} 
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	function getListaUsuarios() {
		$conn = crearConexion();
		// Query the user table for all users and their information
		$query = "SELECT email, full_name, enabled FROM user";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		// Fetch all the rows as an associative array
		$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Return the user data as a virtual table
		return $users;
	}


	function getProducto($ID) {
		$conn = crearConexion();
		$query = "SELECT * FROM product WHERE id = $ID";
		$result = $conn->query($query);
		cerrarConexion($conn);
		return $result;
		$result->closeCursor();

	}


	function getProductos($orden) {
		try {
			$conn = crearConexion();
			$query = "SELECT product.id, product.name, product.cost, product.price, category.name as Categoria FROM product 
						INNER JOIN category WHERE product.category_id = category.category_id 
						ORDER BY $orden";
			$result = $conn->query($query);
			cerrarConexion($conn);
			$result->closeCursor();
		} 
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	function anadirProducto($nombre, $coste, $precio, $categoria) {
		try {
			$conn = crearConexion();
			$query = "INSERT INTO product (name, cost, price, category_id) 
						VALUES ($nombre, $coste, $precio, $categoria)";
			$result = $conn->query($query);
			cerrarConexion($conn);
			
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	function borrarProducto($id) {
		try {
			$conn = crearConexion();
			$query = "DELETE FROM product WHERE id = $id";
			$result = $conn->query($query);
			cerrarConexion($conn);
		} 
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	function editarProducto($id, $nombre, $coste, $precio, $categoria) {
		try {
			$conn = crearConexion();
			$query = "UPDATE product SET id =: $id, name =: $nombre, cost =: $coste, price =: $precio, category_id =: $categoria
						WHERE id = $id";
			$result = $conn->query($query);
			cerrarConexion($conn);
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

?>