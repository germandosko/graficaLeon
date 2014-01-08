<?php

/**  
 * @author Web Design Rosario 
 * @version Dec 2 2011
 */
 
class Bootstrap{
	/** 
	 * All files contained into the specified folders will be included.
	 * Must be ordered by priority.
	 */
	private static $foldersToInclude = array('Utils',
	'Entities',
	'Models');
	
	/** 
	 * Perform include_once for all required php files
	 */
	public static function setRequiredFiles(){
		foreach(self::$foldersToInclude as $folderName){		
			$arrayPath = array();
			self::findFiles($arrayPath, ROOT_FOLDER.$folderName);
			sort($arrayPath);
			foreach($arrayPath as $file){
				if(!in_array($file, self::getFilesToExclude())){
					require_once $file;
				}
			}
		}
	}
	
	/** 
	 * Looks for all files and foldes inside a folder and fill the array given by ref
	 * This feature lookup recursively into subfolders
	 *
	 * @param 	Array|string 	$arrayPath
	 * @param 	string 			$xmlFolderPath
	 */
	private static function findFiles(&$arrayPath, $xmlFolderPath)
	{
		try{
			if (is_dir($xmlFolderPath)){
				if ($dh = opendir($xmlFolderPath)){
					//Make sure it is a readable file
					while (($file = readdir($dh)) !== false){
						if(($file != '.') && ($file != '..') && ($file != '.svn')){
							$tmpPath = $xmlFolderPath . DIR_SEPARATOR . $file;
							if (is_dir($tmpPath)){
								self::findFiles($arrayPath, $tmpPath);
							} else if(substr($tmpPath, -4) == '.php'){
								array_push($arrayPath, $tmpPath);
							}
						}
					}
					closedir($dh);
				}
			}
		} catch(Exception $e){
			throw new Exception($e);
		}
		return ;
	}
	
	/** 
	 * Returns files to be exculded
	 *
	 * @return	Array|string
	 */
	private static function getFilesToExclude(){
		$filesToExclude = array(
			ROOT_FOLDER.'Utils'.DIR_SEPARATOR.'Bootstrap.php',
			ROOT_FOLDER.'Utils'.DIR_SEPARATOR.'Code'.DIR_SEPARATOR.'FileJoiner.php',
			ROOT_FOLDER.'Utils'.DIR_SEPARATOR.'Code'.DIR_SEPARATOR.'ProjectGenerator.php'
		);
		return $filesToExclude;
	}
}
