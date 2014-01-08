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
		$orders = OrderModel::FindBy(array("customerId"=>$_GET['id']));
		foreach($orders as $order){
			$boxes = BoxModel::FindBy(array("orderId"=>$order->getId()));			
			foreach($boxes as $box){
				BoxModel::Delete($box->getId());
				}
			OrderModel::Delete($order->getId());
		}		
		CustomerModel::Delete($_GET['id']);
		header('Location: customers.php');
	}
}


