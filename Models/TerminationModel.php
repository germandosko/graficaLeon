<?php
/**
* @author							
* @version			November 10 , 2012
* @filesource			/Models/TerminationModel.php
*/

class TerminationModel extends AbstractModel {

	/**
	 * Saves the Termination in the Data Base
	 *
	 * @param	Termination
	 * @static
	 */
	public static function Save(&$termination){
		$id = $termination->getId();
		$properties = array(
			"name" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($termination->getName())) : htmlentities($termination->getName()),
			"value" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($termination->getValue())) : htmlentities($termination->getValue())
			);
		if(!empty($properties["name"]) && !empty($properties["value"])){
			$query = new Query();
			if(!empty($id) && is_int($id)){
				$query->createUpdate('terminations', $properties, 'id = "'.$id.'"', true);
				$isExecuted = $query->execute();
				if(!$isExecuted){
					throw new Exception('Unable to update Termination "'.$id.'" in database. (TerminationModel::save())');
				}
			} else {
				$query->createInsert('terminations', $properties, true);
				$isExecuted = $query->execute();
				if($isExecuted){
					//get the last inserted id
					$query->createSelect(array('MAX(id) as id'), 'terminations');
					$value = $query->execute();
					$termination->setId($value['id']);
				} else {
					throw new Exception('Unable to insert Termination in database. (TerminationModel::save())');
				}
			}
		} else {
			throw new Exception('Unable to save Termination with empty required values. (TerminationModel::save())');
		}
		return true;
	}

	/**
	 * Finds a Termination by id
	 *
	 * @param	int	$id
	 * @return	 Termination
	 * @static
	 */
	public static function FindById($id){
		$query = new Query();
		$query->createSelect(array('*'), 'terminations', array(), 'id = "'.$id.'"');
		$terminationArray = $query->execute();
		$termination = false;
		if(!empty($terminationArray)){
			$termination = self::CreateObjectFromArray($terminationArray);
		}
		return $termination;
	}

	/**
	 * Finds stored Termination by specific values
	 *
	 * @param	array|string	$params
	 * @param	bool	$expectsOne
	 * @return	array|Termination
	 * @static
	 */
	public static function FindBy($params, $expectsOne=false){
		$terminationsArray = array();
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
			$query->createSelect(array('*'), 'terminations', null, $where);
			$arrayArraysTermination = $query->execute(true);
			if(!empty($arrayArraysTermination)){
				if($expectsOne){
					return self::CreateObjectFromArray($arrayArraysTermination[0]);
				}
				foreach($arrayArraysTermination as $arrayTermination){
					array_push($terminationsArray, self::CreateObjectFromArray($arrayTermination));
				}
			} elseif($expectsOne){
				return false;
			}
		}
		return $terminationsArray;
	}


	/**
	 * Retrieves all Termination stored in the data base
	 *
	 * @return	array|Termination
	 *static
	*/
	public static function FetchAll(){
		$terminationsArray = array();
		$query = new Query();
		$query->createSelect(array('*'), 'terminations');
		$arrayArraysTermination = $query->execute(true);
		if(!empty($arrayArraysTermination)){
			foreach($arrayArraysTermination as $arrayTermination){
				array_push($terminationsArray, self::CreateObjectFromArray($arrayTermination));
			}
		}
		return $terminationsArray;
	}

	/**
	 * Deletes Termination by id
	 *
	 * @param	int	$id
	 *static
	 */
	public static function Delete($id){
		$query = new Query();
		$query->createDelete('terminations', $id);
		return $query->execute();
	}

	/**
	 *Creates Termination object from the basic properties
	 *
	 * @param	array|string	$properties
	 * @return	Termination
	 *static
	 */
	
	public static function CreateObjectFromArray($properties){
		if(!empty($properties["id"]) && !empty($properties["name"]) && !empty($properties["value"])){
			return new Termination($properties);
		} else {
			throw new Exception('Unable to create Termination with empty values. (TerminationModel::CreateObjectFromArray())');
		}
	}

}