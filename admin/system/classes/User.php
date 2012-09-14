<?php

class User {

	private $name = null;

	private $id = null;

	private function __construct($id = null, $name = null) {
		$this->id = is_int($id) ? $id : null;
		$this->name = is_string($name) ? $name : null;
	}
	
	public static function login($name, $password) {
		return false;
	}

	public function logout() {

	}

	public static function register($name, $password) {
		if (preg_match("/[^a-zA-Z0-9_\-]+/", $name) > 0 || strlen($name) > 50) {
			return false;
		}

		if (preg_match("/[[:space:]]+/", $password) > 0 || strlen($password) < 8) {
			return false;
		}
		
		$name = (string) $name;
		
		$db = System::getDatabase();
		$data = array();
		
		$db->prepareStatement("SELECT id FROM user WHERE name = ?",
				array($name), array(&$data["id"]), true);
		
		if ($db->fetchStatement()) {
			return false;
		}
		
		$db->prepareStatement("INSERT INTO user (name, password) VALUES (?, ?)", 
				array($name, $this->getHash($password)), null, true);
		
		return new User($db->getLastId(), $name);
	}
	
	private function getHash($text) {
		return hash("md5", $text);
	}
	
	public static function getUser($id) {
		throw new BadMethodCallException("Not yet implemented");;
	}
	
	public static function getUsers() {
		throw new BadMethodCallException("Not yet implemented");;
	}

	public function getName() {
		return $name;
	}

	public function getId() {
		return $id;
	}
}

?>