<?php
	/* Si la variable "$usuario" tiene espacios en blanco,
		quiere decir que el usuario no introdujo nada en este campo,
		entonces asignamos un mensaje en la variable "$errores" y 
		asignamos el valor "true" a la variable "$error"
		para mostrarlos después al usuario */

	if (trim($usuario) == "")
		{
		$errores["usuario"] = "¡Debe introducir el usuario!";
		$error = true;
		}

?>

