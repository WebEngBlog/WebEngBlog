<?php
/*******************************************************************************
* Contains the Tag module for the frontend
*
* @version		1.0
*******************************************************************************/

class Tag extends Modul {
	
	/**
	 * The minimum size of the font
	 * @var int
	 */
	const MIN_SIZE = 12;
	
	/**
	 * The maximum size of the font
	 * @var int
	 */
	const MAX_SIZE = 24;
	
	/**
	 * The max count of tags to be displayed
	 * @var int
	 */
	const MAX_TAGS = 20;
	
	/**
	 * Returns all tags
	 * @return multitype:number
	 */
	public function &getTags() {
		//Get all articles with tags
		$articles = R::find("article", "tags != ''");
		
		//Save the count of tag for each
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
		
		//Remove the tags with the less count until max count is reached
		while (count($tag_count) > Tag::MAX_TAGS) {
			unset($tag_count[array_search(min($tag_count), $tag_count)]);
		}
		
		//Sort tags ascending
		ksort($tag_count);
		
		return $tag_count;
	}
}

?>