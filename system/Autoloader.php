<?php

include(ROOT.S."system".S."classes.inc.php");

final class Autoloader {

	private static $classes = array();

	private function __construct(){
	}

	public static function registerAutoload() {
		spl_autoload_register('Autoloader::__autoload', true, true);
	}

	public static function unregisterAutoload() {
		spl_autoload_unregister('Autoloader::__autoload');
	}

	private static function __autoload($class) {
		if (!array_key_exists($class, self::$classes)) {
			return false;
		}
		$file = ROOT.S.self::$classes[$class];
		
		if (!file_exists($file)) {
			return false;
		}
		return include($file);
	}

	public static function setClassPaths($classes) {
		if (is_array($classes)) {
			self::$classes = $classes;
			return true;
		}
		return false;
	}
	
	public static function addClassPaths($classes) {
		if (is_array($classes)) {
			self::$classes = array_merge(self::$classes, $classes);
			return true;
		}
		return false;
	}
}

Autoloader::setClassPaths($classes);
Autoloader::registerAutoload();

include(ROOT.S."configuration.inc.php");

?>