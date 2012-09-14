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
				array($name, hash("md5", $password)), null, true);
		
		return new User($db->getLastId(), $name);
	}
	
	public static function getUser($id) {
		throw new BadMethodCallException("Not yet implemented");;
	}
	
	public static function getUsers() {
		throw new BadMethodCallException("Not yet implemented");;
	}

	private function createSession() {
		$session_name = 'sec_session_id'; // Set a custom session name
		$secure = false; // Set to true if using https.
		$httponly = true; // This stops javascript being able to access the session id.
		
		ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies.
		$cookieParams = session_get_cookie_params(); // Gets current cookies params.
		session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
		session_name($session_name); // Sets the session name to the one set above.
		session_start(); // Start the php session
		session_regenerate_id(true); // regenerated the session, delete the old one.
	}

	public function getName() {
		return $name;
	}

	public function getId() {
		return $id;
	}
}

?>