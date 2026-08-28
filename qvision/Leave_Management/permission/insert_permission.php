<?php 
Session_start();
require '../../../connect.php';
$user_id=$_SESSION['userid'];
if( isset($_POST['candids_id']) || isset($_POST['full_name']) || isset($_POST['time']) || isset($_POST['time1'])|| isset($_POST['from_date']) || isset($_POST['to_date']) || isset($_POST['reason']) || isset($_POST['uploadfile']) ) 

{	


$candids_id=$_POST['candids_id'];
$full_name=$_POST['full_name'];
$per_datz=$_POST['from_date'];
$per_date=date('Ymd',strtotime($per_datz));

$date=date('Ymd');
$per_from=$_POST['time'];
$per_to=$_POST['time1'];
$from_date=$_POST['from_date'];
$to_date=$_POST['from_date'];;
$hrs_count="2";
$reason=$_POST['reason'];


if($date<=$per_date)
{

$filename = $_FILES["uploadfile"]["name"];
      $tempname = $_FILES["uploadfile"]["tmp_name"];    
     
	  $folder = "files/".$filename;
	  if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }
	
$sql=$con->query("INSERT INTO permission_apply (candid_id, per_from, per_to, per_date, reason, file_name, status, created_by, created_on) VALUES ('$candids_id', '$per_from', '$per_to', '$per_date', '$reason', '$filename', '1', '$candids_id', NOW())");


//echo "insert into permission_apply(candid_id,per_from,per_to,per_date,reason,file_name,status,created_by,created_on) values('$candids_id','$per_from','$per_to','$per_date','$reason','$file_name','1','$candids_id',NOW())";


/*  echo "insert into leave_apply_masters(candid_id,emp_code,emp_name, leave_type,req_date,leave_date, from_date, to_date,no_of_days,leave_reason,sick_doc, status,	created_by,	created_on) values('$candids_id','$emply_code','$full_name','$leave_type','$date','$from_date','$from_date','$to_date','$no_of_day','$reason','$filename','1','$candids_id',NOW())"; */ 
echo"0";
}else{
	
	echo"1";
}

}
?>
