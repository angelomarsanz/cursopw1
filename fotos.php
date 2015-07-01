<?php 
   	session_start(); 
	header ('Content-type: text/html; charset=utf-8');  
	$usuario = "";
	$id_evento = 0;	
	$nombre_evento = ""; 
	if (isset($_SESSION['id_usuario']))
	{	
		$usuario = $_SESSION['id_usuario'];		
		if (isset($_GET['IdEvento']))
		{	
			$id_evento = $_GET['IdEvento'];				
			$_SESSION['id_evento'] = $id_evento;
		}
		if (isset($_GET['NombreEvento']))
		{
			$nombre_evento = $_GET['NombreEvento'];		
			$_SESSION['nombre_evento'] = $nombre_evento;
		}
		include "conexionbasedatos.php";
		$sql = "SELECT * FROM fotos WHERE id_evento = '$id_evento' ORDER BY id_foto ASC";
		$result = mysqli_query($conn, $sql) or die ("Fallo al acceder a la tabla fotos");
		if (mysqli_num_rows($result) > 0) 
		{
			include "cabecera.php";
			print ("<body>\n");
			print ("<section class='formulario'>\n");				
			print ("<form action='procesar_fotos.php' method='post'>\n");		
			print ("<h3>Fotos del evento: $nombre_evento</h3>\n");
			print ("<h4>Seleccione las fotos a imprimir y/o eliminar</h4>\n");
			print ("<br>\n");
                for ($i=0; $i<mysqli_num_rows($result); $i++)
				{	
					$row = mysqli_fetch_assoc($result);
					print ("<figure>\n");
					print ("<img src='fotos/" . $row['foto'] . "'>\n");		
					print ("<p>Imprimir&nbsp;<input type='checkbox' name='imprimir[]' value='" . $row['id_foto'] . "'");
					if ($row['impresion'])
						print ("checked>");
					else
						print (">");
					print ("&nbsp;&nbsp;Eliminar&nbsp;<input type='checkbox' name='borrar[]' value='" . $row['id_foto'] . "'></p>\n");
					print ("</figure>\n");						
				}
			print ("<br>\n");	
			print ("<input type='submit' NAME='procesar' VALUE='Imprimir y/o eliminar las fotos seleccionadas'>\n");
			print ("</form>\n");			
		}
		else
		{
			echo "Error al acceder la tabla fotos";
		}				
		mysqli_free_result($result);		
		mysqli_close($conn);
		print ("<br>\n");
		print ("<p>[ <a href='index.php'>Volver al inicio</a> ]</p>\n");
		print ("</section>\n");
		print ("</body>\n");
		print ("</html>\n");
	}
?>