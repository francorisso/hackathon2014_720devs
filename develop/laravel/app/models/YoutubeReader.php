<?php

class YouTubeReader {

	private $google_client;
	
	function __construct(Google_Client $client){
		$this->google_client = $client;
	}

	/**
	* Searches a video for video ID
	*/
	public function getById( $id, $parts ){
		// Define an object that will be used to make all API requests.
	    $youtube = new Google_Service_YouTube( $this->google_client );
		try {
	        $videos = $youtube->videos->listVideos($parts, array(
		        'id' => (is_array($id)? implode(',',$id) : $id)
	        ));
	    } catch (Google_ServiceException $e) {
	        trigger_error(sprintf('<p>A service error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage())));
	        return null;
	    } catch (Google_Exception $e) {
	        trigger_error(sprintf('<p>An client error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage())));
	        
	        return null;
	    }
	    
	    if(is_array($id)){
	    	return ( empty($videos["items"])? null : $videos["items"]);
	    } else {
	   		return ( empty($videos["items"])? null : $videos["items"][0]);
	   	}
	}

	/**
	* Searches from Youtube
	* @return list of videos
	*/
	public function search( $params, $parts ){
	    // Define an object that will be used to make all API requests.
	    $youtube = new Google_Service_YouTube( $this->google_client );
	    try {
	        // Call the search.list method to retrieve results matching the specified
	        // query term.
	        $result = $youtube->search->listSearch('id', $params);
	    } catch (Google_ServiceException $e) {
	        trigger_error(sprintf('<p>A service error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage())));
	        return null;
	    } catch (Google_Exception $e) {
	        trigger_error(sprintf('<p>An client error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage())));
	        return null;
	    }

	    //Now I get the details for each video here
	    $video_ids = array();
	    foreach($result["items"] as $res){
	    	$video_ids[] 	= $res['id']['videoId'];
	    }

	    try {
	        $videos = $youtube->videos->listVideos($parts, array(
		        'id' 			=> implode(',', array_values( $video_ids ))
	        ));
	        
	    } catch (Google_ServiceException $e) {
	        trigger_error(sprintf('<p>A service error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage())));
	        return null;
	    } catch (Google_Exception $e) {
	        trigger_error(sprintf('<p>An client error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage())));
	        return null;
	    }
	    
	   	return $videos;
	}

}