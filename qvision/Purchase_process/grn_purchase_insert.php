<?php
//purchase_generate status = 1 ... initial 
//purchase_generate status = 2.... after finance approve.


require '../../connect.php'; 
require '../../user.php'; 

require '../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

 $user_id = $_SESSION['userid'];
 $candidateid = $_SESSION['candidateid']; 

 
$uploadDir = 'uploads/'; 
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 


if( isset($_POST['cs_id']) || isset($_POST['vendor']) || isset($_POST['rqst']) || isset($_POST['receive']) ||  isset($_POST['pvm_id']) ||  isset($_POST['serialnumber']) ) {
								   
							     
    // Get the submitted form data 
     $rqst = $_POST['rqst']; 
     $receive = $_POST['receive']; 
     $vendor = $_POST['vendor']; 
     $cs_id = $_POST['cs_id']; 
     $serial = $_POST['serialnumber']; 
     $pvm_id = $_POST['pvm_id']; 
     $purchase_invoice_no = $_POST['purchase_invoice_no']; 
     $purchase_invoice_date = $_POST['purchase_invoice_date']; 
     $Customization = $_POST['Customization']; 
     $remark = $_POST['remark']; 
     $grn_ID = $_POST['grn_ID']; 

    //  $grn_entry_id = $_POST['chk']; 
	// $grnId = '';
    //  foreach($grn_entry_id as $id){
    //     $con->query("UPDATE `grn_entry` SET `status`=2 WHERE id='$id'");
    //     $grnId .= $id.','; 
    //  }

    $images = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];    
    $folder = "uploads/".$images;
  if (move_uploaded_file($tempname, $folder))  {
          $msg = "Image uploaded successfully";
      }else{
          $msg = "Failed to upload image";
    }

if($Customization == 1){ // 1 = customization yes
    $status = 0;
}else{
    $status = 1;
}

$con->query("INSERT INTO `purchase_generate`( `cost_sheets_id`, `purchase_id`, `req_qty`, `rec_qty`,`grn_id`,  `vendor_id`, `status`, `purchase_invoice_no`, `purchase_invoice_date`, `purchase_invoice_upload`, `customization`, `remark`) VALUES ('$cs_id','$pvm_id','$rqst','$receive','$grn_ID','$vendor','$status','$purchase_invoice_no','$purchase_invoice_date','$images','$Customization','$remark') ");

$grngen = $con->query("update grn_generate set status='2' where id='$grn_ID'");
	  
$change = $rqst-$receive;
if($change==0){
	
	$poUpdate = $con->query("update purchase_vendor_master set status='3' where id='$pvm_id'");
}

if($Customization == 1){
   //// Ticket for Material custmization against PO ////////
   $po_details = $con->query("select * from purchase_vendor_master where id='$pvm_id' ");
   $po = $po_details -> fetch();

   $costSheetId = $po['cost_sheet_id'];
   $costSheetNo = $po['cost_sheet_no'];
   $soNo = $po['so_number'];

   /////MAX id of purchase_generate//////////////////
   $tables_data="select MAX(id) as ids from purchase_generate";
			
   $sss=$con->query($tables_data);
   $rowx=$sss->fetch();
   $max_id=$rowx['ids'];

   ////////////////////////Insert query  for Ticket raise for Customize material after GRN Generate.///////////////////////////////
   $insertTickets = $con->query("INSERT INTO `po_ticket`( `cost_sheet_no`, `cost_sheet_id`, `so_number`,`po_invoice`, `purchase_generate_id`, `status`, `created_by`, `created_on`) VALUES ('$costSheetNo','$costSheetId ','$soNo','$remark','$max_id', 0 ,'$candidateid',now() )"); 

   if($insertTickets){

    /////////////////////// Mail send to HOD to know the GRN Generated for the material and ready to customization. ///////////////////////
    $staff_query= $con->query("SELECT a.`full_name`,a.`email_id` FROM `z_user_master` a left join staff_master b on a.candidate_id = b.candid_id where b.dep_id =2 && b.head_status=1");  
    $staff_query->execute(); 
    
      $row            =  $staff_query->fetch();	
      $FULLNAME       =  $row['full_name'];
      $SENDMAIL       =  $row['email_id'];
      
    $mail = new PHPMailer;
    $mail->SMTPDebug = 2; 
    $mail->Mailer = "smtp";
    $mail->IsSMTP(true); 
    $mail->Port = 587;
    $mail->Host = 'mail2.ssinformation.in';        
    $mail->SMTPAuth = true;                              // Enable SMTP authentication
    $mail->Username = 'test1@ssinformation.in';
    $mail->Password = 'dqR8mdSzsb';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        'allow_self_singed' => true,
        ]
    ];
    $mail->From = 'test1@ssinformation.in';		//Sets the From email address for the message  
    $mail->FromName = 'SSINFORMATION';
    $mail->AddAddress($SENDMAIL, $FULLNAME);		//Adds a "To" address    
    $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
    $mail->isHTML(true);                                 // Set email format to HTML
    
    $subject="Regarding Customization of Material";
    $html_table = 'Dear &nbsp;&nbsp;' . $FULLNAME . ',  <br> 
        &nbsp;&nbsp;	This email is about Customization of Material as per PO.';
    
    $html_table .=' <h4 style="margin-bottom:0px">Thanks & Regards,</h4><br>
      <p style="margin-bottom:0px">SS Information </p>';
    
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

   }
}


	
}
