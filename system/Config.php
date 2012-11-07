<?php
/*******************************************************************************
 * Class Config from which configurations can be loaded
 *
 * @version		1.0
 *******************************************************************************/

/**
 * A configuration can be get like a normal attribute of an object.
 * Configurations must be set first
 */
class Config {
	
	/**
	 * Stores the Config instance
	 * @var Config
	 */
	private static $instance = null;
	
	/**
	 * All configurations
	 * @var String[]
	 */
	private static $config = array();
	
	private function __construct() {
	}
	
	/**
	 * Set the configuration
	 * @param String[] $config
	 * @return boolean
	 */
	public static function setConfig($config) {
		//Check if $config is an array
		if (is_array($config)) {
			Config::$config = $config;
			return true;
		}
		return false;
	}
	
	/**
	 * Return instance of Config
	 * @return Config
	 */
	public static function &getInstance() {
		//Create new instance if no exists
		if (Config::$instance === null) {
			Config::$instance = new Config();
		}
		return Config::$instance;
	}

	public function __get($key) {
		//If configuration exists return the value, otherwise null
		return array_key_exists($key, Config::$config) ? Config::$config[$key] : null;
	}
}

?>