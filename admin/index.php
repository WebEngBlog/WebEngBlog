<?php 

define("S", DIRECTORY_SEPARATOR);
define("ADMIN", dirname(__FILE__));

$parts = explode(S, ADMIN);
array_pop($parts);
define("ROOT", implode(S, $parts));

include(ROOT.S."system".S."Autoloader.php");
include(ADMIN.S."system".S."classes.inc.php");

Session::start();

$name = $_POST["name"];
$password = $_POST["password"];
$msg = "";

if (isset($_POST["register"])) {
	$user = User::register($name, $password);

	if ($user !== false) {
		$msg = "erfolgreich";
	} else {
		$msg = "fehlgeschlagen	";
	}

} else if (isset($_POST["login"])) {
	$user = User::login($name, $password);

	if ($user !== false) {
		$msg = "erfolgreich";
	} else {
		$msg = "fehlgeschlagen";
	}
} else if (isset($_POST["logout"])) {
	Session::destroy();
	$msg = "logged out";
}

if (User::isLogedIn()) {
	echo "logged in<br>";
	echo '<form action="index.php" method="post"><input type="submit" name="logout" value="Logout"></form>';
	exit(0);
}


include("login.html");


?>