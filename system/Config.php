<?php

class Config {
	
	private static $instance = null;
	
	private static $config = array();
	
	private function __construct() {
	}
	
	public static function setConfig($config) {
		if (is_array($config)) {
			self::$config = $config;
			return true;
		}
		return false;
	}
	
	public static function &getInstance() {
		if (self::$instance === null) {
			self::$instance = new Config();
		}
		return self::$instance;
	}
	
	public function __get($key) {
		return array_key_exists($key, self::$config) ? self::$config[$key] : null;
	}
}