<?php
require '../../../connect.php';

$id = $_POST['id'];
$COMPANY_NAME = $_POST['name'];
$ADDRESS = $_POST['address'];
$EMAIL_ID = $_POST['email_id'];
$PHONE_NO = $_POST['phone_no'];
$GST_NO = $_POST['gst_no'];
$STATUS = $_POST['status'];

$sql = $con->query("
UPDATE company_master
SET
companyname='$COMPANY_NAME',
address='$ADDRESS',
email_id='$EMAIL_ID',
phone_no='$PHONE_NO',
gst_no='$GST_NO',
status='$STATUS'
WHERE id='$id'
");

if($sql){
    echo "1";
}else{
    echo mysqli_error($con);
}
?>