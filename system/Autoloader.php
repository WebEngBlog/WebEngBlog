<?php
/*******************************************************************************
* Autoloader class and some basic settings for the system: Register Redbean and
* set error handling
* 
* @version		1.0
*******************************************************************************/

include(ROOT.S."system".S."classes.inc.php");

/**
 * Class which tries to load a class if it was not found. Classes must be
 * registered first.
 */
final class Autoloader {

	/**
	 * Holds the file of the classes with class name as the key
	 * @var String[]
	 */
	private static $classes = array();

	private function __construct(){
	}

	/**
	 * Register the Autoloader function
	 */
	public static function registerAutoload() {
		spl_autoload_register("Autoloader::__autoload", true, true);
	}

	/**
	 * Unregister the Autoloader function
	 */
	public static function unregisterAutoload() {
		spl_autoload_unregister("Autoloader::__autoload");
	}

	private static function __autoload($class) {
		//Check that class is registered
		if (!array_key_exists($class, self::$classes)) {
			return false;
		}
		
		//Check that file exists
		$file = ROOT.S.self::$classes[$class];
		if (!file_exists($file)) {
			return false;
		}
		
		return include($file);
	}

	/**
	 * Register $classes
	 * @param String[] $classes
	 * @return boolean
	 */
	public static function setClassPaths($classes) {	
		//Check that $classes is an array	
		if (is_array($classes)) {
			self::$classes = $classes;
			return true;
		}
		return false;
	}
	
	/**
	 * Add $classes to registered classes
	 * @param String[] $classes
	 * @return boolean
	 */
	public static function addClassPaths($classes) {
		//Check that $classes is an array
		if (is_array($classes)) {
			self::$classes = array_merge(self::$classes, $classes);
			return true;
		}
		return false;
	}
}

//Register all classes of the system
Autoloader::setClassPaths($classes);
Autoloader::registerAutoload();

//Load the configuration RedBean framework
include(ROOT.S."configuration.inc.php");
include(ROOT.S."system".S."framework".S."rb.php");

//Set error handling
function error_handler($code, $msg, $file, $row) {
	System::addError(new Error("Code: ". $code . " => ". $msg, $file, $row));
	return true;
}

function exception_handler($exception) {
	?>Sorry there was an error: <?php echo $exception->getMessage();
}

set_error_handler("error_handler");
set_exception_handler("exception_handler");

//Initialize RedBean
$config = Config::getInstance();
R::setup("mysql:host=". $config->dbHost .";dbname=". $config->dbName, $config->dbUser, $config->dbPassword);

//Dont print any errors
ini_set("display_errors", false);
R::debug(false);

//Check if system must be set in debugging mode
if (System::isDebugging()) {
	$adapter = R::$adapter;
	System::setLogger(RedBean_Plugin_QueryLogger::getInstanceAndAttach($adapter));
}

?>