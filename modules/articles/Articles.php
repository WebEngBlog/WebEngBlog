<?php
/*******************************************************************************
* Articles modul for the frontend
* 
* @author 		Lukas Berg
* @copyright	Lukas Berg, 14.10.2012
* @version		0.9
*******************************************************************************/

class Articles extends Modul {
	
	public function display() {
		
		parent::display();
	}
	
	public function execute() {
		
	}
	
	public static function &getAll() {
		return R::findAll("article", " ORDER BY creation_date DESC");	
	}
}

?>