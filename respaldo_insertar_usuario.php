<!DOCTYPE html>
	<html lang="es">
	<head>
 		<meta charset="utf-8">
		<meta name="description" content="insertar usuarios">
		<meta content="width=device-width, initial-scale=1, minimum-scale=1" name="viewport">
		<meta name="robots" content="noindex, nofollow">
		<meta name="googlebot" content="noindex, nofollow">
		<title>Insertar usuario</title>
		<link href="movil.css" rel="stylesheet" media="all and (min-width:0px) and (max-width: 480px)" />
		<link href="tablet.css" rel="stylesheet" media="all and (min-width: 481px) and (max-width: 800px)" />
		<link href="escritorio.css" rel="stylesheet" media="all and (min-width: 801px)" />	   
	</head>
	<body>
<?php
	// Obtener valores introducidos en el formulario
	if (isset($_REQUEST['insertar']))
		{
			$insertar = $_REQUEST['insertar'];
			$usuario = $_REQUEST['usuario'];
			$clave = $_REQUEST['clave'];
			$correo = $_REQUEST['correo'];
			// Insertar la noticia en la Base de Datos
			$servername = "localhost";
			$username = "usuariocliente";
			$password = "";
			$dbname = "clientes";
			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			// Check connection
			if (!$conn) 
				{
					die("Connection failed: " . mysqli_connect_error());
				}
			$sql = "INSERT INTO usuario (usuario, clave, correo) values ('$usuario', '$clave', '$correo')";
			if (mysqli_query($conn, $sql)) 
				{
				echo "Usuario creado satisfactoriamente";
				} 
			else 
				{
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			mysqli_close($conn); 
			print ("<p>[<a href='index.html'>Volver a inicio</a> ]</p>\n");
		}
	else
		{
?>
<h1>Registrarse</h1>
<form action="insertar_usuario.php" name="inserta" method="post">
	<!-- Cuenta de usuario -->
	<p>Usuario:*<input type="text" name="usuario" size="10" MAXLENGTH="10"></p>
	<!-- Clave del usuario -->
	<p>Clave:*<input type="text" name="clave" id="clave" size="10" maxlenght="10"></p>
	<!-- Correo -->
	<p>Correo:*<input type="email" name="correo" id="correo"></p>
	<!-- Botón de envío -->
	<p><input type="submit" NAME="insertar" VALUE="Insertar usuario"></p>
</form>

<p>NOTA: los datos marcados con (*) deben ser rellenados obligatoriamente</p>

<p>[ <a href='index.html'>Volver a inicio</a> ]</p>

<?php
		}
?>
</body>
</html>