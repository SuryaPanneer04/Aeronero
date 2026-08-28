
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../../../connect.php';
require '../../../user.php';
file_put_contents('debug.txt', "Started costsheet_revise_insert.php\n", FILE_APPEND);
$user_id =$_SESSION['userid'];
$candidateid=$_SESSION['candidateid'];
$costsheetno_old =$_REQUEST['cost_sheet_no'];
 
$uploadDir = 'uploads/'; 
//$filename = $_FILES['up_file']['name'];
//echo $form_data     = $_REQUEST['form_data'];
/// echo $vendor_id     = $_REQUEST['vendor_id'];
//echo $vendor_amt  = $_REQUEST['vendor_amt'];
//exit;
$item          = $_REQUEST['item'] ?? [];
//echo $row_count= count($specification);
$qty           = $_REQUEST['qty'] ?? [];
//$unit          = $_REQUEST['unit'] ?? [];
$unit_rate     = $_REQUEST['cost'] ?? [];
$total         = $_REQUEST['price'] ?? [];
//$totalPrice    = $_REQUEST['totalPrice'] ?? [];
file_put_contents('debug.txt', "Line 25\n", FILE_APPEND);
$row_count= count($total);
//$gst         = $_REQUEST['gst'];


$client_id      = $_REQUEST['client_id'];
//$company_id   = $_REQUEST['company_id'];
$enquiry_id     = $_REQUEST['enquiry_id'];
$quote_type     = $_REQUEST['quote_type'];
$business_id    = $_REQUEST['mapping_id'];
$candid_id      = $_REQUEST['candid_id'];

$costsheet_date_str  = $_REQUEST['chost_date'];
file_put_contents('debug.txt', "Line 37\n", FILE_APPEND);
$costsheet_date = date('Y-m-d', strtotime($costsheet_date_str));

 if($business_id ==1){
	 //$bussiness_type ="QSPLPR";
	 $bussiness_type ="SSPR";//product
 }elseif($business_id ==2){
	 //$bussiness_type ="QSPLSE";
	 $bussiness_type ="SSSE";//service
 }elseif($business_id ==3){
	 //$bussiness_type ="QSPLSL";
	 $bussiness_type ="SSSL";//solution
 }
file_put_contents('debug.txt', "Line 50\n", FILE_APPEND);
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
	 $nextyear; 
	 $nextyear; 
    //current year
	$curyear = substr(date('Y'),-2); 
    $finyear = $curyear.'-'.$nextyear; 
    $char_str = 1;
    $seq = 00001;
    $costsheetno = sprintf("%05d", $seq);
    $CS_NO = $bussiness_type.''.$costsheetno.'/'.$finyear.'/'.$char_str ;
}else{	 
 $row_query = "SELECT * FROM cost_sheet_entry ORDER BY id DESC ";

 $query2 = $con->query($row_query);
 $query2->execute();
 $count = $query2->rowCount();
 $row = $query2->fetch();
 // $row['cost_sheet_no'];
		if (!empty($row['cost_sheet_no'])) 
		{
		
		$splite_val = explode("/",$row['cost_sheet_no']); 	
		 $no   =  $splite_val [0];
		 $no2   =  $splite_val [1];
		 $char =  $splite_val [2];
	     $newchar= ++$char;
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
			 $curyear = substr(date('Y'),-2); 
			 $finyear = $curyear.'-'.$nextyear; 
			
			$find_f = substr($row['cost_sheet_no'], 0, 6);
	        $find_fs = substr($row['cost_sheet_no'], 7, 4);
	        $bussiness_type ; 
	  // echo  $a = sprintf("%05d", $find_fs);
	    $final_cost_no = str_pad($find_fs + 1, 5, 0, STR_PAD_LEFT); 
	    $CS_NO = $no.''.'/'.$no2.'/'.$newchar;
	  //echo $CS_NO = $bussiness_type.''.$final_cost_no.'/'.$finyear.'/'.$newchar;	
	 }
}//exit;
 $candidateid=$_SESSION['candidateid'];
 
 $log_per   = $_REQUEST['log_per'] ?? [];
 $eng_per   = $_REQUEST['eng_per'] ?? [];
 $log_amt   = $_REQUEST['log_amt'] ?? [];
 $eng_amt   = $_REQUEST['eng_amt'] ?? [];
 //$log_eng_amt   = $_REQUEST['log_eng_total'];
 $com_per   = $_REQUEST['com_per'] ?? [];
 $com_amt   = $_REQUEST['com_amt'] ?? [];
 
 $total_amt = $_REQUEST['col_item'] ?? [];
 $net_amt = $_REQUEST['total_item'] ?? 0;
 $grand_amt = $_REQUEST['grand_total'] ?? 0;

 $gst_per   = $_REQUEST['gst_per'] ?? 0;
 $gst_amt   = $_REQUEST['gst_val'] ?? 0;
 $igst_per  = $_REQUEST['igst_per'] ?? 0;
 $igst_amt  = $_REQUEST['igst_val'] ?? 0;
 $vendor_id  = $_REQUEST['vendor_name'] ?? [];
 
	  $vendor_name1 = $_REQUEST['vendor_name1'] ?? [];	
	  	
      $amount      = $_REQUEST['amount'] ?? [];
      $amount1      = $_REQUEST['amount1'] ?? [];
	  
