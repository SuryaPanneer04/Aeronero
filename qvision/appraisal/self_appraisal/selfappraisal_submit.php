<?php
require '../../../connect.php';

	$person=$_REQUEST['personid'];
	$employee=$_REQUEST['emp_no'];
	$self_app_id=$_REQUEST['self_appraisalMaster_id'];
	$status=0;
      
    $rate_count=$_REQUEST['count'];
    $rating_count=$_REQUEST['rating_count'];
	
    $stmt = $con->query("SELECT COUNT(*) as count FROM self_appraisal_rating where emp_name='$employee' && self_appraisalMaster_id= '$self_app_id'");
    $row = $stmt->fetch();
	$count=$row['count'];
  if($count==0)
 {  
 	for($i=0;$i<$rate_count;$i++)
    {
  $question_id=implode($_REQUEST['qid'.$i]);
  $rate=implode($_REQUEST['rating'.$i]);
	
   $sql2=$con->query("INSERT INTO `self_appraisal_rating` (`emp_name`,`candid_id`,`question_id`, `rating`,`self_appraisalMaster_id`) VALUES ('$employee','$person','$question_id','$rate','$self_app_id')"); 
   echo "INSERT INTO `self_appraisal_rating` (`emp_name`,`candid_id`,`question_id`, `rating`,`self_appraisalMaster_id`) VALUES ('$employee','$person','$question_id','$rate','$self_app_id')";
   } 
   
 }else{
	
	for($i=0;$i<$rating_count;$i++)
    {
    $rating_id=implode($_REQUEST['sid'.$i]);
    $rate=implode($_REQUEST['rating'.$i]);
    $question_id=implode($_REQUEST['qid'.$i]);
	
    if($rating_id){

    $sql2=$con->query("UPDATE `self_appraisal_rating` SET  `rating`='$rate' where `id`='$rating_id'"); 

    echo "UPDATE `self_appraisal_rating` SET  `rating`='$rate' where `id`='$rating_id'";

   } else{
    $sql2=$con->query("INSERT INTO `self_appraisal_rating` (`emp_name`,`candid_id`,`question_id`, `rating`,`self_appraisalMaster_id`) VALUES ('$employee','$person','$question_id','$rate','$self_app_id')"); 
    echo "INSERT INTO `self_appraisal_rating` (`emp_name`,`candid_id`,`question_id`, `rating`,`self_appraisalMaster_id`) VALUES ('$employee','$person','$question_id','$rate','$self_app_id')";

   }
  }
 }
 
if($sql2){
	echo "1";
}else{
	echo "0";
}
?>