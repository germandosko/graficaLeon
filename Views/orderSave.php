<?php

require '../siteConfig.php';
require '../Utils/Bootstrap.php';

Bootstrap::setRequiredFiles();
if (!Security::authenticate()){
	header('Location: login.php?auth=0');
}
$count= '';
$repeat= false;
$session = Session::getInstance();

$order = false;
if(isset($_GET['id']) && !empty($_GET['id']) && (intval($_GET['id']) > 0)){
	$order = OrderModel::FindById(intval($_GET['id']));	
}
if(isset($_GET['type']) && !empty($_GET['type'])){	
		$repeat = true;	
} 
if(isset($_GET['customerId']) && !empty($_GET['customerId']) && (intval($_GET['customerId']) > 0)){
	$customer = CustomerModel::FindById (intval($_GET['customerId']));
} 
$stateTypes = array("Dise&ntilde;o", "Impresion", "Terminado", "Entregado", "BAJA", "PROBLEMAS");
$paperTypes = PaperModel::FetchAll();
$machineTypes = MachineModel::FetchAll(); 
$colorPaperTypes = array("", "Blanco", "Amarillo", "Rosa", "Verde", "Celeste");
$typeTypes = array("", "Factura", "Otros");
$type = '';
$date = '';
$description = '';
$state = '';
$total = '';
$advance = '';
$deliveryDate = '';
$amount = '';
$paper = '';
$colorPaper = '';
$weight = '';
$machine = '';
$termination = '';
$fromNumber = '';
$toNumber = '';
$observation = '';
$facturaControl = '';
if(isset($_POST['type'])){
	$type = $_POST['type'] = trim($_POST['type']);
	if($type == "Factura"){
		$facturaControl = true;
	} else {$facturaControl = false;
	}
}

function save() {

}

if(isset($_POST['date'])){
$date = $_POST['date'] = trim($_POST['date']);
}
if(isset($_POST['description'])){
$description = $_POST['description'] = trim($_POST['description']);
}
if(isset($_POST['state'])){
$state = $_POST['state'] = trim($_POST['state']);
}
if(isset($_POST['total'])){
$total = $_POST['total'] = trim($_POST['total']);
}
if(isset($_POST['advance'])){
$advance = $_POST['advance'] = trim($_POST['advance']);
}
if(isset($_POST['deliveryDate'])){
$deliveryDate = $_POST['deliveryDate'] = trim($_POST['deliveryDate']);
}
if(isset($_POST['amount'])){
$amount= $_POST['amount'] = trim($_POST['amount']);
}
if(isset($_POST['paper'])){
$paper = $_POST['paper'] = trim($_POST['paper']);
}
if(isset($_POST['colorPapel'])){
$colorPaper = $_POST['colorPaper'] = trim($_POST['colorPaper']);
}
if(isset($_POST['weight'])){
$weight = $_POST['weight'] = trim($_POST['weight']);
}
if(isset($_POST['machine'])){
$machine = $_POST['machine'] = trim($_POST['machine']);
}
if(isset($_POST['termination'])){
$termination = $_POST['termination'] = trim($_POST['termination']);
}
if(isset($_POST['fromNumber'])){
$fromNumber = $_POST['fromNumber'] = trim($_POST['fromNumber']);
}
if(isset($_POST['toNumber'])){
$toNumber = $_POST['toNumber'] = trim($_POST['toNumber']);
}
if(isset($_POST['observation'])){
$observation = $_POST['observation'] = trim($_POST['observation']);
}
$cond2 = 'true';
$cond1 = !empty($_POST['type']) && !empty($_POST['date']) && !empty($_POST['state']) && !empty($_POST['total']) && !empty($_POST['amount']) && !empty($_POST['machine']);
if($facturaControl == true) {$cond2 = !empty($_POST['toNumber']) && !empty($_POST['fromNumber']);
			} else {
			$cond2 = true;
			} 	
