<?php

/**
 * @author			David Curras
 * @version			June 6, 2012
 * @filesource		/Utils/Code/JsModelGenerator.php
 */
class JsModelGenerator {

	/**
	 * The file author
	 *
	 * @var		string
	 */
	protected static $author = array();

	/**
	 * The Models structure
	 *
	 * @var		array
	 */
	protected static $models = array();

	/**
	 * The folder path where the .js file will be created
	 *
	 * @var		string
	 */
	protected static $folder = array();

	/**
	 * The output code
	 *
	 * @var		string
	 */
	protected static $code = array();
	
	/**
	 * Loads the classes and other initial values
	 *
	 * @param		string		$author
	 * @param		array		$models
	 * @param		string		$folder
	 * @static
	 */
	public static function LoadInitialValues($author, $models, $folder){
		self::$author = $author;
		self::$models = $models;
		self::$folder = $folder;
	}
	
	/**
	 * This function handles the process
	 *
	 * @static
	 */
	public static function run(){
		foreach(self::$models as $class => $innerObjects){
			self::CreateHeader($class);
			self::CreateSave($class);
			self::CreateFindById($class);
			self::CreateFindBy($class);
			self::CreateFindByInnerObjectProperties($class, $innerObjects);
			self::CreateFetchAll($class);
			self::CreateFile($class);
		}
	}
	
	/**
	 * Creates the header
	 *
	 * @param		string		$class
	 * @static
	 */
	public static function CreateHeader($class){
		self::$code = '/**' . "\n";
		self::$code .= ' * This class  performs server queries for ' . $class . "\n";
		self::$code .= ' *' . "\n";
		self::$code .= ' * @author' . "\t\t" . self::$author . "\n";
		self::$code .= ' * @version' . "\t\t" . date("F j, Y"). "\n";
		self::$code .= ' */' . "\n";
		self::$code .= 'var ' . $class . 'Model = function(){ };' . "\n\n";
	}
	
	/**
	 * Creates the Save method
	 *
	 * @param		string		$class
	 * @static
	 */
	public static function CreateSave($class){
		self::$code .= '/**' . "\n";
		self::$code .= ' * Saves a ' . $class . ' in the server'. "\n";
		self::$code .= ' *' . "\n";
		self::$code .= ' * @param' . "\t\t" . $class . "\t\t\t" . lcfirst($class) . "\n";
		self::$code .= ' * @param' . "\t\t" . 'function' . "\t\t" . 'uiFunction' . "\n";
		self::$code .= ' * @param' . "\t\t" . 'object' . "\t\t\t" . 'uiExtraParams' . "\n";
		self::$code .= ' * @static' . "\n";
		self::$code .= ' */' . "\n";
		self::$code .= $class . 'Model.Save = function('. lcfirst($class) .', uiFunction, uiExtraParams){' . "\n";
		self::$code .= "\t" . 'var ajaxParams = {' . "\n";
		self::$code .= "\t\t" . "obj : '". lcfirst($class) ."'," . "\n";
		self::$code .= "\t\t" . "action : 'save'," . "\n";
		self::$code .= "\t\t" . 'params : '. lcfirst($class) . "\n";
		self::$code .= "\t" . '};' . "\n";
		self::$code .= "\t" . 'var callbackFunction = function(data, callbackExtraParams){' . "\n";
		self::$code .= "\t\t\t" . 'if(data){' . "\n";
		self::$code .= "\t\t\t\t" . 'uiFunction(data, callbackExtraParams);' . "\n";
		self::$code .= "\t\t\t" . '} else {' . "\n";
		self::$code .= "\t\t\t\t" . 'console.error("Unable to parse server response.'. $class .'Model.Save()");' . "\n";
		self::$code .= "\t\t\t" . '}' . "\n";
		self::$code .= "\t\t" . '};' . "\n";
		self::$code .= "\t" . 'Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);' . "\n";
		self::$code .= '};' . "\n\n";
	}
	
