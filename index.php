<?php

define("S", DIRECTORY_SEPARATOR);
define("ROOT", dirname(__FILE__));

include(ROOT.S.'system'.S.'Autoloader.php');

System::display(ROOT, "header"); 
?>	
	<section id="content"><?php System::display(ROOT, "articles"); ?></section>
<?php 
System::display(ROOT, "footer"); 
?>