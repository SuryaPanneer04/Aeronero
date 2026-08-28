<?php
require '../../../connect.php';
	
$lineid=$_REQUEST['id'];
$count=$_REQUEST['count'];
$count_name_count= count($count);

$update =$con->query("update appraisal_master set status= 0 where id='$lineid'");


for($i=0;$i<$count_name_count;$i++)
{ 
 $get_id=$_REQUEST['get_id'.$i];
 $question_names= $_REQUEST['question'.$i];

 $sql=$con->query("update appraisal_question set question='$question_names', status= 0 where id='$get_id'");
  echo "update appraisal_question set question='$question_names', status= 0 where id='$get_id'";
}
?>
