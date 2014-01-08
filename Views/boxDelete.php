<?php
require '../siteConfig.php';
require '../Utils/Bootstrap.php';

Bootstrap::setRequiredFiles();
if (!Security::authenticate()){
	header('Location: /login.php?auth=0');
}
if(isset($_GET['id']) && !empty($_GET['id'])){
	$int = intval($_GET['id']);
	if(!empty($_GET['id'])){
		BoxModel::Delete($_GET['id']);
		header('Location: boxes.php');
	}
}