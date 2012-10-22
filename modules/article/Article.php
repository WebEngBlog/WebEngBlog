<?php
/*******************************************************************************
* Article modul for the frontend
* 
* @author 		Lukas Berg, Tobias Röding
* @copyright	@author, 14.10.2012
* @version		0.9
*******************************************************************************/

class Article extends Modul {
	
	public function getArticle($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}
		return R::load("article", $id);
	}

	public function getAllArticles() {
		return R::findAll("article", " ORDER BY creation_date DESC");	
	}

	public function getAllArticlesWithTag($tag) {
		if (!is_string($tag)){
			throw new InvalidArgumentException($tag ." is not a string");
		}
		return R::find("article", "tags LIKE ?", array("%". $tag ."%"));
	}

	public function getAllArticlesWithAuthor($author) {
		if (!is_int($author)) {
			throw new InvalidArgumentException($author ." is not an int");
		}
		return R::find("article", "author = ?", array($author));
	}
	
	public function getAllArticlesWithSearch($search) {
		if (!is_string($search)){
			throw new InvalidArgumentException($search ." is not a string");
		}

		$search = "%". $search ."%";
		return R::find("article", "title LIKE ? OR content LIKE ? OR tags LIKE ?", 
				array($search, $search, $search));
	}
}

?>