<?php
/**  
 * @author Web Design Rosario
 * @version Jan 10 2012
 */

class Connection
{
	private $connection;
	private $database;
	private $charset;

	public function __construct(){
		try{
			$this->createConnection();
		} catch(Exception $e) {
			throw new Exception("There was a low level fatal error connecting " 
									. "to Database. \n\t" . $e);
		}
	}	
			
	/** 
	* Create the conection with mysql database
	*/
	private function createConnection(){
		$this->connection = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
		$this->database = mysql_select_db(MYSQL_DB);
		$this->charset = mysql_set_charset('utf8');
	}	
			
	/** 
	* Close the conection with mysql database
	*/
	public function close(){
		mysql_close($this->connection);
	}
}