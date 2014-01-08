<?php
require '../siteConfig.php';
require '../Utils/Bootstrap.php';

Bootstrap::setRequiredFiles();
if (!Security::authenticate()){
	header('Location: login.php?auth=0');
}

if($_POST['script'] == 0){
	$info = upload_file($_POST, $_FILES);			
	$script = 1;
	$path = $info['path'];
	$pathSave = $info['pathSave'];	
	$type = $_POST['type'];
	$targetName = $info['targetName'];
}
if($_POST['script'] == 1){									
	$save = new ImageSave();
	$save->Save($_POST);
	$script = 2;
	$type = $_POST['type'];
	$path = $_POST['path'];
	$pathSave = $_POST['pathSave'];
	$targetName = $_POST['targetName'];
}
if($_POST['script'] == 2){		
	$save = new ImageSave();
	$result = $save->Save2($_POST);
	if ($result == true){
		header("Location: imagesGallery.php");
	} elseif ($result == false) {			
		$save = new ImageSave();
		$save->Save($_POST);
		$script = 2;
		$type = $_POST['type'];
		$path = $_POST['path'];
		$pathSave = $_POST['pathSave'];
		$targetName = $_POST['targetName'];	
	}
}
function upload_file($post, $files){
		$finalDir = '../resources/img/galleries/' .$post["type"]. '/images/';
		$finalPath  = '../resources/img/galleries/' .$post["type"]. '/gallery/';
		$num = number("../resources/img/galleries/" .$post["type"]. "/images/");	
				//$num = count(glob("../resources/img/galleries/" .$post["type"]. "/images/{*.jpg,*.png}",GLOB_BRACE));	
		$num -= 1;
		$allowedExts = array("jpg", "jpeg", "gif", "png");
		$temp = explode(".", $files["file"]["name"]);
		$extension = end($temp);				
		if ((($files["file"]["type"] == "image/gif") || ($files["file"]["type"]  == "image/jpeg") || ($files["file"]["type"] == "image/png") || ($files["file"]["type"]  == "image/jpg")) && ($files["file"]["size"]  < 3500000) && in_array($extension, $allowedExts)){
			if ($files["file"]["error"]  > 0){
				echo "Return Code: " . $files["error"]["file"] . "<br>";
				} else {
					$targetName = 'modelo' . $num . '.' .$extension;
					move_uploaded_file($_FILES["file"]["tmp_name"],  $finalDir . $targetName);					
					return array('targetName' => $targetName, 'path' =>  $finalDir . $targetName, 'pathSave' => $finalPath);
				}
		} else {
			echo "Invalid file";
		} 
}
function number($path){
	$d = dir($path);
	$count = 0;
	while (false !== ($entry = $d->read())) {
		$count += 1;
	}
	$d->close();
	return $count;
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
	<link rel="stylesheet" href="../resources/css/jquery.Jcrop.css" type="text/css">
	
	<script type="text/javascript" src="../resources/js/libs/jquery.min.js"></script>
	<script type="text/javascript" src="../resources/js/libs/jquery.Jcrop.js"></script>
	<script type="text/javascript" src="../resources/js/libs/jquery.color.js"></script>
	<?php if ($_POST['script'] == 0){ echo '<script type="text/javascript" src="../resources/js/libs/script1.js"></script>'; }?>
	<?php if ($_POST['script'] == 1){ echo '<script type="text/javascript" src="../resources/js/libs/script2.js"></script>'; }?>	
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
				<form action="image.php" method="post" id="form">
					<input type="hidden" name="x" id="x"/>
					<input type="hidden" name="y" id="y"/>
					<input type="hidden" name="w" id="w"/>
					<input type="hidden" name="h" id="h"/>
					<input type="hidden" name="script" value="<?php echo $script;?>"/>
					<input type="hidden" name="path" value="<?php echo $path;?>"/>
					<input type="hidden" name="pathSave" value="<?php echo $pathSave;?>"/>
					<input type="hidden" name="pathSave" value="<?php echo $pathSave;?>"/>
					<input type="hidden" name="targetName" value="<?php echo $targetName;?>"/>
					<input type="hidden" name="type" value="<?php echo $type;?>"/>
					<input type="submit" value="Crop Image" class="btn btn-large btn-inverse" />
				</form>				
				<img src="<?php echo '../resources/img/galleries/' .$_POST["type"]. '/images/' . $targetName; ?>" id="target" />
			</div>
		</div>		
		<div class="clearfix"></div>
		<div id="footer">
		</div>		
	</body>
</html>