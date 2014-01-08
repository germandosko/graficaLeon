<?php
/**
* @author    German Dosko
* @version   November 10 , 2012
*/
class Customer extends AbstractEntity {
	
	/**
	* @var	int
	*/
	protected $id=null;
	
	/**
	* @var	string
	*/
	protected $cuit=null;
	
	/**
	* @var	string
	*/
	protected $initDate=null;
	
	/**
	* @var	string
	*/
	protected $numGross_income=null;
	
	/**
	* @var	string
	*/
	protected $name=null;
	
	/**
	* @var	string
	*/
	protected $lastName=null;
	
	/**
	* @var	string
	*/
	protected $businessName=null;
	
	/**
	* @var	string
	*/
	protected $address=null;
	
	/**
	* @var	string
	*/
	protected $city=null;
	
	/**
	* @var	string
	*/
	protected $email=null;
	
	/**
	* @var	string
	*/
	protected $phone=null;
	
	/**
	* @var	string
	*/
	protected $cellPhone=null;
	
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
	* @param	string	$cuit
	*/
	public function setCuit($cuit){
		$this->cuit = substr(strval($cuit), 0, 256);
	}
	
	
	/**
	* @param	string	$initDate
	*/
	public function setInitDate($initDate){
		$this->initDate = substr(strval($initDate), 0, 32);
	}
	
	
	/**
	* @param	string	$numGross_income
	*/
	public function setNumGross_income($numGross_income){
		$this->numGross_income = substr(strval($numGross_income), 0, 32);
	}
	
	
	/**
	* @param	string	$name
	*/
	public function setName($name){
		$this->name = substr(strval($name), 0, 256);
	}
	
	
	/**
	* @param	string	$lastName
	*/
	public function setLastName($lastName){
		$this->lastName = substr(strval($lastName), 0, 256);
	}
	
	
	/**
	* @param	string	$businessName
	*/
	public function setBusinessName($businessName){
		$this->businessName = substr(strval($businessName), 0, 256);
	}
	
	
	/**
	* @param	string	$address
	*/
	public function setAddress($address){
		$this->address = substr(strval($address), 0, 256);
	}
	
	
	/**
	* @param	string	$city
	*/
	public function setCity($city){
		$this->city = substr(strval($city), 0, 32);
	}
	
	
	/**
	* @param	string	$email
	*/
	public function setEmail($email){
		$this->email = substr(strval($email), 0, 256);
	}
	
	
	/**
	* @param	string	$phone
	*/
	public function setPhone($phone){
		$this->phone = substr(strval($phone), 0, 32);
	}
	
	
	/**
	* @param	string	$cellPhone
	*/
	public function setCellPhone($cellPhone){
		$this->cellPhone = substr(strval($cellPhone), 0, 32);
	}
	
	
	/**
	* @param	User	$user
	*/
	public function setUser($user){
		if(is_object($user)){
			$this->user = $user;
		} else {
			throw new Exception('Function expects an object as param. (Customer->setUser($user))');
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
	public function getCuit(){
		return $this->cuit;
	}
	
	/**
	* @return	string
	*/
	public function getInitDate(){
		return $this->initDate;
	}
	
	/**
	* @return	string
	*/
	public function getNumGross_income(){
		return $this->numGross_income;
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
	public function getLastName(){
		return $this->lastName;
	}
	
	/**
	* @return	string
	*/
	public function getBusinessName(){
		return $this->businessName;
	}
	
	/**
	* @return	string
	*/
	public function getAddress(){
		return $this->address;
	}
	
	/**
	* @return	string
	*/
	public function getCity(){
		return $this->city;
	}
	
	/**
	* @return	string
	*/
	public function getEmail(){
		return $this->email;
	}
	
	/**
	* @return	string
	*/
	public function getPhone(){
		return $this->phone;
	}
	
	/**
	* @return	string
	*/
	public function getCellPhone(){
		return $this->cellPhone;
	}
	
	/**
	* @return	User
	*/
	public function getUser(){
		return $this->user;
	}
}