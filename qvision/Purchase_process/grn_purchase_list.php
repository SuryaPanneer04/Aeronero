<?php
require '../../connect.php';
require '../../user.php';
$candidateid = $_SESSION['candidateid'];
$userrole = $_SESSION['userrole'];
?>
<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="Qvision\commonstyle.css">
	<style>
		.right {

			margin-right: 2px;
		}
	</style>
</head>
<body>
	<div class="card card-primary">
		<div class="card-header">
			<h2 class="card-title">
				<font size="4"><b>Purchase List</b></font>
			</h2>
		</div>
		<div class="card-body">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<th>SL.No</th>
					<th>SO Number</th>
					<th>Cost Sheet No</th>
					<th>Vendor Name</th>
					<th>Status</th>
					<th><strong> Action</strong></th>
				</thead>
				<tbody>
					<?php
					$emp_sql = $con->query("SELECT a.id,b.so_number,b.cost_sheet_no,a.vendor_id,c.vendor_name,a.status from grn_generate a left join purchase_vendor_master b on a.purchase_id = b.id left join doller_vendor_mastor c on a.vendor_id = c.id  order by a.id desc");
					$cnt = 1;
					while ($data = $emp_sql->fetch()) {
					?>
						<tr>
							<td><?php echo $cnt; ?>.</td>
							<td><?php echo $data['so_number']; ?></td>
							<td><?php echo $data['cost_sheet_no']; ?> </td>
							<td><?php echo $data['vendor_name']; ?>	</td>
							<td><?php
							if( $data['status'] == '1'){
								echo "<span style='color: blue;font-weight: bold;'> Generate Purchase </span>";
								} else {
									echo "<span style='color: green;font-weight: bold;'> Generated Purchase Successfully </span>";
							} ?>	</td>
							<td>
								<button class="btn btn-info" name="generate_purchase"  onclick="purchase_view(<?php echo $data['id']; ?>)"> <i class="fa fa-eye"></i> </button>						
							</td>
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
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"autoWidth": false,
			});
		});


		function purchase_view(v) {

			$.ajax({
				type: "POST",
				url: "qvision/Purchase_process/grn_purchase_view.php?id=" + v,
				success: function(data) {
					$("#main_content").html(data);
				}
			})
		}
	</script>
</body>
</html>