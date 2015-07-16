<?php
	function validarformato($fecha_evento_formato)
		{
#		if (preg_match('#^(d{1,2})/(d{1,2})/(d{4})$#', $fecha_evento_formato, $segmento))					
		if (preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/', $fecha_evento_formato, $segmento))					
		{
                   	$error_formato = false;                 	
                   	print_r($segmento[1]);
  			}
		else
			{
                   	$error_formato = true;
			}

		return $error_formato;
		}
			
	if (trim($fecha_evento) == "")
			{
			$errores["fecha_evento"] = "¡Debe introducir la fecha del evento!";
			$error = true;				
			}
	else		
			{
			$error = validarformato($fecha_evento);                
				if ($error)
					{	
						$errores["fecha_evento"] = "¡Introdujo incorrectamente la fecha!";
					}
			}
?>