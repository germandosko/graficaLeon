<?php
/**
* @author							
* @version			November 10 , 2012
* @filesource			/Models/DesignModel.php
*/

class DesignModel extends AbstractModel {

	/**
	 * Saves the Design in the Data Base
	 *
	 * @param	Design
	 * @static
	 */
	public static function Save(&$design){
		$id = $design->getId();
		$properties = array(
			"name" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($design->getName())) : htmlentities($design->getName()),
			"value" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($design->getValue())) : htmlentities($design->getValue())
			);
		if(!empty($properties["name"]) && !empty($properties["value"])){
			$query = new Query();
			if(!empty($id) && is_int($id)){
				$query->createUpdate('designs', $properties, 'id = "'.$id.'"', true);
				$isExecuted = $query->execute();
				if(!$isExecuted){
					throw new Exception('Unable to update Design "'.$id.'" in database. (DesignModel::save())');
				}
			} else {
				$query->createInsert('designs', $properties, true);
				$isExecuted = $query->execute();
				if($isExecuted){
					//get the last inserted id
					$query->createSelect(array('MAX(id) as id'), 'designs');
					$value = $query->execute();
					$design->setId($value['id']);
				} else {
					throw new Exception('Unable to insert Design in database. (DesignModel::save())');
				}
			}
		} else {
			throw new Exception('Unable to save Design with empty required values. (DesignModel::save())');
		}
		return true;
	}

	/**
	 * Finds a Design by id
	 *
	 * @param	int	$id
	 * @return	 Design
	 * @static
	 */
	public static function FindById($id){
		$query = new Query();
		$query->createSelect(array('*'), 'designs', array(), 'id = "'.$id.'"');
		$designArray = $query->execute();
		$design = false;
		if(!empty($designArray)){
			$design = self::CreateObjectFromArray($designArray);
		}
		return $design;
	}

	/**
	 * Finds stored Design by specific values
	 *
	 * @param	array|string	$params
	 * @param	bool	$expectsOne
	 * @return	array|Design
	 * @static
	 */
	public static function FindBy($params, $expectsOne=false){
		$designsArray = array();
		if(is_array($params)){
			$whereArray = array();
			foreach ($params as $key => $value){
				if(!empty($value)){
					$parsedValue = self::$IsUsingUtf8 ? htmlentities(utf8_decode($value)) : htmlentities($value);
					array_push($whereArray, $key.' = "'.$parsedValue.'"');
				}
			}
			$where = implode(' AND ', $whereArray);
			$query = new Query();
			$query->createSelect(array('*'), 'designs', null, $where);
			$arrayArraysDesign = $query->execute(true);
			if(!empty($arrayArraysDesign)){
				if($expectsOne){
					return self::CreateObjectFromArray($arrayArraysDesign[0]);
				}
				foreach($arrayArraysDesign as $arrayDesign){
					array_push($designsArray, self::CreateObjectFromArray($arrayDesign));
				}
			} elseif($expectsOne){
				return false;
			}
		}
		return $designsArray;
	}


	/**
	 * Retrieves all Design stored in the data base
	 *
	 * @return	array|Design
	 *static
	*/
	public static function FetchAll(){
		$designsArray = array();
		$query = new Query();
		$query->createSelect(array('*'), 'designs');
		$arrayArraysDesign = $query->execute(true);
		if(!empty($arrayArraysDesign)){
			foreach($arrayArraysDesign as $arrayDesign){
				array_push($designsArray, self::CreateObjectFromArray($arrayDesign));
			}
		}
		return $designsArray;
	}

	/**
	 * Deletes Design by id
	 *
	 * @param	int	$id
	 *static
	 */
	public static function Delete($id){
		$query = new Query();
		$query->createDelete('designs', $id);
		return $query->execute();
	}

	/**
	 *Creates Design object from the basic properties
	 *
	 * @param	array|string	$properties
	 * @return	Design
	 *static
	 */
	
	public static function CreateObjectFromArray($properties){
		if(!empty($properties["id"]) && !empty($properties["name"]) && !empty($properties["value"])){
			return new Design($properties);
		} else {
			throw new Exception('Unable to create Design with empty values. (DesignModel::CreateObjectFromArray())');
		}
	}

}