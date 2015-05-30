<?php 
header ('Content-type: text/html; charset=utf-8'); 
include "cabecera.php";
?>
		<body>
			<section class="formulario">

<!-- Abrimos la etiqueta de PHP para codificar en PHP -->

<?php
	// Asignamos un valor inicial a las variables de control de errores

	$error = false;
	$errores = array ("usuario"=>"", "clave"=>"", "correo"=>"");

	/* Si la variable "acceder" existe y tiene algun valor, 
		quiere decir que el usuario introdujo datos en el formulario,
		entonces procedemos a... */

	if (isset($_REQUEST['acceder']))
		{
			// Transferimos los datos de las variables de HTML a las variables de PHP

			$acceder = $_REQUEST['acceder'];	
			$usuario = $_REQUEST['usuario'];
			$clave = $_REQUEST['clave'];

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
		}

	/* Si la variable "acceder" existe y tiene algún valor y además el valor de la variable "error" es "false", 
			quiere decir que no hay error en los datos introducidos por el usuario, 
			entonces procedemos a... */

	if (isset($_REQUEST['acceder']) && !($error))
		{									

			/* Crear las variables necesarias para conectar con la base de datos y
				asignarle los valores correspondientes */

			$servername = "sartyprogapp01.db.8347959.hostedresource.com";
			$username = "sartyprogapp01";
			$password = "iemE6@2F28Q63454";
			$dbname = "sartyprogapp01";

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
				para acceder a la cuenta del usuario en la base de datos "clientes" */
				
			$sql = "SELECT * FROM usuario WHERE usuario = '$usuario' and clave = '$clave'";

			/* Si se pudo acceder a la cuenta del usuario, 
				entonces procedemos a... */

            		$result = mysqli_query($conn, $sql) or die ("Fallo al acceder a la cuenta del usuario");	
	
			if (mysqli_num_rows($result) > 0) 
				{
					$row = mysqli_fetch_assoc($result);			
					echo "Usuario: " . $row["usuario"]. " - Clave : " . $row["clave"]. " - Correo: " . $row["correo"];												
				}
			else
				echo "No existe la cuenta del usuario";
    			
			/* cerrar el resulset */
   			
			mysqli_free_result($result);

			
			/* Cerrar la conexión a la base de datos */

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
			<form action="modificar_usuario.php" name="acceder" method="post">

			<p class="etiqueta">Usuario:*</p>
				<p class="campo"><input type="text" name="usuario" size="10" maxlenght="10" 

<?php
	/* Si la variable "acceder" existe y tiene algún valor, procedemos 
			mostrar por pantalla el valor del usuario */

	if (isset($_REQUEST['acceder']))
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

	/* Si la variable "acceder" existe y tiene algún valor, procedemos 
			mostrar por pantalla el valor del usuario */
		
	if (isset($_REQUEST['acceder']))
		print ("value='$clave'></p>");

	// De lo contrario, mostramos el campo "clave" en blanco 

	else 
		print ("></p>");
	
	/* Si en la variable "$errores" en la posición "clave" existe un valor diferente a "blanco",
		Entonces mostramos por pantalla el mensaje de "error de usuario" */ 
	
	if ($errores["clave"] != "")
		print "<p>Error {$errores['clave']}</p>";
?>										
				<p class="campo"><input type="submit" name="acceder" value="Acceder"></p>
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
