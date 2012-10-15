<?php
/*******************************************************************************
* Comment modul for the frontend
* 
* @author 		Tobias Röding
* @copyright	@author, 14.10.2012
* @version		0.9
*******************************************************************************/

class Comment extends Modul {

	public function execute() {
		
	}

	public function &getComments($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException($id ." is not an int");
		}

		return R::find("comment", "article=?", array($id));	
	}
}

?>