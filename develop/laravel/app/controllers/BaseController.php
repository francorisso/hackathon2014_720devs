<?php

class BaseController extends Controller {

	protected $google_api_key = "AIzaSyAP7bMOYrtVgQueAcBtRsYVN1Ebxo3s3A8";
	
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
