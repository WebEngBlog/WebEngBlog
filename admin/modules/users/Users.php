<?php
/*******************************************************************************
* Users modul for the backend (admin area)
* 
* @author 		Tobias Röding
* @copyright	Tobias Röding, 14.10.2012
* @version		0.9
*******************************************************************************/

class Users extends Modul {

	public function execute() {
		if(isset($_POST["register"])){
			User::register($_POST["username"], $_POST["password"]);
		} elseif (isset($_POST["edit"])) {
			$return = User::edit((int) $_GET["id"], $_POST["oldpassword"], $_POST["newpassword"]);
			if($return == false){
				echo '<script type="text/javascript">window.location.href="?display=users&func=edit&id='.$_GET["id"].'";</script>';
			}
		} elseif (isset($_POST["delete"])) {
			User::delete((int) $_GET["id"]);
		}
		echo '<script type="text/javascript">window.location.href="?display=users";</script>';
	}
}

?>