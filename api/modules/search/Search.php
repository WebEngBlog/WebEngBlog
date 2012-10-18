<?php

class Search extends Modul {
	
	const MAX_RESULTS = 5;
	
	public function getResult($search) {
		$beans = R::find("article", "content LIKE ? OR title LIKE ? OR tags LIKE ?", 
				array("%". $search ."%", "%". $search ."%", "%". $search ."%"));
		
		$result = array();
		
		$search = strtoupper($search);
		
		foreach ($beans as $key => $article) {
			$count = substr_count(strtoupper($article->title), $search)
				+ substr_count(strtoupper($article->content), $search)
				+ substr_count(strtoupper($article->tags), $search);
			
			$article = array("id" => $key, "title" => $article->title);

			$result[$count] = $article;
		}
		
		krsort($result);
		
		return array_slice($result, 0, Search::MAX_RESULTS);
	}
}

?>