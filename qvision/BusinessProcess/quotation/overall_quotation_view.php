<?php
require '../../../connect.php';
include("../../../user.php");
$costsheet_id=$_REQUEST['id'];


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
 /* echo "SELECT a.id as costsheet_id,a.cost_sheet_no as cst_no,a.*,b.*,e.*,f.*,g.*,h.*,i.employee as acc_manager,b.org_name as cname,p.*,ci.*,s.* from cost_sheet_entry a 
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
/* echo "SELECT a.id as costsheet_id,a.*,b.*,e.*,f.*,g.*,h.* from cost_sheet_entry a 
		 inner join client_master b on(b.id=a.client_id) 
		 inner join `product/services` f on (f.id = a.business_id)
		INNER JOIN staff_master e ON e.candid_id=a.candid_id 
		inner join z_user_master g ON (g.candidate_id = e.id)
		inner join quote_generate h on(h.cost_sheet_id=a.id)
		where a.id='$costsheet_id'  and a.status ='2' ";
 */
$stmt->execute(); 
$row        = $stmt->fetch();
$company_id = $row['company_id'];
$quote_type = $row['quote_type'];
$cost_sheet_no = $row['cst_no'];
$design_id  = $row['design_id'];
$acc_manager  = $row['acc_manager'];
//$quote_type = $row['quote_type'];
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
.table>tbody{
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
</style>
<section class="wage_content"></section>
<section class="content" id="content">
	<div class="container-fluid">
	 <div class="row">
	  <div class="card-body">
     <form action="" method="post" enctype="multipart/form-data">   
    <div class="col-sm-12">
	<!--<div class="col-sm-12"  style="text-align:left;">
	   <img src="../../ss-information/images/04.png" alt="ssinformation">
	</div>-->
	<div class="col-sm-12 row2"  style="text-align:right;">
	  <input type ="hidden" name="costsheet_id" id ="costsheet_id" value="<?php echo $costsheet_id; ?>">
	  
	 
	  <a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>BACK</a> &nbsp;&nbsp;

	  <?php /* if($row ['flag']==0){ ?>
	    
	  <?php }elseif($row ['flag']==1) { ?>
	   <input type="button" class="btn btn-success" id="save" name="save" onclick="quote_rewise()"  value="Rewise Quote">
	  <?php } */ ?>
	   <!--<input type="print" class="btn btn-success" id="print" name="print" onclick="window.print()"  value="print">-->
	   &nbsp;<br/><br/>
	</div>
	
	 
	 <table id="dataTable" width="350px" border="1" style="border-collapse:collapse;border: 1px solid !important;" class="table border m_b_0px">
	    <h4 align="center"><b><u>QUOTATION</u></b></h4> 

		<tr> 
		  <td colspan='5' style="padding:10px;"><h4> 
		     <b>SS Information Systems Private Limited</b><br/><br/>
		     No.1/102, First Floor, Periyar Pathai (West),<br>
			 100 Feet Road, Arumbakkam,Chennai,Tamil-Nadu 600 106
		 </td>
		</tr>
		<tr> 
		  <td colspan='1'style="padding:10px;"><b>Company E-Mail : </b>info@ssinformation.in</td>
		  <!--<td><b>GST NO : </b>33AAACQ0129P1ZG</td>-->
		  <td colspan='4'><b>Company Phone No : </b>044 2362 3544</td>
		</tr>
		<tr> 
		   <td colspan='1' style="padding:10px;"><b>Quote. NO : </b><?php echo $row['quote_no'];?><br/><br/>
		   <b>Currency : </b><?php $quote_type = $row['quote_type'];if($quote_type=='1'){ echo "INDIAN RUPEES"; }else{ echo "Dollar RUPEES"; }?>
		  </td>
		 
		 <?php $query1=  $con->prepare("select a.*,b.*,c.* from staff_master a inner join designation_master b on 
		                  (b.id = a.design_id) inner join z_user_master c on (c.candidate_id=a.id) where a.id = '$acc_manager'");
				  
			$query1->execute(); 
			$row4 = $query1->fetch();
		 ?>
		 
		 
		  <td colspan='2'>
		  <b>Acct Manager : </b><?php echo $row['emp_name'];?><br/><br/>
		   <b>Mobile Number : </b><?php echo $row['mobile_no'];?><br/><br/>
		   <b>Email : </b> <?php echo $row4['email_id'];?> <br/><br/>
		  </td>
		  
		   <td colspan='2'>
		   <b>Date : </b><?php echo $quote_date = date('d-m-Y', strtotime($row['quote_date'])); ?> <br/><br/>
		   
		  </td>
		</tr>
		
		<tr style="border:1px solid black; padding:10px;">
  		  <td colspan='5' style="padding:10px;">
		    <b><u>Client Name & Details </u></b><br/>
		   <?php echo $row['org_name']; ?> </b><br/>
		   <b>Contact Person : </b> <?php echo $row['contact_person']; ?><br/>
			  
  		 
			  <b> Address : </b><br><?php echo $row['address']; ?>,<br/>
			  <?php echo $row['area']; ?>,<?php echo $row['city_name']; ?>,<?php echo $row['pincode']; ?>,<br/><?php echo $row['statename']; ?></b><br/>
			  <b>Mobile No : </b><?php echo $row['mobile_no']; ?><br/><br/>
			  <b>Dear Sir,</b><br/>
				 As per your requirement, please find attached below our proposal
		  </td>
		</tr>
			
				<tr>
				<th>S.No</th>
				  <th>SPECIFICATION</th>
				  <th>QTY</th>
				  <!--th>UNIT</th-->
				  <th>UNIT RATE</th>
				  <th>TOTAL</th>
				</tr>
				<?php  
				$query= $con->query("SELECT a.id as costsheet_id,a.*,b.*,e.* from cost_sheet_entry a 
				 inner join new_client_master b on(b.id=a.client_id) 
				 inner join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='2' and a.cost_sheet_no='$cost_sheet_no' order by a.id desc"); 
				
				$sum_total=0;
				$cnt=1;
					while($quote = $query->fetch(PDO::FETCH_ASSOC)){
				 
				   $net_amt    = $quote['net_amt'];
						$gst_per    = $quote['gst_per'];
						$gst_amt    = $quote['gst_amt'];
						$igst_per    = $quote['igst_per'];
						$igst_amount    = $quote['igst_amount'];
						$grand_totals= $quote['grand_amt'];

					//$sum_total+= $quote['total_price'];
					$gst    = $row['gst_per'];
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
					}elseif($gst =='5'){ $CGST_cal  = ($net_amt)*(2.5/100); 
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
					//echo $quote['total_amt'];
					
                    //$logengcom =$quote['log_amt']+$quote['eng_amt']+$quote['com_amt'];
					
					 $tax_amount = $SGST_cal + $CGST_cal + $igst_amount;
				?>
				<tr>
		          <td><?php echo $cnt;?></td>
		          <td>
		           <INPUT type="hidden" id="cost_sheet_no" name="cost_sheet_no" class="form-control" value="<?php echo $quote['cost_sheet_no']; ?>" readonly="readonly">
			       <?php echo $quote['specification']; ?></td>
		           <td><?php echo $quote['qty']; ?></td>
				  <!--td><!?php echo $quote['unit']; ?></td-->
				  <td><?php echo $iteam_rate; ?></td>
		          <td><?php echo $quote['total_amt']; ?></td>
		
		
		  
				  <!--<td>
					<INPUT type="button" class="btn btn-success" value="Add " onclick="addRow('dataTable')" />
					<INPUT type="button" class="btn btn-danger" value="Delete" onclick="deleteRow('dataTable')" />
				   </td>-->
			  </tr>
				<?php $cnt=$cnt+1; } ?>
				 <tr>
				  <td colspan="4" align="center"><b>Net Amount</b></td>
		
				  <td align="left" colspan="5"><?php echo number_format($net_amt,2); ?>
				  </td>
				</tr>
				<tr>

				  <td colspan="4" align="center"><b>GST Persentage <?php echo $gst_per; ?>%</b></td>

				  <td colspan="5" align="left"><?php echo number_format($gst_amt,2); ?></td>
				</tr>
				<tr>
				<tr>
				  <td colspan="4" align="center"><b>IGST Persentage <?php echo $igst_per; ?>%</b></td>
				  <td colspan="5" align="left"><?php echo number_format($igst_amount,2); ?></td>
				</tr>
				<tr>
				  <td colspan="4" align="center"><b>Grand Total</b></td>
				  <td colspan="5" align="left">
					<?php echo number_format($grand_totals,2); ?>
				  </td>
				</tr>
			 
			 
			  <tr style="border-bottom-style: hidden;">
				   <TD colspan="6" style="text-align:left;"> <b>Tax Summary</b> </TD>
			  </tr>
			  <tr>
				   <TD colspan="6">
				   <u><h5 style="font-weight: bold;margin-left: 600px;"> Tax Details :   </h5></u><br/>
				   <div style="margin-left: 610px;">
				        <div class="row">
						<div class="col-md-3">SGST </div>  <div class="col-md-2"> <?php echo $sgst_per;?> </div>  <div class="col-md-3"> <?php echo $SGST_cal;?> </div>
						</div>
						<br/>
						<div class="row">
						<div class="col-md-3">CGST </div>  <div class="col-md-2"> <?php echo $cgst_per;?> </div>  <div class="col-md-3"> <?php echo $CGST_cal;?> </div>
						</div>
						<br/>
						<div class="row">
						<div class="col-md-3">IGST </div>  <div class="col-md-2"> <?php echo $igst_per;?> </div>  <div class="col-md-3"> <?php echo $igst_amount;?> </div>
						</div>
						<br/>
						....................................................................................... <br/>
					 <div class="row">
					 <div class="col-md-5"> <h5 style="font-weight: bold;margin-left: 10px;"> Tax Amount  : </div> 
					 <div class="col-md-3"><?php echo number_format($tax_amount,2); ?>  <h5/> </div> </div>
					....................................................................................... <br/>
					</div>
				   </TD>
			  </tr>
			</table>
	
			
			<tr style="page-break-after: always;"><td>E. & O.E</td></tr>
			
		<br>	
			
		<?php
	    $stmt = $con->query("select * from terms_and_condition where cost_sheet_no='$cost_sheet_no'");
        //echo "select * from terms_and_condition where cost_sheet_no ='$cost_sheet_no'";
		$stmt->execute(); 
		$row_fetch = $stmt->fetch();
		                	
								
	   ?> 
	   <br>	
		<div style="text-align:left;">
		   <img src="/ssinfo130122/images/04.png" alt="ssinformation">
		 </div>
		 <div style="text-align:center;font-weight:bold;"><b><u>QUOTATION</u></b></div><br/>
<div style="font-size:15px;min-width:708px;min-height:500px;border-top: 1px solid black;border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">
		
 <div style="padding: 10px;">
		<div> <u><b>Terms and Condition</b></u> </div>
          <br/>
       
		    <div class="row">		  
			<div class="col-md-1 txtcolor" >  VALIDITY  </div> <div class="col-md-1 txtcolor"> : </div> 
			<div class="col-md-9"> <?php echo $row_fetch['validity']; ?> </div>
           </div>  
		   <br/>
		   
		    <div class="row">		  
			<div class="col-md-1 txtcolor" >  IMPORTANT  </div> <div class="col-md-1 txtcolor"> : </div> 
			<div class="col-md-10"> <?php echo $row_fetch['important']; ?> </div>
           </div>  
		   <br/>

		<div class="row">		  
			<div class="col-md-1 txtcolor" > DELIVERY </div> <div class="col-md-1 txtcolor"> : </div> 
			<div class="col-md-10"> <?php echo $row_fetch['delivery']; ?> </div>
           </div>  
		   <br/>

		<div class="row">		  
			<div class="col-md-1 txtcolor" >WARRANTY </div> <div class="col-md-1 txtcolor"> : </div> 
			<div class="col-md-10"> <?php echo $row_fetch['warrenty']; ?> </div>
           </div>  
		   <br/>

		<div class="row">		  
			<div class="col-md-1 txtcolor" >PAYMENT </div> <div class="col-md-1 txtcolor"> : </div> 
			<div class="col-md-10"> <?php echo $row_fetch['payment']; ?> </div>
         </div>  
		   <br/>


		
	
		<div> 
			<b><u>BANK DETAILS FOR NEFT / RTGS / IMPS</u></b> 
		</div>
        <br/>

		<div class="row">		  
			<div class="col-md-2 txtcolor" > ACC HOLDER NAME </div> <div class="col-md-1 txtcolor"> : </div> 
			<div class="col-md-4"> <?php echo $row_fetch['acc_holder_name']; ?> </div>
           </div>  
		   <br/>
		   
		<div class="row">		  
			<div class="col-md-2 txtcolor" > BANK NAME </div> <div class="col-md-1 txtcolor"> : </div> 
			<div class="col-md-4"> <?php echo $row_fetch['bank_name']; ?> </div>
           </div>  
		   <br/>
		   
        <div class="row">		  
			<div class="col-md-2 txtcolor" > BRANCH NAME </div> <div class="col-md-1 txtcolor"> : </div> 
			<div class="col-md-4"> <?php echo $row_fetch['branch_name']; ?></div>
           </div>  
		   <br/>
		   
		 <div class="row">		  
			<div class="col-md-2 txtcolor" > CURRENT A/C NO </div> <div class="col-md-1 txtcolor"> : </div> 
			<div class="col-md-4"> <?php echo $row_fetch['account_no']; ?> </div>
           </div>  
		   <br/>

		 <div class="row">		  
			<div class="col-md-2 txtcolor" > IFSC CODE </div> <div class="col-md-1 txtcolor"> : </div> 
			<div class="col-md-4"> <?php echo $row_fetch['ifsc_code']; ?> </div>
           </div>  
		   <br/>

	</div>   

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		<div style="width: 100%;border-top: 1px solid black;border-bottom: 1px solid black;height:100px;">
			<div style="width: 50%; height: 100px; float: left;border-right: 1px solid black;"> 
				<div style="min-height:30px"><br/><br/>
				</div>
				<div style="border-top: 1px solid black;min-height:30px;padding: 10px;">
				<br/>
				<?php  $grand_totalz=number_format(round ($grand_totals),2);
				echo $get_amount= AmountInWords($grand_totals); ?>
				</div>
			</div>
			<div style="height: auto;margin-left:50%;"> 
			
			<div style="width: 100%; padding: 10px;">
				<div style="width: 85%; height: 70px; float: left;"> 
				
				<div class="row">		  
				<div class="col-md-3 txtcolor" > Amount </div> <div class="col-md-3 txtcolor"> : </div> 
				<div> <?php echo $net_amt;?> </div>
			   </div>  
		
			    
				<div class="row">		  
				<div class="col-md-3 txtcolor" > Tax </div> <div class="col-md-3 txtcolor"> : </div> 
				<div> <?php echo round($tax_amount,2);?> </div>
			   </div>  
		
			   
			    <div class="row">		  
				<div class="col-md-3 txtcolor" >  Net Amount </div> <div class="col-md-3 txtcolor"> : </div> 
				<div> <?php echo round ($grand_totals,2);?> </div>
			   </div>  
	
			   
				</div>
		    </div>

			</div>

        </div>
		<div style="margin-left:65%;justify-content: center;">
		<br/>
		<?php $query1=  $con->prepare("select a.*,b.*,c.* from staff_master a inner join designation_master b on 
		                  (b.id = a.design_id) inner join z_user_master c on (c.candidate_id=a.id) where a.id = '$acc_manager'");
				   /* echo "select a.*,b.*,c.* from staff_master a inner join designation_master b on 
		                  (b.id = a.design_id) inner join z_user_master c on (c.candidate_id=a.id) where a.id = '$acc_manager'"; */ 
						 //echo "select designation_name from designation_master where id ='$design_id'";
						$query1->execute(); 
						$row1 = $query1->fetch();
				  ?>
		<div style="font-weight:bold;"><?php echo $row1['emp_name'];?></div>
		<div style="font-weight:bold;"><?php echo $row1['designation_name'];?></div>
		<div style="font-weight:bold;">Mobile No : <?php echo $row1['mobile_no'];?></div>
		<div style="font-weight:bold;">Email Id : <?php echo $row1['email_id'];?></div>
		<br/>
		</div>
		</div>
		
	</div>
   </form>
	</div>
	</div>
   </div>
</section>			
	
<script>

function mail_send()
{
	var data  = $('form').serialize();
	var extra_file  = document.getElementById("extra_file").value;
	
	 var id    = document.getElementById("costsheet_id").value;
    $('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');
	document.getElementById('content').style.display = "none";
	$.ajax({
	type:'GET',
	data:"id="+id, 
	url:"qvision/BusinessProcess/quotation/quotation_mail_post.php",
	success:function(data)
	{      
		alert("Quote Details has been send successfully...");
		enquiry()
				  
	}       
	}); 
}

/* 

function quote_rewise(){
	  var field=1;
	  var  data  = $('form').serialize();
	  alert(data)
	 //var costsheet_id    = document.getElementById("costsheet_id1").value;
	
	$.ajax({
	type:'GET',
	
    data: data + "&" + "field="+field,	
	url:"qvision/BusinessProcess/quotation/quotation_rewise.php",
	success:function(data)
	{
		$(".content").html(data);
	}
	})
} */



function back()

	{
		Quotation_send()

	}
</script>