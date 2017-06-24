<?php

class UserGet extends API implements APIInterface {
	
	public function method() {
		return "GET";
	}
	
	public function validate() {
		return true;
	}
	
	public function arguments() {
		return array(
			array('filter'=>FILTER_SANITIZE_NUMBER_INT)
		);
	}
	
	public function process($id) {
		$data = [
			'id' => $id,
			'username' => "test.user"
		];
			
		return $data;
	}
}
