<?php
require '../../connect.php';

 $employeeid = $_REQUEST['emp'];	
 $hike = $_REQUEST['hike'];	

 //$sql=$con->query("UPDATE `appraisal_details` SET `status`='5' where id='$employeeid'"); 
 $sql=$con->query("UPDATE `appraisal_details` SET `salary`= '$hike', `status`='5' where id='$employeeid'"); 

?>