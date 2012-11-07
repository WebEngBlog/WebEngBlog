<?php
/*******************************************************************************
 * Object class which can be used as root class
 *
 * @version		1.0
 *******************************************************************************/

/**
 * Has some basic functions, all classes can extend it
 */
class Object {
	
	function __get($key) {
		throw new BadMethodCallException($key ." is not a valid attribute");
	}
	
	function __set($key, $value) {
		throw new BadMethodCallException($key ." is not a valid attribute");
	}
}

?>