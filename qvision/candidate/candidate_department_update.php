<?php
include('../../connect.php');
include('../../user.php');

$id=$_REQUEST['id'];

//$company=$_REQUEST['companys']; 
$position=$_REQUEST['position'];
$tech_department=$_REQUEST['tech_department'];


  $sql=$con->query("update candidate_form_details set position='$position',department='$tech_department',status='40' where id='$id'");
   
   echo "update candidate_form_details set position='$position',department='$tech_department',status='40' where id='$id'";
	
if($sql)
{
	echo "Query updated_1";
	
}
else
{
	echo "Query not updated_0";

}
?>
