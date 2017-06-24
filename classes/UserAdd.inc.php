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
		
	}
}