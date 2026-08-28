<?php
require '../../../connect.php'; 
require '../../../user.php'; 
require '../../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';
$user_id =$_SESSION['userid'];
$user_role =$_SESSION['userrole'];
 $candidateid=$_SESSION['candidateid'];
//$id=$_REQUEST['get_id'];
  $cost_sheet_no = $_REQUEST['id']; 
  $enquiry_id    = $_REQUEST['enquiry_id'];
 $old_quote_no = $_REQUEST['old_quote_no'];
  $business_id = $_REQUEST['business_id'];
  $costsheet_id = $_REQUEST['costsheet_id'];

//  $full_name = $_REQUEST['full_name'];
//echo $user_id;echo '****';
//echo '****';
//echo $candidateid; echo '****'; 
   //$row_query = "SELECT * FROM quote_generate";
  $stmt = $con->prepare ("sELECT e.client,e.company_name,e.mail,cse.client_id,zum.full_name,zum.user_name FROM cost_sheet_entry cse 
INNER JOIN enquiry e on e.id=cse.enquiry_id INNER JOIN z_user_master zum ON zum.candidate_id=e.created_by where cse.cost_sheet_no='$cost_sheet_no' and e.id='$enquiry_id'");
 
 $query_select = $con->query("sELECT e.client,e.company_name,e.mail,cse.client_id,zum.full_name,zum.user_name FROM cost_sheet_entry cse 
INNER JOIN enquiry e on e.id=cse.enquiry_id INNER JOIN z_user_master zum ON zum.candidate_id=e.created_by where cse.cost_sheet_no='$cost_sheet_no' and e.id='$enquiry_id'");
 echo "sELECT e.client,e.company_name,e.mail,cse.client_id,zum.full_name,zum.user_name FROM cost_sheet_entry cse 
INNER JOIN enquiry e on e.id=cse.enquiry_id INNER JOIN z_user_master zum ON zum.candidate_id=e.created_by where cse.cost_sheet_no='$cost_sheet_no' and e.id='$enquiry_id'";
 $stmt->execute();
 $row_val = $stmt->fetch();
 $query = $query_select->fetch();
 $row_query = "SELECT * FROM quote_generate";

 $queryz = $con->query($row_query);
 $queryz->execute();
 $count   = $queryz->rowCount();

 /* 
 
 SELECT qg.cost_sheet_no,e.company_name,e.client,e.mail,zum.full_name,zum.user_name,zum.candidate_id FROM `quote_generate` qg
JOIN enquiry e on qg.created_by = e.created_by
JOIN z_user_master zum WHERE zum.candidate_id = e.created_by and qg.cost_sheet_no ='$cost_sheet_no'"); */
  
 
 /*  $deatsils=$con->query("SELECT qg.cost_sheet_no,e.company_name,e.client,e.mail,zum.user_name,zum.candidate_id FROM `quote_generate` qg
JOIN enquiry e on qg.created_by = e.created_by
JOIN z_user_master zum WHERE zum.candidate_id = e.created_by and qg.cost_sheet_no ='$cost_sheet_no'");

	$data=$deatsils->fetch();
	//$enquiry_id=$data['id'];
	$client=$data['client'];
	$full_name=$data['full_name']; echo $full_name;
	$company_name=$data['company_name']; 
	$candidateid=$_SESSION['candidateid']; */
	
	//$data=$deatsils->fetch();
	//$enquiry_id=$data['id'];
	$client=$query['client'];echo $client;echo '**$**';
	$full_name=$query['full_name']; echo $full_name;echo '**#**';
	$user_name=$query['user_name']; echo $user_name;echo '**%**';
	$mailerID=$query['mail']; echo $mailerID;
	$company_name=$query['company_name']; echo $company_name;echo '**@**';
	$candidateid=$_SESSION['candidateid'];
	
	echo $user_name;
	//echo"Anto";
if($count == 0)
	
{   
   echo"1";

        $char = 'QOT';
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
	$char_str = '1';
	//for($n=0; $n<26; $n++) {
       //echo +$char_str;
    //}
    $seq = 00001;
    $quoteno = sprintf("%05d", $seq);
      //$QUOTE_NO = $char.''.$finyear.''.$quoteno.'/'.$char_str;
     $QUOTE_NO = $char.''.$current_month.'/'.$finyear.'/'.$quoteno.'/'.$char_str;
	
    }else{	
       
  if($old_quote_no!=''){
	 
	    $row_query = "SELECT * FROM quote_generate where quote_no ='$old_quote_no' ";
		//echo "SELECT * FROM quote_generate where quote_no ='$old_quote_no' ";
	   $query2 = $con->query($row_query);
		 $query2->execute();
		 $count = $query2->rowCount();
		 $row = $query2->fetch();
		 $row['quote_no'];
			 if (!empty($row['quote_no'])) {
				
				$splite_val = explode("/",$row['quote_no']); 	
				  $no   =  $splite_val [0];
				  $no2   =  $splite_val [1];
				  $no3 =  $splite_val [2];
				  $char =  $splite_val [3];
				  $newchar = ++$char;
			 echo  $QUOTE_NO =  $no.''.'/'.$no2.'/'.$no3.'/'.$newchar;
			 } 
  }else{
	  	 
       echo"2";echo '**@@**';
		$row_query = "SELECT quote_no FROM quote_generate ORDER BY id DESC ";
     
		 $query2 = $con->query($row_query);
		 $query2->execute();
		 $count = $query2->rowCount();
		 $row = $query2->fetch();
		 echo $row['quote_no'];
		 
		
		 if (!empty($row['quote_no'])) {
				
				 $splite_val = explode("/",$row['quote_no']); 	
				 $no     =  $splite_val [0];
				 $no2   =  $splite_val [1];
				 //echo $char =  $splite_val [1];
				 $char = '1';
				
				
			 $char = 'QOT';
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
				$char_str = '1';	
				
				
			  // $result = preg_split('/[-_]/', $number);
			    $find_f = substr($row['quote_no'], 0, 7);echo "<br/>";
			    $find_fs = substr($row['quote_no'], 12, 5);echo "<br/>";
			  
			 // echo  $a = sprintf("%05d", $find_fs);echo "<br/>";
			    $final_quote_no = str_pad($find_fs +1, 5, 0, STR_PAD_LEFT);echo "<br/>";
			  //echo $last_quote_no = $find_fs;echo "<br/>";
			 //echo  $final_quote_no = ++$final_no;echo "<br/>";
			 //echo $QUOTE_NO = $find_f .$final_quote_no.'/'.$char;
			 //echo  $QUOTE_NO = $no2.'/'.$final_quote_no.'/'.$char;
			  echo  $QUOTE_NO =  $char.''.$current_month.'/'.$finyear.'/'.$final_quote_no.'/'.$char_str;
			 } 
			 } else {
    // DB-la entha quote-um illana, first quote number generate panna
    $char = 'QOT';
    $current_month = date('m');
    
    // Financial year logic
    $month = 01;
    if ($current_month >= '01' && $current_month < '04'){
        $nextyear = ($month >= '01' && $month < '04') ? substr(date('Y'),-2) : substr(date('Y')-1,-2);
    } else {
        $nextyear = ($month >= '04') ? substr(date('Y'),-2) : substr(date('Y')+1,-2);
    }
    
    $curyear = substr(date('Y'),-2); 
    $finyear = $curyear.'-'.$nextyear; 
    
    // First sequence number
    $seq = 1;
    $final_quote_no = sprintf("%05d", $seq);
    $char_str = '1';
    
    $QUOTE_NO =  $char.''.$current_month.'/'.$finyear.'/'.$final_quote_no.'/'.$char_str;
}
}




 $date = date('Y-m-d');

// Removed the count() and for loop. Directly updating the cost_sheet_no
$update_query = $con->query("update cost_sheet_entry set approved_by ='$candidateid', status ='2',modified_by ='$candidateid',modified_on =NOW() WHERE cost_sheet_no= '$cost_sheet_no'");

$insert_query2= $con->query("Update enquiry set status='5',approved_by ='$candidateid' where id='$enquiry_id'");
echo "Update enquiry set status='5',approved_by ='$candidateid' where id='$enquiry_id'";
/* $row_query = "SELECT qg.cost_sheet_no,e.company_name,e.client,e.mail,zum.full_name,zum.user_name,zum.candidate_id FROM `quote_generate` qg
JOIN enquiry e on qg.created_by = e.created_by
JOIN z_user_master zum WHERE zum.candidate_id = e.created_by and qg.cost_sheet_no ='$cost_sheet_no'"; */


 $row_query = "SELECT * FROM quote_generate where  cost_sheet_id ='$costsheet_id' ";



 $query2 = $con->query($row_query);
 $query2->execute();
 $quote_count = $query2->rowCount();
 $row = $query2->fetch();
 
 
 if($quote_count!=="")
 
 {
  $insert_query=$con->query("insert into quote_generate(quote_no,cost_sheet_no,quote_date,status,created_by,created_on) 
  values('$QUOTE_NO','$cost_sheet_no','$date','1','$candidateid',NOW())");     
   echo "insert into quote_generate(quote_no,cost_sheet_no,quote_date,status,created_by,created_on) 
  values('$QUOTE_NO','$cost_sheet_no','$date','1','$candidateid',NOW())";
   $update_query =$con->query("update quote_generate set status ='3' where quote_no ='$old_quote_no'");
   echo "update quote_generate set status ='3' where quote_no ='$old_quote_no'";
  
 }


 else{
	   $insert_query=$con->query("insert into quote_generate(quote_no,cost_sheet_no,quote_date,status,created_by,created_on) 
  values('$QUOTE_NO','$cost_sheet_no','$date','2','$candidateid',NOW())"); 
	
 } 
 

 
//$date=$_REQUEST['date'];
$mail = new PHPMailer;
$mail->SMTPDebug = 2; 
$mail->Mailer = "smtp";
$mail->IsSMTP(true); 
$mail->Port = 587;
$mail->Host = 'webmail.quadsel.in';        
$mail->SMTPAuth = true;                              // Enable SMTP authentication
$mail->Username = 'quote@quadsel.in';
$mail->Password = 'Q@2023';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->SMTPOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
		'allow_self_singed' => true,
    ]
];
$mail->From = 'quote@quadsel.in';
$mail->FromName = 'Quote Generate Alert....';
$mail->AddAddress($user_name, $client);
//$mail->AddAddress("subramanian.r@bluebase.in");		//Adds a "To" address
//$mail->addAddress("laxmipriya@bluebase.in");     // Add a recipient
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML
$subject="Cost Sheet approved by Head..";			
	$html_table = 'Dear&nbsp;&nbsp;'.$client.',<br> 
		&nbsp;&nbsp;	This Mail regarding your Cost sheet approved ';
		
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

?>  







