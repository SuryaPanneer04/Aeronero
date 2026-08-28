<?php
require '../../../connect.php'; 
require '../../../user.php'; 
require '../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
$row_count='';
	//$enquiry_id =$_REQUEST['enquiry_id']; echo $enquiry_id;echo '****';
 $user_id =$_SESSION['userid'];
 $candidateid=$_SESSION['candidateid']; 

 $enquiry_idflow=$_REQUEST['enquiry_idflow'];
 $enquiry_idq = $enquiry_idflow;

//$deatsils=$con->query("select e.company_name,e.mail as email,zud.full_name, zud.candidate_id,zud.user_name as mail,cse.enquiry_id as enquiry_ids,cse.cost_sheet_no,cse.specification from cost_sheet_entry cse left Join enquiry e on e.id = cse.enquiry_id left JOIN z_user_master zud ON zud.candidate_id = cse.created_by WHERE cse.candid_id = '$candidateid'");

$candidateid=$_SESSION['candidateid'];

$detailsss=$con->query("SELECT * FROM `enquiry` WHERE id='$enquiry_idflow'");
$data=$detailsss->fetch();

$getname=$con->query("SELECT * FROM `candidate_form_details` WHERE id='$candidateid'");

$getfistsname=$getname->fetch();




$callsid=$data['calls_id'];

$clientnname=$con->query("SELECT * FROM `crm_calls` WHERE id='$callsid'");
$data2=$clientnname->fetch();

	$client=$data2['client_name'];
	//$mailerID=$data['mail'];
	$mailerID='rajeshwari@bluebase.in';

	$full_name=$getfistsname['first_name']; 

	$company_name=$data['Company_name']; 

	//$cost_sheet_no=$data['cost_sheet_no']; 
	//$specification= $product_name;	
	$enquiry_id=$data['id'];	



 
 if($candidateid==''){
	 $candidateid=0;//admin
	 }
 
$uploadDir = 'uploads/'; 
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 

