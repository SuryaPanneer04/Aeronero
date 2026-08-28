<?php
require '../../connect.php';

$aid=$_REQUEST['aid'];
$appraisal_recommend=$_REQUEST['appraisal_recommend'];
$fullappraisalremark=$_REQUEST['remark'];
$salary=$_REQUEST['salary'];	
$new_designation=$_REQUEST['new_designation'];
$appraisal_score=$_REQUEST['appraisal_score'];	
$overallmark=$_REQUEST['overallmark'];


$sql=$con->query("UPDATE `appraisal_details` SET `recommend_full_appraisal`='$appraisal_recommend',`remark`='$fullappraisalremark',`salary`='$salary',`new_designation`='$new_designation',`appraisal_point`='$appraisal_score',`overall_points`='$overallmark',`status`='0' where id='$aid'");

 echo "UPDATE `appraisal_details` SET `recommend_full_appraisal`='$appraisal_recommend',`remark`='$fullappraisalremark',`salary`='$salary',`new_designation`='$new_designation',`appraisal_point`='$appraisal_score',`overall_points`='$overallmark',`status`='0' where id='$aid'"; echo "<br>";
 
 $counts=$_REQUEST['counts'];
 
 for($i=0;$i<$counts;$i++)
{ 
 $question_id=implode($_REQUEST['qid'.$i]);
 $rate=implode($_REQUEST['rating'.$i]);

 $sql=$con->query("UPDATE `appraisal_rating` SET rating='$rate' WHERE id='$question_id'");
  echo "UPDATE `appraisal_rating` SET rating='$rate' WHERE id='$question_id'"; echo"<br>";
}
?>
