<?php 
Session_start();
require '../../connect.php';
$user_id=$_SESSION['userid'];
if( isset($_POST['candids_id']) || isset($_POST['full_name']) || isset($_POST['leave_type']) || isset($_POST['lveapp'])|| isset($_POST['from_date']) || isset($_POST['to_date']) || isset($_POST['count']) || isset($_POST['balance_leave']) || isset($_POST['reason']) || isset($_POST['uploadfile']) ) 
{	

$candids_id=$_POST['candids_id'];
$full_name=$_POST['full_name'];
$leave_type=$_POST['leave_type'];
$count=$_POST['count'];
$approve_date=$_POST['lveapp'];
$balance_leave=$_POST['balance_leave'];
		
$stmtz = $con->prepare("SELECT prefix_code,emp_code,candid_id FROM staff_master where candid_id='$candids_id'");
$stmtz->execute(); 
$rowz = $stmtz->fetch();
$prefix_code=$rowz['prefix_code'];
$emply_code=$rowz['emp_code'];

if($leave_type==2){
	$from_date=$_POST['from_date'];
	$to_date=$_POST['to_date'];
	$date1=date_create("$from_date");
	$date2=date_create("$to_date");
	$diff=date_diff($date1,$date2);

// %a outputs the total number of days

	$no_of_dayss=$diff->format('%R%a');
	$no_days=explode("+",$no_of_dayss);
	$no_of_days=$no_days[1];
	
	$no_of_day=$no_of_days+1; //8
	 
	 $curn_month=date('m');
	 //echo$curn_month; 
	 $jan_month="1";
	 
	 $leaves_avails=$curn_month+$jan_month;

if($leave_avail>=$no_of_day)
{
	
$reason=$_POST['reason'];
$date=date('Y-m-d');
$filename = $_FILES["uploadfile"]["name"];
      $tempname = $_FILES["uploadfile"]["tmp_name"];    
     
	  $folder = "files/".$filename;
	  if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }
	
/* $sql=$con->query("insert into leave_apply_masters(candid_id,emp_code,emp_name, leave_type,req_date,leave_date, from_date, to_date,no_of_days,leave_reason,sick_doc, status,	created_by,	created_on) values('$candids_id','$emply_code','$full_name','$leave_type','$date','$from_date','$from_date','$to_date','$no_of_day','$reason','$filename','1','$candids_id',NOW())");
 */
/*  echo "insert into leave_apply_masters(candid_id,emp_code,emp_name, leave_type,req_date,leave_date, from_date, to_date,no_of_days,leave_reason,sick_doc, status,	created_by,	created_on) values('$candids_id','$emply_code','$full_name','$leave_type','$date','$from_date','$from_date','$to_date','$no_of_day','$reason','$filename','1','$candids_id',NOW())"; */ 
echo"0";
}
else{
	$half_full=$_POST['half_full'];
	if($half_full==0.5){
		$from_date=$_POST['today_date'];
		$to_date=$_POST['today_date'];
	}
	else{
		$from_date=$_POST['from_date'];
		$to_date=$_POST['to_date'];
	}
}
}else{
	
	echo"1";
}

}
?>
