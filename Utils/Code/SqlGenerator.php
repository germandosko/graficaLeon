<?php

/**
 * @author			David Curras
 * @version			June 6, 2012
 * @filesource		/Utils/Code/SqlGenerator.php
 */
class SqlGenerator {

	/**
	 * The file author
	 *
	 * @var		string
	 */
	protected static $author = array();
	
	/**
	 * The data base name
	 *
	 * @var		string
	 */
	protected static $db = array();

	/**
	 * The tables structure
	 *
	 * @var		array
	 */
	protected static $tables = array();
	
	/**
	 * The folder path where the .sql file will be created
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
	 * Loads the folders table and other initial values
	 * 
	 * @param		string		$author
	 * @param		string		$db
	 * @param		array		$tables
	 * @param		string		$folder
	 * @static
	 */
	public static function LoadInitialValues($author, $db, $tables, $folder){
		self::$author = $author;
		self::$db = $db;
		self::$tables = $tables;
		self::$folder = $folder;
	}

	/**
	 * This function handles the process
	 *
	 * @static
	 */
	public static function run(){
		self::CreateHeader();
		self::CreateTables();
		self::CreateRelationships();
		self::CreateFile();
	}
	
	/**
	 * Creates the header
	 * 
	 * @static
	 */
	public static function CreateHeader(){
		self::$code = 'SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";' . "\n";
		self::$code  .= 'SET time_zone = "+00:00";' . "\n\n";
		self::$code .= 'CREATE DATABASE `'. self::$db .'` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;' . "\n";
		self::$code .= 'USE `'. self::$db .'`;' . "\n\n";
		self::$code .= '-- --------------------------------------------------------' . "\n\n";
	}
	
	/**
	 * Creates the tables
	 *
	 * @static
	 */
	public static function CreateTables(){
		foreach(self::$tables as $table => $data){
			self::$code .= 'CREATE TABLE IF NOT EXISTS `'. $table .'` (' . "\n";
			$fieldList = array();
			foreach($data['fields'] as $field => $settings){
				self::$code .= "\t" . '`'. $field .'` '. implode(' ', $settings) .',' . "\n";
				array_push($fieldList, $field);
			}
			self::$code .= "\t" . 'PRIMARY KEY (`'. implode('`, `', $data['pk']) .'`),' . "\n";
			foreach($data['fk'] as $field => $relation){
				self::$code .= "\t" . 'KEY `'. $field .'` (`'. $field .'`),' . "\n";
			}
			self::$code = substr(self::$code, 0, -2) . "\n"; //Deletes the last "end-line" and "comma" chars
			self::$code .= ') ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;' . "\n\n";
			if(!empty($data['inserts'])){
				self::$code .= 'INSERT INTO `'.$table.'` (`' . implode('`, `', $fieldList) . '`) VALUES' . "\n";
				$insertStrings = array();
				foreach($data['inserts'] as $values){
					array_push($insertStrings, '(\'' . implode('\', \'', $values) . '\')');
				}
				$inserts = str_ireplace('\'NULL\'', 'NULL', implode(",\n\t", $insertStrings));
				self::$code .= "\t" . $inserts . ';' . "\n\n";;
			}
			self::$code .= '-- --------------------------------------------------------' . "\n\n";
		}
	}
	
	/**
	 * Creates the relationships
	 *
	 * @static
	 */
	public static function CreateRelationships(){
		foreach(self::$tables as $table => $data){
			if(!empty($data['fk'])){
				self::$code .= 'ALTER TABLE `'. $table .'`' . "\n";
				$i = 1;
				foreach($data['fk'] as $field => $relation){
					self::$code .= "\t" . 'ADD CONSTRAINT `'. $table .'_ibfk_'. $i .'` FOREIGN KEY (`' . $field . '`) REFERENCES `' . $relation[0] . '` (`' . $relation[1] . '`),' . "\n";
					++$i;
				}
				self::$code = substr(self::$code, 0, -2) . ";\n\n"; //Deletes the last "end-line" and "comma" chars
			}
		}
	}
	
