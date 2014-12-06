<?php

/**
This class is supposed to be created to make RESTfull request from a simple manner
and flexible enough to be able to adjust to any API, using PHP.
Also the idea is create plugins or libs associated to this library for
processing the data, for example, the library includes 2 modules, 
one for reading and interprete Twitter and other for Facebook.
The are great libs out there for each language, the idea here is having
the same pattern of functionality for every API, so is easy
to remember in a world with so many freaking different APIs (and is awesome!!!) 

@author: Franco Risso <franco@720desarrollos.com>
@version 1.0-dev
*/
class RESTreader {
	private $result;

	private $method;
	private $object;
	private $endpoint;
	
	private $error_code;

	public function __construct(){
	}

	function __call($method, $args){
		if( method_exists($this, $method) ){
			$this->{$method}($args);
			return;
		}

		$this->method = strtolower($method);
		$this->parameters = (!empty($args)? $args[0] : null);
		$this->request();
	}

	public function set_endpoint( $endpoint ){
		$this->endpoint = $endpoint;
	}

	/**
	check http://support.qualityunit.com/061754-How-to-make-REST-calls-in-PHP for details
	*/
	private function request(){
		$this->result = null;

		if(empty($this->endpoint)){
			trigger_error("Empty API endpoint");
			return false;
		}

		$curl = curl_init();

		switch($this->method){
			case 'get':
				curl_setopt($curl, CURLOPT_URL, $this->endpoint . '?' . http_build_query($this->parameters));
				
				break;
			case 'post':
				curl_setopt($curl, CURLOPT_URL, $this->endpoint);
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($this->parameters));
				break;
		}

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$curl_response = curl_exec($curl);
		if ($curl_response === false) {
		    $info = curl_getinfo($curl);
		    curl_close($curl);
		    trigger_error("Error retrieving info from endpoint");
		    return false;
		}

		curl_close($curl);

		$this->result = $curl_response;

		return true;
	}

	public function resultJSON($parameters = null){
		return $this->result;
	}

	public function resultArray($parameters = null){
		return json_decode($this->result, true);
	}

}


