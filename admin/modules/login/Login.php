<?php

class Login extends Modul {

	public function execute() {
		$name = $_POST["username"];
		$password = $_POST["password"];
		
		User::login($name, $password);
	}
}

?>