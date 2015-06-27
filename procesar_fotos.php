<?php 
   	session_start(); 
	header ('Content-type: text/html; charset=utf-8');  
	include "cabecera.php";
    print ("<body>\n");
    print ("<section class='formulario'>\n");
	$usuario = "";
	$imprimir = [];
	$borrar = [];
	if (isset($_SESSION['id_usuario']))
		{
			$usuario = $_SESSION['id_usuario'];
			$id_evento = $_SESSION['id_evento'];
			include "conexionbasedatos.php";
			if (isset($_REQUEST['imprimir']))
			{
				$imprimir = $_REQUEST['imprimir'];
				var_dump($imprimir);
			}
			$sql = "SELECT * FROM fotos WHERE id_evento = '$id_evento'";
			$result = mysqli_query($conn, $sql) or die ("Fallo al acceder a la tabla eventos");
			if (mysqli_num_rows($result) > 0)
			{
				$i = 0;
				while ($i<mysqli_num_rows($result)):
					$row = mysqli_fetch_assoc($result);
					$id_foto = $row['id_foto'];
					echo "i: $i";
					echo nl2br("id_foto $id_foto\n");		
					if (isset($imprimir[$i]))
					{
						echo "pase por true"; 			
						$sql = "update fotos set impresion=true where id_foto='$id_foto'";
					}
					else
						$sql = "update fotos set impresion=false where id_foto='$id_foto'";					
					$result2 = mysqli_query($conn, $sql) or die ("Fallo al actualizar foto");						
					$i++;
				endwhile;
			}				
			if (isset($_REQUEST['borrar']))
			{
				$borrar = $_REQUEST['borrar'];
				$nfilasborrar = count ($borrar);
				var_dump($borrar);
			}
			mysqli_close($conn);				
		}
?>		