<?php
require '../../../connect.php';
require '../../../user.php';

require '../../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';
include ('pdf.php');

$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

$costsheet_id=$_REQUEST['id'];




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
   //$cst_no=$row ['cost_sheet_no'];
?>


<style>
.form-control {
    
    width: 60px !important;
}	
.row1{
	 border:1px solid black;
}
.row2{
   height: 6px;
}

.table>tbody>tr>th{
	 width:300px;
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
#leftbox {
	float:left;
}
#middlebox{
	float:left; 
	margin-left: 400px;
}
#rightbox{
	float:right;
}



TABLE, th, td {
  border: 1px solid black;
  border-collapse:collapse;
}

#qiso{
	width: 150px;
    margin-top: 35px;
    float: right;
	
}

</style>

<style>

.inner {
 width:80%;
 margin-left:100px;
}
.inner ul li {
  list-style-type:square;
  text-align:justify;
  margin-bottom:15px;
}

.head {
  margin: 50px 0px 20px 0px;
  text-align:center;
}

#head th, td{
	padding-left:10px;
}
</style>

<?php 
class fetch_data{
 public $costsheet_id;
	function fetch_quote_data($con,$costsheet_id){ 

$stmt = $con->prepare("select a.cost_sheet_no as cst_no,a.specification as pvm_spec,a.vendor_id as pvm_vendor_id,a.*,b.client_id as cid,b.*,c.*,d.* from purchase_vendor_master a left join cost_sheet_entry b on (a.cost_sheet_id=b.id) left join purchase_requistion_entry c on (a.cost_sheet_id=c.cost_sheet_id) left join doller_vendor_mastor d on (a.vendor_id=d.id) where a.cost_sheet_id='$costsheet_id' and a.status ='2'");

$stmt->execute(); 
$row        = $stmt->fetch();
 $costsheet_no=$row['cst_no']; 
 $pvm_spec=$row['pvm_spec'];
 $vendors_id=$row['pvm_vendor_id'];
 $vendor_name=$row['vendor_name'];
 $address=$row['address1'];
 $cliint_id=$row['cid'];

$stmtcc = $con->prepare("select a.*,b.* from new_client_master a left join new_plant_master b on (a.id=b.client_id)where a.id='$cliint_id'");

$stmtcc->execute(); 
$rowcc        = $stmtcc->fetch();
$gst_no=$rowcc['gst_no'];
$pan_no=$rowcc['pan_no'];
	
	
	
	
$output='<section class="content" id="content">
	<div class="container-fluid">
	 <div class="row">
	  <div class="card-body">
     <form action="" method="post" enctype="multipart/form-data">   
    <div class="col-sm-12">


	
	 <TABLE width="100%">
	  <h4 align="center"><b>PURCHASE ORDER</b></h4>
	  <tr style="border:none;">
	     <td colspan="6" rowspan="2"  style="border:none; margin-bottom:3px; padding-bottom: 30px;padding-left:10px;">
		    <b>Quadsel Systems Pvt Ltd</b><br>
		       NO:118,ANNA SALAI MANICKAM LANE<br>
		       GUINDY,CHENNAI.<br>
			   <div class="row">
				  <div class="col-1"><b>E-Mail </b></div> <div class="col-0"><b>: </b></div> <div class="col-1">helpdesk@quadsel.in</div><br>
			    </div>
			  
		  </td>
		  
	  </tr>
		  
	   <tr>
		   <td colspan="3"  style="border-left-style:hidden; padding-top:30px; width:0px;">
              <div class="row">
				  <div class="col-3"><b>GSTIN </b></div> <div class="col-2"><b>: </b></div> <div class="col-5"> 
				  '. $gst_no .'</div><br>
			  </div>
               <div class="row">
				  <div class="col-3"><b>PAN NO </b></div> <div class="col-2"><b>: </b></div> <div class="col-5">
				  '. $pan_no .'</div><br>
			  </div>
               <div class="row">
				  <div class="col-3"><b>CIN NO </b></div> <div class="col-2"><b>: </b></div> <div class="col-5"></div><br>
			  </div>			  
		      
		  </td>
	  </tr>
	  
	  <tr>
		  <td colspan="3" style="padding: 0px 15px 30px 10px;"> <b>Vendor Name & Address &nbsp: </b></td>
		  
		  <td colspan="7" rowspan="3" style="padding-left:30px;">
		      <div class="row">
				  <div class="col-3">Order No</div> <div class="col-2">: </div> <div class="col-5">POTR011000304</div><br>
			  </div>
			  <div class="row">
				  <div class="col-3">Order Date</div> <div class="col-2">: </div> <div class="col-5">000</div><br>
			  </div>
			  <div class="row">
				  <div class="col-3">Quote ID</div> <div class="col-2">: </div> <div class="col-5">000</div><br>
			  </div>
			  <div class="row">
				  <div class="col-3">Part Shipment</div> <div class="col-2">: </div> <div class="col-5">000</div><br>
			  </div>
			  <div class="row">
				  <div class="col-3">Division</div> <div class="col-2">: </div> <div class="col-5">000</div><br>
			  </div>
			  <div class="row">
				  <div class="col-3">Mode of Bill</div> <div class="col-2">: </div> <div class="col-5">000</div><br>
			  </div>
			  
		  </td> 
          	  
	 </tr>
		
		<tr>
		  <td colspan="2" style="padding-left:10px;"><b>
<div class="col-3"> '. $vendor_name .' </div><div class="col-3"> '. $address .'</div>
		  </td>
		</tr>
		  
		 <tr>
		   <td colspan="2" style="padding: 0px 15px 30px 10px;">
		   <b> GSTIN&nbsp&nbsp:&nbsp&nbsp</b>
		   </td>
		</tr>
		
		<tr id="head">
		  <th>S.No </th>
		  <th colspan="1">Product Description </th>
		  <th>Products </th>
		  <th>Qty </th>
		  <th>UOM </th>
		  <th>Unite Rate </th>
		  <th>Value </th>
		  <th>Tax </th>
		  <th>Amount </th>
		</tr>';
		
		 
		$stmtw = $con->prepare("SELECT COUNT(*) as count FROM purchase_requistion_entry where cost_sheet_nos='$costsheet_no' 
		and specifications='$pvm_spec'");

		$stmtw->execute(); 
		$roww        = $stmtw->fetch();
		$count=$roww['count'];
if($count==0)
{		
				$query= $con->query("SELECT * from purchase_vendor_master 				
				 where status ='2' and vendor_id='$vendors_id' group by specification"); 

}else{
	
	$query= $con->query("SELECT distinct a.specification,a.*,b.*,c.* from purchase_vendor_master a 
				 left join cost_sheet_entry b on(a.cost_sheet_no=b.cost_sheet_no) 
				 left join purchase_requistion_entry c on (a.cost_sheet_no=c.cost_sheet_nos)				
				 where a.status ='2' and a.vendor_id='$vendors_id' group by a.specification");
	
	
	
}			
		
				$sum_total=0;
				$cnt=1;
					while($quote = $query->fetch(PDO::FETCH_ASSOC)){
						$qty1=$quote['unit_qty'];
						$gst_val=$quote['gst_val'];
						$igst_val=$quote['igst_val'];
						$grand_total=$quote['grand_total'];
						$price=$quote['price'];
						$gst_per=$quote['gst_per'];
						$gst    = $gst_per;


					$withgst     = ($price)*($gst/100);

					$grand_totals = round($withgst+$price);
					
					
					if($gst =='18') { 
					$SGST_cal  = ($price)*(9/100); 
					}elseif($gst =='28'){
						$SGST_cal  = ($price)*(14/100); 
					}else{ 
					$SGST_cal = ($price)*(0/100); }
					
					 if($gst =='18') {   
					 $CGST_cal  = ($price)*(9/100); 
					}elseif($gst =='28'){
						$CGST_cal  = ($price)*(14/100); 
					}else{
						$CGST_cal = ($price)*(0/100); }
					
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
				$no = $gst_val+$igst_val;
				
		$output .= '<tr>
		  <td>'. $cnt .' </td>
		  <td colspan="1">'. $quote['specification'] .' </td>
		  <td>'. "" .' </td>
		  <td>'. $quote['unit_qty'] .' </td>
		  <td>'. "" .' </td>
		  <td>'. $quote['unit_cost'] .' </td>
		  <td>'. $quote['price'] .' </td>
		  <td>'. $no .' </td>
		  <td>'. $quote['grand_total'] .' </td>
		</tr>';
				 $cnt=$cnt+1; } 
		
		$output .= ' <tr>
		  <td> </td>
		  <td colspan="1"> </td>
		  <td> </td>
		  <td> </td>
		  <td> </td>
		  <td><b>Total </b> </td>
		    <td>'; 
			
			$stmtlo = $con->prepare("SELECT distinct a.specification,a.*,b.*,c.* from purchase_vendor_master a 
				 left join cost_sheet_entry b on(a.cost_sheet_no=b.cost_sheet_no) 
				 left join purchase_requistion_entry c on (a.cost_sheet_no=c.cost_sheet_nos)				
				 where a.status ='2' and a.vendor_id='$vendors_id' group by a.specification"); 

	
			$stmtlo->execute(); 
			$rowlo = $stmtlo->fetch();
			$rowlo['grand_total']; 
			
			$taxamnt = $SGST_cal+$CGST_cal;
			
			$output .= '</td>
		  
		</tr>
		
			  <tr style="border-bottom-style: hidden;">
				   <TD colspan="9" style="text-align:left; padding-left:10px;"> <b><u>Tax Summary</u> </b> </TD>
			  </tr>
			  <tr>
				   <TD colspan="9">
				   <u><h5 style="font-weight: bold; margin-left: 400px;"> Tax Details :   </h5></u><br/>
				   <div style="margin-left: 410px; width: 510px;">
						SGST  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '. $sgst_per .'  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '. $SGST_cal .'
						<br/>
						CGST  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '. $cgst_per .'  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '. $CGST_cal .' <br/>
						....................................................................................... <br/>
					 <h5 style="font-weight: bold;margin-left: 80px;"> Tax Amount  : &nbsp;&nbsp; '. $taxamnt .' <h5/>
					....................................................................................... <br/>
					<br/><br/><br/><br/><br/><br/><br/><br/>
					</div>
				   </TD>
			  </tr>
			
		<tr>
		  <td colspan="4" style="padding: 0px 15px 47px 10px;"> <b><u>Special Instructions</u></b></td>
		 <td colspan="5"> 
		      <div class="row">
				  <div class="col-3">Amount</div> <div class="col-2">: </div> <div class="col-5"> '. $price .' </div><br>
			  </div>
			  <div class="row">
				  <div class="col-3">Tax</div> <div class="col-2">: </div> <div class="col-5"> '. number_format($gst_val+$igst_val,2) .' </div><br>
			  </div>
			  <div class="row">
				  <div class="col-3"> Net Amount</div> <div class="col-1">: </div> <div class="col-1">INR </div> <div class="col-5"> '. number_format($grand_total,2) .' </div><br>
			  </div>
			 
		  </td>
		</tr>
		
		<tr>
             <td  colspan="4" rowspan="2"> <b> <u>Terms& Conditions</u> </b> <br>
				<div class="row">
				  <div class="col-5">MODE OF PAYMENT</div> <div class="col-1">: </div> <div class="col-5">THROUGH BANK</div><br>
				</div>
				<div class="row">
				  <div class="col-5">MODE OF DELIVERY</div> <div class="col-1">: </div> <br>
				</div>
				<div class="row">
				  <div class="col-5">VALIDITY</div> <div class="col-1">: </div> <br>
				</div>
				<div class="row">
				  <div class="col-5">FRIGHT CHARGES </div> <div class="col-1">: </div> <br>
				</div>
				<div class="row">
				  <div class="col-5">INSURANCE</div> <div class="col-1">: </div> <br>
				</div>
				<div class="row">
				  <div class="col-5">PACKING & FORWADING</div> <div class="col-1">: </div> <br>
				</div>
				<div class="row">
				  <div class="col-5">PAYMENT</div> <div class="col-1">: </div> <br>
				</div>
				
			  </td>
			  
			  <td colspan="5" style="padding-left:10px;"> <b> <u>Note &nbsp:</u> </b><br> 
				 <b> 1) </b>Please return the Duplicate copy of our purchase<br> 
                     Order duly signed as a token of acceptance. <br>				  
				 <b> 2) </b>Please Mention our P.O NO. In your invoice to avoid <br>
				     delay in payment. 
			  </td>
		 </tr>
		 
		  <tr  style="text-align: right;">		 
			  <td colspan="5" style="padding-right: 10px;">
			     <b>Quadsel system pvt ltd </b><br><br>
				 
				 Authorised signatory.
			  </td>
         </tr>	
     	 
		
	</TABLE>
	
		<div class="content">
   <div class="inner"> 
	<div class="head"><br><br><br><br><br><br><br><br>
	   <h5 > <b>TERMS AND CONDITION OF SALE</b> </h5>
	 </div>
	 
	 <div>
 	    <ul>
		  <li> Goods Once Sold cannot be taken back or exchanged. </li>
		  <li> Interest @24% will be charged on all delayed payments beyond the credit limit indicated in the P.O.</li>
		  <li> Warranty void if the seal is broken.</li>
		  <li> Delivery will depend on the availability of stack. Part delivery shall be permitted and in the case of non availability,
               the supplier shall have the option to cancel the order. Delay in Delivery of the goods shall not render the contract voidable on the 
               part of the buyers. The buyers have no right to withhold payment on the Account and shall not reject the goods on this ground.</li>
		  <li> The supplier shall also not be liable for delay or non delivery for reasons like difficulities in supply of stock or any other 
		       cause beyond the control of the supplier. No compensation is payable to the Buyer under such circumstances. </li>
		  <li> If the buyers fail to take delivery, they shall reimburse the supplier all storage and other expenses incurred in respect of the goods delivered
		       but not taken by the buyers.</li>
		  <li> No dispute regarding the quality or fitness of the goods can be raised without notice to the supplier within five days of receipt of the goods.
		       This supplier will not accept any Return of goods unless agreed to in writing. </li>
		  <li> In addition to GST if any other taxes to applicable will be charged extra.</li>
		  <li> No credit or set-off for GST and other statutory levies already collected will be allowed on Rejected goods unless rejected goods are received
		       by the supplier before the end of the next quater.</li>
		  <li> All bank charges (include collection charges) and stamp duty on cheques, of exchanges, hundies shall be payable by the buyers. The supplier 
		       shall not be liable for any loss or theft of bank drafts, cheques etc, in transit.</li>
		  <li> "All contracts of the company including any disputes arising out of and in connection with this contract / transaction will be subject to 
		       Arbitration & conciliation Act of 1996 and subject to exclusive jurisdiction of courts in chennai only". </li>
		  <li> Order cancellation charges @10% will be applicable on all Order cancelled. </li>
		  <li> GSTIN Number is provided by the customer and errors, omissions and discrepancies if any shall remain customer responsibility.</li>
		  <li> In addition to GST any additional increase in levies and charges taxes, duties and cess etc, which becomes effective on or before despatch shall
		       be payable solely by the buyer.</li>
		</ul>
	 </div>
	</div>
  </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	
	</div>
   </form>
	</div>
	</div>
   </div>
</section> ';
return $output;
	}
}


$class_quote = new fetch_data();
$class_quote->fetch_quote_data($con,$costsheet_id); 

$sub='Quotation from SS Information by';

$file_name = 'SS Info Quotation'.'.pdf';
$html_code = '<link rel="stylesheet" href="bootstrap.min.css">';
	
$html_code .=  $class_quote->fetch_quote_data($con,$costsheet_id);

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
	$mail->FromName = 'Quotation from SS Information ';			//Sets the From name of the message
	//$mail->AddAddress($mailerID, $client_name);		//Adds a "To" address
	//$mail->AddAddress('antoajith.d@bluebase.in', $client_name);		//Adds a "To" address
	$mail->AddAddress('antoajith2103@gmail.com');		//Adds a "To" address
    echo"zkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk";
	
	$mail->WordWrap = 50;		//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
    $mail->Subject = $sub;			//Sets the Subject of the message
	$mail->Body = "Dear&nbsp;&nbsp;Madam/Sir ,  <br> <br>

		&nbsp;&nbsp;	Please Find the Quote / Proposal in Attached PDF File..!   <br> <br>
		
		&nbsp;&nbsp;   Greetings! <br> <br>
		&nbsp;&nbsp; <b> Thanks & Regards </b> <br> <br>
		&nbsp;&nbsp; <b> SS Information  </b>  ";	
	
?>