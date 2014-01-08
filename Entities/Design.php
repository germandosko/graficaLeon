<?php
/**
* @author    German Dosko
* @version   November 10 , 2012
*/
class Design extends AbstractEntity {
	
	/**
	* @var	int
	*/
	protected $id=null;
	
	/**
	* @var	string
	*/
	protected $name=null;
	
	/**
	* @var	float
	*/
	protected $value=null;
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
		$this->name = substr(strval($name), 0, 128);
	}
	
	
	/**
	* @param	float	$value
	*/
	public function setValue($value){
		$this->value = floatval($value);
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
	* @return	float
	*/
	public function getValue(){
		return $this->value;
	}
}