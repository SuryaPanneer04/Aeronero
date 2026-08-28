<?php
require '../../../connect.php';
$resourceid = $_REQUEST['id'];
//$sql=$con->query("SELECT *,s.status as status,s.feedback_sts as feedbcksts,s.next_followup_date as next_followup_date FROM resource_form_detail s left join jobdescription_master m on s.position=m.id join source_master sm on s.source=sm.id where s.id='$resourceid'");
$sql = $con->query("SELECT *,s.status as status FROM resource_form_detail s left join jobdescription_master m on s.position=m.id join source_master sm on s.source=sm.id where s.id='$resourceid'");
$fet = $sql->fetch();
?>
<style>
	.card-primary:not(.card-outline)>.card-header {
		background-color: #f1cc61 !important;
	}

	.btn-danger {
		background-color: #ed5d00;
		border-color: #ed5d00;
	}

	.card-primary:not(.card-outline)>.card-header a {
		color: black;
	}

	.card-primary:not(.card-outline)>.card-header {
		color: black !important;
	}
</style>
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<font size="5">Resource Form View</font>
		</h3>
		<a onclick="back_to_list()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"></i>Back</a>
	</div>

	<form role="form" method="POST" enctype="multipart/form-data">
		<!-- Post -->
		<table class="table table-bordered">
			<tr id="get_name">
				<td>Source: *</td>
				<td colspan="5">
					<input type="text" class="form-control" name="source" id="source" value="<?php echo $fet['name']; ?>" readonly>
				</td>
			</tr>

			<?php
			if ($fet['source'] == "2") {
			?>
				<tr id="cname">
					<td>Consultant Name:</td>
					<td colspan="5"><input type="text" class="form-control" name="consl_name" id="consl_name" value="<?php echo $fet['consultant_name']; ?>" readonly>
					</td>
				</tr>

			<?php
			} else {

			?>
				<tr id="refer_type">
					<td>Referal Type</td>
					<td colspan="5"><input type="text" class="form-control" id="referal_type" name="referal_type" value="<?php echo $fet['referal_type']; ?>" readonly>
					</td>
				</tr>

				<tr id="refer_name">
					<td>Referal Name</td>
					<td colspan="5"><input type="text" class="form-control" id="get_ref_name" name="get_ref_name" value="<?php echo $fet['referal_name']; ?>" readonly>
					</td>
				</tr>

			<?php
			}
			?>


			<tr>
				<td>Date:</td>
				<td colspan="5"><input type="date" class="form-control" name="consl_date" id="consl_date" value="<?php echo $fet['date']; ?>" readonly>
				</td>
			</tr>

			<tr>
				<td>Post Applied for: *</td>
				<td colspan="5">
					<input type="text" class="form-control" name="position" id="position" value="<?php echo $fet['tittle']; ?>" readonly>
				</td>

			</tr>


			<tr>
				<td>Client Org Name</td>
				<td colspan="5">
					<input type="text" class="form-control" id="client_org_name" name="client_org_name" value="<?php echo $fet['client_org_name']; ?>" readonly>
				</td>
			</tr>

			<tr>
				<td>Location</td>
				<td><input type="text" class="form-control" id="location" name="location" value="<?php echo $fet['location']; ?>" readonly></td>
			</tr>

			<tr>
				<td>Interview Round Level:</td>
				<td colspan="5">
					<input type="text" class="form-control" name="round" id="round" value="<?php echo $fet['interview_round']; ?>" readonly>
				</td>
			</tr>

			<tr>
				<td colspan="6">
					<center><b>Personal Details</b></center>
				</td>
			</tr>
			<tr>
				<td>First Name: *</td>
				<td colspan="2"><input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $fet['first_name']; ?>" readonly></td>
				<td>Last Name: *</td>
				<td colspan="2"><input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $fet['last_name']; ?>" readonly></td>
			</tr>

			<tr>
				<td>Gender:</td>
				<td colspan="2">
					<label>
						<input type="radio" name="gender" value="male" <?php if ($fet['gender'] == "male") {
																			echo "checked";
																		} else {
																			echo "disabled";
																		} ?>>&nbsp;Male</label>
				</td>

				<td colspan="2">
					<label>
						<input type="radio" name="gender" value="female" <?php if ($fet['gender'] == "female") {
																				echo "checked";
																			} else {
																				echo "disabled";
																			} ?>>&nbsp;Female</label>
				</td>
			</tr>

			<tr>
				<td>Mobile Number: *</td>
				<td colspan="5"><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $fet['mobile']; ?>" readonly></td>
			</tr>
			<tr>
				<td>WhatsApp Number: </td>
				<td colspan="5"><input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?php echo $fet['whatsapp']; ?>" readonly></td>
			</tr>
			<tr>
				<td>Email ID : *</td>
				<td colspan="5"><input type="text" class="form-control" id="mail" name="mail" value="<?php echo $fet['mail']; ?>" readonly></td>
			</tr>
			<tr>
				<td>Aadhar Number: </td>
				<td colspan="4">
					<input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $fet['aadhar_no']; ?>" readonly>
				</td>
			</tr>

			<tr>
				<td colspan="6">
					<center><b>Educational Qualification</center></b>
				</td>
			</tr>
			<tr>
				<td>Degree: *</td>
				<td colspan="4"><input type="text" class="form-control" id="degree" name="degree" value="<?php echo $fet['degree']; ?>" readonly>
				</td>
			</tr>
			<tr>
				<td>University: *</td>
				<td colspan="4"><input type="text" class="form-control" id="university" name="university" value="<?php echo $fet['university']; ?>" readonly>
				</td>
			</tr>

			<tr id='employee_new1'>
				<td>Percentage</td>
				<td colspan="4"><input type="text" class="form-control" id="percentage" name="percentage" value="<?php echo $fet['percentage']; ?>" readonly></td>
			</tr>
			<tr>
				<td>Employement Status:</td>
				<td colspan="4">
					<input type="text" class="form-control" id="emp_status" name="emp_status" value="<?php echo $fet['employement_status']; ?>" readonly>
				</td>
			</tr>
			<?php
			if ($fet['employement_status'] == "Experience") {
			?>
				<tr id='employee_status'>
					<td>Company Name:</td>
					<td colspan="2"><input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $fet['company_name']; ?>" readonly></td>
					<td>No of Year Experience:</td>
					<td colspan="2"><input type="number" class="form-control" id="no_of_year" name="no_of_year" value="<?php echo $fet['year_experience']; ?>" readonly></td>
				</tr>
			<?php
			} else {
			?>
				<tr id='employee_new'>
					<td>Year of Passout </td>
					<td colspan="4"><input type="text" class="form-control" id="year_of_pass" name="year_of_pass" value="<?php echo $fet['year_of_pass']; ?>" readonly></td>
				</tr>
			<?php
			}
			?>
			<tr>
				<td>Resume:
				<td>
					<a href="qvision/Resource/Resource_form/resume_upload/<?php echo $fet['resume']; ?>" download="<?php echo $fet['resume']; ?>"><?php echo $fet['resume']; ?></a>
			</tr>

			<tr>
				<td colspan="6">
					<center><b>Certification Details</center></b>
				</td>
			</tr>
			<tr>
				<td>Certification:</td>
				<td colspan="4">
					<input type="text" class="form-control" id="cer_status" name="cer_status" value="<?php echo $fet['certification_status']; ?>" readonly>
				</td>
			</tr>
			<?php
			if ($fet['certification_status'] == "YES") {
			?>
				<tr id='certificate_status'>
					<td>Certificate:</td>
					<td colspan="2"><input type="text" class="form-control" id="certificate" name="certificate" value="<?php echo $fet['certification']; ?>" readonly></td>
				</tr>
				<tr id='validity'>
					<td>Validity From:</td>
					<td colspan="2"><input type="text" class="form-control" id="validity" name="validity" value="<?php echo $fet['validity']; ?>" readonly></td>
					<td>Validity To:</td>
					<td colspan="2"><input type="text" class="form-control" id="cer_from" name="cer_from" value="<?php echo $fet['certified_from']; ?>" readonly></td>
				</tr>
			<?php
			} else {
			}
			?>

		</table>
		<!-- /.post -->



		<table class="table table-bordered">
			<h3>
				<center>Feedback Entry Details</center>
			</h3>
			<tr>
				<th>Feedback</th>
				<th>Feedback Followup Date</th>
			</tr>

			<?php
			$sql3 = $con->query("SELECT * FROM  resource_feedback where resource_id='$resourceid'");
			$cnt = 1;
			while ($rows = $sql3->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr>
					<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows['resource_id']; ?>">

					<td>
						<input type="text" class="form-control" id="feedback_1" name="feedbacks[]" value="<?php echo  $rows['feedback']; ?>" readonly>
					</td>

					<td>
						<input type="text" class="form-control" id="date_1" name="dates[]" value="<?php echo  $rows['feedback_date'] ?? 0; ?>" readonly>
					</td>
				</tr>

			<?php
				$cnt = $cnt + 1;
			}
			?>
		</table>

		<br>
		<br>

		<?php
		$feedbcksts = isset($fet['feedbcksts']) ? $fet['feedbcksts'] : '';
		$next_followup_date = isset($fet['next_followup_date']) ? $fet['next_followup_date'] : '';

		if (($fet['status'] == 1 || $fet['status'] == 2) && ($feedbcksts != '1' && $next_followup_date == '')) {
		?>

			<table class="table table-bordered" id="new_tab">
				<tr>
					<th>#</th>
					<th>Feedback</th>
					<th>Feedback Followup Date</th>
					<th>Next Followup Date</th>
				</tr>


				<tr>
					<td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;" /></td>

					<td><input type="text" class="form-control" id="feedback_1" name="feedback[]"></td>
					<td><input type="date" class="form-control" id="date_1" name="date[]"></td>

					<td><input type="date" class="form-control" name="next_date" id="next_date"></td>

					<td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
						<input type="button" class="btn btn-danger" id="enquiry_row_remove" value="Remove">
					</td>
				</tr>
			</table>


		<?php
		}
		?>

		<?php
		$feedbcksts = isset($fet['feedbcksts']) ? $fet['feedbcksts'] : '';
		$next_followup_date = isset($fet['next_followup_date']) ? $fet['next_followup_date'] : '';

		if (
			(isset($fet['status']) && ($fet['status'] == 1 || $fet['status'] == 2)) &&
			($feedbcksts != '1' && $next_followup_date == '')
		) {
		?>


			<!-- ?> -->
			<tr>
				<td>
					<input type="hidden" name="rid" id="rid" value="<?php echo $resourceid; ?>">
				</td>
				<td colspan="6">
					<input type="button" class="btn btn-success" name="save" onclick="feedback_insert()" style="float:right;" value="Save">
				</td>
			</tr>
			<br>
			<br>

		<?php
		}
		?>
	</form>
