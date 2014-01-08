<?php
require '../siteConfig.php';
require '../Utils/Bootstrap.php';

Bootstrap::setRequiredFiles();
$logged = Security::authenticate();

$success = null;
if($_POST){
	if(!empty($_POST['razonsocial']) && !empty($_POST['cuit'])){
		$header = 'From: ' . $_POST['razonsocial'] . " \r\n";
		$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
		$header .= "Mime-Version: 1.0 \r\n";
		$header .= "Content-Type: text/plain";
		$mensaje = "Este mensaje fue enviado por " . $_POST['razonsocial'] . "\r\n";
		$mensaje .= "Razon Social: " . $_POST['razonsocial'] . " \r\n";
		$mensaje .= "Cuit: " . $_POST['cuit'] . " \r\n";
		$mensaje .= "Ing. Brutos: " . $_POST['brutos'] . " \r\n";
		$mensaje .= "Inicio Act.: " . $_POST['inicio'] . " \r\n";
		$mensaje .= "Desde Nº: " . $_POST['numeracion'] . " \r\n";
		$mensaje .= "Cantidad: " . $_POST['cantidad'] . " \r\n";
		$mensaje .= "Tipo: " . $_POST['tipo'] . " \r\n";
		$mensaje .= "Ciudad: " . $_POST['ciudad'] . " \r\n";
		$mensaje .= "Direccion: " . $_POST['direccion'] . " \r\n";
		$mensaje .= "Opcional: " . $_POST['opcional'] . " \r\n";
		$mensaje .= "Telefono: " . $_POST['telefono'] . " \r\n";
		$mensaje .= "Enviado el " . date('d/m/Y', time());
		$para = 'graficacolor@live.com';
		$asunto = 'MENSAJE PAGINA WEB';
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
				<div class="clearfix"></div>
				<div id="presentation">
					<div id="roundLogo">
					</div>					
					<div id="imagen_presentacion">
						<div id="imagen_1"></div>				
						<div id="imagen_2"></div>
						<div id="imagen_3"></div>
						<div id="marca_1"></div>
						<div id="marca_2"></div>				
						<div id="marca_3"></div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
				<div id='contact'>
					<div id='contact_left'>
						<span class='titles' style="color:red;">INFORMACION DE AYUDA</span><br/><br/>
						<span class='titles'>Razon Social: </span><span class='text'>Nombre y Apellido del Titular<br/><span class='example'>Ej.: Maxi Santecchia</span></span><br/><br/><br/>
						<span class='titles'>CUIT: </span><span class='text'>Numero de Cuit<br/><span class='example'>Ej.: 20-12988923-8</span></span><br/><br/><br/>
						<span class='titles'>Ingresos Brutos: </span><span class='text'>Tambien llamado Numero de cuenta, se encuentra en los formularios del API<br/><span class='example'>Ej.: 021-232235-8</span></span><br/><br/><br/>
						<span class='titles'>Cantidad: </span><span class='text'>Cantidad de Facturas - Cada Talonario trae 50 unidades<br/><span class='example'>Ej.: 250 Facturas = 5 Talonarios</span></span><br/><br/><br/>
						<span class='titles'>Tipo de Talonarios: </span><span class='text'>Tipo de factura a Solicitar<br/><span class='example'>Ej.: Factura C</span></span><br/><br/><br/>
						<span class='titles'>Informacion Opcional: </span><span class='text'>En caso de agregar: Nombre Fantasia, Descripcion, Telefono, Mails, Etc<br/><span class='example'>Ej.: Relojeria Rolex / Atencion de 8 a 17hs / Tel.: 4925656 / Email: rolex@gmail.com / Etc</span></span><br/><br/><br/>
					</div>
					<div id='contact_right'>
						<p>FORMULARIO SOLICITUD FACTURA</p>
						<div id='line'></div>
						<form action="invoice.php" method="post" id="contactForm">
							<?php 
							if ($success === true){
								?><p class="success">Su consulta se envio correctamente. Gracias!</p><?php
							} elseif ($success === false){
								?><p class="loginError">Su consulta NO pudo ser enviada.</p><?php
							}
							?>
							<fieldset>
								<label for="razonsocial" class="black">Razon Social</label>
								<input type="text" name="razonsocial" id="razonsocial" class="shadow" required/>
								<label for="cuit" class="black">CUIT</label>
								<input type="text" name="cuit" id="cuit" class="shadow" required/>
								<label for="brutos" class="black">Ingresos Brutos</label>
								<input type="text" name="brutos" id="brutos" class="shadow" required/>
								<label for="inicio" class="black">Fecha Inicio Actividades</label>
								<input type="text" name="inicio" id="inicio" class="shadow" required/>
								<label for="numeracion" class="black">Desde Numero</label>
								<input type="text" name="numeracion" id="numeracion" class="shadow" required/>
								<label for="cantidad" class="black">Cantidad</label>
								<input type="text" name="cantidad" id="cantidad" class="shadow" required/>
								<label for="tipo" class="black">Tipo Talonario</label>
								<input type="text" name="tipo" id="tipo" class="shadow" required/>
								<label for="ciudad" class="black">Ciudad</label>
								<input type="text" name="ciudad" id="ciudad" class="shadow" required/>
								<label for="direccion" class="black">Direcci&oacute;n</label>
								<input type="text" name="direccion" id="direccion" class="shadow" required/>
								<label for="telefono" class="black">Telefono</label>
								<input type="text" name="telefono" id="telefono" class="shadow" required/>
								<label for="number" class="black">Informacion Opcional</label>
								<textarea name="opcional" id="opcional" class="shadow"></textarea>
								<input type="submit" value="Enviar" />
							</fieldset>							
						</form>
					</div>	
					<div class="clearfix"></div>
				</div>
			</div>			
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