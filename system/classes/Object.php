<?php

class Object {
	
	function __get($key) {
		throw new BadMethodCallException($key ." is not a valid attribute");
	}
	
	function __set($key, $value) {
		throw new BadMethodCallException($key ." is not a valid attribute");
	}
}