<?php
/**  
 * @author 		Web Design Rosario
 * @version 	Mar 01 2012
 * @filesource	/Models/AbstractModel.php
 */

abstract class AbstractModel{
	static public $IsUsingUtf8=false;
	
	/**
	 * Saves an Object in the Data Base
	 * 
	 * @param		Object		$object
	 * @static
	 */
	abstract public static function Save(&$object);
	
	/**
	 * Finds an Object by id
	 * 
	 * @param 		mixed		$id
	 * @return 		Unit
	 * @static
	 */
	abstract public static function FindById($id);
	
	/**
	 * Finds stored Object by specific values
	 * 
	 * @param		array|string 	$data
	 * @return 		array|Object
	 * @static
	 */
	abstract public static function FindBy($data);

	/**
	 * Retrieves all Objects stored into the data base
	 * 
	 * @return		Array|Object
	 * @static
	 */
	abstract public static function FetchAll();

	/**
	 * Intantiates an object from the current class with the database array
	 * 
	 * @return		Array|Object
	 * @static
	 */
	abstract public static function CreateObjectFromArray($databaseArray);
	
	/**
	 * Decodes the html entities with utf8 encode
	 * 
	 * @return		Array|string
	 * @static
	 */
	public static function HtmlEntitiesDecode(&$databaseArray){
		foreach($databaseArray as $key => $value){
			if(is_array($value)){
				self::HtmlEntitiesDecode($databaseArray[$key]);
			} else {
				$databaseArray[$key] = html_entity_decode($value);
			}
		}
	}
}