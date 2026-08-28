<?php
require '../../../connect.php';

	$department=$_REQUEST['department'];
	//$division=$_REQUEST['division'];
	$designation=$_REQUEST['design'];
	$employeeName=$_REQUEST['employeeName'];
	$round=$_REQUEST['cid'];
	$question=$_REQUEST['question'];
	//$question_count=count($question);
   $status = 0;
	
	$sql=$con->query("INSERT INTO `appraisal_master`(`dep_name`,`dsgn_name`,`employee_id`,`person_id`,`status`) VALUES ('$department','$designation','$employeeName','$round','$status')");  
   
   echo "INSERT INTO `appraisal_master`(`dep_name`,`dsgn_name`,`employee_id`,`person_id`,`status`) VALUES ('$department','$designation','$employeeName','$round','$status')";
   
   /* echo "INSERT INTO `appraisal_master`(`dep_name`,`div_name`,`dsgn_name`,`round_id`) VALUES ('$department','$division','$designation','$round')"; */
	
   $maxid = $con->query("select max(id) as mid from appraisal_master");
   $max = $maxid->fetch();

   $appraisal_id = $max['mid'];
	
	
	for($i=0;$i<5;$i++)
    {
    $question_names= $question[$i];
   
   $sql2=$con->query("INSERT INTO `appraisal_question` (`dep_name`,`question`,`person_id`,`emp_id`,`status`,`appraisal_Master_id`) VALUES ('$department','$question_names','$round','$employeeName','$status','$appraisal_id')"); 
  
   echo "INSERT INTO `appraisal_question` (`dep_name`,`question`,`person_id`,`emp_id`,`status`,`appraisal_Master_id`) VALUES ('$department','$question_names','$round','$employeeName','$status','$appraisal_id')";
   echo "<br>";
   
   }
   
?>