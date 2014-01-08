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

if($_POST){
	$order = OrderModel::FindById(1);
	$_POST['order'] = $order; 
	$_POST['User'] = UserModel::FindById($session->userId);		
	$box = new Box($_POST);
	BoxModel::Save($box);
}

$gastos = 0;
$ingresos = 0;

$boxesTotal = BoxModel::FetchAll();
$boxes = BoxModel::FetchAll();
$numTotal = count($boxesTotal);
if($numTotal>30){
	$unsetNums = $numTotal - 30;
	for($i=0; $i<$unsetNums; $i++){
		unset($boxesTotal[$i]);
	}
} 

foreach($boxes as $box){
if($box->getType() == "INGRESO"){
	$ingresos += $box->getValue();
	} else {
	$gastos += $box->getValue();
	}
$total = $ingresos - $gastos;
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
		<div id="header_nav_body">
			<div id="header_nav">
				<div id="logo">
					<p>GRAFICA LEON</p>
				</div>
				<div id="nav_bar">
					<ul class="menu">
						<li><a href="#"><span id="IL_AD6" class="IL_AD">Inicio</span></a></li>
						<li><a id="trabajos" href="#">Trabajos</a>
							<ul id='firstList'>
								<li><a href="#">Facturas</a></li>
								<li><a href="#">Folletos</a></li>
								<li><a href="#">Tarjetas</a></li>
								<li><a href="#">Otros</a></li>
							</ul>
						</li>
						<li><a href="#">Promociones</a></li>
						<li><a href="#">Ubicacion</a></li>
						<li><a href="#">Contacto</a></li>
					</ul>	
					<div class="clearfix"></div>
				</div>			
			</div>
		</div>
		<div id="header">
			<a id="contacto" href="contact.php">Contacto</a>
			<div id="content">
				<a href="administration.php" title="back"><img src="../resources/img/back.jpg" alt="Volver" /></a>
				<span class="title">Caja</span>				
					<table>
						<thead>
							<tr>
								<th>Fecha</th>
								<th>Cliente</th>								
								<th>Descripcion</th>																
								<th>Tipo</th>								
								<th>Valor</th>
								<th class="optPlus">Opciones</th>
								<th class="usr"> </th>
							</tr>
						</thead>
						<tbody>
							<?php
							$html = '';
							foreach($boxesTotal as $box){
								if($box->getType() == 'INGRESO') {$html .= '<tr class="ingreso">';} else {$html .= '<tr class="gasto">';}
								$html .= '<td>'.$box->getDate().'</td>';
								if($box->getType() == 'INGRESO') {$html .= '<td>'.$box->getOrder()->getCustomer()->getLastName().'</td>';} else {$html .= '<td></td>';}							
								$html .= '<td>'.$box->getDescription().'</td>';
								$html .= '<td>'.$box->getType().'</td>';
								$html .= '<td>$ '.$box->getValue().'</td>';
								$html .= '<td class="optPlus">';
								if ($control) {$html .= '<a href="boxDelete.php?id='.$box->getId().'" title="Eliminar" class="delete"><img src="../resources/img/delete.jpg" alt="Eliminar" /></a>';
								} else {
								$html .= '<a Style="visibility:hidden;" href="boxDelete.php?id='.$box->getId().'" title="Eliminar" class="delete"><img src="../resources/img/delete.jpg" alt="Eliminar" /></a>';
								}
								$html .= '</td>';
								$html .= '<td class="usr"><img src="../resources/img/info.jpg" alt="INFO" title="'.$box->getUser()->getName().'" /></td>';
								$html .= '</tr>';
							}
							echo $html;
							?>
						</tbody>
					</table>
				<form action="boxes.php" method="post">
					<fieldset>
						<input  type="hidden" name="id"/>
						<input  type="hidden" name="date" value="<?php echo date("d/m/Y")?>" />					
						<input  type="hidden" name="type" value="GASTO" />
						<label for="description">DESCRIPCION</label>
						<input  type="text" name="description" />
						<label for="value">MONTO</label>
						<input  type="text" name="value" />
						<input type="submit" value="Guardar" />	
					</fieldset>
				</form>
				<div id='boxFooter'>DINERO EN CAJA $<?php if (!empty($total)) echo $total;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COSTO: $<?php if (!empty($total)) echo round(($total/1.5), 2); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GANANCIA: <span>$<?php if (!empty($total)) echo round($total-($total/1.5), 2);?> </span></div>
			</div>
			<div class="clearfix"></div>
		</div>		
		<div class="clearfix"></div>
		<div id="footer">
		</div>		
	</body>
</html>