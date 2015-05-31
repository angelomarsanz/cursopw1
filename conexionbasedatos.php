<?php

	/* Crear las variables necesarias para conectar con la base de datos y
		asignarle los valores correspondientes */

	$servername = "localhost";
	$username = "cursophp";
	$password = "";
	$dbname = "clientes";

	/* Creamos la variable "$conn" y le asignamos la instrucción "mysqli_connect" y las variables
		necesarias para conectar a la base de datos "clientes" */

	$conn = mysqli_connect ($servername, $username, $password, $dbname);

	/* Intentamos conectarnos, si al intentar la variable "$conn" retorna el valor "false", 
		quiere decir que la conexión a la base de datos falló, entonces,
		abortamos el programa y mostramos un mensaje de error 
		por pantalla */

	If (!($conn))
		{
		die ("Conexión fallida: " . mysqli_connect_error());				
		}
?>

