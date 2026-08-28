<?php
require '../../../connect.php';
include("../../../user.php");
$vendor_id = $_REQUEST['id']; // This is actually receiving quote_id or vendor_id from list page

// Changed INNER JOIN to LEFT JOIN to prevent data hiding, and check quote_id OR vendor_id
$stmt = $con->query("SELECT a.id as quote_id, a.*, b.*, c.*, e.*, d.* FROM quotation_entry a 
		 LEFT JOIN client_master b ON(b.id=a.client_id) 
		 LEFT JOIN doller_vendor_mastor c ON(c.id=a.vendor_id)
		 LEFT JOIN company_master d ON(d.id=a.company_id)
		 LEFT JOIN staff_master e ON e.candid_id=a.candid_id
		 WHERE a.status ='1' AND (a.id='$vendor_id' OR a.vendor_id='$vendor_id') LIMIT 1");
 
$stmt->execute(); 
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Safety Fallback: If DB returns false, initialize empty array to prevent warning errors!
if (!$row) {
    $row = [
        'company_id' => '', 'companyname' => 'Company Not Found', 'address' => '', 'email_id' => '',
        'gst_no' => '', 'phone_no' => '', 'quote_no' => '', 'quote_date' => date('Y-m-d'),
        'quote_type' => '1', 'client_name' => 'Client Not Found', 'address1' => '', 'address2' => '',
        'area' => '', 'town_city' => '', 'pincode' => '', 'district' => '', 'state' => '',
        'country' => '', 'mobile_no1' => '', 'mobile_no2' => '', 'gst_percentage' => '18',
        'account_name' => '', 'account_no' => '', 'ifsc_code' => '', 'name' => '',
        'position' => '', 'mobile_num' => '', 'candid_id' => ''
    ];
}
$company_id = $row['company_id'];

// Default safe initialization for math variables to prevent undefined warnings
$sum_total = 0;
$withgst = 0;
$tax_amount = 0;
$grand_total = 0;
$SGST_cal = 0;
$CGST_cal = 0;
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
	 width:500px;
}
</style>
<div class="card-body">

    <div class="col-sm-12">
	<div class="col-sm-12"  style="text-align:left;">
	   <img src="../../Recruitment/image/userlog/quadsel.png" alt="quadsel">
	</div>
	<div class="col-sm-12 row2"  style="text-align:right;">
	  <input type ="hidden" name="vendor_id" id ="vendor_id" value="<?php echo $vendor_id; ?>">
	   
	  <a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a> &nbsp;&nbsp;
	   <input type="button" class="btn btn-success" id="save" name="save" onclick="approve_quote()"  value="Quote Approve">
	   
	   &nbsp;<br/><br/>
	</div>
    <h4 align="center"><b><u>QUOTATION</u></b></h4> 
	<div class="col-sm-12 row1">
		<div class="col-sm-12"><p><h4> <b>
		<?php echo $row ['companyname']; ?>
		</b></h4></p>
		</div>
		<div class="col-sm-12"><p><?php echo $row['address'];?></p>
		 </div>
		 <div class="col-sm-12 row2">&nbsp;</div>
		 <div class="col-sm-3" style="text-align:left;"><b>E-Mail : </b><?php echo $row['email_id'];?></div>
		 <div class="col-sm-3" style="text-align:center;"><b>GST NO : </b><?php echo $row['gst_no'];?></div>
		 <div class="col-sm-3" style="text-align:right;"><b>PHONE NO : +91 </b><?php echo $row['phone_no'];?></div>
		 <div class="col-sm-3">&nbsp;&nbsp;</div>
		 <!--<div class="col-sm-6"><b>PAN : </b></div>
		 <div class="col-sm-6"><b> </b></div>
		 <div class="col-sm-6"><b>CIN No : </b></div>-->
		 <div class="col-sm-12 row2">&nbsp;</div>
	</div> 
	<div class="col-sm-12 row1">
	     <div class="col-sm-12 row2">&nbsp;</div>
		 <div class="col-sm-4"><b>Quot. NO : </b><?php echo $row['quote_no'];?></div>
		 <div class="col-sm-4"><b>Ref. No.  : </b><?php echo $row['quote_no'];?></div>
		 <div class="col-sm-4"><b>Acct Manager : </b><?php //echo $row['quote_no'];?></div>
		 <div class="col-sm-12 row2">&nbsp;</div>
		 <div class="col-sm-4"><b>Date : </b><?php echo $quote_date = date('d-m-Y', strtotime($row['quote_date'])); ?></div>
		 <div class="col-sm-4"><b>Currency : </b><?php if($row['quote_type']==1){ echo "INDIAN RUPEES"; }else{ echo "Dollar RUPEES"; }?></div>
		 <div class="col-sm-12 row2">&nbsp;</div>
	</div>

	<div class="col-sm-12 row1">
	   <div class="col-sm-12 row2">&nbsp;</div>
	   <div class="col-sm-12"><p><b><u>Client Name & Details </u></b></p></div>
	   <div class="col-sm-12"><p><b><?php echo $row['client_name']; ?></b></p></div>
	   <div class="col-sm-12"><p><b> Address : </b><?php echo $row['address1']; ?>,<?php echo $row['address2']; ?>,<br/><?php echo $row['area']; ?>,<?php echo $row['town_city']; ?>,<?php echo $row['pincode']; ?>,<br/><?php echo $row['district']; ?>,<?php echo $row['state']; ?>,<?php echo $row['country']; ?></b></p></div>
	   <div class="col-sm-12"><p><b>Mobile No : </b><?php echo $row['mobile_no1']; ?>,<?php echo $row['mobile_no2']; ?></p></div>
	   <div class="col-sm-12"><p><b>Dear Sir,</b><br/>
	  As per your requirement, please find attached below our proposal for HP 280 Pro G6 Desktops</p></div>
	</div>

	<div class="col-sm-12 row1"><br/>
		 <TABLE id="dataTable" width="350px" border="1" style="border-collapse:collapse;" class="table table-bordered"> 
			<TR>
			   <th>SLNO.</th>
			  <th>SPECIFICATION</th>
			  <th>QTY</th>
			  <th>UNIT RATE</th>
			  <TH formula="cost*qty" summary="sum">AMOUNT</TH>
			</TR>
			<?php    
