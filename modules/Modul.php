<?php
/*******************************************************************************
* Modul class
*
* @version		1.0
*******************************************************************************/


class Modul extends Object {

	private static $modules = array();
	
	private $root = null;

	public function display($template = null) {		
		if (is_string($template)) {
			$file = $this->root.S."modules".S.$template.S."template".S.$template.".php";
		} else {
			$dir = lcfirst(get_class($this));
			$file = $this->root.S."modules".S.$dir.S."template".S.lcfirst(get_class($this)).".php";
		}
		
		if (!is_file($file)) {
			throw new InvalidArgumentException($file . " is not a valid file");
		}
		
		include($file);
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
		
		if (!is_dir($root)) {
			throw new InvalidArgumentException($root . " is not a valid dir");
		}

		if (array_key_exists($name, Modul::$modules)) {
			return Modul::$modules[$name];
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
		$modul->root = $root;

		if (!($modul instanceof Modul)) {
			throw new InvalidArgumentException("'". $class ."' is not an instance of 'Modul'");
		}

		Modul::$modules[$name] = $modul;

		return $modul;
	}
}

?>