file_put_contents('debug.txt', "About to start loop, count=$row_count.\n", FILE_APPEND);
	  
 for($i=0;$i<$row_count;$i++)
{
file_put_contents('debug.txt', "Inside loop i=$i.\n", FILE_APPEND);
/*  $specifications = $specification[$i];
 $qtys           = $qty[$i];
 $units          = $unit[$i];
 $unit_rates     = $unit_rate[$i];
 $totalPrices    = $total[$i]; */
 
 
 $items          = $item[$i];
 $qtys           = $qty[$i];
 //$units          = $unit[$i];
 $unit_rates     = $unit_rate[$i];
 $totalPrices    = $total[$i];//qty*cost
 $total_amts     = $total_amt[$i];//items total
 //$net_amts       = $net_amt[$i];//netamount
$vendor=$vendor_id[$i];

 $log_pers   = $log_per[$i];
 $eng_pers   = $eng_per[$i];
 $log_amts   = $log_amt[$i];
 $eng_amts   = $eng_amt[$i];
 //$log_eng_amts   = $log_eng_amt[$i];
 
 
 $com_pers   = $com_per[$i];
 $com_amts   = $com_amt[$i];
 
 
 // Safe check for image
 $filesArr3 = isset($_FILES["image"]) ? $_FILES["image"] : null;
 $fileNames = $filesArr3 ? array_filter($filesArr3['name']) : [];

/* Resume upload for image */
$uploadedFile = ''; 
if(!empty($fileNames)) {                          
    foreach($filesArr3['name'] as $key=>$val) {  
        $fileName = basename($filesArr3['name'][$key]);  
        $targetFilePath = $uploadDir . $fileName;  
        if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)) {  
            $uploadedFile .= $fileName; 
        }
    }  
}    

 // Safe check for file1 (This fixes the Fatal Error!)
 $filesArr4 = isset($_FILES["file1"]) ? $_FILES["file1"] : null;
 $fileNames1 = $filesArr4 ? array_filter($filesArr4['name']) : []; 

/* Resume upload for file1 */
$uploadedFile1 = ''; 
if(!empty($fileNames1)) {                          
    foreach($filesArr4['name'] as $key=>$val) {  
        $fileName1 = basename($filesArr4['name'][$key]);  
        $targetFilePath1 = $uploadDir . $fileName1;  
        if(move_uploaded_file($filesArr4["tmp_name"][$key], $targetFilePath1)) {  
            $uploadedFile1 .= $fileName1; 
        }
    }  
}   
    
 file_put_contents('debug.txt', "Reached line 254 before quote query.\n", FILE_APPEND);
    
 
 $row_query = "SELECT quote_no from quote_generate where cost_sheet_no ='$costsheetno_old' ";
 $query3 = $con->query($row_query);
 $query3->execute();
 $count = $query3->rowCount();
 $row = $query3->fetch();
 $quote_no = $row['quote_no'];
