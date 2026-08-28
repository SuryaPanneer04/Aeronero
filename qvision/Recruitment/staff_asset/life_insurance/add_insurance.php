<?php
require '../../../../connect.php';
include("../../../../user.php");
$userrole = $_SESSION['userrole'];
?>

<head>
	<link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<font size="5"> Add Life Insurance </font>
		</h3>
		<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"></i>BACK</a>
	</div>

	<form method="POST" id="lifeInsuranceFrom" enctype="multipart/form-data">
		<table class="table table-bordered">

			<tr>
				<td>Employee Name:</td>
				<td colspan="2">
					<select class="form-control" name="emp_name">
						<option value="0">-- Select Employee Name --</option>
						<?php
						$dep_sql = $con->query("SELECT * FROM staff_master");
						while ($dep_sql_res = $dep_sql->fetch(PDO::FETCH_ASSOC)) {
						?>
							<option value="<?php echo $dep_sql_res['id']; ?>" data-id="<?php echo $dep_sql_res['id']; ?>"> <?php echo $dep_sql_res['emp_name']; ?> </option>
						<?php
						}
						?>
					</select>
				</td>
			</tr>

			<tr>
				<td>Insurance Name</td>
				<td colspan="2">
					<input type="text" class="form-control" name="life_insurance_name">
				</td>
			</tr>

			<tr>
				<td>Insurance Number</td>
				<td colspan="2">
					<input type="text" class="form-control" name="life_insurance_number">
				</td>
			</tr>

			<tr>
				<td>Validity From</td>
				<td colspan="2">
					<input type="date" class="form-control" name="validity_from">
				</td>
			</tr>

			<tr>
				<td>Validity To</td>
				<td colspan="2">
					<input type="date" class="form-control" name="validity_to">
				</td>
			</tr>

			<tr>
				<td>Policy Period</td>
				<td colspan="2">
					<input type="text" class="form-control" name="policy_period" value="10 Years" readonly>
				</td>
			</tr>

			<tr>
				<td>Eligible criteria</td>
				<td colspan="2">
					<!-- <input type="text" class="form-control" name="eligiblity" value="YES/NO" readonly> -->
					<select class="form-control" name="eligiblity">
						<option> -- Select Eligible -- </option>
						<option value="YES"> YES </option>
						<option value="NO"> NO </option>
					</select>
				</td>
			</tr>

			<tr>
				<td>Document Upload</td>
				<td colspan="2">
					<input type="file" class="form-control" name="policy_doc[]" accept=".doc,.docx,.pdf">
				</td>
			</tr>

		</table>
		<input type="submit" value="Submit" class="btn btn-primary btn-md" style="float:right;">
	</form>
</div>
	<script>
		function back() {
			life_insure()
		}

		$(document).ready(function() {
			$("#lifeInsuranceFrom").on('submit', function(e) {
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: 'qvision/Recruitment/staff_asset/life_insurance/insurance_submit.php',
					data: new FormData(this),
					contentType: false,
					processData: false,
					success: function(data) {
						if (data == 0) {
							alert("Form Data has not been Submitted");
							life_insure();
						} else {
							alert("Form Data has been Submitted");
							life_insure();
						}
					}
				});
			});
		})

// //addDays Function used to check employee completed 3 years or not from current date.
// 	function addDays(date, days) {
// 		var result = new Date(date);
// 		var DOJ = new Date(days);
// 		result.setDate(result.getDate() - DOJ.getDate());
// 		return result;
// 	}

// 	// <!-- Current date-->
// 	var mintoday = new Date();
// 	var mindd = mintoday.getDate();
// 	var minmm = mintoday.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
// 	var minyyyy = mintoday.getFullYear();
// 	if (mindd < 10) {
// 		mindate = '0' + mindd
// 	} else {
// 		mindate = mindd
// 	}
// 	if (minmm < 10) {
// 		minmm = '0' + minmm
// 	} else {
// 		minmm = minmm
// 	}
// 	mintoday = minyyyy + '-' + minmm + '-' + mindate;
//     cur  = new Date(mintoday);
//     joining  = new Date('2022-07-01');

//  	var nextMonth = addDays(mintoday, joining)

	
// 	var Difference_In_Time = cur.getTime() - joining.getTime();
// 	console.log(Difference_In_Time)

// 	var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

// 	console.log(Difference_In_Days)

	</script>