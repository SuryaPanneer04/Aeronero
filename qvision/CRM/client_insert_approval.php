<?php
require '../../connect.php';
include("../../user.php");
$id = $_REQUEST['id'];
$stmt = $con->prepare("SELECT distinct new_plant_master.id,new_client_master.status as client_master_status,z_department_master.*,candidate_form_details.*,enquiry.id as eq_id,enquiry.status as enqstst,enquiry.*,new_client_master.*,org_type_master.*,new_plant_master.*,s.*,c.* FROM `new_client_master` left join  new_plant_master on new_client_master.id=new_plant_master.client_id left join states s on new_plant_master.state=s.id left join cities c on new_plant_master.city=c.id  left join z_department_master ON new_client_master.department_id=z_department_master.id left JOIN candidate_form_details ON new_client_master.employee_id = candidate_form_details.id left join enquiry on new_client_master.org_name=enquiry.Company_name left JOIN org_type_master ON new_client_master.org_type=org_type_master.id where enquiry.id='$id'");



$stmt->execute();
$row = $stmt->fetch();
$eq_id = $row['eq_id'] ?? 0;
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
<section class="wage_content">
	<div class="card card-primary">
		<div class="card-header">
			<center>
				<h3 class="card-title"><b>Client DETAILS FORM</b></h3>
			</center>
			<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
		</div>
	</div>

	<!--form method="POST" name="form" id="form" action="" autocomplete="off"-->
	<form method="POST" name="form" id="form" action="">

		<input type="hidden" name="client_id" id="client_id" value="<?php echo $id; ?>">
		<input type="hidden" name="enquiry_id" id="enquiry_id" value="<?php echo $eq_id; ?>">

		<table class="table table-bordered" id="new_tab">
			<td>Customer Code</td>
			<td colspan="3"><input type="text" class="form-control" id="cus_code" value="<?php echo $row['enquiry_code'] ?? 0; ?>" name="cus_code" readonly></td>
			<td>Clinet Code</td>
			<td colspan="2"><input type="text" class="form-control" id="client_code" value="<?php echo $row['client_code'] ?? 0; ?>" name="client_code" readonly></td>

			<input type="hidden" class="form-control" id="get_id" value="<?php echo $id; ?>" name="get_id" readonly>


			</tr>
			<tr>
				<td>Client Org Name*</td>
				<td colspan="5">
					<input type="text" class="form-control" id="txt_org_name" name="txt_org_name" value="<?php echo $row['org_name'] ?? 0; ?>" readonly>

				</td>

			</tr>
			<tr>
				<td>Client Org Type:</td>
				<td colspan="5">
					<input type="text" name="client_type" id="client_type" class="form-control" value="<?php echo $row['organization_type'] ?? 0; ?>" readonly>

				</td>

			<tr>
				<td>Website </td>
				<td colspan="5"><input type="text" class="form-control" id="txt_website" name="txt_website" value="<?php echo $row['website'] ?? 0; ?>" readonly></td>
				<td colspan="2"> </td>
			</tr>
			</tr>

			<div id="product_detail">
			</div>
			<td>Location</td>
			<td colspan="4"><input type="text" class="form-control" id="Location" name="Location" value="<?php echo $row['location'] ?? 0; ?>" readonly></td>
			<tr>
				<td>State *</td>
				<td colspan="5">
					<input type="text" class="form-control" name="state_1" id="state_1" value="<?php echo $row['statename'] ?? 0; ?>" readonly>

				</td>
			</tr>
			<tr>
				<td>City *</td>
				<td colspan="5"><input type="text" class="form-control" name="city_1" id="city_1" value="<?php echo $row['city_name'] ?? 0; ?>" readonly></td>
			</tr>
			<tr id="txt_gst_noo">
				<td>GST NO</td>
				<td colspan="4"><input type="text" class="form-control gst form-control mandatory" style="text-transform:uppercase" id="txt_gst_no" name="txt_gst_no" value="<?php echo $row['gst_no'] ?? 0; ?>" readonly></td>
				<input type="hidden" name="txt_duplicate_gstno" id="txt_duplicate_gstno">
			</tr>
			<tr id="txt_pan_noo">
				<td>PAN NO</td>
				<td colspan="4"><input type="text" style="text-transform:uppercase" class="form-control pan" id="txt_pan_no_1" name="txt_pan_no_1" value="<?php echo $row['pan_no'] ?? 0; ?>" readonly></td>
				<input type="hidden" name="txt_duplicate_panno" id="txt_duplicate_panno">
			</tr>
			<tr>
				<td>Company Address *</td>
				<td colspan="4"><input type="text" class="form-control" id="txt_address_1" name="txt_address_1" value="<?php echo $row['address'] ?? 0; ?>" readonly></td>
			</tr>
			<td>Contact Person *</td>
			<td colspan="3"><input type="text" class="form-control" value="<?php echo $row['it_name'] ?? 0; ?>" id="txt_client_name" name="txt_client_name" Placeholder="Customer Name" readonly></td>

			<td colspan="2"><input type="text" class="form-control" value="<?php echo $row['Designation'] ?? 0; ?>" id="txt_client_desig" name="txt_client_desig" placeholder="Customer  Designation" readonly></td>
			</tr>


			<tr>
				<td>Mobile No1 * </td>
				<td colspan="2"><input type="text" class="form-control" id="txt_mobile1" name="txt_mobile1" value="<?php echo $row['mobile1'] ?? 0; ?>" readonly></td>

				<td colspan="2"><input type="text" class="form-control" id="txt_mobile2" name="txt_mobile2" value="<?php echo $row['mobile2'] ?? 0; ?>" readonly></td>
			</tr>
			<tr>
				<td>Email Id 1 *</td>
				<td colspan="2"><input type="text" class="form-control" id="txt_mail_id1" name="txt_mail_id1" value="<?php echo $row['email1'] ?? 0; ?>" readonly></td>

				<td colspan="2"><input type="text" class="form-control" id="txt_mail_id2" name="txt_mail_id2" value="<?php echo $row['email2'] ?? 0; ?>" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control " id="txt_area_1" name="txt_area_1" value="<?php echo $row['area'] ?? 0; ?>" readonly></td>
				<td colspan="2"><input type="text" class="form-control pin" id="txt_pincode_1" name="txt_pincode_1" value="<?php echo $row['pincode'] ?? 0; ?>" readonly></td>
			</tr>
			<tr>
				<td>IT Department</td>
				<td colspan="2"><input type="text" class="form-control " id="txt_client_name_1" name="txt_client_name_1" value="<?php echo $row['it_name'] ?? 0; ?>" readonly></td>
				<td colspan="2"><input type="text" class="form-control " id="txt_client_desig_1" name="txt_client_desig_1" value="<?php echo $row['it_designation'] ?? 0; ?>" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control mob" id="txt_mobileone_1" maxlength="10" name="txt_mobileone_1" value="<?php echo $row['it_mob1'] ?? 0; ?>" readonly></td>
				<td colspan="2"><input type="text" class="form-control amob" id="txt_mobiletwo_1" maxlength="10" name="txt_mobiletwo_1" value="<?php echo $row['it_mob2'] ?? 0; ?>" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="mail" class="form-control mail" id="txt_mail_idone_1" name="txt_mail_idone_1" value="<?php echo $row['it_mail1'] ?? 0; ?>" readonly></td>
				<td colspan="2"><input type="mail" class="form-control amail" id="txt_mail_idtwo_1" name="txt_mail_idtwo_1" value="<?php echo $row['it_mail2'] ?? 0; ?>" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="4"><input type="text" class="form-control " id="txt_landno_1" name="txt_landno_1" value="<?php echo $row['it_landno'] ?? 0; ?>" readonly></td>
				</td>
			</tr>
			<tr>
				<td>Purchase Department</td>
				<td colspan="2"><input type="text" class="form-control " id="pur_name_1" name="pur_name_1" value="<?php echo $row['pur_name'] ?? 0; ?>" readonly></td>
				<td colspan="2"><input type="text" class="form-control " id="pur_designation_1" name="pur_designation_1" value="<?php echo $row['pur_designation'] ?? 0; ?>" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control " id="pur_contact_1" name="pur_contact_1" value="<?php echo $row['pur_contact'] ?? 0; ?>" readonly></td>
				<td colspan="2"><input type="mail" class="form-control purmail" id="pur_mail_1" name="pur_mail_1" value="<?php echo $row['pur_mail'] ?? 0; ?>" readonly></td>
			</tr>
			<tr>
				<td>Finance Department</td>
				<td colspan="2"><input type="text" class="form-control " id="fin_name_1" name="fin_name_1" value="<?php echo $row['fin_name'] ?? 0; ?>" readonly></td>
				<td colspan="2"><input type="text" class="form-control " id="fin_designation_1" name="fin_designation_1" value="<?php echo $row['fin_designation'] ?? 0; ?>" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control " id="fin_contact_1" name="fin_contact_1" value="<?php echo $row['fin_contact'] ?? 0; ?>" readonly></td>
				<td colspan="2"><input type="mail" class="form-control finmail" id="fin_mail_1" name="fin_mail_1" value="<?php echo $row['fin_mail'] ?? 0; ?>" readonly></td>
			</tr>
			<tr>


				<td colspan="5"><b>Document Upload*</b></td>
				<td align="left">
					<a href="qvision/CRM/uploads/<?php echo $row['verified_file']; ?>" target="_blank"><?php echo $row['verified_file'] ?? 0; ?></a>
				</td>
			</tr>
			<tr id="remrk">
				<td>Remarks *</td>
				<td colspan="2"><input type="text" id="remarks" name="remarks" class="form-control" required></td>
				<td colspan="2"><input type="button" class="btn btn-danger btn-lg" id="submit" name="submit" onclick="update_status()" value="Update"></td>
			</tr>
		</table>

		<br>
		<br>
		<table class="table table-bordered">
			<h3>
				<center>Feedback Entry Details</center>
			</h3>
			<br>
			<tbody>

				<?php
				$ddd = $row['calls_id'] ?? 0;
				$sql = $con->query("SELECT * FROM  crm_calls_feedback where calls_id='$ddd'");

				$cnt = 1;
				while ($feeddd = $sql->fetch(PDO::FETCH_ASSOC)) {

				?>
					<tr>
						<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $feeddd['calls_id']; ?>">
						<td>Feedback</td>
						<td><input type="text" class="form-control" id="feedback_1" name="feedbacks[]" value="<?php echo  $feeddd['feedback']; ?>" readonly></td>



						<td>Feedback Date </td>
						<td colspan="1"><input type="date" class="form-control" id="date_1" name="dates[]" value="<?php echo  $feeddd['feedback_date']; ?>" readonly></td>

					</tr>
				<?php
					$cnt = $cnt + 1;
				} ?>
			</tbody>

		</table>

		<center>
			<?php
			if ($row && isset($row['enqstst']) && $row['enqstst'] == 20) {
			?>


				<input type="button" class="btn btn-success btn-lg" id="save" name="save" onclick="approved()" value="Approve">

				<input type="button" class="btn btn-danger btn-lg" id="save1" name="save1" onclick="rejected()" value="Reject">
			<?php }
			?>
		</center>
	</form>



	<script>
		$(document).ready(function() {

			document.getElementById('remrk').style.visibility = "hidden";
			//document.getElementById('submit').style.visibility = "hidden";

		});

		function back_ctc() {
			cost_sheet_approval()
		}

		function approved() {
			var id = $('#client_id').val();
			var data = $('form').serialize();

			$('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');
			$.ajax({
				type: 'GET',
				data: data + "&" + "id=" + id,

				url: 'qvision/CRM/accounts_approval.php?id=' + id,
				success: function(data) {
					if (data == 1) {
						alert('Not Approved');
					} else {
						alert("Client Approved Successfully");
						costsheet_add()
					}
				}
			});
		}

		function rejected() {

			//alert(id);

			document.getElementById('remrk').style.visibility = "visible";
			//document.getElementById('submit').style.visibility = "visible";
			document.getElementById('save1').style.visibility = "hidden";
			document.getElementById('save').style.visibility = "hidden";


		}


		function update_status() {
			var id = $('#client_id').val();
			var remarks = $('#remarks').val();
			if (remarks == '') {
				alert("Enter Remarks");
			} else {
				var data = $('form').serialize();
				$.ajax({
					type: 'GET',
					data: data + "&" + "id=" + id,

					url: 'qvision/CRM/accounts_rejected.php?id=' + id + '&remark=' + remarks,
					success: function(data) {
						console.warn("jhgffg:" + data);
						if (data == 1) {
							alert('Not');
						} else {
							alert("Client Rejected Successfully");
							costsheet_add()
						}
					}
				});
			}

		}
	</script>