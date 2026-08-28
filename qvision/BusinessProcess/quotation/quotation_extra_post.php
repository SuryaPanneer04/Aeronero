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

//$file_name = md5(rand()) . '.pdf';
$costsheet_id = $_REQUEST['id'];
$sendermail = $_REQUEST['sendermail'];

$stmtd= $con->query("SELECT cost_sheet_no,enquiry_id from cost_sheet_entry where id='$costsheet_id'");
$stmtd->execute(); 
$rowd        = $stmtd->fetch();
$enquirys_id=$rowd['enquiry_id'];

$stmtg= $con->query("SELECT MAX(id) AS cmax,cost_sheet_no,enquiry_id from cost_sheet_entry where enquiry_id='$enquirys_id'");
$stmtg->execute(); 
$rowg        = $stmtg->fetch();
 $cc_id=$rowg['cmax'];

$stmtf= $con->query("SELECT cost_sheet_no,enquiry_id from cost_sheet_entry where id='$cc_id'");
$stmtf->execute(); 
$rowf        = $stmtf->fetch();

$cost_sheet_nos=$rowf['cost_sheet_no'];
 echo "SELECT a.id as costsheet_id,a.*,b.*,e.* from cost_sheet_entry a 
				 inner join new_client_master b on(b.id=a.client_id) 
				 inner join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='2' and a.cost_sheet_no='$cost_sheet_nos' order by a.id desc";
		 
$stmtb= $con->query("SELECT a.id,a.first_name as fnames,a.phone as pphone,a.mail as mmail,a.position,b.id as cc_id,b.enquiry_id,b.extra_file as exxtra_file,c.id,c.created_by as enquiry_created,e.org_name as oorg_name,n.contact_person as ccontact_person from cost_sheet_entry b left join enquiry c on (b.enquiry_id=c.id) left join candidate_form_details a on (b.created_by=a.id) left join new_client_master e on (b.enquiry_id=e.enquiry_id) left join new_plant_master n on (e.id=n.client_id) where b.id='$costsheet_id'");

 echo "SELECT a.id,a.first_name as fnames,a.phone as pphone,a.mail as mmail,a.position,b.id as cc_id,b.enquiry_id,b.extra_file as exxtra_file,c.id,c.created_by as enquiry_created,e.org_name as oorg_name,n.contact_person as ccontact_person from cost_sheet_entry b left join enquiry c on (b.enquiry_id=c.id) left join candidate_form_details a on (b.created_by=a.id) left join new_client_master e on (b.enquiry_id=e.enquiry_id) left join new_plant_master n on (e.id=n.client_id) where b.id='$costsheet_id'"; 

/* echo "SELECT id,first_name as fnames,phone as pphone,mail as mmail,position from candidate_form_details where id='$enquiey_created'"; */
		$stmtb->execute(); 
		$rowb        = $stmtb->fetch();
		$fnames = $rowb['fnames'];
		$pphone = $rowb['pphone'];
		$mmail = $rowb['mmail'];
		$position = $rowb['position'];
		$ccontact_person = $rowb['ccontact_person'];
		echo $oorg_name = $rowb['oorg_name'];
		echo $exxtra_file = $rowb['exxtra_file'];
		
$count = sizeof($costsheet_id);


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
    /* border: none; */
}
.border>tbody>tr>td, .border>tbody>tr>th, .border>tfoot>tr>td, .border>tfoot>tr>th, .border>thead>tr>td, .border>thead>tr>th {
    
   border :1px  solid  black;
}
.m_b_0px {
	margin-bottom: 0px !important;
}
.container{
	width:500px;
    margin: 0 auto;
    text-align: center;
}
table, th, td {
  border: 1px solid black;
}
</style>

