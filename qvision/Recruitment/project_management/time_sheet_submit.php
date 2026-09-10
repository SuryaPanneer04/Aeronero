<?php
require '../../../connect.php';
require '../../../user.php';

$user_id=$_SESSION['userid'];

if(isset($_POST['submit']))
{
	$id=$_POST['pro_id'];
	$one=isset($_POST['one1']) ? addslashes($_POST['one1']) : '';
	$two=isset($_POST['two2']) ? addslashes($_POST['two2']) : '';
	$three=isset($_POST['three3']) ? addslashes($_POST['three3']) : '';
	$four=isset($_POST['four4']) ? addslashes($_POST['four4']) : '';
	$five=isset($_POST['five5']) ? addslashes($_POST['five5']) : '';
	$six=isset($_POST['six6']) ? addslashes($_POST['six6']) : '';
	$seven=isset($_POST['seven7']) ? addslashes($_POST['seven7']) : '';
	$eight=isset($_POST['eight8']) ? addslashes($_POST['eight8']) : '';
	$nine=isset($_POST['nine9']) ? addslashes($_POST['nine9']) : '';
    $ten=isset($_POST['ten10']) ? addslashes($_POST['ten10']) : '';
	$over_time=isset($_POST['over_time10']) ? addslashes($_POST['over_time10']) : '';

	$a_one=isset($_POST['a_one1']) ? addslashes($_POST['a_one1']) : '';
	$a_two=isset($_POST['a_two2']) ? addslashes($_POST['a_two2']) : '';
	$a_three=isset($_POST['a_three3']) ? addslashes($_POST['a_three3']) : '';
	$a_four=isset($_POST['a_four4']) ? addslashes($_POST['a_four4']) : '';
	$a_five=isset($_POST['a_five5']) ? addslashes($_POST['a_five5']) : '';
	$a_six=isset($_POST['a_six6']) ? addslashes($_POST['a_six6']) : '';
	$a_seven=isset($_POST['a_seven7']) ? addslashes($_POST['a_seven7']) : '';
	$a_eight=isset($_POST['a_eight8']) ? addslashes($_POST['a_eight8']) : '';
	$a_nine=isset($_POST['a_nine9']) ? addslashes($_POST['a_nine9']) : '';
    $a_ten=isset($_POST['a_ten10']) ? addslashes($_POST['a_ten10']) : '';
	$a_over_time=isset($_POST['a_over_time10']) ? addslashes($_POST['a_over_time10']) : '';
	
	$date = date('Y-m-d');

	$stmt = $con->prepare("SELECT COUNT(*) as count FROM time_sheet where staff_id='$id' and date='$date'");
	$stmt->execute(); 
    $row = $stmt->fetch();
	$count=$row['count'];
    
    $success = false;

    if($count==0)
    {
        try {
            $insert_sql=$con->query("insert into time_sheet(staff_id,date,one,two,three,four,five,six,seven,eight,nine,ten,over_time,a_one,a_two,a_three,a_four,a_five,a_six,a_seven,a_eight,a_nine,a_ten,a_over_time,created_on) values('$id','$date','$one','$two','$three','$four','$five','$six','$seven','$eight','$nine','$ten','$over_time','$a_one','$a_two','$a_three','$a_four','$a_five','$a_six','$a_seven','$a_eight','$a_nine','$a_ten','$a_over_time',NOW())");
            if ($insert_sql) {
                $success = true;
            } else {
                echo "<script>alert('Insert Error: " . addslashes(print_r($con->errorInfo(), true)) . "'); window.history.back();</script>";
                exit;
            }
        } catch(Exception $e) {
            echo "<script>alert('Insert Exception: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
            exit;
        }
    }else{
        try {
            $update_sql=$con->query("update time_sheet set one='$one',two='$two',three='$three',four='$four',five='$five',six='$six',seven='$seven',eight='$eight',nine='$nine',ten='$ten',over_time='$over_time',a_one='$a_one',a_two='$a_two',a_three='$a_three',a_four='$a_four',a_five='$a_five',a_six='$a_six',a_seven='$a_seven',a_eight='$a_eight',a_nine='$a_nine',a_ten='$a_ten',a_over_time='$a_over_time',modified_on=NOW() where staff_id='$id' and date='$date'");
            if ($update_sql) {
                $success = true;
            } else {
                echo "<script>alert('Update Error: " . addslashes(print_r($con->errorInfo(), true)) . "'); window.history.back();</script>";
                exit;
            }
        } catch (Exception $e) {
            echo "<script>alert('Update Exception: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
            exit;
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