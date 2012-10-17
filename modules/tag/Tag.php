<?php

class Tag extends Modul {
	
	const MIN_SIZE = 12;
	const MAX_SIZE = 24;
	
	const MAX_TAGS = 20;
	
	public function &getTags() {
		$articles = R::find("article", "tags != ''");
		
		$tag_count = array();
		foreach ($articles as $article) {
			$tags = explode(" ", preg_replace("/\s{2,}/", " ", $article->tags));
			foreach ($tags as $tag) {
				if (array_key_exists($tag, $tag_count)) {
					$tag_count[$tag]++;
				} else {
					$tag_count[$tag] = 1;
				}
			}
		}
		krsort($tag_count);
		
		while (count($tag_count) > self::MAX_TAGS) {
			unset($tag_count[array_search(min($tag_count), $tag_count)]);
		}
		
		ksort($tag_count);
		
		return $tag_count;
	}
}

?>