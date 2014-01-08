<?php

/**
 * @author			David Curras
 * @version			June 6, 2012
 * @filesource		/Utils/Code/JsClassGenerator.php
 */
class JsClassGenerator {

	/**
	 * The file author
	 *
	 * @var		string
	 */
	protected static $author = array();

	/**
	 * The Classes structure
	 *
	 * @var		array
	 */
	protected static $entities = array();

	/**
	 * The folder path where the .js file will be created
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
	 * Loads the folders class and other initial values
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
			self::CreateConstructor($fields);
			self::CreateSetters($class, $fields);
			self::CreateGetters($fields);
			self::CreateReturn($fields);
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
		self::$code = '/**' . "\n";
		self::$code .= ' * This class represents a ' . $class . "\n";
		self::$code .= ' *' . "\n";
		self::$code .= ' * @author' . "\t\t" . self::$author . "\n";
		self::$code .= ' * @version' . "\t\t" . date("F j, Y"). "\n";
		self::$code .= ' */' . "\n";
		self::$code .= 'var ' . $class . ' = function(genericObj) {' . "\n\n";
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
			switch(strtoupper($type[0])){
				case 'STRING':
					self::$code .= "\t" . 'var _' . lcfirst($field) . ' = \'\';' . "\n\n";
					break;
				case 'NUMBER':
					self::$code .= "\t" . 'var _' . lcfirst($field) . ' = 0;' . "\n\n";
					break;
				case 'BOOL':
				case 'BOOLEAN':
					self::$code .= "\t" . 'var _' . lcfirst($field) . ' = false;' . "\n\n";
					break;
				case 'ARRAY':
					self::$code .= "\t" . 'var _' . lcfirst($field) . ' = new Array();' . "\n\n";
					break;
				default:
					self::$code .= "\t" . 'var _' . lcfirst($field) . ' = new ' . $type[0] . '();' . "\n\n";
			}
		}
	}
	
	/**
	 * Creates the properties
	 *
	 * @param		array		$fields
	 * @static
	 */
	public static function CreateConstructor($fields){
		self::$code .= "\t" . '/**' . "\n";
		self::$code .= "\t" . ' * Constructor' . "\n";
		self::$code .= "\t" . ' */' . "\n";
		self::$code .= "\t" . 'var init = function() {' . "\n";
		self::$code .= "\t\t" . 'if(Validator.IsInstanceOf(\'Object\', genericObj)){' . "\n";
		self::$code .= "\t\t\t" . '$.each(genericObj, function(property, value){' . "\n";
		self::$code .= "\t\t\t\t" . "switch (property.toUpperCase()) {" . "\n";
		foreach($fields as $field => $type){
			self::$code .= "\t\t\t\t\t" . "case '" . strtoupper($field) . "':" . "\n";
			self::$code .= "\t\t\t\t\t\t_set" . ucfirst($field) .  '(value);' . "\n";
			self::$code .= "\t\t\t\t\t\t" . 'break;' . "\n";
		}
		self::$code .= "\t\t\t\t" . "}" . "\n";
		self::$code .= "\t\t\t" . '});' . "\n";
		self::$code .= "\t\t" . '}' . "\n";
		self::$code .= "\t" . '};' . "\n\n";
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
			self::$code .= "\t" . ' * @param' . "\t\t" . $type[0] . "\t\t" . lcfirst($field) . "\n";
			self::$code .= "\t" . ' */' . "\n";
			self::$code .= "\t" . 'var _set' . ucfirst($field) . ' = function(' . lcfirst($field) . '){' . "\n";
			switch(strtoupper($type[0])){
				case 'STRING':
					self::$code .= "\t\t_" . lcfirst($field) .  ' = String(' . lcfirst($field) . ');' . "\n";
					break;
				case 'NUMBER':
					self::$code .= "\t\t_" . lcfirst($field) .  ' = Number(' . lcfirst($field) . ');' . "\n";
					break;
				case 'BOOL':
				case 'BOOLEAN':
					self::$code .= "\t\t_" . lcfirst($field) .  ' = Boolean(' . lcfirst($field) . ');' . "\n";
					break;
				case 'ARRAY':
					self::$code .= "\t\t" . 'if($.isArray(' . lcfirst($field) . ')){' . "\n";
					self::$code .= "\t\t\t_" . lcfirst($field) .  ' = ' . lcfirst($field) . ';' . "\n";
					self::$code .= "\t\t" . '} else {' . "\n";
					self::$code .= "\t\t\t" . 'console.error(\'Function expects an array as param. ( '.$class.'.set' . ucfirst($field) . ' ))' . "\n";
					self::$code .= "\t\t" . '}' . "\n";
					break;
				default:
					self::$code .= "\t\t" . 'if(Validator.IsInstanceOf(\'Object\', ' . lcfirst($field) . ')){' . "\n";
					self::$code .= "\t\t\t_" . lcfirst($field) .  ' = new ' . ucfirst($field) . '(' . lcfirst($field) . ');' . "\n";
					self::$code .= "\t\t" . '} else {' . "\n";
					self::$code .= "\t\t\t" . 'console.error(\'Function expects an object as param. ( '.$class.'.set' . ucfirst($field) . ' )\');' . "\n";
					self::$code .= "\t\t" . '}' . "\n";
			}
			self::$code .= "\t" . '};' . "\n\n";
		}
	}
	
	/**
	 * Creates the getter methods
	 *
	 * @param		array		$fields
	 * @static
	 */
	public static function CreateGetters($fields){
		foreach($fields as $field => $type){
			self::$code .= "\t" . '/**' . "\n";
			self::$code .= "\t" . ' * @return' . "\t\t" . $type[0] . "\n";
			self::$code .= "\t" . ' */' . "\n";
			self::$code .= "\t" . 'var _get' . ucfirst($field) . ' = function(){' . "\n";
			self::$code .= "\t\t" . 'return _' . lcfirst($field) . ';' . "\n";
			self::$code .= "\t" . '};' . "\n\n";
		}
	}
	
	/**
	 * Creates the return statement and the public methods
	 *
	 * @param		array		$fields
	 * @static
	 */
	public static function CreateReturn($fields){
		self::$code .= "\t" . '/**' . "\n";
		self::$code .= "\t" . ' * Executes constructor' . "\n";
		self::$code .= "\t" . ' */' . "\n";
		self::$code .= "\t" . 'init();' . "\n\n";
		self::$code .= "\t" . '/**' . "\n";
		self::$code .= "\t" . ' * Returns public functions' . "\n";
		self::$code .= "\t" . ' */' . "\n";
		self::$code .= "\t" . 'return{' . "\n\n";
		foreach($fields as $field=>$type){
			self::$code .= "\t\t" . '/**' . "\n";
			self::$code .= "\t\t" . ' * @param' . "\t\t" . $type[0] . "\t\t" . lcfirst($field) . "\n";
			self::$code .= "\t\t" . ' */' . "\n";
			self::$code .= "\t\t" . 'set' . ucfirst($field) . ' : function(' . lcfirst($field) . '){' . "\n";
			self::$code .= "\t\t\t" . '_set' . ucfirst($field) . '(' . lcfirst($field) . ');' . "\n";
			self::$code .= "\t\t" . '},' . "\n\n";
		}
		foreach($fields as $field=>$type){
			self::$code .= "\t\t" . '/**' . "\n";
			self::$code .= "\t\t" . ' * @return' . "\t\t" . $type[0] . "\n";
			self::$code .= "\t\t" . ' */' . "\n";
			self::$code .= "\t\t" . 'get' . ucfirst($field) . ' : function(){' . "\n";
			self::$code .= "\t\t\t" . 'return _get' . ucfirst($field) . '();' . "\n";
			self::$code .= "\t\t" . '},' . "\n\n";
		}
		self::$code .= "\t" . '};' . "\n";
		self::$code .= '};';
	}
	
	/**
	 * Creates the .js file
	 *
	 * @param		string		$class
	 * @static
	 */
	public static function CreateFile($class){
		$fileName = self::$folder . $class . '.js';
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
			'id' => array('Number'),
			'metadata' => array('Metadata'),
			'language' => array('Language'),
			'region' => array('Region'),
			'partner' => array('Partner'),
			'type' => array('Type'),
			'state' => array('State'),
			'processDate' => array('String', 32),
			'entityId' => array('String', 255)
		),
	'Language' => array(
			'code' => array('String', 3),
			'alt' => array('String', 2),
			'name' => array('String', 255)
		),
	'Log' => array(
			'id' => array('Number'),
			'bundle' => array('Bundle'),
			'description' => array('String', 1023),
			'isError' => array('Boolean'),
			'active' => array('Boolean')
		),
	'Metadata' => array(
			'id' => array('Number'),
			'video' => array('Video'),
			'airDate' => array('String', 255),
			'archiveStatus' => array('String', 255),
			'assetGUID' => array('String', 255),
			'assetID' => array('Number'),
			'author' => array('String', 255),
			'category' => array('String', 255),
			'copyrightHolder' => array('String', 255),
			'description' => array('String', 1023),
			'dTOAssetXMLExportstage1' => array('Boolean'),
			'dTOContainerPosition' => array('String', 255),
			'dTOEpisodeID' => array('String', 255),
			'dTOEpisodeName' => array('String', 255),
			'dTOGenre' => array('String', 255),
			'dTOLongDescription' => array('String', 1023),
			'dTOLongEpisodeDescription' => array('String', 2047),
			'dTORatings' => array('String', 255),
			'dTOReleaseDate' => array('String', 255),
			'dTOSalesPrice' => array('String', 255),
			'dTOSeasonID' => array('String', 255),
			'dTOSeasonName' => array('String', 255),
			'dTOSeriesDescription' => array('String', 1023),
			'dTOSeriesID' => array('String', 255),
			'dTOShortEpisodeDescription' => array('String', 1023),
			'dTOShortDescription' => array('String', 1023),
			'eMDeliveryAsset' => array('Boolean'),
			'episodeName' => array('String', 255),
			'episodeNumber' => array('Number'),
			'forceDTOexportXML' => array('Boolean'),
			'forceDTOproxyAsset' => array('Boolean'),
			'genre' => array('String', 255),
			'keywords' => array('String', 255),
			'licenseStartDate' => array('String', 255),
			'localEntity' => array('Boolean'),
			'location' => array('String', 255),
			'mediaType' => array('String', 255),
			'metadataSet' => array('String', 255),
			'network' => array('String', 255),
			'owner' => array('String', 255),
			'ratingsOverride' => array('String', 255),
			'ratingSystem' => array('String', 255),
			'releaseYear' => array('String', 255),
			'seasonDescription' => array('String', 1023),
			'seasonLanguage' => array('String', 255),
			'seasonName' => array('String', 255),
			'seasonNumber' => array('String', 255),
			'seasonOverride' => array('String', 255),
			'seriesDescription' => array('String', 1023),
			'seriesName' => array('String', 255),
			'status' => array('String', 255),
			'storeandtrackversionsofthisasset' => array('Boolean'),
			'syndicationPartnerDelivery' => array('String', 255),
			'title' => array('String', 255),
			'tVRating' => array('String', 255)
		),
	'Partner' => array(
			'id' => array('Number'),
			'name' => array('String', 255)
		),
	'Region' => array(
			'code' => array('String', 2),
			'country' => array('String', 255),
			'language' => array('Language')
		),
	'State' => array(
			'id' => array('Number'),
			'name' => array('String', 255)
		),
	'Type' => array(
			'id' => array('Number'),
			'name' => array('String', 255)
		),
	'Video' => array(
			'id' => array('Number'),
			'audioCodec' => array('String', 255),
			'createdBy' => array('String', 255),
			'creationDate' => array('String', 32),
			'dTOVideoType' => array('String', 255),
			'duration' => array('String', 255),
			'fileCreateDate' => array('String', 32),
			'fileModificationDate' => array('String', 32),
			'fileName' => array('String', 255),
			'imageSize' => array('String', 255),
			'lastAccessed' => array('String', 32),
			'lastModified' => array('String', 32),
			'mD5Hash' => array('String', 255),
			'mD5HashRecal' => array('Boolean'),
			'mimeType' => array('String', 255),
			'size' => array('String', 255),
			'storedOn' => array('String', 255),
			'timecodeOffset' => array('String', 255),
			'videoBitrate' => array('String', 255),
			'videoCodec' => array('String', 255),
			'videoElements' => array('String', 255),
			'videoFrameRate' => array('String', 255)
		)
);
*/