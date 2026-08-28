<?php
//GRN Entry status = 1 ... initial 
//GRN status = 2.... after add to purchase.

require '../../connect.php';
require '../../user.php';

$id = $_REQUEST['id'];

$table_data = "select a.cost_sheet_id,a.so_number,a.specification,a.vendor_id,a.unit_qty,b.vendor_name from purchase_vendor_master a  left join doller_vendor_mastor b on a.vendor_id = b.id where a.id='$id'";
$que = $con->query($table_data);
$row = $que->fetch();

$cs_id = $row['cost_sheet_id'];
$so_num = $row['so_number'];
$specification = $row['specification'];
$vendor = $row['vendor_id'];
$vendor_name = $row['vendor_name'];
$cost_sheet_id = $row['cost_sheet_id'];
$qty = $row['unit_qty'];

$datas = "select id,description,qty from cost_sheet_entry where id='$cost_sheet_id'";
$quexz = $con->query($datas);
$roedw = $quexz->fetch();
$description = $roedw['description'] ?? 0;
$qtyx = $roedw['qty'] ?? 0;

$pre_record = "select * from grn_generate where cost_sheets_id='$cost_sheet_id' and spec='$description'";
$_preroar = $con->query($pre_record);
$_preroar->execute();
$count = $_preroar->rowCount();
$rem_val = $_preroar->fetch();
if ($count == 0) {

	$merg = "select a.*,a.qty as cost_req,b.*,b.quantity as pur_req from cost_sheet_entry a  join purchase_requistion_entry b on (a.description=b.description) where a.product_name='$specification' and a.id='$cost_sheet_id'";

	$roar = $con->query($merg);
	$roar->execute();
	$countz = $roar->rowCount();
	$ras_val = $roar->fetch();

	if ($countz == 1) {
		$cost_req = $ras_val['cost_req'];
		$pur_req = $ras_val['pur_req'];

		$total_req = $cost_req + $pur_req;
	} else {
		$total_req = $row['unit_qty'];
	}
} else {
	$grn_id = $rem_val['id'];
	$req_qty = $rem_val['req_qty'];
	$rec_qty = $rem_val['rec_qty'];
	$total_req = $req_qty - $rec_qty;
}
?>
<html>

<head>
	<link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<div class="card card-info">
	<div class="card-header">
		<h2 class="card-title">
			<font size="4"><b>GRN Details</b></font>
		</h2>
		<a onclick="grn_list()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
	</div>
</div>

<form id="fupForm" name="fupForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
	<table class="table table-bordered">

		<tr>
			<td><b>SO Number</b></td>
			<td colspan="4">
				<input type="text" class="form-control" value="<?php echo $so_num; ?>" name="soNumber" readonly>
			</td>
		</tr>

		<tr>
			<td><b> Vendor Name </b></td>
			<td colspan="4">
				<input type="text" class="form-control" name="vendor_name" value="<?php echo $vendor_name; ?>" readonly>
			</td>
		</tr>

		<tr>
			<td><b>Product Name</b></td>
			<td colspan="4">
				<input type="text" class="form-control" id="proname" value="<?php echo $specification; ?>" name="proname" readonly>
			</td>
		</tr>
		<tr>
			<td><b>Specification</b></td>
			<td colspan="4"><textarea class="form-control" id="specification" name="specification"><?php echo $description; ?></textarea></td>
		</tr>
		<tr>
			<td><b>Requested Qty</b></td>
			<td colspan="4"><input type="text" class="form-control" id="rqst" value="<?php echo $total_req; ?>" name="rqst" readonly></td>
		</tr>
		<?php if ($total_req != 0) { ?>
			<tr>
				<td><b>Received Qty</b></td>
				<td colspan="4"><input type="text" class="form-control" id="receive" onkeyup="vallue(this.value)" name="receive" required></td>
			</tr>
		<?php } ?>
		<!-- <tr>
			<td><b>Upload Purchase Invoice</b></td>
			<td colspan="4"><input type="file" class="form-control" id="image" name="image" required></td>
		</tr> -->

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
			$query = $con->query("SELECT * from purchase_vendor_master where  id='$id'");
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
		$query1 = $con->query("SELECT * from purchase_vendor_master where  id='$id'");
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

	<input type="hidden" value="<?php echo $vendor; ?>" name="vendor" id="vendor">
	<input type="hidden" value="<?php echo $cs_id; ?>" name="cs_id" id="cs_id">
	<input type="hidden" value="<?php echo $id; ?>" name="pvm_id" id="pvm_id">

	</div>

	<?php if ($total_req != 0) { ?>

		<input type="button" class="delete-row btn btn-danger" value="Delete" style="float:right;" onclick="deleteRow('new_tab')">&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" class="add-row btn btn-success" value="Add" onclick="checking();" style="float:right;"><br /><br />
		<table id="new_tab" width="300px" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered table-striped">
			<tbody id="cost_sheett">

				<tr>
					<th>Sr. No.</th>
					<th>Serial Number</th>
				</tr>



				<script>
					function back() {
						grn_list()
					}

					function vallue(c) {
						var resd = c;

						$.ajax({
							url: "qvision/Purchase_process/get.php?id=" + resd,
							success: function(data) {

								$('#new_tab').html(data);
							}
						});
					}
				</script>
			</tbody>
		</table>


		<input type="submit" name="submit" id="submit" class="btn btn-success submitBtn" value="SAVE">
	<?php } else {
	?>
		<table id="new_tab_view" width="300px" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered table-striped">
			<tbody>

				<tr>
					<th>Sr. No.</th>
					<th>Serial Number</th>
				</tr>

				<?php
				$grn_generated_code = $con->query("select * from grn_entry where grn_id = '$grn_id' order by status");
				$i = 1;
				while ($grncode = $grn_generated_code->fetch()) {
				?>
					<tr>
						<td>
							<?php echo $i; ?>
						</td>

						<td>
							<input type="text" id="serialnumber<?php echo $i; ?>" name="serialnumber[]" class="form-control" value="<?php echo $grncode['serial_no']; ?>" readonly>
						</td>
					</tr>
				<?php $i = $i + 1;
				}  ?>

			</tbody>
		</table>

	<?php } ?>

</form>



<script type="text/javascript">
	// For Adding and Deleting New Row start -----------------------------------------------------------
	function checking() {
		var len = $('#new_tab tr').length;
		len = len + 0;



		$('#new_tab').append('<tr class="row_' + len + '"><td><input type="checkbox" name="chk[]" id="chk_' + len + '" value="' + len + '"></td><td><input type="text" id="serialnumber' + len + '" name="serialnumber[]" class="form-control"></td></tr>');

	}

	function deleteRow(new_tab) {
		var table = document.getElementById(new_tab);
		var rowCount = table.rows.length;
		var tabCount = table.rows.length;

		//document.getElementById("select-all").checked = false;

		for (var i = 1; i < rowCount; i++) {

			var row = table.rows[i];
			var chkbox = row.cells[0].childNodes[0];
			if (null != chkbox && true == chkbox.checked) {
				table.deleteRow(i);

				rowCount--;
				i--;
			}
		}
	}

	$(document).ready(function() {
		$("form[name='fupForm']").on("submit", function(ev) {
			ev.preventDefault();

			var formData = new FormData(this);
			$('.wage_content').html('<br><div style="text-align: center;"><img src="images/images/load3.gif"></div>');
			$.ajax({
				url: 'qvision/Purchase_process/grn_insert.php',
				method: "POST",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data) {

					alert('GRN Added Successfully');
					grn_list()

				}
			});
		});
	});
</script>

</html>