<?php
/**
* @author    German Dosko
* @version   November 10 , 2012
*/
class User extends AbstractEntity {
	
	/**
	* @var	int
	*/
	protected $id=null;
	
	/**
	* @var	string
	*/
	protected $name=null;
	
	/**
	* @var	string
	*/
	protected $nick=null;
	
	/**
	* @var	string
	*/
	protected $password=null;
	
	/**
	* @var	string
	*/
	protected $lastAcces=null;
	/**
	* @param	int	$id
	*/
	public function setId($id){
		$this->id = intval($id);
	}
	
	
	/**
	* @param	string	$name
	*/
	public function setName($name){
		$this->name = substr(strval($name), 0, 32);
	}
	
	
	/**
	* @param	string	$nick
	*/
	public function setNick($nick){
		$this->nick = substr(strval($nick), 0, 32);
	}
	
	
	/**
	* @param	string	$password
	*/
	public function setPassword($password){
		$this->password = substr(strval($password), 0, 32);
	}
	
	
	/**
	* @param	string	$lastAcces
	*/
	public function setLastAcces($lastAcces){
		$this->lastAcces = substr(strval($lastAcces), 0, 32);
	}
	
	/**
	* @return	int
	*/
	public function getId(){
		return $this->id;
	}
	
	/**
	* @return	string
	*/
	public function getName(){
		return $this->name;
	}
	
	/**
	* @return	string
	*/
	public function getNick(){
		return $this->nick;
	}
	
	/**
	* @return	string
	*/
	public function getPassword(){
		return $this->password;
	}
	
	/**
	* @return	string
	*/
	public function getLastAcces(){
		return $this->lastAcces;
	}
}