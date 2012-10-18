<?php

class Login extends Modul {

	public function execute() {
		$name = $_POST["username"];
		$password = $_POST["password"];
		
		UserManagement::login($name, $password);
	}
}

?>