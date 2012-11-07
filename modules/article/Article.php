<?php
/*******************************************************************************
* Article modul for the frontend
* 
* @version		1.0
*******************************************************************************/

class Article extends Modul {
	
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
	public function getAllArticles() {
		return R::findAll("article", " ORDER BY creation_date DESC");	
	}

	/**
	 * Get all articles with the specified tag from the database 
	 *
	 * @param String $tag Tag to search for
	 */
	public function getAllArticlesWithTag($tag) {
		if (!is_string($tag)){
			throw new InvalidArgumentException($tag ." is not a string");
		}
		return R::find("article", "tags LIKE ?", array("%". $tag ."%"));
	}

	/**
	 * Get all articles with the specified author from the database 
	 *
	 * @param String $author Author to search for
	 */
	public function getAllArticlesWithAuthor($author) {
		if (!is_int($author)) {
			throw new InvalidArgumentException($author ." is not an int");
		}
		return R::find("article", "author = ?", array($author));
	}
	
	/**
	 * Get all articles with the specified search string from the database 
	 *
	 * @param String $search Arbitrary String to search for
	 */
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