	/**
	 * Creates the .sql file
	 *
	 * @static
	 */
	public static function CreateFile(){
		$fileName = self::$folder . self::$db . '.sql';
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
 $tables = array(
 		'bundles' => array(
 				'fields' => array(
 						'id' => array('int(11)', 'NOT NULL', 'AUTO_INCREMENT'),
 						'metadataId' => array('int(11)', 'NOT NULL'),
 						'languageId' => array('char(3)', 'DEFAULT NULL'),
 						'regionId' => array('char(2)', 'DEFAULT NULL'),
 						'partnerId' => array('int(11)', 'NOT NULL'),
 						'typeId' => array('int(11)', 'NOT NULL'),
 						'stateId' => array('int(11)', 'NOT NULL'),
 						'processDate' => array('datetime', 'NOT NULL'),
 						'entityId' => array('varchar(255)', 'DEFAULT NULL')
 				),
 				'pk' => array('id'),
 				'fk' => array(
 						'metadataId' => array('metadata', 'id'),
 						'languageId' => array('languages', 'code'),
 						'regionId' => array('regions', 'code'),
 						'partnerId' => array('partners', 'id'),
 						'typeId' => array('types', 'id'),
 						'stateId' => array('states', 'id')
 				),
 				'inserts' => array()
 		),
 		'languages' => array(
 				'fields' => array(
 						'code' => array('char(3)', 'NOT NULL'),
 						'alt' => array('char(2)', 'DEFAULT NULL'),
 						'name' => array('varchar(255)', 'NOT NULL')
 				),
 				'pk' => array('code'),
 				'fk' => array(),
 				'inserts' => array(
 						array('DEU', 'DE', 'GERMAN'),
 						array('ENG', 'EN', 'ENGLISH'),
 						array('FRE', 'FR', 'FRENCH'),
 						array('ITA', 'IT', 'ITALIAN'),
 						array('JPN', 'JP', 'JAPANESE'),
 						array('SPA', 'ES', 'SPANISH')
 				)
 		),
 		'logs' => array(
 				'fields' => array(
 						'id' => array('int(11)', 'NOT NULL', 'AUTO_INCREMENT'),
 						'bundleId' => array('int(11)', 'NOT NULL'),
 						'description' => array('varchar(1023)', 'NOT NULL'),
 						'isError' => array('tinyint(1)', 'NOT NULL'),
 						'active' => array('tinyint(1)', 'NOT NULL')
 				),
 				'pk' => array('id'),
 				'fk' => array(
 						'bundleId' => array('bundles', 'id')
 				),
 				'inserts' => array()
 		),
 		'metadata' => array(
 				'fields' => array(
 						'id' => array('int(11)', 'NOT NULL', 'AUTO_INCREMENT'),
 						'videoId' => array('int(11)', 'NOT NULL'),
 						'airDate' => array('varchar(255)', 'DEFAULT NULL'),
 						'archiveStatus' => array('varchar(255)', 'DEFAULT NULL'),
 						'assetGUID' => array('varchar(255)', 'DEFAULT NULL'),
 						'assetID' => array('int(11)', 'DEFAULT NULL'),
 						'author' => array('varchar(255)', 'DEFAULT NULL'),
 						'category' => array('varchar(255)', 'DEFAULT NULL'),
 						'copyrightHolder' => array('varchar(255)', 'DEFAULT NULL'),
 						'description' => array('varchar(1023)', 'DEFAULT NULL'),
 						'dTOAssetXMLExportstage1' => array('tinyint(1)', 'DEFAULT NULL'),
 						'dTOContainerPosition' => array('varchar(255)', 'DEFAULT NULL'),
 						'dTOEpisodeID' => array('varchar(255)', 'DEFAULT NULL'),
 						'dTOEpisodeName' => array('varchar(255)', 'DEFAULT NULL'),
 						'dTOGenre' => array('varchar(255)', 'DEFAULT NULL'),
 						'dTOLongDescription' => array('varchar(1023)', 'DEFAULT NULL'),
 						'dTOLongEpisodeDescription' => array('varchar(2047)', 'DEFAULT NULL'),
 						'dTORatings' => array('varchar(255)', 'DEFAULT NULL'),
 						'dTOReleaseDate' => array('varchar(255)', 'DEFAULT NULL'),
 						'dTOSalesPrice' => array('varchar(255)', 'DEFAULT NULL'),
 						'dTOSeasonID' => array('varchar(255)', 'DEFAULT NULL'),
 						'dTOSeasonName' => array('varchar(255)', 'DEFAULT NULL'),
 						'dTOSeriesDescription' => array('varchar(1023)', 'DEFAULT NULL'),
 						'dTOSeriesID' => array('varchar(255)', 'DEFAULT NULL'),
 						'dTOShortEpisodeDescription' => array('varchar(1023)', 'DEFAULT NULL'),
 						'dTOShortDescription' => array('varchar(1023)', 'DEFAULT NULL'),
 						'eMDeliveryAsset' => array('tinyint(1)', 'DEFAULT NULL'),
 						'episodeName' => array('varchar(255)', 'DEFAULT NULL'),
 						'episodeNumber' => array('int(11)', 'DEFAULT NULL'),
 						'forceDTOexportXML' => array('tinyint(1)', 'DEFAULT NULL'),
 						'forceDTOproxyAsset' => array('tinyint(1)', 'DEFAULT NULL'),
 						'genre' => array('varchar(255)', 'DEFAULT NULL'),
 						'keywords' => array('varchar(255)', 'DEFAULT NULL'),
 						'licenseStartDate' => array('varchar(255)', 'DEFAULT NULL'),
 						'localEntity' => array('tinyint(1)', 'DEFAULT NULL'),
 						'location' => array('varchar(255)', 'DEFAULT NULL'),
 						'mediaType' => array('varchar(255)', 'DEFAULT NULL'),
 						'metadataSet' => array('varchar(255)', 'DEFAULT NULL'),
 						'network' => array('varchar(255)', 'DEFAULT NULL'),
 						'owner' => array('varchar(255)', 'DEFAULT NULL'),
 						'ratingsOverride' => array('varchar(255)', 'DEFAULT NULL'),
 						'ratingSystem' => array('varchar(255)', 'DEFAULT NULL'),
 						'releaseYear' => array('varchar(255)', 'DEFAULT NULL'),
 						'seasonDescription' => array('varchar(1023)', 'DEFAULT NULL'),
 						'seasonLanguage' => array('varchar(255)', 'DEFAULT NULL'),
 						'seasonName' => array('varchar(255)', 'DEFAULT NULL'),
 						'seasonNumber' => array('varchar(255)', 'DEFAULT NULL'),
 						'seasonOverride' => array('varchar(255)', 'DEFAULT NULL'),
 						'seriesDescription' => array('varchar(1023)', 'DEFAULT NULL'),
 						'seriesName' => array('varchar(255)', 'DEFAULT NULL'),
 						'status' => array('varchar(255)', 'DEFAULT NULL'),
 						'storeandtrackversionsofthisasset' => array('tinyint(1)', 'DEFAULT NULL'),
 						'syndicationPartnerDelivery' => array('varchar(255)', 'DEFAULT NULL'),
 						'title' => array('varchar(255)', 'DEFAULT NULL'),
 						'tVRating' => array('varchar(255)', 'DEFAULT NULL'),
 				),
 				'pk' => array('id'),
 				'fk' => array(
 						'videoId' => array('videos', 'id')
 				),
 				'inserts' => array()
 		),
 		'partners' => array(
 				'fields' => array(
 						'id' => array('int(11)', 'NOT NULL', 'AUTO_INCREMENT'),
 						'name' => array('varchar(255)', 'NOT NULL')
 				),
 				'pk' => array('id'),
 				'fk' => array(),
 				'inserts' => array(
 						array(1, 'iTunes'),
 						array(2, 'Sony'),
 						array(3, 'Xbox'),
 						array(4, 'StarHub')
 				)
 		),
 		'regions' => array(
 				'fields' => array(
 						'code' => array('char(2)', 'NOT NULL'),
 						'country' => array('varchar(255)', 'NOT NULL'),
 						'language' => array('char(3)', 'NOT NULL')
 				),
 				'pk' => array('code'),
 				'fk' => array(
 						'language' => array('languages', 'code')
 				),
 				'inserts' => array(
 						array('AU', 'AUSTRALIA', 'ENG'),
 						array('CA', 'CANADA', 'FRE'),
 						array('DE', 'GERMANY', 'DEU'),
 						array('ES', 'SPAIN', 'SPA'),
 						array('FR', 'FRANCE', 'FRE'),
 						array('GB', 'UNITED KINGDOM', 'ENG'),
 						array('IT', 'ITALY', 'ITA'),
 						array('JP', 'JAPAN', 'JPN'),
 						array('MX', 'MEXICO', 'SPA'),
 						array('US', 'UNITED STATES OF AMERICA', 'ENG')
 				)
 		),
 		'states' => array(
 				'fields' => array(
 						'id' => array('int(11)', 'NOT NULL', 'AUTO_INCREMENT'),
 						'name' => array('varchar(255)', 'NOT NULL')
 				),
 				'pk' => array('id'),
 				'fk' => array(),
 				'inserts' => array(
 						array(1, 'NONSTARTED'),
 						array(2, 'STARTED'),
 						array(3, 'INCOMPLETE'),
 						array(4, 'SUCCESS'),
 						array(5, 'FAILED')
 				)
 		),
 		'types' => array(
 				'fields' => array(
 						'id' => array('int(11)', 'NOT NULL', 'AUTO_INCREMENT'),
 						'name' => array('varchar(255)', 'NOT NULL')
 				),
 				'pk' => array('id'),
 				'fk' => array(),
 				'inserts' => array(
 						array(1, 'MERGE'),
 						array(2, 'CONVERSION'),
 						array(3, 'TRANSPORTER')
 				)
 		),
 		'users' => array(
 				'fields' => array(
 						'id' => array('varchar(32)', 'NOT NULL'),
 						'password' => array('char(32)', 'NOT NULL'),
 						'name' => array('varchar(255)', 'NOT NULL'),
 						'lastActionDate' => array('datetime', 'NOT NULL'),
 						'active' => array('tinyint(1)', 'NOT NULL')
 				),
 				'pk' => array('id'),
 				'fk' => array(),
 				'inserts' => array(
 						array('xmladmin', md5('unicornbacon'), 'Admin', date('Y-m-d H:i:s'), 1),
 				)
 		),
 		'videos' => array(
 				'fields' => array(
 						'id' => array('int(11)', 'NOT NULL', 'AUTO_INCREMENT'),
 						'audioCodec' => array('varchar(255)', 'DEFAULT NULL'),
 						'createdBy' => array('varchar(255)', 'DEFAULT NULL'),
 						'creationDate' => array('datetime', 'DEFAULT NULL'),
 						'dTOVideoType' => array('varchar(255)', 'DEFAULT NULL'),
 						'duration' => array('varchar(255)', 'DEFAULT NULL'),
 						'fileCreateDate' => array('datetime', 'DEFAULT NULL'),
 						'fileModificationDate' => array('datetime', 'DEFAULT NULL'),
 						'fileName' => array('varchar(255)', 'DEFAULT NULL'),
 						'imageSize' => array('varchar(255)', 'DEFAULT NULL'),
 						'lastAccessed' => array('datetime', 'DEFAULT NULL'),
 						'lastModified' => array('datetime', 'DEFAULT NULL'),
 						'mD5Hash' => array('varchar(255)', 'NOT NULL'),
 						'mD5HashRecal' => array('tinyint(1)', 'DEFAULT NULL'),
 						'mimeType' => array('varchar(255)', 'DEFAULT NULL'),
 						'size' => array('varchar(255)', 'DEFAULT NULL'),
 						'storedOn' => array('varchar(255)', 'DEFAULT NULL'),
 						'timecodeOffset' => array('varchar(255)', 'DEFAULT NULL'),
 						'videoBitrate' => array('varchar(255)', 'DEFAULT NULL'),
 						'videoCodec' => array('varchar(255)', 'DEFAULT NULL'),
 						'videoElements' => array('varchar(255)', 'DEFAULT NULL'),
 						'videoFrameRate' => array('varchar(255)', 'DEFAULT NULL')
 				),
 				'pk' => array('id'),
 				'fk' => array(),
 				'inserts' => array()
 		)
 );
*/
