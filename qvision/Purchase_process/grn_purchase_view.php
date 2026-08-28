<?php
//GRN Entry status = 1 ... initial 
//GRN status = 2.... after add to purchase.


require '../../connect.php';
require '../../user.php';

$id = $_REQUEST['id'];

$grn_data = $con->query("SELECT a.id,b.so_number,b.cost_sheet_no,a.vendor_id,c.vendor_name,a.req_qty,a.rec_qty,a.cost_sheets_id,a.purchase_id,a.products,a.spec,a.status from grn_generate a left join purchase_vendor_master b on a.purchase_id = b.id left join doller_vendor_mastor c on a.vendor_id = c.id where a.id='$id'");
$grninfo = $grn_data->fetch();
$pvmid = $grninfo['purchase_id'];

?>
<html>

<head>
	<link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<div class="card card-info">
	<div class="card-header">
		<h2 class="card-title">
			<font size="4"><b>Purchase Details</b></font>
		</h2>
		<a onclick="generate_purchase()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
	</div>
</div>

<form id="fupForm" name="fupForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
	<table class="table table-bordered">

		<tr>
			<td><b> Vendor Name </b></td>
			<td colspan="4">
				<input type="text" class="form-control" name="vendor_name" value="<?php echo $grninfo['vendor_name']; ?>" readonly>
			</td>
		</tr>

		<tr>
			<td><b>SO Number</b></td>
			<td colspan="4">
				<input type="text" class="form-control" value="<?php echo $grninfo['so_number']; ?>" name="soNumber" readonly>
			</td>
		</tr>

		<tr>
			<td><b>Product Name</b></td>
			<td colspan="4">
				<input type="text" class="form-control" id="proname" value="<?php echo $grninfo['products']; ?>" name="proname" readonly>
			</td>
		</tr>
		<tr>
			<td><b>Specification</b></td>
			<td colspan="4">
				<textarea class="form-control" id="specification" name="specification" readonly><?php echo $grninfo['spec']; ?></textarea>
			</td>
		</tr>
		<tr>
			<td><b>Requested Qty</b></td>
			<td colspan="4">
				<input type="text" class="form-control" id="rqst" value="<?php echo $grninfo['req_qty']; ?>" name="rqst" readonly>
			</td>
		</tr>

		<tr>
			<td><b>Received Qty</b></td>
			<td colspan="4">
				<input type="text" class="form-control" name="receive" value="<?php echo $grninfo['rec_qty']; ?>" readonly>
			</td>
		</tr>

		<?php if ($grninfo['status'] == '1') {  ?>
			<tr>
				<td><b>Purchase Invoice No</b></td>
				<td colspan="4">
					<input type="text" class="form-control" name="purchase_invoice_no">
				</td>
			</tr>

			<tr>
				<td><b>Purchase Invoice Date</b></td>
				<td colspan="4">
					<input type="date" class="form-control" name="purchase_invoice_date">
				</td>
			</tr>

			<tr>
				<td><b>Upload Purchase Invoice</b></td>
				<td colspan="4">
					<input type="file" class="form-control" id="image" name="image" required>
				</td>
			</tr>

			<tr>
				<td><b>Customization</b></td>
				<td colspan="4">
					<select class="form-control" id="Customization" name="Customization" onchange="openRemark(this.value)">
						<option> -- Select -- </option>
						<option value="1"> YES </option>
						<option value="0"> NO </option>
					</select>
				</td>
			</tr>

			<tr id="remark_custom">
				<td><b>Remark</b></td>
				<td colspan="4">
					<textarea class="form-control" name="remark"> </textarea>
				</td>
			</tr>

		<?php  } else {
			$purchase_grn_data = $con->query("SELECT * from purchase_generate where grn_id='$id'");
			$purGen = $purchase_grn_data->fetch();

		?>
			<tr>
				<td><b>Purchase Invoice No</b></td>
				<td colspan="4">
					<input type="text" class="form-control" name="purchase_invoice_no" value="<?php echo $purGen['purchase_invoice_no']; ?>" readonly>
				</td>
			</tr>

			<tr>
				<td><b>Purchase Invoice Date</b></td>
				<td colspan="4">
					<input type="text" class="form-control" name="purchase_invoice_date" value="<?php echo date('d-m-Y', strtotime($purGen['purchase_invoice_date'])); ?>" readonly>
				</td>
			</tr>

			<tr>
				<td><b>Upload Purchase Invoice</b></td>
				<td colspan="4">
					<a href="Qvision\Purchase_process\uploads\<?php echo $purGen['purchase_invoice_upload']; ?>" download="<?php echo $purGen['purchase_invoice_upload']; ?>"><?php echo $purGen['purchase_invoice_upload']; ?></a>
				</td>
			</tr>

			<tr>
				<td><b>Customization</b></td>
				<td colspan="4">
					<input type="text" class="form-control" name="Customization" value="<?php echo ($purGen['customization'] == '1') ? 'YES' : 'NO'; ?>" readonly>
				</td>
			</tr>
			<?php if ($purGen['customization'] == '1') { ?>
				<tr>
					<td><b>Remark</b></td>
					<td colspan="4">
						<textarea class="form-control" name="remark" readonly><?php echo $purGen['remark']; ?></textarea>
					</td>
				</tr>

		<?php }
		}  ?>


	</table>
	<table id="dataTable" width="300px" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered">
		<thead>
			<tr>
				<th>PRODUCT</th>
				<th>QTY</th>
				<th>UNIT RATE</th>
				<th>AMOUNT </th>
			</tr>
		</thead>
		<tbody>
			<?php
			$query = $con->query("SELECT * from purchase_vendor_master where  id='$pvmid'");
			$cnt = 1;
			while ($cost = $query->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr>
					<td>
						<INPUT type="hidden" id="cost_sheet_no" name="cost_sheet_no" class="form-control" value="<?php echo $cost['cost_sheet_no']; ?>" readonly="readonly">
						<?php echo $cost['specification']; ?>
					</td>

					<td>
						<?php echo $cost['unit_qty']; ?>
					</td>

					<td>
						<?php echo $cost['unit_cost']; ?>
					</td>

					<td>
						<?php echo $cost['price']; ?>
					</td>
				</tr>

			<?php $cnt++;
			} ?>

		</tbody>

		<?php
		$query1 = $con->query("SELECT * from purchase_vendor_master where  id='$pvmid'");
		$query1->execute();
		$row1 = $query1->fetch();
		?>

		<table id="dataTable" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered">

			<tr>
				<td colspan="5" align="center"><b>GST Percentage <?php echo $row1['gst_per']; ?>%</b></td>
				<td colspan="3" align="right">
					<INPUT type="text" id="gst_per" name="gst_per" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['gst_val']; ?>" readonly="readonly">
				</td>
			</tr>

			<tr>
				<td colspan="5" align="center"><b>iGST Percentage <?php echo $row1['igst_per']; ?>%</b></td>
				<td colspan="3" align="right">
					<INPUT type="text" id="igst_per" name="igst_per" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['igst_val']; ?>" readonly="readonly">
				</td>
			</tr>

			<tr>
				<td colspan="5" align="center"><b>Discount Percentage <?php echo $row1['disc_per']; ?>%</b></td>
				<td colspan="3" align="right">
					<INPUT type="text" id="discount" name="discount" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['discount']; ?>" readonly="readonly">
				</td>
			</tr>

			<tr>
				<td colspan="5" align="center"><b>Grand Total</b></td>
				<td colspan="3" align="right">
					<INPUT type="text" id="grand_total" name="grand_total" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['grand_total']; ?>" readonly="readonly">
				</td>
			</tr>

		</table>
	</table>

	<br />

	<input type="hidden" value="<?php echo $grninfo['vendor_id']; ?>" name="vendor" id="vendor">
	<input type="hidden" value="<?php echo $grninfo['cost_sheets_id']; ?>" name="cs_id" id="cs_id">
	<input type="hidden" value="<?php echo $pvmid; ?>" name="pvm_id" id="pvm_id">

	</div>

	<table id="new_tab" width="300px" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered table-striped">
		<tbody id="cost_sheett">
			<tr>
				<th>Sr. No.</th>
				<th>Serial Number</th>
				<th>GRN Number</th>
			</tr>
			<?php
			$grn_generated_code = $con->query("select * from grn_entry where grn_id = '$id' order by status");
			$i = 1;
			while ($grncode = $grn_generated_code->fetch()) {
			?>
				<tr>
					<td>
						<!-- <?php if ($grncode['status'] == 1) { ?> -->
						<input type="hidden" name="chk[]" value="<?php echo $grncode['id']; ?>">
						<!-- <?php } ?> -->

						<?php echo $i; ?>
					</td>

					<td>
						<input type="text" id="serialnumber<?php echo $i; ?>" name="serialnumber[]" class="form-control" value="<?php echo $grncode['serial_no']; ?>" readonly>
					</td>

					<td>
						<input type="text" id="grn<?php echo $i; ?>" name="grnnumber[]" class="form-control" value="<?php echo $grncode['grn_number']; ?>" readonly>
					</td>
				</tr>
			<?php $i = $i + 1;
			}  ?>
		</tbody>
	</table>

	<?php if ($grninfo['status'] == '1') {  ?>
		<input type="hidden" name="grn_ID" value="<?php echo $id; ?>">
		<input type="submit" name="submit" id="submit" class="btn btn-success submitBtn" value="SAVE">
	<?php  }  ?>

</form>



<script type="text/javascript">
	$(document).ready(function() {
		$("form[name='fupForm']").on("submit", function(ev) {
			ev.preventDefault();

			var formData = new FormData(this);
			$('.wage_content').html('<br><div style="text-align: center;"><img src="images/images/load3.gif"></div>');
			$.ajax({
				url: 'qvision/Purchase_process/grn_purchase_insert.php',
				method: "POST",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data) {

					alert('Updated Successfully');
					generate_purchase()

				}
			});
		});

		$('#remark_custom').hide();
	});


	function openRemark(v) {

		if (v == 1) {
			$('#remark_custom').show();

		} else {
			$('#remark_custom').hide();
		}

	}
</script>

</html>