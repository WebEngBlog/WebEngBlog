<?php

define("S", DIRECTORY_SEPARATOR);
define("ROOT", dirname(__FILE__));

include(ROOT.S.'system'.S.'Autoloader.php');

// we need  a url regex check 
// for urls like /posts/2012/3/3 and /posts/testname

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="jquery-1.8.2.min.js"></script>
		<script type="text/javascript">

			function loadContent(data) {
				window.location.href = "?" + data;
			}
		
		</script>
		
		<style type="text/css">
		
			#content {
				margin: 0 auto;
				width: 700px;
			}
			
			.article_preview {
				cursor: pointer;
				border: solid;
				margin-bottom: 12px;
			}
			
			.comment {
				color: red;
			}
			
		</style>
	</head>
	<body>
		<section id="content"><?php System::display(ROOT, "articles"); ?></section>
	</body>
</html>

<?php 

?>