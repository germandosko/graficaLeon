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
		switch ($_GET['objectName']) {
			case 'paper':
				PaperModel::Delete($_GET['id']);
				header('Location: objectsPrice.php?objectName=paper');
				break;
			case 'machine':
				MachineModel::Delete($_GET['id']);
				header('Location: objectsPrice.php?objectName=machine');
				break;
			case 'design':
				DesignModel::Delete($_GET['id']);
				header('Location: objectsPrice.php?objectName=design');
				break;
			case 'cut':
				CutModel::Delete($_GET['id']);
				header('Location: objectsPrice.php?objectName=cut');
				break;
			case 'termination':
				TerminationModel::Delete($_GET['id']);
				header('Location: objectsPrice.php?objectName=termination');
				break;
		}	
	}
}