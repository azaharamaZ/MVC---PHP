<?php include "funciones.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Articulos</title>
</head>
<body>

	<center>
	<h1>Lista de artículos</h1>
	<?php
		if(getPermisos()==1) { //COMPROBAMOS SI TIENE PERMISO PARA ESTAR AQUI
			echo "<p><a href='formArticulos.php?Anadir>Añadir artículo</a></p>";
		}
		//////
		if (!isset($_COOKIE['login']) || ($_COOKIE['login']) != 'autorizado' ) {
			echo "No posee permiso de acceso";
			header("Location:index.php");
		} else if(!isset($_GET['orden']) ){
			$orden = $_GET['orden'];
			pintaProductos($orden);
		}
	?>
	<a href="index.php">Página de inicio</a>
	</center>

	

</body>
</html>
