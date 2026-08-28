<?php
require '../../connect.php';

 $employeeid = $_REQUEST['emp'];	
 $rejected = $_REQUEST['rejected'];	

 
 $sql=$con->query("UPDATE `appraisal_details` SET `status`='6',`md_reject__remark`='$rejected' where id='$employeeid'");

 echo "UPDATE `appraisal_details` SET `status`='6',`md_reject__remark`='$rejected' where id='$employeeid'";

 
?>