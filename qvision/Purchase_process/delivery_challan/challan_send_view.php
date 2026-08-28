<?php
require '../../../connect.php';
require '../../../user.php';

$user_id = $_SESSION['userid'];
$candidateid = $_SESSION['candidateid'];
$purchase_id = $_REQUEST['id'];

$queryx = $con->prepare("SELECT id,spec,qty,customer_name,product_name,serial_no,remark,created_by,created_on from challan_entry where  id='$purchase_id'");
$queryx->execute();
$rowi = $queryx->fetch();
$created_on = $rowi['created_on'];
$created_by = $rowi['created_by'];
$customer_name = $rowi['customer_name'];

$queryo = $con->prepare("SELECT id,client_id,hsn from cost_sheet_entry where  id='$customer_name'");
$queryo->execute();
$rowo = $queryo->fetch();
$client_id = $rowo['client_id'];
$hsn = $rowo['hsn'];

$stmtx = $con->query("SELECT * FROM new_plant_master WHERE client_id='$client_id' ");
$stmtx->execute();
$rowx = $stmtx->fetch();
$emp_name = $rowx['contact_person'];
$designation = $rowx['designation'];
$address = $rowx['address'];
$area = $rowx['area'];
$pincode = $rowx['pincode'];
$mobile1 = $rowx['mobile1'];

$date = date('d-m-Y');
?>
<!DOCTYPE html>
<html>

<head>

</head>

<body>
	<section class="wage_content"></section>
	<section class="content" id="content">

		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>BACK</a> &nbsp;&nbsp;
		<input type="button" style="float: right;margin-right: 20px;" class="btn btn-success" id="save" name="save" onclick="Print()" value="Print">
		<div class="container-fluid" id="main">
			<style>
				* {
					margin: 0px;
					padding: 0px;
					box-sizing: border-box;
					/* font-family:arial; */
					font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
				}

				table,
				th,
				td {
					border: 1px solid black;
					border-collapse: collapse;
					font-size: 14px;
				}

				td {
					padding: 2px;
				}

				/* @page{
  size: a5 landscape;
} */
			</style>
			<table style="width: 1005px; height: 170.07874016px;margin-left:20px;margin-top:20px;">
				<tr>
					<td colspan='1' style="border-right:none;border-bottom: none;">
						<span> <!-- style="position: relative;top: -5px;z-index: -1;" -->
							<img src="images/logo123.jpg" style="height: 100px;width: 225px;">
						</span>
					</td>
					<td colspan='1' style="border-left:none;border-right:none;border-bottom: none;">
						<span style="position: relative;top: -10px;font-size: 15px;">
							<center> <b>GATE PASS <br> (Returnable/Non Returnable Goods)</b> </center>
						</span>
					</td>
					<td colspan='2' style="border-left:none;border-bottom: none;">
						<span style="position: relative; left: 40px; top: -6px;font-size: 12px;"> <b>GSTIN : </b>33AAACQO129PZZF<br>
							<b>CST NO : </b>CST NO.865682/DT07.08.95 <br>
							<b>CIN NO : </b>U72300TN1995PTC031143
						</span>
					</td>
				</tr>

				<tr>
					<td colspan='2' style="border-right:none;border-top: none;font-size: 12px;">
						<b>Quadsel System pvt LTD</b><br /><br />
						old no:80 ,new no :118 manickam lane ,Annasalai <br>
						Guindy,chennai-600032, Tamilnadu, India.
					</td>

					<td colspan='1' style="border-left:none;border-right:none;border-top: none;font-size: 14px;">No : </td>

					<td colspan='1' style="border-left:none;border-top: none;font-size: 14px;">Date : <?php echo $date; ?></td>
				</tr>

				<tr>
					<td colspan='2'>
						<span style="position: relative;top: -35px;"> M/s : <?php echo $emp_name; ?><br>
							<?php echo $designation; ?> <br><?php echo $address; ?><?php echo $area; ?>-<?php echo $pincode; ?>
							<br><?php echo $mobile1; ?> </span>
					</td>

					<td colspan='2'>
						<br> Our Ref :_____________________________ <br><br>
						Your Ref :_____________________________ <br><br>
						<span style="float: right; margin-right: 20px;"> Area code
							<table style="width:60px;height: 20px;">
								<tr>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</table>

						</span>
					</td>
				</tr>
				<table style="width: 1005px;margin-left:20px; border-top:none;">
					<thead>
						<tr>
							<th style="width: 50px; padding: 5px;border-top:none;text-align:center;"> Sl No. </th>
							<th style="border-top:none;text-align:center;width: 530px;"> ITEM DESCRIPTION </th>
							<th style="border-top:none;text-align:center;"> QTY. </th>
							<th style="border-top:none;text-align:center;"> HSN Code </th>
							<th style="border-top:none;text-align:center;"> REMARKS </th>
						</tr>
					</thead>
					<tbody>
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


							// $stmtp=$con->query("select id,name,description from product_master where id='$product_name' ");
							// $rowp = $stmtp->fetch();
							// $name = $rowp['name'];
							// $description = $rowp['description'];
						?>

							<tr>
								<td style="text-align: center;"><?php echo $cnt; ?> </td>
								<td>
									<?php echo $product_name; ?><br><?php echo $spec; ?><br><b>Serial Number:</b>

									<?php //echo $serial_no; 
									$grn = explode(',', $grn_entry_id);

									for ($i = 0; $i < count($grn) - 1; $i++) {

										$grnentry = $con->query("SELECT serial_no FROM `grn_entry` WHERE id='$grn[$i]' ");
										$grn_serial = $grnentry->fetch();
										echo $grn_serial['serial_no'], ",", "  ";
									}
									?>
								</td>
								<td style="text-align: center;"><?php echo $qty; ?> </td>
								<td style="text-align: center;"><?php echo $hsn; ?> </td>
								<td style="text-align: center;"><?php echo $remark; ?> </td>


							</tr>
						<?php
							$cnt = $cnt + 1;
						}
						?>
					</tbody>
				</table>
				<table style="width: 1005px;margin-left:20px; border-top:none;">
					<tr style="height: 60px;">
						<td colspan='1' style="border-top:none;border-right:none;text-align:center;padding: 40px 0px 0px 0px;"><b> Prepared by </b></td>
						<td colspan='1' style="border-top:none;border-left:none;border-right:none;text-align:center;padding: 40px 0px 0px 0px;"><b> Authorised by </b></td>
						<td colspan='2' style="border-top:none;border-left:none;text-align:center;padding: 40px 0px 0px 0px;"><b> Received by </b></td>
					</tr>
				</table>

			</table>

		</div>
	</section>

	<script>
		function back() {
			delivery_challan()
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

</body>

</html>