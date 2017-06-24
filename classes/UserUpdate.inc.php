<?php

class UserUpdate extends API implements APIInterface {
	
	public function method() {
		return "PUT";
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
		
	}
}
