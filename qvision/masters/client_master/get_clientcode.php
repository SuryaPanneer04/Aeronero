<?php 
require '../../../connect.php';

$client=$_REQUEST['client'];

$exp=explode('-',$client);
$cid=$exp[2];

$sel=$con->query("select * from new_client_master where id='$cid'");
$sfet=$sel->fetch();
echo $ccode=$sfet['client_code'];

?>