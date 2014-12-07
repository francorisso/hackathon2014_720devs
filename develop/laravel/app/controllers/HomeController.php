<?php

class HomeController extends \BaseController {

	protected $layout = 'layout.master';

	private $view_params = array();
	
	/**
	Basic controller for creating topics
	*/
	public function getIndex()
	{
		if (Auth::check()){
		    $this->layout = View::make("home");
		} else {
			$this->layout = View::make("login");
		}
	}


}
