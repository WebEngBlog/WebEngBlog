<?php
/*******************************************************************************
* Modul class
* 
* @author 		Lukas Berg
* @copyright	Lukas Berg, 14.10.2012
* @version		1.0
*******************************************************************************/


class Modul {

	private static $modules = array();

	public function display($template = null) {
		if (is_string($template)) {
			include(dirname(__FILE__).S.$template.S."template".S.$template.".php");
		} else {
			$dir = lcfirst(get_class($this));
			include(dirname(__FILE__).S.$dir.S."template".S.lcfirst(get_class($this)).".php");
		}
	}

	public function execute() {
	}

	/**
	 *
	 * @param string $name
	 * @throws InvalidArgumentException
	 * @return Modul
	 */
	public static final function &loadModul($name, $root = ROOT) {
		if (!is_string($name) || preg_match("/[^a-z]+/", $name) > 0) {
			throw new InvalidArgumentException($name ." is invalid");
		}

		if (array_key_exists($name, self::$modules)) {
			return self::$modules[$name];
		}

		$class = ucfirst($name);

		if (!class_exists($class)) {
			$file = $root.S."modules".S.$name.S.$class.".php";

			if (!file_exists($file)) {
				throw new InvalidArgumentException("file '". $name ."' does not exist");
			}
				
			include($file);
				
			if (!class_exists($class)) {
				throw new InvalidArgumentException("class '". $class ."' does not exist");
			}
		}

		$modul = new $class();

		if (!($modul instanceof Modul)) {
			throw new InvalidArgumentException("'". $class ."' is not an instance of 'Modul'");
		}

		//$modul->template = $root.S."modules".S.$name.S."template".S.$name.".php";

		self::$modules[$class] = $modul;

		return $modul;
	}
}

?>