<?php
require '../../../connect.php';
	
$count=$_REQUEST['count'];
$count_name_count= count($count);

for($i=0;$i<$count_name_count;$i++)
{ 
 $get_id=$_REQUEST['get_id'.$i];
 $question_names= $_REQUEST['question'.$i];

 $sql=$con->query("update self_appraisal_question set question='$question_names' where id='$get_id'");
  echo "update self_appraisal_question set question='$question_names' where id='$get_id'";
}
?>
