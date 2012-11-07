<?php
/*******************************************************************************
* Contains the Login module for the backend (admin area)
*
* @version		1.0
*******************************************************************************/

class Login extends Modul {

	public function execute() {
		$name = $_POST["username"];
		$password = $_POST["password"];
		
		UserManagement::login($name, $password);
	}
}

?>