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
			<font size="5">Company E-mail Generation </font>
		</h3>
		<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"></i>BACK</a>
	</div>

	<form method="POST" name="fupname" enctype="multipart/form-data">
		<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
		<table class="table table-bordered">

			<tr>
				<!-- To create Official mail id for this new joinee employee /// Value is candidate id-->
				<td>Employee Name:</td>
				<td colspan="2">
					<select class="form-control" name="emp_name" >
						<option value="0">-- Select Employee Name --</option>
						<?php
$dep_sql = $con->query("SELECT * FROM staff_master");
while ($dep_sql_res = $dep_sql->fetch(PDO::FETCH_ASSOC)) {
    // Name empty ah illana mattum than kela option show aagum:
    if (!empty(trim($dep_sql_res['emp_name']))) {
?>
	<option value="<?php echo $dep_sql_res['candid_id']; ?>"><?php echo trim($dep_sql_res['emp_name']); ?></option>
<?php
    }
}
?>
					</select>
				</td>
			</tr>

			<tr>
				<!-- IT Department Employee assigning to create mail id /// Value is candidate id-->
				<td>IT Person</td>
				<td colspan="2"><select class="form-control" name="it_person">
						<option value="0">-- Select Person --</option>
						<?php
$it_dept = $con->query("SELECT * FROM staff_master");
while ($it_person = $it_dept->fetch(PDO::FETCH_ASSOC)) {
    // Name empty ah illana mattum than IT person list la varum:
    if (!empty(trim($it_person['emp_name']))) {
?>
	<option value="<?php echo $it_person['candid_id']; ?>"><?php echo trim($it_person['emp_name']); ?></option>
<?php
    }
}
?>
					</select></td>
			</tr>

			<tr>
				<!-- Mail Content to the IT department Employee -->
				<td>Content</td>
				<td colspan="2">
					<textarea class="form-control" name="mail_content"> </textarea>
				</td>
			</tr>

			<tr>
				<!-- Mail with CC to the IT department Employee -->
				<td>Mail CC</td>
				<td colspan="2">
					<input type="email" class="form-control" name="mail_cc"> 
				</td>
			</tr>

		</table>
		<input type="button" value="Send Mail" class="btn btn-primary btn-md" style="float:right;" onclick="send_mail_to_IT()">
	</form>

	<script>
		function back() {
			mail_generation()
		}

		function send_mail_to_IT() {
    if ($('select[name="emp_name"]').val() == "0" || $('select[name="it_person"]').val() == "0") {
        alert("Please select both Employee Name and IT Person!");
        return false; 
    }

    var formData = $('form').serialize();
    $.ajax({
        method: "POST",
        data: formData,
        url: 'qvision/Recruitment/staff_asset/mail_generation/mail_send_content.php',
        success: function(data) {
            if (data.includes("Message has been sent.") || data.includes("1")) {
                alert("Mail Send Successfully.");
                mail_generation();
            } else {
                alert("Mail sending failed! Please check mail configurations.");
            }
        }
    })
}
	</script>