// If form is submitted 
if(isset($_POST['enquiry_idflow']) || isset($_POST['mapping_id']) || isset($_POST['Call_type'])|| isset($_POST['pro_ser_id'])||  isset($_POST['quote_type']) || isset($_POST['client_id']) || isset($_POST['tot_item1'])
	                           || isset($_POST['chost_date'])|| isset($_POST['Y-m-d'])
						       
						   
						       || isset($_POST['product_id'])|| isset($_POST['product_name'])|| isset($_POST['description'])|| isset($_POST['item'])|| isset($_POST['qty'])||  isset($_POST['igst_amt'])
                               || isset($_POST['cost'])|| isset($_POST['price']) || isset($_POST['sel_amt']) || isset($_POST['dist_per']) 
							   
							   || isset($_POST['log_per'])|| isset($_POST['eng_per'])|| isset($_POST['log_amt'])
							   || isset($_POST['eng_amt']) || isset($_POST['dist_amt'])
							   
							   || isset($_POST['com_per'])|| isset($_POST['com_amt'])
							   
							   || isset($_POST['col_item'])|| isset($_POST['total_item'])|| isset($_POST['grand_total'])
							   || isset($_POST['gst_per'])|| isset($_POST['gst_amt'])|| isset($_POST['igst_per']) || isset($_POST['mar_pper']) || isset($_POST['mar_aamt'])
							   
							   || isset($_POST['vendor_name'])
							   
							   || isset($_POST['validity'])|| isset($_POST['payment'])|| isset($_POST['bank_name']) || isset($_POST['acc_hold_name'])
							   || isset($_POST['account_no'])|| isset($_POST['ifsc_code'])|| isset($_POST['important']) || isset($_POST['branch_name'])
							   || isset($_POST['delivery'])|| isset($_POST['warrenty']) || isset($_POST['vendor_type']) || isset($_POST['image'])){
								   
								   
								   
							     
    // Get the submitted form data 
	$business_ids = $_POST['mapping_id'];
 $business_id = $data['Product']; 	
	if($business_id==1 || $business_id==3){
     $tot_item_get = $_POST['tot_item'];
	 if($tot_item_get)
	 {
		 $tot_item=$tot_item_get;
	 }
	 else
	 {
		 $tot_item=0;
	 }
	}	 
     $Call_type = $data['Call_type']; 
    
     $enquiry_idq = $_POST['enquiry_idflow']; 

     
     $client_id = $_POST['client_id']; 
     $quote_type = $_POST['quote_type']; 
	
	 
	 $costsheet_date_str  = $_REQUEST['chost_date'];
	//get submitted cost details
	  $product_id          = isset($_REQUEST['product_id']) ? $_REQUEST['product_id'] : array();
	  $product_name          = isset($_REQUEST['product_name']) ? $_REQUEST['product_name'] : array();
	  $description          = isset($_REQUEST['description']) ? $_REQUEST['description'] : array();
	  if(isset($_REQUEST['item']))
	  {
		$item          = $_REQUEST['item'];

	  }
	  else
	  {
		$item='NULL';
	  }
	  $hsn_code          = isset($_REQUEST['hsn_code']) ? $_REQUEST['hsn_code'] : array();
	 
    //echo $row_count= count($specification);
      $qty           = isset($_REQUEST['qty']) ? $_REQUEST['qty'] : array();
	 
      //$unit          = $_REQUEST['unit'];
      $unit_rate     = isset($_REQUEST['cost']) ? $_REQUEST['cost'] : array();
      $total         = isset($_REQUEST['price']) ? $_REQUEST['price'] : array();
	 
		$row_count= is_array($total) ? count($total) : 0;
	  $sel_amt   = isset($_REQUEST['sel_amt']) ? $_REQUEST['sel_amt'] : array();
	  $dist_per   = isset($_REQUEST['dist_per']) ? $_REQUEST['dist_per'] : array();
	  $dist_amt   = isset($_REQUEST['dist_amt']) ? $_REQUEST['dist_amt'] : array();
	  $log_per   = isset($_REQUEST['log_per']) ? $_REQUEST['log_per'] : array();
      $eng_per   = isset($_REQUEST['eng_per']) ? $_REQUEST['eng_per'] : array();
      $log_amt   = isset($_REQUEST['log_amt']) ? $_REQUEST['log_amt'] : array();
      $eng_amt   = isset($_REQUEST['eng_amt']) ? $_REQUEST['eng_amt'] : array();
    //$log_eng_amt   = $_REQUEST['log_eng_total'];
      $com_per   = isset($_REQUEST['com_per']) ? $_REQUEST['com_per'] : array();
      $com_amt   = isset($_REQUEST['com_amt']) ? $_REQUEST['com_amt'] : array();
	 
	  $total_amt = isset($_REQUEST['col_item']) ? $_REQUEST['col_item'] : array();
      $net_amt   = isset($_REQUEST['total_item']) ? $_REQUEST['total_item'] : 0;
      $grand_amt = isset($_REQUEST['grand_total']) ? $_REQUEST['grand_total'] : 0;
    //gst calculations
      $gst_pers   = isset($_REQUEST['gst_per']) ? $_REQUEST['gst_per'] : array();
      $gst_amts   = isset($_REQUEST['gst_amt']) ? $_REQUEST['gst_amt'] : array();
      $igst_pers  = isset($_REQUEST['igst_per']) ? $_REQUEST['igst_per'] : array();
      $igst_vals  = isset($_REQUEST['igst_amt']) ? $_REQUEST['igst_amt'] : array();
      $mar_pper  = isset($_REQUEST['mar_pper']) ? $_REQUEST['mar_pper'] : 0;
      $mar_aamt  = isset($_REQUEST['mar_aamt']) ? $_REQUEST['mar_aamt'] : 0;
	//vendor selection
	  $vendor_name = isset($_REQUEST['vendor_name']) ? $_REQUEST['vendor_name'] : array();

	 if($business_id==1 || $business_id==3){
      $costsheet_date = date('Y-m-d', strtotime($costsheet_date_str));
	 }
    //Terms and conditions
	  $validity   = $_REQUEST['validity'];
      $payment   = $_REQUEST['payment'];
      $bank_name   = $_REQUEST['bank_name'];
      $account_no  = $_REQUEST['account_no'];
 
      $ifsc_code   = $_REQUEST['ifsc_code'];
      $important   = $_REQUEST['important'];
      $delivery   = $_REQUEST['delivery'];
      $warrenty   = $_REQUEST['warrenty'];
      $acc_hold_name   = $_REQUEST['acc_hold_name'];
      $branch_name   = $_REQUEST['branch_name'];
    //Business id create	
	if($business_id =='1'){
	 //$bussiness_type ="QSPLPR";
	 $bussiness_type ="SSPR";//product
    }elseif($business_id =='2'){
	//$bussiness_type ="QSPLSE";
	 $bussiness_type ="SSSE";//service
    }elseif($business_id =='3'){
	// $bussiness_type ="QSPLSL";
	 $bussiness_type ="SSSL";//solution
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
       //  echo "aaaaa";
		  $char = 'QOT';
	  //financial year	
	         $month =01;
	         $current_month = date('m');
	      if($current_month >= '01' && $current_month < '04')
		  {

				  if($month >= '01' && $month < '04'){
					 $nextyear = substr(date('Y'),-2);
					 $curyears = substr(date('Y'),-2); 
					 $curyear = $curyears-1; 
				} 

				  if($month >= '04'){
					 $nextyear = substr(date('Y')-1,-2);
					 $curyears = substr(date('Y'),-2); 
					 $curyear = $curyears-1; 
				}
	      } 

	     if($current_month >= '04')
		 {
				 if($month >= '04'){
				   $nextyears = substr(date('Y'),-2,+1);
				   $nextyear=$nextyears+1;
				   $curyears = substr(date('Y'),-2); 
				   $curyear = $curyears-1; 
			   }

				 if($month < '04'){
				   $nextyear = substr(date('Y')+1,-2);
					$curyears = substr(date('Y'),-2); 
			   }
	     }
	 
				 $nextyear; 
			//current year
				  $curyears = substr(date('Y'),-2); 

				 $finyear = $curyears.'-'.$nextyear; 
				 $char_str = 1;
				 $seq = 00001;
				 $costsheetno = sprintf("%05d", $seq);
				 $CS_NO = $bussiness_type.''.$costsheetno.'/'.$finyear.'/'.$char_str ;
				 //echo"ff";
				 //echo $CS_NO;

		}
		else
		{	 
	
	   //  
	
         $row_query = "SELECT * FROM cost_sheet_entry ORDER BY id DESC ";

         $query2 = $con->query($row_query);
         $query2->execute();
         $count = $query2->rowCount();
         $row = $query2->fetch();
         $row['cost_sheet_no'];
	    if (!empty($row['cost_sheet_no'])) {
		
		 $splite_val = explode("/",$row['cost_sheet_no']); 	
		 $no   =  $splite_val [0];
		 $char =  $splite_val [2];
	     $newchar= 1;
	     $month =01;
		 $current_month = date('m');
		 //$current_month = 05;
			if ($current_month >= '01' && $current_month < '04'){

			if ($month >= '01' && $month < '04'){
			   $nextyear = substr(date('Y'),-2);

			   
			   $curyear = substr(date('Y'),-2); echo "<br/>";
			   $curyear = $curyears-1; echo "<br/>";
			} 

			if ($month >= '04'){
			   $nextyear = substr(date('Y')-1,-2);
			   $curyears = substr(date('Y'),-2); echo "<br/>";
			}
			} 

			if ($current_month >= '04'){
			if ($month >= '04'){
			   $nextyears = substr(date('Y'),-2);
			   $nextyear = $nextyears+1;
			   $curyear = substr(date('Y'),-2); echo "<br/>";
			}

			if ($month < '04'){
			   $nextyears = substr(date('Y'),-2);
			   $nextyear = $nextyears+1;
			   $curyear = substr(date('Y'),-2); echo "<br/>";
			}
			}

		 $nextyear; 
	//current year
		// echo $curyear;
		 $finyear = $curyear.'-'.$nextyear; echo "<br/>";
			
			
		 $find_f = substr($row['cost_sheet_no'], 0, 6);
	     $find_fs = substr($row['cost_sheet_no'], 7, 4);
	     $bussiness_type ; echo "<br/>";
	
if (is_numeric($find_fs)) {
    $final_cost_no = str_pad($find_fs + 1, 5, 0, STR_PAD_LEFT);
} else {
	$final_cost_no=0;
  
}
	     $CS_NO = $bussiness_type.''.$final_cost_no.'/'.$finyear.'/'.$newchar;
	
	
	    }
							   
	}  
if($business_id==1){  //product quotation
			for($i=0;$i<$row_count;$i++)
					
			{
				
				$tot_items =$tot_item[$i];
				$product_ids          = $product_id[$i];
					$product_names          = $product_name[$i];
					$descriptions          = $description[$i];
					 $items          = $item[$i];
					 $hsn          = $hsn_code[$i];
					 $qtys           = $qty[$i];
					// $units          = $unit[$i];
					 $unit_rates     = $unit_rate[$i];
					 $totalPrices    = $total[$i];//qty*cost
					 $total_amts     = $total_amt[$i];//items total
			   //$net_amts       = $net_amt[$i];//netamount
					$sel_amts   = $sel_amt[$i];
					$dist_perss   = $dist_per[$i];
					$dist_amts   = $dist_amt[$i];
					$gst_per   = $gst_pers[$i];
					$gst_amt  = $gst_amts[$i];
					$igst_per  = $igst_pers[$i];
					$igst_val  = $igst_vals[$i];
					
					 $images = $_FILES["image"]["name"][$i];
					// echo  $filename;exit;
				  $tempname = $_FILES["image"]["tmp_name"][$i];    
				 
				  $folder = "uploads/".$images;
				  if (move_uploaded_file($tempname, $folder))  {
						$msg = "Image uploaded successfully";
					}else{
						$msg = "Failed to upload image";
				  }

			if($dist_perss!=''){
					 $dist_pers  = $dist_per[$i];
				  }else{
					 $dist_pers  ='0';
			}

					 $log_perss   = $log_per[$i];
					 $vendor=$vendor_name[$i];

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


       $filesArr3 = $_FILES["image"];



/* Quote upload */
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
                    if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath))
					{  
                        $uploadedFile .= $fileName; 
                     
                }
            }  
        }    
      
    
    
	


   $insert_query=$con->query("insert into cost_sheet_entry(cost_sheet_no,specification,qty,unit,unit_rate,sel_price,dist_per,dist_amt,log_per,log_amt,eng_per,eng_amt,com_per,com_amt,total_price,total_amt,net_amt,total_gst,grand_amt,gst_per,gst_amt,igst_per,igst_amount,mar_per,mar_amt,enquiry_id,client_id,quote_type,
  business_id,vendor_id,candid_id,costsheet_date,product_id,product_name,description,hsn,
  file_upload,status,flag,created_by,created_on) 
  values('$CS_NO','$product_names','$qtys','0','$unit_rates','$sel_amts','$dist_pers','$dist_amts','$log_pers','$log_amts','$eng_pers','$eng_amts',
  '$com_pers','$com_amts','$totalPrices','$total_amts','$net_amt','$tot_items','$grand_amt','$gst_per','$gst_amt','$igst_per','$igst_val','$mar_pper','$mar_aamt','$enquiry_idq','$client_id','$quote_type','$business_id','$vendor','$candidateid','$costsheet_date','$product_ids','$product_names','$descriptions','$hsn','$images','1','0','$candidateid',NOW())"); 

 
  $insertz_query=$con->query("Update enquiry set Product='$business_id',Call_type='$Call_type' where id='$enquiry_idq'"); 



  
      $insert_query1=$con->query("insert into terms_and_condition(cost_sheet_no,validity,payment,bank_name,branch_name,acc_holder_name,account_no,ifsc_code,important,delivery,warrenty) values('$CS_NO','$validity','$payment','$bank_name','$branch_name','$acc_hold_name','$account_no','$ifsc_code','$important','$delivery','$warrenty')");   
 
   /* echo "insert into terms_and_condition(cost_sheet_no,validity,payment,bank_name,account_no,
 ifsc_code,important,delivery,warrenty) 
  values('$CS_NO','$validity','$payment','$bank_name','$account_no','$ifsc_code','$important','$delivery','$warrenty')"; */

    } //forloop end for product 
 } //product if contion end section 
 
 
 else if($business_id==2) //service quotation create portion 
 {    $costsheet_date = date('Y-m-d', strtotime($costsheet_date_str));
	  $row_count_serv = count($_POST['service']);
	 for($i=0;$i<$row_count_serv;$i++)
					
			{
				$log_perss   = isset($log_per[$i]) ? $log_per[$i] : '';
					 $vendor= isset($vendor_name[$i]) ? $vendor_name[$i] : '';

				  if($log_perss!=''){
					 $log_pers  = $log_per[$i];
				  }else{
					 $log_pers  ='0';
			}

			$com_perss   = isset($com_per[$i]) ? $com_per[$i] : '';
			if($com_perss!=''){
			  $com_pers = $com_per[$i];
	 }else{
			  $com_pers = '0';
	 }	
				$service_id = $_POST['service'][$i];
				$manday = $_POST['manday'][$i];
				$no_of_days = $_POST['no_of_days'][$i];
				$hr_cost = $_POST['hr_cost'][$i];
				$admin_charges = $_POST['admin_charges'][$i];
				$total_serv = $_POST['total'][$i];
				$gst = $_POST['gst'][$i];
				$gst_amt = $_POST['gst_amt'][$i];
				$net_total = $_POST['net_total'][$i];
    
    
	


   $insert_query=$con->query("insert into cost_sheet_entry(cost_sheet_no,specification,qty,unit,unit_rate,sel_price,dist_per,dist_amt,log_per,log_amt,eng_per,eng_amt,com_per,com_amt,total_price,total_amt,net_amt,total_gst,grand_amt,gst_per,gst_amt,igst_per,igst_amount,mar_per,mar_amt,enquiry_id,client_id,quote_type,business_id,vendor_id,candid_id,costsheet_date,product_id,product_name,description,hsn,servtypeof_type,manday,no_of_days,hr_cost,admin_charges,servicetype_total,servicetype_gst,servicetype_gstamt,servicetype_net_total,file_upload,status,flag,created_by,created_on) 
   values('$CS_NO','$service_id','0','0','0','0','0','0','$log_pers','0','0','0','$com_pers','0','0','0','0','0','0','0','0','0','0','0','0','$enquiry_idq','$client_id','$quote_type','$business_id','$vendor','$candidateid','$costsheet_date','','','','','$service_id','$manday','$no_of_days','$hr_cost','$admin_charges','$total_serv','$gst','$gst_amt','$net_total','','1','0','$candidateid',NOW())"); 

 /*echo "insert into cost_sheet_entry(cost_sheet_no,specification,qty,unit,unit_rate,sel_price,dist_per,dist_amt,log_per,log_amt,eng_per,eng_amt,com_per,com_amt,total_price,total_amt,net_amt,total_gst,grand_amt,gst_per,gst_amt,igst_per,igst_amount,mar_per,mar_amt,enquiry_id,client_id,quote_type,business_id,vendor_id,candid_id,costsheet_date,product_id,product_name,description,hsn,servtypeof_type,manday,no_of_days,hr_cost,admin_charges,servicetype_total,servicetype_gst,servicetype_gstamt,servicetype_net_total,file_upload,status,flag,created_by,created_on) values('$CS_NO','$service_id','','0','','','','','$log_pers','','','','$com_pers','','','','','','','','','','','','','$enquiry_idq','$client_id','$quote_type','$business_id','$vendor','$candidateid','$costsheet_date','','','','','$service_id','$manday','$no_of_days','$hr_cost','$admin_charges ','$total','$gst','$gst_amt','$net_total','','1','0','$candidateid',NOW())";*/
 
  $insertz_query=$con->query("Update enquiry set Product='$business_id',Call_type='$Call_type' where id='$enquiry_idq'"); 



  
      $insert_query1=$con->query("insert into terms_and_condition(cost_sheet_no,validity,payment,bank_name,branch_name,acc_holder_name,account_no,
 ifsc_code,important,delivery,warrenty) values('$CS_NO','$validity','$payment','$bank_name','$branch_name','$acc_hold_name','$account_no','$ifsc_code','$important','$delivery','$warrenty')");   
 
   /* echo "insert into terms_and_condition(cost_sheet_no,validity,payment,bank_name,account_no,
 ifsc_code,important,delivery,warrenty) 
  values('$CS_NO','$validity','$payment','$bank_name','$account_no','$ifsc_code','$important','$delivery','$warrenty')"; */

    } //forloop end for service
 } // serveice if condtion end section 
	 
 else if($business_id==3)
 {
	 
	 
	 for($i=0;$i<$row_count;$i++)
					
			{
				
				$tot_items =$tot_item[$i];
				$product_ids          = $product_id[$i];
					$product_names          = $product_name[$i];
					$descriptions          = $description[$i];
					 $items          = $item[$i];
					 $hsn          = $hsn_code[$i];
					 $qtys           = $qty[$i];
					// $units          = $unit[$i];
					 $unit_rates     = $unit_rate[$i];
					 $totalPrices    = $total[$i];//qty*cost
					 $total_amts     = $total_amt[$i];//items total
			   //$net_amts       = $net_amt[$i];//netamount
					$sel_amts   = $sel_amt[$i];
					$dist_perss   = $dist_per[$i];
					$dist_amts   = $dist_amt[$i];
					$gst_per   = $gst_pers[$i];
					$gst_amt  = $gst_amts[$i];
					$igst_per  = $igst_pers[$i];
					$igst_val  = $igst_vals[$i];
					
					 $images = $_FILES["image"]["name"][$i];
					// echo  $filename;exit;
				  $tempname = $_FILES["image"]["tmp_name"][$i];    
				 
				  $folder = "uploads/".$images;
				  if (move_uploaded_file($tempname, $folder))  {
						$msg = "Image uploaded successfully";
					}else{
						$msg = "Failed to upload image";
				  }

			if($dist_perss!=''){
					 $dist_pers  = $dist_per[$i];
				  }else{
					 $dist_pers  ='0';
			}

					 $log_perss   = $log_per[$i];
					 $vendor=$vendor_name[$i];

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


       $filesArr3 = $_FILES["image"];



/* Quote upload */
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
                    if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath))
					{  
                        $uploadedFile .= $fileName; 
                     
                }
            }  
        }    
      
    
    
	


   $insert_query=$con->query("insert into cost_sheet_entry(cost_sheet_no,specification,qty,unit,unit_rate,sel_price,dist_per,dist_amt,log_per,log_amt,eng_per,eng_amt,com_per,com_amt,total_price,total_amt,net_amt,total_gst,grand_amt,gst_per,gst_amt,igst_per,igst_amount,mar_per,mar_amt,enquiry_id,client_id,quote_type,
  business_id,vendor_id,candid_id,costsheet_date,product_id,product_name,description,hsn,
  file_upload,status,flag,created_by,created_on) 
  values('$CS_NO','$product_names','$qtys','0','$unit_rates','$sel_amts','$dist_pers','$dist_amts','$log_pers','$log_amts','$eng_pers','$eng_amts',
  '$com_pers','$com_amts','$totalPrices','$total_amts','$net_amt','$tot_items','$grand_amt','$gst_per','$gst_amt','$igst_per','$igst_val','$mar_pper','$mar_aamt','$enquiry_idq','$client_id','$quote_type','$business_id','$vendor','$candidateid','$costsheet_date','$product_ids','$product_names','$descriptions','$hsn','$images','1','0','$candidateid',NOW())"); 

 
  $insertz_query=$con->query("Update enquiry set Product='$business_id',Call_type='$Call_type' where id='$enquiry_idq'"); 



  
      $insert_query1=$con->query("insert into terms_and_condition(cost_sheet_no,validity,payment,bank_name,branch_name,acc_holder_name,account_no,ifsc_code,important,delivery,warrenty) values('$CS_NO','$validity','$payment','$bank_name','$branch_name','$acc_hold_name','$account_no','$ifsc_code','$important','$delivery','$warrenty')");   
 
   /* echo "insert into terms_and_condition(cost_sheet_no,validity,payment,bank_name,account_no,
 ifsc_code,important,delivery,warrenty) 
  values('$CS_NO','$validity','$payment','$bank_name','$account_no','$ifsc_code','$important','$delivery','$warrenty')"; */

    } //forloop end for product 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 ////////////////////////////////service//////////////////////////
	 
	  $row_count_serv = count($_POST['service']);
	 for($i=0;$i<$row_count_serv;$i++)
					
			{
				
				$service_id = $_POST['service'][$i];
				$manday = $_POST['manday'][$i];
				$no_of_days = $_POST['no_of_days'][$i];
				$hr_cost = $_POST['hr_cost'][$i];
				$admin_charges = $_POST['admin_charges'][$i];
				$total_serv = $_POST['total'][$i];
				$gst = $_POST['gst'][$i];
				$gst_amt = $_POST['gst_amt'][$i];
				$net_total = $_POST['net_total'][$i];
    
    
	


   $insert_query=$con->query("insert into cost_sheet_entry(cost_sheet_no,specification,qty,unit,unit_rate,sel_price,dist_per,dist_amt,log_per,log_amt,eng_per,eng_amt,com_per,com_amt,total_price,total_amt,net_amt,total_gst,grand_amt,gst_per,gst_amt,igst_per,igst_amount,mar_per,mar_amt,enquiry_id,client_id,quote_type,business_id,vendor_id,candid_id,costsheet_date,product_id,product_name,description,hsn,servtypeof_type,manday,no_of_days,hr_cost,admin_charges,servicetype_total,servicetype_gst,servicetype_gstamt,servicetype_net_total,file_upload,status,flag,created_by,created_on) values('$CS_NO','$service_id','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','$enquiry_idq','$client_id','$quote_type','$business_id','$vendor','$candidateid','$costsheet_date','','','','','$service_id','$manday','$no_of_days','$hr_cost','$admin_charges','$total_serv','$gst','$gst_amt','$net_total','','1','0','$candidateid',NOW())"); 

 //echo "insert into cost_sheet_entry(cost_sheet_no,specification,qty,unit,unit_rate,sel_price,dist_per,dist_amt,log_per,log_amt,eng_per,eng_amt,com_per,com_amt,total_price,total_amt,net_amt,total_gst,grand_amt,gst_per,gst_amt,igst_per,igst_amount,mar_per,mar_amt,enquiry_id,client_id,quote_type,business_id,vendor_id,candid_id,costsheet_date,product_id,product_name,description,hsn,servtypeof_type,manday,no_of_days,hr_cost,admin_charges,servicetype_total,servicetype_gst,servicetype_gstamt,servicetype_net_total,file_upload,status,flag,created_by,created_on) values('$CS_NO','$service_id','','0','','','','','$log_pers','','','','$com_pers','','','','','','','','','','','','','$enquiry_idq','$client_id','$quote_type','$business_id','$vendor','$candidateid','$costsheet_date','','','','','$service_id','$manday','$no_of_days','$hr_cost','$admin_charges ','$total','$gst','$gst_amt','$net_total','','1','0','$candidateid',NOW())";
 
  $insertz_query=$con->query("Update enquiry set Product='$business_id',Call_type='$Call_type' where id='$enquiry_idq'"); 



  
      $insert_query_two=$con->query("insert into terms_and_condition(cost_sheet_no,validity,payment,bank_name,branch_name,acc_holder_name,account_no,
 ifsc_code,important,delivery,warrenty) values('$CS_NO','$validity','$payment','$bank_name','$branch_name','$acc_hold_name','$account_no','$ifsc_code','$important','$delivery','$warrenty')");   
 
   /* echo "insert into terms_and_condition(cost_sheet_no,validity,payment,bank_name,account_no,
 ifsc_code,important,delivery,warrenty) 
  values('$CS_NO','$validity','$payment','$bank_name','$account_no','$ifsc_code','$important','$delivery','$warrenty')"; */

    } //forloop end for service
 }
