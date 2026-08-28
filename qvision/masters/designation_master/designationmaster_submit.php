<?php
require '../../../connect.php';

$department=$_REQUEST['department'];
	$designation_name=$_REQUEST['designation_name'];
	$status=$_REQUEST['status'];
	$userrole=$_REQUEST['userrole'];
	$sql=$con->query("insert into designation_master(dep_id,designation_name,status,created_by,created_on,modified_by,modified_on)values('$department','$designation_name','$status','2',now(),'2',now())");
    $sql1=$con->query("insert into jobdescription_master(`id`, `tittle`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`)values(NULL,'$designation_name','$status','2',now(),now(),NULL)");
	//echo "insert into jobdescription_master(`id`, `tittle`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`)values(NULL,'$designation_name','$status','2',now(),now(),NULL)";
	/* echo "insert into designation_master(dep_id,designation_name,status,created_by,created_on,modified_by,modified_on)values('$department','$designation_name','$status','2',now(),'2',now())"; */
if($sql!='' && $sql1!='')
{
	echo "1";
	
}

?>