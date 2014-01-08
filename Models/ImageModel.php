<?php
/**
* @author							
* @version			October 2 , 2012
* @filesource			/Models/ImageModel.php
*/

class ImageModel extends AbstractModel {

	/**
	 * Saves the Image in the Data Base
	 *
	 * @param	Image
	 * @static
	 */
	public static function Save(&$image){
		$id = $image->getId();
		$properties = array(
			"page" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($image->getPage())) : htmlentities($image->getPage()),
			"smallPath" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($image->getSmallPath())) : htmlentities($image->getSmallPath()),
			"bigPath" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($image->getBigPath())) : htmlentities($image->getBigPath()),
			"downloadPath" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($image->getDownloadPath())) : htmlentities($image->getDownloadPath()),
			"altText" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($image->getAltText())) : htmlentities($image->getAltText()),
			"description" => self::$IsUsingUtf8 ? htmlentities(utf8_decode($image->getDescription())) : htmlentities($image->getDescription())
			);
		if(!empty($properties["page"]) && !empty($properties["smallPath"]) && !empty($properties["bigPath"]) && !empty($properties["altText"])){
			$query = new Query();
			if(!empty($id) && is_int($id)){
				$query->createUpdate('images', $properties, 'id = "'.$id.'"', true);
				$isExecuted = $query->execute();
				if(!$isExecuted){
					throw new Exception('Unable to update Image "'.$id.'" in database. (ImageModel::save())');
				}
			} else {
				$query->createInsert('images', $properties, true);
				$isExecuted = $query->execute();
				if($isExecuted){
					//get the last inserted id
					$query->createSelect(array('MAX(id) as id'), 'images');
					$value = $query->execute();
					$image->setId($value['id']);
				} else {
					throw new Exception('Unable to insert Image in database. (ImageModel::save())');
				}
			}
		} else {
			throw new Exception('Unable to save Image with empty required values. (ImageModel::save())');
		}
		return true;
	}

	/**
	 * Finds a Image by id
	 *
	 * @param	int	$id
	 * @return	 Image
	 * @static
	 */
	public static function FindById($id){
		$query = new Query();
		$query->createSelect(array('*'), 'images', array(), 'id = "'.$id.'"');
		$imageArray = $query->execute();
		$image = false;
		if(!empty($imageArray)){
			$image = self::CreateObjectFromArray($imageArray);
		}
		return $image;
	}

	/**
	 * Finds stored Image by specific values
	 *
	 * @param	array|string	$params
	 * @param	bool	$expectsOne
	 * @return	array|Image
	 * @static
	 */
	public static function FindBy($params, $expectsOne=false){
		$imagesArray = array();
		if(is_array($params)){
			$whereArray = array();
			foreach ($params as $key => $value){
				if(!empty($value)){
					$parsedValue = self::$IsUsingUtf8 ? htmlentities(utf8_decode($value)) : htmlentities($value);
					array_push($whereArray, $key.' = "'.$parsedValue.'"');
				}
			}
			$where = implode(' AND ', $whereArray);
			$query = new Query();
			$query->createSelect(array('*'), 'images', null, $where);
			$arrayArraysImage = $query->execute(true);
			if(!empty($arrayArraysImage)){
				if($expectsOne){
					return self::CreateObjectFromArray($arrayArraysImage[0]);
				}
				foreach($arrayArraysImage as $arrayImage){
					array_push($imagesArray, self::CreateObjectFromArray($arrayImage));
				}
			} elseif($expectsOne){
				return false;
			}
		}
		return $imagesArray;
	}


	/**
	 * Retrieves all Image stored in the data base
	 *
	 * @return	array|Image
	 *static
	*/
	public static function FetchAll(){
		$imagesArray = array();
		$query = new Query();
		$query->createSelect(array('*'), 'images');
		$arrayArraysImage = $query->execute(true);
		if(!empty($arrayArraysImage)){
			foreach($arrayArraysImage as $arrayImage){
				array_push($imagesArray, self::CreateObjectFromArray($arrayImage));
			}
		}
		return $imagesArray;
	}

	/**
	 * Deletes Image by id
	 *
	 * @param	int	$id
	 *static
	 */
	public static function Delete($id){
		$query = new Query();
		$query->createDelete('images', $id);
		return $query->execute();
	}

	/**
	 *Creates Image object from the basic properties
	 *
	 * @param	array|string	$properties
	 * @return	Image
	 *static
	 */
	
	public static function CreateObjectFromArray($properties){
		if(!empty($properties["id"]) && !empty($properties["page"]) && !empty($properties["smallPath"]) && !empty($properties["bigPath"]) && !empty($properties["altText"])){
			return new Image($properties);
		} else {
			throw new Exception('Unable to create Image with empty values. (ImageModel::CreateObjectFromArray())');
		}
	}

}