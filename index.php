<?php
/*******************************************************************************
* index.php for the frontend
* 
* @author 		Lukas Berg, Tobias Röding
* @copyright	@author, 14.10.2012
* @version		0.9
*******************************************************************************/


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
	<section id="content">
		<?php 
			System::display(ROOT, "articles"); 
			//Modul::loadModul("articles",ROOT)->display;
		?>
	</section>
<?php 
}
System::display(ROOT, "footer"); 

?>