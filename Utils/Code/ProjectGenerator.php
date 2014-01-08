<?php

//die('Comment this line to use the ProjectGenerator.php file');
require '../../siteConfig.php';
require '../Bootstrap.php';

Bootstrap::SetRequiredFiles();

ProjectGenerator::run();
die();

/**
 * @author			David Curras
 * @version			June 6, 2012
 * @filesource		/Utils/Code/ProjectGenerator.php
 */
class ProjectGenerator {
	
	/**
	 * The root folder full path
	 * 
	 * @var		string
	 */
	protected static $root = array();
	
	/**
	 * The folder basic structure for the project
	 * 
	 * @var		array
	 */
	protected static $folders = array();
	
	/**
	 * The entities that represent the Object Model Classes
	 * 
	 * @var		array
	 */
	protected static $entities = array();
	
	/**
	 * The entries to be inserted in the data base
	 * 
	 * @var		array
	 */
	protected static $inserts = array();
	
	/**
	 * This function handles the process
	 *
	 * @static
	 */
	public static function run(){
		self::$root = dirname(__FILE__) . '/../../';
		self::LoadInitialValues();
		self::CreateFolders(self::$root, self::$folders);
		self::CreateSqlStructure();
		self::CreatePhpClasses();
		self::CreatePhpModels();
		self::CreateJsClasses();
		self::CreateJsModels();
	}
	
	/**
	 * Loads the folders structure and other initial values
	 *
	 * @static
	 */
	public static function LoadInitialValues(){
		self::$folders = Xml::XmlFileToObject(ROOT_FOLDER.'/Docs/folders.xml');
		self::$entities = Xml::XmlFileToObject(ROOT_FOLDER.'/Docs/entities.xml');
		self::$inserts = Xml::XmlFileToObject(ROOT_FOLDER.'/Docs/inserts.xml');
	}
	
	/**
	 * Checks the basic folder structure and fix it if needed
	 *
	 * @var			string 				$root
	 * @var 		array|string		$folderStructure
	 * @static
	 */
	public static function CreateFolders($root, $folders){
		foreach($folders as $folder){
			$folderName = $root . $folder['name'];
			if (!is_dir($folderName)){
				if(mkdir($folderName)){
					echo '<b>Folder created:</b> ' . $folderName;
					if(chmod($folderName, 0775)){
						echo ' - <b>Premissions 0775 added</b>.';
					}
					echo '<br />';
				}
			}
			self::CreateFolders($folderName.'/', $folder);
		}
		echo '<br />Folders for '.$root.' created.<hr /><br />';
	}
	