</div>

<script>
	$(document).ready(function() {
		var refer = <?php echo json_encode($fet['referal_type']); ?>;

		if (refer == '') {
			$('#refer_type').hide();
			$('#refer_name').hide();
		}
	})
</script>
<script>
	function back_to_list() {
		resource_list();

	}
</script>

<script>
	function feedback_insert() {
		var id = $('#rid').val();
		var feedback_1 = $('#feedback_1').val();
		var date_1 = $('#date_1').val();
		//alert(id);
		var data = $('form').serialize();
		if (feedback_1 == '' || date_1 == '') {
			alert("Enter all required fields");
		} else {
			$.ajax({
				type: 'GET',
				data: "id=" + id,
				data,
				url: "qvision/Resource/Resource_form/followup_date_insert.php",
				success: function(data) {
					if (data == 0) {
						alert('Update Failed');
					} else {
						alert("Update Successfully");
						resource_list()
					}
				}
			});
		}
	}
</script>

<script>
	function check() // education
	{
		var len = $('#new_tab tr').length;
		len = len + 1;
		$('#new_tab').append('<tr class="row_' + len + '"><td><input type="checkbox" class="chk" name="chk[]" id="chk_' + len + '" value="' + len + '"</td><td><input type="text" class="form-control" id="feedback_' + len + '" name="feedback[]"></td><td><input type="date" class="form-control" id="date_' + len + '" name="date[]"></td></tr>');
	}

	$('#enquiry_row_remove').click(function() {
		$('input:checkbox:checked.chk').map(function() {
			var id = $(this).val();
			var le = $('#new_tab tr').length;

			if (le == 1) {
				alert("You Can't Delete All the Rows");
			} else {
				$('.row_' + id).remove();
			}

		});
	});
</script>