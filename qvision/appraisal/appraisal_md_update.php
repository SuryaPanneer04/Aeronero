<?php
require '../../connect.php';

 $employee = $_REQUEST['emp'];	
 $salary = $_REQUEST['salary'];	
 $new_designation = $_REQUEST['new_designation'];	
 
 $sql=$con->query("UPDATE `appraisal_details` SET `salary`='$salary',`new_designation`='$new_designation',`status`=4 where emp_name='$employee'"); 
 
 echo "UPDATE `appraisal_details` SET `salary`='$salary',`new_designation`='$new_designation',`status`=4 where emp_name='$employee'";
  
?>
