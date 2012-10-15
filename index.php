<?php

define("S", DIRECTORY_SEPARATOR);
define("ROOT", dirname(__FILE__));

include(ROOT.S.'system'.S.'Autoloader.php');

$_GET = System::clean($_GET);
$_POST = System::clean($_POST);

System::display(ROOT, "header"); 

if(isset($_GET["display"])){
	//Modul::loadModul("article", ROOT)->display();
} else {
?>	
	<section id="content"><?php System::display(ROOT, "articles"); ?></section>
<?php 
}
System::display(ROOT, "footer");

?>