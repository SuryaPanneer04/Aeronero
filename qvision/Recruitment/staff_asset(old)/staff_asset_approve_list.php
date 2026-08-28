<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];
$candidateid = $_SESSION['candidateid'];

$staff = $con->query("select * from staff_master where candid_id='$candidateid'");
$sfet = $staff->fetch();
$staff_id = $sfet['id'];
?>

<head>
  <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<style>
  /* #page-wrapper{
	margin-left: 117px !important;
}
.btn-warning{
	padding-top: 0px !important;
}

.btn-warning{
	background-color: #337ab7 !important;
    border-color: #337ab7 !important;
}
.btn-success{
	background-color: #5cb85c !important;
    border-color: #5cb85c !important;
}
.page-header{
	border-bottom: 3px solid #eee !important;
} */
</style>
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">
      <font size="5"> Staff Asset List </font>
    </h3>

  </div>

  <div class="row content">
    <div class="col-lg-12">
      <div class="panel panel-default">


        <!-- Content Header (Page header) -->

        <!-- /.card-header -->
        <div class="card-body">
          <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
            <thead>
              <th>ID</th>
              <th>Employee Name</th>
              <th>Access</th>
              <th>Status</th>
              <th>Action</th>
              <!--th>Tools</th-->
            </thead>
            <tbody>
              <?php
              // ✅ Only Status 3 (Waiting for MD) and Status 4 (Approved by MD) records ah list pandrom
              $emp_sql = $con->query("SELECT sm.emp_name, a.asset_master_id, a.id as sid, a.status as status FROM staff_access_request a JOIN staff_master sm ON a.staff_id=sm.id WHERE a.status IN (3, 4) ORDER BY a.id DESC");

              $i = 1;
              while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo htmlspecialchars($emp_res['emp_name']); ?></td>
                  <td>
                    <?php
                      $aids = trim($emp_res['asset_master_id']);
                      $aids = rtrim($aids, ',');
                      if(!empty($aids)){
                          $ass = $con->query("SELECT name FROM assets_master WHERE id IN ($aids)");
                          $asset_names = [];
                          if($ass){
                              while ($afet = $ass->fetch(PDO::FETCH_ASSOC)) {
                                  $asset_names[] = $afet['name'];
                              }
                              echo implode(", ", $asset_names);
                          }
                      } else {
                          echo "-";
                      }
                    ?>
                  </td>
                  <td>
                    <?php
                    if ($emp_res['status'] == 3) {
                      echo "<span style='color:orange; font-weight:bold;'>Accepted (Pending Approval)</span>";
                    } elseif ($emp_res['status'] == 4) {
                      echo "<span style='color:green; font-weight:bold;'>Approved</span>";
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    if ($emp_res['status'] == 3) {
                    ?>
                      <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['sid']; ?>" onclick="staff_asset_approve_page(<?php echo $emp_res['sid']; ?>)"><i class="fa fa-edit"></i> Approve</button>
                    <?php
                    } elseif ($emp_res['status'] == 4) {
                    ?>
                      <button class="btn btn-info btn-sm edit btn-flat" style="background-color: #5bc0de; border-color: #46b8da; color:white;" data-id="<?php echo $emp_res['sid']; ?>" onclick="staff_asset_view(<?php echo $emp_res['sid']; ?>)"><i class="fa fa-eye"></i> View</button>
                    <?php
                    }
                    ?>
                  </td>
                </tr>
              <?php
                $i++;
              }
              ?>
            </tbody>
          </table>

        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.dataTables-example').DataTable({
      responsive: true
    });
  });
</script>
<script>
  function staff_asset_view(v) {
    $.ajax({
      type: "POST",
      url: "qvision/Recruitment/staff_asset/staff_asset_view.php?id=" + v,
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }

  function staff_asset_approve_page(v) {
    $.ajax({
      type: "POST",
      url: "qvision/Recruitment/staff_asset/staff_asset_approve.php?id=" + v,
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }
</script>