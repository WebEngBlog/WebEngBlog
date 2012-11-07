<?php
/*******************************************************************************
 * Contains class CommentManagement which is used to store a comment in the
 * database
 *
 * @version		1.0
 *******************************************************************************/

class CommentManagement {
	
	/**
	 * 
	 * @param integer $id Id of the related article
	 * @param String  $author The author, only a-z A-Z 0-9 _ - are allowed and 
	 * the maximal length is 20
	 * @param String $content
	 * @throws InvalidArgumentException
	 */
	public static function createComment($id, $author, $content) {
		//Check that author is valid
		if (preg_match("/[^a-zA-Z0-9_\-]+/", $author) > 0 || strlen($author) === 0 || strlen($author) > 20) {
			throw new InvalidArgumentException("Author is invalid", 1);
		}
		
		//Check that content is not empty
		if (strlen($content) === 0) {
			throw new InvalidArgumentException("Content is invalid", 2);
		}
		
		//Check that id of the article is correct
		$article = R::load("article", $id);
		if ($article->id != $id) {
			throw new InvalidArgumentException("Article is invalid", 3);
		}
		
		//Store the comment
		$comment = R::dispense("comment");
		$comment->article = $id;
		$comment->author = $author;
		$comment->content = $content;
		$comment->created = date("Y-m-d H:i:s");
		R::store($comment);
	}
}

?>