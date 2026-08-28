<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid = $_SESSION['candidateid'];
$userrole = $_SESSION['userrole'];

$costsheet_id = $_REQUEST['id'];

$stmt = $con->prepare("select a.cost_sheet_no as cst_no,a.specification as pvm_spec,a.vendor_id as pvm_vendor_id,a.*,b.client_id as cid,b.*,c.*,c.id as pur_re_id,d.*,e.ship_to,e.other_reference,e.term_delivery,e.terms from purchase_vendor_master a left join cost_sheet_entry b on (a.cost_sheet_id=b.id) left join purchase_requistion_entry c on (b.description=c.description) left join doller_vendor_mastor d on (a.vendor_id=d.id) left join ship_terms e on a.id = e.pvm_id where a.cost_sheet_id='$costsheet_id' and a.status ='6'");


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

$stmtcc = $con->prepare("select a.*,b.*,c.statename from new_client_master a left join new_plant_master b on (a.id=b.client_id) left join states c on b.state = c.id where a.id='$cliint_id'");

$stmtcc->execute();
$rowcc        = $stmtcc->fetch();
$org_name = $rowcc['org_name'];
$address = $rowcc['address'];
$plantstatename = $rowcc['statename'];
$gst_no = $rowcc['gst_no'];
$plantstateCode = substr("$gst_no", 0, 2);
$pan_no = $rowcc['pan_no'];


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
//$cst_no=$row ['cost_sheet_no'];
?>

<style>
	table th,
	td {
		font-size: 13px;
		margin: 0px;
		padding: 0px;
		padding-left: 3px;
		border: 1px solid black !important;
		border-collapse: collapse;
	}

	tr,
	td {
		border-color: black;
	}

	th {
		text-align: center;
	}

	.qr-code {
		width: 100px;
	}

	.img1 {
		width: 60px;
	}

	/* p{
 text-align:center;
 font-size:8px;
} */
</style>

<div class="row">
	<div class="col-xs-2" style="margin-left: 20px;">
		<b>Add CC Mail ID : </b>
	</div>
	<div class="col-xs-4">
		<input type="text" style="width: 553px !important;margin-left: 20px;" title="Please enter valid Mail id (use comma ,)" class="form-control" id="ccmailid" name="ccmailid" placeholder="Enter CC Mail ID (use comma ' , ' when more than one Mail id)">
	</div>
</div>

