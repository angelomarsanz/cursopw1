<?php
	function validarformato($fecha_evento_formato)
		{
		if (preg_match('#^\d{4}\-\d{1,2}\-\d{1,2}$#', $fecha_evento_formato))
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

