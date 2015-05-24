<!DOCTYPE html>
<?php 
include "cabecera.php";
header ('Content-type: text/html; charset=utf-8'); 
?>
			<section class="formulario">
<?php
	$error = false;
	$errores = array ("usuario"=>"", "clave"=>"", "correo"=>"");
	// Obtener los valores de las variables de HTML
		if (isset($_REQUEST['insertar']))
			{
				$insertar = $_REQUEST['insertar'];	
				$usuario = $_REQUEST['usuario'];
				$clave = $_REQUEST['clave'];
				$correo = $_REQUEST['correo'];
				// Validar los datos ingresados por el usuario
				// Validar usuario 
				if (trim($usuario) == "")
					{
						$errores["usuario"] = "¡Debe introducir el usuario!";
						$error = true;
					}
				// Validar clave
				if (trim($clave == ""))
					{
						$errores["clave"] = "¡Debe introducir la clave!";
						$error = true;								
					}
				// Validar correo
				if (trim($correo == ""))
					{
						$errores["correo"] = "¡Debe introducir el correo!";
						$error = true;											
					}
			}	
		if (isset($_REQUEST['insertar']) && !$error)
			{				
				// Conectar con la base de datos clientes
				$servername = "localhost";
				$username = "cursophp";
				$password = "";
				$dbname = "clientes";
				// Crear conexión
				$conn = mysqli_connect ($servername, $username, $password, $dbname);
				// Chequear la conexion
				If (!($conn))
					{
						die ("Conexión fallida: " . mysqli_connect_error());				
					}
				$sql = "INSERT INTO usuario (usuario, clave, correo) values ('$usuario', '$clave', '$correo')";
				if (mysqli_query($conn, $sql))
					{
						echo "Usuario creado satisfactoriamente";	
						print ("<p><a href='index.php'>Volver a inicio</a></p>\n"); 
					}
				else	
					{
						echo "Error: " . "<p>" . mysqli_error($conn) . "</p>";			
						print ("<p><a href='insertar_usuario3.php'>Volver al formulario</a></p>\n"); 
					}
				mysqli_close($conn);
			}		
		else
			{
?>						
				<h1>Registrarse:</h1>
				<form action="insertar_usuario3.php" name="insertar" method="post">
					<p class="campo">Usuario:*<input type="text" name="usuario" size="10" maxlenght="10"
<?php
	// Validamos el usuario
	if (isset($_REQUEST['insertar']))
		print ("value='$usuario'></p>");
	else	
		print ("></p>");
	if ($errores["usuario"] != "")
		print "<p>Error: {$errores['usuario']}</p>";
?>						
					<p class="campo">Clave:*&nbsp;&nbsp;&nbsp;<input type="password" name="clave" id="miclave" size="10" maxlenght="10"
<?php
	// Validamos la clave
	if (isset($_REQUEST['insertar']))
		print ("value='$clave'></p>");
	else 
		print ("></p>");
	if ($errores["clave"] != "")
		print "<p>Error {$errores['clave']}</p>";
?>					
					<p class="campo">Correo:*<input type="email" name="correo" id="micorreo"
<?php	
	// Validamos el correo
	if (isset($_REQUEST['insertar']))
		print ("value='$correo'></p>");
	else
		print ("></p>");
	if ($errores["correo"] != "")
		print "<p>Error {$errores['correo']}</p>";
?>
					<p class="campo"><input type="submit" name="insertar" value="Registrarse"></p>
				</form>
				<p class="campo">Nota: Los datos marcados con (*) deben ser rellenados obligatoriamente</p>
				<p><a href="index.php">Volver al inicio</a></p>		
			</section>
<?php	
			}
include "piedepagina.php";
?>
