<?php

/**
 * @author			David Curras
 * @version			June 6, 2012
 * @filesource		/Utils/Code/PhpModelGenerator.php
 */
class PhpModelGenerator {

	/**
	 * The file author
	 *
	 * @var		string
	 */
	protected static $author = array();

	/**
	 * The Classes structure
	 *
	 * @var		array
	 */
	protected static $models = array();

	/**
	 * The folder path where the .php file will be created
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
	 * Loads the model structure and other initial values
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
		foreach(self::$models as $class => $data){
			self::CreateHeader($class);
			self::CreateSave($class, $data);
			self::CreateFindById($class, $data);
			self::CreateFindBy($class, $data);
			self::CreateFindByInnerObjectProperties($class, $data);
			self::CreateFetchAll($class, $data);
			self::CreateDelete($class, $data);
			self::GenerateCreateBundleFromArray($class, $data);
			self::$code .= '}';
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
		self::$code = '<?php'."\n";
		self::$code .= '/**'."\n";
		self::$code .= ' * @author'."\t\t".self::$author."\n";
		self::$code .= ' * @version'."\t\t".date("F j, Y"). "\n";
		self::$code .= ' * @filesource'."\t\t".'/Models/'.$class.'Model.php'."\n";
		self::$code .= ' */'."\n\n";
		self::$code .= 'class '.$class.'Model extends AbstractModel {'."\n\n";
	}
	
	/**
	 * Creates the Save method
	 * 
	 * @param		string		$class
	 * @param		array		$data
	 * @static
	 */
	public static function CreateSave($class, $data){
	
		self::$code .= "\t".'/**'."\n";
		self::$code .= "\t".' * Saves the '.$class.' in the Data Base'."\n";
		self::$code .= "\t".' * '."\n";
		self::$code .= "\t".' * @param'."\t\t".$class."\t\t".'$'.lcfirst($class)."\n";
		self::$code .= "\t".' * @static'."\n";
		self::$code .= "\t".' */'."\n";
		self::$code .= "\t".'public static function Save(&$'.lcfirst($class).'){'."\n";
		self::$code .= "\t\t".'$id = $'.lcfirst($class).'->get'.ucfirst($data['id'][0]).'();'."\n";
		$requiredFields = array();
		foreach($data['fields'] as $field => $type){
			if($type[1]){
				array_push($requiredFields, $field);
			}
		}
		$properties = array();
		$nonRequiredObjects = array();
		foreach($data['fields'] as $field => $type){
			switch(strtoupper($type[0])){
				case 'STRING':
					array_push($properties, "\t\t\t\t".'"'.lcfirst($field).'" => htmlentities($'.lcfirst($class).'->get'.ucfirst($field).'())');
					break;
				case 'INT':
				case 'FLOAT':
					array_push($properties, "\t\t\t\t".'"'.lcfirst($field).'" => $'.lcfirst($class).'->get'.ucfirst($field).'()');
					break;
				case 'BOOL':
					array_push($properties, "\t\t\t\t".'"'.lcfirst($field).'" => intval($'.lcfirst($class).'->get'.ucfirst($field).'())');
					break;
				case 'DATE':
					array_push($properties, "\t\t\t\t".'"'.lcfirst($field).'" => Date::ParseDate($'.lcfirst($class).'->get'.ucfirst($field).'())');
					break;
				default:
					if(in_array($field, $requiredFields)){
						array_push($properties, "\t\t\t\t".'"'.lcfirst($field).'" => $'.lcfirst($class).'->get'.$type[0].'()->get'.ucfirst($type[2]).'()');					
					} else {
						array_push($properties, "\t\t\t\t".'"'.lcfirst($field).'" => null');
						$nonRequiredObjects[$field] = $type;
					}
					break;
			}
		}
		self::$code .= "\t\t".'$properties = array('."\n";
		self::$code .= implode(",\n", $properties)."\n";
		self::$code .= "\t\t\t".');'."\n";
		foreach($nonRequiredObjects as $field => $type){
			self::$code .= "\t\t".'if(is_object($'.lcfirst($class).'->get'.$type[0].'())){'."\n";
			self::$code .= "\t\t\t".'$properties["'.lcfirst($field).'"] = $'.lcfirst($class).'->get'.$type[0].'()->get'.ucfirst($type[2]).'();'."\n";
			self::$code .= "\t\t".'}'."\n";
		}
		if(($data['id'][1] == 'int') && ($data['id'][2] == true)){
			self::$code .= "\t\t".'if(!empty($properties["'.implode('"]) && !empty($properties["', $requiredFields).'"])){'."\n";
		} else {
			self::$code .= "\t\t".'if(!empty($id) && !empty($properties["'.implode('"]) && !empty($properties["', $requiredFields).'"])){'."\n";
		}
		self::$code .= "\t\t\t".'$query = new Query();'."\n";
		if(($data['id'][1] == 'int') && ($data['id'][2] == true)){
			self::$code .= "\t\t\t".'if(!empty($id) && is_int($id)){'."\n";
		} else {
			self::$code .= "\t\t\t".'$db'.$class.' = self::FindById($id);'."\n";
			self::$code .= "\t\t\t".'if(!empty($db'.$class.')){'."\n";
		}
		self::$code .= "\t\t\t\t".'$query->createUpdate(\''.$data['table'].'\', $properties, \''.$data['id'][0].' = "\'.$id.\'"\', true);'."\n";
		self::$code .= "\t\t\t\t".'$isExecuted = $query->execute();'."\n";
		self::$code .= "\t\t\t\t".'if(!$isExecuted){'."\n";
		self::$code .= "\t\t\t\t\t".'throw new Exception(\'Unable to update '.$class.' "\'.$'.$data['id'][0].'.\'" in database. ('.$class.'Model::save())\');'."\n";
		self::$code .= "\t\t\t\t".'}'."\n";
		self::$code .= "\t\t\t".'} else {'."\n";
		if(($data['id'][1] != 'int') || ($data['id'][2] != true)){
			self::$code .= "\t\t\t\t".'$properties[\''.$data['id'][0].'\'] = $id;'."\n";
		}
		self::$code .= "\t\t\t\t".'$query->createInsert(\''.$data['table'].'\', $properties, true);'."\n";
		self::$code .= "\t\t\t\t".'$isExecuted = $query->execute();'."\n";
		if(($data['id'][1] == 'int') && ($data['id'][2] == true)){
			self::$code .= "\t\t\t\t".'if($isExecuted){'."\n";
			self::$code .= "\t\t\t\t\t".'//get the last inserted id'."\n";
			self::$code .= "\t\t\t\t\t".'$query->createSelect(array(\'MAX('.$data['id'][0].') as '.$data['id'][0].'\'), \''.$data['table'].'\');'."\n";
			self::$code .= "\t\t\t\t\t".'$value = $query->execute();'."\n";
			self::$code .= "\t\t\t\t\t".'$'.lcfirst($class).'->set'.ucfirst($data['id'][0]).'($value[\''.$data['id'][0].'\']);'."\n";
			self::$code .= "\t\t\t\t".'} else {'."\n";
			self::$code .= "\t\t\t\t\t".'throw new Exception(\'Unable to insert '.$class.' in database. ('.$class.'Model::save())\');'."\n";
			self::$code .= "\t\t\t\t".'}'."\n";
		} else {
			self::$code .= "\t\t\t\t".'if(!$isExecuted){'."\n";
			self::$code .= "\t\t\t\t\t".'throw new Exception(\'Unable to insert '.$class.' in database. ('.$class.'Model::save())\');'."\n";
			self::$code .= "\t\t\t\t".'}'."\n";
		}
		self::$code .= "\t\t\t".'}'."\n";
		self::$code .= "\t\t".'} else {'."\n";
		self::$code .= "\t\t\t".'throw new Exception(\'Unable to save '.$class.' with empty required values. ('.$class.'Model::save())\');'."\n";
		self::$code .= "\t\t".'}'."\n";
		self::$code .= "\t\t".'return true;'."\n";
		self::$code .= "\t".'}'."\n\n";
	}
	
	/**
	 * Creates the FindById method
	 *
	 * @param		string		$class
	 * @param		array		$data
	 * @static
	 */
	public static function CreateFindById($class, $data){
		self::$code .= "\t".'/**'."\n";
		self::$code .= "\t".' * Finds a '.$class.' by id'."\n";
		self::$code .= "\t".' * '."\n";
		self::$code .= "\t".' * @param'."\t\t".'int'."\t\t".'$id'."\n";
		self::$code .= "\t".' * @return'."\t\t".$class."\n";
		self::$code .= "\t".' * @static'."\n";
		self::$code .= "\t".' */'."\n";
		self::$code .= "\t".'public static function FindById($id){'."\n";
		self::$code .= "\t\t".'$query = new Query();'."\n";
		self::$code .= "\t\t".'$query->createSelect(array(\'*\'), \''.$data['table'].'\', array(), \''.$data['id'][0].' = "\'.$id.\'"\');'."\n";
		self::$code .= "\t\t".'$'.lcfirst($class).'Array = $query->execute();'."\n";
		self::$code .= "\t\t".'$'.lcfirst($class).' = false;'."\n";
		self::$code .= "\t\t".'if(!empty($'.lcfirst($class).'Array)){'."\n";
		self::$code .= "\t\t\t".'$'.lcfirst($class).' = self::CreateObjectFromArray($'.lcfirst($class).'Array);'."\n";
		self::$code .= "\t\t".'}'."\n";
		self::$code .= "\t\t".'return $'.lcfirst($class).';'."\n";
		self::$code .= "\t".'}'."\n\n";
	}
	
	/**
	 * Creates the FindBy method
	 *
	 * @param		string		$class
	 * @param		array		$data
	 * @static
	 */
	public static function CreateFindBy($class, $data){
		self::$code .= "\t".'/**'."\n";
		self::$code .= "\t".' * Finds stored '.ucfirst($data['table']).' by specific values'."\n";
		self::$code .= "\t".' * '."\n";
		self::$code .= "\t".' * @param'."\t\t".'array|string'."\t\t".'$params'."\n";
		self::$code .= "\t".' * @param'."\t\t".'bool'."\t\t\t\t".'$expectsOne'."\n";
		self::$code .= "\t".' * @return'."\t\t".'array|'.$class."\n";
		self::$code .= "\t".' * @static'."\n";
		self::$code .= "\t".' */'."\n";
		self::$code .= "\t".'public static function FindBy($params, $expectsOne=false){'."\n";
		self::$code .= "\t\t".'$'.$data['table'].'Array = array();'."\n";
		self::$code .= "\t\t".'if(is_array($params)){'."\n";
		self::$code .= "\t\t\t".'$whereArray = array();'."\n";
		self::$code .= "\t\t\t".'foreach ($params as $key => $value){'."\n";
		self::$code .= "\t\t\t\t".'if(!empty($value)){'."\n";
		self::$code .= "\t\t\t\t\t".'array_push($whereArray, $key.\' = "\'.htmlentities($value).\'"\');'."\n";
		self::$code .= "\t\t\t\t".'}'."\n";
		self::$code .= "\t\t\t".'}'."\n";
		self::$code .= "\t\t\t".'$where = implode(\' AND \', $whereArray);'."\n";
		self::$code .= "\t\t\t".'$query = new Query();'."\n";
		self::$code .= "\t\t\t".'$query->createSelect(array(\'*\'), \''.$data['table'].'\', null, $where);'."\n";
		self::$code .= "\t\t\t".'$arrayArrays'.$class.' = $query->execute(true);'."\n";
		self::$code .= "\t\t\t".'if(!empty($arrayArrays'.$class.')){'."\n";
		self::$code .= "\t\t\t\t".'if($expectsOne){'."\n";
		self::$code .= "\t\t\t\t\t".'return self::CreateObjectFromArray($arrayArrays'.ucfirst($class).'[0]);'."\n";
		self::$code .= "\t\t\t\t".'}'."\n";
		self::$code .= "\t\t\t\t".'foreach($arrayArrays'.$class.' as $array'.ucfirst($class).'){'."\n";
		self::$code .= "\t\t\t\t\t".'array_push($'.$data['table'].'Array, self::CreateObjectFromArray($array'.ucfirst($class).'));'."\n";
		self::$code .= "\t\t\t\t".'}'."\n";
		self::$code .= "\t\t\t".'} elseif($expectsOne){'."\n";
		self::$code .= "\t\t\t\t".'return false;'."\n";
		self::$code .= "\t\t\t".'}'."\n";
		self::$code .= "\t\t".'}'."\n";
		self::$code .= "\t\t".'return $'.$data['table'].'Array;'."\n";
		self::$code .= "\t".'}'."\n\n";
	}
	
	/**
	 * Creates methods to find object by inner object properties
	 *
	 * @param		string		$class
	 * @param		array		$data
	 * @static
	 */
	public static function CreateFindByInnerObjectProperties($class, $data){
		foreach($data['fields'] as $field=>$type){
			if((strtoupper($type[0]) != 'STRING') && (strtoupper($type[0]) != 'INT') && (strtoupper($type[0]) != 'FLOAT') && (strtoupper($type[0]) != 'BOOL') && (strtoupper($type[0]) != 'DATE')){
				self::$code .= "\t".'/**'."\n";
				self::$code .= "\t".' * Finds stored '.ucfirst($data['table']).' by related '.ucfirst($type[0]).' properties'."\n";
				self::$code .= "\t".' * '."\n";
				self::$code .= "\t".' * @param'."\t\t".'array|string'."\t\t".'$params'."\n";
				self::$code .= "\t".' * @param'."\t\t".'bool'."\t\t\t\t".'$expectsOne'."\n";
				self::$code .= "\t".' * @return'."\t\t".'array|'.$class."\n";
				self::$code .= "\t".' * @static'."\n";
				self::$code .= "\t".' */'."\n";
				self::$code .= "\t".'public static function FindBy'.ucfirst($type[0]).'Properties($params, $expectsOne=false){'."\n";
				self::$code .= "\t\t".'$'.$data['table'].'Array = array();'."\n";
				self::$code .= "\t\t".'if(is_array($params)){'."\n";
				self::$code .= "\t\t\t".'$selectFields = array('."\n";
				$properties = array($data['id'][0]);
				foreach($data['fields'] as $tempField=>$tempType){
					array_push($properties, lcfirst($tempField));
				}
				self::$code .= "\t\t\t\t\t'users.".implode("',\n\t\t\t\t\t'users.", $properties)."'\n";
				self::$code .= "\t\t\t\t".');'."\n";
				self::$code .= "\t\t\t".'$joinArray = array(\''.self::$models[$type[0]]['table'].'\'=>\''.self::$models[$type[0]]['table'].'.'.self::$models[$type[0]]['id'][0].' = '.$data['table'].'.'.lcfirst($field).'\');'."\n";
				self::$code .= "\t\t\t".'$whereArray = array();'."\n";
				self::$code .= "\t\t\t".'foreach ($params as $key => $value){'."\n";
				self::$code .= "\t\t\t\t".'if(!empty($value)){'."\n";
				self::$code .= "\t\t\t\t\t".'array_push($whereArray, \''.self::$models[$type[0]]['table'].'.\'.$key.\' = "\'.htmlentities($value).\'"\');'."\n";
				self::$code .= "\t\t\t\t".'}'."\n";
				self::$code .= "\t\t\t".'}'."\n";
				self::$code .= "\t\t\t".'$where = implode(\' AND \', $whereArray);'."\n";
				self::$code .= "\t\t\t".'$query = new Query();'."\n";
				self::$code .= "\t\t\t".'$query->createSelect(array(\'*\'), \''.$data['table'].'\', $joinArray, $where);'."\n";
				self::$code .= "\t\t\t".'$arrayArrays'.$class.' = $query->execute(true);'."\n";
				self::$code .= "\t\t\t".'if(!empty($arrayArrays'.$class.')){'."\n";
				self::$code .= "\t\t\t\t".'if($expectsOne){'."\n";
				self::$code .= "\t\t\t\t\t".'return self::CreateObjectFromArray($arrayArrays'.ucfirst($class).'[0]);'."\n";
				self::$code .= "\t\t\t\t".'}'."\n";
				self::$code .= "\t\t\t\t".'foreach($arrayArrays'.$class.' as $array'.ucfirst($class).'){'."\n";
				self::$code .= "\t\t\t\t\t".'array_push($'.$data['table'].'Array, self::CreateObjectFromArray($array'.ucfirst($class).'));'."\n";
				self::$code .= "\t\t\t\t".'}'."\n";
				self::$code .= "\t\t\t".'} elseif($expectsOne){'."\n";
				self::$code .= "\t\t\t\t".'return false;'."\n";
				self::$code .= "\t\t\t".'}'."\n";
				self::$code .= "\t\t".'}'."\n";
				self::$code .= "\t\t".'return $'.$data['table'].'Array;'."\n";
				self::$code .= "\t".'}'."\n\n";
			}
		}
	}
	
	/**
	 * Creates the FetchAll method
	 *
	 * @param		string		$class
	 * @param		array		$data
	 * @static
	 */
	public static function CreateFetchAll($class, $data){
		self::$code .= "\t".'/**'."\n";
		self::$code .= "\t".' * Retrieves all '.ucfirst($data['table']).' stored in the data base'."\n";
		self::$code .= "\t".' * '."\n";
		self::$code .= "\t".' * @return'."\t\t".'array|'.$class."\n";
		self::$code .= "\t".' * @static'."\n";
		self::$code .= "\t".' */'."\n";
		self::$code .= "\t".'public static function FetchAll(){'."\n";
		self::$code .= "\t\t".'$'.$data['table'].'Array = array();'."\n";
		self::$code .= "\t\t".'$query = new Query();'."\n";
		self::$code .= "\t\t".'$query->createSelect(array(\'*\'), \''.$data['table'].'\');'."\n";
		self::$code .= "\t\t".'$arrayArrays'.$class.' = $query->execute(true);'."\n";
		self::$code .= "\t\t".'if(!empty($arrayArrays'.$class.')){'."\n";
		self::$code .= "\t\t\t".'foreach($arrayArrays'.$class.' as $array'.ucfirst($class).'){'."\n";
		self::$code .= "\t\t\t\t".'array_push($'.$data['table'].'Array, self::CreateObjectFromArray($array'.ucfirst($class).'));'."\n";
		self::$code .= "\t\t\t".'}'."\n";
		self::$code .= "\t\t".'}'."\n";
		self::$code .= "\t\t".'return $'.$data['table'].'Array;'."\n";
		self::$code .= "\t".'}'."\n\n";
	}
	
	/**
	 * Creates the Delete method
	 *
	 * @param		string		$class
	 * @param		array		$data
	 * @static
	 */
	public static function CreateDelete($class, $data){
		self::$code .= "\t".'/**'."\n";
		self::$code .= "\t".' *  Deletes '.ucfirst($class).' by id'."\n";
		self::$code .= "\t".' * '."\n";
		self::$code .= "\t".' * @param'."\t\t".'int'."\t\t".'$id'."\n";
		self::$code .= "\t".' * @static'."\n";
		self::$code .= "\t".' */'."\n";
		self::$code .= "\t".'public static function Delete($id){'."\n";
		self::$code .= "\t\t".'$query = new Query();'."\n";
		if(($data['id'][1] == 'int') && ($data['id'][2] == true)){
			self::$code .= "\t\t".'$query->createDelete(\''.$data['table'].'\', $id);'."\n";
		} else {
			self::$code .= "\t\t".'$query->createDelete(\''.$data['table'].'\', array(\''.$data['id'][0].'\'=>$id));'."\n";
		}
		self::$code .= "\t\t".'return $query->execute();'."\n";
		self::$code .= "\t".'}'."\n\n";
	}
	
	/**
	 * Generates the CreateBundleFromArray method
	 *
	 * @param		string		$class
	 * @param		array		$data
	 * @static
	 */
	public static function GenerateCreateBundleFromArray($class, $data){
		self::$code .= "\t".'/**'."\n";
		self::$code .= "\t".' *  Creates '.ucfirst($class).' object from the basic properties'."\n";
		self::$code .= "\t".' * '."\n";
		self::$code .= "\t".' * @param'."\t\t".'array|string'."\t\t".'$properties'."\n";
		self::$code .= "\t".' * @return'."\t\t".$class."\n";
		self::$code .= "\t".' * @static'."\n";
		self::$code .= "\t".' */'."\n";
		self::$code .= "\t".'public static function CreateObjectFromArray($properties){'."\n";
		$requiredFields = array();
		foreach($data['fields'] as $field=>$type){
			if($type[1]){
				array_push($requiredFields, $field);
			}
		}
		self::$code .= "\t\t".'if(!empty($properties["'.$data['id'][0].'"]) && !empty($properties["'.implode('"]) && !empty($properties["', $requiredFields).'"])){'."\n";
		foreach($data['fields'] as $field=>$type){
			if((strtoupper($type[0]) != 'STRING') && (strtoupper($type[0]) != 'INT') && (strtoupper($type[0]) != 'FLOAT') && (strtoupper($type[0]) != 'BOOL') && (strtoupper($type[0]) != 'DATE')){
				if(in_array($field, $requiredFields)){
					self::$code .= "\t\t\t".'$properties[\''.lcfirst($type[0]).'\'] = '.ucfirst($type[0]).'Model::FindById($properties[\''.$field.'\']);'."\n";
					self::$code .= "\t\t\t".'if(empty($properties[\''.lcfirst($type[0]).'\'])){'."\n";
					self::$code .= "\t\t\t\t".'throw new Exception(\'Unable to find the '.ucfirst($type[0]).' for the '.$class.'.('.$class.'Model::CreateObjectFromArray())\');'."\n";
					self::$code .= "\t\t\t".'}'."\n";
				} else {
					self::$code .= "\t\t\t".'if(!empty($properties[\''.$field.'\'])){'."\n";
					self::$code .= "\t\t\t\t".'$properties[\''.lcfirst($type[0]).'\'] = '.ucfirst($type[0]).'Model::FindById($properties[\''.$field.'\']);'."\n";
					self::$code .= "\t\t\t\t".'if(empty($properties[\''.lcfirst($type[0]).'\'])){'."\n";
					self::$code .= "\t\t\t\t\t".'throw new Exception(\'Unable to find the '.ucfirst($type[0]).' for the '.$class.'.('.$class.'Model::CreateObjectFromArray())\');'."\n";
					self::$code .= "\t\t\t\t".'}'."\n";
					self::$code .= "\t\t\t".'}'."\n";	
				}
			}
		}
		self::$code .= "\t\t\t".'return new '.$class.'($properties);'."\n";
		self::$code .= "\t\t".'} else {'."\n";
		self::$code .= "\t\t\t".'throw new Exception(\'Unable to create '.$class.' with empty values. ('.$class.'Model::CreateObjectFromArray())\');'."\n";
		self::$code .= "\t\t".'}'."\n";
		self::$code .= "\t".'}'."\n";
	}
	
	/**
	 * Creates the .php file
	 *
	 * @param		string		$class
	 * @static
	 */
	public static function CreateFile($class){
		$fileName = self::$folder.$class.'Model.php';
		$fh = fopen($fileName , 'w') or die("can't open file");
		fwrite($fh, self::$code);
		fclose($fh);
		if(is_file($fileName)){
			chmod($fileName, 0774);
		}
		echo '<b>File created:</b>'.$fileName.'<br />';
	}
}

