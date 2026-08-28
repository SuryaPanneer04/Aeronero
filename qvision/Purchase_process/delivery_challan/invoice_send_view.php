<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid = $_SESSION['candidateid'];
$userrole = $_SESSION['userrole'];

$purchase_id = $_REQUEST['id'];

$queryx = $con->prepare("SELECT * from challan_entry where  id='$purchase_id'");
$queryx->execute();
$rowi = $queryx->fetch();
$challan_id = $rowi['id'];
$created_on = $rowi['created_on'];
$created_by = $rowi['created_by'];
$customer_name = $rowi['customer_name'];
$podate = $rowi['po_date'];
$pvmid = $rowi['pvm_id'];

$shipTo = $con->query("SELECT ship_to,terms,other_reference,term_delivery from ship_terms  where  pvm_id='$pvmid'");
$ship = $shipTo->fetch();
$terms = $ship['terms'];
$other_reference = $ship['other_reference'];
$term_delivery = $ship['term_delivery'];
$ship_to = $ship['ship_to'];

$clientIdDetails = $con->query("SELECT id,client_id,hsn,cost_sheet_no from cost_sheet_entry where  id='$customer_name'");
$clientId = $clientIdDetails->fetch();
$client_id = $clientId['client_id'] ?? 0;
$hsn = $clientId['hsn'] ?? 0;
$cost_sheet_no = $clientId['cost_sheet_no'] ?? 0;






// $orgName = $con->query("SELECT org_name from new_client_master where  id='$client_id'");
// $org = $orgName->fetch();
// echo $client_org_name = $org['org_name'];

$stmtx = $con->query("select * from new_plant_master where client_id='$client_id' ");

$stmtx->execute();
$rowx = $stmtx->fetch();
$client_org_name = $rowx['client_org_name'] ?? 0;
$emp_name = $rowx['contact_person'] ?? 0;
$designation = $rowx['designation'] ?? 0;
$address = $rowx['address'] ?? 0;
$area = $rowx['area'] ?? 0;
$pincode = $rowx['pincode'] ?? 0;
$mobile1 = $rowx['mobile1'] ?? 0;
$gst_no = $rowx['gst_no'] ?? 0;
$stateCode = substr("$gst_no", 0, 2);



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
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
</head>


<body>
<a onclick="invoice()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>BACK</a> &nbsp;&nbsp;
		<input type="button" class="btn btn-success" id="save" name="save" onclick="invoicemail_send(<?php echo $challan_id; ?>,'<?php echo $cost_sheet_no;?>')" value="Send Mail" style="float: right;margin-right: 3px;"> 
		<input type="button" style="float: right;margin-right: 3px;" class="btn btn-info" id="save" name="save" onclick="Print()" value="Print">  <br /><br />
		<section class="wage_content"></section>
		<div class="container" id="main">
		<h4 align="center"><b>INVOICE CUM DELIVERY CHALLAN</b></h4>
		
		<style>
	* {
		margin: 0px;
		padding: 0px;
		box-sizing: border-box;
	}

	table,th,td {
		font-size: 10px;
		margin: 0px;
		padding: 5px;
		font-size: 14px;
		border: 1px solid black !important;
        border-collapse: collapse !important;
	}


	th {
		text-align: center;
	}

	.qr-code {
		width: 100px;
	}

	/* .img1{
 width: 100px;
} */
	p {
		text-align: center;
	}
