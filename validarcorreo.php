<?php
	/* Si la variable "$correo" tiene espacios en blanco,
		quiere decir que el usuario no introdujo nada en este campo,
		entonces asignamos un mensaje en la variable "$errores" y 
		asignamos el valor "true" a la variable "$error"
		para mostrarlos después al usuario */

	if (trim($correo) == "")
		{
		$errores["correo"] = "¡Debe introducir el correo!";
		$error = true;
		}

?>

