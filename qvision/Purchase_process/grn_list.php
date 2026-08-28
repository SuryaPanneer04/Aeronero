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
				<font size="4"><b>GRN List</b></font>
			</h2>
		</div>
		<div class="card-body">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<th>SL.No</th>
					<th>SO Number</th>
					<th>Cost Sheet No</th>
					<th>Vendor Name</th>
					<th> Status </th>
					<th><strong> Action</strong></th>
				</thead>
				<tbody>
					<?php
					$emp_sql = $con->query("SELECT * from purchase_vendor_master   order by id desc"); //where status='5'

					//echo "select a.*,b.* from purchase_vendor_master a left join grn_generate b on (a.id=b.purchase_id) where='2'";
					/* echo "SELECT p.*,d.vendor_name from purchase_vendor_master p left join doller_vendor_mastor d on p.vendor_id=d.id where p.status='2' order by p.id desc"; */
					$cnt = 1;
					while ($data = $emp_sql->fetch()) {
						
						$p_id = $data['id'];
					?>
						<tr>
							<td><?php echo $cnt; ?>.</td>
							<td><?php echo $data['so_number']; ?></td>
							<td><?php echo $data['cost_sheet_no']; ?></td>
							<td><?php $data['vendor_id'];
								$vendor_name = $con->query("select id,vendor_name from doller_vendor_mastor where id='$data[vendor_id]'");
								while ($ven_name = $vendor_name->fetch()) {
									echo $ven_name['vendor_name'];
								} ?>
							</td>
							<td>

								<?php
								$grn_cnt = $con->query("SELECT req_qty,rec_qty FROM `grn_generate` where purchase_id = '$data[id]' ");
								$grnCnt =  $grn_cnt->rowCount();
								if($grnCnt != 0){
								$grn_view = $con->query("SELECT req_qty,rec_qty FROM `grn_generate` where purchase_id = '$data[id]' ");
								$grnGen = $grn_view->fetch();
								$req_qty = $grnGen['req_qty'];
								$rec_qty = $grnGen['rec_qty'];
								$total_req = $req_qty - $rec_qty;
								if ($total_req != 0) {
									echo "<span style='color: blue;font-weight: bold;'> Generate GRN</span>";
								} else {
									echo "<span style='color: green;font-weight: bold;'> Generated GRN Successfully </span>";
								} 
							} else{ 
								echo "<span style='color: blue;font-weight: bold;'> Generate GRN</span>";
							}?>

							</td>
							<td>

								<?php
									if($grnCnt != 0){
								$grn_view = $con->query("SELECT req_qty,rec_qty FROM `grn_generate` where purchase_id = '$data[id]' ");
								$grnGen = $grn_view->fetch();
								$req_qty = $grnGen['req_qty'];
								$rec_qty = $grnGen['rec_qty'];
								$total_req = $req_qty - $rec_qty;
								if ($total_req != 0) {
								?>
									<button class="btn btn-info" name="generate_grn" id="generate_grn" data-id="<?php echo $p_id; ?>" onclick="generate_grn(<?php echo $p_id; ?>)"> Generate GRN
									</button>
								<?php } else { ?>

									<?php
									// $grn_view = $con->query("SELECT 1 FROM `grn_entry`");
									// 		$grn = $grn_view->rowCount();
									// 		if ($grn > 0) {
									?>
									<button class="btn btn-info" name="grn_view" onclick="grn_view(<?php echo $data['id']; ?>)"> <i class="fa fa-eye"> </i> </button>

								<?php }  } else{ ?>
									<button class="btn btn-info" name="generate_grn" id="generate_grn" data-id="<?php echo $p_id; ?>" onclick="generate_grn(<?php echo $p_id; ?>)"> Generate GRN
									</button>
							<?php 	} ?>

							</td>
						<?php
						$cnt = $cnt + 1;
					}
						?>
						
						</tr>
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


		function generate_grn(v) {
  $.ajax({
    type: "POST",
    url: "qvision/Purchase_process/generate_grn.php?id=" + v,
    success: function(data) {
      $("#main_content").html(data);
    },
    error: function(xhr) {
      alert("Error " + xhr.status + ": " + xhr.statusText);
    }
  });
}

function grn_view(v) {
  $.ajax({
    type: "POST",
    url: "qvision/Purchase_process/generate_grn.php?id=" + v,
    success: function(data) {
      $("#main_content").html(data);
    },
    error: function(xhr) {
      alert("Error " + xhr.status + ": " + xhr.statusText);
    }
  });
}

	</script>
</body>

</html>