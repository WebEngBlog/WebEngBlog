<?php

class Articles extends Modul {
	
	public function display() {
		
		parent::display();
	}
	
	public function execute() {
		
	}
	
	public static function &getAll() {
		return R::findAll("article", " ORDER BY last_edit DESC");	
	}
}