if($cond1 & $cond2){
		$id = $_POST['id'] = intval($_POST['id']);
		$_POST['customer'] = customerModel::FindById (intval($_GET['customerId']));
		$_POST['user'] = UserModel::FindById($session->userId);
		$order = new Order($_POST);
		OrderModel::Save($order);
		if(!empty($_POST['advance'])){
			$arrayBox = array();
			$arrayBox['date'] = date("d/m/y");;
			$arrayBox['type'] = 'INGRESO';
			$arrayBox['description'] = $description;
			$arrayBox['value'] = $advance;
			$arrayBox['order'] = $order;
			$arrayBox['user'] = UserModel::FindById($session->userId);		
			$box = new Box($arrayBox);
			$boxExist = BoxModel::FindBy(array('orderId'=>$order->getId()), true);
			if(!empty($boxExist)){
			BoxModel::Delete($boxExist->getId());
			BoxModel::Save($box);
			} else {BoxModel::Save($box);
			}		
		}
		header('Location: customerOrders.php?customerId=' . $_GET['customerId']);
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
	<link rel="icon" type="image/png" href="../resources/img/favicon.png"/>
	<link rel="stylesheet" href="../resources/css/reset.css" type="text/css">
	<link rel="stylesheet" href="../resources/css/style.css" type="text/css">	
	<link rel="stylesheet" href="../resources/css/styleWhite.css" type="text/css">	
	<link rel="stylesheet" href="../resources/css/galleriffic-3.css" type="text/css" />
	<link rel="stylesheet" href="../resources/css/jquery-ui-1.7.3.custom.css" type="text/css" />
	<link rel="stylesheet" href="../resources/css/calendar-win2k-cold-1.css" type="text/css" title="win2k-cold-1"/>
	<script type="text/javascript" src="../resources/js/libs/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="../resources/js/libs/jquery-ui-1.7.3.custom.min.js"></script>
	<script type="text/javascript" src="../resources/js/libs/calendar.js"></script>
	<script type="text/javascript" src="../resources/js/libs/calendar-es.js"></script>
	<script type="text/javascript" src="../resources/js/libs/calendar-setup.js"></script>
	<script type="text/javascript">
	jQuery(function($){
			$.datepicker.regional['es'] = {
				closeText: 'Cerrar',
				prevText: '&#x3c;Ant',
				nextText: 'Sig&#x3e;',
				currentText: 'Hoy',
				monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
				'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
				monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
				'Jul','Ago','Sep','Oct','Nov','Dic'],
				dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
				dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
				dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
				weekHeader: 'Sm',
				dateFormat: 'dd/mm/yy',
				firstDay: 1,
				isRTL: false,
				showMonthAfterYear: false,
				yearSuffix: ''};
			$.datepicker.setDefaults($.datepicker.regional['es']);
		});   
		$(document).ready(function() {
		$("#datepicker").datepicker();
		$("#datepicker2").datepicker();
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
				<a href="<?php if(!empty($_GET['backOrder'])) {echo 'orders.php';} else {echo 'customerOrders.php';}?><?php if(!empty($customer)) echo '?customerId='.$customer->getId();?>" title="back"><img src="../resources/img/back.jpg" alt="Volver" /></a>
				<div id="admin">
					<h1>Guardar Servicio a: </h1><h2><?php if(!empty($customer)) echo $customer->getLastName()?></h2>
					<form action="orderSave.php?<?php if(!empty($order)) echo 'id='.$order->getId();?><?php if(!empty($customer)) echo '&customerId='.$customer->getId();?>" method="post">
						<fieldset>
							<input type="hidden" name="id" value="<?php if(!empty($order)) { if($repeat == false) {echo $order->getId();}}?>" />
							<input type="hidden" name="customerId" value="<?php if(!empty($customer)) {echo $customer->getId();}?>" />
							<label for="state">Estado</label>
							<select name="state">
								<?php foreach($stateTypes as $value) { 
									$count .= '<option';
									if(!empty($order) ){
										if($order->getState() == $value && $repeat != true){$count .= ' selected="selected"';}
									}
									if(!empty($state) ){
										if($state == $value && $repeat != true ){$count .= ' selected="selected"';}
									}
									$count .= ' value="';
									$count .= $value;
									$count .= '">';
									$count .= $value;
									$count .= '</option> ';
									echo $count; 
									$count = '';
								}
								?>
							</select>	
							<label for="type">Tipo Trabajo</label>
							<select name="type">
							<?php foreach($typeTypes as $value) { 
								$count .= '<option';
								if(!empty($order) ){
									if($order->getType() == $value){$count .= ' selected="selected"';}
								}
								if(!empty($type) ){
									if($type == $value ){$count .= ' selected="selected"';}
								}
								$count .= ' value="';
								$count .= $value;
								$count .= '">';
								$count .= $value;
								$count .= '</option> ';
								echo $count; 
								$count = '';
							}
							?>
							</select>
							<?php if(isset($_POST['type']) && empty($type)){?> <p class="loginError">Debe ingresar un Tipo</p> <?php } ?>							
							<label for="date">Fecha</label>							
							<input type="text" name="date" id="datepicker" readonly="readonly" value="<?php if(!empty($order) && $repeat != true){ echo html_entity_decode($order->getDate());} else {echo html_entity_decode($date);}?>" />
							<?php if(isset($_POST['date']) && empty($date)){ ?> <p class="loginError">Debe ingresar Fecha</p><?php } ?>	
							<label for="amount">Cantidad</label>
							<input type="text" name="amount" value="<?php if(!empty($order)){ echo html_entity_decode($order->getAmount());} else {echo html_entity_decode($amount);}?>" />
							<?php if(isset($_POST['amount']) && empty($amount)){ ?> <p class="loginError">Debe ingresar Cantidad</p><?php } ?>								
							<label for="description">Descripcion</label>
							<input type="text" name="description" value="<?php if(!empty($order)){ echo html_entity_decode($order->getDescription());} else {echo html_entity_decode($description);}?>" />
							<?php if(isset($_POST['description']) && empty($description)){ ?> <p class="loginError">Debe ingresar Descripcion</p><?php } ?>	
							<!--<input type="text" name="state" value="<?php //if(!empty($order)){ echo html_entity_decode($order->getState());} else {echo html_entity_decode($state);}?>" />-->
							<?php if(isset($_POST['state']) && empty($state)){?> <p class="loginError">Debe ingresar Estado</p> <?php } ?>							
							
							<label for="total">Total</label>
							<input type="text" name="total" value="<?php if(!empty($order)){ echo html_entity_decode($order->getTotal());} else {echo html_entity_decode($total);}?>" />
							<?php if(isset($_POST['total']) && empty($total)){?> <p class="loginError">Debe ingresar Total</p> <?php } ?>							
							<label for="advance">Seña</label>
							<input type="text" name="advance" value="<?php if(!empty($order)){ echo html_entity_decode($order->getAdvance());} else {echo html_entity_decode($advance);}?>" />							
							
							<label for="deliveryDate">Fecha Entrega</label>
							<input type="text" name="deliveryDate" id="datepicker2" readonly="readonly" value="<?php if(!empty($order) && $repeat != true){ echo html_entity_decode($order->getDeliveryDate());} else {echo html_entity_decode($deliveryDate);}?>" />							
							<label for="paper">Papel</label>
							<select name="paper">
								<?php foreach($paperTypes as $pap) { 
									$count .= '<option';
									if(!empty($order) ){
										if($order->getPaper() == $pap->getName()){$count .= ' selected="selected"';}
									}
									if(!empty($paper) ){
										if($paper == $pap->getName()){$count .= ' selected="selected"';}
									}
									$count .= ' value="';
									$count .= $pap->getName();
									$count .= '">';
									$count .= $pap->getName();
									$count .= '</option> ';
									echo $count; 
									$count = '';
								}
								?>
							</select>	
							<label for="colorPaper">Color de Papel</label>
							<select name="colorPaper">
								<?php foreach($colorPaperTypes as $value) { 
									$count .= '<option';
									if(!empty($order) ){
										if($order->getColorPaper() == $value){$count .= ' selected="selected"';}
									}
									if(!empty($colorPaper) ){
										if($colorPaper == $value ){$count .= ' selected="selected"';}
									}
									$count .= ' value="';
									$count .= $value;
									$count .= '">';
									$count .= $value;
									$count .= '</option> ';
									echo $count; 
									$count = '';
								}
								?>
							</select>
							<label for="machine">Tipo Impresi&oacute;n</label>							
							<select name="machine">
								<?php foreach($machineTypes as $mach) { 
									$count .= '<option';
									if(!empty($order) ){
										if($order->getMachine() == $mach->getName()){$count .= ' selected="selected"';}
									}
									if(!empty($machine) ){
										if($machine == $mach->getName()){$count .= ' selected="selected"';}
									}
									$count .= ' value="';
									$count .= $mach->getName();
									$count .= '">';
									$count .= $mach->getName();
									$count .= '</option> ';
									echo $count; 
									$count = '';
								}
								?>
							</select>	
							<?php if(isset($_POST['machine']) && empty($machine)){?> <p class="loginError">Debe ingresar una Maquina</p> <?php } ?>								
							<label for="termination">Terminaci&oacute;n</label>
							<input type="text" name="termination" value="<?php if(!empty($order)){ echo html_entity_decode($order->getTermination());} else {echo html_entity_decode($termination);}?>" />
							<label for="fromNumber">Desde Nº</label>
							<input type="text" name="fromNumber" value="<?php if(!empty($order) && $repeat != true){ echo html_entity_decode($order->getFromNumber());} else {echo html_entity_decode($fromNumber);}?>" />
							<?php if ($facturaControl == true) { if(isset($_POST['fromNumber']) && empty($fromNumber)){ echo '<p class="loginError">Debe ingresar Desde Nº</p>';} } ?>
							<label for="toNumber">Hasta Nº</label>
							<input type="text" name="toNumber" value="<?php if(!empty($order) && $repeat != true){ echo html_entity_decode($order->getToNumber());} else {echo html_entity_decode($toNumber);}?>" />
							<?php if ($facturaControl == true) { if(isset($_POST['toNumber']) && empty($toNumber)){ echo '<p class="loginError">Debe ingresar Hasta Nº</p>';} } ?>
							<label for="observation">Observaci&oacute;n</label>
							<input type="text" name="observation" value="<?php if(!empty($order)){ echo html_entity_decode($order->getObservation());} else {echo html_entity_decode($observation);}?>" />
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