	/**
	 * Creates the sql tables structure and triggers the sql code generator
	 *
	 * @static
	 */
	public static function CreateSqlStructure(){
		$sqlTables = array();
		foreach(self::$entities as $entity){
			$class = (string) $entity['name'];
			$table = (string) $entity->table['name'];
			$autoincrement = (string) $entity->table['autoincrement'];
			$sqlTables[$table] = array();
			$sqlTables[$table]['fields'] = array();
			$sqlTables[$table]['pk'] = array();
			foreach($entity->pk as $keys){
				$pk = (string)$keys->field['name'];
				array_push($sqlTables[$table]['pk'], $pk);
			}
			$sqlTables[$table]['fk'] = array();
			$sqlTables[$table]['inserts'] = array();
			foreach($entity->fields->field as $field){
				$fieldName = '';
				$fieldType = '';
				$fieldRequired = trim(strtolower($field['required'])) == 'true';
				$fieldLength = '';
				switch (strtoupper($field['type'])) {
					case 'STRING':
						$fieldLength = (string)$field['length'];
					case 'INT':
					case 'FLOAT':
					case 'DATE':
					case 'BOOL':
						$fieldName = (string)$field['name'];
						$fieldType = (string)$field['type'];
						break;
					default:
						$xmlRelatedEntityId = self::$entities->xpath('/entities/entity[@name="'.$field['type'].'"]/pk/field/@name');
						$relatedEntityId = (string) $xmlRelatedEntityId[0]->name;
						$fieldName = strtolower($field['type']) . ucfirst($relatedEntityId);
						$xmlRelatedEntityType = self::$entities->xpath('/entities/entity[@name="'.$field['type'].'"]/fields/field[@name="'.$relatedEntityId.'"]/@type');
						$fieldType = (string) $xmlRelatedEntityType[0]->type;
						if(strtoupper($fieldType) == 'STRING'){
							$xmlRelatedEntityLength = self::$entities->xpath('/entities/entity[@name="'.$field['type'].'"]/fields/field[@name="'.$relatedEntityId.'"]/@length');
							$fieldLength = (string) $xmlRelatedEntityLength[0]->length;
						}
						//Creates the fk //TODO: improve
						$xmlForeingTable = self::$entities->xpath('/entities/entity[@name="'.$field['type'].'"]/table/@name');
						$foreingTable = (string) $xmlForeingTable[0]->name;
						$sqlTables[$table]['fk'][$fieldName] = array($foreingTable, $relatedEntityId);
						break;
				}
				switch (strtoupper($fieldType)) {
					case 'STRING':
						$sqlTables[$table]['fields'][$fieldName] = array('varchar('.$fieldLength.')');
						break;
					case 'INT':
						$sqlTables[$table]['fields'][$fieldName] = array('int(11)');
						break;
					case 'FLOAT':
						$sqlTables[$table]['fields'][$fieldName] = array('decimal(11,3)');
						break;
					case 'DATE':
						$sqlTables[$table]['fields'][$fieldName] = array('datetime');
						break;
					case 'BOOL':
						$sqlTables[$table]['fields'][$fieldName] = array('tinyint(1)');
						break;
					default:
						throw new Exception('Unable to recognize field type. ProjectGenerator::CreateSqlCode');
						break;
				}
				//check if required
				if($fieldRequired){
					array_push($sqlTables[$table]['fields'][$fieldName], 'NOT NULL');
				} else {
					array_push($sqlTables[$table]['fields'][$fieldName], 'DEFAULT NULL');
				}
				//check is pk and autoincrement
				if(in_array($fieldName, $sqlTables[$table]['pk']) && strtolower(trim($autoincrement)) == 'true'){
					array_push($sqlTables[$table]['fields'][$fieldName], 'AUTO_INCREMENT');
				}
			}
			$inserts = self::$inserts->xpath('/inserts/entries[@table="'.$table.'"]/entry');
			foreach($inserts as $entry){
				$data = array();
				foreach($entry->field as $field){
					$fieldData = (string)$field;
					array_push($data, $fieldData);
				}
				array_push($sqlTables[$table]['inserts'], $data);
			}
		}
		SqlGenerator::LoadInitialValues('David Curras', 'taller_eduardo', $sqlTables, self::$root.'Docs/');
		SqlGenerator::run();
		echo '<br /><hr /><br />';
	}
	
	/**
	 * Creates the php classes structure and triggers the php class generator
	 *
	 * @static
	 */
	public static function CreatePhpClasses(){
		$phpEntities = array();
		foreach(self::$entities as $entity){
			$class = (string) $entity['name'];
			$phpEntities[$class] = array();
			foreach($entity->fields->field as $field){
				$fieldName = (string)$field['name'];
				$fieldType = (string)$field['type'];
				if(strtoupper($fieldType) == 'STRING'){
					$fieldLength = (string)$field['length'];
					$phpEntities[$class][$fieldName] = array($fieldType, $fieldLength);
				} else {
					$phpEntities[$class][$fieldName] = array($fieldType);
				}
			}
		}
		PhpClassGenerator::LoadInitialValues('David Curras', $phpEntities, self::$root.'Entities/');
		PhpClassGenerator::run();
		echo '<br /><hr /><br />';
	}
	
