<?php

class Config {
	
	private static $instance = null;
	
	private static $config = array();
	
	private function __construct() {
	}
	
	public static function setConfig($config) {
		if (is_array($config)) {
			Config::$config = $config;
			return true;
		}
		return false;
	}
	
	public static function &getInstance() {
		if (Config::$instance === null) {
			Config::$instance = new Config();
		}
		return Config::$instance;
	}
	
	public function __get($key) {
		return array_key_exists($key, Config::$config) ? Config::$config[$key] : null;
	}
}