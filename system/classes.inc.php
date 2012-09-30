<?php

$classes = array(
	"System" => "system".S."System.php",
	"Config" => "system".S."Config.php",
	"Database" => "system".S."database".S."Database.php"
);

include(ROOT.S."system".S."framework".S."rb.php");
R::setup("mysql:host=localhost;dbname=blog", "root", "");
//R::debug( true );

?>