<?php
/**
* @author    German Dosko
* @version   October 2 , 2012
*/
class Image extends AbstractEntity {
	
	/**
	* @var	int
	*/
	protected $id=null;
	
	/**
	* @var	string
	*/
	protected $page=null;
	
	/**
	* @var	string
	*/
	protected $smallPath=null;
	
	/**
	* @var	string
	*/
	protected $bigPath=null;
	
	/**
	* @var	string
	*/
	protected $downloadPath=null;
	
	/**
	* @var	string
	*/
	protected $altText=null;
	
	/**
	* @var	string
	*/
	protected $description=null;
	/**
	* @param	int	$id
	*/
	public function setId($id){
		$this->id = intval($id);
	}
	
	
	/**
	* @param	string	$page
	*/
	public function setPage($page){
		$this->page = substr(strval($page), 0, 128);
	}
	
	
	/**
	* @param	string	$smallPath
	*/
	public function setSmallPath($smallPath){
		$this->smallPath = substr(strval($smallPath), 0, 128);
	}
	
	
	/**
	* @param	string	$bigPath
	*/
	public function setBigPath($bigPath){
		$this->bigPath = substr(strval($bigPath), 0, 128);
	}
	
	
	/**
	* @param	string	$downloadPath
	*/
	public function setDownloadPath($downloadPath){
		$this->downloadPath = substr(strval($downloadPath), 0, 128);
	}
	
	
	/**
	* @param	string	$altText
	*/
	public function setAltText($altText){
		$this->altText = substr(strval($altText), 0, 128);
	}
	
	
	/**
	* @param	string	$description
	*/
	public function setDescription($description){
		$this->description = substr(strval($description), 0, 128);
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
	public function getPage(){
		return $this->page;
	}
	
	/**
	* @return	string
	*/
	public function getSmallPath(){
		return $this->smallPath;
	}
	
	/**
	* @return	string
	*/
	public function getBigPath(){
		return $this->bigPath;
	}
	
	/**
	* @return	string
	*/
	public function getDownloadPath(){
		return $this->downloadPath;
	}
	
	/**
	* @return	string
	*/
	public function getAltText(){
		return $this->altText;
	}
	
	/**
	* @return	string
	*/
	public function getDescription(){
		return $this->description;
	}
}