<?php
require '../siteConfig.php';
require '../Utils/Bootstrap.php';

Bootstrap::setRequiredFiles();
$logged = Security::authenticate();

$success = null;
if($_POST){
	if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['question'])){
		$header = 'From: ' . $_POST['email'] . " \r\n";
		$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
		$header .= "Mime-Version: 1.0 \r\n";
		$header .= "Content-Type: text/plain";
		$mensaje = "Este mensaje fue enviado por " . $_POST['name'] . "\r\n";
		$mensaje .= "e-mail: " . $_POST['email'] . " \r\n";
		$mensaje .= "Tel.: " . $_POST['telephone'] . " \r\n";
		$mensaje .= "Mensaje: " . $_POST['question'] . " \r\n";
		$mensaje .= "Enviado el " . date('d/m/Y', time());
		$para = 'graficaleon@gmail.com';
		$asunto = 'MENSAJE ENVIADO DESDE LA "PAGINA WEB"';
		if(mail($para, $asunto, $mensaje, $header)){
			$success = true;
		} else {
			$success = false;
		}	
	}
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head profile="http://www.w3.org/2005/10/profile">
	<title>Gr&aacute;fica Leon Online</title>
	<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />
	<meta name="description" content="Empresa de dise&ntilde;o e impresion de trabajos graficos" />
	<meta name="keywords" content="imprenta, grafica, dise&ntilde;o, grafico, galvez, rosario, impresion" />
	<meta name="author" content="Tu Web Rosario - Desarrollo de Sitios y Sistemas Web" />
	<link href='http://fonts.googleapis.com/css?family=Patrick+Hand+SC' rel='stylesheet' type='text/css'>
	<link rel="icon" type="image/png" href="../resources/img/favicon.png"/>	
	<link rel="stylesheet" href="../resources/css/reset.css" type="text/css">
	<link rel="stylesheet" href="../resources/css/style.css" type="text/css">		
	<script type="text/javascript" src="../resources/js/libs/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="../resources/js/libs/jquery.corner.js"></script>
	
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
				<div id="administration">
				<a href="Index.php" title="back" id="back_inicio">
					<img src="../resources/img/back.png" alt="Volver" />
				</a>	
				<?php
					if ($logged){
						?><span class="loginName">Bienvenido <strong><?php echo Session::getInstance()->userName;?></strong></span>
						<a href="logout.php" title="Cerrar Sesi&oacute;n" class="loginButton"><img src="../resources/img/logoutBlack.png" alt="Cerrar Sesi&oacute;n" /></a>
						<a href="administration.php" title="Ingresar" class="loginButton"><img src="../resources/img/process.png" alt="Ingresar" /></a><?php
					} else {
						?>
						<a href="login.php" title="Iniciar Sesi&oacute;n" class="loginButton"><img src="../resources/img/user.png" alt="Iniciar Sesi&oacute;n" /></a><?php
					}
				?>
				</div>
				<div class="clearfix"></div>
				<div id='contact'>
					<div id='contact_right'>
						<h2>FORMULARIO CONTACTO</h2>
						<div id='line'></div>
						<form action="contact.php" method="post" id="contactForm">
							<?php 
							if ($success === true){
								?><p class="success">Su consulta se envio correctamente. Gracias!</p><?php
							} elseif ($success === false){
								?><p class="loginError">Su consulta NO pudo ser enviada.</p><?php
							}
							?>
							<fieldset>
								<label for="name" class="black">Nombre</label>
								<input type="text" name="name" id="name" class="shadow" required/>
								<label for="email" class="black">E-mail</label>
								<input type="email" name="email" id="email" class="shadow" required/>
								<label for="telephone" class="black">Tel&eacute;fono</label>
								<input type="text" name="telephone" id="telephone" class="shadow" />
								<label for="question" class="black">Consulta</label>
								<textarea name="question" id="question" class="shadow" required></textarea>
								<input type="submit" value="Enviar" />
							</fieldset>							
						</form>
					</div>	
					<div class="clearfix"></div>
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