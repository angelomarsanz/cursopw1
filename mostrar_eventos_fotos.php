<?php 
   	session_start(); 
	header ('Content-type: text/html; charset=utf-8');  
	include "cabecera.php";
    print ("<body>\n");
    print ("<section class='formulario'>\n");
	$usuario = "";	
	$nombre_evento = ""; 
	if (isset($_SESSION['id_usuario']))
	{	
		$usuario = $_SESSION['id_usuario'];		
		include "conexionbasedatos.php";
		$sql = "SELECT * FROM eventos WHERE usuario = '$usuario' ORDER BY nombre_evento ASC";
		$result = mysqli_query($conn, $sql) or die ("Fallo al acceder a la tabla eventos");
		if (mysqli_num_rows($result) > 0) 
		{
			print ("<h3>Eventos del usuario: $usuario</h3>\n");
                for ($i=0; $i<mysqli_num_rows($result); $i++)
				{	
					$row = mysqli_fetch_assoc($result);
					print ("<p><a href='fotos.php?IdEvento=" . $row['id_evento'] . "&NombreEvento=" . $row['nombre_evento'] . "'title='Ver fotos'>
                                   <img border='0' src='imagenes/iconocamara.png'></a>&nbsp;&nbsp;&nbsp;"
                                    . $nombre_evento = $row['nombre_evento'] . "</p>\n");
				}
		}
	}
	else
		{
		echo "Error al acceder la tabla eventos";
		print ("<p><a href='index.php'>Volver al inicio</a></p>\n"); 
		}
				
	mysqli_free_result($result);
		
	mysqli_close($conn);

	print ("</section>\n");
	print ("</body>\n");
	print ("</html>\n");
?>