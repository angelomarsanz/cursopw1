<?php 
	session_start();
	header ('Content-type: text/html; charset=utf-8'); 
	include "cabecera.php";
	print ("<body>\n");
	print ("<section class='formulario'>\n");

   	if (isset($_GET['IdUsuario']))
	   $usuario = $_GET['IdUsuario'];

	$error = false;
	$errores = array ("nombre_evento"=>"", "fecha_evento"=>"");

	if (isset($_REQUEST['insertar']))
		{
		$insertar = $_REQUEST['insertar'];	
		$usuario = $_REQUEST['usuario'];
		$tipo_evento = $_REQUEST['tipoevento'];
		$nombre_evento = $_REQUEST['nombreevento'];
		$lugar_evento = $_REQUEST['lugarevento'];
		$fecha_evento = $_REQUEST['fechaevento'];
		$hora_evento = $_REQUEST['horaevento'];

		include "validarnombreevento.php";
		include "validarfecha.php";
		}

	if (isset($_REQUEST['insertar']) && !($error))
		{									
		include "conexionbasedatos.php";
 			
		$sql = "INSERT INTO eventos (usuario, tipo_evento, nombre_evento, lugar_evento, fecha_evento, hora_evento) values ('$usuario', '$tipo_evento', '$nombre_evento', '$lugar_evento', '$fecha_evento', '$hora_evento')";
			
		if (mysqli_query($conn, $sql))
			{
			echo "Evento creado satisfactoriamente";

			$ultimo_registro = mysqli_insert_id($conn);

			print ("<p><a href='agregar_fotos.php?IdEvento=" . $ultimo_registro . "' title='Agregar fotos'>
                                   <img border='0' src='imagenes/agregar.jpeg'></a>&nbsp;&nbsp;&nbsp;"
                                    . $nombre_evento . "</p>\n");

			print ("<p><a href='index.php'>Volver a inicio</a></p>\n"); 
			}
		else	
			{
			echo "Error: " . "<p>" . mysqli_error($conn) . "</p>";			
			print ("<p><a href='agregar_evento.php'>Volver al formulario</a></p>\n"); 
			}

			mysqli_close($conn);
		}
	else
		{
		print ("<h1>Agregar evento:</h1>\n");
	        print ("<form action='agregar_evento.php' name='insertar' method='post'>\n");

		print ("<p class='etiqueta'>Usuario:</p>\n");
		print ("<p class='campo'><input type='text' name='usuario' size='10' maxlenght='10' value='$usuario' readonly></p>\n");
							
		print ("<p class='etiqueta'>Nombre del evento:*</p>\n");
		print ("<p class='campo'><input type='text' name='nombreevento' size='20' maxlenght='200'");  
				
		if (isset($_REQUEST['insertar']))
			print ("value='$nombre_evento'></p>\n");
		else
			print ("></p>\n");

	    	if ($errores["nombre_evento"] != "")
			print "<p>Error {$errores['nombre_evento']}</p>\n";
																		
		print ("<p class='etiqueta'>Fecha del evento (AAAA-MM-DD):</p>\n");
		print ("<p class='campo'><input type='text' name='fechaevento'></p>\n");

	    	if ($errores["fecha_evento"] != "")
			print "<p>Error {$errores['fecha_evento']}</p>\n";

		print ("<p class='etiqueta'>Hora del evento (Formato 24 horas):</p>\n");
		print ("<p class='campo'><input type='text' name='horaevento'></p>\n");

		print ("<p class='etiqueta'>Lugar del evento:</p>\n");
		print ("<p class='campo'><input type='text' name='lugarevento' size='20' maxlenght='200'></p>\n");

		print ("<p class='etiqueta'>Tipo de evento:</p>\n");
	        print ("<p class='campo'>
     				<select name='tipoevento'>
					<option value='' select>&nbsp
					<option value='Cumpleaños'>Cumpleaños
					<option value='Quinceaños'>Quince años
					<option value='Boda'>Boda
					<option value='Bautizo'>Bautizo
					<option value='Despedida de soltero'>Despedida de soltero
					<option value='Inauguración'>Inauguración
					<option value='Otro'>Otro
				</select>");                  							

		print ("<p class='campo'><input type='submit' name='insertar' value='Agregar evento'></p>\n");
		print ("</form>\n");

		print ("<p class='campo'>Nota: Los datos marcados con (*) deben ser rellenados obligatoriamente.</p>\n");
		print ("<p class='campo'><a href='mostrar_usuario.php'>Regresar</a></p>\n");		
		print ("</section>\n");

		}

	print ("</body>\n");
	print ("</html>\n");					
?>
