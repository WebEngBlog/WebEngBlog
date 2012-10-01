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
	
	public static function isDebug() {
		return true;
	}
	
	public static function getIp() {
		return $_SERVER['REMOTE_ADDR'];
	}
	
	public static function getBrowser() {
		return $_SERVER['HTTP_USER_AGENT'];
	}
}

?>