<?php
/**  
 * @author Web Design Rosario
 * @version Mar 10 2012
 */

// require_once '../../siteConfig.php';
// require_once '../../services/Utils/class.Bootstrap.php';

// Bootstrap::setRequiredFiles();

// AjaxHandler::Run();
// die();

class AjaxHandler {

	/**
	 * @var		ErrorLogger
	 * @staticvar
	 */
	protected static $ErrorLogger = null;
	
	/**
	 * @var		string
	 * @staticvar
	 */
	protected static $Object = null;
	
	/**
	 * @var		string
	 * @staticvar
	 */
	protected static $Action = null;
	
	/**
	 * @var		array|mixed
	 * @staticvar
	 */
	protected static $Params = null;
	
	/**
	 * @var		string
	 * @staticvar
	 */
	protected static $Result = null;
	
	/**
	 * Runs the ajax handler
	 * 
	 * @static
	 */
	public static function Run(){
		try{
			self::PrepareData();
			self::ExecuteAction();
			self::SendResults();
		} catch (Exception $e){
			self::$ErrorLogger->addFileLog($e->getMessage());
			self::SendResults();
		}
	}

	/**
	 * Prepare the params to execute the requested action
	 * 
	 * @static
	 */
	private static function PrepareData(){
		if(empty($_POST)){
			$_POST = $_GET;
		}
		self::$ErrorLogger = ErrorLogger::getInstance();
		self::$ErrorLogger->setProcessType(Type::FRONTEND);
		if(!empty($_POST['obj']) && !empty($_POST['action'])){
			self::$Object = strtoupper($_POST['obj']);
			self::$Action = $_POST['action'];
		} else {
			throw new Exception('Unable to resolve ajax request, there are missed params.');
		}
		if(!empty($_POST['params'])){
			self::$Params = $_POST['params'];
		}
	}

	/**
	 * Executes the requested action
	 * 
	 * @static
	 */
	private static function ExecuteAction(){
		$action = self::$Action;
		switch (self::$Object){
			case 'PARTNER':
			case 'PARTNERS':
			case 'DTOPARTNER':
				self::$Result = DtoPartnerModel::$action(self::$Params);
				break;
			case 'REGION':
			case 'REGIONS':
			case 'DTOREGION':
				self::$Result = DtoRegionModel::$action(self::$Params);
				break;
			case 'LANGUAGE':
			case 'LANGUAGES':
			case 'DTOLANGUAGE':
				self::$Result = DtoLanguageModel::$action(self::$Params);
				break;
			case 'BUNDLE':
			case 'DTOBUNDLE':
				self::$Result = DtoBundleModel::$action(self::$Params);
				break;
			case 'TYPE':
				self::$Result = TypeModel::$action(self::$Params);
				break;
			case 'LOG':
				//TODO: must be generics
				self::$Result = LogModel::FindByBundleId(self::$Params['id']);
				break;
			default:
				throw new Exception('Unable to recognize Model class "'.self::$Object.'". (AjaxHandler::ExecuteAction)');
		}
	}
	
	/**
	 * Sends the ajax request output
	 * 
	 * @static
	 */
	private static function SendResults(){
		if(self::$ErrorLogger->hasErrors()){
			self::$ErrorLogger->saveErrors();
			echo 'false';
		} else {
			$output = array();
			if(is_array(self::$Result)){
				foreach (self::$Result as $obj){
					array_push($output, $obj->convertToArray());
				}
			} elseif(is_object(self::$Result)) {
				$output = self::$Result->convertToArray();
			} else {
				$output = self::$Result;
			}
			echo json_encode($output);
		}
	}
}
