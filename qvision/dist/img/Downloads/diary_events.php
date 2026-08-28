<?php


class Diary_event_class {
	
	private $db;
	
	public $title					= "";
	public $description				= "";
	public $starttime				= "";
	public $endtime					= "";
	
	
	public function __construct($db) {
		$this->db = $db;
  	}

    public function set($field, $value){
		$this->{$field} = $this->db->escape($value);
	}
	
	public function get($field){
		return $this->{$field};
	}

	public function create_event(){
		$title 				= $this->title;
		$description 		= $this->description;
		$starttime 			= $this->starttime;
		$endtime 			= $this->endtime;
		if($title!='' && $description!=""){
			$this->db->query("INSERT INTO `events`(`event_title`, `event_description`,`event_starttime`, `event_endtime`) VALUES ('$title', '$description', '$starttime', '$endtime')");
			return $this->db->getLastId();
		}
		else{
			return false;
		}
	}
	
	public function get_all_events(){
		$obj = $this->db->query("select * from `events`");
		$rows = $obj->rows;
		return json_decode(json_encode($rows));
	}
	
	
}

?>