/*
$models = array(
	'Bundle' => array(
		'table' =>'bundles',
		//field, type, autoincrement
		'id' => array('id', 'int', true),
		'fields' => array(
			'metadataId' => array('Metadata', true, 'id'),
			'languageId' => array('Language', false, 'id'),
			'regionId' => array('Region', false, 'id'),
			'partnerId' => array('Partner', true, 'id'),
			'typeId' => array('Type', true, 'id'),
			'stateId' => array('State', true, 'id'),
			'processDate' => array('date', true),
			'entityId' => array('string', false)
		)
	),
	'Language' => array(
		'table' =>'languages',
		'id' => array('code', 'string', false),
		'fields' => array(
			'alt' => array('string', false),
			'name' => array('string', true)
		)
	),
	'Log' => array(
		'table' =>'logs',
		'id' => array('id', 'int', true),
		'fields' => array(
			'bundle' => array('Bundle', true, 'id'),
			'description' => array('string', true),
			'isError' => array('bool', true),
			'active' => array('bool', true)
		)
	),
	'Metadata' => array(
		'table' =>'metadata',
		'id' => array('id', 'int', true),
		'fields' => array(
			'video' => array('Video', true, 'id'),
			'airDate' => array('string', false),
			'archiveStatus' => array('string', false),
			'assetGUID' => array('string', false),
			'assetID' => array('int', false),
			'author' => array('string', false),
			'category' => array('string', false),
			'copyrightHolder' => array('string', false),
			'description' => array('string', false),
			'dTOAssetXMLExportstage1' => array('bool', false),
			'dTOContainerPosition' => array('string', false),
			'dTOEpisodeID' => array('string', false),
			'dTOEpisodeName' => array('string', false),
			'dTOGenre' => array('string', false),
			'dTOLongDescription' => array('string', false),
			'dTOLongEpisodeDescription' => array('string', false),
			'dTORatings' => array('string', false),
			'dTOReleaseDate' => array('string', false),
			'dTOSalesPrice' => array('string', false),
			'dTOSeasonID' => array('string', false),
			'dTOSeasonName' => array('string', false),
			'dTOSeriesDescription' => array('string', false),
			'dTOSeriesID' => array('string', false),
			'dTOShortEpisodeDescription' => array('string', false),
			'dTOShortDescription' => array('string', false),
			'eMDeliveryAsset' => array('bool', false),
			'episodeName' => array('string', false),
			'episodeNumber' => array('int', false),
			'forceDTOexportXML' => array('bool', false),
			'forceDTOproxyAsset' => array('bool', false),
			'genre' => array('string', false),
			'keywords' => array('string', false),
			'licenseStartDate' => array('string', false),
			'localEntity' => array('bool', false),
			'location' => array('string', false),
			'mediaType' => array('string', false),
			'metadataSet' => array('string', false),
			'network' => array('string', false),
			'owner' => array('string', false),
			'ratingsOverride' => array('string', false),
			'ratingSystem' => array('string', false),
			'releaseYear' => array('string', false),
			'seasonDescription' => array('string', false),
			'seasonLanguage' => array('string', false),
			'seasonName' => array('string', false),
			'seasonNumber' => array('string', false),
			'seasonOverride' => array('string', false),
			'seriesDescription' => array('string', false),
			'seriesName' => array('string', false),
			'status' => array('string', false),
			'storeandtrackversionsofthisasset' => array('bool', false),
			'syndicationPartnerDelivery' => array('string', false),
			'title' => array('string', false),
			'tVRating' => array('string', false)
		)
	),
	'Partner' => array(
		'table' =>'partners',
		'id' => array('id', 'int', true),
		'fields' => array(
			'name' => array('string', true)
		)
	),
	'Region' => array(
		'table' =>'regions',
		'id' => array('code', 'string', false),
		'fields' => array(
			'country' => array('string', true),
			'language' => array('Language', true, 'id')
		)
	),
	'State' => array(
		'table' =>'states',
		'id' => array('id', 'int', true),
		'fields' => array(
			'name' => array('string', true)
		)
	),
	'Type' => array(
		'table' =>'types',
		'id' => array('id', 'int', true),
		'fields' => array(
			'name' => array('string', true)
		)
	),
	'Video' => array(
		'table' =>'videos',
		'id' => array('id', 'int', true),
		'fields' => array(
			'audioCodec' => array('string', false),
			'createdBy' => array('string', false),
			'creationDate' => array('string', false),
			'dTOVideoType' => array('string', false),
			'duration' => array('string', false),
			'fileCreateDate' => array('string', false),
			'fileModificationDate' => array('string', false),
			'fileName' => array('string', false),
			'imageSize' => array('string', false),
			'lastAccessed' => array('string', false),
			'lastModified' => array('string', false),
			'mD5Hash' => array('string', true),
			'mD5HashRecal' => array('bool', false),
			'mimeType' => array('string', false),
			'size' => array('string', false),
			'storedOn' => array('string', false),
			'timecodeOffset' => array('string', false),
			'videoBitrate' => array('string', false),
			'videoCodec' => array('string', false),
			'videoElements' => array('string', false),
			'videoFrameRate' => array('string', false)
		)
	)
);
*/
