<?php include "funciones.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Formulario de artículos</title>
</head>
<body>

	<?php 
		//COMPROBAMOS SI TIENE PERMISOS DE EDICIÓN
		if (!isset($_COOKIE['login']) || ($_COOKIE['login']) != 'autorizado' ) {
			echo "No posee permiso de acceso";
			header("Location:index.php");
			} 
			else if( isset($_GET['editar']) ) {
				$datos = getProducto($_GET['editar']);
				$result = $datos->fetch(PDO::FETCH_ASSOC);
				print_r($result);
			} 
			elseif (isset($_GET['borrar'])) {
				$datos = getProducto($_GET['borrar']);
			} 
			else {
				$datos = ["ProductoID" => "",
							"Name" => "", 
							"Cost" => 0,
							"Price" => 0,
							"Categoria" => "PANTALÓN"];
			}
		?>
		
	<!-- Insertar Registros-->
		<hr>
		<h3>Insertar Artículos</h3>
		<form method="post" action="formArticulos.php">
			<table>
				<tr>
					<td>Id</td>
					<td>Name</td>
					<td>Coste</td>
					<td>Precio</td>
					<td>Categoria</td>
				</tr>
				<tr>
					<td><input type="submit" name="editar"></td>
					<td><input type="submit" name="borrar"></td>
				</tr>
			</table>
		</form>
	<!-- Fin Insertar Registros-->


	
</body>
</html>