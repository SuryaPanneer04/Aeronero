<?php
require '../../../connect.php';
if(isset($_POST['client_id']) || isset($_POST['plant_id'])  || isset($_POST['amount'])  || isset($_POST['bank'])
|| isset($_POST['source']))
{


	 $client_name = $_POST['client_id'];
     $plant   = $_POST['plant_id'];
	 $amount  = $_POST['amount'];
	 $bank  = $_POST['bank'];
	 $source= $_POST['source'];
	 
	
	$insert_sql=$con->query("insert into receivable_pending_payment(client_id,plant_id,amount,bank,source)
	values('$client_name','$plant','$amount','$bank','$source')");
	$select_sql=$con->query("select * from receivable_payment where client_id='$client_name' and plant_id='$plant'");
	$selects=$select_sql->fetch();
	$pending=$selects['payment_pending'];
	$receive=$selects['payment_received'];
	$amounts=$pending-$amount;
	$amt=$receive+$amount;
	$update_sql=$con->query("update receivable_payment set payment_pending='$amounts' where client_id='$client_name' and plant_id='$plant'");
	$updates=$con->query("update receivable_payment set payment_received='$amt' where client_id='$client_name' and plant_id='$plant'");
	if($insert_sql)
	{
		echo "1";
		
	}else{
	echo "2";
	}
	
}
?>
