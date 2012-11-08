<?php
/*******************************************************************************
 * The search modul
 *
 * @version		1.0
 *******************************************************************************/

/**
 * Is used to geturn all results for a given search string
 */
class Search extends Modul {

	/**
	 * Define the maximal count of results
	 * @var int
	 */
	const MAX_RESULTS = 5;

	/**
	 *
	 * @param string $search The word to search for
	 * @return multitype:array
	 */
	public function getResult($search) {
		//Search the given word in the content, title and tags of each article
		$beans = R::find("article", "content LIKE ? OR title LIKE ? OR tags LIKE ?",
				array("%". $search ."%", "%". $search ."%", "%". $search ."%"));

		$result = array();
		$search = strtoupper($search);

		//Put the needed parameters in an array and count the matches of
		//the search string
		foreach ($beans as $key => $article) {
			$count = substr_count(strtoupper($article->title), $search)
			+ substr_count(strtoupper($article->content), $search)
			+ substr_count(strtoupper($article->tags), $search);

			$article = array("id" => $key, "title" => $article->title);

			$result[$count] = $article;
		}
		//Sort the array descending from count of matches
		krsort($result);

		return array_slice($result, 0, Search::MAX_RESULTS);
	}
}

?>