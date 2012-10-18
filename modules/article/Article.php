<?php
/*******************************************************************************
* Article modul for the frontend
* 
* @author 		Lukas Berg, Tobias Röding
* @copyright	@author, 14.10.2012
* @version		0.9
*******************************************************************************/

class Article extends Modul {
	
	public function execute() {
		
	}
	
	public function getArticle($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}

		return R::load("article", $id);
	}

	public static function getAll() {
		return R::findAll("article", " ORDER BY creation_date DESC");	
	}

	public function getAllArticleWithTag($tag) {
		if (!is_string($tag)){
			throw new InvalidArgumentException($tag ." is not a string");
		}
		return R::find("article", "tags LIKE '%" . $tag . "%'");
	}

	public function getAllArticleWithAuthor($author) {
		if (!is_int($author)){
			throw new InvalidArgumentException($tag ." is not a string");
		}
		return R::find("article", "author == '" . $author . "'");
	}
}

?>