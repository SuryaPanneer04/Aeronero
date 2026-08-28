<?php
require '../../../connect.php'; 
require '../../../user.php'; 
$candidateid=$_SESSION['candidateid'];

if(isset($_POST['costSheetId']) || isset($_POST['pro_name']) || isset($_POST['desc_1']) || isset($_POST['qty']) || isset($_POST['remark']))
{
$cus_name = $_REQUEST['costSheetId']; //CostSheet id;
$pro_name = $_REQUEST['pro_name'];
$desc_1 = $_REQUEST['desc_1'];
$qty = $_REQUEST['qty'];
// $serial_no = $_REQUEST['serial_no'];
$remark = $_REQUEST['remark'];
$poDate = $_REQUEST['poDate'];
$pvmId = $_REQUEST['pvmId'];
$so_no = $_REQUEST['so_no'];
$grn_entry_id = $_REQUEST['chk'];

$grnId = '';
     foreach($grn_entry_id as $id){
        $con->query("UPDATE `grn_entry` SET `status`=2 WHERE id='$id'");
        $grnId .= $id.','; 
     }

$row_count= count($pro_name);
$status =1;

for($i=0;$i<$row_count;$i++)		
{
		$pro_names 	  = $pro_name[$i];
		$desc_1s      = $desc_1[$i];
		$qtys      	  = $qty[$i];
		// $serial_nos   = $serial_no[$i];
		$remarks      = $remark[$i];
    


  $invoicetitle ="SS/CHE";

  	  //financial year	
		$current_month = date('m');
		if($current_month >= '01' && $current_month < '04'){
	
			$nextyear = substr(date('Y'),-2); //23
	   } 
	   else if($current_month >= '04'){
			$nextyear = substr(date('Y')+1,-2); //24
	   }
	
	   if($current_month >= '01' && $current_month < '04'){
	
		  $curyear = substr(date('Y')-1,-2); //22
	  }
	  else if($current_month >= '04'){
		  $curyear = substr(date('Y'),-2); //23
	  }

	  $finyear = $curyear.$nextyear;

  $row_query = $con->query("SELECT invoice_no FROM challan_entry ORDER BY id DESC");
   $count = $row_query->rowCount();
   
	  if($count == 0)
	  {   
		   $seq = 001;
		   $invoice_seq = sprintf("%04d", $seq);
		   $invoice_NO = $invoicetitle.'/'.$finyear.'/'.$invoice_seq ;
	  
	  }else{	 
		   $rowx = $row_query->fetch();
		 
		if (!empty($rowx['invoice_no'])) {
			  
		   $find_fs = substr($rowx['invoice_no'], 12, 4);
		   $final_invoice_seq = str_pad($find_fs + 1, 4, 0, STR_PAD_LEFT); 
		   $invoice_NO = $invoicetitle.'/'.$finyear.'/'.$final_invoice_seq;
		  
		  }
	  }

	  $sql =$con->query("insert into challan_entry(customer_name,product_name,spec,qty,remark,po_date,pvm_id,invoice_no,so_number,grn_entry_id,status,created_by,created_on) values('$cus_name','$pro_names','$desc_1s','$qtys','$remarks','$poDate','$pvmId','$invoice_NO','$so_no','$grnId','$status','$candidateid',now())");

	/*   echo "insert into challan_entry(customer_name,product_name,spec,qty,remark,po_date,pvm_id,invoice_no,so_number,grn_entry_id,status,created_by,created_on) values('$cus_name','$pro_names','$desc_1s','$qtys','$remarks','$poDate','$pvmId','$invoice_NO','$so_no','$grnId','$status','$candidateid',now())"; */

	  // echo "insert into challan_entry(customer_name,product_name,spec,qty,serial_no,remark,status,created_by,created_on) values('$cus_name','$pro_names','$desc_1s','$qtys','$serial_nos','$remarks','$status','$candidateid',now())"."<br>";

}

if($sql){
	echo 1;
}
else{
	echo 0;
}
}
?>