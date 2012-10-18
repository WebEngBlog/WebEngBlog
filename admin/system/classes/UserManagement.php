<?php
/*******************************************************************************
* User class for mangagin the users
* 
* @author 		Lukas Berg, Tobias Röding
* @copyright	@author, 14.10.2012
* @version		0.9
*******************************************************************************/

class UserManagement {

	const PASSWORD_LENGTH = 0;

	private function __construct() {
	}

	public static function login($name, $password) {
		if (!is_string($name) || !is_string($password)) {
			return false;
		}

		$user = UserManagement::getUser($name);

		if ($user->password === UserManagement::getHash($password)) {		
			$ip = System::getIp();
			$browser = System::getBrowser();
			
			$session = Session::getSession();

			$session->setValue("userid", $user->id);
			$session->setValue("username", $user->name);
			$session->setValue("login", UserManagement::getHash($browser . $user->password . $ip));
			
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

		if (preg_match("/[[:space:]]+/", $password) > 0 || strlen($password) < UserManagement::PASSWORD_LENGTH) {
			return false;
		}

		$user = UserManagement::getUser($name);
			
		if ($user->id) {
			return false;
		}

		$user = R::dispense("user");
		$user->name = $name;
		$user->password = UserManagement::getHash($password);
		$user->id = R::store($user);

		return $user;
	}

	public static function edit($id, $oldpassword, $newpassword){
		if (preg_match("/[[:space:]]+/", $newpassword) > 0 || strlen($newpassword) < UserManagement::PASSWORD_LENGTH) {
			return false;
		}

		$user = UserManagement::getUser($id);
		if($user->password == UserManagement::getHash($oldpassword)){
			$user->password = UserManagement::getHash($newpassword);
		} else {
			return false;
		}
		return  R::store($user);
	}

	public static function delete($id){
		$user = UserManagement::getUser($id);
		
		return R::trash($user);
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
		return R::findAll("user", " ORDER BY id DESC");	
	}
	
	public static function isLoggedIn() {
		$session = Session::getSession();
		
		$id = (int) $session->getValue("userid");
		$name = $session->getValue("username");
		$login = $session->getValue("login");
		if (!isset($id) || !isset($name) || !isset($login)) {
			return false;
		}
		
		$user = UserManagement::getUser($id);
		
		if (!$user->id || $user->name !== $name) {
			return false;
		}
	
		$ip = System::getIp();
		$browser = System::getBrowser();
		
		if ($login !== UserManagement::getHash($browser . $user->password . $ip)) {
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