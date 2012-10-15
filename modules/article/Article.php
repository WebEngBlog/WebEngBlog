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
	
	public function &getArticle($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}

		return R::load("article", $id);
	}

	public static function &getAll() {
		return R::findAll("article", " ORDER BY creation_date DESC");	
	}
}

?>