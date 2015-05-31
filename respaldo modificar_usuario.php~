<?php

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

	/* Preparamos la variable "$sql" con las instrucciones necesarias
		y los datos introducidos por el usuario
		para acceder a la cuenta del usuario
		en la base de datos "clientes" */
				
	$sql = "SELECT * FROM usuario WHERE usuario = '$usuario' and clave = '$clave'";

	/* Intentamos acceder a la cuenta del usuario,
		si se logra, se sigue el curso normal del programa,
		pero si hay algún error abortamos el programa
		y enviamos un mensaje por pantalla */

  	$result = mysqli_query($conn, $sql) or die ("Fallo al acceder a la cuenta del usuario");

	/* mysqli_num_rows es una función de Php que devuelve el número
		de registros encontrados en la tabla y si es mayor a "cero"
		quiere decir que si existe uno o más registros que coinciden
		con el "usuario" y la "clave" */
	
	if (mysqli_num_rows($result) > 0) 
		{
		/* mysqli_fetch_asoc es una función que devuelve
			un arreglo o array que contiene el registro encontrado
			en la tabla. Ese arreglo lo guardamos en la variable
			$row */

		$row = mysqli_fetch_assoc($result);
		print ("<h1>Modificar datos:</h1>");
		print ("<p class='campo'>Usuario: " . $row['usuario'] . "</p>");
?>
			<form action="modificar_usuario.php" name="modificar" method="post">
					
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

				<p class="campo"><input type="submit" name="insertar" value="Registrarse"></p>
			</form>
				<p class="campo">Nota: Los datos marcados con (*) deben ser rellenados obligatoriamente.</p>
				<p class="campo"><a href="index.php">Volver al inicio</a></p>		

<?php

		}
	else
		{
		echo "Usuario o clave inválida";
		print ("<p><a href='acceder_usuario.php'>Volver al formulario</a></p>\n"); 
		}
 			
	/* Liberamos el resul set para reusarlo más adelante */
   			
	mysqli_free_result($result);
			
	/* Cerramos la conexión a la base de datos */

	mysqli_close($conn);

?>			
