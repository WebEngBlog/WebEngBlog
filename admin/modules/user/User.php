<?php
/*******************************************************************************
* Users modul for the backend (admin area)
* 
* @author 		Tobias Röding
* @copyright	Tobias Röding, 14.10.2012
* @version		0.9
*******************************************************************************/

class User extends Modul {

	public function execute() {
		if(isset($_POST["register"])){
			UserManagement::register($_POST["username"],$_POST["fullname"],$_POST["password"]);
		} elseif (isset($_POST["edit"])) {
			$return = UserManagement::edit((int) $_GET["id"], $_POST["oldpassword"], $_POST["newpassword"]);
			if($return == false){
				echo '<script type="text/javascript">window.location.href="?display=user&func=edit&id='.$_GET["id"].'";</script>';
			}
		} elseif (isset($_POST["delete"])) {
			UserManagement::delete((int) $_GET["id"]);
		}
		echo '<script type="text/javascript">window.location.href="?display=user";</script>';
	}
}

?>