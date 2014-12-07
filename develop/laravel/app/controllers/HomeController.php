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
		$step = Input::get("step");
		if( empty($step) ){
			$step = 1;
		}
		if(method_exists($this, "step" . $step)){
			$this->{ "step" . $step }();
			return;
		}

		trigger_error("Wrong page. Please go back.");
	}


	


}
