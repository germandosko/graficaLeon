<?php
/**
* @author    German Dosko
* @version   November 10 , 2012
*/
class Order extends AbstractEntity {
	
	/**
	* @var	int
	*/
	protected $id=null;
	
	/**
	* @var	string
	*/
	protected $date=null;
	
	/**
	* @var	Customer
	*/
	protected $customer=null;
	
	/**
	* @var	string
	*/
	protected $description=null;
	
	/**
	* @var	string
	*/
	protected $type=null;
	
	/**
	* @var	string
	*/
	protected $state=null;
	
	/**
	* @var	float
	*/
	protected $total=null;
	
	/**
	* @var	float
	*/
	protected $advance=null;
	
	/**
	* @var	string
	*/
	protected $deliveryDate=null;
	
	/**
	* @var	int
	*/
	protected $amount=null;
	
	/**
	* @var	string
	*/
	protected $paper=null;
	
	/**
	* @var	string
	*/
	protected $colorPaper=null;
	
	/**
	* @var	int
	*/
	protected $weight=null;
	
	/**
	* @var	string
	*/
	protected $machine=null;
	
	/**
	* @var	string
	*/
	protected $termination=null;
	
	/**
	* @var	int
	*/
	protected $fromNumber=null;
	
	/**
	* @var	int
	*/
	protected $toNumber=null;
	
	/**
	* @var	string
	*/
	protected $observation=null;
	
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
	* @param	Customer	$customer
	*/
	public function setCustomer($customer){
		if(is_object($customer)){
			$this->customer = $customer;
		} else {
			throw new Exception('Function expects an object as param. (Order->setCustomer($customer))');
		}
	}
	
	/**
	* @param	string	$description
	*/
	public function setDescription($description){
		$this->description = substr(strval($description), 0, 2048);
	}
	
	
	/**
	* @param	string	$type
	*/
	public function setType($type){
		$this->type = substr(strval($type), 0, 32);
	}
	
	
	/**
	* @param	string	$state
	*/
	public function setState($state){
		$this->state = substr(strval($state), 0, 32);
	}
	
	
	/**
	* @param	float	$total
	*/
	public function setTotal($total){
		$this->total = floatval($total);
	}
	
	
	/**
	* @param	float	$advance
	*/
	public function setAdvance($advance){
		$this->advance = floatval($advance);
	}
	
	
	/**
	* @param	string	$deliveryDate
	*/
	public function setDeliveryDate($deliveryDate){
		$this->deliveryDate = substr(strval($deliveryDate), 0, 32);
	}
	
	
	/**
	* @param	int	$amount
	*/
	public function setAmount($amount){
		$this->amount = intval($amount);
	}
	
	
	/**
	* @param	string	$paper
	*/
	public function setPaper($paper){
		$this->paper = substr(strval($paper), 0, 256);
	}
	
	
	/**
	* @param	string	$colorPaper
	*/
	public function setColorPaper($colorPaper){
		$this->colorPaper = substr(strval($colorPaper), 0, 32);
	}
	
	
	/**
	* @param	int	$weight
	*/
	public function setWeight($weight){
		$this->weight = intval($weight);
	}
	
	
	/**
	* @param	string	$machine
	*/
	public function setMachine($machine){
		$this->machine = substr(strval($machine), 0, 256);
	}
	
	
	/**
	* @param	string	$termination
	*/
	public function setTermination($termination){
		$this->termination = substr(strval($termination), 0, 2048);
	}
	
	
	/**
	* @param	int	$fromNumber
	*/
	public function setFromNumber($fromNumber){
		$this->fromNumber = intval($fromNumber);
	}
	
	
	/**
	* @param	int	$toNumber
	*/
	public function setToNumber($toNumber){
		$this->toNumber = intval($toNumber);
	}
	
	
	/**
	* @param	string	$observation
	*/
	public function setObservation($observation){
		$this->observation = substr(strval($observation), 0, 2048);
	}
	
	
	/**
	* @param	User	$user
	*/
	public function setUser($user){
		if(is_object($user)){
			$this->user = $user;
		} else {
			throw new Exception('Function expects an object as param. (Order->setUser($user))');
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
	* @return	Customer
	*/
	public function getCustomer(){
		return $this->customer;
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
	* @return	string
	*/
	public function getState(){
		return $this->state;
	}
	
	/**
	* @return	float
	*/
	public function getTotal(){
		return $this->total;
	}
	
	/**
	* @return	float
	*/
	public function getAdvance(){
		return $this->advance;
	}
	
	/**
	* @return	string
	*/
	public function getDeliveryDate(){
		return $this->deliveryDate;
	}
	
	/**
	* @return	int
	*/
	public function getAmount(){
		return $this->amount;
	}
	
	/**
	* @return	string
	*/
	public function getPaper(){
		return $this->paper;
	}
	
	/**
	* @return	string
	*/
	public function getColorPaper(){
		return $this->colorPaper;
	}
	
	/**
	* @return	int
	*/
	public function getWeight(){
		return $this->weight;
	}
	
	/**
	* @return	string
	*/
	public function getMachine(){
		return $this->machine;
	}
	
	/**
	* @return	string
	*/
	public function getTermination(){
		return $this->termination;
	}
	
	/**
	* @return	int
	*/
	public function getFromNumber(){
		return $this->fromNumber;
	}
	
	/**
	* @return	int
	*/
	public function getToNumber(){
		return $this->toNumber;
	}
	
	/**
	* @return	string
	*/
	public function getObservation(){
		return $this->observation;
	}
	
	/**
	* @return	User
	*/
	public function getUser(){
		return $this->user;
	}
}