<?php

class Article extends Modul {
	
	public function execute() {
		
	}
	
	public function &getArticle($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}
		
		return R::load("article", $id);
	}
}

?>