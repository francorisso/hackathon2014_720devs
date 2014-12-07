<?php

class UserController extends \BaseController {

	protected $layout = 'layout.master';

	//Google API key
	private $google_api_key = "AIzaSyBUsuVB1YULi0Zmmjr4L0hCrDSrpBKzT-U";

	private $view_params = array();
	
	/**
	Basic controller for creating topics
	*/
	public function postLogin()
	{
		$fb_id = Input::get("id");
		$user = User::where( array("fb_id"=>$fb_id) )->first();
		if(empty($user)){
			$user = new User();
			$user->fb_id 		= $fb_id;
			$user->email 		= Input::get("email");
			$user->username 	= Input::get("name");
			$user->first_name 	= Input::get("first_email");
			$user->last_name 	= Input::get("last_name");

			$user->save();
		}

		Auth::login($user);

		return Response::json( $user );
	}


}