<?php

class CommentManagement {
	
	public static function createComment($id, $author, $content) {
		if (preg_match("/[^a-zA-Z0-9_\-]+/", $author) > 0 || strlen($author) === 0 || strlen($author) > 20) {
			throw new InvalidArgumentException("Author is invalid", 1);
		}
		
		if (strlen($content) === 0) {
			throw new InvalidArgumentException("Content is invalid", 2);
		}
		
		$article = R::load("article", $id);
		
		if ($article->id != $id) {
			throw new InvalidArgumentException("Article is invalid", 3);
		}
		
		$comment = R::dispense("comment");
		$comment->article = $id;
		$comment->author = $author;
		$comment->content = $content;
		$comment->created = date("Y-m-d H:i:s");
		R::store($comment);
	}
}

?>