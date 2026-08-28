<?php
require '../../connect.php';

    $userrole = $_REQUEST['userrole'];
	$department=$_REQUEST['department'];
	//$round=$_REQUEST['personid'];
	$employee=$_REQUEST['emp_name'];
	$from_date=$_REQUEST['from_date'];
	$to_date=$_REQUEST['to_date'];
	$person_id=$_REQUEST['personid'];
	$appraisal_recommend=$_REQUEST['appraisal_recommend']; 
	$remark=$_REQUEST['remark'];
	$salary=$_REQUEST['salary'];
	$appraisal_designation=$_REQUEST['new_designation'];
    $self_appraisal_point = $_REQUEST['points_get_self'];
    $appraisal_point = $_REQUEST['appraisal_score'];
    $overall = $_REQUEST['overallmark'];
    
	$status=0;
   

$sql=$con->query("INSERT INTO `appraisal_details`(`dep_name`, `emp_name`, `from_date`, `to_date`, `person_id`,`recommend_full_appraisal`, `remark`,`salary`,`new_designation`,`self_appraisal_point`,`appraisal_point`,`overall_points`,`status`,`hike`) VALUES ('$department','$employee','$from_date','$to_date','$person_id','$appraisal_recommend','$remark','$salary','$appraisal_designation','$self_appraisal_point','$appraisal_point','$overall','$status','$salary')"); 

echo "INSERT INTO `appraisal_details`(`dep_name`, `emp_name`, `from_date`, `to_date`, `person_id`,`recommend_full_appraisal`, `remark`,`salary`,`new_designation`,`self_appraisal_point`,`appraisal_point`,`overall_points`,`status`,`hike`) VALUES ('$department','$employee','$from_date','$to_date','$person_id','$appraisal_recommend','$remark','$salary','$appraisal_designation','$self_appraisal_point','$appraisal_point','$overall','$status','$salary')","<br>";

if($sql){
    $rate_count=$_REQUEST['count'];
   
 	for($i=0;$i<$rate_count;$i++)
    {
  $question_id=implode($_REQUEST['qid'.$i]);
  $rate=implode($_REQUEST['rating'.$i]);
	
   $sql2=$con->query("INSERT INTO `appraisal_rating` (`emp_name`,`persons_id`,`question_id`, `rating`,`from_date`,`to_date`) VALUES ('$employee','$person_id','$question_id','$rate','$from_date','$to_date')"); 

   //echo "INSERT INTO `appraisal_rating` (`emp_name`,`persons_id`,`question_id`, `rating`,`from_date`,`to_date`) VALUES ('$employee','$person_id','$question_id','$rate','$from_date','$to_date')","<br>";
   } 
}

if($sql && $sql2){
	echo "1";
}else{
	echo "0";
}
?>