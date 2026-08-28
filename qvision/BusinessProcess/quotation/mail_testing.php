<?php
require 'PHPMailer/PHPMailerAutoload.php';
require 'class/class.phpmailer.php';

//gmail configuration

/* $mail = new PHPMailer;	
	$mail->SMTPDebug = 2; 
	$mail->Mailer = "smtp";
	$mail->IsSMTP(true);								//Sets Mailer to send message using SMTP
	//$mail->Host = 'mail2.ssinformation.in';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Host = 'webmail.quadsel.in';
	$mail->Port = '25';								//Sets the default SMTP server port
	//$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	//$mail->SMTPAutoTLS = false;

	//$mail->Username = 'antoajith2103@gmail.com';					//Sets SMTP username
	//$mail->Password = 'anto@21032000';					//Sets SMTP password
	$mail->Username = 'rajeshwari.s@quadsel.in';					//Sets SMTP username
	$mail->Password = 'Welcome@123';					//Sets SMTP password
	$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
	//$mail->SMTPSecure = true;							//Sets connection prefix. Options are "", "ssl" or "tls"
	//$mail->From = $from_id;			//Sets the From email address for the message
	$mail->From = 'rajeshwari.s@quadsel.in';			//Sets the From email address for the message
	$mail->FromName = 'Quotation from SS Information ';			//Sets the From name of the message
	$mail->AddAddress('rajeshwari.s@quadsel.in');		//Adds a "To" address
	//$mail->AddCC('test1@ssinformation.in');
	//$mail->AddBCC('laxmipriya@bluebase.in');
	
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
    $mail->Subject = 'Quotation gmail';			//Sets the Subject of the message
	$mail->Body = 'Please';
	
	
	  if(!$mail->send()) {
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
	   echo "0";
   }  */
   
   
   //internal mail configuration
   
   	 $mail = new PHPMailer;	
	$mail->SMTPDebug = 2; 
	$mail->Mailer = "smtp";
	$mail->IsSMTP(true);								//Sets Mailer to send message using SMTP
	$mail->Host = 'Webmail.quadsel.in';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	//$mail->Host = 'smtp.gmail.com';
	$mail->Port = '25';								//Sets the default SMTP server port
	$mail->SMTPAuth = false;							//Sets SMTP authentication. Utilizes the Username and Password variables
	//$mail->SMTPAutoTLS = false;

	//$mail->Username = 'antoajith2103@gmail.com';					//Sets SMTP username
	//$mail->Password = 'anto@21032000';					//Sets SMTP password
	$mail->Username = 'rajeshwari.s@quadsel.in';					//Sets SMTP username
	$mail->Password = 'Welcome@123';					//Sets SMTP password
	//$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->SMTPSecure = false;							//Sets connection prefix. Options are "", "ssl" or "tls"
	//$mail->From = $from_id;			//Sets the From email address for the message
	$mail->From = 'rajeshwari.s@quadsel.in';			//Sets the From email address for the message
	$mail->FromName = 'Quotation from SS Information ';			//Sets the From name of the message
	$mail->AddAddress('rajeshwari.s@quadsel.in' , $client_name);		//Adds a "To" address
	$mail->AddCC('rajeshwari.s@quadsel.in');
	//$mail->AddBCC('laxmipriya@bluebase.in');
	
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
    $mail->Subject = 'Internal';			//Sets the Subject of the message
	$mail->Body = 'Please Find Quote / Proposal Report in attach PDF File.';				//An HTML or plain text message body
	
   if(!$mail->send()) {
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
	   echo "0";
   } 
   
   
   //ssinformation
   
 /*   $mail = new PHPMailer;	
	$mail->SMTPDebug = 2; 
	$mail->Mailer = "smtp";
	$mail->IsSMTP(true);								//Sets Mailer to send message using SMTP
	$mail->Host = 'mail2.ssinformation.in';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	//$mail->Host = 'smtp.gmail.com';
	$mail->Port = '587';								//Sets the default SMTP server port
	$mail->SMTPAuth = false;							//Sets SMTP authentication. Utilizes the Username and Password variables
	//$mail->SMTPAutoTLS = false;

	//$mail->Username = 'antoajith2103@gmail.com';					//Sets SMTP username
	//$mail->Password = 'anto@21032000';					//Sets SMTP password
	$mail->Username = 'test2@ssinformation.in';					//Sets SMTP username
	$mail->Password = 'gA952Hfj3K';					//Sets SMTP password
	//$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->SMTPSecure = false;							//Sets connection prefix. Options are "", "ssl" or "tls"
	//$mail->From = $from_id;			//Sets the From email address for the message
	$mail->From = 'test2@ssinformation.in';			//Sets the From email address for the message
	$mail->FromName = 'Quotation from SS Information ';			//Sets the From name of the message
	$mail->AddAddress('test2@ssinformation.in' , $client_name);		//Adds a "To" address
	$mail->AddCC('test2@ssinformation.in');
	//$mail->AddBCC('laxmipriya@bluebase.in');
	
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
    $mail->Subject = 'Internal';			//Sets the Subject of the message
	$mail->Body = 'Please Find Quote / Proposal Report in attach PDF File.';				//An HTML or plain text message body
	
   if(!$mail->send()) {
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
	   echo "0";
   }
    */
   
?>