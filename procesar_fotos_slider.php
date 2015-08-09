<?php 
   	session_start(); 
	header ('Content-type: text/html; charset=utf-8');  
	include "conexionbasedatos.php";
	if (isset($_REQUEST['borrar']))
	{
		$borrar = $_REQUEST['borrar'];
		$nro_filas_borrar = count ($borrar);
		$i = 0;
		while ($i<$nro_filas_borrar):
			$paraborrar = $borrar[$i];
			echo nl2br("$paraborrar\n");
			$sql = "select * from slider where id_foto_slider = $borrar[$i]";
			$result = mysqli_query($conn, $sql) or die ("Fallo al seleccionar foto para eliminar");
			$row = mysqli_fetch_assoc($result);
			$foto = $row['foto_slider'];
			$sql = "delete from slider where id_foto_slider = '$borrar[$i]'";
			$result = mysqli_query($conn, $sql) or die ("Fallo al eliminar registro en tabla slider");
			$ruta_archivo = "slider/" . $foto;
			unlink ($ruta_archivo);						
			$i++;
		endwhile;
	}
	mysqli_close($conn);
	$_SESSION['fotos_borrar'] = $nro_filas_borrar;
	header ('Location: notificacion_fotos_slider.php');
?>		