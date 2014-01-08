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
	<link href='http://fonts.googleapis.com/css?family=Rum+Raisin|Spicy+Rice|Lobster|Bowlby+One+SC|Snowburst+One|Shojumaru' rel='stylesheet' type='text/css'>	
	<script type="text/javascript" src="../resources/js/libs/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="../resources/js/libs/jquery.corner.js"></script>
	
	<script type="text/javascript" src="../resources/js/libs/effectsIndex.js"></script>
	<script type="text/javascript" src="../resources/js/libs/effects.js"></script>
	<script type="text/javascript" src="../resources/js/libs/effects.js"></script>
	<script type="text/javascript" src="../resources/js/libs/jquery-ui-1.10.1.custom.js"></script>	
	</head>
	<body>	
		<div id="header">
			<a id="contacto" href="contact.php">Contacto</a>
			<div id="content_block">
				<div id="block_logo"></div>
				<div id="block_menu">
					<div class="clearfix"></div>
					<nav>
						<ul id="nav">
							<li id="link_tarjetas"><a style="border-top-left-radius:25px" href="#">Tarjetas</a>
								<ul id="submenu_tarjetas">
										<li id="link_personales" class="noBorderRight"><a href="#">Personales</a>
											<ul id="submenu_personales">
												<li class="noBorderRight"><a href="showGallery_tarjetapersonal.php?type=personalesFormal&name=TARJETAS&nbsp;PERSONALES&nbsp;FORMALES">Formal</a></li>
												<li class="noBorderRight"><a href="showGallery_tarjetapersonal.php?type=personalesInformal&name=TARJETAS&nbsp;PERSONALES&nbsp;INFORMALES">Informal</a></li>				
											</ul>
										</li>
										<li class="noBorderRight"><a href="showGallery.php?type=15anios&name=TARJETAS&nbsp;15&nbsp;A&Ntilde;OS">15 A&ntilde;os</a></li>
										<li class="noBorderRight"><a href="showGallery.php?type=bautismo&name=TARJETAS&nbsp;BAUTISMO">Bautismo</a></li>
										<li class="noBorderRight"><a href="showGallery.php?type=casamiento&name=TARJETAS&nbsp;CASAMIENTO">Casamiento</a></li>
										<li class="noBorderRight"><a href="showGallery.php?type=comunion&name=TARJETAS&nbsp;COMUNION">Comunion</a></li>
								</ul>
							</li>
							<li id="link_folletos"><a href="#">Folletos</a>
								<ul id="submenu_folletos">
									<li class="noBorderRight"><a href="showGallery_folletonegro.php?type=tintanegra&name=FOLLETOS&nbsp;TINTA&nbsp;NEGRA">Tinta Negra</a></li>
									<li class="noBorderRight"><a href="showGallery_folleto1color.php?type=1color&name=FOLLETOS&nbsp;1&nbsp;COLOR">1 Color</a></li>
									<li class="noBorderRight"><a href="showGallery_fullcolor.php?type=fullcolor&name=FOLLETOS&nbsp;FULL&nbsp;COLOR">Full Color</a></li>	
								</ul>
							</li>
							<li id="link_talonarios"><a href="#">Talonarios</a>
								<ul id="submenu_talonarios">
									<li class="noBorderRight"><a href="#">Facturas</a></li>
									<li class="noBorderRight"><a href="#">Presupuestos</a></li>
									<li class="noBorderRight"><a href="#">Anotadores</a></li>
									<li class="noBorderRight"><a href="#">Recibos</a></li>
								</ul>
							</li>
							<li id="link_otros"><a href="#">Otros</a>
								<ul id="submenu_otros">
									<li class="noBorderRight"><a href="showGallery_stickers.php?type=etiquetas&name=ETIQUETAS">Etiquetas</a></li>
									<li class="noBorderRight"><a href="showGallery_imanes.php?type=imanes&name=IMANES">Imanes</a></li>
									<li class="noBorderRight"><a href="showGallery.php?type=sobres&name=SOBRES">Sobres</a></li>
									<li class="noBorderRight"><a href="showGallery.php?type=membretados&name=MEMBRETADOS">Membretada</a></li>
									<li class="noBorderRight"><a href="showGallery.php?type=rifas&name=RIFAS">Rifas</a></li>
									<li class="noBorderRight"><a href="showGallery.php?type=carpetas&name=CARPETAS">Carpetas</a></li>
								</ul>
							</li>
							<li id="link_disenos" style="border-right: none;"><a href="#" style="border-top-right-radius:25px; border-right:none">Dise&ntilde;os</a>
								<ul id="submenu_disenos">
									<li class="noBorderRight"><a href="showGallery.php?type=catalogo1&name=CATALOGO&nbsp;DE&nbsp;DISE&Ntilde;OS&nbsp;1">Dise&ntilde;os 1</a></li>
									<li class="noBorderRight"><a href="showGallery.php?type=catalogo2&name=CATALOGO&nbsp;DE&nbsp;DISE&Ntilde;OS&nbsp;2">Dise&ntilde;os 2</a></li>
									<li class="noBorderRight"><a href="showGallery.php?type=catalogo3&name=CATALOGO&nbsp;DE&nbsp;DISE&Ntilde;OS&nbsp;3">Dise&ntilde;os 3</a></li>
									<li class="noBorderRight"><a href="showGallery.php?type=catalogo4&name=CATALOGO&nbsp;DE&nbsp;DISE&Ntilde;OS&nbsp;4">Dise&ntilde;os 4</a></li>
									<li class="noBorderRight"><a href="showGallery.php?type=catalogo5&name=CATALOGO&nbsp;DE&nbsp;DISE&Ntilde;OS&nbsp;1">Dise&ntilde;os 5</a></li>		
								</ul>
							</li>
							<div class="clearfix"></div>
						</ul>
					</nav>		
				</div>
				<div class="clearfix"></div>
			</div>			
			<div id="content">
				<div id='promotion_head'>
					<div id='promotion_move'>
						<span>PROMOCIONES</span>
					</div>
				</div>
				<div class='promotion'>
					<h1>Promo 1</h1>
					<span>200 Tarj. Color <span class="notation">(8,5x5cm) Telada 180grs</span></span><br/><br/><span>2 Tls de Facturas C</span><br/><br/><span>1000 Folletos <span class="notation">(10x15 Cm) Tinta Negra</span></span><br/><br/><span>10 Talonarios<span class="notation"> Anotadores - 10x15cm - Tinta Negra</span></span><br/><br/><span class="option">Opcional: </span><span class="notation">Tarjetas Laser - Ilustracion Brilloso 300Grs + $50</span>
					<div id='price'>$300</div>
				</div>
				<div class='promotion'>
					<h1>Promo 2</h1>
					<span>500 Tarj. Color <span class="notation">(8,5x5cm) Telada 180grs</span></span><br/><br/><span>5 Tls de Facturas C</span><br/><br/><span>2000 Folletos <span class="notation">(10x15 Cm) Tinta Negra</span></span><br/><br/><span>20 Talonarios <span class="notation">Anotadores - 10x15cm - Tinta Negra</span></span><br/><br/><span class="option">Opcional: </span><span class="notation">Tarjetas Laser - Ilustracion Brilloso 300Grs + $100</span>
					<div id='price'>$450</div>
				</div>
				<div class='promotion'>
					<h1>Promo 3</h1>
					<span>200 Tarj. Color <span class="notation">(8,5x5cm) Telada 180grs</span></span><br/><br/><span>200 Imanes<span class="notation"> Color - 6x4cm</span></span><br/><br/><span>1000 Folletos <span class="notation">(10x15 Cm) Tinta Negra</span></span><br/><br/><span>10 Talonarios <span class="notation">Presupuesto - 10x15cm</span></span><br/><br/><span class="option">Opcional: </span><span class="notation">Tarjetas e Imanes Laser + $50</span>
					<div id='price'>$400</div>
				</div>
				<div class='promotion'>
					<h1>Promo 4</h1>
					<span>500 Tarj. Color <span class="notation">(8,5x5cm) Telada 180grs</span></span><br/><br/><span>500 Imanes<span class="notation"> Color - 6x4cm</span></span><br/><br/><span>2000 Folletos <span class="notation">(10x15 Cm) Tinta Negra</span></span><br/><br/><span>20 Talonarios <span class="notation">Presupuesto - 10x15cm</span></span><br/><br/><span class="option">Opcional: </span><span class="notation">Tarjetas e Imanes Laser + $150</span>
					<div id='price'>$600</div>
				</div>
				<div class='promotion'>
					<h1>Promo 5</h1>
					<span>1000 Tarjetas <span class="notation">(8,5x5cm) 350grs - Full Color</span></span><br/><br/><span>1000 Sticker <span class="notation">3,6x6cm - Barniz UV - Full Color</span></span><br/><br/><span>5000 Folletos <span class="notation">(10x15 Cm) Frente - Full Color</span></span><br/><br/><span class="option">Entrega: </span><span class="notation">Entrega: 15 a 20 Dias</span>
					<div id='price'>$1000</div>
				</div>
				<div class='promotion'>
					<h1>Promo 6</h1>
					<span>1000 Tarjetas<span class="notation">(8,5x5cm) 350grs - Full Color</span></span><br/><br/><span>1000 Imanes <span class="notation">3,6x6cm - Barniz UV- Full Color</span></span><br/><br/><span>5000 Folletos <span class="notation">(10x15 Cm) Frente - Full Color</span></span><br/><br/><span class="option">Nota: </span><span class="notation">Entrega: 15 a 20 Dias</span>
					<div id='price'>$1300</div>
				</div>
				<div class="clearfix"></div>
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