<?php
require '../siteConfig.php';
require '../Utils/Bootstrap.php';

Bootstrap::setRequiredFiles();
if (!Security::authenticate()){
	header('Location: login.php?auth=0');
}
$session = Session::getInstance();
if ($session->userName == "German Dosko")
	{$control = true;
	} else{
	$control = False;}
switch ($_GET['objectName']) {
		case 'paper':
			$array = PaperModel::FetchAll();
			break;
		case 'machine':
			$array = MachineModel::FetchAll();
			break;
		case 'design':
			$array = DesignModel::FetchAll();
			break;
		case 'cut':
			$array = CutModel::FetchAll();
			break;
		case 'termination':
			$array = TerminationModel::FetchAll();
			break;
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
	<link rel="stylesheet" href="../resources/css/galleriffic-3.css" type="text/css" />
	<script type="text/javascript" src="../resources/js/libs/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="../resources/js/libs/DeleteMessage.js"></script>
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
			<a href="administrationPrice.php" title="back"><img src="../resources/img/back.jpg" alt="Volver" /></a>
				<span class="title">Administraci&oacute;n de <?php echo ucfirst($_GET['objectName'])?></span>
					<table>
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Valor</th>
								<th class="optPlus">Opciones</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$html = '';
							foreach($array as $object){
								$html .= '<tr>';
								$html .= '<td>'.$object->getName().'</td>';
								$html .= '<td>'.$object->getValue().'</td>';
								$html .= '<td class="optPlus">';
									$html .= '<a href="save.php?id='.$object->getId().'&objectName=' .$_GET['objectName']. '" title="Editar"><img src="../resources/img/edit.jpg" width="24" alt="Editar" /></a>';
									if ($control) {$html .= '<a href="delete.php?id='.$object->getId().'&objectName=' .$_GET['objectName']. '" title="Eliminar" class="delete"><img src="../resources/img/delete.jpg" alt="Eliminar" /></a>';} 
								$html .= '</td>';
							}
							echo $html;
							?>
							<tr class="opt">
								<td colspan="5"><a href="save.php?objectName=<?php echo $_GET['objectName']?>" title="Nuevo"><img src="../resources/img/add.jpg" alt="Nuevo" /></a></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>		
		<div class="clearfix"></div>
		<div id="footer">
		</div>		
	</body>
</html>