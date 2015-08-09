<?php 
   	session_start(); 
	header ('Content-type: text/html; charset=utf-8');  
	include "conexionbasedatos.php";
	$sql = "SELECT * FROM slider ORDER BY id_foto_slider ASC";
	$result = mysqli_query($conn, $sql) or die ("Error al acceder tabla slider");
	if (mysqli_num_rows($result) > 0) 
	{
		include "cabecera.php";
		print ("<body>\n");
		print ("<section class='formulario'>\n");				
		print ("<form action='procesar_fotos_slider.php' method='post'>\n");		
		print ("<h3>Fotos Para el Slider</h3>\n");
		print ("<h4>Seleccione las fotos que desea eliminar del slider</h4>\n");
		print ("<br>\n");
        for ($i=0; $i<mysqli_num_rows($result); $i++)
		{	
			$row = mysqli_fetch_assoc($result);
			print ("<figure>\n");
			print ("<img src='slider/" . $row['foto_slider'] . "'>\n");		
			print ("&nbsp;&nbsp;Eliminar&nbsp;<input type='checkbox' name='borrar[]' value='" . $row['id_foto_slider'] . "'></p>\n");
			print ("</figure>\n");						
		}
		print ("<br>\n");	
		print ("<input type='submit' NAME='procesar' VALUE='Eliminar las fotos seleccionadas'>\n");
		print ("</form>\n");			
	}
	else
	{
		echo "No hay fotos para el slider";
	}				
	mysqli_free_result($result);		
	mysqli_close($conn);
	print ("<br>\n");
	print ("<p>[ <a href='index.php'>Volver al inicio</a> ]</p>\n");
	print ("</section>\n");
	print ("</body>\n");
	print ("</html>\n");
?>