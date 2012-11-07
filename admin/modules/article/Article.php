<?php
/*******************************************************************************
* Contains the Article module for the backend (admin area)
*
* @version		1.0
*******************************************************************************/

class Article extends Modul {

	public function execute() {
		if(isset($_POST["create"])){
			self::createArticle($_POST["title"],$_POST["content"],$_POST["tags"]);
		} elseif(isset($_POST["edit"])){
			self::editArticle((int) $_GET["id"],$_POST["title"],$_POST["content"],$_POST["tags"]);
		} elseif(isset($_POST["delete"])){
			self::deleteArticle((int) $_GET["id"]);
		}
		echo '<script type="text/javascript">window.location.href="?";</script>';
		//header doesn't work here, headers already sent
		//header("Location: ?");
	}

	/**
	 * Get an article from the database with the specified id 
	 *
	 * @param integer $id Id of the searched article
	 */
	public function getArticle($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}
		return R::load("article", $id);
	}

	/**
	 * Get all articles from the database 
	 */
	public static function getAll() {
		return R::findAll("article", " ORDER BY creation_date DESC");	
	}

	/**
	 * Creates a new article with the specified params 
	 *
	 * @param String $title Title of the article
	 * @param String $content Text of the article
	 * @param String $tags Tags of the article
	 */
	public function createArticle($title,$content,$tags) {
		$article = R::dispense("article");
		$article->title = $title;
		$article->content = $content;
		$article->author = UserManagement::getLoggedInUserID();
		$article->tags = $tags;
		date_default_timezone_set('UTC');
		$article->last_edit = date('Y-m-d H:i:s');
		$article->creation_date = date('Y-m-d H:i:s');
		return R::store($article);
	}

	/**
	 * Edits a specified article 
	 *
	 * @param integer $id Id of the article
	 * @param String $title Title of the article
	 * @param String $content Text of the article
	 * @param String $tags Tags of the article
	 */
	public function editArticle($id,$title,$content,$tags) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}
		$article = R::load("article", $id);
		$article->title = $title;
		$article->content = $content;
		$article->author = UserManagement::getLoggedInUserID();
		$article->tags = $tags;
		date_default_timezone_set('UTC');
		$article->last_edit = date('Y-m-d H:i:s');
		return R::store($article);
	}

	/**
	 * Deletes a article specified by the id
	 *
	 * @param integer $id Id of the article
	 */
	public function deleteArticle($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}
		$article = R::load("article", $id);
		$comments = Modul::loadModul("comment", ADMIN)->getAllCommentsWithArticleID($id);

		foreach ($comments as $comment ) {
			R::trash($comment);
		}

		return R::trash($article);
	}
}

?>