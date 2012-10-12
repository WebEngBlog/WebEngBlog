<?php

class User {

	const PASSWORD_LENGTH = 0;

	private function __construct() {
	}

	public static function login($name, $password) {
		if (!is_string($name) || !is_string($password)) {
			return false;
		}

		$user = self::getUser($name);

		if ($user->password === self::getHash($password)) {		
			$ip = System::getIp();
			$browser = System::getBrowser();
			
			$session = Session::getSession();

			$session->setValue("userid", $user->id);
			$session->setValue("username", $user->name);
			$session->setValue("login", self::getHash($browser . $user->password . $ip));
			
			return true;
		} else {
			return false;
		}
	}
	
	public static function logout() {
		Session::destroy();
	}

	public static function register($name, $password) {
		if (!is_string($name) || !is_string($password)) {
			return false;
		}

		if (preg_match("/[^a-zA-Z0-9_\-]+/", $name) > 0 || strlen($name) > 50 || strlen($name) === 0) {
			return false;
		}

		if (preg_match("/[[:space:]]+/", $password) > 0 || strlen($password) < self::PASSWORD_LENGTH) {
			return false;
		}

		$user = self::getUser($name);
			
		if ($user->id) {
			return false;
		}

		$user = R::dispense("user");
		$user->name = $name;
		$user->password = self::getHash($password);
		$user->id = R::store($user);

		return $user;
	}

	public static function getUser($value) {
		if (is_int($value) && $value > 0) {
			return R::load("user", $value);
		} else if (!is_string($value)) {
			throw new InvalidArgumentException($value . " is not a string or an int");
		}

		return R::findOne("user", "name = ?", array($value));
	}

	private function getHash($text) {
		return hash("md5", $text);
	}

	public static function getUsers() {
		throw new BadMethodCallException("Not yet implemented");;
	}
	
	public static function isLoggedIn() {
		$session = Session::getSession();
		
		$id = (int) $session->getValue("userid");
		$name = $session->getValue("username");
		$login = $session->getValue("login");
		if (!isset($id) || !isset($name) || !isset($login)) {
			return false;
		}
		
		$user = self::getUser($id);
		
		if (!$user->id || $user->name !== $name) {
			return false;
		}
	
		$ip = System::getIp();
		$browser = System::getBrowser();
		
		if ($login !== self::getHash($browser . $user->password . $ip)) {
			return false;
		}
		
		return $user;
	}

	public static function getLoggedInUserID() {
		$session = Session::getSession();
		$id = (int) $session->getValue("userid");
		return $id;
	}

}

?>