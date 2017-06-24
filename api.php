<?php

function __autoload($classname) {
	if (file_exists("classes/{$classname}.inc.php")) {
		require "classes/{$classname}.inc.php";
	}
}

Router::set('users', function() {
	return new Users();
});

Router::set('user/add', function() {
	return new UserAdd();
});

Router::set('user/update', function() {
	return new UserUpdate();
});

Router::set('user/delete', function() {
	return new UserDelete();
});

Router::set('user/get', function() {
	return new UserGet();
});

try {
	/**
	 * Find the handler for this request
	 */
	Router::get();
	
	/**
	 * Check the request method is correct
	 */
	Router::validateMethod();
	
	/**
	 * Check the data sent is as it should be
	 */
	Router::validateData();
	
	/**
	 * Process the request and output the response
	 */
	Router::process();
	
} catch (Router_Exception $ex) {
	Router::response($ex->getMessage(), 400, "Bad Request");
} catch (Exception $ex) {
	Router::response($ex->getMessage(), 400, "Bad Request");
}
