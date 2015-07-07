<?php 
   	session_start(); 
	header ('Content-type: text/html; charset=utf-8');  
	$fotos_slider = 0;
	if (isset($_SESSION['fotos_slider']))
		$fotos_slider = $_SESSION['fotos_slider'];
	include "conexionbasedatos.php";
	$sql = "SELECT * FROM fotos ORDER BY id_foto ASC";
	$result = mysqli_query($conn, $sql) or die ("Fallo al acceder a la tabla fotos");
	if (mysqli_num_rows($result) > 0) 
	{
		include "cabecera.php";
		print ("<body>\n");
		print ("<form action='seleccionar_fotos_slider.php' method='post'>\n");		
		print ("<h3>Notificación de fotos selecionadas para el slider</h3>\n"); 
		print ("<p>Cantidad de fotos seleccionadas para el slider: " . $fotos_slider . "</p>\n");
		print ("<p>Si desea seleccionar otras fotos para el slider marque la casilla correspondiente, de lo contrario pulsar el botón volver al inicio</p>\n");
		print ("<br>\n");
        for ($i=0; $i<mysqli_num_rows($result); $i++)
		{	
			$row = mysqli_fetch_assoc($result);
			print ("<figure>\n");
			print ("<img src='fotos/" . $row['foto'] . "'>\n");		
			print ("<p>Imprimir&nbsp;<input type='checkbox' name='slider[]' value='" . $row['id_foto'] . "'");
			if ($row['eliminada'])
				print ("checked>");
			else
				print (">");
		}			
		print ("<br>\n");
		print ("<br>\n");
		print ("<input type='submit' NAME='seleccionar' VALUE='Imprimir y/o eliminar las fotos seleccionadas'>\n");
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
	print ("<br>\n");
	print ("</section>\n");
	print ("</body>\n");
	print ("</html>\n");
?>