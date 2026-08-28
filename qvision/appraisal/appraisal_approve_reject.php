<?php
require '../../connect.php';

 $employeeid=$_REQUEST['emp'];	
 $rejectremark=$_REQUEST['reject'];	
 $status = 2;
 
 $sql=$con->query("UPDATE `appraisal_details` SET `status`='$status',reject_remark='$rejectremark' where id='$employeeid'");

?>