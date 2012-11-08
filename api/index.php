<?php 
/*******************************************************************************
* index.php for the api
* 
* @version		1.0
*******************************************************************************/

define("S", DIRECTORY_SEPARATOR);
define("API", dirname(__FILE__));

$parts = explode(S, API);
array_pop($parts);
define("ROOT", implode(S, $parts));

include(ROOT.S."system".S."Autoloader.php");

$_GET = System::clean($_GET);
$_POST = System::clean($_POST);

if (isset($_POST["action"])) {
	Modul::loadModul($_POST["action"], API)->execute();
}
if (isset($_POST["display"])) {
	Modul::loadModul($_POST["display"], API)->display();
}

?>