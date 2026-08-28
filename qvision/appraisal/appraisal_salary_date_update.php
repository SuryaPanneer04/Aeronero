<?php
require '../../connect.php';

 //$employee=$_REQUEST['id'];	
 $employee=$_REQUEST['emp'];	
 $new_salary_date=$_REQUEST['date'];	
 $meetdate=$_REQUEST['meetdate'];	
 $recomend=$_REQUEST['recomend'];

 $status = 3;
 
 if($recomend ==''){

    $sql=$con->query("UPDATE `appraisal_details` SET `new_salary_start_date`='$new_salary_date',`status`='$status' where emp_name='$employee'");

   //  echo "UPDATE `appraisal_details` SET  `new_salary_start_date`='$new_salary_date',`status`='$status' where emp_name='$employee'","<br>"; 

 }else{
    $sql=$con->query("UPDATE `appraisal_details` SET `full_appraisal_meet_date`='$meetdate', `new_salary_start_date`='$new_salary_date',`status`='$status' where emp_name='$employee'");
 
   //  echo "UPDATE `appraisal_details` SET `full_appraisal_meet_date`='$meetdate', `new_salary_start_date`='$new_salary_date',`status`='$status' where emp_name='$employee'","<br>";
 }

?>