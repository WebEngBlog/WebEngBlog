<?php
/*******************************************************************************
 * Displays the search result as a JSON string
 *
 * @version		1.0
 *******************************************************************************/

if (isset($_POST["search"])) {
	$result = Modul::loadModul("search", API)->getResult($_POST["search"]);

	echo json_encode($result);
}

?>	