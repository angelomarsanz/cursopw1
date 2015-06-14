<?php
	function validarformato($fecha_evento_formato)
		{
		if (ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $fecha_evento_formato, $registros)) 
			{
                   	$error_formato = false;
			}
		else
			{
                   	$error_formato = true;
			}

		return $error_formato;
		}
			
	if (trim($fecha_evento) != "")
		{
		$error = validarformato($fecha_evento);                
                if ($error)
			{	
			$errores["fecha_evento"] = "¡Introdujo incorrectamente la fecha!";
			}
		}
?>

