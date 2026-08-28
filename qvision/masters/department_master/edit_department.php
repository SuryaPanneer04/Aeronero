<?php
require '../../../connect.php';
$id = $_REQUEST['id'];
$stmt = $con->prepare("select * from z_department_master where id='$id'");
$stmt->execute();
$row = $stmt->fetch();
$sta = $row['status'];
?>

<head>
	<link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<style>
	.card-primary:not(.card-outline)>.card-header {
		background-color: #f1cc61 !important;
	}

	.card-primary:not(.card-outline)>.card-header {
		color: black !important;
	}

	.btn-dark {
		background-color: #ed5d00 !important;
		border-color: #ed5d00 !important;
	}

	.card-primary:not(.card-outline)>.card-header a {
		color: black !important;
	}
</style>
<!-- <div class="container-fluid">
<div class="card mb-3"> -->
<div class="card card-primary">

	<div class="card-header">
		<!-- <i class="fa fa-table"></i> DEPARTMENT DETAILS EDIT -->
		<h3 class="card-title">
			<font size="5">EDIT DEPARTMENT DETAILS</font>
		</h3>

		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
	</div>
	<div class="card-body" id="printableArea">
		<form role="form" name="edit_form" id="edit_form">

			<table class="table table-bordered">
				<tr>
					<td>Department Name</td>
					<td colspan="5">
						<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id; ?>">
						<input type="text" class="form-control" id="name" name="name" value="<?php echo  $row['dept_name']; ?>">
					</td>
				</tr>
				<tr>
					<td>Status</td>
					<td colspan="2">

						<select class="form-control" name="status" id="status">
							<?php

							if ($sta == 0) {
							?>
								<option value="0">InActive</option>
								<option value="1">Active</option>
							<?php
							} else {
							?>
								<option value="1">Active</option>
								<option value="0">InActive</option>
							<?php
							}
							?>

						</select>
					</td>
				</tr>
			</table>

			<input type="button" name="submit" value="Submit" class="btn btn-primary btn-md" style="float:right;" onclick="update_department()">
			<br>
			<br>
		</form>
	</div>
</div>
<script>
	function back() {
		department_master();
	}

	function update_department() {
		var data = $('#edit_form').serialize();
		$.ajax({
			type: 'POST',
			url: 'qvision/masters/department_master/update_department.php',
			data: data + "&submit=1",
			success: function(data) {
				alert("Updated Successfully");
				department_master();
			}
		});
	}
</script>