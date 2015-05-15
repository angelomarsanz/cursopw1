<!DOCTYPE html>
<?php 
include "cabecera.php";
header ('Content-type: text/html; charset=utf-8'); 
?>
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
									      esta es la imagen del mensaje
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
<?php
include "piedepagina.php";
?>