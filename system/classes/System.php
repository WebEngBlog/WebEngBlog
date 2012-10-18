<?php
/*******************************************************************************
* System class which contains important system functions
* 
* @author 		Lukas Berg, Tobias Röding
* @copyright	@author, 14.10.2012
* @version		1.1
*******************************************************************************/

class System {

	/**
	 * @var Database
	 */
	private static $database = null;

	private function __construct() {
	}

	public static function &getConfig() {
		return Config::getInstance();
	}
	
	public static function isDebugging() {
		return false;
	}
	
	public static function getIp() {
		return $_SERVER['REMOTE_ADDR'];
	}
	
	public static function getBrowser() {
		return $_SERVER['HTTP_USER_AGENT'];
	}

	public static function clean($elem) { 
    	if(!is_array($elem)) 
        	$elem = htmlentities($elem,ENT_QUOTES,"UTF-8"); 
    	else 
        foreach ($elem as $key => $value) 
        	$elem[$key] = self::clean($value); 
        
    	return $elem; 
	} 
	
	public static function display($dir, $default) {
		if (!isset($dir) || !is_string($dir) || !is_dir($dir)) {
			throw new InvalidArgumentException($dir ." is invalid");
		}
		
		$display = $_GET["display"];
		
		if (!isset($display)) {
			$display = $default;
		}
		
		try {
			Modul::loadModul($display, $dir)->display();
		} catch (Exception $e) {
			echo $display ." not found";
		}
	}
}

?>