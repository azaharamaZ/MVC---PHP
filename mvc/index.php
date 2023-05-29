<?php 
session_start();
require "consultas.php"; 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index.php</title>
</head>
<body>
	<?php
		if(isset($_POST['name']) && isset($_POST['email'])) {
			$nombre = $_POST['name'];
			$correo = $_POST['email'];
			$tipoUsuario = tipoUsuario($nombre, $correo);
			setcookie("login", $tipoUsuario, time()+4200);
			if ($tipoUsuario == 'superadmin') {
				echo "<h1>Welcome, $nombre!</h1>";
				echo "<p>You are a superadmin. Click <a href='users.php'>here</a> to access the user management page.</p>";
			} elseif ($tipoUsuario == 'authorized') {
				echo "<h1>Welcome, $nombre!</h1>";
				echo "<p>You are an authorized user. Click <a href='articles.php'>here</a> to access the articles page.</p>";
			} elseif ($tipoUsuario == 'registered') {
				echo "<h1>Welcome, $nombre!</h1>";
				echo "<p>You are a registered user, but you do not have access permissions.</p>";
			} else {
				echo "<p>Sorry, you are not registered.</p>";
			}
		}
	?>	

	<center>
		<h3>Ingrese las credenciales </h3>
		<form action="index.php" method="post">
			<label for="name">Nombre:</label>
			<input type="text" name="name" id="name"><br><br>
			<label for="email">Email:</label>
			<input type="email" name="email" id="email"><br><br>
			<input type="submit" value="Submit">
		</form>
	</center>

	
</body>
</html>