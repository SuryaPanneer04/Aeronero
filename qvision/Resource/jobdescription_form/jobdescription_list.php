<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];
$candidid = $_SESSION['candidateid'];
?>
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<font size="5">JOB DESCRIPTION</font>
		</h3>
		<a onclick="new_jd()" style="float: right;" data-toggle="modal" class="btn btn-danger"> <i class="fa fa-plus"></i>Add</a>
	</div> <br>

	<!-- <div class="row content"> -->
		<div class="col-lg-12">
			<div class="panel panel-default">

				<div class="card-body">
					<table class="dataTables-example table table-bordered" id="example1">
						<thead>
							<tr>
								<th>ID</th>
								<th>Job Title</th>
								<th>Location</th>
								<!-- <th>Initiate Date</th>
								<th>Date to be closed</th>
								<th style="width:100px;">No Of Position</th> -->
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php

						
							if ($userrole == 'R003' && $candidid == 5) {
								// $userrole."**".$candidid;
								$emp_sql = $con->query("SELECT *,j.status as status,j.id as jid FROM `jobdescription_form_details` j left join jobdescription_master m on j.jobdescription_id=m.id where  j.status=5 order by j.id desc");
							} else {
							// 		print_r($candidid);
							// die();
								//ho $userrole."else".$candidid;
$emp_sql = $con->query("SELECT *,j.status as status,j.id as jid FROM `jobdescription_form_details` j left join jobdescription_master m on j.jobdescription_id=m.id where m.status=1 and j.jdcode  IS NULL order by j.id desc");								//where j.created_by='1'	
							}

							$i = 1;
							while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
								$emp_id = $emp_res['id'];
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $emp_res['tittle']; ?></td>
									<td><?php echo $emp_res['location']; ?></td>
									<!-- <td><?php echo $emp_res['joining_date']; ?></td>
									<td><?php echo $emp_res['closed_date']; ?></td>
									<td><?php echo $emp_res['no_of_position']; ?></td> -->
									<td> <?php
											if ($emp_res['status'] == 0) {
												echo '<span style="color:red; font-weight:bold;"> Pending</span>';
											} elseif ($emp_res['status'] == 3) {
												echo '<span style="color:orange; font-weight:bold;"> JD Closed </span>';
											} elseif ($emp_res['status'] == 4) {
												echo '<span style="color:blue; font-weight:bold;"> JD Rejected </span>';
											} elseif ($emp_res['status'] == 5) {
												echo '<span style="color:green; font-weight:bold;"> Approved </span>';
											} elseif ($emp_res['status'] == 6) {
												echo '<span style="color:red; font-weight:bold;"> Pending</span>';
											}

											?> </td>
									<td>
										<button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['jid']; ?>" onclick="jd_view(<?php echo $emp_res['jid']; ?>)"> View</button>
										<?php if ($emp_res['status'] == 4) {
										?>
											<button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['jid']; ?>" onclick="jd_edit(<?php echo $emp_res['jid']; ?>)"> <i class="fa fa-mail">Edit</i></button>
										<?php
										}
										if ($userrole != 'R003' && $candidid != 53) {
										?>
										<button class="btn btn-danger btn-sm" data-id="<?php echo $emp_res['jid']; ?>" onclick="jd_close(<?php echo $emp_res['jid']; ?>)"> Close </button>
										<?php } ?>
									</td>
								</tr>
							<?php
								$i++;
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
			//responsive: true
			        "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
		});
	});

	function new_jd() {
		$.ajax({
			type: "POST",
			url: "qvision/Resource/jobdescription_form/jobdescription_form.php",
			success: function(data) {
				$("#main_content").html(data);
			}
		})
	}

	function jd_view(v) {
		$.ajax({
			type: "POST",
			url: "qvision/Resource/jobdescription_form/jd_view.php?jid=" + v,
			success: function(data) {
				$("#main_content").html(data);
			}
		})
	}


	function jd_edit(v) {
		$.ajax({
			type: "POST",
			url: "qvision/Resource/jobdescription_form/jd_edit.php?jid=" + v,
			success: function(data) {
				$("#main_content").html(data);
			}
		})
	}

	function jd_close(v) {
		$.ajax({
			type: "POST",
			url: "qvision/Resource/jobdescription_form/jd_close.php?jid=" + v,
			success: function(data) {
				$("#main_content").html(data);
			}
		})
	}
</script>