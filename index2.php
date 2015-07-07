<?php 
session_start();
header ('Content-type: text/html; charset=utf-8'); 
include "cabecera.php";
?>
		<body>
			<div id="agrupar">
				<header id="cabecera">
					<h1>Título de mi Sitio Web</h1>
				</header>
				<nav id="menu">
					<ul>
						<li>Inicio</li>
						<li>¿Quiénes somos?</li>
						<li><a class="opcionmenu" href="insertar_usuario2.php">Registrarse</a></li>
						<li><a class="opcionmenu" href="acceder_usuario.php">Modificar perfil</a></li>
						<li><a class="opcionmenu" href="mostrar_usuarios.php">Eventos</a></li>
						<li><a class="opcionmenu" href="acceder_usuario_fotos.php">Fotos</a></li>
						<li><a class="opcionmenu" href="slider_fotos.php">Slider</a></li>
					</ul>
				</nav>
				<section id="seccion">
					<article>
						<header>
							<time datetime="2015-04-19T11:18:22" pubdate>Publicado el 19-04-2015</time>
							<h2>Título de la sección principal</h2>
						</header>
						<span>Esta es la <mark>primera</mark> línea de la <cite>sección</cite> principal</span>
						<p>Este es un parráfo de la sección principal</p>
						<p class="texto1">Este es un párrafo con clase</p>
						<figure>
							   <img src="manos.jpg">
						              <figcaption>
									      esta es la imagen del mensaje del sitio prueba del curso
									  </figcaption>
						</figure>
						<footer>
						    <address>
							    <a href="http://www.notitarde.com">Notitarde</a>
							</address>
							<small>pie de pagina del articulo</small>
					    </footer>
					</article>
				</section>
				<aside id="columna">
				   <h3>primer mensaje de la columna lateral</h3>
				   <h3>segundo mensaje de la columna lateral</h3>
			    </aside>
				<footer id="pie">
				<small>Derechos reservados</small>
			    </footer>
				
			</div>
		</body>
	</html>

	
	
	
	
<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Galeria Dinámica Nivo Slider Por PHP - Bakia</title>
        <link rel="stylesheet" href="css/default.css" type="text/css" media="screen" />
        <style>
            #galeria {
                margin:0 auto 0 auto;
                width:550px;
                height:425px;
                -webkit-box-shadow: 0px 1px 5px 0px #4a4a4a;
                -moz-box-shadow: 0px 1px 5px 0px #4a4a4a;
                box-shadow: 0px 1px 5px 0px #4a4a4a;
            }
   
        </style>
    <script type="text/javascript" src="scripts/jquery-1.6.1.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
       
    </head>
    <body>
        <div id="galeria">
            <div id="slider" class="nivoSlider">
                <?php
                    $directory="img";
                        $dirint = dir($directory);
                            while (($archivo = $dirint->read()) !== false)
                            {
                                if (eregi("gif", $archivo) || eregi("jpg", $archivo) || eregi("png", $archivo)){
                                    echo '<img src="'.$directory."/".$archivo.'">'."\n";
                                }
                            }
                            $dirint->close();
                ?>
            </div>
        </div>
    </body>
</html>