<?php 
   	session_start();
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

			include "validarusuario.php";
			include "validarclave.php";
		}

	/* Si la variable "acceder" existe y tiene algún valor y además el valor de la variable "error" es "false", 
			quiere decir que no hay error en los datos introducidos por el usuario, 
			entonces procedemos a...  */

	if (isset($_REQUEST['acceder']) && !($error))
		{

		include "conexionbasedatos.php";

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
				$_SESSION */

   			$_SESSION['registro_seleccionado'] = mysqli_fetch_assoc($result);

			include "modificar_usuario.php";

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

		/* De lo contrario, si la variable "acceder" no existe o no tiene ningún valor
			y además la variable "$error" tiene el valor "true", quiere decir que el usuario aún 
			no ha indroducido datos o le faltó introducir uno o más datos de los que son obligatorios,
			entonces a volver a mostrar los datos al usuario... */

		}
	else
		{

/* Cerramos la etiqueta de PHP, porque lo que viene a continuación está
	en HTML */
?>			
			<h1>Modificar la cuenta de usuario:</h1>
			<form action="acceder_usuario.php" name="acceder" method="post">

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
