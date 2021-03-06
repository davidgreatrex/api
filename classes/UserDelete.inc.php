<?php

class UserDelete extends API implements APIInterface {
	
	public function method() {
		return "DELETE";
	}
	
	public function validate() {
		return true;
	}
	
	public function arguments() {
		return array(
			0 => array('filter'=>FILTER_SANITIZE_NUMBER_INT)
		);
	}
	
	public function process($id) {
		/**
		 * Add functionality to delete a user by it's id
		 */
	}
}
