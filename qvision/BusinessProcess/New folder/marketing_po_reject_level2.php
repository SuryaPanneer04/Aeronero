<?php 
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$qid=$_REQUEST['id'];
$remark=$_REQUEST['remark'];
$sel=$con->query("update po_generate set md_status='2',md_remarks='$remark',md_approved_by='$candidateid' where id='$qid'");
//echo "update po_generate set finance_status='2',finance_remarks='$remark',finance_approved_by='$candidateid' where id='$qid'";
if($sel)
{
	echo 1;
}
else
{
	echo 0;
}
?>