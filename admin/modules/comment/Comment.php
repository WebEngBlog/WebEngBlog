<?php
/*******************************************************************************
* Comments modul for the backend (admin area)
* 
* @version		1.0	
*******************************************************************************/

class Comment extends Modul {

	public function execute() {
		$comment = self::getComment((int) $_GET["id"]);
		if(isset($_POST["delete"])){
			self::deleteComment((int) $_GET["id"]);
		}
		echo '<script type="text/javascript">window.location.href="?display=comment&article='.$comment->article.'";</script>';
	}

	/**
	 * Returns a comment specified by the id 
	 *
	 * @param integer $id Id of the comment
	 */
	public function getComment($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}
		return R::load("comment", $id);
	}

	/**
	 * Get all comments for the specfified article from the database 
	 *
	 * @param integer $id Id of the searched article
	 */
	public function getAllCommentsWithArticleID($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}
		return R::find("comment", "article = ? ORDER BY created DESC", array($id));
	}

	/**
	 * Deletes a comment from the database 
	 *
	 * @param integer $id Id of the comment
	 */
	public function deleteComment($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}
		$comment = R::load("comment", $id);
		return R::trash($comment);
	}
}

?>