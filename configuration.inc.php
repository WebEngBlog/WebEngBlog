<?php
/*******************************************************************************
 * Contains the configuration of the system
 *
 * @version		1.0
*******************************************************************************/

$config = array(
	"dbName" => "blog",
	"dbHost" => "localhost",
	"dbUser" => "root",
	"dbPassword" => "root",
	"debug" => false
);

Config::setConfig($config);

?>