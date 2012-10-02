<?php

abstract class Modul {

	private $template;

	public final function display() {
		include($this->template);
	}

	public abstract function execute();

	/**
	 *
	 * @param string $name
	 * @throws InvalidArgumentException
	 * @return Modul
	 */
	public static function &loadModul($name, $root = ROOT) {
		if (!is_string($name)) {
			throw new InvalidArgumentException($name ." is not a string");
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
		
		$modul->template = $root.S."modules".S.$name.S."template".S.$name.".php";

		return $modul;
	}
}

?>