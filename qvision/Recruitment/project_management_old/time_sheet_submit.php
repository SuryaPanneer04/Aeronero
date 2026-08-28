<?php
require '../../../connect.php';
require '../../../user.php';

$user_id=$_SESSION['userid'];

if(isset($_POST['submit']))
{
	$id=$_POST['pro_id'];
	$one=$_POST['one1'];
	$two=$_POST['two2'];
	$three=$_POST['three3'];
	$four=$_POST['four4'];
	$five=$_POST['five5'];
	$six=$_POST['six6'];
	$seven=$_POST['seven7'];
	$eight=$_POST['eight8'];
	$nine=$_POST['nine9'];
	$over_time=$_POST['over_time10'];
	
	$date = date('Y-m=d');

	$stmt = $con->prepare("SELECT COUNT(*) as count FROM time_sheet where staff_id='$id' and date='$date'");
	echo "SELECT COUNT(*) as count FROM time_sheet where staff_id='$id' and date='$date'";
	//echo "SELECT COUNT(*) FROM time_sheet where staff_id='$id' and date='$date'";
	$stmt->execute(); 
     $row = $stmt->fetch();
	 $count=$row['count'];
echo $count;

if($count==0)
{
	$insert_sql=$con->query("insert into time_sheet(staff_id,date,one,two,three,four,five,six,seven,eight,nine,over_time,created_on) values('$id','$date','$one','$two','$three','$four','$five','$six','$seven','$eight','$nine','$over_time',NOW())");

echo "insert into time_sheet(staff_id,date,one,two,three,four,five,six,seven,eight,nine,over_time,created_on) values('$id','$date','$one','$two','$three','$four','$five','$six','$seven','$eight','$nine','$over_time',NOW())";

}else{
		
    $update_sql=$con->query("update time_sheet set one='$one',two='$two',three='$three',four='$four',five='$five',six='$six',seven='$seven',eight='$eight',nine='$nine',over_time='$over_time',modified_on=NOW() where staff_id='$id' and date='$date'");
	
	
}
	
	/* echo "update time_sheet set one='$one',two='$two',three='$three',four='$four',five='$five',six='$six',seven='$seven',eight='$eight',nine='$nine',over_time='$over_time',modified_on=NOW()"; */
	
	if($insert_sql)
{
	echo "<script>alert(' Updated Updated');</script>";
	header("location:qvision/index.php#");
}else{

header("location:qvision/index.php#");
}	
}?>