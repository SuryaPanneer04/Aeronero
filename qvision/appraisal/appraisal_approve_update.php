<?php
require '../../connect.php';

 $employeeid = $_REQUEST['emp'];	
 $status = 1;
 
 $sql=$con->query("UPDATE `appraisal_details` SET `status`='$status' where id='$employeeid'"); 

 if($sql){
    echo 1;
 } else{
    echo 0;
 }
?>
