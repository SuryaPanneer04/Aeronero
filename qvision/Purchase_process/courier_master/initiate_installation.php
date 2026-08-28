<?php
//initiate_installation status = 0   initial,

require '../../../connect.php';
include("../../../user.php");

require '../../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';


$candidateid = $_SESSION['candidateid'];

$id = $_REQUEST['challan_id'];
$confrmInstallation = $_REQUEST['conform'];

if($confrmInstallation == 1){ //Installation YES
	$status =5;
}
else if($confrmInstallation == 2){ //Installation NO
	$status =6;
}
$con->query("UPDATE challan_entry set status = '$status' where id ='$id'");


if($confrmInstallation == 1){
$remark = $_REQUEST['remark'];

$insert = $con->query("SELECT * FROM challan_entry where id ='$id'");
$chaln            =  $insert->fetch();	
$challan_id       =  $chaln['id'];
$cost_id       =  $chaln['customer_name'];
$pvm_id       =  $chaln['pvm_id'];
$invoice       =  $chaln['invoice_no'];
$so_number       =  $chaln['so_number'];

////////////////////////Insert query  for Ticket raise for Customize material after GRN Generate.///////////////////////////////
$insertTickets = $con->query("INSERT INTO `initiate_installation`( `cost_id`, `pvm_id`, `invoice_no`, `so_number`, `challan_id`, `remarks`, `status`, `created_by`, `created_on`) VALUES ('$cost_id','$pvm_id ','$invoice','$so_number ','$challan_id ','$remark', 0 ,'$candidateid',now())");

echo  "INSERT INTO `initiate_installation`( `cost_id`, `pvm_id`, `invoice_no`, `so_number`, `challan_id`, `remarks`, `status`, `created_by`, `created_on`) VALUES ('$cost_id','$pvm_id ','$invoice','$so_number ','$challan_id ','$remark', 0 ,'$candidateid',now())";

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
     &nbsp;&nbsp;	This email is about Installation of Material.';
 
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
?>