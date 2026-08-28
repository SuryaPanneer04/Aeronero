<?php
require '../../../connect.php';
require '../../../user.php';
 $user_id =$_SESSION['userid'];
 $candidateid=$_SESSION['candidateid'];
 
//$filename = $_FILES['up_file']['name'];
//echo $form_data     = $_REQUEST['form_data'];
/// echo $vendor_id     = $_REQUEST['vendor_id'];
//echo $vendor_amt  = $_REQUEST['vendor_amt'];
//exit;
$item          = $_REQUEST['item'];
//echo $row_count= count($specification);
$qty           = $_REQUEST['qty'];
$unit          = $_REQUEST['unit'];
$unit_rate     = $_REQUEST['cost'];
$total         = $_REQUEST['price'];
//$totalPrice    = $_REQUEST['totalPrice'];
$row_count= count($total);
//$gst         = $_REQUEST['gst'];

 
 
$client_id      = $_REQUEST['client_id'];
//$company_id   = $_REQUEST['company_id'];
$enquiry_id     = $_REQUEST['enquiry_id'];
$quote_type     = $_REQUEST['quote_type'];
$business_id    = $_REQUEST['mapping_id'];
$candid_id      = $_REQUEST['candid_id'];

$costsheet_date_str  = $_REQUEST['chost_date'];
$costsheet_date = date('Y-m-d', strtotime($costsheet_date_str));

 if($business_id ==1){
	 $bussiness_type ="QSPLPR";
 }elseif($business_id ==2){
	 $bussiness_type ="QSPLSE";
 }elseif($business_id ==3){
	 $bussiness_type ="QSPLSL";
 }
//echo  $bussiness_type;
//$vendor_id     = $_REQUEST['vendor_id'];
 

//costsheet No Generated  Here
$row_query = "SELECT * FROM cost_sheet_entry ";

 $query = $con->query($row_query);
 $query->execute();
 $count = $query->rowCount();

 $row_val = $query->fetch();
 
	if($count == 0)
	{   
		$char = 'QOT';
	//financial year	
	$month =01;
	$current_month = date('m');
	if ($current_month >= '01' && $current_month < '04'){

	   if ($month >= '01' && $month < '04'){
		   $nextyear = substr(date('Y'),-2);
	   } 

	   if ($month >= '04'){
		   $nextyear = substr(date('Y')-1,-2);
	   }
	} 

	if ($current_month >= '04'){
	   if ($month >= '04'){
		   $nextyear = substr(date('Y'),-2);
	   }

	   if ($month < '04'){
		   $nextyear = substr(date('Y')+1,-2);
	   }
	}
	 
	 $nextyear; echo "<br/>";
    //current year
	 $curyear = substr(date('Y'),-2); echo "<br/>";
	 $finyear = $curyear.'-'.$nextyear; echo "<br/>";
	 $char_str = 'A';
    $seq = 00001;
    $costsheetno = sprintf("%05d", $seq);
       $CS_NO = $bussiness_type.''.$costsheetno.'/'.$finyear.'/'.$char_str ;
	
}else{	 
 $row_query = "SELECT * FROM cost_sheet_entry ORDER BY id DESC ";

 $query2 = $con->query($row_query);
 $query2->execute();
 $count = $query2->rowCount();
 $row = $query2->fetch();
 // $row['cost_sheet_no'];echo "<br/>";
	 if (!empty($row['cost_sheet_no'])) {
		
		$splite_val = explode("/",$row['cost_sheet_no']); 	
		 $no   =  $splite_val [0];echo "<br/>";
		 $char =  $splite_val [2];
	     $newchar= $char;
			$month =01;
			$current_month = date('m');
			if ($current_month >= '01' && $current_month < '04'){

			if ($month >= '01' && $month < '04'){
			   $nextyear = substr(date('Y'),-2);
			} 

			if ($month >= '04'){
			   $nextyear = substr(date('Y')-1,-2);
			}
			} 

			if ($current_month >= '04'){
			if ($month >= '04'){
			   $nextyear = substr(date('Y'),-2);
			}

			if ($month < '04'){
			   $nextyear = substr(date('Y')+1,-2);
			}
			}

			 $nextyear; 
			//current year
			 $curyear = substr(date('Y'),-2); echo "<br/>";
			 $finyear = $curyear.'-'.$nextyear; echo "<br/>";
			
			
			$find_f = substr($row['cost_sheet_no'], 0, 6);echo "<br/>";
	        $find_fs = substr($row['cost_sheet_no'], 7, 4);echo "<br/>";
	    $bussiness_type ; echo "<br/>";
	 // echo  $a = sprintf("%05d", $find_fs);echo "<br/>";
	   $final_cost_no = str_pad($find_fs + 1, 5, 0, STR_PAD_LEFT); echo "<br/>";
	   $CS_NO = $bussiness_type.''.$final_cost_no.'/'.$finyear.'/'.$newchar;
			
	 } 
}

 $log_per   = $_REQUEST['log_per'];
 $eng_per   = $_REQUEST['eng_per'];
 $log_amt   = $_REQUEST['log_amt'];
 $eng_amt   = $_REQUEST['eng_amt'];
 //$log_eng_amt   = $_REQUEST['log_eng_total'];
 $com_per   = $_REQUEST['com_per'];
 $com_amt   = $_REQUEST['com_amt'];
 
 $total_amt = $_REQUEST['col_item'];
 $net_amt = $_REQUEST['total_item'];
 $grand_amt = $_REQUEST['grand_total'];

 $gst_per   = $_REQUEST['gst_per'];
 $gst_amt   = $_REQUEST['gst_val'];
 $igst_per  = $_REQUEST['igst_per'];
 
