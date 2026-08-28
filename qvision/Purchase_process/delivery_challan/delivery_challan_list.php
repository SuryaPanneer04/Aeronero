<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid = $_SESSION['candidateid'];
$userrole = $_SESSION['userrole'];
?>
<!DOCTYPE HTML>
<html>

<head>
	<style>
		.right {
			margin-right: 2px;
		}
	</style>
</head>

<body>
	<div class="card card-primary">

		<div class="card-header" style="background-color: #f1cc61 ;">
			<h2 class="card-title">
				<font size="4"><b>Delivery Challan List</b></font>
			</h2>
			<a onclick="return new_challan()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Add</a>
		</div>
		<div class="card-body">

			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<th>SL.No</th>
					<th> SO Number</th>
					<th>Company Name</th>
					<th>Product</th>
					<th>Qty</th>
					<th colspan='2'><strong> Action</strong></th>
				</thead>
				<tbody>
					<?php

					$emp_sql = $con->query("SELECT * from challan_entry   group by customer_name"); //where status='1'
					//echo "SELECT id,cost_sheet_no,quote_no,so_number,po_date FROM po_generate where po_upload_status=2 order by id desc";

					$cnt = 1;
					while ($data = $emp_sql->fetch()) {

					?>
						<tr>
							<td><?php echo $cnt; ?>.</td>
							<td> <?php echo $data['so_number']; ?> </td>
							<td><?php
								$customer_name = $data['customer_name'];

								$queryo = $con->prepare("SELECT id,client_id from cost_sheet_entry where  id='$customer_name'");
								$queryo->execute();
								$rowo = $queryo->fetch();
								$client_id = $rowo['client_id'] ?? 0;

								$orgName = $con->query("SELECT org_name from new_client_master where  id='$client_id'");
								$org = $orgName->fetch();

								echo $client_org_name = $org['org_name'] ?? 0;
								?>
							</td>

							<td> <?php echo  $product_name = $data['product_name']; ?> </td>
							<td> <?php echo $data['qty']; ?> </td>



							<td>
								<button class="btn btn-info" name="challan_view" id="challan_view" data-id="<?php echo $data['id']; ?>" onclick="challan_view(<?php echo $data['id']; ?>)">View
								</button>

							</td>

						</tr>
					<?php
						$cnt = $cnt + 1;
					}
					?>
				</tbody>
			</table>
		</div>
		<!-- /.content -->
	</div>

	<script>
		function challan_view(v) {
			//alert(v)

			$.ajax({
				type: "POST",
				url: "qvision/Purchase_process/delivery_challan/challan_send_view.php?id=" + v,
				success: function(data) {
					$("#main_content").html(data);
				}
			})
		}

		function new_challan() {
			$.ajax({
				type: "POST",
				// url:"qvision/Purchase_process/delivery_challan/challan_add.php?id=",
				url: "qvision/Purchase_process/delivery_challan/dc_add.php",
				success: function(data) {
					$("#main_content").html(data);
				}
			})
		}
	</script>
</body>

</html>