<?php
/*******************************************************************************
* Comment modul for the frontend
*
* @version		1.0
*******************************************************************************/

/**
 * Creates new comments or return the created
 */
class Comment extends Modul {

	/**
	 * Contains error if somethings happend while creating a comment
	 * @var string|boolean
	 */
	private $error = false;
	
	/**
	 * The author of the comment
	 * @var string
	 */
	private $author = "";
	
	/**
	 * The content of the comment
	 * @var string
	 */
	private $content = "";

	public function execute() {
		//Checl that arguments are given
		if (!isset($_POST["author"]) || !isset($_POST["content"]) || !isset($_GET["id"])) {
			return;
		}
		
		$author = trim($_POST["author"]);
		$content = trim($_POST["content"]);

		//Create the comment handle, if an error occurs
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
	
	/**
	 * Return the error
	 * @return Ambigous <string, boolean>
	 */
	public function getError() {
		return $this->error;
	}
	
	/**
	 * The author
	 * @return string
	 */
	public function getAuthor() {
		return $this->author;
	}
	
	/**
	 * The content
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Returns all comments
	 * @param int $id The id of the article
	 * @throws InvalidArgumentException
	 * @return Ambigous <multitype:, multitype:Ambigous <RedBean_OODBBean, unknown> >
	 */
	public function getComments($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}

		//Load the comments descending by creating date
		return R::find("comment", "article = ? ORDER BY created DESC", array($id));
	}
}

?>