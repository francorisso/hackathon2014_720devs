<?php

class TopicController extends \BaseController {

	protected $layout = 'layout.master';

	//Google API key
	private $google_api_key = "AIzaSyBUsuVB1YULi0Zmmjr4L0hCrDSrpBKzT-U";

	private $view_params = array();
	
	/**
	* First step is asking the user what he wants to learn
	*/
	public function getIndex()
	{
		$this->layout = View::make( "topic.step1", $this->view_params );
	}

	/***
	* In this step we refine the search with some help from the user
	*/
	public function postStep2(){
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
		$params["limit"] 	= 10;
		$params["output"]	= "(/common/topic/description /common/topic/image)"; 
		$freebase->get($params);

		$result = $freebase->resultArray();

		/**
		TODO: better error management.
		*/
		if(!empty( $result["error"]) ){
			$errors = "";
			foreach($result["error"]["errors"] as $error){
				$errors .= $error["message"] . "<br />";
			}
			trigger_error( $errors );
			return;
		}

		$this->view_params["subject"] = $subject;
		$this->view_params["topics"]  = $result["result"];

		$this->layout = View::make( "topic.step2", $this->view_params );
	}

	public function postStep3(){
		$subject = Input::get("subject");
		$topicIds = Input::get("topicId");

		$client = new Google_Client();
		$client->setDeveloperKey( $this->google_api_key );
		
		///get youtube videos
		$this->getYoutubeByTopic( $subject, $topicIds, $client );

		///get google books
		$this->getBooks( $topicIds );

		//set up some vars for the template
		$this->view_params["subject"] = $subject;

		$this->layout = View::make("topic.show", $this->view_params);
	}

	/**
	* Get youtube videos related to a list of topics from Freebase
	*/
	private function getYoutubeByTopic( $subject, $topicIds, Google_Client $client ){
		if(empty($topicIds)){
			return;
		}

		$youtube_api = new YouTubeReader($client);
		$videos = array();
		foreach($topicIds as $topicId){
			$params = array(
				'q' 			=> $subject,
				'topicId'		=> $topicId,
				'maxResults' 	=> 15,
				'type' 			=> 'video',
				'regionCode'	=> 'US'
			);
			$videos_aux = $youtube_api->getCourses($params);
			$videos = array_merge($videos, $videos_aux["items"]);
		}

		$this->view_params["videos"] = $videos;

	}

	/**
	* Get books from google books api, first it searches in freebase
	*/
	private function getBooks($topicIds){
		if(empty($topicIds)){
			return;
		}

		$freebase = App::make("RESTreader");
		$freebase->set_endpoint( "https://www.googleapis.com/freebase/v1/search" );
		//get all the topics the user has selected
		$params = array(
			'query' 	=> "",
			'key' 		=> $this->google_api_key,
			'filter'  	=> "(all type:/book/book subject:". implode(" subject:",$topicIds) .")",
			'limit'		=> 10
		);
		$freebase->get($params);
		$result = $freebase->resultArray();
		
		$this->view_params["books"] = $result["result"];
	}

}
