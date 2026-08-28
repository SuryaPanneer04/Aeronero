<?php
require '../../../connect.php';

$payroll_master = $con->query("SELECT * FROM payroll_master WHERE flag=2 ORDER BY id ASC LIMIT 1");
$res = $payroll_master->fetch();

if(!$res){
    echo "<h3 style='color:red;'>No payroll generated to close</h3>";
    exit;
}

$year = $res['year'];
$id = $res['id'];


if ($res['month'] == "1") {
	$month = "January";
} elseif ($res['month'] == "2") {
	$month = "February";
} elseif ($res['month'] == "3") {
	$month = "March";
} elseif ($res['month'] == "4") {
	$month = "April";
} elseif ($res['month'] == "5") {
	$month = "May";
} elseif ($res['month'] == "6") {
	$month = "June";
} elseif ($res['month'] == "7") {
	$month = "July";
} elseif ($res['month'] == "8") {
	$month = "August";
} elseif ($res['month'] == "9") {
	$month = "September";
} elseif ($res['month'] == "10") {
	$month = "October";
} elseif ($res['month'] == "11") {
	$month = "November";
} elseif ($res['month'] == "12") {
	$month = "December";
} else {
	$month = "-";
}
?>
<div class="content-wrapper" id='wage_content' style="padding-left: 50px; position: relative; top: 45px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<?php if ($year != '') { ?>
					<div class="col-sm-6">
						<h2>Payroll Close For The Month Of <?php echo $month; ?> - <?php echo $year; ?></h2>
					</div>
					<div class="col-sm-6">
						<input class="btn btn-primary btn-sm btn-flat" style="float: center;" type="button" name="payroll_close" id="payroll_close" onclick="payroll_close_page(<?php echo $id; ?>)" value="Payroll Close">
					<?php } else { ?>
						<div class="col-sm-6">
							<h2>Payroll Not Generated</h2>
						</div>

					<?php } ?>
					<!--<a onclick="return add_employee()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Payroll Generate</a>-->
					</div>

			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->

	<!-- /.content -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function payroll_close_page(v) {

    $.ajax({
        type: 'GET',
        url: 'qvision/payroll/payroll_process/payroll_close_update.php',
        data: { payroll_master_id: v },

        success: function(data) {

            if (data == 0) {
                alert("✅ Payroll Closed Successfully");
                location.reload();
            } else {
                alert("❌ Payroll Not Closed");
            }
        },

        error: function(xhr) {
            alert("AJAX ERROR: " + xhr.status);
        }
    });

}
</script>