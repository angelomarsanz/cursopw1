<?php 
session_start();
header ('Content-type: text/html; charset=utf-8'); 
include "cabecera.php";
print ("<body>\n");
print ("<div id='agrupar'>\n");
print ("<header id='cabecera'>\n");
print ("<h1>Título de mi Sitio Web</h1>\n");
print ("</header>\n");
print ("<nav id='menu'>\n");
print ("<ul>\n");
print ("<li>Inicio</li>\n");
print ("<li>¿Quiénes somos?</li>\n");
print ("<li><a class='opcionmenu' href='insertar_usuario2.php'>Registrarse</a></li>\n");
print ("<li><a class='opcionmenu' href='acceder_usuario.php'>Modificar perfil</a></li>\n");
print ("<li><a class='opcionmenu' href='mostrar_usuarios.php'>Eventos</a></li>\n");
print ("<li><a class='opcionmenu' href='acceder_usuario_modificar.php'>Modificar eventos</a></li>\n");
print ("<li><a class='opcionmenu' href='acceder_usuario_fotos.php'>Fotos</a></li>\n");
print ("<li><a class='opcionmenu' href='agregar_fotos_slider.php'>Agregar slider</a></li>\n");
print ("<li><a class='opcionmenu' href='slider_fotos.php'>Eliminar slider</a></li>\n");
print ("</ul>\n");
print ("</nav>\n");
print ("<section id='seccion'>\n");
include "conexionbasedatos.php";
$sql = "SELECT * FROM slider";
$result = mysqli_query($conn, $sql) or die ("No se encontraron fotos para el slider");
if (mysqli_num_rows($result) > 0)
{
	print ("<div id='slider-container'>\n");
	print ("<div id='slider-box'>\n");	
	for ($i=0; $i<mysqli_num_rows($result); $i++)
	{
		$row = mysqli_fetch_assoc($result);
		print ("<div class='slider-element'>\n");
		print ("<article>\n");
		print ("<figure>\n");
		print ("<img src='slider/" . $row['foto_slider'] . "'>\n");
		print ("</figure>\n");
		print ("</article>\n");
		print ("</div>\n");		
	}	
	print ("</div>\n");
	print ("</div>\n");
}	
print ("</section>\n");
print ("<footer id='pie'>\n");
print ("<small>Derechos reservados</small>\n");
print ("</footer>\n");				
print ("</div>\n");
print ("</body>\n");
print ("</html>\n");
?>