for($i=0;$i<$row_count;$i++)
{
 $items          = $item[$i];
 $qtys           = $qty[$i];
 $units          = $unit[$i];
 $unit_rates     = $unit_rate[$i];
 $totalPrices    = $total[$i];//qty*cost
 $total_amts     = $total_amt[$i];//items total
 //$net_amts       = $net_amt[$i];//netamount
$log_perss   = $log_per[$i];
echo "$log_perss";

if($log_perss!=''){
	$log_pers  = $log_per[$i];
}else{
	$log_pers  ='0';
}
 //echo $log_pers;exit;
 $eng_perss   = $eng_per[$i];
 if($eng_perss!=''){
	$eng_pers  = $eng_per[$i];
}else{
	$eng_pers  ='0';
}
 $log_amts   = $log_amt[$i];
 $eng_amts   = $eng_amt[$i];
 //$log_eng_amts   = $log_eng_amt[$i];
 
 
 $com_perss   = $com_per[$i];
 if($com_perss!=''){
	$com_pers = $com_per[$i];
 }else{
	$com_pers = '0';
 }	
	
 $com_amts   = $com_amt[$i];

 


  $insert_query=$con->query("insert into cost_sheet_entry(cost_sheet_no,specification,qty,unit,unit_rate,log_per,log_amt,
  eng_per,eng_amt,com_per,com_amt,total_price,total_amt,net_amt,grand_amt,gst_per,gst_amt,enquiry_id,
  client_id,quote_type,business_id,candid_id,costsheet_date,status,flag,created_by,created_on) 
  values('$CS_NO','$items','$qtys','$units','$unit_rates','$log_pers','$log_amts','$eng_pers','$eng_amts',
  '$com_pers','$com_amts','$totalPrices','$total_amts','$net_amt','$grand_amt',
  '$gst_per','$gst_amt','$enquiry_id','$client_id','$quote_type','$business_id','$candid_id',
  '$costsheet_date','1','0','$candidateid',NOW())");  
  
  /* echo "insert into cost_sheet_entry(cost_sheet_no,specification,qty,unit,unit_rate,log_per,log_amt,
  eng_per,eng_amt,com_per,com_amt,total_price,total_amt,net_amt,grand_amt,gst_per,gst_amt,enquiry_id,
  client_id,quote_type,business_id,candid_id,costsheet_date,status,flag,created_by,created_on) 
  values('$CS_NO','$items','$qtys','$units','$unit_rates','$log_pers','$log_amts','$eng_pers','$eng_amts',
  '$com_pers','$com_amts','$totalPrices','$total_amts','$net_amt','$grand_amt',
  '$gst_per','$gst_amt','$enquiry_id','$client_id','$quote_type','$business_id','$candid_id',
  '$costsheet_date','1','0','$candidateid',NOW())"; */
 
}
$validity   = $_REQUEST['validity'];
 $payment   = $_REQUEST['payment'];
 $bank_name   = $_REQUEST['bank_name'];
 $account_no  = $_REQUEST['account_no'];
 
 $ifsc_code   = $_REQUEST['ifsc_code'];
 echo $ifsc_code   = $_REQUEST['ifsc_code'];
 $important   = $_REQUEST['important'];
 $delivery   = $_REQUEST['delivery'];
 $warrenty   = $_REQUEST['warrenty'];
 
 $insert_query=$con->query("insert into terms_and_condition(cost_sheet_no,validity,payment,bank_name,account_no,ifsc_code,important,delivery,
  warrenty) 
  values('$CS_NO','$validity','$payment','$bank_name','$account_no','$ifsc_code','$important','$delivery','$warrenty')");  
  
 echo "insert into terms_and_condition(validity,payment,bank_name,account_no,ifsc_code,important,delivery,
  warrenty) 
  values('$validity','$payment','$bank_name','$account_no','$ifsc_code','$important','$delivery','$warrenty')";
  
$insert_query2= $con->query("Update enquiry set status='4' where id='$enquiry_id'");
	/* echo "Update enquiry set status='4' where id='$enquiry_id'"; */
?>






