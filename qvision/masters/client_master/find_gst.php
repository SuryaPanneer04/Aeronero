<?php
require '../../../connect.php';
include("../../../user.php");

$state_id = $_REQUEST["city_id"];
$state_id = intval($state_id); // Ensure that $state_id is an integer to prevent SQL injection
$txt_org_name = $_REQUEST["txt_org_name"];
$exp = explode('-', $txt_org_name);
//$client_id = intval($exp[2]); // Extract the client ID and ensure it's an integer

// Fetch the state name based on the state ID
$stmt1 = $con->query("SELECT statename FROM `states` WHERE id = '$state_id'");
//$stmt1->execute([$state_id]);
$state_row = $stmt1->fetch(PDO::FETCH_ASSOC);

$state_name = $state_row['statename'];

// Fetch the GST prefix for the corresponding state
$stmt2 = $con->query("SELECT gst_prefix FROM `gst_prefixes` WHERE state ='$state_name'");
//echo "SELECT gst_prefix FROM `gst_prefixes` WHERE state ='$state_name'";
//$stmt2->execute([$state_name]);
$prefix_row = $stmt2->fetch(PDO::FETCH_ASSOC);

// Construct the GST number with the retrieved prefix
$gst_prefix = $prefix_row['gst_prefix'];

// Return the GST number as JSON
echo $gst_prefix;
?>
