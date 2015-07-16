<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
	if (isset($_SESSION['id_usuario']))
	{
		$usuario = $_SESSION['id_usuario'];
		$error = false;
		$errores = array ("nombre_evento"=>"", "fecha_evento"=>"");
		include "conexionbasedatos.php";
		/* Modificar programa aquí: Si el usuario ha introducido datos en el formulario
		 * mueve los datos de html a php, valida fecha y nombre del evento
		 */
		if (isset($_GET['IdEvento']))
			$id_evento = $_GET['IdEvento'];
		$sql = "SELECT * FROM eventos WHERE id_evento = '$id_evento'";
		$result = mysqli_query($conn, $sql) or die ("Fallo al acceder a la tabla eventos");
		if (mysqli_num_rows($result) > 0)
		{	
			$row = mysqli_fetch_assoc($result);			
			$tipo_evento = $row['tipo_evento'];
			$nombre_evento = $row['nombre_evento'];
			$lugar_evento = $row['lugar_evento'];
			$fecha_evento = $row['fecha_evento'];
			$hora_evento = $row['hora_evento'];
			/* Modificar programa aquì: Si el usuario introdujo los datos en el formulario y no
			 * hay errores en la fecha y en el nombre del evento actualizas la tabla
			 * eventos de la base de datos clientes
			 */
			print ("<h1>Modificar evento:</h1>\n");
			print ("<form action='modificar_evento_guia.php' name='modificar' method='post'>\n");
			print ("<p class='etiqueta'>Identificador del evento:</p>\n");
			print ("<p class='campo'><input type='text' name='idevento' size='10' maxlenght='10' value='$id_evento' readonly></p>\n");
			print ("<p class='etiqueta'>Usuario:</p>\n");
			print ("<p class='campo'><input type='text' name='usuario' size='10' maxlenght='10' value='$usuario' readonly></p>\n");
			print ("<p class='etiqueta'>Nombre del evento:*</p>\n");
			print ("<p class='campo'><input type='text' name='nombreevento' value='$nombre_evento' size='20' maxlenght='200'></p>\n");
			if ($errores["nombre_evento"] != "")
				print "<p>Error {$errores['nombre_evento']}</p>\n";
			print ("<p class='etiqueta'>Fecha del evento (DD/MM/AAAA):</p>\n");
			print ("<p class='campo'><input type='text' name='fechaevento' value='$fecha_evento'></p>\n");
			if ($errores["fecha_evento"] != "")
				print "<p>Error {$errores['fecha_evento']}</p>\n";
			print ("<p class='etiqueta'>Hora del evento (Formato 24 horas):</p>\n");
			print ("<p class='campo'><input type='text' name='horaevento' value='$hora_evento' ></p>\n");
			print ("<p class='etiqueta'>Lugar del evento:</p>\n");
			print ("<p class='campo'><input type='text' name='lugarevento' size='20' maxlenght='200' value='$lugar_evento' ></p>\n");				
			print ("<p class='etiqueta'>Tipo de evento:</p>\n");
			print ("<p class='campo'>
     			<select name='tipoevento'>
				<option value='$tipo_evento' select>$tipo_evento						
				<option value=''>&nbsp
				<option value='Cumpleaños'>Cumpleaños
				<option value='Quinceaños'>Quince años
				<option value='Boda'>Boda
				<option value='Bautizo'>Bautizo
				<option value='Despedida de soltero'>Despedida de soltero
				<option value='Inauguración'>Inauguración
				<option value='Otro'>Otro
				</select>");
			print ("<p class='campo'><input type='submit' name='modificar' value='Modificar evento'></p>\n");
			print ("</form>\n");				
			print ("<p class='campo'>Nota: Los datos marcados con (*) deben ser rellenados obligatoriamente.</p>\n");
		}				
		mysqli_close($conn);
		print ("<p><a href='index.php'>Volver a inicio</a></p>\n");
		print ("</section>\n");
		print ("</body>\n");
		print ("</html>\n");
	}
?>