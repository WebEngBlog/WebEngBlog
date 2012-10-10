<?php

$classes = array(
	"System" => "system".S."System.php",
	"Config" => "system".S."Config.php",
	"Modul" => "modules".S."Modul.php"
);

include(ROOT.S."system".S."framework".S."rb.php");
R::setup("mysql:host=localhost;dbname=blog", "root", "root");

?>