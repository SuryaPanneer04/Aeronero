<?php
require '../../../connect.php';
require '../../../user.php';
require '../../../PHPMailer/PHPMailerAutoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';
include('pdf.php');

//$file_name = md5(rand()) . '.pdf';
$costsheet_id = $_REQUEST['id'];
$sendermail = $_REQUEST['ccmailid'];

//$count = sizeof($costsheet_id);


// Create a function for converting the amount in words
function AmountInWords($amount)
{
	$amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
	// Check if there is any number after decimal
	$amt_hundred = null;
	$count_length = strlen($num);
	$x = 0;
	$string = array();
	$change_words = array(
		0 => '', 1 => 'One', 2 => 'Two',
		3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
		7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
		10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
		13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
		16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
		19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
		40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
		70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
	);
	$here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
	while ($x < $count_length) {
		$get_divider = ($x == 2) ? 10 : 100;
		$amount = floor($num % $get_divider);
		$num = floor($num / $get_divider);
		$x += $get_divider == 10 ? 1 : 2;
		if ($amount) {
			$add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
			$amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
			$string[] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . ' 
       ' . $amt_hundred : $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . ' 
       ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
		} else $string[] = null;
	}
	$implode_to_Rupees = implode('', array_reverse($string));
	$get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise Only' : 'Only';
	return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}


