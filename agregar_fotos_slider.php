<?php 
	session_start();
	header ('Content-type: text/html; charset=utf-8'); 
	include "cabecera.php";
	print ("<body>\n");
	print ("<section class='formulario'>\n");
	if (isset($_REQUEST['insertar']))
	{
		$comentario_foto = $_REQUEST['comentariofoto'];
		include "conexionbasedatos.php";
		$uploads_dir = "slider";
		if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK)		
		{
       		$tmp_name = $_FILES["imagen"]["tmp_name"];
       		$name = $_FILES["imagen"]["name"];
       		echo nl2br("$comentario_foto\n");
       		echo nl2br("$uploads_dir\n");      		 
       		echo nl2br("$tmp_name\n");
       		echo nl2br("$name\n");
       		$sql = "INSERT INTO slider (foto_slider, comentario_foto) values ('$name', '$comentario_foto')";
       		$result = mysqli_query($conn, $sql) or die ("Fallo al insertar fotos en la tabla slider");
        	move_uploaded_file($tmp_name, "$uploads_dir/$name");					
 		}
		echo "Fotos subidas al servidor satisfactoriamente";
		print ("<p><a href='index.php'>Volver a inicio</a></p>\n");				
		mysqli_close($conn);
	}
	else
		{
		print ("<h1>Agregar fotos para el slider:</h1>\n");
	    print ("<form action='agregar_fotos_slider.php' name='fotos' method='post' enctype='multipart/form-data'>\n");
		
		print ("<input type='hidden' name='max_file_size' value='10000000'>");
        print ("<p class='campo'><input type='file' name='imagen'></p>");

        print ("<p class='etiqueta'>Comentario de la foto:</p>\n");
        print ("<p class='campo'><input type='text' name='comentariofoto' size='10' maxlenght='10'></p>\n");
        
        print ("<p class='campo'><input type='submit' name='insertar' value='Agregar fotos'></p>\n");
		print ("</form>\n");

		print ("<p class='campo'><a href='index.php'>Volver al inicio</a></p>\n");		
		print ("</section>\n");

		}

	print ("</body>\n");
	print ("</html>\n");					
?>