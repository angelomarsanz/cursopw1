<?php 
	session_start();
	header ('Content-type: text/html; charset=utf-8'); 
	include "cabecera.php";
	$valor = $_GET['IdUsuario'];
	print ("<body>");
	print ("<section class='formulario'>");
	$error = false;
	$errores = array ("tipo_evento"=>"", "nombre_evento"=>"");

	if (isset($_REQUEST['insertar']))
		{
		$insertar = $_REQUEST['insertar'];	
		$usuario = $_REQUEST['usuario'];
		$tipo_evento = $_REQUEST['tipoevento'];
		$nombre_evento = $_REQUEST['nombreevento'];
		$lugar_evento = $_REQUEST['lugarevento'];
		$fecha_evento = $_REQUEST['fechaevento'];
		$hora_evento = $_REQUEST['horaevento'];

		include "validartipoevento.php";
		include "validarnombreevento.php";
		}

	if (isset($_REQUEST['insertar']) && !($error))
		{									

			include "conexionbasedatos.php";
 			
			$sql = "INSERT INTO eventos (usuario, tipo_evento, nombre_evento, lugar_evento, fecha_evento, hora_evento) values ('$usuario', '$tipo_evento', '$nombre_evento', '$lugar_evento', '$fecha_evento', '$hora_evento')";
			
			if (mysqli_query($conn, $sql))
				{
					echo "Evento creado satisfactoriamente";	
					print ("<p><a href='index.php'>Volver a inicio</a></p>\n"); 

				}
	
			else	
				{
					echo "Error: " . "<p>" . mysqli_error($conn) . "</p>";			
					print ("<p><a href='agregar_evento.php'>Volver al formulario</a></p>\n"); 
				}

			mysqli_close($conn);
		}

	else
		{

			<h1>Registrarse:</h1>
			<form action="insertar_usuario2.php" name="insertar" method="post">

			<p class="etiqueta">Usuario:*</p>
				<p class="campo"><input type="text" name="usuario" size="10" maxlenght="10" 

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
				<p class="campo"><input type="password" name="clave" id="miclave" size="10" maxlenght="10" 

<?php

	/* Si la variable "insertar" existe y tiene algún valor, procedemos 
			mostrar por pantalla el valor del usuario */
		
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
				<p class="campo"><input type="email" name="correo" id="micorreo" 
<?php
				
	/* Si la variable "insertar" existe y tiene algún valor, procedemos 
			mostrar por pantalla el valor del usuario */
		
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
				<p class="campo"><a href="index.php">Volver al inicio</a></p>		
		</section>

<!-- Volvemos a abrir la etiqueta de PHP para colocar la llave
	del último "else" -->
<?php	
			}
// Cerramos la etiqueta de PHP para volver a HTML

?>

		</body>
	</html>					



