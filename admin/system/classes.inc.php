<?php
/*******************************************************************************
* config class for specifying the classes the Autoloader should load
* 
* @version		1.0
*******************************************************************************/


$classes_admin = array(
	"UserManagement" => "admin".S."system".S."classes".S."UserManagement.php",
	"Session" => "admin".S."system".S."classes".S."Session.php"
);

Autoloader::addClassPaths($classes_admin);

?>