class fetch_data
{
	public $costsheet_id;
	function fetch_quote_data($con, $costsheet_id)
	{

		$stmt = $con->prepare("select a.cost_sheet_no as cst_no,a.specification as pvm_spec,a.vendor_id as pvm_vendor_id,a.*,b.client_id as cid,b.*,c.*,c.id as pur_re_id,d.*,e.ship_to,e.other_reference,e.term_delivery,e.terms from purchase_vendor_master a left join cost_sheet_entry b on (a.cost_sheet_id=b.id) left join purchase_requistion_entry c on (b.description=c.description) left join doller_vendor_mastor d on (a.vendor_id=d.id) left join ship_terms e on a.id = e.pvm_id where a.cost_sheet_id='$costsheet_id' and a.status ='6'");

		echo "<br>", "select a.cost_sheet_no as cst_no,a.specification as pvm_spec,a.vendor_id as pvm_vendor_id,a.*,b.client_id as cid,b.*,c.*,c.id as pur_re_id,d.*,e.ship_to,e.other_reference,e.term_delivery,e.terms from purchase_vendor_master a left join cost_sheet_entry b on (a.cost_sheet_id=b.id) left join purchase_requistion_entry c on (b.description=c.description) left join doller_vendor_mastor d on (a.vendor_id=d.id) left join ship_terms e on a.id = e.pvm_id where a.cost_sheet_id='$costsheet_id' and a.status ='6'", "<br>";

		$stmt->execute();
		$row        = $stmt->fetch();
		$costsheet_no = $row['cst_no'];
		$pvm_spec = $row['pvm_spec'];
		$vendors_id = $row['pvm_vendor_id'];
		$vendor_name = $row['vendor_name'];
		$address = $row['address1'];
		$vendor_address2 = $row['address2'];
		$vendor_area = $row['area'];
		$vendor_town_city = $row['town_city'];
		$vendor_state = $row['state'];
		$vendor_district = $row['district'];
		$vendor_pincode = $row['pincode'];
		$cliint_id = $row['cid'];
		$pur_re_id = $row['pur_re_id'];
		$vendor_gst_num = $row['vendor_gst_num'];
		$stateCode = substr("$vendor_gst_num", 0, 2);
		$ship_to = $row['ship_to'];
		$other_reference = $row['other_reference'];
		$term_delivery = $row['term_delivery'];
		$terms = $row['terms'];

		$stmtcc = $con->prepare("select a.*,b.*,c.statename from new_client_master a left join new_plant_master b on (a.id=b.client_id) left join states c on b.state = c.id where a.id='$cliint_id'");

		$stmtcc->execute();
		$rowcc        = $stmtcc->fetch();
		$org_name = $rowcc['org_name'];
		$address = $rowcc['address'];
		$plantstatename = $rowcc['statename'];
		$gst_no = $rowcc['gst_no'];
		$plantstateCode = substr("$gst_no", 0, 2);


		$output = '<div style="font-size:13px;font-weight: normal;">
		<table width="710px" style="text-align:left; border: none;">
		   <tr>
		     <td colspan="5"><img src="../../../images/04.png" alt="SS-Information" style="width:240px; height:70px;"><br/>
		        <h4 align="center"> <b> PURCHASE ORDER </b> </h4> 
			 </td>
		   </tr>
		   </table>
	  
	   <table id="dataTable" width="710px"  border="1" style="font-size:13px;border-collapse:collapse;border: 1px solid !important;border-top: none;" class="table border m_b_0px"> 
		<tr style="border:1px solid black;"> 
				<td colspan="1" rowspan="3" style="border-right: none;"><img src="../../../images/ss.png" class="img1 " > </td>
	            <td colspan="5" rowspan="3" style="border-left: none;">
	            <b> Invoice To <br/>
	      SS Information Systems Pvt Ltd </b><br/>
          No:1/102,Periyar Pathai West,100 Feet Road,<br/>
		  Arumbakkam,Chennai -600106 <br/>
          Rajkumar@ssinformation.in <br/>
		  Landline No: 044-23623544 <br/>
          GSTIN/UIN: 33AARCS9223K1ZU <br/>
          State Name : Tamil Nadu, Code : 33 <br/>
          CIN: U72900TN2012PTC087388 <br/>
          E-Mail : karthick@ssinformation.in </td>
	          <td colspan="2">Voucher No. <b>  </b> </td>  
	          <td colspan="2" >Dated:<b>  </b></td>
		</tr>
		   
			   
		   <tr style="border :1px  solid  black;font-size:13px;"> 
			 <td colspan="2"> </td>
	         <td colspan="2">Mode/Terms of Payment <b>' . $terms . ' </b></td>
		   </tr> <br/> <br/>
			 
		  <tr style="border:1px solid black;border-top-style: hidden;font-size:13px;">
			<td colspan="2">Reference No. & Date. <b>  </b>  </td>
	        <td colspan="2">Other References <b>' . $other_reference . '  </b>  </td>
		  </tr>

		<tr>
	      <td colspan="6" rowspan="2">Consignee (Ship to) <br/>';

		if ($ship_to == 1) {

			$output .= '<b>SS Information Systems Pvt Ltd </b> <br/>
			No:1/102,Periyar Pathai West,100 Feet Road ,Arumbakkam, <br/>
			Chennai -600106 <br/>
			Rajkumar@ssinformation.in <br/>
			Landline No: 044-23623544 <br/>
			E-Mail : karthick@ssinformation.in <br/>
			GSTIN/UIN: 33AARCS9223K1ZU <br/>
			State Name : Tamil Nadu, Code : 33 ';
		} else {

			$output .= '<b>' . $org_name . ' </b><br/>';

			$addres_split = explode(',', $address);
			foreach ($addres_split as $addressline) {
				$output .=  $addressline  . ',<br/>';
			}

			$output .= 'GSTIN/UIN: ' . $gst_no . ' <br/>
			State Name: ' . $plantstatename . ', Code : ' . $plantstateCode;
		}

		$output .= '</td>

	     <td colspan="2">Delivery Note Date </td>
	     <td colspan="2">Destination </td>
	  </tr>
	  <tr>
	     <td colspan="4" rowspan="2"> <span style="position: absolute;top: 0px;"> Terms of Delivery </span>' . $term_delivery . '</td>
	 </tr>
	 <tr>
	    <td colspan="6">Supplier (Bill from)<br/>
        <b>' .  $vendor_name . ' - ' . $vendor_town_city . ' </b><br/>
          ' . $address . '<br> ' . $vendor_address2 . ' , ' . $vendor_area . ' , ' . $vendor_town_city . ' , ' . $vendor_district  . ' <br> ' . $vendor_state . ' - ' . '   ' . $vendor_pincode . '. <br/>
         GSTIN/UIN : ' . $vendor_gst_num . '<br/>
         State Name : ' .  $vendor_state . ', Code : ' . $stateCode . '
        </td>
	</tr>

				 <TR>
	                <th>Sl No. </th>
	                <th colspan="4">Description of Goods </th>
	                <th>Qty </th>
	                <th>Rate </th>
	                <th>per </th>
	                <th>Disc. % </th>
	                <th>Amount </th>
				</TR> ';

		$query = $con->query("SELECT distinct a.specification,SUM(a.unit_qty) as unitt,SUM(a.price) as prices,SUM(a.gst_val) as gst,SUM(a.igst_val) as igst,SUM(a.grand_total) as gtotal,b.description,a.gst_per,a.igst_per,a.unit_cost,SUM(a.discount) as discnt,a.disc_per,a.edd from purchase_vendor_master a left join cost_sheet_entry b on (a.cost_sheet_id=b.id) where a.status ='6' and a.vendor_id='$vendors_id' group by a.specification");

		echo "<br>", "SELECT distinct a.specification,SUM(a.unit_qty) as unitt,SUM(a.price) as prices,SUM(a.gst_val) as gst,SUM(a.igst_val) as igst,SUM(a.grand_total) as gtotal,b.description,a.gst_per,a.igst_per,a.unit_cost,SUM(a.discount) as discnt,a.disc_per,a.edd from purchase_vendor_master a left join cost_sheet_entry b on (a.cost_sheet_id=b.id) where a.status ='6' and a.vendor_id='$vendors_id' group by a.specification", "<br>";

		$sum_total = 0;
		$cnt = 1;
		while ($quote = $query->fetch(PDO::FETCH_ASSOC)) {
			$qty1 = $quote['unitt'];
			$gst_val = $quote['gst'];
			$igst_val = $quote['igst'];
			$grand_total = $quote['gtotal'];
			$price = $quote['prices'];
			$gst_per = $quote['gst_per'];
			$gst    = $gst_per;
			$disc_per = $quote['disc_per'];
			$discount = $quote['discnt'];
			$edd = $quote['edd'];


			$withgst     = ($price) * ($gst / 100);

			$grand_totals = round($withgst + $price);


			if ($gst == '18') {
				$SGST_cal  = ($price) * (9 / 100);
			} elseif ($gst == '28') {
				$SGST_cal  = ($price) * (14 / 100);
			} elseif ($gst == '3') {
				$SGST_cal  = ($price) * (1.5 / 100);
			} elseif ($gst == '5') {
				$SGST_cal  = ($price) * (2.5 / 100);
			} else {
				$SGST_cal = ($price) * (0 / 100);
			}

			if ($gst == '18') {
				$CGST_cal  = ($price) * (9 / 100);
			} elseif ($gst == '28') {
				$CGST_cal  = ($price) * (14 / 100);
			} elseif ($gst == '3') {
				$CGST_cal  = ($price) * (1.5 / 100);
			} elseif ($gst == '5') {
				$CGST_cal  = ($price) * (2.5 / 100);
			} else {
				$CGST_cal = ($price) * (0 / 100);
			}

			if ($gst == '18') {
				$sgst_per =  "9 %";
			} elseif ($gst == '28') {
				$sgst_per =  "14%";
			} elseif ($gst == '3') {
				$sgst_per =  "1.5%";
			} elseif ($gst == '5') {
				$sgst_per =  "2.5%";
			}

			if ($gst == '18') {
				$cgst_per =  "9 %";
			} elseif ($gst == '28') {
				$cgst_per =  "14%";
			} elseif ($gst == '3') {
				$cgst_per =  "1.5%";
			} elseif ($gst == '5') {
				$cgst_per =  "2.5%";
			}

			$output .= '<TR>
				  <TD>' . $cnt . '</TD>
	              <TD colspan="4"> <b>' . $quote['specification'] . ' </b> <br/>
	              ' . $quote['description'] . '</TD>
	              <TD> ' . $quote['unitt'] . ' </TD>
	              <TD> ' . number_format($quote['unit_cost'], 2) . '  </TD>
	              <TD> Nos </TD>
	              <TD></TD>
	              <TD> ' . number_format($price, 2) . ' </TD>
				</TR>';
			$cnt = $cnt + 1;
		}
		$output .= '<TR>
				   <TD></TD>
	               <TD colspan="3" style="text-align:right;"><b> CGST @ ' . $cgst_per . ' </b></TD>
             	  <TD></TD>
	              <TD></TD>
	              <TD> ' . $CGST_cal . ' </TD>
	              <TD>% </TD>
	              <TD> </TD>
	              <TD><b> ' . number_format($price + $CGST_cal, 2) . ' </b></TD>
				</TR>
	   
				
				<TR>
				  <TD></TD>
	              <TD colspan="3" style="text-align:right;"><b> SGST @ ' . $sgst_per . ' </b></TD>
	              <TD></TD>
	              <TD></TD>
	              <TD> ' . $SGST_cal . ' </TD>
	              <TD>% </TD>
	              <TD></TD>
	              <TD><b> ' . number_format($price + $CGST_cal + $SGST_cal, 2) . ' </b></TD>
				</TR>

				<TR>
	            <TD></TD>
	            <TD colspan="3" style="text-align:right;"><b> Discount @ ' . $disc_per . ' %</b></TD>
	            <TD></TD>
	            <TD></TD>
	            <TD> ' . number_format($discount, 2) . ' </TD>
	            <TD>% </TD>
	            <TD> ' . $disc_per . '  </TD>
	            <TD><b>' . number_format($price + $CGST_cal + $SGST_cal - $discount, 2) . ' </b></TD>
	            </TR>

				<TR>
	             <TD></TD>
	             <TD colspan="3" style="text-align:right;"><b> Total </b> </TD>
	             <TD></TD>
	             <TD><b> ' . $qty1 . '  </b></TD>
	             <TD> </TD>
	             <TD> </TD>
	             <TD></TD>
	             <TD><b> ' . number_format($grand_total, 2) . ' </b></TD>
	            </TR>
			  
			<tr>
	          <td colspan="10" style="border-bottom:none !important; padding: 0px 0px 20px 5px;">Amount Chargeable (in words)  <span style="float:right;"> E. & O.E </span><br>
              <b> INR ' . AmountInWords($grand_total) . ' </b>
	          </td>
	        </tr> 

			<tr style="border-top:none !important; border-bottom:none !important;">
	         <td colspan="10" style="border-top:none !important; border-bottom:none !important;">Company’s PAN :<b> AARCS9223K </b></td>
	        </tr>

			<tr style="border-bottom: none !important;">
	         <td colspan="5" style="border-top: none !important;border-bottom: none !important;"></td>
	         <td colspan="5" style="text-align: right;padding-bottom: 10px;border-bottom: none !important;"><b> for SS Information Systems Pvt Ltd </b><br/> </td>
	        </tr>

			<tr style="border-top: none !important;">
			<td colspan="5" style="border-top: none !important;"></td>
			<td colspan="5" style="text-align: right;border-top: none !important;">  Authorised Signatory </td>
		   </tr>

			<tr>
		      <td colspan="10"> Reg Office Address: </td>
	        </tr>
		 </table>
	
		<center> <p>This is a Computer Generated Invoice </p> </center>
	   </div>
	   ';

		return $output;
	}
}


