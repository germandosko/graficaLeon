<?php
/**
* @author							
* @version			November 10 , 2012
* @filesource			/Models/PaperModel.php
*/

class PaperModel extends AbstractModel {

	/**
	 * Saves the Paper in the Data Base
	 *
	 * @param	Paper
	 * @static
	 */
	public static function Save(&$paper){
		$id = $paper->getId();
		$properties = array(
			"name" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($paper->getName())) : htmlentities($paper->getName()),
			"value" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($paper->getValue())) : htmlentities($paper->getValue())
			);
		if(!empty($properties["name"]) && !empty($properties["value"])){
			$query = new Query();
			if(!empty($id) && is_int($id)){
				$query->createUpdate('papers', $properties, 'id = "'.$id.'"', true);
				$isExecuted = $query->execute();
				if(!$isExecuted){
					throw new Exception('Unable to update Paper "'.$id.'" in database. (PaperModel::save())');
				}
			} else {
				$query->createInsert('papers', $properties, true);
				$isExecuted = $query->execute();
				if($isExecuted){
					//get the last inserted id
					$query->createSelect(array('MAX(id) as id'), 'papers');
					$value = $query->execute();
					$paper->setId($value['id']);
				} else {
					throw new Exception('Unable to insert Paper in database. (PaperModel::save())');
				}
			}
		} else {
			throw new Exception('Unable to save Paper with empty required values. (PaperModel::save())');
		}
		return true;
	}

	/**
	 * Finds a Paper by id
	 *
	 * @param	int	$id
	 * @return	 Paper
	 * @static
	 */
	public static function FindById($id){
		$query = new Query();
		$query->createSelect(array('*'), 'papers', array(), 'id = "'.$id.'"');
		$paperArray = $query->execute();
		$paper = false;
		if(!empty($paperArray)){
			$paper = self::CreateObjectFromArray($paperArray);
		}
		return $paper;
	}

	/**
	 * Finds stored Paper by specific values
	 *
	 * @param	array|string	$params
	 * @param	bool	$expectsOne
	 * @return	array|Paper
	 * @static
	 */
	public static function FindBy($params, $expectsOne=false){
		$papersArray = array();
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
			$query->createSelect(array('*'), 'papers', null, $where);
			$arrayArraysPaper = $query->execute(true);
			if(!empty($arrayArraysPaper)){
				if($expectsOne){
					return self::CreateObjectFromArray($arrayArraysPaper[0]);
				}
				foreach($arrayArraysPaper as $arrayPaper){
					array_push($papersArray, self::CreateObjectFromArray($arrayPaper));
				}
			} elseif($expectsOne){
				return false;
			}
		}
		return $papersArray;
	}


	/**
	 * Retrieves all Paper stored in the data base
	 *
	 * @return	array|Paper
	 *static
	*/
	public static function FetchAll(){
		$papersArray = array();
		$query = new Query();
		$query->createSelect(array('*'), 'papers');
		$arrayArraysPaper = $query->execute(true);
		if(!empty($arrayArraysPaper)){
			foreach($arrayArraysPaper as $arrayPaper){
				array_push($papersArray, self::CreateObjectFromArray($arrayPaper));
			}
		}
		return $papersArray;
	}

	/**
	 * Deletes Paper by id
	 *
	 * @param	int	$id
	 *static
	 */
	public static function Delete($id){
		$query = new Query();
		$query->createDelete('papers', $id);
		return $query->execute();
	}

	/**
	 *Creates Paper object from the basic properties
	 *
	 * @param	array|string	$properties
	 * @return	Paper
	 *static
	 */
	
	public static function CreateObjectFromArray($properties){
		if(!empty($properties["id"]) && !empty($properties["name"]) && !empty($properties["value"])){
			return new Paper($properties);
		} else {
			throw new Exception('Unable to create Paper with empty values. (PaperModel::CreateObjectFromArray())');
		}
	}

}