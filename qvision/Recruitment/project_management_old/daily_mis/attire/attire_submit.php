<?php
 require '../../../../../connect.php';
include("../../../../../user.php");
$user=$_SESSION['userid'];

/* if(isset($_POST['Department'])|| isset($_POST['Designation'])|| isset($_POST['Employee'])|| isset($_POST['yes'])|| isset($_POST['no'])|| isset($_POST['remark'])|| isset($_POST['yes1']) || isset($_POST['no'])|| isset($_POST['remark1'])|| isset($_POST['yes2']) || isset($_POST['no2']) || isset($_POST['remark2']) || isset($_POST['yes3'])  || isset($_POST['no3']) || isset($_POST['remark3']) || isset($_POST['yes4'])  || isset($_POST['no4']) || isset($_POST['remark4']) || isset($_POST['to_date'])  || isset($_POST['in']) || isset($_POST['out']))
{ */
//$date = $_REQUEST['date'];
$Department=$_REQUEST['Department'];
 $Designation=$_REQUEST['Designation'];
$Employee=$_REQUEST['Employee'];
$yes=$_REQUEST['yes'];
//$no=$_REQUEST['no'];
$remark=$_REQUEST['remark'];
$yes1=$_REQUEST['yes1'];
//$no1=$_REQUEST['no1'];
$remark1=$_REQUEST['remark1'];
$yes2=$_REQUEST['yes2'];
//$no2=$_REQUEST['no2'];
$remark2=$_REQUEST['remark2'];
$yes3=$_REQUEST['yes3'];
//$no3=$_REQUEST['no3'];
$remark3=$_REQUEST['remark3'];
$yes4=$_REQUEST['yes4'];
//$no4=$_REQUEST['no4'];
$remark4=$_REQUEST['remark4'];
$to_date=$_REQUEST['to_date'];
echo $in=$_REQUEST['in'];

echo $out=$_REQUEST['out'];



$sql11=$con->query("insert into attire_form(emp_no,dep_id,design_id,yes,remark,yes1,remark1,yes2,remark2,yes3,remark3,yes4,remark4,date,daily_in,daily_out,status,created_on) values('$Employee','$Department','$Designation','$yes','$remark','$yes1','$remark1','$yes2','$remark2','$yes3','$remark3','$yes4','$remark4','$to_date','$in','$out',1,now())"); 
echo "insert into attire_form(emp_no,dep_id,design_id,yes,remark,yes1,remark1,yes2,remark2,yes3,remark3,yes4,remark4,date,daily_in,daily_out,status,created_on) values('$Employee','$Department','$Designation','$yes','$remark','$yes1','$remark1','$yes2','$remark2','$yes3','$remark3','$yes4','$remark4','$to_date','$in','$out',1,now())";

//}
?>