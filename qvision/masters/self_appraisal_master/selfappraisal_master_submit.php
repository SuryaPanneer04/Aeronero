<?php
require '../../../connect.php';

	$department=$_REQUEST['depid'];
	$round=$_REQUEST['cid'];
	$question=$_REQUEST['question_'];
	$status = 1;
	$sql=$con->query("INSERT INTO `self_appraisal_master`(`dep_name`,`person_id`,`status`) VALUES ('$department','$round','$status')");  
   
   echo "INSERT INTO `self_appraisal_master`(`dep_name`,`person_id`,`status`) VALUES ('$department','$round','$status')";

   $maxid = $con->query("select max(id) as mid from self_appraisal_master");
   $max = $maxid->fetch();

   $self_appraisal_id = $max['mid'];
$app=1;

	for($i=0;$i<5;$i++)
    {
    $question_names= $question[$i];
   
    $sql2=$con->query("INSERT INTO `self_appraisal_question` (`dep_name`,`question`,`person_id`,`self_appraisal_id`) VALUES ('$department','$question_names','$round','$self_appraisal_id')"); 
  
  echo "INSERT INTO `self_appraisal_question` (`dep_name`,`question`,`person_id`,`self_appraisal_id`) VALUES ('$department','$question_names','$round','$self_appraisal_id')";
  
   echo "<br>";
   
   }
   
?>