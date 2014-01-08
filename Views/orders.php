<?php
require '../siteConfig.php';
require '../Utils/Bootstrap.php';

Bootstrap::setRequiredFiles();
if (!Security::authenticate()){
	header('Location: login.php?auth=0');
}
$stateTypes = array("Todos", "Dise&ntilde;o", "Impresion", "Terminado", "Entregado", "BAJA", "PROBLEMAS");
$session = Session::getInstance();
$optionSelected = 'Dise&ntilde;o';
if($_POST){
	$optionSelected = $_POST['state'];
	if ($_POST['state'] == 'Todos') {
		$orders = OrderModel::FetchAll();
		} else { $orders = OrderModel::FindBy(array('state'=>$_POST['state']));
	}
	} else {
		$orders = OrderModel::FindBy(array('state'=>'Dise&ntilde;o'));
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
			<a id="contacto" href="contact.php">Contacto</a>
			<div id="content">
				<a href="administration.php" title="back"><img src="../resources/img/back.jpg" alt="Volver" /></a>
				<form action="orders.php" method="post">
					<label for="state">Ordenar por</label>				
					<select name="state">
								<?php foreach($stateTypes as $value) { 
									$countState .= '<option';
									if(!empty($optionSelected) ){
										if($optionSelected == $value){$countState .= ' selected="selected"';}
									}
									$countState .= ' value="';
									$countState .= $value;
									$countState .= '">';
									$countState .= $value;
									$countState .= '</option> ';
									echo $countState; 
									$countState = '';
								}
								?>
					</select>	
					<input type="submit" value="Buscar" />															
				</form>
				<span class="title">Ordenes de Trabajo</span>				
					<table>
						<thead>
							<tr>
								<th>Estado</th>
								<th>Cliente</th>								
								<th>Empresa</th>
								<th>Cantidad</th>
								<th>Descripci&oacute;n</th>
								<th>Fecha Entrega</th>
								<th class="optPlus">Opciones</th>
								<th class="usr"> </th>
							</tr>
						</thead>
						<tbody>
							<?php
							$html = '';
							foreach($orders as $order){						
								$tempDesc = 'Fecha: ' .$order->getDate(). '\nCliente: ' .$order->getCustomer()->getLastName() . '\nTipo: ' .$order->getType(). '\nEstado: ' .$order->getState(). '\nPrecio: $' .$order->getTotal(). '\nSe�a: $' .$order->getAdvance(). '\nFecha Entrega:' .$order->getDeliveryDate(). '\nCantidad: ' .$order->getAmount(). '\nPapel: ' .$order->getPaper(). '\nGramaje: ' .$order->getWeight(). '\nMaquina: ' .$order->getMachine(). '\nTerminacion: '.$order->getTermination(). '\nDel N�: '.$order->getFromNumber(). '\nAl N�: '.$order->getToNumber(). '\nObservacion: ' .$order->getObservation();								
								switch ($order->getMachine()){
									case 'Offset':
										$html .= '<tr class="offset">';
										break;
									case 'Laser Color':
										$html .= '<tr class="laserColor">';
										break;
									case 'Laser B/N':
										$html .= '<tr class="laserBN">';
										break;
									case 'Chorro Tinta (Liviano)':
										$html .= '<tr class="chorroTinta">';
										break;
									case 'Chorro Tinta (Mucha Tinta)':
										$html .= '<tr class="chorroTinta">';
										break;
									case 'Duplicacion':
										$html .= '<tr class="duplicacion">';
										break;											
								}								
								$html .= '<td>'.$order->getState().'</td>';
								$html .= '<td>'.$order->getCustomer()->getLastName().'</td>';								
								$html .= '<td>'.$order->getCustomer()->getBusinessName().'</td>';	
								$html .= '<td>'.$order->getAmount().'</td>';
								$html .= '<td>'.$order->getDescription().'</td>';
								$html .= '<td>'.$order->getDeliveryDate().'</td>';
								$html .= '<td class="optPlus">';
								$html .= '<a title="Ver Detalle" onclick="alert(\'' .$tempDesc . '\')"><img src="../resources/img/ver.jpg" alt="Ver Detalle" /></a>';																
								$html .= '<a href="orderSave.php?id='.$order->getId(). '&customerId='.$order->getCustomer()->getId(). '&backOrder=true" title="Editar"><img src="../resources/img/edit.jpg" width="24" alt="Editar" /></a>';
								$html .= '</td>';
								$html .= '<td class="usr"><img src="../resources/img/info.jpg" alt="INFO" title="'.$order->getUser()->getName().'" /></td>';
								$html .= '</tr>';
							}
							echo $html;
							?>
							<tr class="opt">
								<td colspan="5"><a href="customers.php" title="Nuevo"><img src="../resources/img/add.jpg" alt="Nuevo" /></a></td>
							</tr>
						</tbody>
					</table>
			</div>
			<div class="clearfix"></div>
		</div>	
		<div class="clearfix"></div>
		<div id="footer"></div>		
	</body>
</html>