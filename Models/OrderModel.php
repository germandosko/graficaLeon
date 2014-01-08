<?php
/**
* @author							
* @version			November 10 , 2012
* @filesource			/Models/OrderModel.php
*/

class OrderModel extends AbstractModel {

	/**
	 * Saves the Order in the Data Base
	 *
	 * @param	Order
	 * @static
	 */
	public static function Save(&$order){
		$id = $order->getId();
		$properties = array(
			"date" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($order->getDate())) : htmlentities($order->getDate()),
			"customerId" => $order->getCustomer()->getId(),
			"description" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($order->getDescription())) : htmlentities($order->getDescription()),
			"type" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($order->getType())) : htmlentities($order->getType()),
			"state" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($order->getState())) : htmlentities($order->getState()),
			"total" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($order->getTotal())) : htmlentities($order->getTotal()),
			"advance" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($order->getAdvance())) : htmlentities($order->getAdvance()),
			"deliveryDate" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($order->getDeliveryDate())) : htmlentities($order->getDeliveryDate()),
			"amount" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($order->getAmount())) : htmlentities($order->getAmount()),
			"paper" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($order->getPaper())) : htmlentities($order->getPaper()),
			"colorPaper" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($order->getColorPaper())) : htmlentities($order->getColorPaper()),
			"weight" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($order->getWeight())) : htmlentities($order->getWeight()),
			"machine" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($order->getMachine())) : htmlentities($order->getMachine()),
			"termination" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($order->getTermination())) : htmlentities($order->getTermination()),
			"fromNumber" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($order->getFromNumber())) : htmlentities($order->getFromNumber()),
			"toNumber" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($order->getToNumber())) : htmlentities($order->getToNumber()),
			"observation" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($order->getObservation())) : htmlentities($order->getObservation()),
			"userId" => $order->getUser()->getId()
			);
		if(!empty($properties["date"]) && !empty($properties["customerId"]) && !empty($properties["type"]) && !empty($properties["state"]) && !empty($properties["total"]) && !empty($properties["amount"]) && !empty($properties["userId"])){
			$query = new Query();
			if(!empty($id) && is_int($id)){
				$query->createUpdate('orders', $properties, 'id = "'.$id.'"', true);
				$isExecuted = $query->execute();
				if(!$isExecuted){
					throw new Exception('Unable to update Order "'.$id.'" in database. (OrderModel::save())');
				}
			} else {
				$query->createInsert('orders', $properties, true);
				$isExecuted = $query->execute();
				if($isExecuted){
					//get the last inserted id
					$query->createSelect(array('MAX(id) as id'), 'orders');
					$value = $query->execute();
					$order->setId($value['id']);
				} else {
					throw new Exception('Unable to insert Order in database. (OrderModel::save())');
				}
			}
		} else {
			throw new Exception('Unable to save Order with empty required values. (OrderModel::save())');
		}
		return true;
	}

	/**
	 * Finds a Order by id
	 *
	 * @param	int	$id
	 * @return	 Order
	 * @static
	 */
	public static function FindById($id){
		$query = new Query();
		$query->createSelect(array('*'), 'orders', array(), 'id = "'.$id.'"');
		$orderArray = $query->execute();
		$order = false;
		if(!empty($orderArray)){
			$order = self::CreateObjectFromArray($orderArray);
		}
		return $order;
	}

	/**
	 * Finds stored Order by specific values
	 *
	 * @param	array|string	$params
	 * @param	bool	$expectsOne
	 * @return	array|Order
	 * @static
	 */
	public static function FindBy($params, $expectsOne=false){
		$ordersArray = array();
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
			$query->createSelect(array('*'), 'orders', null, $where);
			$arrayArraysOrder = $query->execute(true);
			if(!empty($arrayArraysOrder)){
				if($expectsOne){
					return self::CreateObjectFromArray($arrayArraysOrder[0]);
				}
				foreach($arrayArraysOrder as $arrayOrder){
					array_push($ordersArray, self::CreateObjectFromArray($arrayOrder));
				}
			} elseif($expectsOne){
				return false;
			}
		}
		return $ordersArray;
	}

	/**
	 * Finds stored Orders by related Customer properties
	 *
	 * @param	array|string	$params
	 * @param	bool	$expectsOne
	 * @return	array|Order
	 * @static
	 */
	
	public static function FindByCustomerProperties($params, $expectsOne=false){
		$ordersArray = array();
		if(is_array($params)){
			$selectFields = array(
				'users.id',
				'users.date',
				'users.customerId',
				'users.description',
				'users.type',
				'users.state',
				'users.total',
				'users.advance',
				'users.deliveryDate',
				'users.amount',
				'users.paper',
				'users.colorPaper',
				'users.weight',
				'users.machine',
				'users.termination',
				'users.fromNumber',
				'users.toNumber',
				'users.observation',
				'users.userId'
			);
		$joinArray = array('customers'=>'customers.id = orders.customerId');
		$whereArray = array();
		foreach ($params as $key => $value){
			if(!empty($value)){
				$parsedValue = self::$IsUsingUtf8 ? htmlentities(utf8_decode($value)) : htmlentities($value);
				array_push($whereArray, 'customers.'.$key.' = "'.$parsedValue.'"');
			}
		}
		$where = implode(' AND ', $whereArray);
		$query = new Query();
		$query->createSelect(array('*'), 'orders', $joinArray, $where);
		$arrayArraysOrder = $query->execute(true);
		if(!empty($arrayArraysOrder)){
			if($expectsOne){
				return self::CreateObjectFromArray($arrayArraysOrder[0]);
			}
			foreach($arrayArraysOrder as $arrayOrder){
				array_push($ordersArray, self::CreateObjectFromArray($arrayOrder));
			}
			} elseif($expectsOne){
				return false;
			}
		}
		return $ordersArray;
	}
	/**
	 * Finds stored Orders by related User properties
	 *
	 * @param	array|string	$params
	 * @param	bool	$expectsOne
	 * @return	array|Order
	 * @static
	 */
	
	public static function FindByUserProperties($params, $expectsOne=false){
		$ordersArray = array();
		if(is_array($params)){
			$selectFields = array(
				'users.id',
				'users.date',
				'users.customerId',
				'users.description',
				'users.type',
				'users.state',
				'users.total',
				'users.advance',
				'users.deliveryDate',
				'users.amount',
				'users.paper',
				'users.colorPaper',
				'users.weight',
				'users.machine',
				'users.termination',
				'users.fromNumber',
				'users.toNumber',
				'users.observation',
				'users.userId'
			);
		$joinArray = array('users'=>'users.id = orders.userId');
		$whereArray = array();
		foreach ($params as $key => $value){
			if(!empty($value)){
				$parsedValue = self::$IsUsingUtf8 ? htmlentities(utf8_decode($value)) : htmlentities($value);
				array_push($whereArray, 'users.'.$key.' = "'.$parsedValue.'"');
			}
		}
		$where = implode(' AND ', $whereArray);
		$query = new Query();
		$query->createSelect(array('*'), 'orders', $joinArray, $where);
		$arrayArraysOrder = $query->execute(true);
		if(!empty($arrayArraysOrder)){
			if($expectsOne){
				return self::CreateObjectFromArray($arrayArraysOrder[0]);
			}
			foreach($arrayArraysOrder as $arrayOrder){
				array_push($ordersArray, self::CreateObjectFromArray($arrayOrder));
			}
			} elseif($expectsOne){
				return false;
			}
		}
		return $ordersArray;
	}

	/**
	 * Retrieves all Order stored in the data base
	 *
	 * @return	array|Order
	 *static
	*/
	public static function FetchAll(){
		$ordersArray = array();
		$query = new Query();
		$query->createSelect(array('*'), 'orders');
		$arrayArraysOrder = $query->execute(true);
		if(!empty($arrayArraysOrder)){
			foreach($arrayArraysOrder as $arrayOrder){
				array_push($ordersArray, self::CreateObjectFromArray($arrayOrder));
			}
		}
		return $ordersArray;
	}

	/**
	 * Deletes Order by id
	 *
	 * @param	int	$id
	 *static
	 */
	public static function Delete($id){
		$query = new Query();
		$query->createDelete('orders', $id);
		return $query->execute();
	}

	/**
	 *Creates Order object from the basic properties
	 *
	 * @param	array|string	$properties
	 * @return	Order
	 *static
	 */
	
	public static function CreateObjectFromArray($properties){
		if(!empty($properties["id"]) && !empty($properties["date"]) && !empty($properties["customerId"]) && !empty($properties["type"]) && !empty($properties["state"]) && !empty($properties["total"]) && !empty($properties["amount"]) && !empty($properties["userId"])){
			$properties['customer'] = CustomerModel::FindById($properties['customerId']);
			if(empty($properties['customer'])){
				throw new Exception('Unable to find the customer for the Order.(OrderModel::CreateObjectFromArray())');
				}
			$properties['user'] = UserModel::FindById($properties['userId']);
			if(empty($properties['user'])){
				throw new Exception('Unable to find the user for the Order.(OrderModel::CreateObjectFromArray())');
				}
			return new Order($properties);
		} else {
			throw new Exception('Unable to create Order with empty values. (OrderModel::CreateObjectFromArray())');
		}
	}

}