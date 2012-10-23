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

if (isset($_POST["action"])) {
	try {
		Modul::loadModul($_POST["action"])->execute();
	} catch (Exception $e) {
		echo $e;
	}
}

?>

<!DOCTYPE html>
<html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>Welcome to our Blog</title>

  <link rel="stylesheet" href="foundation/stylesheets/foundation.min.css">
  <link rel="stylesheet" href="foundation/stylesheets/app.css">
  <link rel="stylesheet" href="foundation/stylesheets/style.css" />

  <script src="foundation/javascripts/modernizr.foundation.js"></script>

  <!-- Included JS Files (Compressed) -->
  <script src="foundation/javascripts/jquery.js"></script>
  <script src="foundation/javascripts/foundation.min.js"></script>
  
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
      <h1>Welcome <small>This is our blog. Still in progress.</small>
      
      <ul class="nav-bar">
        <li><a href="index.php">Home</a></li>
        <li><a href="admin/index.php">Admin Area</a></li>
      </ul>
    </div>
  </div>

  <!-- End Nav -->


  <!-- Main Page Content and Sidebar -->

  <div class="row">

    <!-- Main Blog Content -->
    <div class="nine columns" role="content">

      <?php System::display(ROOT, "article"); ?>

    </div>

    <!-- End Main Content -->


    <!-- Sidebar -->

    <aside class="three columns">
      
      <!--
      <h5>Categories</h5>
      <ul class="side-nav">
        <li><a href="#">News</a></li>
        <li><a href="#">Code</a></li>
        <li><a href="#">Design</a></li>
        <li><a href="#">Fun</a></li>
        <li><a href="#">Weasels</a></li>
      </ul>
      -->
      
      <div class="panel">
        <h5>Search</h5>
        <?php Modul::loadModul("search", ROOT)->display(); ?>
      </div>
      
      <div class="panel">
        <h5>Tags</h5>
        <?php Modul::loadModul("tag", ROOT)->display(); ?>
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
            <li><a href="?display=about">About</a></li>
            <li><a href="?display=contact">Contact</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- End Footer -->

</body>
</html>
