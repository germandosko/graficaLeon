<?php
/**  
 * @author Web Design Rosario
 * @version Sep 1 2012
 */

// Report all errors
error_reporting(E_ALL);
ini_set('error_reporting',E_ALL);
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');

ini_set("memory_limit","256M");
define('DIR_SEPARATOR', '/');
$rootFolder = dirname(__FILE__) . DIR_SEPARATOR;
define('ROOT_FOLDER', $rootFolder);

// Set include paths
set_include_path(dirname(__FILE__) . DIR_SEPARATOR);

// Just in case it hasn't been specified in the PHP ini: 86400 = 24 hours in seconds
ini_set('max_execution_time', 86400);

// Database configuration
define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASS', '');
define('MYSQL_DB', 'on000142_graficaLeon');

