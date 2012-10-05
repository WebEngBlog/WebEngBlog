<?php

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
		return true;
	}
	
	public static function getIp() {
		return $_SERVER['REMOTE_ADDR'];
	}
	
	public static function getBrowser() {
		return $_SERVER['HTTP_USER_AGENT'];
	}
	
	public static function display($dir, $default) {
		if (!isset($dir) || !is_string($dir) || !is_dir($dir)) {
			throw new InvalidArgumentException($dir ." is invalid");
		}
		
	//	$display = $_POST["display"];
		$display = $_GET["display"];
		
		if (!isset($display)) {
			Modul::loadModul($default, $dir)->display();
			return;
		}
		
		$moduls = explode(';', $display);
		
		foreach ($moduls as $modul) {
			try {
				Modul::loadModul($modul, $dir)->display();
			} catch (Exception $e) {
				echo $modul ." not found";
			}
		}
	}
}

?>