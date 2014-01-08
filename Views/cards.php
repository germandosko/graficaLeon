<?php
require '../siteConfig.php';
require '../Utils/Bootstrap.php';

Bootstrap::setRequiredFiles();
$logged = Security::authenticate();
$images = ImageModel::FindBy(array('page'=>'Tarjeta_Personal'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head profile="http://www.w3.org/2005/10/profile">
	<title>Gr&aacute;fica Le&oacute;n Web</title>
	<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />
	<meta name="description" content="Empresa de dise&ntilde;o e impresion de trabajos graficos" />
	<meta name="keywords" content="imprenta, grafica, dise&ntilde;o, grafico, galvez, rosario, impresion" />
	<meta name="author" content="Tu Web Rosario - Desarrollo de Sitios y Sistemas Web" />
	<link rel="icon" type="image/png" href="../resources/img/favicon.png"/>
	<link rel="stylesheet" href="../resources/css/reset.css" type="text/css">
	<link rel="stylesheet" href="../resources/css/style.css" type="text/css">		
	<link rel="stylesheet" href="../resources/css/galleriffic-3.css" type="text/css" />
	<script type="text/javascript" src="../resources/js/libs/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="../resources/js/libs/jquery.history.js"></script>
	<script type="text/javascript" src="../resources/js/libs/jquery.galleriffic.js"></script>
	<script type="text/javascript" src="../resources/js/libs/jquery.opacityrollover.js"></script>
	<script type="text/javascript" src="../resources/js/libs/action_gallery.js"></script>
	<script type="text/javascript" src="../resources/js/libs/action_menu.js"></script>
	</head>
	<body>	
		<div id="header_nav_body">
			<div id="header_nav">
				<div id="logo">
					<p>GRAFICA LEON</p>
				</div>
				<div id="nav_bar">
					<ul class="menu">
						<li><a href="#"><span id="IL_AD6" class="IL_AD">Inicio</span></a></li>
						<li><a href="#">Trabajos</a>
							<ul>
								<li><a href="#">Facturas</a></li>
								<li><a href="#">Folletos</a></li>
								<li><a href="#">Tarjetas</a></li>
								<li><a href="#">Otros</a></li>
							</ul>
						</li>
						<li><a href="#">Promociones</a></li>
						<li><a href="#">Ubicacion</a></li>
						<li><a href="#">Contacto</a></li>
					</ul>	
					<div class="clearfix"></div>
				</div>			
			</div>
		</div>
		<div id="header">
			<a id="contacto" href="contact.php">Contacto</a>
			<div id="content">
				<div id="title_gallery"><span>Galeria de Tarjetas Personales</span></div>

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
						<li>
							<a class="thumb" name="drop" href="http://farm3.static.flickr.com/2404/2538171134_2f77bc00d9.jpg" title="Title #1">
								<img src="http://farm3.static.flickr.com/2404/2538171134_2f77bc00d9_s.jpg" alt="Title #1" />
							</a>
							<div class="caption">
								<div class="download">
									<a href="http://farm3.static.flickr.com/2093/2538168854_f75e408156_b.jpg">Download Original</a>
								</div>
								<div class="image-title">Title #1</div>
								<div class="image-desc">Se ve bien esto?</div>
							</div>
						</li>
						<li>
							<a class="thumb" name="bigleaf" href="http://farm3.static.flickr.com/2093/2538168854_f75e408156.jpg" title="Title #2">
								<img src="http://farm3.static.flickr.com/2093/2538168854_f75e408156_s.jpg" alt="Title #2" />
							</a>
							<div class="caption">
								<div class="download">
									<a href="http://farm3.static.flickr.com/2093/2538168854_f75e408156_b.jpg">Download Original</a>
								</div>
								<div class="image-title">Title #2</div>
								<div class="image-desc">Description</div>
							</div>
						</li>
						<li>
							<a class="thumb" name="lizard" href="http://farm4.static.flickr.com/3153/2538167690_c812461b7b.jpg" title="Title #3">
								<img src="http://farm4.static.flickr.com/3153/2538167690_c812461b7b_s.jpg" alt="Title #3" />
							</a>
							<div class="caption">
								<div class="download">
									<a href="http://farm4.static.flickr.com/3153/2538167690_c812461b7b_b.jpg">Download Original</a>
								</div>
								<div class="image-title">Title #3</div>
								<div class="image-desc">Description</div>
							</div>
						</li>
						<li>
							<a class="thumb" href="http://farm4.static.flickr.com/3150/2538167224_0a6075dd18.jpg" title="Title #4">
								<img src="http://farm4.static.flickr.com/3150/2538167224_0a6075dd18_s.jpg" alt="Title #4" />
							</a>
							<div class="caption">
								<div class="download">
									<a href="http://farm4.static.flickr.com/3150/2538167224_0a6075dd18_b.jpg">Download Original</a>
								</div>
								<div class="image-title">Title #4</div>
								<div class="image-desc">Description</div>
							</div>
						</li>
						<li>
							<a class="thumb" href="http://farm4.static.flickr.com/3204/2537348699_bfd38bd9fd.jpg" title="Title #5">
								<img src="http://farm4.static.flickr.com/3204/2537348699_bfd38bd9fd_s.jpg" alt="Title #5" />
							</a>
							<div class="caption">
								<div class="download">
									<a href="http://farm4.static.flickr.com/3204/2537348699_bfd38bd9fd_b.jpg">Download Original</a>
								</div>
								<div class="image-title">Title #5</div>
								<div class="image-desc">Description</div>
							</div>
						</li>					
						<?php
						$html = '';
							foreach($images as $image){						
							$html .= '<li>';
								$html .= '<a class="thumb" href="../resources/img/' .$image->getBigPath(). '" title="' .$image->getAltText(). '">';
									$html .= '<img src="../resources/img/' .$image->getSmallPath(). '" alt="' .$image->getAltText(). '" />';
								$html .= '</a>';
								$html .= '<div class="caption">';	
									$html .= '<div class="download">';	
										$html .= '<a href="../resources/img/' .$image->getDownloadPath(). '">Ver m&aacute;s GRANDE</a>';
									$html .= '</div>';					
									$html .= '<div class="image-title">' .$image->getAltText(). '</div>';
								$html .= '<div class="image-desc">' .$image->getDescription(). '</div>';								
								$html .= '</div>';
							$html .= '</li>';
							}
							echo $html;
							?>
					</ul>					
				</div>
				<!-- End Advanced Gallery Html Containers -->
				<div style="clear: both;"></div>
			</div>
			</div>
		</div>		
		<div class="clearfix"></div>
		<div id="footer">			
			<div id="info">
				<span class="footerText">Juan B. Justo 2256 - Villa Gdor. Galvez - Santa Fe - Argentina</span>
				<span class="footerText">Tel.: (0341) 4925877   e-mail: graficaleon@gmail.com </span>
			</div>
		</div>			
	</body>
</html>