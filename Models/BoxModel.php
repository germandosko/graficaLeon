<?php
/**
* @author							
* @version			November 10 , 2012
* @filesource			/Models/BoxModel.php
*/

class BoxModel extends AbstractModel {

	/**
	 * Saves the Box in the Data Base
	 *
	 * @param	Box
	 * @static
	 */
	public static function Save(&$box){
		$id = $box->getId();
		$properties = array(
			"date" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($box->getDate())) : htmlentities($box->getDate()),
			"description" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($box->getDescription())) : htmlentities($box->getDescription()),
			"type" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($box->getType())) : htmlentities($box->getType()),
			"value" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($box->getValue())) : htmlentities($box->getValue()),
			"orderId" => $box->getOrder()->getId(),
			"userId" => $box->getUser()->getId()
			);
		if(!empty($properties["date"]) && !empty($properties["description"]) && !empty($properties["type"]) && !empty($properties["value"]) && !empty($properties["userId"])){
			$query = new Query();
			if(!empty($id) && is_int($id)){
				$query->createUpdate('boxes', $properties, 'id = "'.$id.'"', true);
				$isExecuted = $query->execute();
				if(!$isExecuted){
					throw new Exception('Unable to update Box "'.$id.'" in database. (BoxModel::save())');
				}
			} else {
				$query->createInsert('boxes', $properties, true);
				$isExecuted = $query->execute();
				if($isExecuted){
					//get the last inserted id
					$query->createSelect(array('MAX(id) as id'), 'boxes');
					$value = $query->execute();
					$box->setId($value['id']);
				} else {
					throw new Exception('Unable to insert Box in database. (BoxModel::save())');
				}
			}
		} else {
			throw new Exception('Unable to save Box with empty required values. (BoxModel::save())');
		}
		return true;
	}

	/**
	 * Finds a Box by id
	 *
	 * @param	int	$id
	 * @return	 Box
	 * @static
	 */
	public static function FindById($id){
		$query = new Query();
		$query->createSelect(array('*'), 'boxes', array(), 'id = "'.$id.'"');
		$boxArray = $query->execute();
		$box = false;
		if(!empty($boxArray)){
			$box = self::CreateObjectFromArray($boxArray);
		}
		return $box;
	}

	/**
	 * Finds stored Box by specific values
	 *
	 * @param	array|string	$params
	 * @param	bool	$expectsOne
	 * @return	array|Box
	 * @static
	 */
	public static function FindBy($params, $expectsOne=false){
		$boxesArray = array();
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
			$query->createSelect(array('*'), 'boxes', null, $where);
			$arrayArraysBox = $query->execute(true);
			if(!empty($arrayArraysBox)){
				if($expectsOne){
					return self::CreateObjectFromArray($arrayArraysBox[0]);
				}
				foreach($arrayArraysBox as $arrayBox){
					array_push($boxesArray, self::CreateObjectFromArray($arrayBox));
				}
			} elseif($expectsOne){
				return false;
			}
		}
		return $boxesArray;
	}

	/**
	 * Finds stored Boxes by related Order properties
	 *
	 * @param	array|string	$params
	 * @param	bool	$expectsOne
	 * @return	array|Box
	 * @static
	 */
	
	public static function FindByOrderProperties($params, $expectsOne=false){
		$boxesArray = array();
		if(is_array($params)){
			$selectFields = array(
				'users.id',
				'users.date',
				'users.description',
				'users.type',
				'users.value',
				'users.orderId',
				'users.userId'
			);
		$joinArray = array('orders'=>'orders.id = boxes.orderId');
		$whereArray = array();
		foreach ($params as $key => $value){
			if(!empty($value)){
				$parsedValue = self::$IsUsingUtf8 ? htmlentities(utf8_decode($value)) : htmlentities($value);
				array_push($whereArray, 'orders.'.$key.' = "'.$parsedValue.'"');
			}
		}
		$where = implode(' AND ', $whereArray);
		$query = new Query();
		$query->createSelect(array('*'), 'boxes', $joinArray, $where);
		$arrayArraysBox = $query->execute(true);
		if(!empty($arrayArraysBox)){
			if($expectsOne){
				return self::CreateObjectFromArray($arrayArraysBox[0]);
			}
			foreach($arrayArraysBox as $arrayBox){
				array_push($boxesArray, self::CreateObjectFromArray($arrayBox));
			}
			} elseif($expectsOne){
				return false;
			}
		}
		return $boxesArray;
	}
	/**
	 * Finds stored Boxes by related User properties
	 *
	 * @param	array|string	$params
	 * @param	bool	$expectsOne
	 * @return	array|Box
	 * @static
	 */
	
	public static function FindByUserProperties($params, $expectsOne=false){
		$boxesArray = array();
		if(is_array($params)){
			$selectFields = array(
				'users.id',
				'users.date',
				'users.description',
				'users.type',
				'users.value',
				'users.orderId',
				'users.userId'
			);
		$joinArray = array('users'=>'users.id = boxes.userId');
		$whereArray = array();
		foreach ($params as $key => $value){
			if(!empty($value)){
				$parsedValue = self::$IsUsingUtf8 ? htmlentities(utf8_decode($value)) : htmlentities($value);
				array_push($whereArray, 'users.'.$key.' = "'.$parsedValue.'"');
			}
		}
		$where = implode(' AND ', $whereArray);
		$query = new Query();
		$query->createSelect(array('*'), 'boxes', $joinArray, $where);
		$arrayArraysBox = $query->execute(true);
		if(!empty($arrayArraysBox)){
			if($expectsOne){
				return self::CreateObjectFromArray($arrayArraysBox[0]);
			}
			foreach($arrayArraysBox as $arrayBox){
				array_push($boxesArray, self::CreateObjectFromArray($arrayBox));
			}
			} elseif($expectsOne){
				return false;
			}
		}
		return $boxesArray;
	}

	/**
	 * Retrieves all Box stored in the data base
	 *
	 * @return	array|Box
	 *static
	*/
	public static function FetchAll(){
		$boxesArray = array();
		$query = new Query();
		$query->createSelect(array('*'), 'boxes');
		$arrayArraysBox = $query->execute(true);
		if(!empty($arrayArraysBox)){
			foreach($arrayArraysBox as $arrayBox){
				array_push($boxesArray, self::CreateObjectFromArray($arrayBox));
			}
		}
		return $boxesArray;
	}
	
	/**
	 * Retrieves all Box stored in the data base
	 *
	 * @return	array|Box
	 *static
	*/
	public static function FetchUntils(){
		$boxesArray = array();
		$query = new Query();
		$query->createSelect(array('*'), 'boxes');
		$arrayArraysBox = $query->execute(true);
		if(!empty($arrayArraysBox)){
			foreach($arrayArraysBox as $arrayBox){
				array_push($boxesArray, self::CreateObjectFromArray($arrayBox));
			}
		}
		return $boxesArray;
	}


	/**
	 * Deletes Box by id
	 *
	 * @param	int	$id
	 *static
	 */
	public static function Delete($id){
		$query = new Query();
		$query->createDelete('boxes', $id);
		return $query->execute();
	}

	/**
	 *Creates Box object from the basic properties
	 *
	 * @param	array|string	$properties
	 * @return	Box
	 *static
	 */
	
	public static function CreateObjectFromArray($properties){
		if(!empty($properties["id"]) && !empty($properties["date"]) && !empty($properties["description"]) && !empty($properties["type"]) && !empty($properties["value"]) && !empty($properties["userId"])){
			$properties['order'] = OrderModel::FindById($properties['orderId']);
			if(empty($properties['order'])){
				throw new Exception('Unable to find the order for the Box.(BoxModel::CreateObjectFromArray())');
				}
			$properties['user'] = UserModel::FindById($properties['userId']);
			if(empty($properties['user'])){
				throw new Exception('Unable to find the user for the Box.(BoxModel::CreateObjectFromArray())');
				}
			return new Box($properties);
		} else {
			throw new Exception('Unable to create Box with empty values. (BoxModel::CreateObjectFromArray())');
		}
	}

}