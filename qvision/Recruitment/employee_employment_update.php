<?php
require '../../connect.php';

$candidateid=$_REQUEST['cid'];
$conformexp=$_REQUEST['conformexp'];

$sql=$con->query("insert into `emp_exp_detail`(`emp_id`, `organization_name`, `designation`, `from_date`, `to_date`, `total_experience`,`created_by`,`status`)  values('$candidateid',null,null,null,null,'$conformexp','$candidateid','1')");

$ins=$con->query("update candidate_form_details set status='20' where id='$candidateid'");


if($ins)
{
	echo 1;
}
else
{
	echo 0;
}
?>