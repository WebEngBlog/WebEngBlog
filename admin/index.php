<?php 
/*******************************************************************************
* index.php for the backend (admin area)
* 
* @author 		Lukas Berg, Tobias Röding
* @copyright	@author, 14.10.2012
* @version		0.9
*******************************************************************************/

define("S", DIRECTORY_SEPARATOR);
define("ADMIN", dirname(__FILE__));

$parts = explode(S, ADMIN);
array_pop($parts);
define("ROOT", implode(S, $parts));

include(ROOT.S."system".S."Autoloader.php");
include(ADMIN.S."system".S."classes.inc.php");

Session::getSession()->start();

$_GET = System::clean($_GET);
$_POST = System::clean($_POST);

if (isset($_POST["action"])) {
	Modul::loadModul($_POST["action"], ADMIN)->execute();
}

?>

<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>Admin Area</title>

  <link rel="stylesheet" href="../foundation/stylesheets/foundation.min.css">
  <link rel="stylesheet" href="../foundation/stylesheets/app.css">

  <script src="../foundation/javascripts/modernizr.foundation.js"></script>

  <!-- Included JS Files (Compressed) -->
  <script src="../foundation/javascripts/jquery.js"></script>
  <script src="../foundation/javascripts/foundation.min.js"></script>
  
  <!-- Initialize JS Plugins -->
  <!-- <script src="foundation/javascripts/app.js"></script> -->


  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>
<body>

  <!-- Nav Bar -->

  <div class="row">
    <div class="twelve columns">
      <ul class="nav-bar">
        <li><a href="#">Startseite</a></li>
        <li><a href="?display=articles">Articles</a></li>
        <li><a href="?display=users">Users</a></li>
        <li><a href="#">Not Used</a></li>
      </ul>

      <h1>Admin Area</h1>
      <hr />
    </div>
  </div>

  <!-- End Nav -->


  <!-- Main Page Content and Sidebar -->

  <div class="row">

    <!-- Main Blog Content -->
    <div class="nine columns" role="content">

<?php 
if (User::isLoggedIn()) {
	if(isset($_GET["display"])){
		Modul::loadModul($_GET["display"], ADMIN)->display();
	} else {
		Modul::loadModul("articles", ADMIN)->display();
	}
} else {
	Modul::loadModul("login", ADMIN)->display();
} 
?>

    </div>

    <!-- End Main Content -->


    <!-- Sidebar -->

    <aside class="three columns">

      <h5>Categories</h5>
      <ul class="side-nav">
        <li><a href="#">News</a></li>
        <li><a href="#">Code</a></li>
        <li><a href="#">Design</a></li>
        <li><a href="#">Fun</a></li>
        <li><a href="#">Weasels</a></li>
      </ul>

      <div class="panel">
        <h5>Featured</h5>
        <p>Pork drumstick turkey fugiat. Tri-tip elit turducken pork chop in. Swine short ribs meatball irure bacon nulla pork belly cupidatat meatloaf cow.</p>
        <a href="#">Read More &rarr;</a>
      </div>

    </aside>

    <!-- End Sidebar -->
  </div>

  <!-- End Main Content and Sidebar -->


  <!-- Footer -->

  <footer class="row">
    <div class="twelve columns">
      <hr />
      <div class="row">
        <div class="six columns">
          <p>&copy; WebEng Project</p>
        </div>
        <div class="six columns">
          <ul class="link-list right">
            <li><a href="#">Last article</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
            <li><a href="#">Archive</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- End Footer -->

</body>
</html>

