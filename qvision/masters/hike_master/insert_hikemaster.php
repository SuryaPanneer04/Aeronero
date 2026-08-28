<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
$candidate_id = $_SESSION['candidateid'];

$department = $_REQUEST['department'];
$name = $_REQUEST['amount'];
$rates = $_REQUEST['rating_score'];
$percent = $_REQUEST['percentage'];
$status = $_REQUEST['status'];

$sql = $con->query("INSERT INTO `hike_master`(dept_id, employeename, status, created_by, created_on) VALUES ('$department','$name','$status','$candidate_id',now())");

// print_r($sql);
// die();

$maxid = $con->query("select max(id) as mid from hike_master");
$max = $maxid->fetch();

$hike_id = $max['mid'];


for($i=0;$i<5;$i++)
{
$rating_score = $rates[$i];
$percentage = $percent[$i];

$rating = $con->query("INSERT INTO `hike_value_percent`(hike_master_id, rating_point, percentage_hike,created_on) VALUES ('$hike_id','$rating_score','$percentage',now())");

}


if($sql)
{
	echo 1;
}
else
{
	echo 0;
}
?>