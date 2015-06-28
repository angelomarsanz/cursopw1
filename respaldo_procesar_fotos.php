<?php 
   	session_start(); 
	header ('Content-type: text/html; charset=utf-8');  
	include "cabecera.php";
    print ("<body>\n");
    print ("<section class='formulario'>\n");
	$usuario = "";
	$imprimir = [];
	$borrar = [];
	$foto = "";
	$ruta_archivo = "";
	if (isset($_SESSION['id_usuario']))
		{
			$usuario = $_SESSION['id_usuario'];
			$id_evento = $_SESSION['id_evento'];
			include "conexionbasedatos.php";
			if (isset($_REQUEST['imprimir']))
			{
				$imprimir = $_REQUEST['imprimir'];
				var_dump($imprimir);
				print ("<br>");
			}
			if (isset($_REQUEST['borrar']))
			{
				$borrar = $_REQUEST['borrar'];
				var_dump($borrar);
				print ("<br>");
			}
			$sql = "SELECT * FROM fotos WHERE id_evento = '$id_evento' ORDER BY id_foto ASC";
			$result = mysqli_query($conn, $sql) or die ("Fallo al acceder a la tabla eventos");
			if (mysqli_num_rows($result) > 0)
			{
				$i = 0;
				while ($i<mysqli_num_rows($result)):
					$row = mysqli_fetch_assoc($result);
					$id_foto = $row['id_foto'];
					if (isset($imprimir[$i]))
					{
						echo nl2br("pase por true\n"); 			
						echo nl2br("i: $i\n");
						echo nl2br("id_foto $id_foto\n");
						echo nl2br("vector imprimir $imprimir[$i]\n");
						$sql = "update fotos set impresion=true where id_foto='$id_foto'";
					}
					else if (isset($borrar[$i]))
					{
						echo "pase por borrar";						
						echo "i: $i";
						echo nl2br("id_foto $id_foto\n");						
						$foto = $row['foto'];
						$sql = "delete from fotos where id_foto = $id_foto";
					}	
					else
					{		
						echo nl2br("pase por false\n"); 			
						echo nl2br("i: $i\n");
						echo nl2br("id_foto $id_foto\n");
						echo nl2br("vector imprimir $imprimir[$i]\n");
						$sql = "update fotos set impresion=false where id_foto='$id_foto'";	
					}				
					$result2 = mysqli_query($conn, $sql) or die ("Fallo al actualizar tabla fotos");
					if ($foto != "")
					{
						$ruta_archivo = "fotos/" . $foto;
						unlink ($ruta_archivo);
					}	
					$i++;
				endwhile;
			}				
			mysqli_close($conn);				
		}
?>		