<?php 
   	session_start(); 
	header ('Content-type: text/html; charset=utf-8');  
	include "cabecera.php";
    print ("<body>\n");
    print ("<section class='formulario'>\n");
	$usuario = "";
	$imprimir = [];
	$nro_filas_impresion;
	$borrar = [];
	$nro_filas_borrar;
	$foto = "";
	$ruta_archivo = "";
	if (isset($_SESSION['id_usuario']))
		{
			$usuario = $_SESSION['id_usuario'];
			$id_evento = $_SESSION['id_evento'];
			include "conexionbasedatos.php";
			$sql = "update fotos set impresion=false where id_evento='$id_evento'";
			$result = mysqli_query($conn, $sql) or die ("Fallo al actualizar tabla fotos");
			if (isset($_REQUEST['imprimir']))
			{
				$imprimir = $_REQUEST['imprimir'];
				$nro_filas_impresion = count ($imprimir);					
				var_dump($imprimir);
				print ("<br>");
				echo nl2br("Nro. filas marcadas para impresión $nro_filas_impresion\n");
				$i = 0;
				while ($i<$nro_filas_impresion):
					print nl2br("Foto a imprimir: $imprimir[$i]\n");
					$sql = "update fotos set impresion=true where id_foto='$imprimir[$i]'";
					$result = mysqli_query($conn, $sql) or die ("Fallo al actualizar tabla fotos");
					$i++;
				endwhile;
			}				
			if (isset($_REQUEST['borrar']))
			{
				$borrar = $_REQUEST['borrar'];
				$nro_filas_borrar = count ($borrar);
				var_dump($borrar);
				print ("<br>");
				echo nl2br("Nro. filas marcadas para eliminar $nro_filas_borrar\n");
				$i = 0;
				while ($i<$nro_filas_borrar):
					print nl2br("Foto a borrar: $borrar[$i]\n");		
					$sql = "select * from fotos where id_foto = $borrar[$i]";
					$result = mysqli_query($conn, $sql) or die ("Fallo al seleccionar foto para eliminar");
					$row = mysqli_fetch_assoc($result);
					$foto = $row['foto'];
					$sql = "delete from fotos where id_foto = '$borrar[$i]'";
					$result = mysqli_query($conn, $sql) or die ("Fallo al eliminar registro en tabla fotos");
					$ruta_archivo = "fotos/" . $foto;
					unlink ($ruta_archivo);						
					$i++;
				endwhile;
			}
			mysqli_close($conn);
			$_SESSION['fotos_impresion'] = $nro_filas_impresion;
			$_SESSION['fotos_borrar'] = $nro_filas_borrar;
			header ('Location: notificacion_fotos.php');
		}
?>		