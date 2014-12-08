<?php

class TopicController extends \BaseController {

	protected $layout = 'layout.master';

	private $user_id = null;
	
	private $google_client;
	private $view_params = array();
	
	public function __construct(Google_Client $google_client){
		$this->user_id = Auth::id();
		$this->view_params["google_api_key"] = $this->google_api_key;

		$this->google_client = $google_client;
		$this->google_client->setDeveloperKey( $this->google_api_key );
	}

	public function getIndex(){
		if(!Input::ajax()){
			trigger_error("Invalid page.");
		}

		//get topics
		$topics = Topic::where(array("user_id"=>$this->user_id))
		->orderBy('name', 'asc')
		->get();

		foreach($topics as &$topic){
			$topic->permalink = url( '/topics/details/'.$topic->id );
		}

		return Response::json($topics);
	}

	/**
	* First step is asking the user what he wants to learn
	*/
	public function getAdd()
	{
		$this->layout = View::make( "topic.add", $this->view_params );
	}

	/***
	* In this step we refine the search with some help from the user
	*/
	public function postAdd(){
		$subject = Input::get("subject");
		$mid = Input::get("mid");
		if(empty($subject)){
			return Redirect::to('/');
		}

		$topic = Topic::where(array('topic_id'=>$mid, "user_id"=> ($this->user_id) ))->get();
		if(empty($topic) || empty($topic->id)){
			$topic = new Topic;
			$topic->topic_id 	= $mid;
			$topic->user_id		= $this->user_id;
			$topic->name		= $subject;
			
			$topic->save();
		}

		return Redirect::to( "/topics/details/".$topic->id );
	}

	public function getDetails( $topic_id ){
		$topic = Topic::find($topic_id);
		if(empty($topic)){
			return Redirect::to("/");
		}

		$mid = $topic->topic_id;
		$subject = $topic->name;

		$this->showListing($mid, $subject);
	}

	public function getPreview($mid_1, $mid_2){
		$mid = "/".$mid_1."/".$mid_2;
		$freebase = App::make("RESTreader");
		$freebase->set_endpoint( "https://www.googleapis.com/freebase/v1/search" );
		//get all the topics the user has selected
		$params = array(
			'query' 	=> "",
			'key' 		=> $this->google_api_key,
			'filter'  	=> "(all mid:".$mid.")",
			'limit'		=> 1
		);
		$freebase->get($params);
		$result = $freebase->resultArray();

		$topic = $result["result"][0];

		$this->showListing($mid, $topic["name"]);
	}
	
	/**
	HELPERS
	*/
	
	/**
	* Get the content for the show page.
	*/
	private function showListing($mid, $subject){
		/**
		YouTube videos
		*/
		//This will be the first videos to show, related directly to the topic
		//but searching for terms related to education
		$videos = $this->getFromYoutube( "learn|education|how to|tutorial|course", $mid );
		
		//Now I'll search for videos related to the search term 
		//related to education (/m/028xmlk) and hobbies (/m/05cglf6) topic.
		$videos = array_merge( $videos, $this->getFromYoutube( $subject, "/m/028xmlk") );
		$videos = array_merge( $videos, $this->getFromYoutube( $subject, "/m/05cglf6") ); 

		$this->view_params["videos"] = $videos;

		/**
		Books related to topic
		*/
		$this->getBooks( array($mid) );

		/**
		Films related to topic
		*/
		$this->getFilms( array($mid) );

		$this->view_params["subject"] = $subject;
		

		$this->layout = View::make( "topic.show", $this->view_params );
	}

	/**
	* Get youtube videos related to a topic from Freebase
	*/
	private function getFromYoutube( $search_term, $topicId ){
		if(empty($topicId)){
			return;
		}

		$youtube_api = new YouTubeReader( $this->google_client );

		//I search for videos related to the topic and bring all the topics of those videos
		//I search for learning resources
		$params = array(
			'q' 			=> $search_term,
			'topicId'		=> $topicId,
			'maxResults' 	=> 20,
			'type' 			=> 'video'
		);
		$videos = $youtube_api->search($params,'id,snippet,topicDetails');
		
		return ( empty( $videos["items"] )? array() : $videos["items"] );
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

	/**
	* Get books from google books api, first it searches in freebase
	*/
	private function getFilms($topicIds){
		if(empty($topicIds)){
			return;
		}

		$freebase = App::make("RESTreader");
		$freebase->set_endpoint( "https://www.googleapis.com/freebase/v1/search" );
		//get all the topics the user has selected
		$params = array(
			'query' 	=> "",
			'key' 		=> $this->google_api_key,
			'filter'  	=> "(all type:/film/film subject:". implode(" subject:",$topicIds) .")",
			'limit'		=> 10
		);
		$freebase->get($params);
		$result = $freebase->resultArray();
		
		$this->view_params["films"] = $result["result"];
	}

}
