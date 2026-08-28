<?php
require '../../../connect.php';

	$round_id=$_REQUEST['round_id'];
	$person_name=$_REQUEST['person_name'];
	$status=$_REQUEST['status'];
	$sql=$con->query("insert into interview_rounds_mapping(round_id,person_name,status,created_on,modified_on)values('$round_id','$person_name','$status',now(),now())");
	
	echo "insert into interview_rounds_mapping(round_id,person_name,status,created_on,modified_on)values('$round_id','$person_name','$status',now(),now())";
?>