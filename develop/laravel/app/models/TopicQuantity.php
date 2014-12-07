<?php

/**
Simple class to get the topics sorted by the amount of appearences
*/
class TopicQuantity {
	private $topics = array();

	public function push($topic){
		$topics[ $topic ] = ( empty($topics[ $topic ])? 1 : $topics[ $topic ]+1);
	}

	public function get(){
		$topics_aux = $topics;
		arsort()
	}
}

?>