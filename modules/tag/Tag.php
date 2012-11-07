<?php
/*******************************************************************************
* Contains the Tag module for the frontend
*
* @version		1.0
*******************************************************************************/

class Tag extends Modul {
	
	const MIN_SIZE = 12;
	const MAX_SIZE = 24;
	
	const MAX_TAGS = 20;
	
	public function &getTags() {
		$articles = R::find("article", "tags != ''");
		
		$tag_count = array();
		foreach ($articles as $article) {
			$tags = explode(";", html_entity_decode($article->tags));
			foreach ($tags as $tag) {
				$tag = htmlentities($tag);
				if (array_key_exists($tag, $tag_count)) {
					$tag_count[$tag]++;
				} else {
					$tag_count[$tag] = 1;
				}
			}
		}
		krsort($tag_count);
		
		while (count($tag_count) > Tag::MAX_TAGS) {
			unset($tag_count[array_search(min($tag_count), $tag_count)]);
		}
		
		ksort($tag_count);
		
		return $tag_count;
	}
}

?>