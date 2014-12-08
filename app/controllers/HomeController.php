<?php

class HomeController extends \BaseController {

	protected $layout = 'layout.master';

	private $view_params = array();
	private $google_client;
	private $user_id;

	public function __construct(Google_Client $google_client){
		$this->google_client = $google_client;
		$this->google_client->setDeveloperKey( $this->google_api_key );
		$this->user_id = Auth::id();
		$this->view_params["google_api_key"] = $this->google_api_key;
	}

	/**
	Basic controller for creating topics
	*/
	public function getIndex()
	{	
		if (Auth::check()){
			$this->user_id = Auth::id();

			$this->layout = View::make("home", $this->view_params);
		} else {
			$this->layout = View::make("login");
		}
	}


}