	/**
	 * Creates the php model classes structure and triggers the php model generator
	 *
	 * @static
	 */
	public static function CreatePhpModels(){
		$phpModels = array();
		foreach(self::$entities as $entity){
			$class = (string) $entity['name'];
			$phpModels[$class] = array();
			$phpModels[$class]['table'] = (string) $entity->table['name'];
			$autoincrement = (string) $entity->table['autoincrement'];
			//TODO: Make it generic
			$pkName = (string)$entity->pk[0]->field['name'];
			$xmlPkType = self::$entities->xpath('/entities/entity[@name="'.$class.'"]/fields/field[@name="'.$pkName.'"]/@type');
			$pkType = (string) $xmlPkType[0]->type;
			$phpModels[$class]['id'] = array($pkName, $pkType, $autoincrement);
			foreach($entity->fields->field as $field){
				$fieldName = (string)$field['name'];
				$fieldType = (string)$field['type'];
				$fieldRequired = trim(strtolower($field['required'])) == 'true';
				if($fieldName != $pkName){
					switch (strtoupper($fieldType)) {
						case 'STRING':
						case 'INT':
						case 'FLOAT':
						case 'DATE':
						case 'BOOL':
							$phpModels[$class]['fields'][$fieldName] = array($fieldType, $fieldRequired);
							break;
						default:
							$xmlRelatedEntityId = self::$entities->xpath('/entities/entity[@name="'.$fieldType.'"]/pk/field/@name');
							$relatedEntityId = (string) $xmlRelatedEntityId[0]->name;
							$fieldName = strtolower($fieldType) . ucfirst($relatedEntityId);
							$phpModels[$class]['fields'][$fieldName] = array($fieldType, $fieldRequired, $relatedEntityId);
							break;
					}
				}
			}
		}
		PhpModelGenerator::LoadInitialValues('David Curras', $phpModels, self::$root.'Models/');
		PhpModelGenerator::run();
		echo '<br /><hr /><br />';
	}
	
	/**
	 * Creates the js classes structure and triggers the js class generator
	 *
	 * @static
	 */
	public static function CreateJsClasses(){
		$jsEntities = array();
		foreach(self::$entities as $entity){
			$class = (string) $entity['name'];
			$jsEntities[$class] = array();
			foreach($entity->fields->field as $field){
				$fieldName = (string)$field['name'];
				$fieldType = (string)$field['type'];
				switch (strtoupper($fieldType)) {
					case 'STRING':
						$fieldLength = (string)$field['length'];
						$jsEntities[$class][$fieldName] = array('String', $fieldLength);
						break;
					case 'DATE':
						$jsEntities[$class][$fieldName] = array('String', '32');
						break;
					case 'INT':
					case 'FLOAT':
						$jsEntities[$class][$fieldName] = array('Number');
						break;
					case 'BOOL':
						$jsEntities[$class][$fieldName] = array('Bool');
						break;
					case 'ARRAY':
						$jsEntities[$class][$fieldName] = array('Array');
						break;
					default:
						$jsEntities[$class][$fieldName] = array($fieldType);
						break;
				}
			}
		}
		JsClassGenerator::LoadInitialValues('David Curras', $jsEntities, self::$root.'resources/js/entities/');
		JsClassGenerator::run();
		echo '<br /><hr /><br />';
	}
	
	/**
	 * Creates the js model classes structure and triggers the js model generator
	 *
	 * @static
	 */
	public static function CreateJsModels(){
		$jsModels = array();
		foreach(self::$entities as $entity){
			$class = (string) $entity['name'];
			$jsModels[$class] = array();
			foreach($entity->fields->field as $field){
				$fieldName = (string)$field['name'];
				$fieldType = (string)$field['type'];
				switch (strtoupper($fieldType)) {
					case 'STRING':
					case 'DATE':
					case 'INT':
					case 'FLOAT':
					case 'BOOL':
					case 'ARRAY':
						break;
					default:
						array_push($jsModels[$class], $fieldType);
						break;
				}
			}
		}
		JsModelGenerator::LoadInitialValues('David Curras', $jsModels, self::$root.'resources/js/models/');
		JsModelGenerator::run();
		echo '<br /><hr /><br />';
	}
}