$po_query = $con->query("select a.id as pvm_id,c.vendor_name,c.mail_id as vendorMailid,d.user_name,d.full_name,f.designation_name,d.mobile_no,d.email_id
from purchase_vendor_master a 
left join cost_sheet_entry b on (a.cost_sheet_id=b.id) 
left join doller_vendor_mastor c on (a.vendor_id=c.id)
left join z_user_master d on (b.created_by = d.candidate_id)
LEFT JOIN staff_master e on (b.created_by = e.candid_id)
LEFT JOIN designation_master f on (e.design_id = f.id)
where a.status='6' && b.id ='$costsheet_id'   ");

$poVendorDetails  = $po_query->fetch();

$pvm_id           = $poVendorDetails['pvm_id'];

$ccMail           = $poVendorDetails['user_name'];  //CC to Cost_sheet_entry created_by person. 
// Details about Employee who created cost_sheet_entry for the mail signature.
$full_name        = $poVendorDetails['full_name'];
$designation_name = $poVendorDetails['designation_name'];
$mobile_no        = $poVendorDetails['mobile_no'];
$email_id         = $poVendorDetails['email_id'];
// Details about Employee who created cost_sheet_entry for the mail signature.///////////END////////////////

$candidateid = $_SESSION['candidateid'];
$mail_to_login = $con->query("select d.user_name,d.full_name from z_user_master d where d.candidate_id='$candidateid' ");
$mail_person  = $mail_to_login->fetch();
$vendorName       = $mail_person['full_name'];
$mailTovendor     = $mail_person['user_name']; //Mail to login person ... they can send mail to vendor.

$enquiryId = $con->query("SELECT `enquiry_id` FROM `cost_sheet_entry` WHERE id ='$costsheet_id'");
$eq = $enquiryId->fetch();
$eqsts = $eq['enquiry_id'];

$insert_query2 = $con->query("Update enquiry set status='11' where id='$eqsts'"); //To change status in customer list menu.
$poUpdate = $con->query("update purchase_vendor_master set status= 4 where id ='$pvm_id' "); // when PO send to Vendor then purchase_vendor_mater table status will update to "4" for Update EDD against SO Number.///

$class_quote = new fetch_data();
$class_quote->fetch_quote_data($con, $costsheet_id);

$sub = 'PO from SS Information by ' . $full_name;

$file_name = 'SS Info PO' . '.pdf';
$html_code = '<link rel="stylesheet" href="bootstrap.min.css">';


$html_code .=  $class_quote->fetch_quote_data($con, $costsheet_id);
//$grabzIt->SaveTo("images/result.jpg");

// reference the Dompdf namespace
// use Dompdf\Dompdf;

// instantiate and use the dompdf class
//$dompdf = new Dompdf();
//$dompdf->loadHtml($html_code);

// (Optional) Setup the paper size and orientation
//$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
// $dompdf->render();

$pdf = new Pdf();
$pdf->setPaper('A4', 'portrait');
$pdf->load_html($html_code);
$pdf->render();
$file = $pdf->output();

file_put_contents($file_name, $file);

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
$mail->FromName = 'PO from SS Information ';			//Sets the From name of the message
$mail->AddAddress($mailTovendor, $vendorName);		//Adds a "To" address

//$mail->AddCC($email_id);
$recipient = explode(',', $sendermail);
foreach ($recipient as $emailx) {
	echo "zzzzz";
	print_r($emailx);
	$mail->AddCC($emailx);
}

$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
$mail->IsHTML(true);							//Sets message type to HTML				
$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
$mail->Subject = $sub;			//Sets the Subject of the message
$mail->Body = "Dear&nbsp;&nbsp;$vendorName ,  <br> <br>
&nbsp;&nbsp;   Greetings! <br> <br>

		&nbsp;&nbsp;	Please Find the PO in Attached PDF File..!   <br> <br><br> <br>
		
		
		&nbsp;&nbsp; <b> Thanks & Regards </b> <br> <br>
		&nbsp;&nbsp; <b> $full_name  </b> <br> <br>
		&nbsp;&nbsp; <b> $designation_name </b> <br> <br>
		&nbsp;&nbsp; <b> $mobile_no </b> <br> <br> 
		&nbsp;&nbsp; <b> $email_id </b> ";

if ($mail->Send())								//Send an Email. Return true on success or false on error
{
	echo "Success";
	$message = '<label class="text-success">PO Details has been send successfully...</label>';
	echo $message;
} elseif (!$mail->send()) {
	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
	echo "0";
}



unlink($file_name);

$class_quote->fetch_quote_data($con, $costsheet_id);

$mail->clearAttachments();
