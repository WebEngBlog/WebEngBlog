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

if (isset($_POST["action"])) {
	Modul::loadModul($_POST["action"], ADMIN)->execute();
}

if (User::isLoggedIn()) {
	if (isset($_GET["create"])){
		Modul::loadModul("article", ADMIN)->display();
	} elseif (isset($_GET["edit"]) && isset($_GET["id"])){
		Modul::loadModul("article", ADMIN)->display();
	} elseif (isset($_GET["delete"]) && isset($_GET["id"])) {
		Modul::loadModul("article", ADMIN)->display();
	} else {
		Modul::loadModul("liste", ADMIN)->display();
	}
} else {
	Modul::loadModul("login", ADMIN)->display();
}

?>

<script type="text/javascript">

	function loadContent(data) {
		window.location.href = "?" + data;
	}
		
</script>
