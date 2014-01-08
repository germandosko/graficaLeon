<?php
/**
* @author							
* @version			September 21 , 2012
* @filesource			/Models/CustomerModel.php
*/

class CustomerModel extends AbstractModel {

	/**
	 * Saves the Customer in the Data Base
	 *
	 * @param	Customer
	 * @static
	 */
	public static function Save(&$customer){
		$id = $customer->getId();
		$properties = array(
			"cuit" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($customer->getCuit())) : htmlentities($customer->getCuit()),
			"initDate" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($customer->getInitDate())) : htmlentities($customer->getInitDate()),
			"numGross_income" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($customer->getNumGross_income())) : htmlentities($customer->getNumGross_income()),
			"name" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($customer->getName())) : htmlentities($customer->getName()),
			"lastName" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($customer->getLastName())) : htmlentities($customer->getLastName()),
			"businessName" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($customer->getBusinessName())) : htmlentities($customer->getBusinessName()),
			"address" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($customer->getAddress())) : htmlentities($customer->getAddress()),
			"city" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($customer->getCity())) : htmlentities($customer->getCity()),
			"email" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($customer->getEmail())) : htmlentities($customer->getEmail()),
			"phone" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($customer->getPhone())) : htmlentities($customer->getPhone()),
			"cellPhone" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($customer->getCellPhone())) : htmlentities($customer->getCellPhone()),
			"userId" => $customer->getUser()->getId()
			);
		if(!empty($properties["name"]) && !empty($properties["lastName"]) && !empty($properties["address"]) && !empty($properties["city"]) && !empty($properties["userId"])){
			$query = new Query();
			if(!empty($id) && is_int($id)){			
				$query->createUpdate('customers', $properties, 'id = "'.$id.'"', true);
				$isExecuted = $query->execute();
				if(!$isExecuted){
					throw new Exception('Unable to update Customer "'.$id.'" in database. (CustomerModel::save())');
				}
			} else {
				$query->createInsert('customers', $properties, true);
				$isExecuted = $query->execute();
				if($isExecuted){
					//get the last inserted id
					$query->createSelect(array('MAX(id) as id'), 'customers');
					$value = $query->execute();
					$customer->setId($value['id']);
				} else {
					throw new Exception('Unable to insert Customer in database. (CustomerModel::save())');
				}
			}
		} else {
			throw new Exception('Unable to save Customer with empty required values. (CustomerModel::save())');
		}
		return true;
	}

	/**
	 * Finds a Customer by id
	 *
	 * @param	int	$id
	 * @return	 Customer
	 * @static
	 */
	public static function FindById($id){
		$query = new Query();
		$query->createSelect(array('*'), 'customers', array(), 'id = "'.$id.'"');
		$customerArray = $query->execute();
		$customer = false;
		if(!empty($customerArray)){
			$customer = self::CreateObjectFromArray($customerArray);
		}
		return $customer;
	}

	/**
	 * Finds stored Customer by specific values
	 *
	 * @param	array|string	$params
	 * @param	bool	$expectsOne
	 * @return	array|Customer
	 * @static
	 */
	public static function FindBy($params, $expectsOne=false, $like=false){
		$customersArray = array();
		if(is_array($params)){
			$whereArray = array();
			foreach ($params as $key => $value){
				if(!empty($value)){
					$parsedValue = self::$IsUsingUtf8 ? htmlentities(utf8_decode($value)) : htmlentities($value);
					if($like == true){
					array_push($whereArray, $key.' LIKE "%'.$parsedValue.'%"');
					} else {array_push($whereArray, $key.' = "'.$parsedValue.'"');}
				}
			}
			if($like == true){
				$where = implode(' OR ', $whereArray);
				} else {$where = implode(' AND ', $whereArray);}
			$query = new Query();
			$query->createSelect(array('*'), 'customers', null, $where);
			$arrayArraysCustomer = $query->execute(true);
			if(!empty($arrayArraysCustomer)){
				if($expectsOne){
					return self::CreateObjectFromArray($arrayArraysCustomer[0]);
				}
				foreach($arrayArraysCustomer as $arrayCustomer){
					array_push($customersArray, self::CreateObjectFromArray($arrayCustomer));
				}
			} elseif($expectsOne){
				return false;
			}
		}
		return $customersArray;
	}

	/**
	 * Finds stored Customers by related User properties
	 *
	 * @param	array|string	$params
	 * @param	bool	$expectsOne
	 * @return	array|Customer
	 * @static
	 */
	
	public static function FindByUserProperties($params, $expectsOne=false){
		$customersArray = array();
		if(is_array($params)){
			$selectFields = array(
				'users.id',
				'users.cuit',
				'users.initDate',
				'users.numGross_income',
				'users.name',
				'users.lastName',
				'users.businessName',
				'users.address',
				'users.city',
				'users.email',
				'users.phone',
				'users.cellPhone',
				'users.userId'
			);
		$joinArray = array('users'=>'users.id = customers.userId');
		$whereArray = array();
		foreach ($params as $key => $value){
			if(!empty($value)){
				$parsedValue = self::$IsUsingUtf8 ? htmlentities(utf8_decode($value)) : htmlentities($value);
				array_push($whereArray, 'users.'.$key.' = "'.$parsedValue.'"');
			}
		}
		$where = implode(' AND ', $whereArray);
		$query = new Query();
		$query->createSelect(array('*'), 'customers', $joinArray, $where);
		$arrayArraysCustomer = $query->execute(true);
		if(!empty($arrayArraysCustomer)){
			if($expectsOne){
				return self::CreateObjectFromArray($arrayArraysCustomer[0]);
			}
			foreach($arrayArraysCustomer as $arrayCustomer){
				array_push($customersArray, self::CreateObjectFromArray($arrayCustomer));
			}
			} elseif($expectsOne){
				return false;
			}
		}
		return $customersArray;
	}

	/**
	 * Retrieves all Customer stored in the data base
	 *
	 * @return	array|Customer
	 *static
	*/
	public static function FetchAll(){
		$customersArray = array();
		$query = new Query();
		$query->createSelect(array('*'), 'customers');
		$arrayArraysCustomer = $query->execute(true);
		if(!empty($arrayArraysCustomer)){
			foreach($arrayArraysCustomer as $arrayCustomer){
				array_push($customersArray, self::CreateObjectFromArray($arrayCustomer));
			}
		}
		return $customersArray;
	}

	/**
	 * Deletes Customer by id
	 *
	 * @param	int	$id
	 *static
	 */
	public static function Delete($id){
		$query = new Query();
		$query->createDelete('customers', $id);
		return $query->execute();
	}

	/**
	 *Creates Customer object from the basic properties
	 *
	 * @param	array|string	$properties
	 * @return	Customer
	 *static
	 */
	
	public static function CreateObjectFromArray($properties){
		if(!empty($properties["id"]) && !empty($properties["name"]) && !empty($properties["lastName"]) && !empty($properties["address"]) && !empty($properties["city"]) && !empty($properties["userId"])){
			$properties['user'] = UserModel::FindById($properties['userId']);
			if(empty($properties['user'])){
				throw new Exception('Unable to find the user for the Customer.(CustomerModel::CreateObjectFromArray())');
				}
			return new Customer($properties);
		} else {
			throw new Exception('Unable to create Customer with empty values. (CustomerModel::CreateObjectFromArray())');
		}
	}

}