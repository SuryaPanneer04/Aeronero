<?php
require '../../connect.php';
require '../../user.php';
$user_id =$_SESSION['userid'];
$candidateid=$_SESSION['candidateid']; 
 
$uploadDir = 'uploads/'; 
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 

// If form is submitted 
if(isset($_POST['mapping_id'])
	                           || isset($_POST['chost_date'])|| isset($_POST['Y-m-d'])|| isset($_POST['cost_sheet_no'])
						       
						   
						       || isset($_POST['item'])|| isset($_POST['qty'])|| isset($_POST['unit'])
                               || isset($_POST['cost'])|| isset($_POST['price'])
							   
							   || isset($_POST['log_per'])|| isset($_POST['eng_per'])|| isset($_POST['log_amt'])
							   || isset($_POST['eng_amt'])
							   
							   || isset($_POST['com_per'])|| isset($_POST['com_amt'])
							   
							   || isset($_POST['col_item'])|| isset($_POST['total_item'])|| isset($_POST['grand_total'])
							   || isset($_POST['gst_per'])|| isset($_POST['gst_val'])|| isset($_POST['igst_per'])
							   
							   || isset($_POST['vendor_name'])|| isset($_POST['amount'])|| isset($_POST['file'])
							   
							   || isset($_POST['validity'])|| isset($_POST['payment'])|| isset($_POST['bank_name'])
							   || isset($_POST['account_no'])|| isset($_POST['ifsc_code'])|| isset($_POST['important'])
							   || isset($_POST['delivery'])|| isset($_POST['warrenty'])){
							
							     
    // Get the submitted form data 
    //$enquiry_id = $_POST['enquiry_id'];      
    //$business_id = $_POST['mapping_id']; 
    // $client_id = $_POST['client_id']; 
	
	
     $quote_types = $_POST['quote_type']; 
	/*  $category_id=$_POST['category'];
	 $cate=$con->query("select mapping_id from product_services where id='$category_id'");
	 $categories=$cate->fetch();
	 $business_id=$categories['mapping_id']; */
     //$remark = $_POST['remark']; 
	 
    // $cost_sheet_no = $_POST['cost_sheet_no']; 
	 if($quote_types="INR")
	 {
		 $quote_type=1;
	 }else{
		 $quote_type=2;
	 }
	 $costsheet_date_str  = $_REQUEST['chost_date'];
     $costsheet_date = date('Y-m-d', strtotime($costsheet_date_str));
	 
	//get submitted cost details
	  $product_name          = $_REQUEST['product_name'];
	  $product_id         = $_REQUEST['product_id'];
	 $description          = $_REQUEST['description'];
    //echo $row_count= count($specification);
      $qty           = $_REQUEST['qty'];
      $unit          = $_REQUEST['unit'];
      $unit_rate     = $_REQUEST['cost'];
      $total         = $_REQUEST['price'];
	  $row_count= count($total);
	  $log_per   = $_REQUEST['log_per'];
      $eng_per   = $_REQUEST['eng_per'];
      $log_amt   = $_REQUEST['log_amt'];	  
	  $log_per_value = str_replace('%', '', $log_amt);
	  
      $eng_amt   = $_REQUEST['eng_amt'];
      $eng_per_value = str_replace('%', '', $eng_amt);
	  
      $com_per   = $_REQUEST['com_per'];	  
      $com_amt   = $_REQUEST['com_amt'];
      $com_per_value = str_replace('%', '', $com_amt);
	  
	  $total_amt = $_REQUEST['col_item'];
      $net_amt   = $_REQUEST['total_item'];
      $grand_amt = $_REQUEST['grand_total'];
    //gst calculations
      $gst_pers   = $_REQUEST['gst_per'];
	  $gst_per = str_replace('%', '', $gst_pers);
      $gst_amt   = $_REQUEST['gst_val'];
      $igst_per  = $_REQUEST['igst_per'];
	//vendor selection
	  $vendor_name = $_REQUEST['vendor_name'];
	  /* $stmt = $con->query("SELECT id,vendor_name FROM doller_vendor_mastor where vendor_name='$vendors_name'");
	  $row8 = $stmt->fetch();
	  $vendor_name = $row8 ['id']; */
      $amount      = $_REQUEST['amount'];
    //Terms and conditions
	  $validity   = $_REQUEST['validity'];
      $payment   = $_REQUEST['payment'];
      $bank_name   = $_REQUEST['bank_name'];
      $account_no  = $_REQUEST['account_no'];
 
      $ifsc_code   = $_REQUEST['ifsc_code'];
      $important   = $_REQUEST['important'];
      $delivery   = $_REQUEST['delivery'];
      $warrenty   = $_REQUEST['warrenty'];
	  
    //Business id create	
	/*   if($business_id =='1'){
	 $bussiness_type ="PR";
    }elseif($business_id =='2'){
	 $bussiness_type ="PR";
    }elseif($business_id =='3'){
	 $bussiness_type ="PR";
    }    */
    //$vendor_id     = $_REQUEST['vendor_id'];
 

    //costsheet No Generated  Here
       $row_query = "SELECT * FROM purchase_requistion_entry ";

       $query = $con->query($row_query);
       $query->execute();
       $count = $query->rowCount();

       $row_val = $query->fetch();
 
	/* if($count == 0)
	{   
		  $char = 'QOT';
	//financial year	
	         $month =01;
	         $current_month = date('m');
	      if($current_month >= '01' && $current_month < '04'){

	      if($month >= '01' && $month < '04'){
		     $nextyear = substr(date('Y'),-2);
	    } 

	      if($month >= '04'){
		     $nextyear = substr(date('Y')-1,-2);
	    }
	} 
 
	     if($current_month >= '04'){
	     if($month >= '04'){
		   $nextyear = substr(date('Y'),-2);
	   }

	     if($month < '04'){
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
         $row_query = "SELECT cost_sheet_nos FROM purchase_requistion_entry where cost_sheet_nos like 'PR%' order by id desc";
   	
         $query2 = $con->query($row_query);
         $query2->execute();
         $count = $query2->rowCount();
         $row = $query2->fetch();
	  if (!empty($row['cost_sheet_nos'])) {
		 $splite_val = explode("/",$row['cost_sheet_nos']); 
		 $no   =  $splite_val [0];echo "<br/>";
		 $no2 =  $splite_val [1];
		 $char =  $splite_val [2];
	     $newchar= ++$char;
	     $month =01;
		 $current_month = date('m');
			if ($current_month >= '01' && $current_month < '04'){

			if ($month >= '01' && $month < '04'){
			   $nextyear = substr(date('Y', strtotime('+1 year')),-2);
			   
			} 

			if ($month >= '04'){
			   $nextyear = substr(date('Y', strtotime('+1 year'))-1,-2);
			}
			} 

			if ($current_month >= '04'){
			if ($month >= '04'){
			   $nextyear = substr(date('Y', strtotime('+1 year')),-2);
			}

			if ($month < '04'){
			   $nextyear = substr(date('Y', strtotime('+1 year'))+1,-2);
			}
			}

		 $nextyear; 
	//current year
		 $curyear = substr(date('Y'),-2); echo "<br/>";
		 $finyear = $curyear.'-'.$nextyear; echo "<br/>";
		
			
		 $find_f = substr($row['cost_sheet_nos'], 0, 2);echo "<br/>";
	     $find_fs = substr($row['cost_sheet_nos'], 3, 4);echo "<br/>";
		
	     $bussiness_type ; echo "<br/>";
		
		// echo  $a = sprintf("%05d", $find_fs);echo "<br/>";
	     $final_cost_no = str_pad($find_fs + 1, 5, 0, STR_PAD_LEFT); echo "<br/>";
		
	     $CS_NO = $bussiness_type.''.$final_cost_no.'/'.$finyear.'/'.$newchar;
		//$CS_NO = $no.''.'/'.$no2.'/'.$newchar;	
	    }
							   
	}   */
	
	 $filesArr3 = $_FILES["file"];


/* Resume upload */
		$fileNames = array_filter($filesArr3['name']); 
			 
         
        // Upload file 
        $uploadedFile = ''; 
        if(!empty($fileNames))
		{                          
            foreach($filesArr3['name'] as $key=>$val)
			{  
                // File upload path  
                $fileName = basename($filesArr3['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName;  
                  
                // Check whether file type is valid  
                 $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                
                    // Upload file to server  
                    if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName; 
                     
                }
            }  
        }    
    

	for($i=0;$i<$row_count;$i++)
{
         $product_names          = $product_name[$i];
		$product_ids         = $product_id[$i];
		$descriptions          = $description[$i];
		 $qtys           = $qty[$i];
         $units          = $unit[$i];
         $unit_rates     = $unit_rate[$i];
         $totalPrices    = $total[$i];//qty*cost
         $total_amts     = $total_amt[$i];//items total

		
         $log_perss   = $log_per[$i];
        

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
         $log_amts   = $log_per_value[$i];
         $eng_amts   = $eng_per_value[$i];
   //$log_eng_amts   = $log_eng_amt[$i];
  
         $com_perss   = $com_per[$i];
       if($com_perss!=''){
	     $com_pers = $com_per[$i];
}else{
	     $com_pers = '0';
}	
	
         $com_amts   = $com_per_value[$i];

	
     $insert_query=$con->query("insert into purchase_requistion_entry(product_name,product_id,description,quantity,units,unit_rates,logs_per,log_amts,
  engs_per,eng_amts,coms_per,com_amts,tot_prices,total_amts,net_amts,grand_amts,gsts_per,gst_amts,quote_types,
  business_ids,vendor_ids,candid_ids,file_uploads,file_amounts,costsheet_dates,req_status,flag,created_by,created_on) 
  values('$product_names','$product_ids','$descriptions','$qtys','$units','$unit_rates','$log_pers','$log_amts','$eng_pers','$eng_amts',
  '$com_pers','$com_amts','$totalPrices','$total_amts','$net_amt','$grand_amt','$gst_per','$gst_amt', '$quote_type','','$vendor_name','$candidateid','$uploadedFile','$amount',
  '$costsheet_date','1','0','$candidateid',NOW())");
  
  $last_id=$con->query("select MAX(id) as max from purchase_requistion_entry");
  $last=$last_id->fetch();
 
    /* $purchase_vendor=$con->query("insert into purchase_vendor_master (cost_sheet_id,so_number,purchase_type,specification,vendor_id,warrenty,price,finance_status,finance_approved_by,finance_remarks,status)values('','NULL','NULL','$product_names','$vendor_name','NULL','$totalPrices','NULL','NULL','NULL','2')");
	 */
  if(!$insert_query)
  {
	 echo '<script>alert("Purchase Requisition Not Submitted")</script>'; 
	  
  }
  
 /* echo "insert into cost_sheet_entry(cost_sheet_no,specification,qty,unit,unit_rate,log_per,log_amt,
  eng_per,eng_amt,com_per,com_amt,total_price,total_amt,net_amt,grand_amt,gst_per,gst_amt,enquiry_id,client_id,quote_type,
  business_id,vendor_id,candid_id,file_upload,file_amount,costsheet_date,status,remark,flag,created_by,created_on) 
  values('$CS_NO','$items','$qtys','$units','$unit_rates','$log_pers','$log_amts','$eng_pers','$eng_amts',
  '$com_pers','$com_amts','$totalPrices','$total_amts','$net_amt','$grand_amt','$gst_per','$gst_amt','$enquiry_id',
  '$client_id', '$quote_type','$business_id','$vendor_name','$candidateid','$uploadedFile','$amount',
  '$costsheet_date','1','$remark','0','$candidateid',NOW())"; */
   
     $insert_query=$con->query("insert into terms_and_condition(cost_sheet_no,validity,payment,bank_name,account_no,
 ifsc_code,important,delivery,warrenty) 
  values('','$validity','$payment','$bank_name','$account_no','$ifsc_code','$important','$delivery','$warrenty')");
  
  
  
} 

}
?> 
    
