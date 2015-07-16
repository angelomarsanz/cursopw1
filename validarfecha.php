<?php
function validarformato($fecha_evento_formato)
	{
		$segmento = array();
		if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $fecha_evento_formato, $segmento))					
		{
        	$error_formato = false;    
            $fecha_convertida = "$segmento[3]-$segmento[2]-$segmento[1]";
		}
		else
		{
        	$error_formato = true;
        	$fecha_convertida = "0000-00-00";
		}
        return array ($error_formato, $fecha_convertida);
	}		
	if (trim($fecha_evento) == "")
			{
			$errores["fecha_evento"] = "¡Debe introducir la fecha del evento!";
			$error = true;				
			}
	else		
			{
			list ($error, $fecha_convertida_bd) = validarformato($fecha_evento);
				if ($error)
					{	
						$errores["fecha_evento"] = "¡Introdujo incorrectamente la fecha!";
					}
			}
?>