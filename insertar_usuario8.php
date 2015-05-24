<?php 
header ('Content-type: text/html; charset=utf-8'); 
include "cabecera.php";
?>
		<body>
			<section class="formulario">
<?php
	// Obtener los valores de las variables de HTML
		if (isset($_REQUEST['insertar']))
			{
				$insertar = $_REQUEST['insertar'];	
				$usuario = $_REQUEST['usuario'];
				$clave = $_REQUEST['clave'];
				$correo = $_REQUEST['correo'];
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
				<form action="insertar_usuario.php" name="insertar" method="post">
					<p class="etiqueta">Usuario:*</p>
					<p class="campo"><input type="text" name="usuario" size="10" maxlenght="10" required></p>
					
					<p class="etiqueta">Clave:*</p>				
					<p class="campo"><input type="password" name="clave" id="miclave" size="10" maxlenght="10" required></p>
					<p class="etiqueta">Correo:*</p>
					<p class="campo"><input type="email" name="correo" id="micorreo" required></p>

					<p class="etiqueta">Cédula, RIF o pasaporte:
					<p class="campo">
						<select name="tipocliente">
							<option value="" select>&nbsp
							<option value="V">V
							<option value="E">E
							<option value="P">P
							<option value="J">J
							<option value="G">G
						</select>
						<input type="text" name="cedularif" id="micedularif" size="12" maxlenght="12"></p>
					
					<p class="etiqueta">Nombre(s):</p>
					<p class="campo"><input type="text" name="nombres" id="minombre" size="20" maxlenght="100"></p>
												
					<p class="etiqueta">Apellido(s):</p>
					<p class="campo"><input type="text" name="apellidos" id="miapellido" size="20" maxlenght="100"></p>

					<p class="etiqueta">Dirección:</p>
					<p class="campo"><input type="input" name="direccion" id="midireccion" size="20" maxlenght="200"></p>

					<p class="etiqueta">Teléfono:</p>
					<p class="campo"><input type="tel" name="telefono" id="mitelefono"></p>

					<p class="campo"><input type="submit" name="insertar" value="Registrarse"></p>
				</form>
				<p class="campo">Nota: Los datos marcados con (*) deben ser rellenados obligatoriamente.</p>
				<p class="campo"><a href="index.php">Volver al inicio</a></p>		
			</section>
<?php	
			}
?>
		</body>
	</html>					
