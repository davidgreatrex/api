<?php

/**
 * An interface for api requests to implement. This makes the system more concreate when adding new api requests
 */
interface APIInterface {
	
	/**
	 * Returns the method that is supported by the current request
	 */
	public function method();
	
	/**
	 * Validates the information that has been sent to ensure that it is what is expected
	 */
	public function validate();
	
	/**
	 * Gets information that formats and handles the arguments that are passed into the process method
	 */
	public function arguments();
}
