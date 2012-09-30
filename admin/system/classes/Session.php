<?php

class Session {
	
	const SECURE = false;
	
	private static $started = false;
	
	private function __construct() {
	}

	public static function start() {
		if (self::$started) {
			throw new BadMethodCallException("session still started");
		}
		
		$session = "session";
		$httponly = true;

		ini_set('session.use_only_cookies', 1);
		
		$cookieParams = session_get_cookie_params();
		
		session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], self::SECURE, $httponly);

		session_name($session);

		session_start();

		if (session_regenerate_id(true) === true) {
			self::$started = true;
			return true;
		}
		
		return false;
	}
	
	public static function destroy() {
		if (!self::$started) {
			throw new BadMethodCallException("session not started");
		}
		
		$_SESSION = array();
		
		$params = session_get_cookie_params();
		
		setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

		return session_destroy();
	}
	
	public static function setValue($name, $value) {
		if (!self::$started) {
			throw new BadMethodCallException("session not started");
		}
		
		if (!is_string($name)) {
			throw new InvalidArgumentException($name ." is not a string");
		}
		
		$_SESSION[$name] = $value;
	}
	
	public static function getValue($name) {
		if (!self::$started) {
			throw new BadMethodCallException("session not started");
		}
		
		if (!is_string($name)) {
			throw new InvalidArgumentException($name ." is not a string");
		}
		
		return $_SESSION[$name];
	}
}

?>