</style>
		<table class="table table-bordered" width="100%">
			<!-- <tr style="border:none;">
				<td colspan='5' style="border:none;">IRN :<b> a981c12b65b3e4a65772d28f00d296249d </b></br>
					Ack No. :<b> 152212616154093 </b></br>
					Ack Date :<b> 8-Aug-22 </b></td>

				<td colspan='5' style="border:none;text-align: right;"><span style="margin-right: 30px;"> e-Invoice </span><br>
					<img src="\ssinfo1\images\qr-code.png" class="qr-code">
				</td>
			</tr> -->

			<tr>
				<td colspan='1' rowspan='5' style="border-right: none;"><img src="images\logo123.jpg" width=100px class="img1"> </td>
				<td colspan='5' rowspan='5' style="border-left: none;"><b>SS Information Systems Pvt Ltd </b></br>
					No:1/102,Periyar Pathai West,100 Feet Road ,Arumbakkam, </br>
					Chennai -600106 </br>
					Rajkumar@ssinformation.in </br>
					GSTIN/UIN: 33AARCS9223K1ZU </br>
					State Name : Tamil Nadu, Code : 33 </br>
					CIN: U72900TN2012PTC087388 </br>
					E-Mail : karthick@ssinformation.in </td>

				<td colspan='2'>Invoice No. <b> <?php echo $rowi['invoice_no']; ?> </b></br>
					e-Way Bill No.<b> 541397929661 </b>
				</td>

				<td colspan='2'>Dated:<b> <?php echo  date('d-m-Y'); ?> </b></td>
			</tr>

			<tr>
				<td colspan='2'> Delivery Note </td>
				<td colspan='2'>Mode/Terms of Payment <b> <?php echo $terms; ?> </b></td>
			</tr>

			<tr>
				<td colspan='2'>Reference No. & Date. </td>
				<td colspan='2'>Other References <b> <?php echo $other_reference; ?> </b></td>
			</tr>

			<tr>
				<td colspan='2'>Buyer’s Order No.<b> L/F/STR/Plant I-23013-0 </b></td>
				<td colspan='2'>Dated:<b> 6-Jul-22 </b></td>
			</tr>

			<tr>
				<td colspan='2'>Dispatch Doc No. </td>
				<td colspan='2'>Delivery Note Date </td>
			</tr>

			<tr>
				<td colspan='6' rowspan='2'>Consignee (Ship to) </br>
				<?php if ($ship_to == 1) { ?>
					<b>SS Information Systems Pvt Ltd </b></br>
					No:1/102,Periyar Pathai West,100 Feet Road ,Arumbakkam, </br>
					Chennai -600106 </br>
					Rajkumar@ssinformation.in </br>
					Landline No: 044-23623544 </br>
					E-Mail : karthick@ssinformation.in </br>
					GSTIN/UIN: 33AARCS9223K1ZU </br>
					State Name : Tamil Nadu, Code : 33 </br>
				<?php } else { ?>
					<b> <?php echo  $client_org_name; ?></b></br>
					<?php echo $address; ?></br>
					<?php echo $area; ?></br>
					Pin-<?php echo $pincode; ?></br>
					GSTIN/UIN : <?php echo $gst_no; ?></br>
					State Name : Tamil Nadu, Code : <?php echo $stateCode; ?>
					</br>
				<?php } ?>
				</td>
				<td colspan='2'>Delivery Note Date </td>
				<td colspan='2'>Destination </td>
			</tr>

			<tr>
				<td colspan='4' rowspan='2' style="text-align: top !important;"> Terms of Delivery <br>
						<b> <?php echo $term_delivery; ?> </b> 
					</td>
			</tr>

			<tr>
				<td colspan='6'>Buyer (Bill to)</br>
					<b> <?php echo  $client_org_name; ?></b></br>
					<?php echo $address; ?></br>
					<?php echo $area; ?></br>
					Pin-<?php echo $pincode; ?></br>
					GSTIN/UIN : <?php echo $gst_no; ?></br>
					State Name : Tamil Nadu, Code : <?php echo $stateCode; ?>
					Place of Supply : Tamil Nadu
				</td>
			</tr>

			<tr>
				<th>Sl No. </th>
				<th colspan='3'>Description of Goods </th>
				<th>HSN/SAC </th>
				<th>Qty </th>
				<th>Rate </th>
				<th>per </th>
				<th>Disc. % </th>
				<th>Amount </th>
			</tr>
			<?php
			$queryw = $con->query("SELECT id,spec,qty,customer_name,product_name,serial_no,remark,created_by,created_on,grn_entry_id from challan_entry where  created_on='$created_on' and customer_name='$customer_name'");


			$cnt = 1;
			while ($data = $queryw->fetch()) {

				$product_name = $data['product_name'];
				$spec = $data['spec'];
				$serial_no = $data['serial_no'];
				$remark = $data['remark'];
				$qty = $data['qty'];
				$created_by = $data['created_by'];
				$grn_entry_id = $data['grn_entry_id'];

				// $stmtp = $con->query("select id,name,description from product_master where id='$product_name' ");
				// $stmtp->execute();
				// $rowp = $stmtp->fetch();
				// $name = $rowp['name'];
				// $description = $rowp['description'];

				$amountDetails = $con->query("SELECT id,unit_cost,gst_per,price from purchase_vendor_master where  id='$pvmid'");
				$productamnt = $amountDetails->fetch();
				$unit_rate = $productamnt['unit_cost'];
				$gst = $productamnt['gst_per'];
				$price = $productamnt['price'];

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
			?>
				<tr>
					<td><?php echo $cnt; ?></td>
					<td colspan='3'><b> <?php echo $product_name; ?></b><br>
						<?php echo $spec; ?> <br><b>Serial Number-
							<?php //echo $serial_no; 
							$grn = explode(',', $grn_entry_id);

							for ($i = 0; $i < count($grn) - 1; $i++) {

								$grnentry = $con->query("SELECT serial_no FROM `grn_entry` WHERE id='$grn[$i]' ");
								$grn_serial = $grnentry->fetch();
								echo $grn_serial['serial_no'], ",", "  ";
							}
							?> </b>
					</td>
					<td> <?php echo $hsn; ?> </td>
					<td> <?php echo $qty; ?> </td>
					<td> <?php echo number_format($unit_rate, 2); ?> </td>
					<td> Nos </td>
					<td></td>
					<td> <?php echo (number_format($total = $unit_rate * $qty, 2)); ?> </td>
				</tr>
			<?php
				$cnt = $cnt + 1;
			}
			?>
			<tr>
				<td></td>
				<td colspan='3' style="text-align:right;"><b> CGST @ <?php echo $cgst_per; ?> </b></td>
				<td></td>
				<td></td>
				<td><?php echo number_format($CGST_cal, 2); ?> </td>
				<td>% </td>
				<td></td>
				<td><b> <?php echo (number_format($total + $CGST_cal, 2)); ?> </b></td>
			</tr>

			<tr>
				<td></td>
				<td colspan='3' style="text-align:right;"><b> SGST @ <?php echo $sgst_per; ?> </b></td>
				<td></td>
				<td></td>
				<td> <?php echo number_format($SGST_cal, 2); ?> </td>
				<td>% </td>
				<td></td>
				<td><b> <?php echo (number_format($total + $CGST_cal + $SGST_cal, 2)); ?> </b></td>
			</tr>

			<tr>
				<td colspan='10'>Reg.Office Address : </td>
			</tr>

			<tr>
				<td></td>
				<td colspan='3' style="text-align:right;">Total</td>
				<td></td>
				<td><b> <?php echo $qty; ?> </b></td>
				<td> </td>
				<td> </td>
				<td></td>
				<td><b> <?php echo (number_format($totalAmnt = $total + $CGST_cal + $SGST_cal, 2)); ?> </b></td>
			</tr>

			<tr>
				<td colspan='10'>Amount Chargeable (in words) <span style="float:right;"> E. & O.E </span><br>
					<b> INR <?php echo AmountInWords($totalAmnt); ?> </b>
				</td>
			</tr>

			<tr>
				<td colspan='4' rowspan='2' style="text-align:right;"> Taxable <br> Value</td>
				<td colspan='2'> Central Tax</td>
				<td colspan='2'> State Tax</td>
				<td colspan='2'> Total</td>
			</tr>

			<tr>
				<td colspan='1'> Rate</td>
				<td colspan='1'> Amount</td>
				<td colspan='1'> Rate</td>
				<td colspan='1'> Amount</td>
				<td colspan='2'> Tax Amount</td>
			</tr>
			<tr>
				<td colspan='4' style="text-align:right;"> <?php echo number_format($total, 2); ?> </td>
				<td colspan='1'> <?php echo $cgst_per; ?></td>
				<td colspan='1'> <?php echo number_format($CGST_cal, 2); ?> </td>
				<td colspan='1'> <?php echo $sgst_per; ?></td>
				<td colspan='1'> <?php echo number_format($CGST_cal, 2); ?> </td>
				<td colspan='2'> <?php echo number_format($CGST_cal + $CGST_cal, 2); ?></td>
			</tr>
			<tr style="font-weight:bold;">
				<td colspan='4' style="text-align:right;">Total: <?php echo number_format($total, 2); ?> </td>
				<td colspan='1'> </td>
				<td colspan='1'> <?php echo number_format($CGST_cal, 2); ?> </td>
				<td colspan='1'> </td>
				<td colspan='1'> <?php echo number_format($CGST_cal, 2); ?> </td>
				<td colspan='2'> <?php echo number_format($taxAmnt = $CGST_cal + $CGST_cal, 2); ?> </td>
			</tr>

			<tr>
				<td colspan='10'>Tax Amount (in words) :<b> INR <?php echo AmountInWords($taxAmnt); ?> </b></td>
			</tr>

			<tr>
				<td colspan='5' style="border-right:none;">Company’s PAN :<b> AARCS9223K </b></td>
				<td colspan='5' style="border-left:none;">Company’s Bank Details <br>
					Bank Name :<b> Yes Bank 000584600004638 </b></td>
			</tr>

			<tr>
				<td colspan='5' style="border-right:none;"><u>Declaration </u><br>
					Terms & Conditions :<br>
					1- Responsibility of warranty lies with the manufacturer only. <br>
					2- Default in payment beyond agreed period SS will have
					the right to repossess the goods. <br>
					3- 2% interest + GST per month will be charged on the
					outstanding invoice value in case of delay in payment <br>
					4- In case any cheque is dishonored a service charges of
				</td>
				<td colspan='5' style="border-left:none;">A/c No. :<b> 000584600004638 </b><br>
					Branch & IFS Code :<b> Nungambakkam & YESB0000005 </b>
				</td>
			</tr>

			<tr>
				<td colspan='5' style="padding: 0px 0px 30px 3px;">Customer’s Seal and Signature </td>
				<td colspan='5' style="text-align: right;padding-bottom: 20px;"><b> for SS Information Systems Pvt Ltd </b><br>
					<span style="position: relative;top: 15px;"> Authorised Signatory </span>
				</td>
			</tr>

		</table>
		<p>This is a Computer Generated Invoice </p>

	</div>
</body>

</html>

<script>
	function invoicemail_send(id,no) {
		var data = $('form').serialize();
		$('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');
		document.getElementById('main').style.display = "none";
		$.ajax({
			type: "GET",
			url: "qvision/Purchase_process/delivery_challan/invoice_send_mail.php?id=" + id + "&cost_no=" + no,
			success: function(data) {
				alert("Mail Sended Successfully");
				invoice()
			}
		})

	}

	function Print() {
			var divContents = document.getElementById("main").innerHTML;
			var a = window.open('', '', 'height=1000, width=1500');
			a.document.write('<html>');
			//a.document.write('<body > <h1>Div contents are <br>');
			a.document.write(divContents);
			a.document.write('</body></html>');
			a.document.close();
			a.print();
			a.close();
		}
</script>