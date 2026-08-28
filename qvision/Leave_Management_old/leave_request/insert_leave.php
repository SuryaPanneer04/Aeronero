<?php 
Session_start();
require '../../connect.php';
$user_id=$_SESSION['userid'];
if( isset($_POST['candids_id']) || isset($_POST['full_name']) || isset($_POST['leave_type']) || isset($_POST['lveapp'])|| isset($_POST['from_date']) || isset($_POST['to_date']) || isset($_POST['total_leave_count']) || isset($_POST['balance_leave']) || isset($_POST['reason']) || isset($_POST['uploadfile']) ) 

{	

$candids_id=$_POST['candids_id'];
$full_name=$_POST['full_name'];
$leave_type=$_POST['leave_type'];
$approve_date=$_POST['lveapp'];
$leave_count=$_POST['total_leave_count'];
$balance_leave=$_POST['balance_leave'];		
$stmtz = $con->prepare("SELECT prefix_code,emp_code,candid_id FROM staff_master where candid_id='$candids_id'");
$stmtz->execute(); 
$rowz = $stmtz->fetch();
$prefix_code=$rowz['prefix_code'];
$emply_code=$rowz['emp_code'];
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
if($leave_type==2){
	$from_date=$_POST['from_date'];
	$to_date=$_POST['to_date'];
	
	if($leave_count<=$balance_leave)
	{
		$sql=$con->query("insert into leave_apply_masters(candid_id,emp_code,emp_name, leave_type,req_date,leave_date, from_date, to_date,no_of_days,leave_reason,sick_doc, status,	created_by,	created_on) values('$candids_id','$emply_code','$full_name','$leave_type','$date','$from_date','$from_date','$to_date','$leave_count','$reason','$filename','1','$candids_id',NOW())");
	}
	elseif($leave_count>$balance_leave){
		$sql=$con->query("insert into leave_apply_masters(candid_id,emp_code,emp_name, leave_type,req_date,leave_date, from_date, to_date,no_of_days,leave_reason,sick_doc, status,	created_by,	created_on) values('$candids_id','$emply_code','$full_name','$leave_type','$date','$from_date','$from_date','$to_date','$balance_leave','$reason','$filename','1','$candids_id',NOW())");
		
		$no_of_day=$leave_count-$balance_leave;
		
		$sql=$con->query("insert into leave_apply_masters(candid_id,emp_code,emp_name, leave_type,req_date,leave_date, from_date, to_date,no_of_days,leave_reason,sick_doc, status,	created_by,	created_on) values('$candids_id','$emply_code','$full_name','4','$date','$from_date','$from_date','$to_date','$no_of_day','$reason','$filename','1','$candids_id',NOW())");
	}

}
elseif($leave_type==1 || $leave_type==3){
	
	$half_full=$_POST['half_full'];
	if($half_full==0.5){
		$from_date=$_POST['today_date'];
		$to_date=$_POST['today_date'];
		
		$sql=$con->query("insert into leave_apply_masters(candid_id,emp_code,emp_name, leave_type,req_date,leave_date, from_date, to_date,no_of_days,leave_reason,sick_doc, status,	created_by,	created_on) values('$candids_id','$emply_code','$full_name','$leave_type','$date','$from_date','$from_date','$to_date','$balance_leave','$reason','$filename','1','$candids_id',NOW())");
	}
	else{
		$from_date=$_POST['from_date'];
		$to_date=$_POST['to_date'];
		$sql=$con->query("insert into leave_apply_masters(candid_id,emp_code,emp_name, leave_type,req_date,leave_date, from_date, to_date,no_of_days,leave_reason,sick_doc, status,	created_by,	created_on) values('$candids_id','$emply_code','$full_name','$leave_type','$date','$from_date','$from_date','$to_date','$balance_leave','$reason','$filename','1','$candids_id',NOW())");
		
		$no_of_day=$leave_count-$balance_leave;
		
		$sql=$con->query("insert into leave_apply_masters(candid_id,emp_code,emp_name, leave_type,req_date,leave_date, from_date, to_date,no_of_days,leave_reason,sick_doc, status,	created_by,	created_on) values('$candids_id','$emply_code','$full_name','4','$date','$from_date','$from_date','$to_date','$no_of_day','$reason','$filename','1','$candids_id',NOW())");
		
	}
}
elseif($leave_type==4){
	$from_date=$_POST['from_date'];
		$to_date=$_POST['to_date'];
		
		$sql=$con->query("insert into leave_apply_masters(candid_id,emp_code,emp_name, leave_type,req_date,leave_date, from_date, to_date,no_of_days,leave_reason,sick_doc, status,	created_by,	created_on) values('$candids_id','$emply_code','$full_name','$leave_type','$date','$from_date','$from_date','$to_date','$leave_count','$reason','$filename','1','$candids_id',NOW())");
}
elseif($leave_type==5){
		$from_date=$_POST['from_date'];
		$to_date=$_POST['to_date'];
		$sql=$con->query("insert into leave_apply_masters(candid_id,emp_code,emp_name, leave_type,req_date,leave_date, from_date, to_date,no_of_days,leave_reason,sick_doc, status,	created_by,	created_on) values('$candids_id','$emply_code','$full_name','$leave_type','$date','$from_date','$from_date','$to_date','$balance_leave','$reason','$filename','1','$candids_id',NOW())");
		if($leave_count>1){
		$no_of_day=$leave_count-$balance_leave;
		
		$sql=$con->query("insert into leave_apply_masters(candid_id,emp_code,emp_name, leave_type,req_date,leave_date, from_date, to_date,no_of_days,leave_reason,sick_doc, status,	created_by,	created_on) values('$candids_id','$emply_code','$full_name','4','$date','$from_date','$from_date','$to_date','$no_of_day','$reason','$filename','1','$candids_id',NOW())");
		}
}
echo "0";
}else{
	
	echo"1";
}


?>
