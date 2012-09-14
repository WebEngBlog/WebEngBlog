<?php 

define("S", DIRECTORY_SEPARATOR);
define("ADMIN", dirname(__FILE__));

$parts = explode(S, ADMIN);
array_pop($parts);
define("ROOT", implode(S, $parts));

include(ROOT.S."system".S."Autoloader.php");
include(ADMIN.S."system".S."classes.inc.php");

//$admin = new Administrator();

$admin = User::register("hu-_23874go", "peterpan");

if ($admin instanceof User) {
	echo "erfolgreich";
	var_dump($admin);
} else {
	echo "fehlgeschlagen";
}

?>