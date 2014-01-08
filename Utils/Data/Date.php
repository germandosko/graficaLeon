<?php
/**  
 * @author Web Design Rosario
 * @version Jan 10 2012
 */

class Date
{
	/** 
	 * Retrieves the current date with the GMT format
	 * 
	 * @return		string
	 * @static
	 */
	public static function GetSystemDate(){
		return date('Y-m-d H:m:s');
	}
	
	/** 
	 * Tries to parse the given date to create a MySQL datetime value
	 * 
	 * @param		string			$date
	 * @return		string
	 * @static
	 */
	public static function ParseDate($date=null){
		if(!empty($date)){
			if (($timestamp = strtotime($date)) !== false) {
				return date("Y-m-d H:i:s", $timestamp);
			} else {
				return false;
			}
		} else {
			return date("Y-m-d H:i:s");
		}
	}
	
}
