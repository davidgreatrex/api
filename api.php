<?php

/**
 * Include the api config options
 */
require 'config.inc.php';

/**
 * Autoloads the classes that are required from the classes folder
 * @param string $classname The name of the class to load
 */
function __autoload($classname) {
	if (file_exists("classes/{$classname}.inc.php")) {
		require "classes/{$classname}.inc.php";
	}
}

/**
 * Add valid routes that can be used with the api
 */
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

/**
 * Add more routes here...
 */
try {
	/**
	 * force connections over https
	 */
	$secure = filter_has_var(INPUT_SERVER, 'HTTPS');

	if (!$secure && CONFIG_FORCE_SECURE) {
		Router::response("Please connect using an HTTPS connection", 403);
		exit;
	}

	/**
	 * Set the data that was sent in the request so it can be used later
	 */
	Router::data();

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
	Router::response($ex->getMessage(), 400);
} catch (Exception $ex) {
	Router::response($ex->getMessage(), 400);
}
