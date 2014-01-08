<?php
/**
* @author							
* @version			March 18 , 2013
* @filesource			/Models/MachineModel.php
*/

class MachineModel extends AbstractModel {

	/**
	 * Saves the Machine in the Data Base
	 *
	 * @param	Machine
	 * @static
	 */
	public static function Save(&$machine){
		$id = $machine->getId();
		$properties = array(
			"name" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($machine->getName())) : htmlentities($machine->getName()),
			"value" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($machine->getValue())) : htmlentities($machine->getValue())
			);
		if(!empty($properties["name"]) && !empty($properties["value"])){
			$query = new Query();
			if(!empty($id) && is_int($id)){
				$query->createUpdate('machines', $properties, 'id = "'.$id.'"', true);
				$isExecuted = $query->execute();
				if(!$isExecuted){
					throw new Exception('Unable to update Machine "'.$id.'" in database. (MachineModel::save())');
				}
			} else {
				$query->createInsert('machines', $properties, true);
				$isExecuted = $query->execute();
				if($isExecuted){
					//get the last inserted id
					$query->createSelect(array('MAX(id) as id'), 'machines');
					$value = $query->execute();
					$machine->setId($value['id']);
				} else {
					throw new Exception('Unable to insert Machine in database. (MachineModel::save())');
				}
			}
		} else {
			throw new Exception('Unable to save Machine with empty required values. (MachineModel::save())');
		}
		return true;
	}

	/**
	 * Finds a Machine by id
	 *
	 * @param	int	$id
	 * @return	 Machine
	 * @static
	 */
	public static function FindById($id){
		$query = new Query();
		$query->createSelect(array('*'), 'machines', array(), 'id = "'.$id.'"');
		$machineArray = $query->execute();
		$machine = false;
		if(!empty($machineArray)){
			$machine = self::CreateObjectFromArray($machineArray);
		}
		return $machine;
	}

	/**
	 * Finds stored Machine by specific values
	 *
	 * @param	array|string	$params
	 * @param	bool	$expectsOne
	 * @return	array|Machine
	 * @static
	 */
	public static function FindBy($params, $expectsOne=false){
		$machinesArray = array();
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
			$query->createSelect(array('*'), 'machines', null, $where);
			$arrayArraysMachine = $query->execute(true);
			if(!empty($arrayArraysMachine)){
				if($expectsOne){
					return self::CreateObjectFromArray($arrayArraysMachine[0]);
				}
				foreach($arrayArraysMachine as $arrayMachine){
					array_push($machinesArray, self::CreateObjectFromArray($arrayMachine));
				}
			} elseif($expectsOne){
				return false;
			}
		}
		return $machinesArray;
	}


	/**
	 * Retrieves all Machine stored in the data base
	 *
	 * @return	array|Machine
	 *static
	*/
	public static function FetchAll(){
		$machinesArray = array();
		$query = new Query();
		$query->createSelect(array('*'), 'machines');
		$arrayArraysMachine = $query->execute(true);
		if(!empty($arrayArraysMachine)){
			foreach($arrayArraysMachine as $arrayMachine){
				array_push($machinesArray, self::CreateObjectFromArray($arrayMachine));
			}
		}
		return $machinesArray;
	}

	/**
	 * Deletes Machine by id
	 *
	 * @param	int	$id
	 *static
	 */
	public static function Delete($id){
		$query = new Query();
		$query->createDelete('machines', $id);
		return $query->execute();
	}

	/**
	 *Creates Machine object from the basic properties
	 *
	 * @param	array|string	$properties
	 * @return	Machine
	 *static
	 */
	
	public static function CreateObjectFromArray($properties){
		if(!empty($properties["id"]) && !empty($properties["name"]) && !empty($properties["value"])){
			return new Machine($properties);
		} else {
			throw new Exception('Unable to create Machine with empty values. (MachineModel::CreateObjectFromArray())');
		}
	}

}