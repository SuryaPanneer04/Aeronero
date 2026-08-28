<?php
require '../../../connect.php';
$id = $_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM staff_access_request WHERE id='$id'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$sid = $row['staff_id'];
$access = $row['asset_master_id'];
$cug_status = $row['cug_status'];
$phone_no = isset($row['phone_no']) ? $row['phone_no'] : '';

$staff_mas = $con->query("SELECT * FROM staff_master WHERE id='$sid'");
$stafet = $staff_mas->fetch(PDO::FETCH_ASSOC);
$dep = isset($stafet['dep_id']) ? $stafet['dep_id'] : '';

$mail_id = '';
$mail_sql = $con->query("SELECT mail_id FROM staff_asset_list WHERE asset_request_id='$id' AND mail_id IS NOT NULL AND TRIM(mail_id) != '' ORDER BY id DESC LIMIT 1");
if($mail_sql && $mail_row = $mail_sql->fetch(PDO::FETCH_ASSOC)) {
    $mail_id = trim($mail_row['mail_id']);
}

if(empty($mail_id) && isset($stafet['mail_id']) && !empty(trim($stafet['mail_id']))) {
    $mail_id = trim($stafet['mail_id']);
}

if(empty($mail_id) && isset($row['mail_id']) && !empty(trim($row['mail_id']))) {
    $mail_id = trim($row['mail_id']);
}
?>

<head>
	<link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
	<div class="card-header">
		<i class="fa fa-table"></i> Allocated Assets
		<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
	</div>
	<div class="card-body" id="printableArea">
		<form id="fupname" role="form" name="fupname" action="" method="post" enctype="multipart/form-data">
			<table class="table table-bordered">
				<tr>
					<td>Employee Name:</td>
					<td colspan="2">
						<input type="hidden" name="sid" id="sid" value="<?php echo $sid; ?>">
						<input type="hidden" name="reqid" id="reqid" value="<?php echo $id; ?>">
						<?php
						$dep_sql1 = $con->query("SELECT * FROM staff_master where id='$sid' ");
						$fet = $dep_sql1->fetch();
						?>
						<input type="text" name="emp_name" id="emp_name" class="form-control" value="<?php echo $fet['emp_name']; ?>" readonly>
					</td>
				</tr>


				<?php
                if(!empty($access)) {
				    $isel = $con->query("SELECT distinct m.id as id, m.name as name, a.Serial_no as Serial_no FROM assets_form_detail a JOIN assets_master m ON a.asset_name=m.id WHERE a.asset='Internal Asset' AND m.id IN ($access) AND a.id IN (SELECT asset_id FROM staff_asset_list WHERE staff_id='$sid')");

                    if($isel) {
				        while ($dfet = $isel->fetch(PDO::FETCH_ASSOC)) {
				?>
							<tr>
								<td><?php echo $dfet['name']; ?></td>
								<td><?php echo $dfet['Serial_no']; ?></td>
							</tr>
				<?php
					    }
                    }
                }
				?>

<?php
if ($cug_status == 'Yes') {
?>
	<tr>

		<td>CUG:</td>
		<td>
			<input type="hidden" name="cug_sta" id="cug_sta" value="<?php echo $cug_status; ?>">
			<input type="text" class="form-control" name="cug" id="cug" value="<?php echo $row['phone_no']; ?>" readonly>

		</td>
	</tr>
<?php
}
?>
<tr>
	<td>Mail Id</td>
	<td><input type="text" name="mail_id" id="mail_id" class="form-control" value="<?php echo $mail_id; ?>" readonly></td>
</tr>
</table>


<!--table class="table table-bordered">
<tr>
<td>Status:</td>
<td>
 
<select name="status" id="status" class="form-control">
<option value="1">Active</option>
<option value="2">In-Active</option>
</select>

</td>
</tr>
</table-->
<input type="submit" name="submit" class="btn btn-primary btn-md" value="I Accept" style="float:right;">
</form>
</div>
</div>
<script>
	function back() {
		staff_asset_accept();
	}

	$(document).ready(function() {
		$(document).off("submit", "#fupname").on("submit", "#fupname", function(ev) {
			ev.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: 'qvision/Recruitment/staff_asset/staff_asset_accept_submit.php',
				method: "POST",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data) {
					alert("Asset Accepted Successfully!");
					staff_asset_accept(); 
				}
			});
		});
	});
</script>