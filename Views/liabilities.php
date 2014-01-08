<?php
require '../siteConfig.php';
require '../Utils/Bootstrap.php';

Bootstrap::setRequiredFiles();
if (!Security::authenticate()){
	header('Location: login.php?auth=0');
}
$customers = array();
$session = Session::getInstance();
$AllCustomers = CustomerModel::FetchAll();
foreach ($AllCustomers as $cust){
	$orders =  OrderModel::FindBy(array('customerId'=>$cust->getId()));
	$control = false;
	foreach ($orders as $ord){	
		if($ord->getAdvance() < $ord->getTotal() && $ord->getState() == 'Entregado') {$control = true;}		
	}
	if ($control == true) {array_push($customers, $cust);}
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
	<script type="text/javascript" src="../resources/js/libs/CustomerDeleteMessage.js"></script>
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
				<span class="title">Deuda de Clientes Pendientes</span><br/><br/>
					<?php
					$html='';
					foreach($customers as $custom){
					$html .= '<span class="negrita">Cliente:</span> <span>' .$custom->getName(). ' ' .$custom->getLastName(). '</span>';
					$html .= '<span class="negrita">  /  Tel:</span> <span>' .$custom->getPhone(). '</span>';
					$html .= '<span class="negrita">  /  Trabajos: </span><a href="customerOrders.php?customerId='.$custom->getId().'" title="Trabajos"><img src="../resources/img/process.jpg" alt="Trabajos" /></a>';
					$html .= '<table>';
						$html .= '<thead>';
							$html .= '<tr>';
								$html .= '<th>Fecha</th>';
								$html .= '<th>Estado</th>';
								$html .= '<th>Cantidad</th>';
								$html .= '<th>Descripcion</th>';
								$html .= '<th>Total</th>';
								$html .= '<th>Seña</th>';
							$html .= '<tr>';
						$html .= '<thead>';
						$html .= '<tbody>';
							$customerOrders = OrderModel::FindBy(array('customerId'=>$custom->getId()));
							$money = 0;
							foreach($customerOrders as $order){
								if($order->getState() == 'Entregado'){
								$html .= '<tr>';
									$html .= '<td>'.$order->getDate().'</td>';
									$html .= '<td>'.$order->getState().'</td>';
									$html .= '<td>'.$order->getAmount().'</td>';
									$html .= '<td>'.$order->getDescription().'</td>';
									$html .= '<td>'.$order->getTotal().'</td>';
									$html .= '<td>'.$order->getAdvance().'</td>';
									if($order->getAdvance() < $order->getTotal()) {
										$money += ($order->getTotal() - $order->getAdvance());
									}
								$html .= '<tr>';
								}
							}
						$html .= '</tbody>';
					$html .= '</table>';
					$html .= '<span class="result"> El cliente debe:  $' .$money. '</span><br/><br/><br/><br/>';					
					}
					echo $html;
					?>
			</div>
			<div class="clearfix"></div>
		</div>		
		<div class="clearfix"></div>
		<div id="footer"></div>		
	</body>
</html>