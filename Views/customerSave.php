<?php
require '../siteConfig.php';
require '../Utils/Bootstrap.php';

Bootstrap::setRequiredFiles();
if (!Security::authenticate()){
	header('Location: login.php?auth=0');
}
$session = Session::getInstance();

$customer = false;
if(isset($_GET['id']) && !empty($_GET['id']) && (intval($_GET['id']) > 0)){
	$customer = CustomerModel::FindById(intval($_GET['id']));	
	} 
$htmlCode = '';
$cuit = '';
$initDate = '';
$numGross_income='';
$name = '';
$lastName = '';
$businessName = '';
$address = '';
$city = '';
$email = '';
$phone = '';
$cellPhone = '';

$customerExists = false;
$citiesTypes = array("", "Villa G. G&aacute;lvez", "Rosario", "Alvear", "Pueblo Esther");								
if(isset($_POST['cuit'])){
	$cuit = $_POST['cuit'] = trim($_POST['cuit']);
}
if(isset($_POST['initDate'])){
	$initDate = $_POST['initDate'] = trim($_POST['initDate']);
}
if(isset($_POST['numGross_income'])){
	$numGross_income = $_POST['numGross_income'] = trim($_POST['numGross_income']);
}
if(isset($_POST['name'])){
	$name = $_POST['name'] = trim($_POST['name']);
}
if(isset($_POST['lastName'])){
	$lastName = $_POST['lastName'] = trim($_POST['lastName']);
}
if(isset($_POST['address'])){
	$address = $_POST['address'] = trim($_POST['address']);
}
if(isset($_POST['businessName'])){
	$businessName = $_POST['businessName'] = trim($_POST['businessName']);
}
if(isset($_POST['city'])){
	$city = $_POST['city'] = trim($_POST['city']);
}
if(isset($_POST['email'])){
	$email = $_POST['email'] = trim($_POST['email']);
}
if(isset($_POST['phone'])){
	$phone = $_POST['phone'] = trim($_POST['phone']);
}
if(isset($_POST['cellPhone'])){
	$cellPhone = $_POST['cellPhone'] = trim($_POST['cellPhone']);
}

if(!empty($_POST['name']) && !empty($_POST['lastName']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['phone'])){
	$id = $_POST['id'] = intval($_POST['id']);
	if(empty($id)){
		$customerExists = CustomerModel::FindBy(array('phone'=>$phone), true);
	}
	if(empty($customerExists)){
		$_POST['user'] = UserModel::FindById($session->userId);
		$customer = new Customer($_POST);
		CustomerModel::Save($customer);
		header('Location: customers.php');
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
				<a href="customers.php" title="back"><img src="../resources/img/back.jpg" alt="Volver" /></a>
				<div id="admin">
					<h1>Guardar Cliente</h1>
					<?php if(!empty($customerExists)) { echo '<strong> El cliente ' . $customerExists->getLastName() . ' YA EXISTE!!</strong>'; } ?>
					<form action="customerSave.php<?php if(!empty($customer)) echo '?id='.$customer->getId();?>" method="post">
						<fieldset>
							<input type="hidden" name="id" value="<?php if(!empty($customer)) echo $customer->getId();?>" />
							<label for="cuit">Cuit</label>
							<input type="text" name="cuit" value="<?php if(!empty($customer)){ echo html_entity_decode($customer->getCuit());} else {echo html_entity_decode($cuit);}?>" /> 
							<label for="numGross_income">Nº de Ingresos Brutos</label>
							<input type="text" name="numGross_income" value="<?php if(!empty($customer)){ echo html_entity_decode($customer->getNumGross_income());} else {echo html_entity_decode($numGross_income);}?>" /> 
							<label for="initDate">Inicio de Actividades</label>
							<input type="text" name="initDate" value="<?php if(!empty($customer)){ echo html_entity_decode($customer->getInitDate());} else {echo html_entity_decode($initDate);}?>" /> 
							<label for="name">Nombre</label>
							<input type="text" name="name" value="<?php if(!empty($customer)){ echo html_entity_decode($customer->getName());} else {echo html_entity_decode($name);}?>" />
							<?php if(isset($_POST['name']) && empty($name)){ ?> <p class="loginError">Debe ingresar Nombre</p><?php } ?>	
							<label for="lastName">Apellido</label>
							<input type="text" name="lastName" value="<?php if(!empty($customer)){ echo html_entity_decode($customer->getLastName());} else {echo html_entity_decode($lastName);}?>" />
							<?php if(isset($_POST['lastName']) && empty($lastName)){?> <p class="loginError">Debe ingresar Apellido</p> <?php } ?>							
							<label for="businessName">Razon Social</label>
							<input type="text" name="businessName" value="<?php if(!empty($customer)){ echo html_entity_decode($customer->getBusinessName());} else {echo html_entity_decode($businessName);}?>" /> 
							<label for="address">Direccion</label>
							<input type="text" name="address" value="<?php if(!empty($customer)){ echo html_entity_decode($customer->getAddress());} else {echo html_entity_decode($address);}?>" />
							<?php if(isset($_POST['address']) && empty($address)){?> <p class="loginError">Debe ingresar Direccion</p> <?php } ?>		
							<label for="city">Ciudad</label>
							<select name="city">
								<?php foreach($citiesTypes as $value) { 
									$htmlCode .= '<option';
									if(!empty($customer) ){
										if($customer->getCity() == $value){$htmlCode .= ' selected="selected"';}
										
									}
									if(!empty($city) ){
										if($city == $value ){$htmlCode .= ' selected="selected"';}
									}
									$htmlCode .= ' value="';
									$htmlCode .= $value;
									$htmlCode .= '">';
									$htmlCode .= $value;
									$htmlCode .= '</option>';
									echo $htmlCode; 
									$htmlCode = '';
								}
								?>
							</select>	
							<?php if(isset($_POST['city']) && empty($city)){?> <p class="loginError">Debe ingresar Ciudad</p> <?php } ?>
							<label for="email">E-mail</label>
							<input type="text" name="email" value="<?php if(!empty($customer)){ echo html_entity_decode($customer->getEmail());} else {echo html_entity_decode($email);}?>" />
							<label for="phone">Telefono</label>
							<input type="text" name="phone" value="<?php if(!empty($customer)){ echo html_entity_decode($customer->getPhone());} else {echo html_entity_decode($phone);}?>" />
							<?php if(isset($_POST['phone']) && empty($phone)){?> <p class="loginError">Debe ingresar Telefono</p> <?php } ?>							
							<label for="cellPhone">Celular</label>
							<input type="text" name="cellPhone" value="<?php if(!empty($customer)){ echo html_entity_decode($customer->getCellPhone());} else {echo html_entity_decode($cellPhone);}?>" />
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