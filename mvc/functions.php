<?php 

	include "consultas.php";


	function pintaCategorias($defecto) {
		$categorias = getCategorias();

		
	}
	

	function pintaTablaUsuarios(){
		$users = getListaUsuarios();
		// Start the HTML table
		$table = "<table>";
		// Add the headers to the table
		$table .= "<tr><th>Name</th><th>Email</th><th>Authorized</th></tr>";
		// Loop through the users and add each row to the table
		foreach ($users as $user) {
			$table .= "<tr><td>{$user['full_name']}</td><td>{$user['email']}</td><td>";
			// If the user is authorized, make the authorized value bold
			if ($user['enabled'] == 1) {
			$table .= "<b>authorized</b>";
			} else {
			$table .= "not authorized";
			}	
		}
		$table .= "</td></tr>";
		// Close the HTML table
		$table .= "</table>";

		// Return the table HTML
		return $table;
	}

		
	function pintaProductos($orden) {
		// Completar...	
	}

?>