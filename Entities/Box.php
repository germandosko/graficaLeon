<?php
/**
* @author    German Dosko
* @version   November 10 , 2012
*/
class Box extends AbstractEntity {
	
	/**
	* @var	int
	*/
	protected $id=null;
	
	/**
	* @var	string
	*/
	protected $date=null;
	
	/**
	* @var	string
	*/
	protected $description=null;
	
	/**
	* @var	string
	*/
	protected $type=null;
	
	/**
	* @var	float
	*/
	protected $value=null;
	
	/**
	* @var	Order
	*/
	protected $order=null;
	
	/**
	* @var	User
	*/
	protected $user=null;
	/**
	* @param	int	$id
	*/
	public function setId($id){
		$this->id = intval($id);
	}
	
	
	/**
	* @param	string	$date
	*/
	public function setDate($date){
		$this->date = substr(strval($date), 0, 32);
	}
	
	
	/**
	* @param	string	$description
	*/
	public function setDescription($description){
		$this->description = substr(strval($description), 0, 256);
	}
	
	
	/**
	* @param	string	$type
	*/
	public function setType($type){
		$this->type = substr(strval($type), 0, 32);
	}
	
	
	/**
	* @param	float	$value
	*/
	public function setValue($value){
		$this->value = floatval($value);
	}
	
	
	/**
	* @param	Order	$order
	*/
	public function setOrder($order){
		if(is_object($order)){
			$this->order = $order;
		} else {
			throw new Exception('Function expects an object as param. (Box->setOrder($order))');
		}
	}
	
	/**
	* @param	User	$user
	*/
	public function setUser($user){
		if(is_object($user)){
			$this->user = $user;
		} else {
			throw new Exception('Function expects an object as param. (Box->setUser($user))');
		}
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
	public function getDate(){
		return $this->date;
	}
	
	/**
	* @return	string
	*/
	public function getDescription(){
		return $this->description;
	}
	
	/**
	* @return	string
	*/
	public function getType(){
		return $this->type;
	}
	
	/**
	* @return	float
	*/
	public function getValue(){
		return $this->value;
	}
	
	/**
	* @return	Order
	*/
	public function getOrder(){
		return $this->order;
	}
	
	/**
	* @return	User
	*/
	public function getUser(){
		return $this->user;
	}
}