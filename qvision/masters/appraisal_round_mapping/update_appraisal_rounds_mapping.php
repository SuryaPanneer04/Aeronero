<?php
require '../../../connect.php';
?>
<?php

	$id=$_REQUEST['id'];
	$round_id=$_REQUEST['round_id'];
	$person_name=$_REQUEST['person_name'];
	$status=$_REQUEST['status'];
	
	$sql=$con->query("update appraisal_rounds_mapping set round_id='$round_id',person_name='$person_name',status='$status' where id='$id'");
	
	echo "update appraisal_rounds_mapping set round_id='$round_id',person_name='$person_name',status='$status' where id='$id'";

