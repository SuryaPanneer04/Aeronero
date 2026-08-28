<?php 
Session_start();
require '../../connect.php';
$user_id=$_SESSION['userid'];
if( isset($_POST['emp_name']) || isset($_POST['doj']) || isset($_POST['leave_type']) || isset($_POST['candid_id']) ) 

{
$org_type   = $_POST['emp_name'];
$str_arr = preg_split ("/\-/", $org_type); 
$emp_name   =$str_arr[1];
$doj=$_POST['doj'];
$dojs = date("Y-m-d", strtotime($doj));

$leave_type=$_POST['leave_type'];

$candid_id=$_POST['candid_id'];

$time = strtotime("$dojs");

$curnt_date=date("Y-m-d");
$cl_from = date("Y-m-d", strtotime("+1 month", $time));
 
$pl_from = date("Y-m-d", strtotime("+6 month", $time));
$pl_year = date('y', strtotime($pl_from));

$pl_month =date('m', strtotime($pl_from));
$yearstrt = date('Y-m-d', strtotime('1/1'));
$yearEnd = date('Y-m-d', strtotime('12/31'));
$year_month =date('m', strtotime($yearEnd));
$cur_year_end = date('y', strtotime($yearEnd));

$new_yr_last_date = date("Y-m-d",strtotime ( '+1 year' , strtotime ($yearEnd) )) ;

if($leave_type==2)
{
	if($pl_year==$cur_year_end)
	{		
	  $datetime1 = date_create("$pl_from");
	  $datetime2 = date_create("$yearEnd");
	  $interval = date_diff($datetime1, $datetime2);
	  $leave_balance=$interval->format('%m');		
	}elseif($pl_year<$cur_year_end)
	{		
	  $datetime1 = date_create("$yearstrt");
	  $datetime2 = date_create("$yearEnd");
	  $interval = date_diff($datetime1, $datetime2);
	  $leave_balances=$interval->format('%m');
      $leave_balance=$leave_balances+1;  
	}elseif($pl_year>$cur_year_end)
	{
	  $datetime1 = date_create("$pl_from");
	  $datetime2 = date_create("$new_yr_last_date");
	  $interval = date_diff($datetime1, $datetime2);
	  $leave_balances=$interval->format('%m');
	  $leave_balance=$leave_balances+1;
	}else{
	  $leave_balance="0";	
	}
}elseif($leave_type==3){

		$leave_balance="1";
}elseif($leave_type==4){

		$leave_balance="0";
}elseif($leave_type==1){

		$leave_balance="0";
}
	

$stmt = $con->prepare("SELECT COUNT(*) as count FROM leave_masters where candid_id='$candid_id' and leave_type='$leave_type'");

	$stmt->execute(); 
     $row = $stmt->fetch();
	 $count=$row['count'];
echo"-";
if($count==0)
{	

$insert_sql=$con->query("insert into leave_masters (candid_id,emp_name,doj,cl_from,pl_from,leave_type,total_leave,balance_leave,status,created_by,created_on) values ('$candid_id','$emp_name','$dojs','$cl_from','$pl_from','$leave_type','$leave_balance','$leave_balance','1','$user_id',NOW())");

 /* echo "insert into leave_masters (candid_id,emp_name,doj,cl_from,pl_from,leave_type,total_leave,balance_leave,status,created_by,created_on) values ('$candid_id','$emp_name','$dojs','$cl_from','$pl_from','$leave_type','$leave_balance','$leave_balance','1','$user_id',NOW())"; */
}else
{

echo "1";
}
}
?>