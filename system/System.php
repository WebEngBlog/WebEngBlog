<?php

class System {

	/**
	 * @var Database
	 */
	private static $database = null;

	private function __construct() {
	}

	public static function &getDatabase() {
		if (self::$database === null) {
			self::$database = new Database(self::getConfig()->dbName, 
					self::getConfig()->dbHost, self::getConfig()->dbUser, 
					self::getConfig()->dbPassword);
			if (!self::$database->connect()) {
				return false;
			}
		}
		return self::$database;
	}

	public static function &getConfig() {
		return Config::getInstance();
	}
	
	public static function isDebug() {
		return true;
	}
}

?>