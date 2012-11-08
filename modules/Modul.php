<?php
/*******************************************************************************
 * Modul class
*
* @version		1.0
*******************************************************************************/

/**
 * Class is the base of all other modules
 */
class Modul extends Object {

	/**
	 * Holds all loaded modules
	 * @var Modul[]
	 */
	private static $modules = array();

	/**
	 * The base dir of the loaded modul
	 * @var string
	*/
	private $root = null;

	/**
	 * Loads a template of the modul
	 * @param string $template - The file which is loaded, must be in dir template of the
	 * modul. As default the template with the same name as the modul is loaded.
	 * Must be written lowercase
	 * @throws InvalidArgumentException
	 */
	public function display($template = null) {
		//Get the correct file to include
		if (!is_string($template) || preg_match("/[^a-z]+/", $template) > 0) {
			$dir = lcfirst(get_class($this));
			$file = $this->root.S."modules".S.$dir.S."template".S.lcfirst(get_class($this)).".php";
		} else {
			$file = $this->root.S."modules".S.$template.S."template".S.$template.".php";
		}

		//Check that file is correct
		if (!is_file($file)) {
			throw new InvalidArgumentException($file . " is not a valid file");
		}

		include($file);
	}

	/**
	 * Will be called at beginning of the page
	 */
	public function execute() {
	}

	/**
	 * Load the modul from the system if exist
	 * @param string $name Name of the modul
	 * @throws InvalidArgumentException
	 * @return Modul
	 */
	public static final function &loadModul($name, $root = ROOT) {
		//Check that nam only contains characters
		if (!is_string($name) || preg_match("/[^a-z]+/", $name) > 0) {
			throw new InvalidArgumentException($name ." is invalid");
		}

		if (!is_dir($root)) {
			throw new InvalidArgumentException($root . " is not a valid dir");
		}

		//Return the modul if it was still loaded
		if (array_key_exists($name, Modul::$modules)) {
			return Modul::$modules[$name];
		}

		$class = ucfirst($name);

		//Load the modul if does not exitst
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

		//Check that the modul is a subtype of Modul
		if (!($modul instanceof Modul)) {
			throw new InvalidArgumentException("'". $class ."' is not an instance of 'Modul'");
		}

		Modul::$modules[$name] = $modul;

		return $modul;
	}
}

?>