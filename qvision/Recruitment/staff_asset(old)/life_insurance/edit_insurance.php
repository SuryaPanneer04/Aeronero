<?php
require '../../../../connect.php';
$id = $_REQUEST['id'];
$stmt = $con->query("SELECT b.emp_name AS ename,a.* FROM life_insurance a LEFT JOIN staff_master b ON a.emp_id = b.id  WHERE a.id='$id'");
$row = $stmt->fetch();
?>

<head>
     <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
     <div class="card-header">
          <i class="fa fa-table"></i> Edit Life Insurance
          <a onclick="backtoinsure()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"> </i>Back</a>
     </div>
     <div class="card-body" id="printableArea">
     <form method="POST" id="InsuranceEditFrom" enctype="multipart/form-data">
		<table class="table table-bordered">

			<tr>
				<td>Employee Name:</td>
				<td colspan="2">
					<select class="form-control" name="emp_name">
						<option value="<?php echo $row['emp_id'];?>"><?php echo $row['ename'];?></option>
						<option value="0">-- Select Employee Name --</option>
						<?php
						$dep_sql = $con->query("SELECT * FROM staff_master");
						while ($dep_sql_res = $dep_sql->fetch(PDO::FETCH_ASSOC)) {
						?>
							<option value="<?php echo $dep_sql_res['id']; ?>"> <?php echo $dep_sql_res['emp_name']; ?> </option>
						<?php
						}
						?>
					</select>
				</td>
			</tr>

			<tr>
				<td>Insurance Name</td>
				<td colspan="2">
					<input type="text" class="form-control" name="life_insurance_name" value="<?php echo $row['insurance_name'];?>">
				</td>
			</tr>

			<tr>
				<td>Insurance Number</td>
				<td colspan="2">
					<input type="text" class="form-control" name="life_insurance_number" value="<?php echo $row['insurance_no'];?>">
				</td>
			</tr>

			<tr>
				<td>Validity From</td>
				<td colspan="2">
					<input type="date" class="form-control" name="validity_from" value="<?php echo $row['validity_from'];?>">
				</td>
			</tr>

			<tr>
				<td>Validity To</td>
				<td colspan="2">
					<input type="date" class="form-control" name="validity_to" value="<?php echo $row['validity_to'];?>">
				</td>
			</tr>

			<tr>
				<td>Policy Period</td>
				<td colspan="2">
					<input type="text" class="form-control" name="policy_period" value="<?php echo $row['policy_period'];?>" readonly>
				</td>
			</tr>

			<tr>
				<td>Eligible criteria</td>
				<td colspan="2">
					<!-- <input type="text" class="form-control" name="eligiblity" value="<?php echo $row['eligiblity'];?>" readonly> -->

                         <select class="form-control" name="eligiblity">
						<option value="<?php echo $row['eligiblity'];?>"> <?php echo $row['eligiblity'];?> </option>
						<option> -- Select Eligible -- </option>
						<option value="YES"> YES </option>
						<option value="NO"> NO </option>
					</select>
				</td>
			</tr>

			<tr>
				<td>Document Upload</td>
				<td>
					<input type="file" class="form-control" name="policy_doc[]" accept=".doc,.docx,.pdf">
				</td>
	               <td style="border-left:none;">

	                <a href="qvision/Recruitment/staff_asset/life_insurance/lifeInsuranceDoc/<?php echo $row['Insurance_doc'];?>" download="<?php echo $row['Insurance_doc']; ?>" ><?php echo $row['Insurance_doc']; ?></a> 

	               <input type="hidden" value="<?php echo $row['Insurance_doc']; ?>" name="life_insure_attach" id="attachhh">
	              </td>
			</tr>

		</table>

          <input type="hidden" name="lid" id="lid" value="<?php echo $row['id'];?>">
		<input type="submit" value="Submit" class="btn btn-primary btn-md" style="float:right;">
	</form>
     </div>
</div>
</div>

<script>
     function backtoinsure() {
          life_insure()
     }


     $(document).ready(function() {
			$("#InsuranceEditFrom").on('submit', function(e) {
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: 'qvision/Recruitment/staff_asset/life_insurance/update_insurance.php',
					data: new FormData(this),
					contentType: false,
					processData: false,
					success: function(data) {
						if (data == 0) {
							alert("Update Failed");
							life_insure();
						} else {
							alert("Update Successfully");
							life_insure();
						}
					}
				});
			});
		})
</script>