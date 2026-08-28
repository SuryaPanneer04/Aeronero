<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];
?>
<style>
.card-body {
    max-width: 100% !important;
    overflow-x: scroll !important;
    /* overflow-y: scroll !important; */
}

<style>
.card-body {
    /* min-width: 989px; */
    max-width: 131% !important;
}
</style>
<head>
  <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">
      <font size="5"> Staff Asset List </font>
    </h3>
    <a onclick=" add_staff_asset()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i> ADD</a>
  </div>

  <div class="row content">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <!--    Staff Asset  -->
        </div>
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <div class="card-body">
          <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
            <thead>
              <th>ID</th>
              <th>Employee Name</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php
              $emp_sql = $con->query("SELECT sm.emp_name,a.asset_name,a.serial_number,s.id AS sid FROM staff_asset s join staff_master sm on s.emp_name=sm.id left join staff_asset_serial_no a on s.id = a.staff_asset_id group by s.emp_name ");

              //echo "SELECT sm.emp_name,s.stationaries,s.system_or_laptop,s.id_card,s.cug,s.access_card,s.erp_access,s.mail_id,s.id AS sid FROM staff_asset s join staff_master sm on s.emp_name=sm.id";
              $i = 1;
              while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $emp_res['emp_name']; ?></td>
                  <td>
                    <button class="btn btn-success btn-sm edit btn-flat" onclick="staff_asset_edit(<?php echo $emp_res['sid']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
  </div><!-- /.container-fluid -->

  <!-- /.content -->
</div>

<script>
  $(document).ready(function() {
    $('.dataTables-example').DataTable({
      responsive: true
    });
  });

  function add_staff_asset() {
    $.ajax({
      type: "POST",
      url: "qvision/Recruitment/staff_asset/new_staff_asset.php",
      success: function(data) {
        $("#leave_view").html(data);
      }
    })
  }

  function staff_asset_edit(v) {
    $.ajax({
      type: "POST",
      url: "qvision/Recruitment/staff_asset/edit_staff_asset.php?id=" + v,
      success: function(data) {
        $("#leave_view").html(data);
      }
    })
  }
</script>