<?php 

define("S", DIRECTORY_SEPARATOR);
define("ADMIN", dirname(__FILE__));

$parts = explode(S, ADMIN);
array_pop($parts);
define("ROOT", implode(S, $parts));

include(ROOT.S."system".S."Autoloader.php");
include(ADMIN.S."system".S."classes.inc.php");

Session::getSession()->start();

if (isset($_POST["action"])) {
	Modul::loadModul($_POST["action"], ADMIN)->execute();
}

if (User::isLoggedIn()) {
	echo "logged in<br>";
} else {
	Modul::loadModul("login", ADMIN)->display();
}

?>