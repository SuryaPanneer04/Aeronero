<?php
require '../../connect.php';
$uploadDir = 'uploads/';
if(isset($_POST['date']) || isset($_POST['Employee_name'])|| isset($_POST['get_id'])|| isset($_POST['traveltpyee'])|| isset($_POST['Customer_name'])|| isset($_POST['Location'])|| isset($_POST['Purpose'])|| isset($_POST['amount'])|| isset($_POST['kms'])|| isset($_POST['attachfile']))
{
 $id = $_REQUEST['get_id'];
$date = $_REQUEST['date'];
$Employee_name = $_REQUEST['Employee_name'];
$Customer_name = $_REQUEST['Customer_name'];
$travel = $_REQUEST['traveltpyee'];
$Location = $_REQUEST['Location'];
$Purpose = $_REQUEST['Purpose'];
//$Distance = $_REQUEST['distance'];
$Amount = $_REQUEST['amount'];
$kms = $_REQUEST['kms'];
$filesArr3 = $_FILES['attachfile'];


$stmt = $con->prepare("SELECT file FROM claim_request WHERE id='$id'");
 
$stmt->execute();
$row = $stmt->fetch();

$status =1;


$sql=$con->query("Update claim_request set kms='$kms',amount='$Amount' where id='$id'");

}
?>



