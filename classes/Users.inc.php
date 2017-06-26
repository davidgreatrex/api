<?php

class Users extends API implements APIInterface {
	
	public function method() {
		return "GET";
	}
	
	public function validate() {
		return true;
	}
	
	public function arguments() {
		return array();
	}
	
	public function process() {
		/**
		 * TODO: Add functionality to list all users
		 */
	}
}
