<?php
require '../../../connect.php';
include("../../../user.php");


 $Quote	    = $_REQUEST['Quote_type'];
 $mapping	=1;

if(($mapping == '1')OR($mapping =='2')){
	 if($Quote =='1'){ 
        $stmt = $con->query("select * from bank_master where vendor_type = '$Quote' ");
		 //echo "select * from bank_master where vendor_type = '$Quote' ";
		 while ($row = $stmt->fetch()) {
			$rows[] = $row;
		} 
	 }else{
		  $stmt = $con->query("select * from bank_master where vendor_type = '$Quote' ");
		 //echo "select * from bank_master where vendor_type = '$Quote' ";
		 while ($row = $stmt->fetch()) {
			$rows[] = $row;
		} 
	 }
}else{
	$rows[] ='';
}

echo json_encode($rows); 
//echo "$rows";
?> 