	/**
	 * Creates the FindById method
	 *
	 * @param		string		$class
	 * @static
	 */
	public static function CreateFindById($class){
		self::$code .= '/**' . "\n";
		self::$code .= ' * Retrieves a ' . $class . ' from the server and gives it to the callback function'. "\n";
		self::$code .= ' *' . "\n";
		self::$code .= ' * @param' . "\t\t" . 'int' . "\t\t\t\t" . lcfirst($class) . 'Id' . "\n";
		self::$code .= ' * @param' . "\t\t" . 'function' . "\t\t" . 'uiFunction' . "\n";
		self::$code .= ' * @param' . "\t\t" . 'object' . "\t\t\t" . 'uiExtraParams' . "\n";
		self::$code .= ' * @static' . "\n";
		self::$code .= ' */' . "\n";
		self::$code .= $class . 'Model.FindById = function('. lcfirst($class) .'Id, uiFunction, uiExtraParams){' . "\n";
		self::$code .= "\t" . 'var ajaxParams = {' . "\n";
		self::$code .= "\t\t" . "obj : '". lcfirst($class) ."'," . "\n";
		self::$code .= "\t\t" . "action : 'FindById'," . "\n";
		self::$code .= "\t\t" . 'params : ' . lcfirst($class) . 'Id' . "\n";
		self::$code .= "\t" . '};' . "\n";
		self::$code .= "\t" . 'var callbackFunction = function(data, callbackExtraParams){' . "\n";
		self::$code .= "\t\t\t" . 'if(data){' . "\n";
		self::$code .= "\t\t\t\t" . 'var genericObject = JSON.parse(data);' . "\n";
		self::$code .= "\t\t\t\t" . 'uiFunction(new ' . $class . '(genericObject), callbackExtraParams);' . "\n";
		self::$code .= "\t\t\t" . '} else {' . "\n";
		self::$code .= "\t\t\t\t" . 'console.error("Unable to parse server response.'. $class .'Model.FindById()");' . "\n";
		self::$code .= "\t\t\t" . '}' . "\n";
		self::$code .= "\t\t" . '};' . "\n";
		self::$code .= "\t" . 'Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);' . "\n";
		self::$code .= '};' . "\n\n";
	}
	
	/**
	 * Creates the FindBy method
	 *
	 * @param		string		$class
	 * @static
	 */
	public static function CreateFindBy($class){
		self::$code .= '/**' . "\n";
		self::$code .= ' * Retrieves ' . $class . 's from the server that matches the queryParams'. "\n";
		self::$code .= ' * filters and gives it to the callback function'. "\n";
		self::$code .= ' *' . "\n";
		self::$code .= ' * @param' . "\t\t" . 'object' . "\t\t\t" . 'queryParams' . "\n";
		self::$code .= ' * @param' . "\t\t" . 'function' . "\t\t" . 'uiFunction' . "\n";
		self::$code .= ' * @param' . "\t\t" . 'object' . "\t\t\t" . 'uiExtraParams' . "\n";
		self::$code .= ' * @static' . "\n";
		self::$code .= ' */' . "\n";
		self::$code .= $class . 'Model.FindBy = function(queryParams, uiFunction, uiExtraParams){' . "\n";
		self::$code .= "\t" . 'var ajaxParams = {' . "\n";
		self::$code .= "\t\t" . "obj : '". lcfirst($class) ."'," . "\n";
		self::$code .= "\t\t" . "action : 'FindBy'," . "\n";
		self::$code .= "\t\t" . 'params : queryParams' . "\n";
		self::$code .= "\t" . '};' . "\n";
		self::$code .= "\t" . 'var callbackFunction = function(data, callbackExtraParams){' . "\n";
		self::$code .= "\t\t\t" . 'if(data){' . "\n";
		self::$code .= "\t\t\t\t" . 'var genericObjectsArray = JSON.parse(data);' . "\n";
		self::$code .= "\t\t\t\t" . 'var '. lcfirst($class) .'sArray = new Array();' . "\n";
		self::$code .= "\t\t\t\t" . '$.each(genericObjectsArray, function(index, genericObject){' . "\n";
		self::$code .= "\t\t\t\t\t" . lcfirst($class) .'sArray.push(new '. $class .'(genericObject));' . "\n";
		self::$code .= "\t\t\t\t" . '});' . "\n";
		self::$code .= "\t\t\t\t" . 'uiFunction('. lcfirst($class) .'sArray, callbackExtraParams);' . "\n";
		self::$code .= "\t\t\t" . '} else {' . "\n";
		self::$code .= "\t\t\t\t" . 'console.error("Unable to parse server response.'. $class .'Model.FindBy()");' . "\n";
		self::$code .= "\t\t\t" . '}' . "\n";
		self::$code .= "\t\t" . '};' . "\n";
		self::$code .= "\t" . 'Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);' . "\n";
		self::$code .= '};' . "\n\n";
	}
	
