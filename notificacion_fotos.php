<?php 
   	session_start(); 
	header ('Content-type: text/html; charset=utf-8');  
	include "cabecera.php";
    print ("<body>\n");
	$usuario = "";
	$id_evento = 0;	
	$nombre_evento = ""; 
	$fotos_impresion = 0;
	$fotos_borrar = 0;
	if (isset($_SESSION['id_usuario']))
	{	
		$usuario = $_SESSION['id_usuario'];		
		if (isset($_SESSION['id_evento']))
			$id_evento = $_SESSION['id_evento'];
		if (isset($_SESSION['nombre_evento']))
			$nombre_evento = $_SESSION['nombre_evento'];
		if (isset($_SESSION['fotos_impresion']))
			$fotos_impresion = $_SESSION['fotos_impresion'];
		if (isset($_SESSION['fotos_borrar']))
			$fotos_borrar = $_SESSION['fotos_borrar'];		
		include "conexionbasedatos.php";
		$sql = "SELECT * FROM fotos WHERE id_evento = '$id_evento' ORDER BY id_foto ASC";
		$result = mysqli_query($conn, $sql) or die ("Fallo al acceder a la tabla fotos");
		if (mysqli_num_rows($result) > 0) 
		{
			print ("<form action='procesar_fotos.php' method='post'>\n");		
			print ("<h3>Notificación de fotos selecionadas para impresión y/o eliminación</h3>\n"); 
			print ("<h4>Evento: $nombre_evento</h4>\n");
			print ("<p>Cantidad de fotos seleccionadas para imprimir: " . $fotos_impresion . "</p>\n");
			print ("<p>Cantidad de fotos eliminadas: " . $fotos_borrar . "</p>\n");
			print ("<p>Si desea seleccionar otras fotos para impresión y/o eliminación marque la casilla correspondiente, de lo contrario pulsar el botón volver al inicio</p>\n");
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
	}
	else
		{
		echo "Error al acceder la tabla fotos";
		print ("<p><a href='index.php'>Volver al inicio</a></p>\n"); 
		}

	print ("<br>\n");
	print ("<p>[ <a href='index.php'>Volver al inicio</a> ]</p>\n");	
				
	mysqli_free_result($result);
		
	mysqli_close($conn);

	print ("</section>\n");
	print ("</body>\n");
	print ("</html>\n");
?>