if($insert_query)
{
	if(isset($vendor_name) && is_array($vendor_name)) {
    $count = count($vendor_name);
    // Use $count here...
}

		if($count >= 1)
		{
				for($k=0;$k<$count;$k++)
		{
			$r=$k+1;
			$venins=$con->query("insert into costsheet_vendor_entries (costsheet_no,vendor_id,document,cost_price,status) values ('$CS_NO','$vendor_name[$k]','$fileNames[$k]','$amount[$k]',1)");
		}
		}
	else
	{
	for($i=0;$i<count($vendor_name);$i++)
    {
	$j=$i+1;
	$venins=$con->query("insert into costsheet_vendor_entries (costsheet_no,vendor_id,document,cost_price,status) values ('$CS_NO','$vendor_name[$i]','$fileNames[$i]','$amount[$i]',1)");
	//echo "insert into costsheet_vendor_entries (costsheet_no,vendor_id,document,cost_price,status) values ('$CS_NO','$vendor_name[$i]','$fileNames[$i]','$amount[$i]',1)";
      }
     }
}
 
}
/*
 $deatsils=$con->query("select e.company_name,e.client,zud.full_name, zud.candidate_id,cse.enquiry_id from cost_sheet_entry cse Join enquiry e on e.id = cse.enquiry_id JOIN z_user_master zud ON zud.candidate_id = cse.created_by WHERE cse.cost_sheet_no = '$cost_sheet_no'");*/
