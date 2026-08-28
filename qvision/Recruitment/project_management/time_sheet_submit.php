<?php
require '../../../connect.php';
require '../../../user.php';

$user_id=$_SESSION['userid'];

if(isset($_POST['submit']))
{
	$id=$_POST['pro_id'];
	$one=addslashes($_POST['one1']);
	$two=addslashes($_POST['two2']);
	$three=addslashes($_POST['three3']);
	$four=addslashes($_POST['four4']);
	$five=addslashes($_POST['five5']);
	$six=addslashes($_POST['six6']);
	$seven=addslashes($_POST['seven7']);
	$eight=addslashes($_POST['eight8']);
	$nine=addslashes($_POST['nine9']);
	$over_time=addslashes($_POST['over_time10']);
	
	$date = date('Y-m-d');

	$stmt = $con->prepare("SELECT COUNT(*) as count FROM time_sheet where staff_id='$id' and date='$date'");
	$stmt->execute(); 
    $row = $stmt->fetch();
	$count=$row['count'];
    
    $success = false;

    if($count==0)
    {
        $insert_sql=$con->query("insert into time_sheet(staff_id,date,one,two,three,four,five,six,seven,eight,nine,over_time,created_on) values('$id','$date','$one','$two','$three','$four','$five','$six','$seven','$eight','$nine','$over_time',NOW())");
        if ($insert_sql) {
            $success = true;
        }
    }else{
        $update_sql=$con->query("update time_sheet set one='$one',two='$two',three='$three',four='$four',five='$five',six='$six',seven='$seven',eight='$eight',nine='$nine',over_time='$over_time',modified_on=NOW() where staff_id='$id' and date='$date'");
        if ($update_sql) {
            $success = true;
        }
    }
	
	if($success)
    {
        // Using session or JS redirect would be better if we want to show an alert, 
        // but for now let's just make the redirection work without errors.
        echo "<script>alert('Time Sheet Updated Successfully'); window.location.href='../../../index.php';</script>";
        exit;
    }else{
        header("location:../../../index.php");
        exit;
    }	
}
?>