$query = $con->query("SELECT a.id as quote_id, a.*, b.*, c.*, e.* FROM quotation_entry a 
	 LEFT JOIN client_master b ON(b.id=a.client_id) 
	 LEFT JOIN doller_vendor_mastor c ON(c.id=a.vendor_id)
	 LEFT JOIN staff_master e ON e.candid_id=a.candid_id  
	 WHERE a.status ='1' AND (a.id='$vendor_id' OR a.vendor_id='$vendor_id')"); 

$sum_total = 0;
$cnt = 1;
while($quote = $query->fetch(PDO::FETCH_ASSOC)) {
    $sum_total += $quote['amount'];
    $gst = !empty($row['gst_percentage']) ? $row['gst_percentage'] : '18';
    $withgst = ($sum_total) * ($gst / 100);
    $grand_total = round($withgst + $sum_total);
    
    if($gst == '18') { $SGST_cal = ($sum_total) * (9/100); }
    elseif($gst == '28') { $SGST_cal = ($sum_total) * (14/100); }
    else { $SGST_cal = 0; }
    
    if($gst == '18') { $CGST_cal = ($sum_total) * (9/100); }
    elseif($gst == '28') { $CGST_cal = ($sum_total) * (14/100); }
    else { $CGST_cal = 0; }
    
    $tax_amount = $SGST_cal + $CGST_cal;
			?>
			<TR>
			  <TD><?php echo $cnt;?>. </TD>
			  <TD> <?php echo $quote['specification']; ?></TD>
			  <TD><?php echo $quote['qty']; ?></TD>
			  <TD> <?php echo $quote['unit_rate']; ?></TD>
			  <TD> <?php echo $quote['amount']; ?></TD>
			   <input type="hidden" readonly="readonly" id="quote_id1" name ="quote_id[]" value ="<?php echo $quote['quote_id'];?>">
			</TR>
		    <?php $cnt=$cnt+1; } ?>
			<TR>
			  <TH colspan="4" style="text-align:right;">SUB TOTAL </TH>
		      <TH><?php  echo $sum_total;?></TH>
			</TR>
			<TR>
			   <TH colspan="4" style="text-align:right;">Add GST @ <?php echo $gst;?> %</TH>
			   <TH><?php echo $withgst ;?></TH> 
			</TR>
			<TR>
			  <TH colspan="4" style="text-align:right;">GRAND TOTAL </TH> 
			  <TH><?php echo round($grand_total); ?></TH>
			</TR>
		  </TABLE>
	</div>

	<div class="col-sm-12 row1">  
	<div class="col-sm-12"><br/></div>
	  <div class="col-sm-6 " style="text-align:left;"><u><b>Tax Summary</b></u></div> 
	  <div class="col-sm-6" style="text-align:center;">
			<u><b>Tax Details : &nbsp;&nbsp; </b></u><br/>
			SGST  &nbsp;&nbsp;&nbsp;&nbsp;  <?php if($gst =='18') {  echo "9 %";   ?> &nbsp;&nbsp;&nbsp;&nbsp;
			<?php 
			echo "$SGST_cal"; }elseif($gst =='28'){ echo "14 %" ; echo "$SGST_cal"; }else{ echo "0 %"; echo "$SGST_cal"; }?>  
			<br/>
			CGST  &nbsp;&nbsp;&nbsp;&nbsp;
			 <?php if($gst =='18') {  echo "9 %";  ?> &nbsp;&nbsp;&nbsp;&nbsp;
			<?php  echo "$CGST_cal"; }elseif($gst =='28'){ echo "14 %" ; echo "$CGST_cal"; }else{ echo "0 %"; echo "CGST_cal"; }?> <br/>
			.............................................................. <br/>
			 <b> Tax Amount  : <?php echo  $tax_amount ?><b/><br/>
			.............................................................. <br/>
			<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		
	 </div>	  
	</div>
<!--</diV>-->
    <div class="col-sm-12">E. & O.E</div>
    <div class="col-sm-12 row1"><br/>
        <TABLE id="dataTable" width="350px" border="1" style="border-collapse:collapse;" class="table table-bordered">
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
				<div class="col-sm-3"><?php echo $row['account_name'];?></div>
			</div>
			<div class="form-group row">
			    <div class="col-sm-3">CURRENT A/C NO :</div>
				<div class="col-sm-3"><?php echo $row['account_no'];?></div>
			</div>
			<div class="form-group row">
			    <div class="col-sm-3">IFSC CODE :</div>
				<div class="col-sm-3"><?php echo $row['ifsc_code'];?></div>
			</div>
			</b>
            </td>
		  </tr>
		  <tr id="hidden_div1">
		    <th >IMPORTANT</th>
			<td>YOUR PO SHOULD BE IN FAVOUR OF QUADSEL SYSTEMS PVT LTD., “QUADSEL TOWERS”, Old No.80, New No.118, Manickam Lane, Anna Salai, Guindy, Chennai – 600 032. INDIA.</td>
		  </tr>
		   <!--<tr id="hidden_div2">
		    <th>IMPORTANT</th>
			<td>YOUR PO SHOULD BE IN FAVOUR OF QUADSEL SYSTEMS PVT LTD., “BLUE BASE SOFTWARE”, Old No.80, New No.118, Manickam Lane, Anna Salai, Guindy, Chennai – 600 032. INDIA.</td>
		  </tr>-->
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
			<td>100% PAYMENT IN ADVANCE<br/><br/><br/><br/><br/><br/>
		  </tr>
		  <TR>
			<TH style="text-align:center;" ><?php echo $get_amount= AmountInWords($grand_total); ?></TH>
			<TH style="text-align:left;">Amount  :  <?php echo $withgst;?> <br/><br/>
			Tax  :  <?php echo $tax_amount;?> <br/><br/>
			Net Amount   :  <?php echo round ($grand_total);?> <br/>
			</TH>
		  </TR>
		  <TR>
  <TH colspan= '2' style="text-align:center;"><b><br/>
    <?php echo !empty($row['name']) ? $row['name'] : 'Authorized Signatory'; ?><br/>
    <?php echo !empty($row['position']) ? $row['position'] : 'Sales Manager'; ?><br/>
    Mobile No : <?php echo !empty($row['mobile_num']) ? $row['mobile_num'] : '+91 9876543210'; ?><br/>
    Email Id : <?php echo !empty($row['email_id']) ? $row['email_id'] : 'info@quadsel.in'; ?><br/>
  </b></TH>
</TR>
        </TABLE>
    </div>
   <div class="col-sm-12">E. & O.E</div>
 
</div>

<script>
function back()

	{
		Quotation_approve()

	}
function approve_quote()
{
	
	var data  = $('form').serialize();
	var id    = document.getElementById("quote_id1").value;
    
	$.ajax({
	type:'GET',
	data:"id="+id, 
	url:"qvision/BusinessProcess/quotation/costsheet_approve_update.php",
	success:function(data)
	{      
		alert("Approved Successfully");
		    Quotation_approve();
				  
	}       
	});
}

</script>