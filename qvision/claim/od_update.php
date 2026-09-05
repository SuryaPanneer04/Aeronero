<?php
require '../../connect.php';
$uploadDir = 'uploads/';
if(isset($_POST['get_id']))
{
 $id = $_REQUEST['get_id'];
$travel = isset($_REQUEST['traveltpyee']) ? $_REQUEST['traveltpyee'] : '';
$Location = isset($_REQUEST['Location']) ? $_REQUEST['Location'] : '';
$Purpose = isset($_REQUEST['Purpose']) ? $_REQUEST['Purpose'] : '';
$Amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : '';

$sql=$con->query("UPDATE claim_request SET amount='$Amount', travel_type='$travel', location='$Location', purpose='$Purpose' WHERE id='$id'");

}
?>



