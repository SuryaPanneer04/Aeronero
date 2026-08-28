<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$round_id=$_REQUEST['round_id'];
	$person_name=$_REQUEST['person_name'];
	$status=$_REQUEST['status'];
	
	$sql=$con->query("insert into appraisal_rounds_mapping(round_id,person_name,status,created_on,modified_on)values('$round_id','$person_name','$status',now(),now())");
	
	echo "insert into appraisal_rounds_mapping(round_id,person_name,status,created_on,modified_on)values('$round_id','$person_name','$status',now(),now())";
	
if($sql)
{
	echo "<script>alert('Inserted Updated');</script>";
	header("location:/qvisionnew/index.php");
}
}
?>