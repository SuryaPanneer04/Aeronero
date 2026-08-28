<?php
require '../../connect.php';
include("../../user.php");

$userrole=$_SESSION['userrole'];


$candidateid=$_SESSION['candidateid'];

$id = $_POST['id'];
$cus_code = $_POST['cus_code'];
$client_name = $_POST['client_name'];
$txt_org_name = $_POST['txt_org_name'];
$client_type = $_POST['client_type'];
$txt_website = $_POST['txt_website'];
//$Call_type=$_POST['Call_type'];
$Location = $_POST['Location'];
$state_1 = $_POST['state_1'];
$city_1 = $_POST['city_1'];
$txt_gst_no = $_POST['txt_gst_no'];
$txt_pan_no_1 = $_POST['txt_pan_no_1'];
$txt_address_1 = $_POST['txt_address_1'];
$txt_client_name = $_POST['txt_client_name'];
$txt_client_desig = $_POST['txt_client_desig'];
$Product = $_POST['Product'];
$services = $_POST['services'];
$Feedback = $_POST['Feedback'];
$Follup = $_POST['Follup'];
$feedback = $_POST['feedback'];
$phoneno=$_POST['phoneno'];
$whatsup=$_POST['whatsup'];
$mail=$_POST['mail'];
$custtype=$_POST['custtype'];
$alternamtivemail=$_POST['alternamtivemail'];

$clinet_code=$_POST['clinet_code'];

    $clieadd=$con->query("INSERT INTO `individual_form`(`id`,`client_org`, `client_name`, `contact`, `whatsapp`, `email`, `alternative_mail`, `pan_card`,`website`, `address`, `state`, `city`, `status`, `flag`, `created_by`, `created_on`) VALUES (NUll,'$txt_org_name','$client_name','$phoneno','$whatsup','$mail','$alternamtivemail','$txt_pan_no_1','$txt_website','$txt_address_1','$state_1','$city_1','1','1','$candidateid',now())");
   
$newclient_master=$con->query("INSERT INTO `new_client_master`(`id`, `client_code`, `org_name`, `org_type`, `website`, `status`, `flow`, `created_by`, `created_on`) VALUES (NULL,'$clinet_code','$txt_org_name','$custtype','$txt_website','1','1','$candidateid',now())");

if($newclient_master!='' && $clieadd!='')
{
  $sql2= $con->query("Update enquiry set status='45' where id='$id'");
  if($sql2)
  {
  echo "<script>alert('client Details Added Sccuessfully!');</script>";
  echo "<script>window.location.href= '../../index.php'</script>";
  }
  else
  {
    echo "<script>alert('SomethingWent wrong!');</script>";
    echo "<script>window.location.href= '../../index.php'</script>";
  }
}
else{
    echo "<script>alert('SomethingWent wrong!');</script>";
    echo "<script>window.location.href= '../../index.php'</script>";

}
?>
