<?php
/*******************************************************************************
 * Displays the created comments as a JSON string
 *
 * @version		1.0
 *******************************************************************************/

//Check if a new comment will be created or the new comments want to be got
if (isset($_POST["article"]) && isset($_POST["since"])) {
	$comments = Modul::loadModul("comment", ROOT)->getComments((int) $_POST["article"], $_POST["since"]);

	echo json_encode($comments);

} elseif (isset($_POST["article"]) && isset($_POST["author"]) && isset($_POST["content"])) {
	$result = Modul::loadModul("comment", ROOT)->createComment($_POST["article"], trim($_POST["author"]), trim($_POST["content"]));

	echo $result ? 1 : 0;
}

?>