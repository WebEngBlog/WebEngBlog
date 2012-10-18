<?php

if (isset($_POST["search"])) {
	$result = Modul::loadModul("search", API)->getResult($_POST["search"]);

	echo json_encode($result);
}

?>	