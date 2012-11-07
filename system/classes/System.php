<?php
/*******************************************************************************
 * System class which contains important system functions
 *
 * @version		1.1
 *******************************************************************************/

class System {

	/**
	 * Stores all occured errors
	 * @var Error[]
	 */
	private static $errors = array();
	
	/**
	 * The logger for all executed queries
	 * @var RedBean_Plugin_QueryLogger
	 */
	private static $logger;

	private function __construct() {
	}

	/**
	 * Returns configuration instance
	 * @return Config
	 */
	public static function &getConfig() {
		return Config::getInstance();
	}

	/**
	 * Rerturns if the system is in debugging mode
	 * @return boolean
	 */
	public static function isDebugging() {
		$debug = System::getConfig()->debug;
		return is_bool($debug) ? $debug : false;
	}

	/**
	 * Returns the IP
	 * @return String
	 */
	public static function getIp() {
		return $_SERVER['REMOTE_ADDR'];
	}

	/**
	 * Returns the browser agent
	 * @return String
	 */
	public static function getBrowser() {
		return $_SERVER['HTTP_USER_AGENT'];
	}

	/**
	 * Log an error
	 * @param Error $error
	 * @throws InvalidArgumentException
	 */
	public static function addError($error) {
		if (!is_a($error, "Error")) {
			throw new InvalidArgumentException("argument is not of type error");
		}
		System::$errors[] = $error;
	}

	/**
	 * Prints all logged errors
	 */
	public static function printErrors() {
		foreach (System::$errors as $error) {
			echo $error->toString() ."<br />";
		}
	}
	
	/**
	 * Sets the logger for all executed queries
	 * @param RedBean_Plugin_QueryLogger $logger
	 * @throws InvalidArgumentException
	 */
	public static function setLogger($logger) {
		if (!is_a($logger, "RedBean_Plugin_QueryLogger")) {
			throw new InvalidArgumentException("argument is not of type 'RedBean_Plugin_QueryLogger'");
		}
		System::$logger = $logger;
	}
	
	/**
	 * Prints all executed queries
	 */
	public static function printQueries() {
		$queries = System::$logger->getLogs();
		foreach ($queries as $log) {
			echo $log ."<br />";
		}
	}

	/**
	 * Is used to encode all html entities from $_GET and _$_POST
	 * @param unknown $elem $_GET or _$_POST
	 * @return string
	 */
	public static function clean($elem) {
		//Encode all html chars recursively
    	if (!is_array($elem)) {
    		$elem = htmlentities($elem, ENT_QUOTES, "UTF-8");
    	} else {
    		foreach ($elem as $key => $value) {
    			$elem[$key] = self::clean($value);
    		}
    	}
    	return $elem;
	}

	/**
	 * Displays all modules in the content area of $_GET["display"] separated by ;
	 * @param String $dir The root dir from which the modules are loaded
	 * @param String $default Default modul if $_GET["display"] is not set
	 * @throws InvalidArgumentException
	 */
	public static function display($dir, $default) {
		//Check that $dir is a valid dir
		if (!isset($dir) || !is_string($dir) || !is_dir($dir)) {
			throw new InvalidArgumentException($dir ." is invalid");
		}

		//Get the module/s to display
		if (isset($_GET["display"])) {
			$display = $_GET["display"];
		} else {
			$display = $default;
		}

		//Render all modules, log error if modul does not exist
		$moduls = explode(';', $display);
		foreach ($moduls as $modul) {
			try {
				Modul::loadModul($modul, $dir)->display();
			} catch (Exception $e) {
				System::addError(new Error($modul ." was not found"));
			}
	    }
	}
}

?>