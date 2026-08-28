<?php
require '../../../connect.php';
include("../../../user.php");
$productname=$_REQUEST['name'];

$exp=explode('-',$productname);

$name=$exp[0];
$id=$exp[1];


$sel=$con->query("select * from product_master where id='$id' and name='$name'");
 $sfet=$sel->fetch();
echo $sfet['product_id']."||".$sfet['description']; 

?>