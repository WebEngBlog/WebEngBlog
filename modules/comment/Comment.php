<?php
/*******************************************************************************
* Comment modul for the frontend
*
* @version		1.0
*******************************************************************************/

class Comment extends Modul {

	private $error = false;
	private $author = "";
	private $content = "";

	public function execute() {
		if (!isset($_POST["author"]) || !isset($_POST["content"]) || !isset($_GET["id"])) {
			return;
		}
		
		$author = trim($_POST["author"]);
		$content = trim($_POST["content"]);

		try {
			CommentManagement::createComment((int) $_GET["id"], $author, $content);
		} catch (InvalidArgumentException $e) {
			$this->error = $e->getMessage();
			switch ($e->getCode()) {
				case 1:
					$this->content = $content;
					break;
				case 2:
					$this->author = $author;
					break;
				default:
					$this->author = $author;
					$this->content = $content;
			}
		}
	}
	
	public function getError() {
		return $this->error;
	}
	
	public function getAuthor() {
		return $this->author;
	}
	
	public function getContent() {
		return $this->content;
	}

	public function getComments($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}

		return R::find("comment", "article = ? ORDER BY created DESC", array($id));
	}
}

?>