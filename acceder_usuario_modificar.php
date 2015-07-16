<?php 
   	session_start(); 
	header ('Content-type: text/html; charset=utf-8'); 
	$usuario = "";
	$clave = "";
	$error = false;
	$errores = array ("usuario"=>"", "clave"=>"", "correo"=>"");
	if (isset($_REQUEST['acceder']))
	{
		$acceder = $_REQUEST['acceder'];	
		$usuario = $_REQUEST['usuario'];
		$clave = $_REQUEST['clave'];
		include "validarusuario.php";
		include "validarclave.php";
	}
	if (isset($_REQUEST['acceder']) && !($error))
	{
		include "conexionbasedatos.php";
		$sql = "SELECT * FROM usuario WHERE usuario = '$usuario' and clave = '$clave'";
  		$result = mysqli_query($conn, $sql) or die ("Fallo al acceder a la cuenta del usuario");
		if (mysqli_num_rows($result) > 0) 
		{
   			$_SESSION['id_usuario'] = $usuario;
			header ('Location: mostrar_eventos_modificar.php');		}
		else
		{
			echo "Usuario o clave inválida";
			print ("<p><a href='acceder_usuario_fotos.php'>Volver al formulario</a></p>\n"); 
		}			
		mysqli_free_result($result);	
		mysqli_close($conn);

	}
	else
	{
		include "cabecera.php";
		print ("<body>\n");
		print ("<section class='formulario'>\n");
		print("<h1>Modificar eventos del usuario:</h1>\n");
		print("<form action='acceder_usuario_modificar.php' name='acceder' method='post'>\n");
		print("<p class='etiqueta'>Usuario:*</p>\n");
		print("<p class='campo'><input type='text' name='usuario' size='10' maxlenght='10'"); 
		if (isset($_REQUEST['acceder']))
			print ("value='$usuario'></p>");
		else	
			print ("></p>");
		if ($errores['usuario'] != "")
			print "<p>Error: {$errores['usuario']}</p>";			
		print("<p class='etiqueta'>Clave:*</p>");				
		print("<p class='campo'><input type='password' name='clave' id='miclave' size='10' maxlenght='10'\n"); 
		if (isset($_REQUEST['acceder']))
			print ("value='$clave'></p>");
		else 
			print ("></p>");	
		if ($errores["clave"] != "")
			print ("<p>Error {$errores['clave']}</p>\n");										
		print ("<p class='campo'><input type='submit' name='acceder' value='Acceder'></p>\n");
		print ("</form>");
		print ("<p class='campo'>Nota: Los datos marcados con (*) deben ser rellenados obligatoriamente.</p>\n");
		print ("<p class='campo'><a href='index.php'>Volver al inicio</a></p>\n");		
		print ("</section>\n");
		print ("</body>\n");
		print ("</html>\n");					
		}
	?>
