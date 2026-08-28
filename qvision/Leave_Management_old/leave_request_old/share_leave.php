<?php 
require '../../connect.php';
//include("../../user.php");
$value=$_REQUEST['back'];

$candid_id=$_REQUEST['candid_id'];
$balance=1;
if($value==2)
{

$stmt1 = $con->query("select * from leave_masters where candid_id='$candid_id' and leave_type='$value'");
$row = $stmt1->fetch();	
$created=$row2['created_on'];
	$pls_from=$row['pl_from'];
	$from = date("d-m-Y", strtotime($pls_from));	
	
	/* $exp=date('Y-m', strtotime( '$created' ) );
	echo $exp;
	$current=date('Y-m');
	
	if($exp==$current)
	{
	$total_leave=$row['total_leave'];
	$balance_leave=$row['balance_leave'];
	}else
	{
	$total_leave="1";
	$balance_leave="1";	
	} */

	$total_leave=$row['total_leave'];
	$balance_leave=$row['balance_leave'];

}elseif($value==3)
{
	
	$stmt = $con->prepare("SELECT COUNT(*) as count,candid_id,leave_type,modified_on FROM leave_masters where candid_id='$candid_id' and leave_type='$value' and modified_on!=''");
	
	//echo "SELECT COUNT(*) as count,candid_id,leave_type,modified_on FROM leave_masters where candid_id='$candid_id' and leave_type='$value' and modified_on!=''";
	
	$stmt->execute(); 
     $row3 = $stmt->fetch();
	 $count=$row3['count'];
 
	 if($count!=0)
{
	 $modified_on=$row3['modified_on'];
	 $modified=date('Y-m', strtotime( "$modified_on" ) );
	 $current=date('Y-m');

	 if($modified==$current)
	 {
		$stmt1 = $con->query("select * from leave_masters where candid_id='$candid_id' and leave_type='$value'");
		$row = $stmt1->fetch();	 
		$pls_from=$row['cl_from'];
	    $from = date("d-m-Y", strtotime($pls_from));
		$total_leave=$row['total_leave'];
		$balance_leave=$row['balance_leave'];
	 }else
	 {
		$stmt1 = $con->query("select * from leave_masters where candid_id='$candid_id' and leave_type='$value'");
		$row = $stmt1->fetch();	 
		$pls_from=$row['cl_from'];
	    $from = date("d-m-Y", strtotime($pls_from));
		
		$total_leave="1";
		$balance_leave="1"; 
	 }
	 
}else
	 {
		$stmt1 = $con->query("select * from leave_masters where candid_id='$candid_id' and leave_type='$value'");
		$row = $stmt1->fetch();	 
		$pls_from=$row['cl_from'];
	    $from = date("d-m-Y", strtotime($pls_from));
		
		$total_leave="1";
		$balance_leave="1"; 
	 }	 	
}elseif($value==1 or 4)
{
$stmt1 = $con->query("select * from leave_masters where candid_id='$candid_id' and leave_type='$value'");

//echo "select * from leave_masters where candid_id='$candid_id' and leave_type='$value'";
$row = $stmt1->fetch();	

	$from=date('d-m-Y');
	$total_leave=$row['total_leave'];
	$balance_leave=$row['balance_leave'];
}
echo $balance.','.$balance_leave.','.$total_leave.','.$from;
?>