<?php

class BaseController extends Controller {

	protected $google_api_key = "AIzaSyBZE4JI_RQWPuK7T3oaJMY3yTkttrducr0";
	
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