if($quote_no!=''){
   $insert_query=$con->query("insert into cost_sheet_entry(cost_sheet_no,specification,qty,unit,unit_rate,log_per,log_amt,eng_per,eng_amt,com_per,com_amt,
                              total_price,total_amt,net_amt,grand_amt,gst_per,gst_amt,igst_per,igst_amount,enquiry_id,client_id,quote_type,
						      business_id,vendor_id,candid_id,costsheet_date,status,old_quote_no,flag,created_by,created_on) 
                        
					    values('$CS_NO','$items','$qtys','0','$unit_rates','$log_pers','$log_amts','$eng_pers','$eng_amts','$com_pers','$com_amts',
							'$totalPrices','$total_amts','$net_amt','$grand_amt','$gst_per','$gst_amt','$igst_per','$igst_amt','$enquiry_id','$client_id','$quote_type',
							'$business_id','$vendor','$candid_id','$costsheet_date','1','$quote_no','0','$candidateid',NOW())");  

/* echo "insert into cost_sheet_entry(cost_sheet_no,specification,qty,unit,unit_rate,log_per,log_amt,eng_per,eng_amt,com_per,com_amt,
                              total_price,total_amt,net_amt,grand_amt,gst_per,gst_amt,enquiry_id,client_id,quote_type,
						      business_id,candid_id,costsheet_date,status,old_quote_no,flag,created_by,created_on) 
                        
					    values('$CS_NO','$items','$qtys','$units','$unit_rates','$log_pers','$log_amts','$eng_pers','$eng_amts','$com_pers','$com_amts',
							'$totalPrices','$total_amts','$net_amt','$grand_amt','$gst_per','$gst_amt','$enquiry_id','$client_id','$quote_type',
							'$business_id','$candid_id','$costsheet_date','2','$quote_no','0','$candidateid',NOW())"; */


  $update_query =$con->query("update cost_sheet_entry set status ='0',flag ='1' where cost_sheet_no= '$costsheetno_old'");
  //echo "update cost_sheet_entry set status ='0',flag ='1' where cost_sheet_no= '$costsheetno_old'";
   
    $insert_query2= $con->query("Update enquiry set status='4' where id='$enquiry_id'");
//echo "Update enquiry set status='5' where id='$enquiry_id'";
   
}
else
{
	$insert_query=$con->query(
							"insert into cost_sheet_entry(cost_sheet_no,specification,qty,unit,unit_rate,log_per,log_amt,eng_per,eng_amt,
	                          com_per,com_amt,total_price,total_amt,net_amt,grand_amt,gst_per,gst_amt,igst_per,igst_amount,enquiry_id,client_id,quote_type,
							  business_id,vendor_id,candid_id,costsheet_date,status,flag,created_by,created_on) 
                            
							values('$CS_NO','$items','$qtys','0','$unit_rates','$log_pers','$log_amts','$eng_pers','$eng_amts',
							'$com_pers','$com_amts','$totalPrices','$total_amts','$net_amt','$grand_amt','$gst_per','$gst_amt','$igst_per','$igst_amt','$enquiry_id','$client_id','$quote_type',
							'$business_id','$vendor','$candid_id','$costsheet_date','1','0','$candidateid',NOW())");  
			

/* echo "insert into cost_sheet_entry(cost_sheet_no,specification,qty,unit,unit_rate,log_per,log_amt,eng_per,eng_amt,
	                          com_per,com_amt,total_price,total_amt,net_amt,grand_amt,gst_per,gst_amt,enquiry_id,client_id,quote_type,
							  business_id,candid_id,costsheet_date,status,flag,created_by,created_on) 
                            
							values('$CS_NO','$items','$qtys','$units','$unit_rates','$log_pers','$log_amts','$eng_pers','$eng_amts',
							'$com_pers','$com_amts','$totalPrices','$total_amts','$net_amt','$grand_amt','$gst_per','$gst_amt','$enquiry_id','$client_id','$quote_type',
							'$business_id','$candid_id','$costsheet_date','1','0','$candidateid',NOW())"; */
			
   $update_query =$con->query("update cost_sheet_entry set status ='0',flag ='1' where cost_sheet_no= '$costsheetno_old'");
  
  
 //echo "update cost_sheet_entry set status ='0',flag ='1' where cost_sheet_no= '$costsheetno_old'";
  
 
  
    $insert_query2= $con->query("Update enquiry set status='5' where id='$enquiry_id'");
	//echo "Update enquiry set status='5' where id='$enquiry_id'";
}
}

if($insert_query)
{
   echo "Success";
   file_put_contents('debug.txt', "Success! inserted.\n", FILE_APPEND);
} else {
   file_put_contents('debug.txt', "Failed to insert: " . implode(" ", $con->errorInfo()) . "\n", FILE_APPEND);
}
?>







