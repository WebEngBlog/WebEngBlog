<?php

// Nutzeridenifikations-Funktion
function check_nutzer($pwddatei=".htpasswd") {
	session_start();

	if (isset($_SESSION["versuch"]) && $_SESSION["versuch"]>2) {
		return false;
	}

	if (!isset($_SESSION["auth"]) && !isset($_POST["username"])) {
		return false;
	}

	if (isset($_POST["username"])) {
		if (!isset($_SESSION["versuch"])) {
			$_SESSION["versuch"]=1;
		} else {
			$_SESSION["versuch"]++;
		}

		if (!isset($_COOKIE[session_name()])) {
			return false;
		}

		$nutzer = trim($_POST["username"]);
		$pwd = trim($_POST["passwort"]);

		if (strlen($nutzer)<3) {
			return false;
		}

		$pwd=$nutzer.":".crypt($pwd,$nutzer[2].$nutzer[1])."\n";
		$pwd_liste=file($pwddatei);

		if (array_search($pwd,$pwd_liste)!== false) {
			$_SESSION["auth"]=$nutzer;
			return true;
		} else {
			return false;
		}
	}

	if (isset($_GET["logout"])) {
		session_destroy();
		session_unset();
		unset($_SESSION);
		return false;
	} else {
		return true;
	}
}

?>