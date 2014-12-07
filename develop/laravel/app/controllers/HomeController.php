<?php

class HomeController extends \BaseController {

	protected $layout = 'layout.master';

	private $view_params = array();
	private $user_id;
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
