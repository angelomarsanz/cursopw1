<!-- Abrimos la etiqueta PHP para ajustar a utf-8 y hacer un include 
	del encabezado -->
<?php 
header ('Content-type: text/html; charset=utf-8'); 
include "cabecera.php";
?>
<!-- Volvemos a HTML -->

		<body>
			<section class="formulario">

<!-- Abrimos la etiqueta de PHP para codificar en PHP -->

<?php
	// Asignamos un valor inicial a las variables de control de errores

	$error = false;
	$errores = array ("usuario"=>"", "clave"=>"", "correo"=>"");

	/* Si la variable "insertar" existe y tiene algun valor, 
		quiere decir que el usuario introdujo datos en el formulario,
		entonces procedemos a... */

	if (isset($_REQUEST['insertar']))
		{
			// Transferimos los datos de las variables de HTML a las variables de PHP

			$insertar = $_REQUEST['insertar'];	
			$usuario = $_REQUEST['usuario'];
			$clave = $_REQUEST['clave'];
			$correo = $_REQUEST['correo'];
			$tipo_cliente = $_REQUEST['tipocliente'];
			$cedula_rif = $_REQUEST['cedularif'];
			$nombres = $_REQUEST['nombres'];
			$apellidos = $_REQUEST['apellidos'];
			$direccion = $_REQUEST['direccion'];
			$telefono = $_REQUEST['telefono'];

			// Validamos los datos obligatorios*

			/* Si la variable "$usuario" tiene espacios en blanco,
				quiere decir que el usuario no introdujo nada en este campo,
				entonces asignamos un mensaje en la variable "$errores" y 
				asignamos el valor "true" a la variable "$error"
				para mostrarlos después al usuario */

			if (trim($usuario) == "")
				{
					$errores["usuario"] = "¡Debe introducir el usuario!";
					$error = true;
				}

			/* Si la variable "$clave" tiene espacios en blanco,
				quiere decir que el usuario no introdujo nada en este campo,
				entonces asignamos un mensaje en la variable "$errores" y 
				asignamos el valor "true" a la variable "$error"
				para mostrarlos después al usuario */

			if (trim($clave) == "")
				{
					$errores["clave"] = "¡Debe introducir la clave!";
					$error = true;
				}

			/* Si la variable "$correo" tiene espacios en blanco,
				quiere decir que el usuario no introdujo nada en este campo,
				entonces asignamos un mensaje en la variable "$errores" y 
				asignamos el valor "true" a la variable "$error"
				para mostrarlos después al usuario */

			if (trim($correo) == "")
				{
					$errores["correo"] = "¡Debe introducir el correo!";
					$error = true;
				}
		}

	/* Si la variable "insertar" existe y tiene algún valor y además el valor de la variable "error" es "false", 
			quiere decir que no hay error en los datos introducidos por el usuario, 
			entonces procedemos a... */

	if (isset($_REQUEST['insertar']) && !($error))
		{									

			/* Crear las variables necesarias para conectar con la base de datos y
				asignarle los valores correspondientes */

			$servername = "localhost";
			$username = "cursophp";
			$password = "";
			$dbname = "clientes";

			/* Creamos la variable "$conn" y le asignamos la instrucción "mysqli_connect" y las variables
				necesarias para conectar a la base de datos "clientes" */

			$conn = mysqli_connect ($servername, $username, $password, $dbname);

			/* Intentamos conectarnos, si al intentar la variable "$conn" retorna el valor "false", 
				quiere decir que la conexión a la base de datos falló, entonces,
				abortamos el programa y mostramos un mensaje de error 
				por pantalla */

			If (!($conn))
				{
					die ("Conexión fallida: " . mysqli_connect_error());				
				}

			/* Preparamos la variable "$sql" con las instrucciones necesarias y los datos introducidos por el usuario,
				para después insertarlos en la tabla "usuario" de la base de datos "cliente" */
 			
			$sql = "INSERT INTO usuario (usuario, clave, correo, tipo_cliente, cedula_rif, nombres, apellidos, direccion, telefono) values ('$usuario', '$clave', '$correo', '$tipo_cliente', '$cedula_rif', '$nombres', '$apellidos', '$direccion', '$telefono')";

			/* Si se insertaron correctamente los datos en la tabla "usuario" de la base de datos
				"clientes", entonces procedemos a... */
			
			if (mysqli_query($conn, $sql))
				{
					echo "Usuario creado satisfactoriamente";	
					print ("<p><a href='index.html'>Volver a inicio</a></p>\n"); 

				}

			// De lo contrario, si no se pudieron insertar los datos, entonces procedemos a...
	
			else	
				{
					echo "Error: " . "<p>" . mysqli_error($conn) . "</p>";			
					print ("<p><a href='insertar_usuario2.php'>Volver al formulario</a></p>\n"); 
				}
			/* No podemos dejar la conexión a la base de datos abierta!,
				 así que procedemos a cerrarla */
			mysqli_close($conn);
		}

	/* De lo contrario, si la variable "insertar" no existe o no tiene ningún valor
		y además la variable "$error" tiene el valor "true", quiere decir que el usuario aún 
		no ha indroducido datos o le faltó introducir uno o más datos de los que son obligatorios,
		entonces a volver a mostrar los datos al usuario... */
	else
		{

/* Cerramos la etiqueta de PHP, porque lo que viene a continuación está
	en HTML */
?>			
			<h1>Registrarse:</h1>
			<form action="insertar_usuario2.php" name="insertar" method="post">

			<p class="etiqueta">Usuario:*</p>
				<p class="campo"><input type="text" name="usuario" size="10" maxlenght="10" required

<?php
	/* Si la variable "insertar" existe y tiene algún valor, procedemos 
			mostrar por pantalla el valor del usuario */

	if (isset($_REQUEST['insertar']))
		print ("value='$usuario'></p>");

	// De lo contrario, mostramos el campo "usuario" en blanco 

	else	
		print ("></p>");

	/* Si en la variable "$errores" en la posición "usuario" existe un valor diferente a "blanco",
		Entonces mostramos por pantalla el mensaje de "error de usuario" */ 

	if ($errores["usuario"] != "")
		print "<p>Error: {$errores['usuario']}</p>";
?>										
					
				<p class="etiqueta">Clave:*</p>				
				<p class="campo"><input type="password" name="clave" id="miclave" size="10" maxlenght="10" required

<?php

	/* Si en la variable "$errores" en la posición "clave" existe un valor diferente a "blanco",
		Entonces mostramos por pantalla el mensaje de "error de usuario" */ 
		
	if (isset($_REQUEST['insertar']))
		print ("value='$clave'></p>");

	// De lo contrario, mostramos el campo "clave" en blanco 

	else 
		print ("></p>");
	
	/* Si en la variable "$errores" en la posición "clave" existe un valor diferente a "blanco",
		Entonces mostramos por pantalla el mensaje de "error de usuario" */ 
	
	if ($errores["clave"] != "")
		print "<p>Error {$errores['clave']}</p>";
?>					
								
				<p class="etiqueta">Correo:*</p>
				<p class="campo"><input type="email" name="correo" id="micorreo" required
<?php
				
	/* Si en la variable "$errores" en la posición "correo" existe un valor diferente a "blanco",
		Entonces mostramos por pantalla el mensaje de "error de usuario" */ 
		
	if (isset($_REQUEST['insertar']))
		print ("value='$correo'></p>");

	// De lo contrario, mostramos el campo "correo" en blanco 

	else
		print ("></p>");

	/* Si en la variable "$errores" en la posición "clave" existe un valor diferente a "blanco",
		Entonces mostramos por pantalla el mensaje de "error de usuario" */ 

	if ($errores["correo"] != "")
		print "<p>Error {$errores['correo']}</p>";
				
?>				
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
				<p class="campo"><input type="text" name="nombres" id="misnombres" size="20" maxlenght="100"></p>
											
				<p class="etiqueta">Apellido(s):</p>
				<p class="campo"><input type="text" name="apellidos" id="misapellidos" size="20" maxlenght="100"></p>

				<p class="etiqueta">Dirección:</p>
				<p class="campo"><input type="input" name="direccion" id="midireccion"></p>

				<p class="etiqueta">Teléfono:</p>
				<p class="campo"><input type="tel" name="telefono" id="mitelefono"></p>

				<p class="campo"><input type="submit" name="insertar" value="Registrarse"></p>
			</form>
				<p class="campo">Nota: Los datos marcados con (*) deben ser rellenados obligatoriamente.</p>
				<p class="campo"><a href="index.html">Volver al inicio</a></p>		
		</section>

<!-- Volvemos a abrir la etiqueta de PHP para colocar la llave
	del último "else" -->
<?php	
			}
// Cerramos la etiqueta de PHP para volver a HTML

?>

		</body>
	</html>					
