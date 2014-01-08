<?php
/** 
* @author Web Design Rosario
* @version Oct 6 2011
*/

class Security
{
	/**
	 * Authenticates the user
	 *
	 * @param		User		$user
	 * @return		boolean  
	 */
	public static function authenticate($user=null){
		$mySession = Session::getInstance();
		if (is_object($user)){
			$mySession->userId = $user->getId();
			$mySession->userName = $user->getName();
			$mySession->lastAccess = date("Y-m-d H:i:s");
			$mySession->isLogged = true;
			return true;
		} else{
			if ($mySession->isLogged){
				$mySession->lastAccess = date("Y-m-d H:i:s");
				return true;
			} 
		}
		return false;
	}
	
	/**
	 *  Closes the session of the user
	 */
	public static function unauthenticate(){
		$mySession = Session::getInstance();
		$mySession->destroy();
		header('Location: login.php?auth=0');
	}
}