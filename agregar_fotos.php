<?php 
	session_start();
	header ('Content-type: text/html; charset=utf-8'); 
	include "cabecera.php";
	print ("<body>\n");
	print ("<section class='formulario'>\n");

   	if (isset($_GET['IdEvento']))
	  	{
		$id_evento = $_GET['IdEvento'];
		}

	if (isset($_GET['NombreEvento']))
		{
			$nombre_evento = $_GET['NombreEvento'];
		}
		
	if (isset($_REQUEST['insertar']))
		{
		$id_evento = $_REQUEST['idevento'];
		include "conexionbasedatos.php";
		$uploads_dir = "fotos";
		foreach ($_FILES["imagen"]["error"] as $key => $error) 
			{
   			if ($error == UPLOAD_ERR_OK) 
				{
        		$tmp_name = $_FILES["imagen"]["tmp_name"][$key];
        		$name = $_FILES["imagen"]["name"][$key];
				$sql = "INSERT INTO fotos (id_evento, foto) values ('$id_evento', '$name')";
				$result = mysqli_query($conn, $sql) or die ("Fallo al insertar fotos en la base de datos");
        		move_uploaded_file($tmp_name, "$uploads_dir/$name");					
        		}
			}
		echo "Fotos subidas al servidor satisfactoriamente";
		print ("<p><a href='index.php'>Volver a inicio</a></p>\n");				
		mysqli_close($conn);
		}
	else
		{
		print ("<h1>Agregar fotos del evento:</h1>\n");
	    print ("<form action='agregar_fotos.php' name='fotos' method='post' enctype='multipart/form-data'>\n");

		print ("<p class='etiqueta'>Código del evento:</p>\n");
		print ("<p class='campo'><input type='text' name='idevento' size='10' maxlenght='10' value='$id_evento' readonly></p>\n");

		print ("<p class='etiqueta'>Nombre del evento:</p>\n");
		print ("<p class='campo'><input type='text' name='nombreevento' size='10' maxlenght='10' value='$nombre_evento' readonly></p>\n");
		
		print ("<input type='hidden' name='max_file_size' value='10000000'>");
        print ("<p class='campo'><input type='file' multiple=true name='imagen[]'></p>");

		print ("<p class='campo'><input type='submit' name='insertar' value='Agregar fotos'></p>\n");
		print ("</form>\n");

		print ("<p class='campo'><a href='mostrar_usuario.php'>Regresar</a></p>\n");		
		print ("</section>\n");

		}

	print ("</body>\n");
	print ("</html>\n");					
?>