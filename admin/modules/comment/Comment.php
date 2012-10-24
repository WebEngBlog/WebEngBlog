<?php
/*******************************************************************************
* Comments modul for the backend (admin area)
* 
* @author 		Tobias Röding
* @copyright	Tobias Röding, 24.10.12
* @version		0.9	
*******************************************************************************/

class Comment extends Modul {

	public function execute() {
		$comment = self::getComment((int) $_GET["id"]);
		if(isset($_POST["delete"])){
			self::deleteComment((int) $_GET["id"]);
		}
		echo '<script type="text/javascript">window.location.href="?display=comment&article='.$comment->article.'";</script>';
	}

	public function getComment($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}
		return R::load("comment", $id);
	}

	public function getAllCommentsWithArticleID($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}
		return R::find("comment", "article = ? ORDER BY created DESC", array($id));
	}

	public function deleteComment($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}
		$comment = R::load("comment", $id);
		return R::trash($comment);
	}
}

?>