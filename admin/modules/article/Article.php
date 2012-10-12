<?php

class Article extends Modul {

	public function execute() {
		if(isset($_POST["create"])){
			self::createArticle($_POST["title"],$_POST["content"]);
		} elseif(isset($_POST["edit"])){
			self::editArticle((int) $_GET["id"],$_POST["title"],$_POST["content"]);
		} elseif(isset($_POST["delete"])){
			self::deleteArticle((int) $_GET["id"]);
		}
		echo '<script type="text/javascript">window.location.href="?";</script>';
		//header doesn't work here, headers already sent
		//header("Location: ?");
	}

	public function &getArticle($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}
		
		return R::load("article", $id);
	}

	public function &createArticle($title,$content) {
		$article = R::dispense("article");
		$article->title = $title;
		$article->content = $content;
		$article->author = User::getLoggedInUserID();
		date_default_timezone_set('UTC');
		$article->last_edit = date('Y-m-d H:i:s');
		$article->creation_date = date('Y-m-d H:i:s');
		return R::store($article);
	}

	public function &editArticle($id,$title,$content) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}
		$article = R::load("article", $id);
		$article->title = $title;
		$article->content = $content;
		$article->author = User::getLoggedInUserID();
		date_default_timezone_set('UTC');
		$article->last_edit = date('Y-m-d H:i:s');
		return R::store($article);
	}

	public function &deleteArticle($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}
		$article = R::load("article", $id);
		return R::trash($article);
	}
}

?>