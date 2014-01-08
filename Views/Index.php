<?php
require '../siteConfig.php';
require '../Utils/Bootstrap.php';

Bootstrap::setRequiredFiles();
$logged = Security::authenticate();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head profile="http://www.w3.org/2005/10/profile">
	<title>Gr&aacute;fica Leon Online</title>
	<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />
	<meta name="description" content="Empresa de dise&ntilde;o e impresion de trabajos graficos" />
	<meta name="keywords" content="imprenta, grafica, dise&ntilde;o, grafico, galvez, rosario, impresion" />
	<meta name="author" content="Tu Web Rosario - Desarrollo de Sitios y Sistemas Web" />
	<link rel="icon" type="image/png" href="../resources/img/favicon.png"/>
	<link rel="stylesheet" href="../resources/css/reset.css" type="text/css">
	<link rel="stylesheet" href="../resources/css/style.css" type="text/css">
	<link rel="stylesheet" href="../resources/css/feature-carousel.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Patrick+Hand+SC' rel='stylesheet' type='text/css'>	
	<script type="text/javascript" src="../resources/js/libs/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="../resources/js/libs/jquery.corner.js"></script>
	<script type="text/javascript" src="../resources/js/libs/carousel_ready.js"></script>
	<script type="text/javascript" src="../resources/js/libs/effectsIndex.js"></script>
	<script type="text/javascript" src="../resources/js/libs/jquery-ui-1.10.1.custom.js"></script>	
	<script type="text/javascript" src="../resources/js/libs/jquery.featureCarousel.js"></script>
	</head>
	<body>
		<div id="header">
			<a id="contacto" href="contact.php">Contacto</a>
			<div id="content_block">
				<div id="block_logo"></div>
				<div id="block_menu">
					<div class="clearfix"></div>
					<nav>
						<ul id="menu">
							<li><a style="border-top-left-radius:25px" href="#">Tarjetas</a>
								<ul>
									<li><a href="showGallery_tarjetapersonal.php?type=personalesFormal&name=TARJETAS&nbsp;PERSONALES&nbsp;FORMALES">Personales</a></li>
									<li><a href="showGallery.php?type=15anios&name=TARJETAS&nbsp;15&nbsp;A&Ntilde;OS">15 A&ntilde;os</a></li>
									<li><a href="showGallery.php?type=bautismo&name=TARJETAS&nbsp;BAUTISMO">Bautismo</a></li>
									<li><a href="showGallery.php?type=casamiento&name=TARJETAS&nbsp;CASAMIENTO">Casamiento</a></li>
									<li><a href="showGallery.php?type=comunion&name=TARJETAS&nbsp;COMUNION">Comunion</a></li>
								</ul>
							</li>
							<li><a href="#">Folletos</a>
								<ul>
									<li><a href="showGallery_folletonegro.php?type=tintanegra&name=FOLLETOS&nbsp;TINTA&nbsp;NEGRA">Tinta Negra</a></li>
									<li><a href="showGallery_folleto1color.php?type=1color&name=FOLLETOS&nbsp;1&nbsp;COLOR">1 Color</a></li>
									<li><a href="showGallery_fullcolor.php?type=fullcolor&name=FOLLETOS&nbsp;FULL&nbsp;COLOR">Full Color</a></li>	
								</ul>
							</li>
							<li><a href="#">Talonarios</a>
								<ul>
									<li><a href="#">Facturas</a></li>
									<li><a href="#">Presupuestos</a></li>
									<li><a href="#">Anotadores</a></li>
									<li><a href="#">Recibos</a></li>
								</ul>
							</li>
							<li><a href="#">Otros</a>
								<ul >
									<li><a href="showGallery_stickers.php?type=etiquetas&name=ETIQUETAS">Etiquetas</a></li>
									<li><a href="showGallery_imanes.php?type=imanes&name=IMANES">Imanes</a></li>
									<li><a href="showGallery.php?type=sobres&name=SOBRES">Sobres</a></li>
									<li><a href="showGallery.php?type=membretados&name=MEMBRETADOS">Membretada</a></li>
									<li><a href="showGallery.php?type=rifas&name=RIFAS">Rifas</a></li>
									<li><a href="showGallery.php?type=carpetas&name=CARPETAS">Carpetas</a></li>
								</ul>
							</li>
							<li class="last"><a href="#" style="border-top-right-radius:25px; border-right:none">Dise&ntilde;os</a>
								<ul>
									<li><a href="showGallery.php?type=catalogo1&name=CATALOGO&nbsp;DE&nbsp;DISE&Ntilde;OS&nbsp;1">Dise&ntilde;os 1</a></li>
									<li><a href="showGallery.php?type=catalogo2&name=CATALOGO&nbsp;DE&nbsp;DISE&Ntilde;OS&nbsp;2">Dise&ntilde;os 2</a></li>
									<li><a href="showGallery.php?type=catalogo3&name=CATALOGO&nbsp;DE&nbsp;DISE&Ntilde;OS&nbsp;3">Dise&ntilde;os 3</a></li>
									<li><a href="showGallery.php?type=catalogo4&name=CATALOGO&nbsp;DE&nbsp;DISE&Ntilde;OS&nbsp;4">Dise&ntilde;os 4</a></li>
									<li><a href="showGallery.php?type=catalogo5&name=CATALOGO&nbsp;DE&nbsp;DISE&Ntilde;OS&nbsp;1">Dise&ntilde;os 5</a></li>		
								</ul>
							</li>
							<div class="clearfix"></div>
						</ul>
					</nav>		
				</div>
				<div class="clearfix"></div>
			</div>
			<div id="content" style="border:none">
				<div>
					<h2 class="title_company">Quienes Somos?</h2>
					<p class="description_company">Somos un grupo de jovenes profesionales dedicados a brindar a nuestros clientes soluciones efectivas en el &aacute;rea de la comunicaci&oacute;n y el dise&ntilde;o. Conformamos un equipo de trabajo responsable en el manejo de nuestras tareas y nos comprometemos con los requerimientos de nuestros clientes, trabajando en conjunto para poder brindarles soluciones gr&aacute;ficas de alto impacto.</p>		
				</div>
				<a id="but_prev" href="#">PREV</a> | <a id="but_pause" href="#">PAUSE</a> | <a id="but_start" href="#">START</a> | <a id="but_next" href="#">NEXT</a> 
				<div class="carousel-container">
					<div id="carousel">
						<div class="carousel-feature">
							<a href="#"><img class="carousel-image" alt="Image Caption" src="../resources/img/sample1.jpg"></a>
						</div>
						<div class="carousel-feature">
							<a href="#"><img class="carousel-image" alt="Image Caption" src="../resources/img/sample2.jpg"></a>
						</div>
						<div class="carousel-feature">
							<a href="#"><img class="carousel-image" alt="Image Caption" src="../resources/img/sample3.jpg"></a>
						</div>
						<div class="carousel-feature">
							<a href="#"><img class="carousel-image" alt="Image Caption" src="../resources/img/sample4.jpg"></a>
						</div>
					</div>
					<div id="carousel-left"><img src="../resources/img/arrow-left.png" /></div>
					<div id="carousel-right"><img src="../resources/img/arrow-right.png" /></div>
				</div>
			</div>
		</div>		
		<div class="clearfix"></div>
		<div id="footer">			
			<div id="info">
				<p id="footer_info_small">Tel.: (0341) 4925877 - graficaleon@gmail.com - Face:Grafika Leon</p>
				<div class='footer_info'>
					<div id='phone_image' class='footer_image'></div>
					<div class='footer_text'>
						<span>Tel.: (0341) 4925877</span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class='footer_info'>
					<div id='email_image' class='footer_image'></div>
					<div class='footer_text'>
						<span>graficaleon@gmail.com</span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class='footer_info'>
					<div id='face_image' class='footer_image'></div>
					<div class='footer_text'>
						<span><a  href="https://www.facebook.com/grafika.leon">Grafika Leon</a></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>		
	</body>
</html>