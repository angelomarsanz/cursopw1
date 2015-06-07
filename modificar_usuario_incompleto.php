<?php

   	if (isset($_SESSION['registro_seleccionado']))
		{
		$row = $_SESSION['registro_seleccionado'];
		$usuario = $row['usuario'];
		$clave = $row['clave'];
		$correo = $row['correo'];
		$tipo_cliente = $row['tipo_cliente'];
		$cedula_rif = $row['cedula_rif'];
		$nombres = $row['nombres'];
		$apellidos = $row['apellidos'];
		}

	if (isset($_REQUEST['modificar']))
		{
	        header ('Content-type: text/html; charset=utf-8'); 
		$modificar = $_REQUEST['modificar'];	
		$usuario = $_REQUEST['usuario'];
		$clave = $_REQUEST['clave'];
		$correo = $_REQUEST['correo'];
		$tipo_cliente = $_REQUEST['tipocliente'];
		$cedula_rif = $_REQUEST['cedularif'];
		$nombres = $_REQUEST['nombres'];
		$apellidos = $_REQUEST['apellidos'];

		$error = false;
		$errores = array ("usuario"=>"", "clave"=>"", "correo"=>"");

		include "validarclave.php";
		}

	if (isset($_REQUEST['modificar']) && !($error))
		{									
		include "conexionbasedatos.php";

		$sql = "update usuario set clave='$clave', correo='$correo', tipo_cliente='$tipo_cliente', cedula_rif='$cedula_rif', nombres='$nombres', apellidos='$apellidos' where usuario='$usuario'";
		
		if (mysqli_query($conn, $sql))
			{
			echo "Usuario modificado satisfactoriamente";	
			print ("<p><a href='index.php'>Volver a inicio</a></p>\n"); 
			}
	
		else	
			{
			echo "Error: " . "<p>" . mysqli_error($conn) . "</p>";			
			print ("<p><a href='acceder_usuario.php'>Volver al formulario</a></p>\n"); 
			}

		mysqli_close($conn);

		}
	else
		{
?>	

<form action="modificar_usuario_incompleto.php" name="modificar" method="post">

	<h1>Modificar datos:</h1>

	<p class="etiqueta">Usuario:*</p>
	<p class="campo"><input type="text" value="<?php echo $usuario; ?>" name="usuario" size="10" maxlenght="10" readonly></p> 
			
	<p class="etiqueta">Clave:*</p>				
	<p class="campo"><input type="password" value="<?php echo $clave; ?>" name="clave" id="miclave" size="10" maxlenght="10"></p> 

<?php
	
	if ($errores["clave"] != "")
		print "<p>Error {$errores['clave']}</p>";
?>					
							
	<p class="etiqueta">Correo:*</p>
	<p class="campo"><input type="email" value="<?php echo $correo; ?>" name="correo" id="micorreo"></p>

<?php			

	if ($errores["correo"] != "")
		print "<p>Error {$errores['correo']}</p>";
				
?>				
	<p class="etiqueta">Cédula, RIF o pasaporte:
	<p class="campo">
		<select name="tipocliente">
			<option value="<?php echo $tipo_cliente; ?>" select><?php echo $tipo_cliente; ?>
			<option value="">&nbsp
			<option value="V">V
			<option value="E">E
			<option value="P">P
		</select>
		<input type="text" value="<?php echo $cedula_rif; ?>" name="cedularif" id="micedularif" size="12" maxlenght="12"></p>
					
	<p class="etiqueta">Nombre(s):</p>
	<p class="campo"><input type="text" value="<?php echo $nombres; ?>" name="nombres" id="misnombres" size="20" maxlenght="100"></p>
											
	<p class="etiqueta">Apellido(s):</p>
	<p class="campo"><input type="text" value="<?php echo $apellidos; ?>" name="apellidos" id="misapellidos" size="20" maxlenght="100"></p>

	<p class="campo"><input type="submit" name="modificar" value="Modificar"></p>

</form>
	<p class="campo">Nota: Los datos marcados con (*) deben ser rellenados obligatoriamente.</p>
	<p class="campo"><a href="index.php">Volver al inicio</a></p>

<?php	
		}
?>		
