<?php
/**  
 * @author Web Design Rosario
 * @version Jan 10 2012
 */

class Number
{
	/** 
	 * Convert the given number to a float value with specific decimal positions
	 * 
	 * @param		mixed		$number
	 * @param		int			$decimalPositions
	 * @return		float
	 * @static
	 */
	public static function getDecimalValue($number, $decimalPositions){
		return floatval(number_format($number, $decimalPositions, '.', ''));
	}
}