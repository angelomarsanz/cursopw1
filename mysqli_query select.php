<?php

/* Primero definimos las variables necesarias para
          conectarnos a la base de datos */

$servername = "localhost";
$username = "cursophp";
$password = "";
$dbname = "clientes";

/* Creamos la variable "$conn" y le asignamos la instrucción "mysqli_connect"
          y las variables creadas arriba */

$conn = mysqli_connect ($servername, $username, $password, $dbname);

/* Intentamos conectarnos, si al intentar la variable "$conn" retorna el valor "false", 
	quiere decir que la conexión a la base de datos falló, entonces,
	salimos del programa y mostramos un mensaje de error 
	por pantalla */

If (!($conn))
	{
	die ("Conexión fallida: " . mysqli_connect_error());				
        }

/* Preparamos la variable "$sql" con los valores necesarios
       para seleccionar el registro de la tabla usuario de la base de datos */
				
$sql = "SELECT * FROM usuario WHERE usuario = 'angel' ";

/* Asignamos a la variable $result la instrucción "mysqli_query" con los parámetros:
	"$conn" (que son los valores para la conexión a la base de datos y
	$conn (que es el SELECT a la base de datos. Si hay alguna falla
	al intentar seleccionar el registro de la base de datos, aborta el 
	programa */ 

$result = mysqli_query($conn, $sql) or die ("Fallo al acceder la cuenta");

/* Si el contador de filas tiene un valor mayor a cero, quiere decir
	que se encontró uno o más registros que cumplen la condición */
		
if (mysqli_num_rows($result) > 0)
	{
	/* Entonces asignamos el contenido del registro hallado a una variable
	llamada "$row", que trataremos como un arreglo o array */
	}
	$row = mysqli_fetch_assoc($result);			
	echo "Usuario: " . $row["usuario"]. " - Clave : " . $row["clave"]. " - Correo: " . $row["correo"];												
	}

/* De lo contrario, si el contador de filas, es menor a cero, quiere
	decir que no se encontraron registros que cumplieran con la

	condición de usuario = 'angel' */
else
				echo "No existe la cuenta del usuario";
			
			/* No podemos dejar la conexión a la base de datos abierta!,
				 así que procedemos a cerrarla */
			mysqli_close($conn);
