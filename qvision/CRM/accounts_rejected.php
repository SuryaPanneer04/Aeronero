<?php
require '../../connect.php';
require '../../user.php';
echo $remark=$_REQUEST['remark'];
echo $idee=$_REQUEST['id'];


//$status=3;

//if($cust_type == 1){
	//$id=$_REQUEST['get_id'];
	//$sql2= $con->query("Update new_client_master set status='$status',flow='2' where id='$id'");
	$sql3= $con->query("Update enquiry set status='25',flag='2',remark='$remark' where id='$idee'");
//}else if($cust_type == 2){
	//$iid=$_REQUEST['iid'];
	//$sql2= $con->query("Update individual_form set status='$status',flag='2' where id='$iid'");
	//$sql3= $con->query("Update enquiry set status='25',flag='2' where id='$idee'");
//}
if($sql3)
{
	echo 0;
}
else
{
	echo 1;
}

?>






