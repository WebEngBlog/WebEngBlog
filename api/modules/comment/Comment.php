<?php

class Comment extends Modul {
	
	public function createComment($article, $author, $content) {
		try {
			CommentManagement::createComment($article, $author, $content);
		} catch (InvalidArgumentException $e) {
			return false;
		}
		return true;
	}
	
	public function getComments($article, $since) {
		if (strtotime($since) === false) {
			return array();
		}
		
		$comments = R::find("comment", "article = ? AND created > ? ORDER BY created", array($article, $since));
		$result = array("comments" => array());

		foreach ($comments as $comment) {
			$result["comments"][] = array("author" => $comment->author, "content" => $comment->content,
					"created" => date("d.m.Y, H:i", strtotime($comment->created)));
		}
		
		$result["since"] = array_pop($comments)->created;
		
		return $result;
	}
}

?>