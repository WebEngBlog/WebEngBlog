<?php
/*******************************************************************************
* Session class
* 
* @version		1.0
*******************************************************************************/

class Session {
	
	const SECURE = false;
	
	private static $session = null;
	
	private $started = false;
	
	private function __construct() {
	}
	
	/**
	 * 
	 * @return Session
	 */
	public static function getSession() {
		if (Session::$session === null) {
			Session::$session = new Session();
		}
		return Session::$session;
	}

	public function start() {
		if ($this->started) {
			return true;
		}
		
		$session = "session";
		$httponly = true;

		ini_set('session.use_only_cookies', 1);
		
		$cookieParams = session_get_cookie_params();
				
		session_set_cookie_params(60 * 15, $cookieParams["path"], $cookieParams["domain"], Session::SECURE, $httponly);
		
		session_name($session);

		if (session_start() !== true) {
			throw new ErrorException("session could not be started");
		}
		
		if (session_regenerate_id() !== true) {
			throw new ErrorException("session id could not be regenerated");
		}
		
		$this->started = true;
		
		return true;		
	}
	
	public function destroy() {
		if (!$this->started) {
			throw new BadMethodCallException("session not started");
		}
		
		$_SESSION = array();
		
		$params = session_get_cookie_params();
		
		setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

		return session_destroy();
	}
	
	public function setValue($name, $value) {
		if (!$this->started) {
			throw new BadMethodCallException("session not started");
		}
		
		if (!is_string($name)) {
			throw new InvalidArgumentException($name ." is not a string");
		}
		
		$_SESSION[$name] = $value;
	}
	
	public function getValue($name) {
		if (!$this->started) {
			throw new BadMethodCallException("session not started");
		}
		
		if (!is_string($name)) {
			throw new InvalidArgumentException($name ." is not a string");
		}
		
		return $_SESSION[$name];
	}
}

?>