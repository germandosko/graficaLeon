<?php
require '../siteConfig.php';
require '../Utils/Bootstrap.php';

Bootstrap::setRequiredFiles();
if (!Security::authenticate()){
	header('Location: login.php?auth=0');
}
$session = Session::getInstance();
$object = false;
if(isset($_GET['objectName'])){
	$objectName = $_GET['objectName'];
}
if(isset($_GET['id']) && !empty($_GET['id']) && (intval($_GET['id']) > 0)){
	switch ($_GET['objectName']) {
		case 'paper':
			$object = paperModel::FindById(intval($_GET['id']));	
			break;
		case 'machine':
			$object = machineModel::FindById(intval($_GET['id']));
			break;
		case 'design':
			$object = designModel::FindById(intval($_GET['id']));
			break;
		case 'cut':
			$object = cutModel::FindById(intval($_GET['id']));
			break;
		case 'termination':
			$object = terminationModel::FindById(intval($_GET['id']));
			break;
			}
	} 
$name = '';
$value = '';
					
if(isset($_POST['name'])){
	$name = $_POST['name'] = trim($_POST['name']);
}
if(isset($_POST['value'])){
	$value = $_POST['value'] = trim($_POST['value']);
}

if(!empty($_POST['name']) && !empty($_POST['value'])){
	$id = $_POST['id'] = intval($_POST['id']);
	switch ($_GET['objectName']) {
		case 'paper':
			$paper = new Paper($_POST);
			paperModel::Save($paper);
			header('Location: objectsPrice.php?objectName=paper');
			break;
		case 'machine':
			$machine = new Machine($_POST);
			machineModel::Save($machine);
			header('Location: objectsPrice.php?objectName=machine');
			break;
		case 'design':
			$design = new Design($_POST);
			designModel::Save($design);
			header('Location: objectsPrice.php?objectName=design');
			break;
		case 'cut':
			$cut = new Cut($_POST);
			cutModel::Save($cut);
			header('Location: objectsPrice.php?objectName=cut');
			break;
		case 'termination':
			$termination = new Termination($_POST);
			terminationModel::Save($termination);
			header('Location: objectsPrice.php?objectName=termination');
			break;
			}	
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
				<a href="objectsPrice.php?objectName=<?php echo $objectName?>" title="back"><img src="../resources/img/back.jpg" alt="Volver" /></a>
				<div id="admin">
					<h1><?php if(!empty($object)){
							echo 'Modificar ' . $object->getName();
							} else {
							echo 'Guardar ' . ucfirst($objectName);} ?>
					</h1>
					<form action="save.php?objectName=<?php echo $objectName?>" method="post">
						<fieldset>
							<input type="hidden" name="id" value="<?php if(!empty($object)) echo $object->getId();?>" />
							<label for="name">Nombre</label>
							<input type="text" name="name" value="<?php if(!empty($object)){ echo html_entity_decode($object->getName());} else {echo html_entity_decode($name);}?>" />
							<?php if(isset($_POST['name']) && empty($name)){ ?> <p class="loginError">Debe ingresar Nombre</p><?php } ?>	
							<label for="value">Valor</label>
							<input type="text" name="value" value="<?php if(!empty($object)){ echo html_entity_decode($object->getValue());} else {echo html_entity_decode($value);}?>" />
							<?php if(isset($_POST['value']) && empty($value)){?> <p class="loginError">Debe ingresar un Valor</p> <?php } ?>		
							<input type="submit" value="Guardar" />							
						</fieldset>
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
			</div>
		</div>		
		<div class="clearfix"></div>
		<div id="footer">
		</div>		
	</body>
</html>