	/**
	 * Creates the FindBy method
	 *
	 * @param		string				$class
	 * @param		array|string		$innerObjects
	 * @static
	 */
	public static function CreateFindByInnerObjectProperties($class, $innerObjects){
		foreach($innerObjects as $type){
			self::$code .= '/**' . "\n";
			self::$code .= ' * Retrieves ' . $class . 's from the server that matches the queryParams'. "\n";
			self::$code .= ' * filters and gives it to the callback function'. "\n";
			self::$code .= ' *' . "\n";
			self::$code .= ' * @param' . "\t\t" . 'object' . "\t\t\t" . 'queryParams' . "\n";
			self::$code .= ' * @param' . "\t\t" . 'function' . "\t\t" . 'uiFunction' . "\n";
			self::$code .= ' * @param' . "\t\t" . 'object' . "\t\t\t" . 'uiExtraParams' . "\n";
			self::$code .= ' * @static' . "\n";
			self::$code .= ' */' . "\n";
			self::$code .= $class . 'Model.FindBy'.ucfirst($type).'Properties = function(queryParams, uiFunction, uiExtraParams){' . "\n";
			self::$code .= "\t" . 'var ajaxParams = {' . "\n";
			self::$code .= "\t\t" . "obj : '". lcfirst($class) ."'," . "\n";
			self::$code .= "\t\t" . 'action : \'FindBy'.ucfirst($type).'Properties\',' . "\n";
			self::$code .= "\t\t" . 'params : queryParams' . "\n";
			self::$code .= "\t" . '};' . "\n";
			self::$code .= "\t" . 'var callbackFunction = function(data, callbackExtraParams){' . "\n";
			self::$code .= "\t\t\t" . 'if(data){' . "\n";
			self::$code .= "\t\t\t\t" . 'var genericObjectsArray = JSON.parse(data);' . "\n";
			self::$code .= "\t\t\t\t" . 'var '. lcfirst($class) .'sArray = new Array();' . "\n";
			self::$code .= "\t\t\t\t" . '$.each(genericObjectsArray, function(index, genericObject){' . "\n";
			self::$code .= "\t\t\t\t\t" . lcfirst($class) .'sArray.push(new '. $class .'(genericObject));' . "\n";
			self::$code .= "\t\t\t\t" . '});' . "\n";
			self::$code .= "\t\t\t\t" . 'uiFunction('. lcfirst($class) .'sArray, callbackExtraParams);' . "\n";
			self::$code .= "\t\t\t" . '} else {' . "\n";
			self::$code .= "\t\t\t\t" . 'console.error("Unable to parse server response.'. $class .'Model.FindBy'.ucfirst($type).'Properties()");' . "\n";
			self::$code .= "\t\t\t" . '}' . "\n";
			self::$code .= "\t\t" . '};' . "\n";
			self::$code .= "\t" . 'Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);' . "\n";
			self::$code .= '};' . "\n\n";
		}
	}
	
	/**
	 * Creates the FetchAll method
	 *
	 * @param		string		$class
	 * @static
	 */
	public static function CreateFetchAll($class){
		self::$code .= '/**' . "\n";
		self::$code .= ' * Retrieves all ' . $class . 's from the server and gives it to the callback function'. "\n";
		self::$code .= ' *' . "\n";
		self::$code .= ' * @param' . "\t\t" . 'function' . "\t\t" . 'uiFunction' . "\n";
		self::$code .= ' * @param' . "\t\t" . 'object' . "\t\t\t" . 'uiExtraParams' . "\n";
		self::$code .= ' * @static' . "\n";
		self::$code .= ' */' . "\n";
		self::$code .= $class . 'Model.FetchAll = function(uiFunction, uiExtraParams){' . "\n";
		self::$code .= "\t" . 'var ajaxParams = {' . "\n";
		self::$code .= "\t\t" . "obj : '". lcfirst($class) ."'," . "\n";
		self::$code .= "\t\t" . "action : 'FetchAll'," . "\n";
		self::$code .= "\t" . '};' . "\n";
		self::$code .= "\t" . 'var callbackFunction = function(data, callbackExtraParams){' . "\n";
		self::$code .= "\t\t\t" . 'if(data){' . "\n";
		self::$code .= "\t\t\t\t" . 'var genericObjectsArray = JSON.parse(data);' . "\n";
		self::$code .= "\t\t\t\t" . 'var '. lcfirst($class) .'sArray = new Array();' . "\n";
		self::$code .= "\t\t\t\t" . '$.each(genericObjectsArray, function(index, genericObject){' . "\n";
		self::$code .= "\t\t\t\t\t" . lcfirst($class) .'sArray.push(new '. $class .'(genericObject));' . "\n";
		self::$code .= "\t\t\t\t" . '});' . "\n";
		self::$code .= "\t\t\t\t" . 'uiFunction('. lcfirst($class) .'sArray, callbackExtraParams);' . "\n";
		self::$code .= "\t\t\t" . '} else {' . "\n";
		self::$code .= "\t\t\t\t" . 'console.error("Unable to parse server response.'. $class .'Model.FetchAll()");' . "\n";
		self::$code .= "\t\t\t" . '}' . "\n";
		self::$code .= "\t\t" . '};' . "\n";
		self::$code .= "\t" . 'Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);' . "\n";
		self::$code .= '};';
	}
	
	/**
	 * Creates the .js file
	 *
	 * @param		string		$class
	 * @static
	 */
	public static function CreateFile($class){
		$fileName = self::$folder . $class . 'Model.js';
		$fh = fopen($fileName , 'w') or die("can't open file");
		fwrite($fh, self::$code);
		fclose($fh);
		if(is_file($fileName)){
			chmod($fileName, 0774);
		}
		echo '<b>File created:</b>' . $fileName . '<br />';
	}
}

/*
$models = array(
	'Bundle',
	'Language',
	'Log',
	'Metadata',
	'Partner',
	'Region',
	'State',
	'Type',
	'Video'
);
*/