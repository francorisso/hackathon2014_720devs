<?php

class BoardController extends \BaseController {

	protected $layout;

	private $google_api_key = "AIzaSyBUsuVB1YULi0Zmmjr4L0hCrDSrpBKzT-U";
	private $google_client;
	private $view_params = array();
	private $user_id;

	public function __construct(Google_Client $google_client){
		$this->google_client = $google_client;
		$this->google_client->setDeveloperKey( $this->google_api_key );
		$this->user_id = Auth::id();
	}

	public function getAdd( $videoId ){
		$boards = Board::where(array("user_id"=>$this->user_id))
		->orderBy('name', 'asc')
		->get();

		$this->view_params["videoId"] = $videoId;
		$this->view_params["boards"] = $boards;

		$this->layout = View::make( "boards.add", $this->view_params );
	}

	public function postAdd(){
		$videoId = Input::get("videoId");
		$name = Input::get("name");

		if(empty($videoId) || empty($name)){
			return Redirect::to("/boards/done");
		}

		$board = new Board;
		$board->user_id = $this->user_id;
		$board->name = $name;
		$board->save();

		$this->board_addVideo( $board->id, $videoId );

		return Redirect::to("/boards/done");
	}

	/**
	* Add a video to a board using an ajax request
	*/
	public function postAddVideo(){
		if(!Input::ajax()){
			trigger_error("Invalid page.");
		}

		$videoId = Input::get("videoId");
		$boardId = Input::get("boardId");

		if(empty($videoId) || empty($boardId)){
			return Redirect::to("/boards/done");
		}

		$this->board_addVideo( $boardId, $videoId );

		return Response::json(array("res"=>1));
	}

	public function getDone(){
		$this->layout = View::make( "boards.done" );
	}

	public function getIndex(){
		if(!Input::ajax()){
			trigger_error("Invalid page.");
		}

		$boards = Board::where(array("user_id"=>$this->user_id))
		->orderBy('name', 'asc')
		->get();

		foreach($boards as &$board){
			$board->permalink = url( '/boards/details/'.$board->id );
		}

		return Response::json($boards);
	}

	public function getDetails($boardId){
		$board = Board::find($boardId);

		$board_videos = BoardVideos::where( array('board_id'=>$boardId) )->get();
		$videosIds = array();
		foreach( $board_videos as $video ){
			$videoIds[] = $video->video_id;
		}
		$youtube_api = new YouTubeReader( $this->google_client );
		$videos = $youtube_api->getById($videoIds,'id,snippet,topicDetails');
		
		$this->view_params["videos"] = $videos;
		$this->view_params["subject"] = $board->name;

		$this->layout = View::make( "topic.show", $this->view_params );
	}

	/**
	Helpers
	*/
	private function board_addVideo($boardId, $videoId){
		$boardVideo = new BoardVideos;
		$boardVideo->board_id = $boardId;
		$boardVideo->video_id = $videoId;
		$boardVideo->save();
	}

}