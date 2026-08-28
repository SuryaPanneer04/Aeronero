<?php
require '../../connect.php';
Session_start();
 $candid_id = $_REQUEST['status'];
$user_id=$_SESSION['userid'];
$date=date('m-d-Y');
$stmt = $con->prepare("SELECT COUNT(*) as count FROM daily_attendence where candid_id='$candid_id' and date='$date'");	
	$stmt->execute(); 
     $row3 = $stmt->fetch();
	 $count=$row3['count'];
    	 if($count==0)
{
	 
$query1= $con->query("select * from staff_master where candid_id='$candid_id'"); 

		//echo "select * from staff_master where candid_id='$candid_id'";		 
	$query1->execute(); 
    $row1 = $query1->fetch();
	
	
	$candid_id=$row1['candid_id'];
	$emps_code=$row1['emp_code'];
	$emp_code=$row1['prefix_code'];
	$emp_name=$row1['emp_name'];

	
	$date=date('d-m-Y');
	$month=date('m');
	$year=date('Y');
    $status=2;
  $insert_query = $con->query("insert into daily_attendence(candid_id,emp_code,emp_name,date,month,year,status,created_by,created_on) values('$candid_id','$emp_code','$emp_name','$date','$month','$year','$status','$user_id',NOW())");  
  
/* echo "insert into daily_attendence(candid_id,emp_code,emp_name,date,month,year,status,created_by,created_on) values('$candid_id','$emp_code','$emp_name','$date','$month','$status','$user_id',NOW())"; */
}else{
	
}
?>






