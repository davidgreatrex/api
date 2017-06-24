<?php

/**
 * A class to handle the routing of the api requests.
 */
class Router {
	
	public static $_active = null;
	
	public static $_routes = [];
	
	public static $_path = null;
	
	public static $_verb = null;
	
	public static $_action = null;
	
	public static $_arguments = [];
	
	
	public static function set($path, Closure $func) {
		if (!array_key_exists($path, self::$_routes)) {
			self::$_routes[$path] = $func;
		}
	}
	
	public static function get() {
		
		$path = filter_input(INPUT_GET, 'request', FILTER_SANITIZE_URL);
		
		self::$_path = $path;
		self::$_arguments = array_map('trim', explode("/", $path));
		self::$_verb = array_shift(self::$_arguments);
		self::$_action = array_shift(self::$_arguments);
		
		foreach (self::$_routes as $k => $func) {
			if (strpos($path, $k) === 0) {
				self::$_active = $func();
				return true;
			}
		}
		
		throw new Router_Exception("Route Not Found");
	}
	
	public static function validateMethod() {
		$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
		
		if ($method != self::$_active->method()) {
			throw new Router_Exception("Invalid method used");
		}
	}
	
	public static function validateData() {
		$valid = self::$_active->validate();
		
		if (!$valid) {
			throw new Router_Exception("Invalid data received");
		}
	}
	
	public static function process() {
		$options = self::$_active->arguments();
		
		foreach (self::$_arguments as $k => $v) {
			if ($options[$k]['filter']) {
				self::$_arguments[$k] = filter_var($v, $options[$k]['filter']);
			}
		}
		
		$response = call_user_func_array(array(self::$_active, 'process'), self::$_arguments);
		
		self::response($response);
	}
	
	public static function response($data, $code=200, $message="OK") {
		header("HTTP/1.1 {$code} {$message}");
		print json_encode($data);
	}
}

