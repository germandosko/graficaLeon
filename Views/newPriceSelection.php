<?php
require '../siteConfig.php';
require '../Utils/Bootstrap.php';
require 'priceCalculator.php';

Bootstrap::setRequiredFiles();
if (!Security::authenticate()){
	header('Location: login.php?auth=0');
}


$session = Session::getInstance();
$papers = PaperModel::FetchAll();
$impressions = MachineModel::FetchAll();
$designs = DesignModel::FetchAll();
$cuts= CutModel::FetchAll();
$terminations = TerminationModel::FetchAll();


$types = array ('Frente' => 1, 'Frente y Dorso' => 1.5);

$finalValue = 0;
$amount = '';
$width = '';
$height = '';
$paperSelected  = '';
$machineSelected = '';
$designSelected = '';
$cutSelected = '';
if(isset($_POST['amount'])){
	$amount = $_POST['amount'];
}
if(isset($_POST['width'])){
	$width = $_POST['width'];
}
if(isset($_POST['height'])){
	$height = $_POST['height'];
}
if(isset($_POST['paper'])){
	$paperSelected = $_POST['paper'];
}
if(isset($_POST['print'])){
	$machineSelected = $_POST['print'];
}
if(isset($_POST['design'])){
	$designSelected = $_POST['design'];
}
if(isset($_POST['type'])){
	$typeSelected = $_POST['type'];
}
if(isset($_POST['cut'])){
	$cutSelected = $_POST['cut'];
}

if(!empty($_POST['amount']) && !empty($_POST['width']) && !empty($_POST['height'])){ 
	$finalValue = priceCalculator::Calculator($_POST);
}

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
	<link rel="stylesheet" href="../resources/css/styleWhite.css" type="text/css">	
	<script>
		$(document).ready(function() {
			$('ul li:has(ul)').hover(
				function(e)
				{
					$(this).find('ul').css({display: "block"});
				},
				function(e)
				{
					$(this).find('ul').css({display: "none"});
				}
			);
		});
	</script>
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
				<a href="administration.php" title="back"><img src="../resources/img/back.jpg" alt="Volver" /></a>
				<span class="title">Calculo de Precio: <?php if(!empty($finalValue)) echo '$ '. round($finalValue)?></span>
				<form action="newPriceSelection.php" method="post">
						<fieldset>							
							<label for="amount">Cantidad</label>
							<input type="text" name="amount" value="<?php if(!empty($amount)){echo html_entity_decode($amount);}?>" /> 
							<?php if(isset($_POST['amount']) && empty($amount)){?> <p class="loginError">Debe ingresar una Cantidad</p> <?php } ?>
							<label for="height">Alto en Cm</label>
							<input type="text" name="height" value="<?php if(!empty($height)){echo html_entity_decode($height);}?>" /> 
							<?php if(isset($_POST['height']) && empty($height)){?> <p class="loginError">Debe ingresar un Alto</p> <?php } ?>
							<label for="width">Ancho en Cm</label>
							<input type="text" name="width" value="<?php if(!empty($width)){echo html_entity_decode($width);}?>" /> 							
							<?php if(isset($_POST['width']) && empty($width)){?> <p class="loginError">Debe ingresar un Ancho</p> <?php } ?>
							<label for="paper">Tipo de Papel</label>
							<select name="paper">
								<?php foreach($papers as $paper) { 
									$count .= '<option';
									if(!empty($paperSelected) ){
										if($paperSelected == $paper->getId()){$count .= ' selected="selected"';}
									}
									$count .= ' value="';
									$count .= $paper->getId();
									$count .= '">';
									$count .= $paper->getName();
									$count .= '</option> ';
									echo $count; 
									$count = '';
								}
								?>
							</select>	
							<?php if(isset($_POST['paper']) && empty($paper)){?> <p class="loginError">Debe ingresar un Papel</p> <?php } ?>
							<label for="print">Tipo Impresion</label>
							<select name="print">
								<?php foreach($impressions as $print) { 
									$count .= '<option';
									if(!empty($machineSelected) ){
										if($machineSelected == $print->getId()){$count .= ' selected="selected"';}
									}
									$count .= ' value="';
									$count .=  $print->getId();
									$count .= '">';
									$count .= $print->getName();
									$count .= '</option> ';
									echo $count; 
									$count = '';
								}
								?>
							</select>	
							<?php if(isset($_POST['print']) && empty($print)){?> <p class="loginError">Debe ingresar un tipo de Impresi&oacute;n</p> <?php } ?>
							<label for="type">Lados de Impresion</label>
							<select name="type">
								<?php foreach($types as $name => $value) { 
									$count .= '<option';
									if(!empty($typeSelected) ){
										if($typeSelected == $name ){$count .= ' selected="selected"';}
									}
									$count .= ' value="';
									$count .= $name;
									$count .= '">';
									$count .= $name;
									$count .= '</option> ';
									echo $count; 
									$count = '';
								}
								?>
							</select>
							<label for="design">Tipo Dise&ntilde;o</label>
							<select name="design">
								<?php foreach($designs as $design) { 
									$count .= '<option';
									if(!empty($designSelected) ){
										if($designSelected == $design->getId()){$count .= ' selected="selected"';}
									}
									$count .= ' value="';
									$count .= $design->getId();
									$count .= '">';
									$count .= $design->getName();
									$count .= '</option> ';
									echo $count; 
									$count = '';
								}
								?>
							</select><br/>	
							<label for="cut">Tipo Corte Guillotina</label>
							<select name="cut">
								<?php foreach($cuts as $cut) { 
									$count .= '<option';
									if(!empty($cutSelected) ){
										if($cutSelected == $cut->getId()){$count .= ' selected="selected"';}
									}
									$count .= ' value="';
									$count .= $cut->getId();
									$count .= '">';
									$count .= $cut->getName();
									$count .= '</option> ';
									echo $count; 
									$count = '';
								}
								?>
							</select><br/>							
								<?php foreach($terminations as $termination) { 
									$count .= '<input type="checkbox" class="" name="' .$termination->getName(). '" value="' .$termination->getValue(). '">' .$termination->getName(). '</imput><br/><br/>';
									echo $count; 
									$count = '';
								}
								?>
							</select><br/>								
							<input type="submit" value="Ver Precio" />							
						</fieldset>
					</form>
			</div>
		</div>		
		<div class="clearfix"></div>
		<div id="footer">
		</div>		
	</body>
</html>