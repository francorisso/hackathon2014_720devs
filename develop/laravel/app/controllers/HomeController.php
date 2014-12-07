<?php

class HomeController extends \BaseController {

	protected $layout = 'layout.master';

	//Google API key
	private $google_api_key = "AIzaSyBUsuVB1YULi0Zmmjr4L0hCrDSrpBKzT-U";

	private $view_params = array();
	
	/**
	Basic controller for creating topics
	*/
	public function getIndex()
	{
		$this->layout = View::make("home");
	}


	


}
