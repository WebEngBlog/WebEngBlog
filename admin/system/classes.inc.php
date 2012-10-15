<?php
/*******************************************************************************
* config class for specifying the classes the Autoloader should load
* 
* @author 		Lukas Berg
* @copyright	Lukas Berg, 14.10.2012
* @version		0.9
*******************************************************************************/


$classes_admin = array(
	"User" => "admin".S."system".S."classes".S."User.php",
	"Session" => "admin".S."system".S."classes".S."Session.php"
);

Autoloader::addClassPaths($classes_admin);

?>