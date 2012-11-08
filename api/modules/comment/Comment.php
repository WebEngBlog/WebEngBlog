<?php
/*******************************************************************************
 * The modul for the comment in the api area
*
* @version		1.0
*******************************************************************************/

/**
 * Is used to handle the comments via Javascript
 */
class Comment extends Modul {

	/**
	 * Create the comment if all parameters a valid
	 * @param int $article
	 * @param string $author
	 * @param string $content
	 * @return boolean
	 */
	public function createComment($article, $author, $content) {
		try {
			CommentManagement::createComment($article, $author, $content);
		} catch (InvalidArgumentException $e) {
			return false;
		}
		return true;
	}

	/**
	 * Returns all comments, created sinc the given time
	 * @param id $article
	 * @param long $since
	 * @return multitype:|multitype:multitype: NULL
	 */
	public function getComments($article, $since) {
		//Check that time is correct
		if (strtotime($since) === false) {
			return array();
		}

		//Get all comments created after since
		$comments = R::find("comment", "article = ? AND created > ? ORDER BY created", array($article, $since));
		$result = array("comments" => array());

		//Store the needed data for each comment
		foreach ($comments as $comment) {
			$result["comments"][] = array("author" => $comment->author, "content" => $comment->content,
					"created" => date("d.m.Y, H:i", strtotime($comment->created)));
		}

		$result["since"] = array_pop($comments)->created;

		return $result;
	}
}

?>