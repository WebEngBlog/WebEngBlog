<?php

$classes_admin = array(
	"User" => "admin".S."system".S."classes".S."User.php",
	"Session" => "admin".S."system".S."classes".S."Session.php"
);

Autoloader::addClassPaths($classes_admin);

?>