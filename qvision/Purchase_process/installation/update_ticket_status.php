<?php
//initiate_installation initial status =0,
//initiate_installation Employee Assign status =1,
//initiate_installation Employee Upload report  status =2,


require '../../../connect.php';
require '../../../user.php';

require '../../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';


$candidateid = $_SESSION['candidateid']; //Candidate Id From Session.

$taskid = $_REQUEST['taskid']; //Ticket Id.
$csId = $_REQUEST['csId']; //costSheet Id.
// $purchaseId = $_REQUEST['purchaseId']; //costSheet Id.

$filename = $_FILES["report_upload"]["name"];
$tempname = $_FILES["report_upload"]["tmp_name"];    
$folder = "installation_report/".$filename;

$update_sts = $con->query("UPDATE initiate_installation SET report_upload_file='$filename' , status= 2 WHERE id='$taskid'"); //Customization Completed  /// Status = 2 ////

$installationas = $con -> query("SELECT * FROM `initiate_installation` WHERE `id`='$taskid'");
$install = $installationas->fetch();
$cost_id = $install['cost_id'];
$pvm_id = $install['pvm_id'];
$invoice_no = $install['invoice_no'];
$challan_id = $install['challan_id'];

$warranty = $con->query("INSERT INTO `warranty_support`( `installation_id`, `invoice_no`, `cost_id`, `pvm_id`, `challan_id`) VALUES ('$taskid','$invoice_no','$cost_id','$pvm_id','$challan_id')");

echo "INSERT INTO `warranty_support`( `installation_id`, `invoice_no`, `cost_id`, `pvm_id`, `challan_id`) VALUES ('$taskid','$invoice_no','$cost_id','$pvm_id','$challan_id')";

if($update_sts && $warranty)
{

	if (move_uploaded_file($tempname, $folder))  {
		$msg = "Image uploaded successfully";
	}else{
		$msg = "Failed to upload image";
  }

	$employee_name = $con->query("select a.emp_name,b.designation_name from staff_master a left join designation_master b on a.dep_id = b.id where a.candid_id= '$candidateid' ");
    $empDetails = $employee_name -> fetch();
    $empName = $empDetails['emp_name'];
    $desgnName = $empDetails['designation_name'];

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
	 &nbsp;&nbsp;	This email is about Completion of Customization of Material as per PO.';
 
	 $html_table .=' <h4 style="margin-bottom:0px">Thanks & Regards,</h4><br>'. $empName .'
	 <br>'. $desgnName .'<br>
	 <p style="margin-bottom:0px"> SS Information </p>';
 
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
else{
    echo "0";
}
?>