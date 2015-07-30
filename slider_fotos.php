<?php 
   	session_start(); 
	header ('Content-type: text/html; charset=utf-8');  
	$id_foto = 0;
	include "conexionbasedatos.php";
	$sql = "SELECT * FROM fotos ORDER BY id_foto ASC";
	$result = mysqli_query($conn, $sql) or die ("Fallo al acceder a la tabla fotos");
	if (mysqli_num_rows($result) > 0) 
	{
		include "cabecera.php";
		print ("<body>\n");
		print ("<section class='formulario'>\n");				
		print ("<form action='seleccionar_fotos_slider.php' method='post'>\n");		
		print ("<h3>Selección de fotos para el slider</h3>\n");
		print ("<br>\n");
        for ($i=0; $i<mysqli_num_rows($result); $i++)
		{	
			$row = mysqli_fetch_assoc($result);
			print ("<figure>\n");
			print ("<img src='fotos/" . $row['foto'] . "'>\n");
			print ("</figure>\n");
			print ("<p>Slider&nbsp;<input type='checkbox' name='slider[]' value='" . $row['id_foto'] . "'");
			if ($row['slider'])
				print ("checked>");
			else
				print (">");
		}
		print ("<br>\n");	
		print ("<br>\n");			
		print ("<input type='submit' NAME='seleccionar' VALUE='Seleccionar fotos para el slider'>\n");
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
?>