<?php
/**
* @author							
* @version			November 10 , 2012
* @filesource			/Models/UserModel.php
*/

class UserModel extends AbstractModel {

	/**
	 * Saves the User in the Data Base
	 *
	 * @param	User
	 * @static
	 */
	public static function Save(&$user){
		$id = $user->getId();
		$properties = array(
			"name" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($user->getName())) : htmlentities($user->getName()),
			"nick" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($user->getNick())) : htmlentities($user->getNick()),
			"password" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($user->getPassword())) : htmlentities($user->getPassword()),
			"lastAcces" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($user->getLastAcces())) : htmlentities($user->getLastAcces())
			);
		if(!empty($properties["name"]) && !empty($properties["nick"]) && !empty($properties["password"]) && !empty($properties["lastAcces"])){
			$query = new Query();
			if(!empty($id) && is_int($id)){
				$query->createUpdate('users', $properties, 'id = "'.$id.'"', true);
				$isExecuted = $query->execute();
				if(!$isExecuted){
					throw new Exception('Unable to update User "'.$id.'" in database. (UserModel::save())');
				}
			} else {
				$query->createInsert('users', $properties, true);
				$isExecuted = $query->execute();
				if($isExecuted){
					//get the last inserted id
					$query->createSelect(array('MAX(id) as id'), 'users');
					$value = $query->execute();
					$user->setId($value['id']);
				} else {
					throw new Exception('Unable to insert User in database. (UserModel::save())');
				}
			}
		} else {
			throw new Exception('Unable to save User with empty required values. (UserModel::save())');
		}
		return true;
	}

	/**
	 * Finds a User by id
	 *
	 * @param	int	$id
	 * @return	 User
	 * @static
	 */
	public static function FindById($id){
		$query = new Query();
		$query->createSelect(array('*'), 'users', array(), 'id = "'.$id.'"');
		$userArray = $query->execute();
		$user = false;
		if(!empty($userArray)){
			$user = self::CreateObjectFromArray($userArray);
		}
		return $user;
	}

	/**
	 * Finds stored User by specific values
	 *
	 * @param	array|string	$params
	 * @param	bool	$expectsOne
	 * @return	array|User
	 * @static
	 */
	public static function FindBy($params, $expectsOne=false){
		$usersArray = array();
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
			$query->createSelect(array('*'), 'users', null, $where);
			$arrayArraysUser = $query->execute(true);
			if(!empty($arrayArraysUser)){
				if($expectsOne){
					return self::CreateObjectFromArray($arrayArraysUser[0]);
				}
				foreach($arrayArraysUser as $arrayUser){
					array_push($usersArray, self::CreateObjectFromArray($arrayUser));
				}
			} elseif($expectsOne){
				return false;
			}
		}
		return $usersArray;
	}


	/**
	 * Retrieves all User stored in the data base
	 *
	 * @return	array|User
	 *static
	*/
	public static function FetchAll(){
		$usersArray = array();
		$query = new Query();
		$query->createSelect(array('*'), 'users');
		$arrayArraysUser = $query->execute(true);
		if(!empty($arrayArraysUser)){
			foreach($arrayArraysUser as $arrayUser){
				array_push($usersArray, self::CreateObjectFromArray($arrayUser));
			}
		}
		return $usersArray;
	}

	/**
	 * Deletes User by id
	 *
	 * @param	int	$id
	 *static
	 */
	public static function Delete($id){
		$query = new Query();
		$query->createDelete('users', $id);
		return $query->execute();
	}

	/**
	 *Creates User object from the basic properties
	 *
	 * @param	array|string	$properties
	 * @return	User
	 *static
	 */
	
	public static function CreateObjectFromArray($properties){
		if(!empty($properties["id"]) && !empty($properties["name"]) && !empty($properties["nick"]) && !empty($properties["password"]) && !empty($properties["lastAcces"])){
			return new User($properties);
		} else {
			throw new Exception('Unable to create User with empty values. (UserModel::CreateObjectFromArray())');
		}
	}

}