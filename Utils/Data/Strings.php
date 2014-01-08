<?php
/**  
 * @author Web Design Rosario
 * @version Jan 10 2012
 */

class Strings
{
	/** 
	 * Returns true if the string contains only alphabetic characters
	 * 
	 * @param		string		$str
	 * @return		boolean
	 * @static
	 */
	public static function IsAlpha($str){
		if(strlen($str) == 0){
			return false;
		}
		$strArray = str_split($str);
		foreach($strArray as $char){
			$isAlpha = ((ord($char) > 64) && (ord($char) < 91)) || ((ord($char) > 96) && (ord($char) < 123));
			$isEspecialChar = (ord($char) == 193) || (ord($char) == 201) ||
				(ord($char) == 205) || (ord($char) == 209) || (ord($char) == 211) ||
				(ord($char) == 218) || (ord($char) == 220) || (ord($char) == 225) ||
				(ord($char) == 233) || (ord($char) == 237) || (ord($char) == 241) ||
				(ord($char) == 243) || (ord($char) == 250) || (ord($char) == 252);
			if(!$isAlpha && !$isEspecialChar){
				return false;
			}
		}
		return true;
	}
	
	/** 
	 * Returns true if the string contains only numeric characters
	 * 
	 * @param		string		$str
	 * @return		boolean
	 * @static
	 */
	public static function IsNumeric($str){
		if(strlen($str) == 0){
			return false;
		}
		$strArray = str_split($str);
		foreach($strArray as $char){
			$isNumeric = (ord($char) > 47) && (ord($char) < 58);
			if(!$isNumeric){
				return false;
			}
		}
		return true;
	}
}