<?php 
 class fetch_data{
 public $costsheet_id;
	function fetch_quote_data($con,$costsheet_id,$client_name,$QuoteNo){ 
	
	$stmt= $con->query("SELECT a.id as costsheet_id,a.cost_sheet_no as cst_no,a.*,b.*,e.*,f.*,g.*,h.*,i.employee as acc_manager,b.org_name as cname,p.*,ci.*,s.* from cost_sheet_entry a 
		 inner join new_client_master b on(b.id=a.client_id) 
		 inner join new_plant_master p on b.org_name=p.client_org_name
		 inner join states s on p.state=s.id
		 inner join cities ci on p.city=ci.id
		 inner join product_services f on (f.id = a.business_id)
		inner join staff_master e ON e.candid_id=a.candid_id 
		inner join z_user_master g ON (g.candidate_id = e.id)
		inner join quote_generate h on(h.cost_sheet_no=a.cost_sheet_no)
		join Enquiry i on (a.enquiry_id=i.id)
		where a.id='$costsheet_id'  and a.status ='2' ");
		echo "SELECT a.id as costsheet_id,a.cost_sheet_no as cst_no,a.*,b.*,e.*,f.*,g.*,h.*,i.employee as acc_manager,b.org_name as cname,p.*,ci.*,s.* from cost_sheet_entry a 
		 inner join new_client_master b on(b.id=a.client_id) 
		 inner join new_plant_master p on b.org_name=p.client_org_name
		 inner join states s on p.state=s.id
		 inner join cities ci on p.city=ci.id
		 inner join product_services f on (f.id = a.business_id)
		inner join staff_master e ON e.candid_id=a.candid_id 
		inner join z_user_master g ON (g.candidate_id = e.id)
		inner join quote_generate h on(h.cost_sheet_no=a.cost_sheet_no)
		join Enquiry i on (a.enquiry_id=i.id)
		where a.id='$costsheet_id'  and a.status ='2' ";
	/* echo"hii". "SELECT a.id as costsheet_id,a.cost_sheet_no as cst_no,a.*,b.*,e.*,f.*,g.*,h.*,i.employee as acc_manager,b.org_name as cname,p.*,ci.*,s.* from cost_sheet_entry a 
		 inner join new_client_master b on(b.id=a.client_id) 
		 inner join new_plant_master p on b.org_name=p.client_org_name
		 inner join states s on p.state=s.id
		 inner join cities ci on p.city=ci.id
		 inner join product_services f on (f.id = a.business_id)
		inner join staff_master e ON e.candid_id=a.candid_id 
		inner join z_user_master g ON (g.candidate_id = e.id)
		inner join quote_generate h on(h.cost_sheet_no=a.cost_sheet_no)
		join Enquiry i on (a.enquiry_id=i.id)
		where a.id='$costsheet_id'  and a.status ='2'"; */
		
		$stmt->execute(); 
		$row        = $stmt->fetch();
		$company_id = $row['company_id'];
		$cost_sheet_no = $row['cost_sheet_no'];
		$cost_sheet_no = $row['cost_sheet_no'];
		echo$cost_sheet_nob=$row['cost_sheet_no'];
		
		
		$quote_date = date('d-m-Y', strtotime($row['quote_date']));
		if($row['quote_type']==1){  
		   $currency = "INDIAN RUPEES"; 
		}else{ 
		   $currency = "DOLLAR RUPEES"; 
		}
		$QuoteNo    = $row['quote_no'];
		$quote_type = $row['quote_type'];
	    $design_id  = $row['design_id'];
		$acc_manager  = $row['acc_manager'];
		//$from_id  = $row['from_id'];
 $output = '<div style="font-size:15px;font-weight:normal;page-break-inside:avoid;page-break-after:always">
 <table width="710px" style="text-align:left; border: none;">
	<tr><td colspan="5"><img src="/ssinfo1/images/04.png" alt="SS-Information" width=300px; height=100px;><br/></br>
	<div class="container1"> 
	<h4 align="center"><b>QUOTATION</b></h4> </div></td>
	</tr>
	</table>
<TABLE width="710px" style="border: 1px solid black;">
 <tr style="border:1px solid black;"> 
		  <td colspan="3"> <div style="font-weight:bold;font-size:17px;">SS Information Systems Private Limited</div>
		  <div style="margin-top:5px;font-size:13px;"> No.1/102, First Floor, Periyar Pathai (West)</div>
		  <div style="font-size:13px;">100 Feet Road, Arumbakkam, Chennai-600 106.,</div><br/></td>
		</tr>
		<tr style="border :1px  solid  black;font-size:13px;border-bottom-style: groove ! important;border-bottom: 1px solid black;"> 
		<td height="30px"><div style="float: left;"><div style="float: left;font-weight:bold;">E-Mail : <div style="font-weight:bold;font-size:13px;">Phone No : </div></div><div style="float: left;margin-left:60px;">info@ssinformation.in<div style="font-size:13px;margin-left:30px;">044 23623544</div></div></div></td>
		<td height="40px"><div style="float: right;margin-top:1px;"><div style="float: left;font-weight:bold;">GST NO : <div style="float: left;margin-left:60px;font-weight:normal;">33AAACQ0129P1ZG</div></div></td>	  
		</tr>
		<tr style="border :1px  solid  black;font-size:13px;"> 
		<td><b>Quote.NO : </b>'. $QuoteNo.'<br/><br/>
		
		<b>Date : </b>'. $quote_date.' 
		
		</td>
		<td><b>Ref.No.  : </b>'. $row['quote_no'].'<br/><br/>
		<b>Currency : </b>'. $currency .'
		</td>
		<td><b>AcctManager : </b>'. $row['emp_name'].'<br/><br/>
		<b>Mobile No : </b>'. $row['mobile_no'].'
		</td>
	 
	  </tr>
	  
	  <tr style="border:1px solid black;border-top-style: hidden;font-size:13px;">
	  <td colspan="3" style="font-size:13px;"><b><u>Client Name & Details : </u></b><br>'. $row['org_name'].'</b><br/><b>Contact Person : </b> '. $row['contact_person'].'<br/>
	  <b> Address : </b>'. $row['address'].','. $row['area'].',<br/>,'. $row['city_name'].','. $row['pincode'].',<br/>,'. $row['statename'].'</b><br/><br/>
	  <b>Mobile No : </b>'. $row['mobile_no'].'<br/><br/>
	  <b>Dear Sir,</b><br/>
		<b> As per your requirement, please find attached below our proposal</b>
	 </td>
	  </tr>
 <table id="dataTable" width="710px"  border="1" style="font-size:13px;border-collapse:collapse;border: 1px solid !important;" class="table border m_b_0px"> 
		  <TR>
			<th>SLNO.</th>
		   <th>SPECIFICATION</th>
		   <th>QTY</th>
		   <th>UNIT</th>
		   <th>UNIT RATE</th>	
		   <th>TOTAL</th>
		   
		   <th>GST PERCENTAGE</th>
		   <th>GST AMOUNT</th>

		   <th>IGST PERCENTAGE</th>
		   <th>IGST AMOUNT</th>	
		   
		  
		   <th>TOTAL WITH GST</th>
		 </TR> ';
		 
						$queryd =  $con->prepare("SELECT cost_sheet_no, SUM(gst_amt) as gst_score,SUM(igst_amount) as igst_score from cost_sheet_entry where cost_sheet_no='$cost_sheet_nob'");

                            $queryd->execute();
                            $rowd = $queryd->fetch();
                            $gst_score=$rowd['gst_score'];
                            $igst_score=$rowd['igst_score'];
							$total_score=$gst_score+$igst_score;
                            $gst_split=$gst_score/2;
							
                            $first_score=$gst_split;
                            $second_score=$gst_split;
							
						
						
						
		 $query= $con->query("SELECT a.id as costsheet_id,a.*,b.*,e.* from cost_sheet_entry a 
				 inner join new_client_master b on(b.id=a.client_id) 
				 inner join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='2' and a.cost_sheet_no='$cost_sheet_nob' order by a.id desc"); 
				 echo "SELECT a.id as costsheet_id,a.*,b.*,e.* from cost_sheet_entry a 
				 inner join new_client_master b on(b.id=a.client_id) 
				 inner join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='2' and a.cost_sheet_no='$cost_sheet_nob' order by a.id desc"; 
				
		 $sum_total="";
		 $cnt=1;
			 while($quote = $query->fetch(PDO::FETCH_ASSOC)){
		  
			            $net_amt    = $quote['net_amt'];
						$gst_per    = $quote['gst_per'];
						$gst_amt    = $quote['gst_amt'];
						$igst_per    = $quote['igst_per'];
						$igst_amount    = $quote['igst_amount'];
						$grand_totals= $quote['grand_amt'];
				 
					$sum_total = $quote['total_price'];
					$gst    = $quote['gst_per'];
					$withgst     = ($net_amt)*($gst/100);
					$grand_total = round($withgst+$net_amt);
					
					 
					
					if($gst =='18') {     $SGST_cal  = ($net_amt)*(9/100); 
					}elseif($gst =='28'){ $SGST_cal  = ($net_amt)*(14/100); 
					}elseif($gst =='3'){ $SGST_cal  = ($net_amt)*(1.5/100); 
					}elseif($gst =='5'){ $SGST_cal  = ($net_amt)*(2.5/100); 
					}elseif($gst =='12'){ $SGST_cal  = ($net_amt)*(6/100); 
					}else{ $SGST_cal = ($net_amt)*(0/100); }
					
					 if($gst =='18') {     $CGST_cal  = ($net_amt)*(9/100); 
					}elseif($gst =='28'){ $CGST_cal  = ($net_amt)*(14/100); 
					}elseif($gst =='3'){ $CGST_cal  = ($net_amt)*(1.5/100); 
					}elseif($gst =='5'){ $CGST_cal  = ($net_amt)*(1.5/100); 
					}elseif($gst =='12'){ $CGST_cal  = ($net_amt)*(6/100); 
					}else{ $CGST_cal = ($net_amt)*(0/100); }
					
					if($gst =='18') {  
					   $sgst_per =  "9 %"; 
					}elseif($gst =='28'){
					   $sgst_per =  "14%"; 
					}elseif($gst =='3'){
					   $sgst_per =  "1.5%"; 
					}elseif($gst =='5'){
					   $sgst_per =  "2.5%"; 
					}elseif($gst =='12'){
					   $sgst_per =  "6%"; 
					}
					
					if($gst =='18') {  
					   $cgst_per =  "9 %"; 
					}elseif($gst =='28'){
					   $cgst_per =  "14%"; 
					}elseif($gst =='3'){
					   $cgst_per =  "1.5%"; 
					}elseif($gst =='5'){
					   $cgst_per =  "2.5%"; 
					}elseif($gst =='12'){
					   $cgst_per =  "6%"; 
					}
					$totalamt = $quote['total_amt'];echo "<br/>";
					 $iteam_rate = $totalamt/$quote['qty'];
					 
					 $tax_amount = $SGST_cal + $CGST_cal + $igst_amount;
		 
		 $output .= '<TR>
		   <TD>'. $cnt.'. </TD>
		   <TD> '. $quote['specification'].'</TD>
		   <TD>'. $quote['qty'].'</TD>
		   <TD> '.$quote['unit'].'</TD>
		   <TD> '.$iteam_rate.'</TD>
		    <TD> '. $quote['total_amt'].'</TD>
		    <TD> '. $quote['gst_per'].'</TD>
		    <TD> '. $quote['gst_amt'].'</TD>
		    <TD> '. $quote['igst_per'].'</TD>
		    <TD> '. $quote['igst_amount'].'</TD>
		    <TD> '. $quote['total_gst'].'</TD>
				
			
			<input type="hidden" readonly="readonly" id="costsheet_id1" name ="costsheet_id[]" value ="'. $quote['costsheet_id'].'">
		 </TR>';
		  $cnt=$cnt+1; 
		  } 
		 $output .= '<TR>
		   <TH colspan="9" style="text-align:right;">SUB TOTAL </TH>
		   <TH colspan="2">'.$net_amt.'</TH>
		 </TR>

		 
		 <TR>
		   <TH colspan="9" style="text-align:right;">GRAND TOTAL </TH> 
		   <TH colspan="2">'.$grand_totals.'</TH>
		 </TR>
	   </table>
	 
 </TABLE>
 <div style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;min-width:708px;">
	<div>
	<u><b>Tax Summary</b></u>
	</div>
<br>
    <div style="margin-left:400px;">
		<u><b> Tax Details :   </b></u><br/>
		SGST  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '. $first_score.'
				<br/>
				CGST  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '. $second_score.'<br/>
				IGST  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '. $igst_score.'<br/>
				.............................................................. <br/>
			<b> Tax Amount  : &nbsp;&nbsp;&nbsp;&nbsp; '. $total_score.'<b/><br/>
				.............................................................. <br/>
	      <br/><br/>
	</div>
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
';
 //terms and condition query
                $query2=  $con->prepare("select a.*,b.*,c.* from staff_master a inner join designation_master b on 
		                  (b.id = a.design_id) inner join z_user_master c on (c.candidate_id=a.id) where a.id = '$acc_manager'");
				   /* echo "select a.*,b.*,c.* from staff_master a inner join designation_master b on 
		                  (b.id = a.design_id) inner join z_user_master c on (c.candidate_id=a.id) where a.id = '$acc_manager'"; */ 
						 //echo "select designation_name from designation_master where id ='$design_id'";
						$query2->execute(); 
						$row2 = $query2->fetch();
						
				$query1=  $con->prepare("select * from terms_and_condition where cost_sheet_no ='$cost_sheet_no'");
				  //echo "select * from terms_and_condition where cost_sheet_no ='$cost_sheet_no'";
						$query1->execute(); 
						$row1 = $query1->fetch();
			
	 $output .= ' 
	 
		 <div style="text-align:left;">
		   <img src="/ssinfo1/images/04.png" alt="SS-Information">
		 </div>
		  <div class="container2"><br/>
		 <div style="text-align:center;font-weight:bold;page-break-inside: avoid;">QUOTATION</div>
<div style="margin-top: -300px;font-size:13px;min-width:708px;min-height:400px;border-top: 1px solid black;border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">
		 <u><b>Terms and Condition</b></u>
<br/>
		 <div style="width: 100%;margin-left: 3%;margin-top:10px;">
			<div style="width: 20%; height: auto; float: left;"> 
			VALIDITY :
			</div>
			<div style="margin-left: 20%; height: auto;"> 
			'. $row1['validity'].'
			</div>
	    </div>



<br/>

		<div style="width: 100%;margin-left: 3%;">
		<div style="width: 20%; height: auto; float: left;"> 
		IMPORTANT :
		</div>
		<div style="margin-left: 20%; height: auto;"> 
		'. $row1['important'].'
		</div>
		</div>

<br/>

		<div style="width: 100%;margin-left: 3%;">
		<div style="width: 20%; height: auto; float: left;"> 
		DELIVERY :
		</div>
		<div style="margin-left: 20%; height: auto;"> 
		'. $row1['delivery'].'
		</div>
		</div>

<br/>

		<div style="width: 100%;margin-left: 3%;">
		<div style="width: 20%; height: auto; float: left;"> 
		WARRANTY :
		</div>
		<div style="margin-left: 20%; height: auto;"> 
		'. $row1['warrenty'].'
		</div>
		</div>
<br/>
		<div style="width: 100%;margin-left: 3%;">
			<div style="width: 20%; height: auto; float: left;"> 
			PAYMENT :
			</div>
			<div style="margin-left: 20%; height: auto;"> 
			'. $row1['payment'].'
			</div>
	    </div>
		<br/>
		
		<div style="width: 100%;margin-left: 3%;">
			<div style="width: 50%; height: auto; float: left;"> 
			<u><b>BANK DETAILS FOR NEFT / RTGS / IMPS</b></u>
			</div>
		<div style="margin-left: 50%; height: auto;"> 
		</div>
		</div>
<br/>
<br/>
<div style="width: 100%;margin-left: 3%;">
			<div style="width: 20%; height: auto; float: left;"> 
			ACC HOLDER NAME : 
			</div>
			<div style="margin-left: 20%; height: auto;"> 
			'. $row1['acc_holder_name'].'
			</div>
	    </div>
<br/>
        <div style="width: 100%;margin-left: 3%;">
			<div style="width: 20%; height: auto; float: left;"> 
			BANK NAME : 
			</div>
			<div style="margin-left: 20%; height: auto;"> 
			'. $row1['bank_name'].'
			</div>
	    </div>

<br/>
<div style="width: 100%;margin-left: 3%;">
			<div style="width: 20%; height: auto; float: left;"> 
			BRANCH NAME : 
			</div>
			<div style="margin-left: 20%; height: auto;"> 
			'. $row1['branch_name'].'
			</div>
	    </div>
<br/>

		<div style="width: 100%;margin-left: 3%;">
			<div style="width: 20%; height: auto; float: left;"> 
			CURRENT A/C NO :
			</div>
			<div style="margin-left: 20%; height: auto;"> 
			'. $row1['account_no'].'
			</div>
		</div>

<br/>

		<div style="width: 100%;margin-left: 3%;">
			<div style="width: 20%; height: auto; float: left;"> 
			IFSC CODE : 
			</div>
			<div style="margin-left: 20%; height: auto;"> 
			'. $row1['ifsc_code'].'
			</div>
		</div>

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		<div style="width: 100%;border-top: 1px solid black;border-bottom: 1px solid black;height:100px;">
			<div style="width: 50%; height: 100px; float: left;border-right: 1px solid black;"> 
				<div style="min-height:30px"><br/><br/>
				</div>
				<div style="border-top: 1px solid black;min-height:30px;margin-top:10px;">
				<p style="margin-left:20px;">'. $get_amount= AmountInWords($grand_totals).'</p>
				</div>
			</div>
			<div style="height: auto;"> 
			
			<div style="width: 50%;margin-top:10px;">
				<div style="width: 75%; height: 70px; float: left; background: white;"> 
				<div style="margin-top:12px;"> Net Amount   : </div>
				</div>
				<div style="float: left; height: 70px; background: white;"> 			
				<div style="margin-top:12px;"> '.$grand_totals.' </div>
				</div>
		    </div>

			</div>

        </div>
		<div style="margin-left:65%;justify-content: center;">
		<br/>
		<div style="font-weight:bold;">'. $row2['emp_name'].'</div>
		<div style="font-weight:bold;">'. $row2['designation_name'].'</div>
		<div style="font-weight:bold;">Mobile No : '. $row2['mobile_no'].'</div>
		<div style="font-weight:bold;">Email Id : '. $row2['email_id'].'</div>
		<br/>
		</div>
		</div>
</div>';    
	  return $output;
	 }
   
} 
for($i=0;$i<$count;$i++)
{  

	$quote_query = $con->query("SELECT a.id as costsheet_id,a.cost_sheet_no as cst_no,p.email1 as email_id1,a.enquiry_id as enquir_id,a.*,b.*,e.*,f.*,g.*,h.*,i.employee as acc_manager,h.quote_no as quote_no,g.full_name as full_name,i.mail,i.employee as cc_mail from cost_sheet_entry a inner join new_client_master b on(b.id=a.client_id) inner join new_plant_master p on b.org_name=p.client_org_name inner join product_services f on (f.id = a.business_id) inner join staff_master e ON e.candid_id=a.candid_id inner join z_user_master g ON (g.candidate_id = e.id) inner join quote_generate h on(h.cost_sheet_no=a.cost_sheet_no) join Enquiry i on (a.enquiry_id=i.id)
		where a.id='$costsheet_id'   ");
		echo "SELECT a.id as costsheet_id,a.cost_sheet_no as cst_no,p.email1 as email_id1,a.*,b.*,e.*,f.*,g.*,h.*,i.employee as acc_manager,h.quote_no as quote_no,g.full_name as full_name from cost_sheet_entry a inner join new_client_master b on(b.id=a.client_id) inner join new_plant_master p on b.org_name=p.client_org_name inner join product_services f on (f.id = a.business_id) inner join staff_master e ON e.candid_id=a.candid_id inner join z_user_master g ON (g.candidate_id = e.id) inner join quote_generate h on(h.cost_sheet_no=a.cost_sheet_no) join Enquiry i on (a.enquiry_id=i.id)
		where a.id='$costsheet_id'  and a.status ='2' ";
		
/* 	echo "SELECT a.id as costsheet_id,a.*,b.*,e.*,f.*,g.*,h.* from cost_sheet_entry a 
		 inner join client_master b on(b.id=a.client_id) 
		 inner join `product/services` f on (f.id = a.business_id)
		INNER JOIN staff_master e ON e.candid_id=a.candid_id 
		inner join z_user_master g ON (g.candidate_id = e.id)
		inner join quote_generate h on(h.cost_sheet_id=a.id)
		where a.id='$costsheet_id'  and a.status ='2' "; */
	$quote_query->execute(); 
	$row        = $quote_query->fetch();
}	 
	$mailerID = $row['mail']; echo $mailerID;
	 $sendmail       = $row['email_id1'];echo "<br/>";
	 $client_name    = $row['org_name'];echo "<br/>";
    $cost_sheet_no  = $row['cost_sheet_no'];echo "<br/>";
	 //$cost_sheet_no  = $row['cost_sheet_no'];
	 $enquiry_id     = $row['enquir_id'];echo "<br/>";
    $QuoteNo        = $row['quote_no'];echo "<br/>";
    $emp_name1        = $row['emp_name'];echo "<br/>";
	echo$cc_mail_id        = $row['cc_mail'];
	
	$quote_qrty = $con->query("SELECT user_name,candidate_id from z_user_master where candidate_id='$cc_mail_id'");
		
	$quote_qrty->execute(); 
	$vaalu        = $quote_qrty->fetch();
	echo$cc_mail        =$vaalu['user_name'];
	
    //$CHECKMAIL ='umadevidevi284@gmail.com';
    //$cname ='client';
	$user_id =$_SESSION['userid'];
	$candidateid=$_SESSION['candidateid'];	
	$class_quote = new fetch_data();
	$class_quote->fetch_quote_data($con,$costsheet_id,$client_name,$QuoteNo);  

$sub='Quotation from SS Information by '.$emp_name1;
	
	$file_name = 'SS Info Quotation'.'.pdf';
	$html_code = '<link rel="stylesheet" href="bootstrap.min.css">';
	
	
	$html_code .=  $class_quote->fetch_quote_data($con,$costsheet_id,$client_name,$QuoteNo);
	//$grabzIt->SaveTo("images/result.jpg");
	$pdf = new Pdf();
	$pdf->setPaper('A4', 'portrait');
	$pdf->load_html($html_code);
	$pdf->render();
	$file = $pdf->output();
	
	file_put_contents($file_name, $file);
	
	//require 'class/class.phpmailer.php';
	
if($exxtra_file!=''){
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
	$mail->AddAddress($sendermail, $client_name);		//Adds a "To" address
	$mail->AddCC($cc_mail);
	//$mail->AddBCC('laxmipriya@bluebase.in');
	
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	//$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
    $mail->addAttachment("uploads/".$exxtra_file);
   // $mail->AddAttachment( $file_to_attach,'$exxtra_file');
    $mail->Subject = $sub;			//Sets the Subject of the message
	$mail->Body = "Dear&nbsp;&nbsp;$ccontact_person ,  <br> <br>

		&nbsp;&nbsp;	Please Find the Quote / Proposal in Attached PDF File..!   <br> <br>
		
		&nbsp;&nbsp;   Greetings! <br> <br>
		&nbsp;&nbsp; <b> Thanks & Regards </b> <br> <br>
		&nbsp;&nbsp; <b> $fnames  </b> <br> <br>
		&nbsp;&nbsp; <b> $position </b> <br> <br>
		&nbsp;&nbsp; <b> $pphone </b> <br> <br> 
		&nbsp;&nbsp; <b> $mmail </b> ";	
	}else{
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
	$mail->AddAddress('antoajith.d@bluebase.in', $client_name);		//Adds a "To" address
	//$mail->AddCC('info@ssinformation.in');
	//$mail->AddBCC('laxmipriya@bluebase.in');
	
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	//$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
   // $mail->AddAttachment( $file_to_attach,'$exxtra_file');
    $mail->Subject = $sub;			//Sets the Subject of the message
	$mail->Body = "Dear&nbsp;&nbsp;$ccontact_person ,  <br> <br>

		&nbsp;&nbsp;	Please Find the Quote / Proposal in Attached PDF File..!   <br> <br>
		
		&nbsp;&nbsp;   Greetings! <br> <br>
		&nbsp;&nbsp; <b> Thanks & Regards </b> <br> <br>
		&nbsp;&nbsp; <b> $fnames  </b> <br> <br>
		&nbsp;&nbsp; <b> $position </b> <br> <br>
		&nbsp;&nbsp; <b> $pphone </b> <br> <br> 
		&nbsp;&nbsp; <b> $mmail </b> ";	
	}
	 if($mail->Send())								//Send an Email. Return true on success or false on error
	{  
     	echo "Success";
		$message = '<label class="text-success">Quote Details has been send successfully...</label>';echo $message;
	    $update_query = $con->query("update ax Summary_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'");  
		echo "update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'";
	} elseif(!$mail->send()) {
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
	   echo "0";
   } 
  

	$update_query = $con->query("update quote_generate set status ='1', modified_by ='$candidateid',modified_on =NOW() WHERE quote_no= '$QuoteNo'");      		
	$update_query1 = $con->query("update cost_sheet_entry set status ='2', modified_by ='$candidateid',modified_on =NOW() WHERE cost_sheet_no= '$cost_sheet_nos'");
   echo "update cost_sheet_entry set status ='2', modified_by ='$candidateid',modified_on =NOW() WHERE cost_sheet_no= '$cost_sheet_nos'";
		$insert_query2= $con->query("Update enquiry set status='5' where id='$enquiry_id'"); 
		echo "Update enquiry set status='5' where id='$enquiry_id'"; 
	unlink($file_name);

	 $class_quote->fetch_quote_data($con,$costsheet_id,$client_name,$QuoteNo);
	
     $mail->clearAttachments();
	
?>
