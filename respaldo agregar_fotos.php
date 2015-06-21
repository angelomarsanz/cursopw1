<?php 
	session_start();
	header ('Content-type: text/html; charset=utf-8'); 
	include "cabecera.php";
	print ("<body>\n");
	print ("<section class='formulario'>\n");

   	if (isset($_GET['IdEvento']))
	  	{
		$id_evento = $_GET['IdEvento'];
		echo "Pase por IdEvento: " . $id_evento;

		}
		
	$error = false;
	$errores = array ("imagen"=>"");

	if (isset($_REQUEST['insertar']))
		{
		$insertar = $_REQUEST['insertar'];	
       		$copiar_fichero = false;
      		if (is_uploaded_file ($_FILES['imagen']['tmp_name']))
      			{
			$id_evento = $_REQUEST['idevento'];
         		$nombre_directorio = "fotos/";
        		$nombre_fichero = $_FILES['imagen']['name'];
         		$copiar_fichero = true;

         		$nombre_completo = $nombre_directorio . $nombre_fichero;
			echo "Ruta archivo" . $nombre_completo;
         		if (is_file($nombre_completo))
         			{
            			$id_Unico = time();
            			$nombre_fichero = $id_unico . "-" . $nombre_fichero;
         			}
      			}
      		else if ($_FILES['imagen']['error'] == UPLOAD_ERR_FORM_SIZE)
      			{
      	 		$maxsize = $_REQUEST['MAX_FILE_SIZE'];
         		$errores["imagen"] = "¡El tamaño del fichero supera el límite permitido ($maxsize bytes)!";
         		$error = true;
      			}
      		else if ($_FILES['imagen']['name'] == "")
         		$nombreFichero = '';
      		else
      			{
         		$errores["imagen"] = "¡No se ha podido subir el fichero!";
         		$error = true;
      			}
   		}

	if (isset($_REQUEST['insertar']) && !($error))
		{									
		include "conexionbasedatos.php";
 			
		$sql = "INSERT INTO fotos (id_evento, foto) values ('$id_evento', '$nombre_fichero')";
			
		if (mysqli_query($conn, $sql))
			{
			echo "Fotos subidas al servidor satisfactoriamente";	
			print ("<p><a href='index.php'>Volver a inicio</a></p>\n"); 
      			if ($copiar_fichero)
				{
        			move_uploaded_file($_FILES["imagen"]["tmp_name"], $nombre_directorio . $nombre_fichero);
    				}
			}
		else	
			{
			echo "Error: " . "<p>" . mysqli_error($conn) . "</p>";			
			print ("<p><a href='agregar_fotos.php'>Volver al formulario</a></p>\n"); 
			}

		mysqli_close($conn);

		}
	else
		{
		print ("<h1>Fotos:</h1>\n");
	        print ("<form action='agregar_fotos.php' name='fotos' method='post' enctype='multipart/form-data'>\n");

		print ("<p class='etiqueta'>Evento:</p>\n");
		print ("<p class='campo'><input type='text' name='idevento' size='10' maxlenght='10' value='$id_evento' readonly></p>\n");

		print ("<input type='hidden' name='max_file_size' value='10002400'>");
                print ("<p class='campo'><input type='file' multiple=yes name='imagen'>");

                if ($errores["imagen"] != "")
			print "<p>Error {$errores['fotos']}</p>\n";

		print ("<p class='campo'><input type='submit' name='insertar' value='Agregar fotos'></p>\n");
		print ("</form>\n");

		print ("<p class='campo'><a href='mostrar_usuario.php'>Regresar</a></p>\n");		
		print ("</section>\n");

		}

	print ("</body>\n");
	print ("</html>\n");					
?>
