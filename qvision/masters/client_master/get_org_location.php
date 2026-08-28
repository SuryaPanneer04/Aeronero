<?php 
require '../../../connect.php';

$client=$_REQUEST['client'];

$exp=explode('-',$client);
$cid=$exp[2];

$sel=$con->query("select * from new_client_master where id='$cid'");
$sfet=$sel->fetch();
//echo $ccode=$sfet['client_code'];
$clienor=$sfet['org_name'];
$ccode=$sfet['client_code'];
 $locationname=$con->query("SELECT DISTINCT location FROM `new_plant_master` WHERE client_code='$ccode' and client_org_name='$clienor'");
// $locationname="SELECT DISTINCT location FROM `new_plant_master` WHERE client_code='$ccode' and client_org_name='$clienor'";
// echo $locationname;exit();
// $ss=$con->query($locationname);

while($location=$locationname->fetch(PDO::FETCH_ASSOC))
{ 
   // for($i=0;$i<count())
     echo $lname=$location['location']."##";

}
?>