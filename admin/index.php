<?php 

define("S", DIRECTORY_SEPARATOR);
define("ADMIN", dirname(__FILE__));

$parts = explode(S, ADMIN);
array_pop($parts);
define("ROOT", implode(S, $parts));

include(ROOT.S."system".S."Autoloader.php");
include(ADMIN.S."system".S."classes.inc.php");

Session::getSession()->start();

$_GET = System::clean($_GET);
$_POST = System::clean($_POST);

Modul::loadModul("header", ROOT)->display();

if (isset($_POST["action"])) {
	Modul::loadModul($_POST["action"], ADMIN)->execute();
}

if (User::isLoggedIn()) {
	if(isset($_GET["display"])){
		Modul::loadModul($_GET["display"], ADMIN)->display();
	} else {
		Modul::loadModul("articles", ADMIN)->display();
	}
} else {
	Modul::loadModul("login", ADMIN)->display();
}

Modul::loadModul("footer", ROOT)->display();

?>
