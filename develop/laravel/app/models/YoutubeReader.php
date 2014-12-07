<?php

class YouTubeReader {

	private $google_client;
	
	function __construct(Google_Client $client){
		$this->google_client = $client;
	}

	public function getCourses( $params ){
		$result = $this->search( $params );

		return $result;
	}

	/**
	* Searches from Youtube
	* NOTE: I prefer to do one request to optional arguments for each video instead of one call by video
	* because the time execution AND the cost of the API call. 
	* So this generates a bit more of code to process all.
	* 
	* @param $q : keywords to search
	* @return list of videos
	*/
	private function search( $params ){
	    // Define an object that will be used to make all API requests.
	    $youtube = new Google_Service_YouTube( $this->google_client );
	    $htmlBody = null;
	    try {
	        // Call the search.list method to retrieve results matching the specified
	        // query term.
	        $result = $youtube->search->listSearch('id', $params);
	    } catch (Google_ServiceException $e) {
	        $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage()));

	        return null;
	    } catch (Google_Exception $e) {
	        $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage()));
	        
	        return null;
	    }

	    //Now I get the details for each video here
	    $video_ids = array();
	    foreach($result["items"] as $res){
	    	$video_ids[] 	= $res['id']['videoId'];
	    }

	    try {
	        $videos = $youtube->videos->listVideos('id,snippet,topicDetails', array(
		        'id' 			=> implode(',', array_values( $video_ids ))
	        ));
	        
	    } catch (Google_ServiceException $e) {
	        $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage()));

	        return null;
	    } catch (Google_Exception $e) {
	        $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage()));
	        
	        return null;
	    }
	    
	   	return $videos;
	}

}