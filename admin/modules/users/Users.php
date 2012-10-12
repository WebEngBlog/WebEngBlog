<?php

class Users extends Modul {

	public function execute() {
		if(isset($_POST["register"])){
			User::register($_POST["username"], $_POST["password"]);
		} elseif (isset($_POST["edit"])) {
			User::edit((int) $_GET["id"], $_POST["username"], $_POST["passord"]);
		} elseif (isset($_POST["delete"])) {
			User::delete((int) $_GET["id"]);
		}
		echo '<script type="text/javascript">window.location.href="?";</script>';
	}
}

?>