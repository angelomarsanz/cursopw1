<?php

	$row = $_SESSION['registro_selecionado'];

	if (isset($_REQUEST['modificar']))
		{
		// Transferimos los datos de las variables de HTML a las variables de PHP

		$modificar = $_REQUEST['modificar'];	
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

		include "validarclave.php";
		include "validarcorreo.php";

		}

	/* Si la variable "modificar" existe y tiene algún valor y además el valor de la variable "error" es "false", 
			quiere decir que no hay error en los datos introducidos por el usuario, 
			entonces procedemos a... */

	if (isset($_REQUEST['modificar']) && !($error))
		{									

		include "conexionbasedatos.php";

		/* Preparamos la variable "$sql" con las instrucciones necesarias y los datos modificados por el usuario,
			para después actualizarlos en la tabla "usuario" de la base de datos "cliente" */
 			
		$sql = "UPDATE usuario SET clave=$clave, correo=$correo, tipo_cliente=$tipo_cliente, cedula_rif=$cedula_rif, nombres=$nombres, apellidos=$apellidos, direccion=$direccion, telefono=$telefono";

		/* Si se actualizaron correctamente los datos en la tabla "usuario" de la base de datos
			"clientes", entonces procedemos a... */
			
		if (mysqli_query($conn, $sql))
			{
			echo "Usuario modificado satisfactoriamente";	
			print ("<p><a href='index.php'>Volver a inicio</a></p>\n"); 
			}

		// De lo contrario, si no se pudieron insertar los datos, entonces procedemos a...
	
		else	
			{
			echo "Error: " . "<p>" . mysqli_error($conn) . "</p>";			
			print ("<p><a href='modificar_usuario.php'>Volver al formulario</a></p>\n"); 
			}
		
		// Cerramos la conexión a la base de datos

		mysqli_close($conn);

		}

	/* De lo contrario, si la variable "modificar" no existe o no tiene ningún valor
		y además la variable "$error" tiene el valor "true", quiere decir que el usuario aún 
		no ha modificado datos o le faltó modificar uno o más datos de los que son obligatorios,
		entonces a volver a mostrar los datos al usuario... */

	else
		{

/* Cerramos la etiqueta de PHP, porque lo que viene a continuación está
	en HTML */

?>	

<form action="modificar_usuario.php" name="modificar" method="post">

	<h1>Modificar datos:</h1>

	<p class="etiqueta">Usuario:*</p>
	<p class="campo"><input type="text" value="<?php echo $row['usuario']; ?>" name="usuario" size="10" maxlenght="10" readonly></p> 
			
	<p class="etiqueta">Clave:*</p>				
	<p class="campo"><input type="password" value="<?php echo $row['clave']; ?>" name="clave" id="miclave" size="10" maxlenght="10" 

<?php

	/* Si la variable "modificar" existe y tiene algún valor, procedemos 
		mostrar por pantalla el valor del usuario */
	
	if (isset($_REQUEST['modificar']))
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
	<p class="campo"><input type="email" value="<?php echo $row['correo']; ?>" name="correo" id="micorreo"

<?php
				
	/* Si la variable "insertar" existe y tiene algún valor, procedemos 
		mostrar por pantalla el valor del usuario */

	if (isset($_REQUEST['modificar']))
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
			<option value="<?php echo $row['tipo_cliente']; ?>" select><?php echo $row['tipo_cliente']; ?>
			<option value="">&nbsp
			<option value="V">V
			<option value="E">E
			<option value="P">P
			<option value="J">J
			<option value="G">G
		</select>
		<input type="text" value="<?php echo $row['cedula_rif']; ?>" name="cedularif" id="micedularif" size="12" maxlenght="12"></p>
					
	<p class="etiqueta">Nombre(s):</p>
	<p class="campo"><input type="text" value="<?php echo $row['nombres']; ?>" name="nombres" id="misnombres" size="20" maxlenght="100"></p>
											
	<p class="etiqueta">Apellido(s):</p>
	<p class="campo"><input type="text" value="<?php echo $row['apellidos']; ?>" name="apellidos" id="misapellidos" size="20" maxlenght="100"></p>

	<p class="etiqueta">Dirección:</p>
	<p class="campo"><input type="input" value="<?php echo $row['direccion']; ?>" name="direccion" id="midireccion"></p>

	<p class="etiqueta">Teléfono:</p>
	<p class="campo"><input type="tel" value="<?php echo $row['telefono']; ?>" name="telefono" id="mitelefono"></p>

	<p class="campo"><input type="submit" name="modificar" value="Modificar"></p>

</form>
	<p class="campo">Nota: Los datos marcados con (*) deben ser rellenados obligatoriamente.</p>
	<p class="campo"><a href="index.php">Volver al inicio</a></p>

<!-- Volvemos a abrir la etiqueta de PHP para colocar la llave
	del último "else" -->
<?php	
			}

// Cerramos la etiqueta de PHP para volver a HTML

?>		

