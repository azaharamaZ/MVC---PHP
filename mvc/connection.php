<?php 

	function crearConexion() {
		$host = "127.0.0.1:3308";
		$user = "root";
		$pass = '';
		$bbdd = "pac_dwes";

		try {
			$con = new PDO("mysql:host=$host;dbname=$bbdd", $user, $pass);
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$con->exec("SET CHARACTER SET utf8");
			return $con;
		} catch (PDOException $e) {
			die ("Could not connect to the database $bbdd :" . $e->getMessage());
		} 
	}


	function cerrarConexion($conexion) {
		$conn = null;
	}


?>