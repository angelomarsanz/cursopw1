<?php 
   	session_start(); 
	header ('Content-type: text/html; charset=utf-8');  
	$slider = [];
	$nro_fotos_slider = 0;
	$foto = "";
	$ruta_archivo = "";
	include "conexionbasedatos.php";
	$sql = "update fotos set slider=false";
	$result = mysqli_query($conn, $sql) or die ("Fallo al actualizar tabla fotos");
	if (isset($_REQUEST['slider']))
	{
		$slider = $_REQUEST['slider'];
		$nro_fotos_slider = count ($slider);					
		$i = 0;
		while ($i<$nro_fotos_slider):
			$sql = "update fotos set slider=true where id_foto='$slider[$i]'";
			$result = mysqli_query($conn, $sql) or die ("Fallo al actualizar tabla fotos");
			$i++;
		endwhile;
	}				
	mysqli_close($conn);
	$_SESSION['fotos_slider'] = $nro_fotos_slider;
	header ('Location: notificacion_fotos_slider.php');
?>		