<?php

/**
 * @author			David Curras
 * @version			June 6, 2012
 * @filesource		/Utils/Code/PhpClassGenerator.php
 */
class PhpClassGenerator {

	/**
	 * The file author
	 *
	 * @var		string
	 */
	protected static $author = array();

	/**
	 * The object structure
	 *
	 * @var		array
	 */
	protected static $entities = array();
	
	/**
	 * The folder path where the .php file will be created
	 *
	 * @var		string
	 */
	protected static $folder = array();

	/**
	 * The output code
	 *
	 * @var		string
	 */
	protected static $code = array();
	
	/**
	 * Loads the class structure and other initial values
	 * 
	 * @param		string		$author
	 * @param		array		$entities
	 * @param		string		$folder
	 * @static
	 */
	public static function LoadInitialValues($author, $entities, $folder){
		self::$author = $author;
		self::$entities = $entities;
		self::$folder = $folder;
	}
	
	/**
	 * This function handles the process
	 *
	 * @static
	 */
	public static function run(){
		foreach(self::$entities as $class => $fields){
			self::CreateHeader($class);
			self::CreateProperties($fields);
			self::CreateSetters($class, $fields);
			self::CreateGetters($fields);
			self::$code .= '}';
			self::CreateFile($class);
		}
	}
	
	/**
	 * Creates the header
	 * 
	 * @param		string		$class
	 * @static
	 */
	public static function CreateHeader($class){
		self::$code = '<?php' . "\n";
		self::$code .= '/**' . "\n";
		self::$code .= ' * @author' . "\t\t" . self::$author . "\n";
		self::$code .= ' * @version' . "\t\t" . date("F j, Y"). "\n";
		self::$code .= ' */' . "\n\n";
		self::$code .= 'class ' . $class . ' extends AbstractEntity {' . "\n\n";
	}
	
	/**
	 * Creates the properties
	 *
	 * @param		array		$fields
	 * @static
	 */
	public static function CreateProperties($fields){
		foreach($fields as $field => $type){
			self::$code .= "\t" . '/**' . "\n";
			self::$code .= "\t" . ' * @var' . "\t\t" . $type[0] . "\n";
			self::$code .= "\t" . ' */' . "\n";
			self::$code .= "\t" . 'protected $' . lcfirst($field) . ' = null;' . "\n\n";
		}
	}
	
	/**
	 * Creates the setter methods
	 *
	 * @param		string		$class
	 * @param		array		$fields
	 * @static
	 */
	public static function CreateSetters($class, $fields){
		foreach($fields as $field => $type){
			self::$code .= "\t" . '/**' . "\n";
			self::$code .= "\t" . ' * @param' . "\t\t" . $type[0] . "\t\t" . '$' . lcfirst($field) . "\n";
			self::$code .= "\t" . ' */' . "\n";
			self::$code .= "\t" . 'public function set' . ucfirst($field) . '($' . lcfirst($field) . '){' . "\n";
			switch(strtoupper($type[0])){
				case 'STRING':
					self::$code .= "\t\t" . '$this->' . lcfirst($field) . ' = substr(strval($' . lcfirst($field) . '), 0, ' . $type[1] . ');' . "\n";
					break;
				case 'DATE':
					self::$code .= "\t\t" . '$this->' . lcfirst($field) . ' = substr(strval($' . lcfirst($field) . '), 0, 32);' . "\n";
					break;
				case 'INT':
					self::$code .= "\t\t" . '$this->' . lcfirst($field) . ' = intval($' . lcfirst($field) . ');' . "\n";
					break;
				case 'FLOAT':
					self::$code .= "\t\t" . '$this->' . lcfirst($field) . ' = floatval($' . lcfirst($field) . ');' . "\n";
					break;
				case 'BOOL':
					self::$code .= "\t\t" . '$this->' . lcfirst($field) . ' = $' . lcfirst($field) . ';' . "\n";
					break;
				case 'ARRAY':
					self::$code .= "\t\t" . 'if(is_array($' . lcfirst($field) . ')){' . "\n";
					self::$code .= "\t\t\t" . '$this->' . lcfirst($field) . ' = $' . lcfirst($field) . ';' . "\n";
					self::$code .= "\t\t" . '} else {' . "\n";
					self::$code .= "\t\t\t" . "throw new Exception('Function expects an array as param. (".$class."->set".ucfirst($field)."($".lcfirst($field)."))');" . "\n";
					self::$code .= "\t\t" . '}' . "\n";
					break;
				default:
					self::$code .= "\t\t" . 'if(is_object($' . lcfirst($field) . ')){' . "\n";
					self::$code .= "\t\t\t" . '$this->' . lcfirst($field) . ' = $' . lcfirst($field) . ';' . "\n";
					self::$code .= "\t\t" . '} else {' . "\n";
					self::$code .= "\t\t\t" . "throw new Exception('Function expects an object as param. (".$class."->set".ucfirst($field)."($".lcfirst($field)."))');" . "\n";
					self::$code .= "\t\t" . '}' . "\n";
			}
			self::$code .= "\t" . '}' . "\n\n";
		}
	}
	
