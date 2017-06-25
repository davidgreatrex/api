<?php

/**
 * A class to handle the routing of the api requests.
 */
class Router {

	/**
	 * The handler to use with the request
	 * @var APIInterface
	 */
	public static $_active = null;

	/**
	 * The routes that are loaded into the class that are available to use in the api
	 * @var array
	 */
	public static $_routes = [];

	/**
	 * The path of the incoming api request
	 * @var string
	 */
	public static $_path = null;

	/**
	 * The noun to identify the target resorce
	 * @var string
	 */
	public static $_noun = null;

	/**
	 * The verb to identify the action to take on the noun
	 * @var string 
	 */
	public static $_verb = null;

	/**
	 * The arguments to pass to the handler that process the request
	 * @var array
	 */
	public static $_arguments = [];

	/**
	 * Add a path that can be used by the api
	 * @param string $path The path of the users request
	 * @param Closure $func Returns a function that returns the function to handle the api request
	 */
	public static function set($path, Closure $func) {
		if (!array_key_exists($path, self::$_routes)) {
			self::$_routes[$path] = $func;
		}
	}

	/**
	 * Gets the handler that will process the request
	 * @return boolean Returns <b>True</b> if the handling class if found, otherwise <b>Router_Exception</b> is thrown
	 * @throws Router_Exception
	 */
	public static function get() {

		$path = filter_input(INPUT_GET, 'request', FILTER_SANITIZE_URL);

		self::$_path = $path;
		self::$_arguments = array_map('trim', explode("/", $path));
		self::$_noun = array_shift(self::$_arguments);
		self::$_verb = array_shift(self::$_arguments);

		foreach (self::$_routes as $k => $func) {
			if (strpos($path, $k) === 0) {
				self::$_active = $func();
				return true;
			}
		}

		throw new Router_Exception("Route Not Found");
	}

	/**
	 * Validates the current method to ensure that it's correct for the request
	 * @throws Router_Exception
	 */
	public static function validateMethod() {
		$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

		if ($method != self::$_active->method()) {
			throw new Router_Exception("Invalid method used");
		}
	}

	/**
	 * Validates the data sent to ensure it is what is expected
	 * @throws Router_Exception
	 */
	public static function validateData() {
		$valid = self::$_active->validate();

		if (!$valid) {
			throw new Router_Exception("Invalid data received");
		}
	}

	/**
	 * Process the current api request
	 */
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

	/**
	 * Create the return response
	 * @param mixed $data aEither a <b>string</b> or an <b>array</b>
	 * @param int $code A valid HTTP status code
	 */
	public static function response($data, $code = 200) {
		$status = new StatusCode($code);

		header('Content-Type: application/json');
		header("HTTP/1.1 {$status->code} {$status->message}");
		print json_encode($data);
	}
}
