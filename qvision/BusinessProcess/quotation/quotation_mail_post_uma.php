<?php
require '../../../connect.php';
require '../../../user.php';
require 'PHPMailer/PHPMailerAutoload.php';
require 'class/class.phpmailer.php';
include ('pdf.php');
//$file_name = md5(rand()) . '.pdf';
$vendor_id = $_REQUEST['id'];

$count = sizeof($vendor_id);

// Create a function for converting the amount in words
function AmountInWords($amount)
{
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
   $amt_hundred = null;
   $count_length = strlen($num);
   $x = 0;
   $string = array();
   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $x < $count_length ) {
      $get_divider = ($x == 2) ? 10 : 100;
      $amount = floor($num % $get_divider);
      $num = floor($num / $get_divider);
      $x += $get_divider == 10 ? 1 : 2;
      if ($amount) {
       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
        }
   else $string[] = null;
   }
   $implode_to_Rupees = implode('', array_reverse($string));
   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
   return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}
?>
<style>
.row1{
	 border:1px solid black;
}
.row2{
   height: 6px;
}
.table>tbody>tr>th{
	 width:700px;
}
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
     padding: 4px;
    border: none;
}

.border>tbody>tr>td, .border>tbody>tr>th, .border>tfoot>tr>td, .border>tfoot>tr>th, .border>thead>tr>td, .border>thead>tr>th {
    
   border :1px  solid  black;
}
.m_b_0px {
	margin-bottom: 0px !important;
}
</style>
<?php 
class fetch_data{
 public $vendor_id;
	function fetch_quote_data($con,$vendor_id,$client_name,$QuoteNo){ 
	
$stmt= $con->query("SELECT a.id as quote_id,a.*,b.*,c.*,e.*,d.* from quotation_entry a 
		 inner join client_master b on(b.id=a.client_id) 
		 inner join doller_vendor_mastor c on(c.id=a.vendor_id)
		 inner join company_master d on(d.id=a.company_id)
		 inner join emp_personal_details e on(e.emp_id=a.candid_id) where a.status ='1' and a.vendor_id='$vendor_id'");
	
		$stmt->execute(); 
		$row        = $stmt->fetch();
		$company_id = $row['company_id'];
		
		$quote_date = date('d-m-Y', strtotime($row['quote_date']));
		if($row['quote_type']==1){  
		   $currency = "INDIAN RUPEES"; 
		}else{ 
		   $currency = "DOLLAR RUPEES"; 
		}
		$QuoteNo = $row['quote_no'];
	   
 $output = ' <div class="col-sm-12">
        <table width="1000px" style="text-align:left; border: none;">
		   <tr><td colspan="5"><img src="../../Recruitment/image/userlog/quadsel.png" alt="quadsel" width=200px; height=100px;><br/></br>
		    <h4 align="center"><b>QUOTATION</b></h4> </td>
		   </tr>
		</table>
	 <TABLE width="1000px" style="padding: 4px;border :none"> 
		<tr style="border :1px  solid  black;"> 
		  <td colspan="3" style="border :1px  solid  black;"><h4><b>'. $row ['companyname'].'</b></h4><br/>
		  '.$row['address'].'</td>
		</tr>
		<tr style="border :1px  solid  black;"> 
		  <td style="border :1px  solid  black;><b>E-Mail : </b>'. $row['email_id'].'</td>
		  <td style="border :1px  solid  black;><b>GST NO : </b>'. $row['gst_no'].'</td>
		  <td><b>PHONE NO : </b>'. $row['email_id'].'</td>
		</tr>
		<tr style="border :1px  solid  black;"> 
		  <td><b>Quote. NO : </b>'. $QuoteNo.'<br/><br/>
		  
		  <b>Date : </b>'. $quote_date.' 
		  
		  </td>
		  <td><b>Ref. No.  : </b>'. $row['quote_no'].'<br/><br/>
		  <b>Currency : </b>'. $currency .'
		  </td>
		  <td><b>Acct Manager : </b>'. $row['name'].'
		  </td>
		  
		</tr>
		
		<tr style="border:1px solid black;">
  		  <td colspan="3"><b><u>Client Name & Details </u></b><br/><br/>
			  <b> Address : </b>'. $row['address1'].','. $row['address2'].',<br/>'. $row['area'].','. $row['town_city'].','. $row['pincode'].',<br/>'. $row['district'].','. $row['state'].','. $row['country'].'</b><br/><br/>
			  <b>Mobile No : </b>'. $row['mobile_no1'].','. $row['mobile_no2'].'<br/><br/>
			  <b>Dear Sir,</b><br/>
				 As per your requirement, please find attached below our proposal for HP 280 Pro G6 Desktops
		  </td>
		</tr>
			<table width="1000px" border="1" style="border-collapse:collapse;border: 1px solid !important;margin-bottom: 0px !important;" class="table border m_b_0px"> 
				<TR>
				   <th>SLNO.</th>
				  <th>SPECIFICATION</th>
				  <th>QTY</th>
				  <th>UNIT RATE</th>
				  <TH formula="cost*qty" summary="sum">AMOUNT</TH>
				</TR> ';
				 
				$query= $con->query("SELECT a.id as quote_id,a.*,b.*,c.*,e.* from quotation_entry a 
				 inner join client_master b on(b.id=a.client_id) 
				 inner join doller_vendor_mastor c on(c.id=a.vendor_id)
				 inner join emp_personal_details e on(e.emp_id=a.candid_id) where a.status ='1' and a.vendor_id='$vendor_id'"); 
				 
				$sum_total="";
				$cnt=1;
					while($quote = $query->fetch(PDO::FETCH_ASSOC)){
				 
					$sum_total+= $quote['amount'];
					$gst         = $row['gst_percentage'];
					$withgst     = ($sum_total)*($gst/100);
					$grand_total = round($withgst+$sum_total);
					
					if($gst =='18') {     $SGST_cal  = ($sum_total)*(9/100); 
					}elseif($gst =='28'){ $SGST_cal  = ($sum_total)*(14/100); 
					}else{ $SGST_cal = ($sum_total)*(0/100); }
					
					 if($gst =='18') {     $CGST_cal  = ($sum_total)*(9/100); 
					}elseif($gst =='28'){ $CGST_cal  = ($sum_total)*(14/100); 
					}else{ $CGST_cal = ($sum_total)*(0/100); }
					
					if($gst =='18') {  
					   $sgst_per =  "9 %"; 
					}elseif($gst =='28'){
					   $sgst_per =  "14%"; 
					}
					
					if($gst =='18') {  
					   $cgst_per =  "9 %"; 
					}elseif($gst =='28'){
					   $cgst_per =  "14%"; 
					}
						
					 $tax_amount = $SGST_cal + $CGST_cal;
				
				$output .= '<TR>
				  <TD>'. $cnt.'. </TD>
				  <TD> '. $quote['specification'].'</TD>
				  <TD>'. $quote['qty'].'</TD>
				  <TD> '. $quote['unit_rate'].'</TD>
				  <TD> '. $quote['amount'].'</TD>
				   <input type="hidden" readonly="readonly" id="quote_id1" name ="quote_id[]" value ="'. $quote['quote_id'].'">
				</TR>';
				 $cnt=$cnt+1; 
				 } 
				$output .= '<TR>
				  <TH colspan="4" style="text-align:right;">SUB TOTAL </TH>
				  <TH>'. $sum_total.'</TH>
				</TR>
				<TR>
				   <TH colspan="4" style="text-align:right;">Add GST @ '. $gst.' %</TH>
				   <TH>'. $withgst .'</TH> 
				</TR>
				<TR>
				  <TH colspan="4" style="text-align:right;">GRAND TOTAL </TH> 
				  <TH>'. round($grand_total).'</TH>
				</TR>
			  </table>
			  <table id="dataTable" width="1000px" border="1" style="border-collapse:collapse;" class="table">
			  <tr style="bottom: none !important;">
				   <TD colspan="6" style="text-align:left;">Tax Summary </TD>
			  </tr>
			  <tr>
				   <TD colspan="6" style="text-align:center;">
				   <u><b> Tax Details :   </b></u><br/>
						SGST  &nbsp;&nbsp;&nbsp;&nbsp; '. $sgst_per.'  &nbsp;&nbsp;&nbsp;&nbsp; '. $SGST_cal.'
						<br/>
						CGST  &nbsp;&nbsp;&nbsp;&nbsp; '. $cgst_per.'  &nbsp;&nbsp;&nbsp;&nbsp; '. $CGST_cal.'<br/>
						.............................................................. <br/>
					 <b> Tax Amount  : '. $tax_amount.'<b/><br/>
					.............................................................. <br/>
					<br/><br/><br/><br/><br/><br/><br/><br/>
				   </TD>
			  </tr>
			</table>
		</TABLE>
		
	';
			
			$output .= '
			    <div class="col-sm-12" style="text-align:left;">
				  <img src="../../Recruitment/image/userlog/quadsel.png" alt="quadsel">
				</div>
				<TABLE id="dataTable" width="1000px" style="border-collapse:collapse; border :1px  solid  black;" class="table border">
					  <tr>
						<th colspan="2"  style="text-align:center;">TERMS & CONDITIONS</th>
					  </tr>
					  <tr>
						<th>VALIDITY</th>
						<th>ONE WEEK FROM THE DATE OF QUOTE. PRICES PREVAILING AT THE TIME OF SUPPLY & BILLING WILL ONLY APPLY.</th>
					  </tr>
					  <tr>
						<th>PAYMENT</th>
						<td><b>100% IN ADVANCE ALONG WITH FORMAL PURCHASE ORDER.<br/></b>
						PAYMENTS SHOULD BE MADE EITHER BY CHEQUE, DD, RTGS AND NEFT IN FAVOUR OF QUADSEL SYSTEMS PVT LTD, PAYABLE AT CHENNAI. CASH PAYMENTS WILL BE NULL & VOID.<br/>
						<b>BANK DETAILS FOR NEFT / RTGS / IMPS 
						<div class="form-group row">
							<div class="col-sm-3">BANK NAME :</div>
							<div class="col-sm-3">'. $row['account_name'].'</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3">CURRENT A/C NO :</div>
							<div class="col-sm-3">'. $row['account_no'].'</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3">IFSC CODE :</div>
							<div class="col-sm-3">'. $row['ifsc_code'].'</div>
						</div>
						</b>
						</td>
					  </tr>
					  <tr id="hidden_div1">
						<th >IMPORTANT</th>
						<td>YOUR PO SHOULD BE IN FAVOUR OF QUADSEL SYSTEMS PVT LTD., “QUADSEL TOWERS”, Old No.80, New No.118, Manickam Lane, Anna Salai, Guindy, Chennai – 600 032. INDIA.</td>
					  </tr>
					  
					  <tr>
						<th>DELIVERY</th>
						<td><b>AS FOR THE OME WITHIN 1 - 2 WEEKS , WITHIN 2 - 3 WEEKS , WITHIN 3 - 4 WEEKS, WITHIN 4 - 5 WEEKS  FROM THE DATE OF RECEIPT OF PAYMENT.</b><br/>
						SHIPPING COSTS WILL BE LEVIED IN FINAL INVOICE AS MAY BECOME APPLICABLE.</td>
					  </tr>
					  <tr>
						<th>WARRANTY</th>
						<td>AS MENTIONED ABOVE.<br/></td>
					  </tr>
					   <tr>
						<th>PAYMENT TERMS : </th>
						<td>100% PAYMENT IN ADVANCE<br/><br/><br/><br/>
					  </tr>
					  <TR>
						<TH style="text-align:center;" >'. $get_amount= AmountInWords($grand_total).'</TH>
						<TH style="text-align:left;">Amount  :  '. $withgst.' <br/><br/>
						Tax  :  '. $tax_amount.' <br/><br/>
						Net Amount   :  '. round ($grand_total).' <br/>
						</TH>
					  </TR>
					  <TR>
						<TH colspan= "2" style="text-align:center;"><b><br/>'. $row['name'].'<br/>'. $row['position'].'<br/>Mobile No : '. $row['mobile_num'].'<br/>Email Id : '. $row['email_id'].'<br/></b></TH>
					  </TR>
			</TABLE>
	</div>';



    
	  return $output;
	 }
   
}
for($i=0;$i<$count;$i++)
{  

   
	$vendor_id=$vendor_id[$i];
	$quote_query= $con->query("SELECT a.id as quote_id,a.*,b.*,c.*,e.* from quotation_entry a 
	inner join client_master b on(b.id=a.client_id) 
	inner join doller_vendor_mastor c on(c.id=a.vendor_id) 
	inner join candidate_form_details e on(e.id =a.candid_id) where a.status ='1' and a.vendor_id='$vendor_id'"); 
	
	$quote_query->execute(); 
	$row        = $quote_query->fetch();
		
	
	$SENDMAIL       = $row['email_id1'];
	$client_name    = $row['client_name'];
    $QuoteNo   = $row['quote_no'];
    //$CHECKMAIL ='umadevidevi284@gmail.com';
    //$cname ='client';
	$user_id =$_SESSION['userid'];
	
	$class_quote = new fetch_data();
	$class_quote->fetch_quote_data($con,$vendor_id,$client_name,$QuoteNo);  

	
	$file_name = md5(rand()) . '.pdf';
	$html_code = '<link rel="stylesheet" href="bootstrap.min.css">';
	
	
	$html_code .=  $class_quote->fetch_quote_data($con,$vendor_id,$client_name,$QuoteNo);
	//$grabzIt->SaveTo("images/result.jpg");
	$pdf = new Pdf();
	$pdf->load_html($html_code);
	$pdf->render();
	$file = $pdf->output();
	
	file_put_contents($file_name, $file);
	
	//require 'class/class.phpmailer.php';
	

	$mail = new PHPMailer;	
	$mail->SMTPDebug = 3; 
	$mail->IsSMTP(true);								//Sets Mailer to send message using SMTP
	$mail->Host = 'smtp.zoho.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = '465';								//Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = 'umadevi.v@bluebase.in';					//Sets SMTP username
	$mail->Password = 'uma@naveen';					//Sets SMTP password
	$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = 'umadevi.v@bluebase.in';			//Sets the From email address for the message
	 $mail->FromName = 'Test';			//Sets the From name of the message
	 $mail->AddAddress('ammudevi284@gmail.com', $client_name);		//Adds a "To" address
		
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
	$mail->Subject = 'Quote / Proposal ';			//Sets the Subject of the message
	$mail->Body = 'Please Find Quote / Proposal Report in attach PDF File.';				//An HTML or plain text message body
	
	/* if($mail->Send())								//Send an Email. Return true on success or false on error
	{  
     	echo "Success";
		$message = '<label class="text-success">Quote Details has been send successfully...</label>';echo $message;
	    $update_query = $con->query("update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'");  
		echo "update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'";
	} */
	if(!$mail->send()) {
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
	   echo "0";
   } 
    else {
        $message = '<label class="text-success">Quote Details has been send successfully...</label>';echo $message;
	    $update_query = $con->query("update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'");  
		//echo "update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'";
	
	}
	unlink($file_name);

	 $class_quote->fetch_quote_data($con,$vendor_id,$client_name,$QuoteNo);
}	
     $mail->clearAttachments();

?>