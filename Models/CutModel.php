<?php
/**
* @author							
* @version			November 10 , 2012
* @filesource			/Models/CutModel.php
*/

class CutModel extends AbstractModel {

	/**
	 * Saves the Cut in the Data Base
	 *
	 * @param	Cut
	 * @static
	 */
	public static function Save(&$cut){
		$id = $cut->getId();
		$properties = array(
			"name" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($cut->getName())) : htmlentities($cut->getName()),
			"value" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($cut->getValue())) : htmlentities($cut->getValue())
			);
		if(!empty($properties["name"]) && !empty($properties["value"])){
			$query = new Query();
			if(!empty($id) && is_int($id)){
				$query->createUpdate('cuts', $properties, 'id = "'.$id.'"', true);
				$isExecuted = $query->execute();
				if(!$isExecuted){
					throw new Exception('Unable to update Cut "'.$id.'" in database. (CutModel::save())');
				}
			} else {
				$query->createInsert('cuts', $properties, true);
				$isExecuted = $query->execute();
				if($isExecuted){
					//get the last inserted id
					$query->createSelect(array('MAX(id) as id'), 'cuts');
					$value = $query->execute();
					$cut->setId($value['id']);
				} else {
					throw new Exception('Unable to insert Cut in database. (CutModel::save())');
				}
			}
		} else {
			throw new Exception('Unable to save Cut with empty required values. (CutModel::save())');
		}
		return true;
	}

	/**
	 * Finds a Cut by id
	 *
	 * @param	int	$id
	 * @return	 Cut
	 * @static
	 */
	public static function FindById($id){
		$query = new Query();
		$query->createSelect(array('*'), 'cuts', array(), 'id = "'.$id.'"');
		$cutArray = $query->execute();
		$cut = false;
		if(!empty($cutArray)){
			$cut = self::CreateObjectFromArray($cutArray);
		}
		return $cut;
	}

	/**
	 * Finds stored Cut by specific values
	 *
	 * @param	array|string	$params
	 * @param	bool	$expectsOne
	 * @return	array|Cut
	 * @static
	 */
	public static function FindBy($params, $expectsOne=false){
		$cutsArray = array();
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
			$query->createSelect(array('*'), 'cuts', null, $where);
			$arrayArraysCut = $query->execute(true);
			if(!empty($arrayArraysCut)){
				if($expectsOne){
					return self::CreateObjectFromArray($arrayArraysCut[0]);
				}
				foreach($arrayArraysCut as $arrayCut){
					array_push($cutsArray, self::CreateObjectFromArray($arrayCut));
				}
			} elseif($expectsOne){
				return false;
			}
		}
		return $cutsArray;
	}


	/**
	 * Retrieves all Cut stored in the data base
	 *
	 * @return	array|Cut
	 *static
	*/
	public static function FetchAll(){
		$cutsArray = array();
		$query = new Query();
		$query->createSelect(array('*'), 'cuts');
		$arrayArraysCut = $query->execute(true);
		if(!empty($arrayArraysCut)){
			foreach($arrayArraysCut as $arrayCut){
				array_push($cutsArray, self::CreateObjectFromArray($arrayCut));
			}
		}
		return $cutsArray;
	}

	/**
	 * Deletes Cut by id
	 *
	 * @param	int	$id
	 *static
	 */
	public static function Delete($id){
		$query = new Query();
		$query->createDelete('cuts', $id);
		return $query->execute();
	}

	/**
	 *Creates Cut object from the basic properties
	 *
	 * @param	array|string	$properties
	 * @return	Cut
	 *static
	 */
	
	public static function CreateObjectFromArray($properties){
		if(!empty($properties["id"]) && !empty($properties["name"]) && !empty($properties["value"])){
			return new Cut($properties);
		} else {
			throw new Exception('Unable to create Cut with empty values. (CutModel::CreateObjectFromArray())');
		}
	}

}