<?php
require '../../../connect.php';
if( isset($_POST['payment_id'])  || isset($_POST['amount'])  || isset($_POST['bank'])
|| isset($_POST['source']))
{


	 $payment_id = $_POST['payment_id'];   
	 $amount  = $_POST['amount'];
	 $bank  = $_POST['bank'];
	 $utr= $_POST['utr'];
	 
	 $select=$con->query("SELECT p.*,d.vendor_name as vendor,d.town_city from payable_payment p left join doller_vendor_mastor  d on d.id=p.vendor_name where p.id='$payment_id'");
	 $selects=$select->fetch();
	$vendor_name=$selects['vendor_name'];
	$insert_sql=$con->query("insert into payable_pending_payment(payment_id,vendor_id,amount,bank,utr)
	values('$payment_id','$vendor_name','$amount','$bank','$utr')");
	
	
	$select_sql=$con->query("select * from payable_payment where id='$payment_id'");
	$selects=$select_sql->fetch();
	$pending=$selects['pending_payment'];
	$paid=$selects['payment_paid'];
	$amounts=$pending-$amount;
	$paids=$paid+$amount;
	$update_sql=$con->query("update payable_payment set pending_payment='$amounts',payment_paid='$paids' where id='$payment_id'");
	if($insert_sql)
	{
		echo "1";
		
	}else{
	echo "2";
	}
	
}
?>
