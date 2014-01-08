<?php
require '../siteConfig.php';
require '../Utils/Bootstrap.php';

Bootstrap::setRequiredFiles();
if (!Security::authenticate()){
	header('Location: /login.html?auth=0');
}
if(isset($_GET['id']) && !empty($_GET['id'])){
	$int = intval($_GET['id']);
	if(!empty($_GET['id'])){
		$boxes = BoxModel::FindBy(array("orderId"=>$_GET['id']));			
		foreach($boxes as $box){
			BoxModel::Delete($box->getId());
		}
		OrderModel::Delete($_GET['id']);
		header('Location: customerOrders.php?customerId=' . $_GET['customerId']);
	}
}