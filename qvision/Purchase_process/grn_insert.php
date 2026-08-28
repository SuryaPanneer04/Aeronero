<?php

//GRN Entry status = 1 ... initial 
//GRN status = 2.... after add to purchase.

require '../../connect.php'; 
require '../../user.php'; 

// require '../../PHPMailer/PHPMailerAutoload.php';
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// require '../../PHPMailer/src/Exception.php';
// require '../../PHPMailer/src/PHPMailer.php';
// require '../../PHPMailer/src/SMTP.php';

 $user_id = $_SESSION['userid'];
 $candidateid = $_SESSION['candidateid']; 

 
$uploadDir = 'uploads/'; 
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 


if(isset($_POST['proname']) || isset($_POST['specification'])  || isset($_POST['cs_id']) || isset($_POST['vendor']) || isset($_POST['rqst']) || isset($_POST['receive']) ||  isset($_POST['pvm_id']) ||  isset($_POST['serialnumber']) ){
								   
							     
    // Get the submitted form data 
     $proname = $_POST['proname']; 
     $specification = $_POST['specification']; 
     $rqst = $_POST['rqst']; 
     $receive = $_POST['receive']; 
     $vendor = $_POST['vendor']; 
     $cs_id = $_POST['cs_id']; 
     $serial = $_POST['serialnumber']; 
     $pvm_id = $_POST['pvm_id']; 
	 
	  $row_count= count($serial);

  //   $images = $_FILES["image"]["name"];

  //   $tempname = $_FILES["image"]["tmp_name"];    
   
  // $folder = "uploads/".$images;
  // if (move_uploaded_file($tempname, $folder))  {
  //         $msg = "Image uploaded successfully";
  //     }else{
  //         $msg = "Failed to upload image";
  //   }
	  
$change=$rqst-$receive;
// if($change==0){
	
	 $poUpdate = $con->query("update purchase_vendor_master set status='7' where id='$pvm_id'");
	// $poUpdate = $con->query("update purchase_vendor_master set status='3' where id='$pvm_id'");
	 
// if($poUpdate){
//    //// Ticket for Material custmization against PO ////////
//    $po_details = $con->query("select * from purchase_vendor_master where id='$pvm_id' ");
//    $po = $po_details -> fetch();

//    $costSheetId = $po['cost_sheet_id'];
//    $costSheetNo = $po['cost_sheet_no'];
//    $soNo = $po['so_number'];

//    ////////////////////////Insert query  for Ticket raise for Customize material after GRN Generate.///////////////////////////////
//    $insertTickets = $con->query("INSERT INTO `po_ticket`( `cost_sheet_no`, `cost_sheet_id`, `so_number`,`po_invoice`, `status`, `created_by`, `created_on`) VALUES ('$costSheetNo','$costSheetId ','$soNo','$images', 0 ,'$candidateid',now() )"); 

//    if($insertTickets){

//     /////////////////////// Mail send to HOD to know the GRN Generated for the material and ready to customization. ///////////////////////
//     $staff_query= $con->query("SELECT a.`full_name`,a.`email_id` FROM `z_user_master` a left join staff_master b on a.candidate_id = b.candid_id where b.dep_id =2 && b.head_status=1");  
//     $staff_query->execute(); 
    
//       $row            =  $staff_query->fetch();	
//       $FULLNAME       =  $row['full_name'];
//       //$SENDMAIL       =  $row['email_id'];
//       $SENDMAIL       =  'rabi.p@bluebase.in';
      
//     $mail = new PHPMailer;
//     $mail->SMTPDebug = 2; 
//     $mail->Mailer = "smtp";
//     $mail->IsSMTP(true); 
//     $mail->Port = 587;
//     $mail->Host = 'mail2.ssinformation.in';        
//     $mail->SMTPAuth = true;                              // Enable SMTP authentication
//     $mail->Username = 'test1@ssinformation.in';
//     $mail->Password = 'dqR8mdSzsb';                           // SMTP password
//     $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
//     $mail->SMTPOptions = [
//         'ssl' => [
//             'verify_peer' => false,
//             'verify_peer_name' => false,
//         'allow_self_singed' => true,
//         ]
//     ];
//     $mail->From = 'test1@ssinformation.in';		//Sets the From email address for the message  
//     $mail->FromName = 'SSINFORMATION';
//     $mail->AddAddress($SENDMAIL, $FULLNAME);		//Adds a "To" address    
//     $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//     $mail->isHTML(true);                                 // Set email format to HTML
    
//     $subject="Regarding Customization of Material";
//     $html_table = 'Dear &nbsp;&nbsp;' . $FULLNAME . ',  <br> 
//         &nbsp;&nbsp;	This email is about Customization of Material as per PO.';
    
//     $html_table .=' <h4 style="margin-bottom:0px">Thanks & Regards,</h4><br>
//       <p style="margin-bottom:0px">SS Information </p>';
    
//     $mail->Subject =$subject;
//     $mail->Body =$html_table;
    
//     if(!$mail->send()) {
//         echo 'Message could not be sent.';
//         echo 'Mailer Error: ' . $mail->ErrorInfo;
//         echo "0";
//     } 
//     else {
//         echo 'Message has been sent';
//         echo "1";
//     } 

//    }
// }

// }
			 
	
	$insert_query=$con->query("insert into grn_generate(cost_sheets_id,purchase_id,products,spec,req_qty,rec_qty,vendor_id,status,created_on) values('$cs_id','$pvm_id','$proname','$specification','$rqst','$receive','$vendor','1',NOW())");

  echo "insert into grn_generate(cost_sheets_id,purchase_id,products,spec,req_qty,rec_qty,vendor_id,status,created_on) values('$cs_id','$pvm_id','$proname','$specification','$rqst','$receive','$vendor','1',NOW())";

  /* echo "insert into grn_generate(cost_sheets_id,purchase_id,products,spec,req_qty,rec_qty,vendor_id,status,created_on) 
  values('$cs_id','$proname','$specification','$rqst','$receive','$vendor','1',NOW())"; */
  
  /* $inserz_query=$con->query("insert into challan_entry(cost_sheets_id,products,spec,rec_qty,vendor_id,status,created_on) 
  values('$cs_id','$proname','$specification','$receive','$vendor','1',NOW())"); */
  
  
  $row_query = "SELECT 1 FROM grn_entry";

       $query = $con->query($row_query);
       $query->execute();
       $count = $query->rowCount();
 $bussiness_type ="GRN";
	if($count == 0)
	{
		
	  $char = 'QOT';

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

	     $finyear = $curyear.'-'.$nextyear;
	     $char_str = 'A';
         $seq = 00001;
         $costsheetno = sprintf("%05d", $seq);
         $GRN_NO = $bussiness_type.''.$costsheetno.'/'.$finyear.'/'.$char_str ;
	
    }else{	 
         $row_query = "SELECT grn_number FROM grn_entry ORDER BY id DESC ";
   	
         $query2 = $con->query($row_query);
         $query2->execute();
         $count = $query2->rowCount();
         $rowx = $query2->fetch();
       
	  if (!empty($rowx['grn_number'])) {
		
		 $splite_val = explode("/",$rowx['grn_number']); 	
		 $no   =  $splite_val [0];echo "<br/>";
		 $no2 =  $splite_val [1];
		 $char =  $splite_val [2];
	     $newchar= $char;
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

		 $finyear = $curyear.'-'.$nextyear; 
			
		 $find_f = substr($rowx['grn_number'], 0,3);
	     $find_fs = substr($rowx['grn_number'], 4, 4);
	     $final_cost_no = str_pad($find_fs + 1, 5, 0, STR_PAD_LEFT); 
	     $GRN_NO = $bussiness_type.''.$final_cost_no.'/'.$finyear.'/'.$newchar;
		
	    }
	}
	
	for($i=0;$i<$row_count;$i++)		
	{

	$serials  = $serial[$i];
	
	
		
		if($insert_query){
			
			$tables_data="select MAX(id) as ids from grn_generate";
			
			$sss=$con->query($tables_data);
			$rowx=$sss->fetch();
            $max_id=$rowx['ids'];

			$insert_sql=$con->query("insert into grn_entry(grn_id,cs_id,grn_number,pro_name,serial_no,vendor_id,status,created_by,created_on) 
  values('$max_id','$cs_id','$GRN_NO','$proname','$serials','$vendor','1','$candidateid',NOW())");
  
  echo "<br>","insert into grn_entry(grn_id,cs_id,grn_number,pro_name,serial_no,vendor_id,status,created_by,created_on) 
  values('$max_id','$cs_id','$GRN_NO','$proname','$serials','$vendor','1','$candidateid',NOW())","<br>";

//   echo "insert into grn_entry(grn_id,cs_id,grn_number,serial_no,vendor_id,status,created_by,created_on) values('$max_id','$cs_id','$CS_NO','$serials','$vendor','1','$candidateid',NOW())";

		}

 
	}
	
}
?> 
    
