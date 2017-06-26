<?php

class UserAdd extends API implements APIInterface {
	
	public function method() {
		return "POST";
	}
	
	public function validate() {
		return true;
	}
	
	public function arguments() {
		return array();
	}
	
	public function process() {
		/**
		 * The data submitted in the request
		 */
		$data = Router::$_data;
		
		/**
		 * Add functionality to add a user
		 */
	}
}