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
$created=$row['created_on'];
	$pls_from=$row['el_from'];
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
	
	$leave=$con->query("select count(*) as cnt from leave_apply_masters where candid_id='$candid_id' and leave_type='2'");
	$leavee=$leave->fetch();
	$leaves=$leavee['cnt'];
	$join=$con->query("select joining_date from candidate_form_details where id='$candid_id'");
	$joining=$join->fetch();
	$join_date=$joining['joining_date'];
	$leave_applicable = date('Y-m-d', strtotime("+8 months", strtotime($join_date)));
	$date=date('Y-m-d');
	$ts1 = strtotime($leave_applicable);
	$ts2 = strtotime($date);

	$year1 = date('Y', $ts1);
	$year2 = date('Y', $ts2);

	$month1 = date('m', $ts1);
	$month2 = date('m', $ts2);
	$interval = (($year2 - $year1) * 12) + ($month2 - $month1);
	
	if($leaves==0){
		
		$balance_leave=$interval;
	}
	elseif($leaves<$inteval){
		
		$balance_leave=$interval-$leaves;
	}
	elseif($leaves>=$interval){
		$balance_leave=0;
	}
	$total_leave=$row['total_leave'];
	

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
		
		$total_leave="0.5";
		$balance_leave="0.5"; 
	 }
	 
}else
	 {
		$stmt1 = $con->query("select * from leave_masters where candid_id='$candid_id' and leave_type='$value'");
		$row = $stmt1->fetch();	 
		$pls_from=$row['cl_from'];
	    $from = date("d-m-Y", strtotime($pls_from));
		
		$total_leave="0.5";
		$balance_leave="0.5"; 
	 }	 	
}elseif($value==1)
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
		
		$total_leave="0.5";
		$balance_leave="0.5"; 
	 }
	 
}else
	 {
		$stmt1 = $con->query("select * from leave_masters where candid_id='$candid_id' and leave_type='$value'");
		$row = $stmt1->fetch();	 
		$pls_from=$row['cl_from'];
	    $from = date("d-m-Y", strtotime($pls_from));
		
		$total_leave="0.5";
		$balance_leave="0.5"; 
	 }	
}
elseif($value==5)
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
	
	
	
}

echo $balance.','.$balance_leave.','.$total_leave.','.$from;
?>