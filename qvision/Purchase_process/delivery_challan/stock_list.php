<?php
require '../../../connect.php';
require '../../../user.php';
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
				<font size="4"><b>Stock List</b></font>
			</h2>

		</div>
		<div class="card-body">

			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<th>SL.No</th>
					<th>Product Name</th>
					<th>Serial No</th>
					<th>GRN Number</th>
					<th>Vendor Name</th>
					<th>Action</th>


				</thead>
				<tbody>
					<?php

					$emp_sql = $con->query("SELECT * from grn_entry  where status='1'");


					$cnt = 1;
					while ($data = $emp_sql->fetch()) {

					?>
						<tr>
							<td><?php echo $cnt; ?>.</td>
							<td><?php echo $data['pro_name'];?></td>
							<td><?php echo $data['serial_no']; ?></td>							
							<td><?php echo $data['grn_number']; ?></td>
							<td><?php $vendor_id = $data['vendor_id'];
								$queryy = $con->prepare("select vendor_name from doller_vendor_mastor where id='$vendor_id'");
								$queryy->execute();
								$values = $queryy->fetch();
								echo $vendor_name = $values['vendor_name'];
								?></td>
							<td><button class="btn btn-info" name="generate_grn" id="generate_grn" data-id="<?php echo $data['id']; ?>" onclick="generate_grn(<?php echo $data['id']; ?>)">View
								</button></td>
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
		function generate_grn(v) {

			//alert(v)
			$.ajax({
				type: "POST",
				url: "qvision/Purchase_process/generate_grn.php?id=" + v,
				success: function(data) {
					$("#main_content").html(data);
				}
			})
		}
	</script>
</body>

</html>