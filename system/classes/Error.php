<?php
/*******************************************************************************
 * Error class which is used to handle errors in the system
 *
 * @version		1.0
 *******************************************************************************/

class Error {

	/**
	 * Stores a message
	 * @var String
	 */
	private $msg = null;
	
	/**
	 * Stores the file of the error
	 * @var String
	 */
	private $file = null;
	
	/**
	 * Stores the line of the error
	 * @var String
	 */
	private $line = null;

	/**
	 * 
	 * @param string $msg The message
	 * @param string $file The file of the error. [optional]
	 * @param string $line The line of the error. [optional]
	 */
	public function __construct($msg, $file = null, $line = null) {
		$this->msg = $msg;
		$this->file = $file;
		$this->line = $line;
	}

	/**
	 * Returns the message
	 * @return string
	 */
	public function getMessage() {
		return $this->msg;
	}

	/**
	 * Returns the file
	 * @return string
	 */
	public function getFile() {
		return $this->file;
	}

	/**
	 * Returns the line
	 * @return string
	 */
	public function getLine() {
		return $this->line;
	}

	/**
	 * Returns a formated string to print
	 * @return string
	 */
	public function toString() {
		return "Error: ". ($this->file != null ? "In file: ". $this->file .". " : "") . 
			($this->line != null ? "In line: ". $this->line .". " : "") . $this->msg;
	}
}

?>