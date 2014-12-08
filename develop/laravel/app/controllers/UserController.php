<?php

class UserController extends \BaseController {

	protected $layout = 'layout.master';

	private $view_params = array();
	
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

	public function postLogout()
	{
		Auth::logout();
	}


	public function getLogout()
	{
		Auth::logout();

		return Redirect::to("/");
	}
}