<section class="wage_content"></section>
<section class="content" id="content">
	<div class="container-fluid">
		<div class="row">
			<div class="card-body">
				<form action="" method="post" enctype="multipart/form-data">
					<div class="col-sm-12">
						<div class="col-sm-12" style="text-align:left;">

						</div>
						<div class="col-sm-12 row2" style="text-align:right;">
							<input type="hidden" name="costsheet_id" id="costsheet_id" value="<?php echo $costsheet_id; ?>">


							<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a> &nbsp;&nbsp;
							<input type="button" class="btn btn-success" id="save" name="save" onclick="mail_send()" value="Send Mail">
							&nbsp;<br /><br />
						</div>

						<div class="container">
							<h6 align="center"><b> PURCHASE ORDER </b></h6>
							<table class="table-bordered" width="100%">

								<tr>
									<td colspan='1' rowspan='3' style="border-right: none;"><img src="\SSInfo1\images\ss.png" class="img1 "> </td>
									<td colspan='5' rowspan='3' style="border-left: none;">
										<b>Invoice To </br>
											SS Information Systems Pvt Ltd </b></br>
										No:1/102,Periyar Pathai West,100 Feet Road ,Arumbakkam, </br>
										Chennai -600106 </br>
										Rajkumar@ssinformation.in </br>
										Landline No: 044-23623544 </br>
										GSTIN/UIN: 33AARCS9223K1ZU </br>
										State Name : Tamil Nadu, Code : 33 </br>
										CIN: U72900TN2012PTC087388 </br>
										E-Mail : karthick@ssinformation.in
									</td>

									<td colspan='2'>Voucher No. <b> </b> </td>

									<td colspan='2'>Dated:<b> </b></td>
								</tr>

								<tr>
									<td colspan='2'> </td>
									<td colspan='2'>Mode/Terms of Payment <b> <?php echo $row['terms']; ?> </b></td>
								</tr>

								<tr>
									<td colspan='2'>Reference No. & Date. <b> </b> </td>
									<td colspan='2'>Other References <b> <?php echo $row['other_reference']; ?> </b> </td>
								</tr>

								<tr>
									<td colspan='6' rowspan='2'>Consignee (Ship to) </br>
										<?php if ($row['ship_to'] == 1) { ?>
											<b>SS Information Systems Pvt Ltd </b></br>
											No:1/102,Periyar Pathai West,100 Feet Road ,Arumbakkam, </br>
											Chennai -600106 </br>
											Rajkumar@ssinformation.in </br>
											Landline No: 044-23623544 </br>
											E-Mail : karthick@ssinformation.in </br>
											GSTIN/UIN: 33AARCS9223K1ZU </br>
											State Name : Tamil Nadu, Code : 33 </br>
										<?php } else { ?>

											<b> <?php echo $org_name; ?> </b></br>
											<?php //echo $address; 
											$addres_split = explode(',', $address);
											foreach ($addres_split as $addressline) {
												echo $addressline, ',<br>';
											}
											?>
											GSTIN/UIN: <?php echo $gst_no; ?> </br>
											State Name: <?php echo $plantstatename; ?>, Code : <?php echo $plantstateCode; ?>
											</br>
										<?php } ?>
									</td>

									<td colspan='2'>Delivery Note Date </td>
									<td colspan='2'>Destination </td>
								</tr>

								<tr>
									<td colspan='4' rowspan='2' style="margin: 0px !important; padding: 0px !important;"> <span style="position: absolute;top: 325px;"> Terms of Delivery </span>

										<b> <?php echo $row['term_delivery']; ?> </b>
									</td>
								</tr>

								<tr>
									<td colspan='6'>Supplier (Bill from)</br>
										<b> <?php echo $vendor_name, ' - ', $vendor_town_city ?> </b></br>
										<?php echo $address, '<br> ', $vendor_address2, ',', $vendor_area, '<br>', $vendor_town_city, ',', $vendor_district, '<br>', $vendor_state, '-', ' ', $vendor_pincode, '.'; ?> </br>
										GSTIN/UIN : <?php echo $vendor_gst_num; ?></br>
										State Name : <?php echo  $vendor_state; ?>, Code : <?php echo $stateCode; ?>
									</td>
								</tr>

								<tr>
									<th>Sl No. </th>
									<th colspan='4'>Description of Goods </th>
									<!-- <th>Due on </th> -->
									<th>Qty </th>
									<th>Rate </th>
									<th>per </th>
									<th>Disc. % </th>
									<th>Amount </th>
								</tr>

								<?php
								$query = $con->query("SELECT distinct a.specification,SUM(a.unit_qty) as unitt,SUM(a.price) as prices,SUM(a.gst_val) as gst,SUM(a.igst_val) as igst,SUM(a.grand_total) as gtotal,b.description,a.gst_per,a.igst_per,a.unit_cost,SUM(a.discount) as discnt,a.disc_per,a.edd from purchase_vendor_master a left join cost_sheet_entry b on (a.cost_sheet_id=b.id) where a.status ='6' and a.vendor_id='$vendors_id' group by a.specification");
								//echo "SELECT distinct a.specification,SUM(a.unit_qty) as unitt,SUM(a.price) as prices,SUM(a.gst_val) as gst,SUM(a.igst_val) as igst,SUM(a.grand_total) as gtotal,b.description,a.gst_per,a.igst_per,a.unit_cost,SUM(a.discount) as discnt,a.disc_per from purchase_vendor_master a left join cost_sheet_entry b on (a.cost_sheet_id=b.id) where a.status ='2' and a.vendor_id='$vendors_id' group by a.specification";
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
								?>


									<tr style="border:none;">
										<td><?php echo $cnt; ?></td>
										<td colspan='4'> <b> <?php echo $quote['specification']; ?> </b> </br>
											<?php echo $quote['description']; ?> </td>
										<!--	<td> <?php echo date('d-m-Y', strtotime($quote['edd'])); ?>  </td> -->
										<td> <?php echo $quote['unitt']; ?> </td>
										<td> <?php echo number_format($quote['unit_cost'], 2); ?> </td>
										<td> Nos </td>
										<td></td>
										<td> <?php echo number_format($price, 2); ?> </td>
									</tr>
								<?php $cnt = $cnt + 1;
								} ?>
								<tr style="border:none;">
									<td></td>
									<td colspan='3' style="text-align:right;"><b> CGST @ <?php echo $cgst_per; ?> </b></td>
									<td></td>
									<td></td>
									<td> <?php echo $CGST_cal; ?> </td>
									<td>% </td>
									<td></td>
									<td><b> <?php echo number_format($price + $CGST_cal, 2); ?> </b></td>
								</tr>

								<tr style="border:none;">
									<td></td>
									<td colspan='3' style="text-align:right;"><b> SGST @ <?php echo $sgst_per; ?> </b></td>
									<td></td>
									<td></td>
									<td> <?php echo $SGST_cal; ?> </td>
									<td>% </td>
									<td></td>
									<td><b> <?php echo number_format($price + $CGST_cal + $SGST_cal, 2); ?> </b></td>
								</tr>

								<tr style="border:none;">
									<td></td>
									<td colspan='3' style="text-align:right;"><b> Discount @ <?php echo $disc_per; ?> %</b></td>
									<td></td>
									<td></td>
									<td> <?php echo number_format($discount, 2); ?> </td>
									<td>% </td>
									<td> <?php echo $disc_per; ?> </td>
									<td><b> <?php echo number_format($price + $CGST_cal + $SGST_cal - $discount, 2); ?> </b></td>
								</tr>

								<tr>
									<td></td>
									<td colspan='3' style="text-align:right;"><b> Total </b> </td>
									<td></td>
									<td><b> <?php echo $qty1; ?> </b></td>
									<td> </td>
									<td> </td>
									<td></td>
									<td><b> <?php echo number_format($grand_total, 2); ?> </b></td>
								</tr>

								<tr>
									<td colspan='10' style="border-bottom:none !important; padding: 0px 0px 100px 5px;">Amount Chargeable (in words) <span style="float:right;"> E. & O.E </span><br>
										<b> INR <?php echo AmountInWords($grand_total); ?> </b>
									</td>
								</tr>

								<tr style="border-top:none !important; border-bottom:none !important;">
									<td colspan='10' style="border-top:none !important; border-bottom:none !important;">Company’s PAN :<b> AARCS9223K </b></td>
								</tr>

								<tr>
									<td colspan='5' style="border-top:none !important;"></td>
									<td colspan='5' style="text-align: right;padding-bottom: 20px;"><b> for SS Information Systems Pvt Ltd </b><br>
										<span style="position: relative;top: 15px;"> Authorised Signatory </span>
									</td>
								</tr>

								<tr>
									<td colspan="10"> Reg Office Address: </td>
								</tr>

							</table>
							<center>
								<p>This is a Computer Generated Invoice </p>
							</center>

						</div>

					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<script>
	function mail_send() {
		var data = $('form').serialize();

		var ccmail = document.getElementById("ccmailid").value;
		if (ccmail == '') {
			alert("Please Enter the Mail ID");
			return false;
		}

		var id = document.getElementById("costsheet_id").value;
		$('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');
		document.getElementById('content').style.display = "none";
		$.ajax({
			type: 'GET',
			data: "id=" + id + "&ccmailid=" + ccmail,
			url: "qvision/Purchase_process/vendor_po_generate/vendor_mail_post.php",
			success: function(data) {

				alert("Mail Sended Successfully");
				vendor_po_generate()

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
		vendor_po_generate()
	}
</script>