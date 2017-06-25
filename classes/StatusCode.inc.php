<?php

/**
 * This class handles the HTTP status codes and messages used in the api response.
 */
class StatusCode {
	
	/**
	 * The HTTP status code that is passed into the constructor when the object is created.
	 * @var int 
	 */
	public $code = 0;
	
	/**
	 * The HTTP status message that is used in the HTTP status response header
	 * @var string
	 */
	public $message = null;
	
	/**
	 * A valid list of HTTP status codes and their associated messages
	 * @var array
	 */
	private $_codes = [
		100 => 'Continue',
		101 => 'Switching Protocols',
		102 => 'Processing',
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative Information',
		204 => 'No Content',
		205 => 'Reset Content',
		206 => 'Partial Content',
		207 => 'Multi-Status',
		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modified',
		305 => 'Use Proxy',
		306 => 'Switch Proxy',
		307 => 'Temporary Redirect',
		400 => 'Bad Request',
		401 => 'Unauthorized',
		402 => 'Payment Required',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Timeout',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Long',
		415 => 'Unsupported Media Type',
		416 => 'Requested Range Not Satisfiable',
		417 => 'Expectation Failed',
		418 => 'I\'m a teapot',
		422 => 'Unprocessable Entity',
		423 => 'Locked',
		424 => 'Failed Dependency',
		425 => 'Unordered Collection',
		426 => 'Upgrade Required',
		449 => 'Retry With',
		450 => 'Blocked by Windows Parental Controls',
		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		502 => 'Bad Gateway',
		503 => 'Service Unavailable',
		504 => 'Gateway Timeout',
		505 => 'HTTP Version Not Supported',
		506 => 'Variant Also Negotiates',
		507 => 'Insufficient Storage',
		509 => 'Bandwidth Limit Exceeded',
		510 => 'Not Extended'
	];
	
	/**
	 * Create the StatusCode object using a valid HTTP status code
	 * @param int $code
	 */
	public function __construct($code) {
		$this->code = intval($code);
	}
	
	/**
	 * Checks to see that the HTTP status code actually exists in the list of valid codes
	 * @return bool Returns <b>True</b> if the code exists, otherwise <b>False</b> is returned
	 */
	public function exists() {
		return array_key_exists($this->code, $this->_codes);
	}
}
