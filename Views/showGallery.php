<?php
require '../siteConfig.php';
require '../Utils/Bootstrap.php';

Bootstrap::setRequiredFiles();
$initPath = '../resources/img/galleries/'.$_GET['type'].'/gallery/modelo';
$name = 'DISE&Ntilde;O ';
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
		<link href='http://fonts.googleapis.com/css?family=Patrick+Hand+SC' rel='stylesheet' type='text/css'>		
		<link rel="stylesheet" href="../resources/css/galleriffic-3.css" type="text/css" />
		<script type="text/javascript" src="../resources/js/libs/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="../resources/js/libs/jquery.corner.js"></script>
		<script type="text/javascript" src="../resources/js/libs/jquery-ui-1.10.1.custom.js"></script>	
		
		<script type="text/javascript" src="../resources/js/libs/effects.js"></script>
		<script type="text/javascript" src="../resources/js/libs/effectsIndex.js"></script>
		<script type="text/javascript" src="../resources/js/libs/jquery.history.js"></script>
		<script type="text/javascript" src="../resources/js/libs/jquery.galleriffic.js"></script>
		<script type="text/javascript" src="../resources/js/libs/jquery.opacityrollover.js"></script>
		<script type="text/javascript" src="../resources/js/libs/action_gallery.js"></script>		
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
			<div id="content">
				<div id="title_gallery"><a href="Index.php" title="back" id="back_inicio">
					<img src="../resources/img/back.png" alt="Volver" /></a>
					<span><?php echo $_GET['name']?></span>
				</div>
				<!-- Start Advanced Gallery Html Containers -->
				<div id="gallery" class="content">
					<div id="controls" class="controls"></div>
					<div class="slideshow-container">
						<div id="loading" class="loader"></div>
						<div id="slideshow" class="slideshow"></div>
					</div>
					<div id="caption" class="caption-container"></div>
				</div>
				<div id="thumbs" class="navigation">
					<ul class="thumbs noscript">				
						<?php
							for ($i = 1; $i <= 105; $i++) {
								$html = '';
								$path = $initPath . $i. '_a.png';
								if (file_exists($path)){
									$html .= '<li>';
										$html .= '<a class="thumb" href="' .$initPath . $i. '_b.png" title="' .$name. ' ' .$i. '">';
											$html .= '<img src="' .$initPath . $i. '_a.png" alt="' .$name. ' ' .$i. '" />';
										$html .= '</a>';
										$html .= '<div class="caption">';
										$html .= '<div class="image-title">' .$name. ' ' .$i. '</div>';							
										$html .= '</div>';
									$html .= '</li>';
								echo $html;
								}								
							}
						?>
					</ul>					
				</div>
				<!-- End Advanced Gallery Html Containers -->
				<div style="clear: both;"></div>
			</div>
		</div>	
		<div class="clearfix"></div>
		<div id="footer">			
			<div id="info">
				<div id="footer_info_content">
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
		</div>			
	</body>
</html>