//echo $id;
	//$data=$deatsils->fetch(); 
	//$enquiry_id=$data['id'];
//	$client=$data['client'];
//$full_name=$data['full_name']; 
//$company_name=$data['company_name']; 
//$candidateid=$_SESSION['candidateid'];  
	
/*
echo $client;
echo $full_name;
echo $company_name;
echo $candidateid;
echo $mailerID;
//echo "antoo";
echo $enquiry_idq;
*/
//$date=$_REQUEST['date'];
$mail = new PHPMailer;
$mail->SMTPDebug = 0; 
$mail->Mailer = "smtp";
$mail->IsSMTP(true); 
$mail->Port = 587;
$mail->Host = 'webmail.quadsel.in';        
$mail->SMTPAuth = true;                              // Enable SMTP authentication
$mail->Username = 'hr@quadsel.in';
$mail->Password = 'Hr@2024#';                         // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->SMTPOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
		'allow_self_singed' => true,
    ]
];
$mail->From = 'hr@quadsel.in';		//Sets the From email address for the message
$mail->FromName = 'Recruitment Job Portal';
$mail->AddAddress($mailerID, $full_name);		//Adds a "To" address
// $mail->AddCC('ENTER MAIL ID');         //Adds a "CC" address.
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML


                                // Set email format to HTML
$subject="New Cost Sheet Generated..";			
	$html_table = 'Dear&nbsp;&nbsp;'.$full_name.'<br>
		&nbsp;&nbsp;	This Mail regarding your Cost sheet generated successfully...';
	
	$html_table .=' </table>';
	$html_table .=' <h4>Thanks & Regards,</h4><br>
	'.$full_name.'
	<p>Quadsel Systems Pvt. Ltd.</p>';
	$mail->Subject =$subject;
	$mail->Body =$html_table;
	

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
	echo "0";
} 
else {
    echo 'Message has been sent';
	echo "1";
}
     $insert_query2= $con->query("Update enquiry set status='4' where id='$enquiry_idq'");

	 if($insert_query2)
	 {
		 
		 echo 1;
		 
	 }
	 else{
		 echo 0;
	 }
							   							   
?> 
    
