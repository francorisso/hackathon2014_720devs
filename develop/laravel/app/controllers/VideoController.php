<?php

class VideoController extends \BaseController {

	protected $layout;

	private $google_api_key = "AIzaSyBUsuVB1YULi0Zmmjr4L0hCrDSrpBKzT-U";
	private $google_client;
	private $view_params = array();

	public function __construct(Google_Client $google_client){
		$this->google_client = $google_client;
		$this->google_client->setDeveloperKey( $this->google_api_key );
	}

	public function getDetails($video_id){
		$youtube_api = new YouTubeReader( $this->google_client );
		$video = $youtube_api->getById($video_id,'id,snippet,topicDetails');

		$topics = array();
		if(!empty($video["topicDetails"]["topicIds"])){
			$topics = $this->freebase_expandTags($video["topicDetails"]["topicIds"]);
		}
		if(!empty($video["topicDetails"]["relevantTopicIds"])){
			$topics = array_merge( $topics, $this->freebase_expandTags($video["topicDetails"]["relevantTopicIds"]) );
		}

		$this->view_params["video"] = $video;
		$this->view_params["topics"] = array_splice( $topics, 0, 4);

		$this->layout = View::make( "videos.details", $this->view_params );
	}

	private function freebase_expandTags( $topicIds ){
		$freebase = App::make("RESTreader");
		$freebase->set_endpoint( "https://www.googleapis.com/freebase/v1/search" );
		//get all the topics the user has selected
		$params = array(
			'query' 	=> "",
			'key' 		=> $this->google_api_key,
			'filter'  	=> "(any mid:" . implode(' mid:', $topicIds) . ")",
			'limit'		=> count($topicIds)
		);
		$freebase->get($params);
		$result = $freebase->resultArray();

		return $result["result"];
	}

}