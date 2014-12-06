<?php

class TopicController extends \BaseController {

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

	private function step1(){
		$this->layout = View::make( "newtopic.step1", $this->view_params );
	}

	private function step2(){
		/**
		TODO: securing form: http://laravel.com/docs/4.2/html
		*/
		$subject = Input::get("subject");
		if(empty($subject)){
			return Redirect::to('/');
		}

		/**  Freebase object creation **/
		$freebase = App::make("RESTreader");
		$freebase->set_endpoint( "https://www.googleapis.com/freebase/v1/search" );
		
		$params = array(
			'query' => null,
			'key' => $this->google_api_key
		);

		///First, I get all the topics in education and interests related to the search.
		$params["query"] 	= $subject;
		$params["filter"] 	= "(any type:/education/field_of_study type:/interests/hobby)";
		$params["limit"] 	= 5;
		$params["output"]	= "(/common/topic/description /common/topic/image)"; 
		$freebase->get($params);

		$result = $freebase->resultArray();

		/**
		TODO: better error management.
		*/
		if(!empty( $result["error"]) ){
			foreach($result["error"]["errors"] as $error){
				echo $error["message"] . "<br />";
			}
			die;
		}
		/* 
		TODO: fix this
		if(empty($topic_id)){
			$related_mids = array();
			foreach($result->result as $res){
				if(!empty($res->mid))
					$related_mids[] = $res->mid;
			}
		} else {
			$related_mids = array($topic_id);
		}*/

		
		$this->view_params["subject"] = $subject;
		$this->view_params["topics"]  = $result["result"];

		$this->layout = View::make( "newtopic.step2", $this->view_params );
	}


	


}
