<?php
/*******************************************************************************
 * config class for specifying the classes the Autoloader should load
*
* @author 		Lukas Berg
* @copyright	Lukas Berg, 14.10.2012
* @version		0.9
*******************************************************************************/


$classes = array(
	"System" => "system".S."classes".S."System.php",
	"Config" => "system".S."Config.php",
	"Modul" => "modules".S."Modul.php",
	"Object" => "system".S."classes".S."Object.php"
);

include(ROOT.S."system".S."framework".S."rb.php");
R::setup("mysql:host=localhost;dbname=blog", "root", "root");

?>