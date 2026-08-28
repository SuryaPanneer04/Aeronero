<?php
require '../../../connect.php';
Session_start();
$user_id=$_SESSION['userid'];

$old_date= $_REQUEST['date']; 
$date = $_REQUEST['leavedate'];
$datetime=new DateTime($date);
$mmmmm=$datetime->format('m');
$candid_id = $_REQUEST['candid_id'];
$remark = $_REQUEST['remark'];
$leavetype=$_REQUEST['leavetpy_get'];
$stmt = $con->prepare("SELECT COUNT(*) as count,status FROM daily_attendance where candid_id='$candid_id' and date='$date'");
	$stmt->execute(); 
     $row3 = $stmt->fetch();
	 $count=$row3['count'];
	 $att_sts=$row3['status']; 

//Status = 2 is attendance mark as absent.
//status = 3 is change status for remove absent (when by mistaken or wrong date mark as absent then update as present).

	 if($att_sts == 2){
		$u_status = 3;  // If already attendance marked but have to remove then status =3

	 } elseif($att_sts == 3){
		$u_status = 2; // if already data insert that date but status =3, we want to mark as absent then status =2. 
	 }
	 
$query1= $con->query("select * from staff_master where candid_id='$candid_id'"); 	 
	$query1->execute(); 
    $row1 = $query1->fetch();
	
	$emps_code=$row1['emp_code'];
	$prefix_code=$row1['prefix_code'];
	$emp_code=$emps_code;
	$emp_name=$row1['emp_name'];
	$month=date('m');
	$year=date('Y');
if($leavetype==1)
{

if($count==0)
	{	
    $status=2; //Daily Attendane INSERT status
  $insert_query = $con->query("insert into daily_attendance(candid_id,emp_code,emp_name,date,month,year,remark,status,created_by,created_on) values('$candid_id','$emp_code','$emp_name','$date','$mmmmm','$year','$remark','$status','$user_id',NOW())");  
}
else{
	//$u_status = 3; //Daily Attendane update status

	//$update_query = $con->query("UPDATE `Daily_attendence` SET `candid_id`='$candid_id',`emp_code`='$emp_code',`emp_name`='$emp_name',`date`='$date',`month`='$month',`year`='$year',`remark`='$remark',`status`='$u_status',`modified_on`= now(),`modified_by`='$user_id'  WHERE `candid_id`='$candid_id' && `date`='$date'");

	$update_query = $con->query("UPDATE `daily_attendance` SET  `remark`='$remark',`status`='$u_status',`modified_on`= now(),`modified_by`='$user_id'  WHERE `candid_id`='$candid_id' && `date`='$date'");
}
}
else if($leavetype==2)
{
	if($count==0)
	{	
    $status=2; //Daily Attendane INSERT status
  $insert_query = $con->query("insert into daily_attendance(candid_id,emp_code,emp_name,date,month,year,remark,status,halfday,created_by,created_on) values('$candid_id','$emp_code','$emp_name','$date','$mmmmm','$year','$remark','$status',1,'$user_id',NOW())");  
}
else{
	//$u_status = 3; //Daily Attendane update status

	//$update_query = $con->query("UPDATE `Daily_attendence` SET `candid_id`='$candid_id',`emp_code`='$emp_code',`emp_name`='$emp_name',`date`='$date',`month`='$month',`year`='$year',`remark`='$remark',`status`='$u_status',`modified_on`= now(),`modified_by`='$user_id'  WHERE `candid_id`='$candid_id' && `date`='$date'");

	$update_query = $con->query("UPDATE `daily_attendance` SET  `remark`='$remark',`status`='$u_status',`halfday`=0,`modified_on`= now(),`modified_by`='$user_id'  WHERE `candid_id`='$candid_id' && `date`='$date'");
}
}
?>