	/**
	 * Creates the getter methods
	 *
	 * @param		array		$fields
	 * @static
	 */
	public static function CreateGetters($fields){
		foreach($fields as $field=>$type){
			self::$code .= "\t" . '/**' . "\n";
			self::$code .= "\t" . ' * @return' . "\t\t" . $type[0] . "\n";
			self::$code .= "\t" . ' */' . "\n";
			self::$code .= "\t" . 'public function get' . ucfirst($field) . '(){' . "\n";
			self::$code .= "\t\t" . 'return $this->' . lcfirst($field) . ';' . "\n";
			self::$code .= "\t" . '}' . "\n\n";
		}
	}
	
	/**
	 * Creates the .php file
	 *
	 * @param		string		$class
	 * @static
	 */
	public static function CreateFile($class){
		$fileName = self::$folder . $class . '.php';
		$fh = fopen($fileName , 'w') or die("can't open file");
		fwrite($fh, self::$code);
		fclose($fh);
		if(is_file($fileName)){
			chmod($fileName, 0774);
		}
		echo '<b>File created:</b>' . $fileName . '<br />';
	}
}

/*

$entities = array(
	'Bundle' => array(
		'id' => array('int'),
		'metadata' => array('Metadata'),
		'language' => array('Language'),
		'region' => array('Region'),
		'partner' => array('Partner'),
		'type' => array('Type'),
		'state' => array('State'),
		'processDate' => array('string', 32),
		'entityId' => array('string', 255)
	),
	'Language' => array(
		'code' => array('string', 3),
		'alt' => array('string', 2),
		'name' => array('string', 255)
	),
	'Log' => array(
		'id' => array('int'),
		'bundle' => array('Bundle'),
		'description' => array('string', 1023),
		'isError' => array('bool'),
		'active' => array('bool')
	),
	'Metadata' => array(
		'id' => array('int'),
		'video' => array('Video'),
		'airDate' => array('string', 255),
		'archiveStatus' => array('string', 255),
		'assetGUID' => array('string', 255),
		'assetID' => array('int'),
		'author' => array('string', 255),
		'category' => array('string', 255),
		'copyrightHolder' => array('string', 255),
		'description' => array('string', 1023),
		'dTOAssetXMLExportstage1' => array('bool'),
		'dTOContainerPosition' => array('string', 255),
		'dTOEpisodeID' => array('string', 255),
		'dTOEpisodeName' => array('string', 255),
		'dTOGenre' => array('string', 255),
		'dTOLongDescription' => array('string', 1023),
		'dTOLongEpisodeDescription' => array('string', 2047),
		'dTORatings' => array('string', 255),
		'dTOReleaseDate' => array('string', 255),
		'dTOSalesPrice' => array('string', 255),
		'dTOSeasonID' => array('string', 255),
		'dTOSeasonName' => array('string', 255),
		'dTOSeriesDescription' => array('string', 1023),
		'dTOSeriesID' => array('string', 255),
		'dTOShortEpisodeDescription' => array('string', 1023),
		'dTOShortDescription' => array('string', 1023),
		'eMDeliveryAsset' => array('bool'),
		'episodeName' => array('string', 255),
		'episodeNumber' => array('int'),
		'forceDTOexportXML' => array('bool'),
		'forceDTOproxyAsset' => array('bool'),
		'genre' => array('string', 255),
		'keywords' => array('string', 255),
		'licenseStartDate' => array('string', 255),
		'localEntity' => array('bool'),
		'location' => array('string', 255),
		'mediaType' => array('string', 255),
		'metadataSet' => array('string', 255),
		'network' => array('string', 255),
		'owner' => array('string', 255),
		'ratingsOverride' => array('string', 255),
		'ratingSystem' => array('string', 255),
		'releaseYear' => array('string', 255),
		'seasonDescription' => array('string', 1023),
		'seasonLanguage' => array('string', 255),
		'seasonName' => array('string', 255),
		'seasonNumber' => array('string', 255),
		'seasonOverride' => array('string', 255),
		'seriesDescription' => array('string', 1023),
		'seriesName' => array('string', 255),
		'status' => array('string', 255),
		'storeandtrackversionsofthisasset' => array('bool'),
		'syndicationPartnerDelivery' => array('string', 255),
		'title' => array('string', 255),
		'tVRating' => array('string', 255)
	),
	'Partner' => array(
		'id' => array('int'),
		'name' => array('string', 255)
	),
	'Region' => array(
		'code' => array('string', 2),
		'country' => array('string', 255),
		'language' => array('Language')
	),
	'State' => array(
		'id' => array('int'),
		'name' => array('string', 255)
	),
	'Type' => array(
		'id' => array('int'),
		'name' => array('string', 255)
	),
	'Video' => array(
		'id' => array('int'),
		'audioCodec' => array('string', 255),
		'createdBy' => array('string', 255),
		'creationDate' => array('string', 32),
		'dTOVideoType' => array('string', 255),
		'duration' => array('string', 255),
		'fileCreateDate' => array('string', 32),
		'fileModificationDate' => array('string', 32),
		'fileName' => array('string', 255),
		'imageSize' => array('string', 255),
		'lastAccessed' => array('string', 32),
		'lastModified' => array('string', 32),
		'mD5Hash' => array('string', 255),
		'mD5HashRecal' => array('bool'),
		'mimeType' => array('string', 255),
		'size' => array('string', 255),
		'storedOn' => array('string', 255),
		'timecodeOffset' => array('string', 255),
		'videoBitrate' => array('string', 255),
		'videoCodec' => array('string', 255),
		'videoElements' => array('string', 255),
		'videoFrameRate' => array('string', 255)
	)
);
*/