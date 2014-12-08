<?php

/**
Simple class to get the topics sorted by the amount of appearences
*/
class TopicFrecuency {
	private $topics = array();

	/**
	* Push the topic into the array
	* @param $topic can be array or single
	*/
	public function push($topic){
		if(is_array($topic)){
			foreach($topic as $topic_single){
				$this->push_single($topic_single);
			}
		} else {
			$this->push_single($topic);
		}
	}

	private function push_single($topic){
		$this->topics[ $topic ] = ( empty($this->topics[ $topic ])? 1 : $this->topics[ $topic ]+1);
	}

	/** 
	* Get the first $n topics 
	* @return $result[1...n] with $result[$i] = ( $topic => $frecuency )
	*/
	public function get( $n ){
		$topics_aux = $this->topics;
		arsort( $topics_aux );

		return array_slice( $topics_aux, 0, $n);
	}
}

?>