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
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">
      <font size="5">Staff Asset List</font>
    </h3>
  </div>

  <div class="row content">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <!--     Staff Asset   -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
            <thead>
              <th>ID</th>
              <th>Employee Name</th>
              <th>Assets</th>
              <th>Submited</th>
              <th>Status</th>
              <th>Action</th>
              <!--th>Tools</th-->
            </thead>
            <tbody>
              <?php
              if ($staff_id == '') {
                $emp_sql = $con->query("SELECT a.staff_id as staff_id,sm.emp_name,a.asset_master_id,a.id as sid,a.status as status FROM staff_access_request a join staff_master sm on a.staff_id=sm.id where a.status!=1 group by a.staff_id");
              } else {
                $emp_sql = $con->query("SELECT a.staff_id as staff_id,sm.emp_name,a.asset_master_id,a.id as sid,a.status as status FROM staff_access_request a join staff_master sm on a.staff_id=sm.id where a.status!=1 and a.staff_id='$staff_id' group by a.staff_id");
              }

              //echo "SELECT sm.emp_name,a.asset_master_id,a.id as sid,a.status as status FROM staff_access_request a join staff_master sm on a.staff_id=sm.id where a.status!=1 and a.staff_id='$staff_id'";
              //echo "SELECT sm.emp_name,s.stationaries,s.system_or_laptop,s.id_card,s.cug,s.access_card,s.erp_access,s.mail_id,s.id AS sid FROM staff_asset s join staff_master sm on s.emp_name=sm.id";
              $i = 1;
              while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
                $staffid = $emp_res['staff_id'];
              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $emp_res['emp_name']; ?></td>
                  <td><?php
                      $aids = $emp_res['asset_master_id'];
                      $ass = $con->query("select * from assets_master where name in('$aids')");
                      while ($afet = $ass->fetch()) {
                        $dat = $afet['name'];
                        echo $dat . ",";
                      }
                      ?>
                  </td>
                  <td>
                    <?php $disasset = $con->query("select * from assets_master where id in(SELECT asset_name FROM `staff_asset_list` s join assets_form_detail a on s.asset_id=a.id join assets_master m on a.asset_name=m.name where s.status=2 and s.staff_id='$staffid')");
                    while ($asdes = $disasset->fetch()) {
                      $aname = $asdes['name'];
                      echo $aname . ",";
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    if ($emp_res['status'] == 2) {
                      echo "Pending";
                    }
                    ?>
                  </td>
                  <td>
                    <?php

                    if ($emp_res['status'] == 4) {
                    ?>
                      <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['sid']; ?>" onclick="staff_asset_recollect(<?php echo $emp_res['sid']; ?>)"><i class="fa fa-edit"></i> Collect</button>
                  </td>
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
  </div><!-- /.container-fluid -->

  <!-- /.content -->
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

  function staff_asset_recollect(v) {
    $.ajax({
      type: "POST",
      url: "qvision/Recruitment/staff_asset/recollect_assets_page.php?id=" + v,
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }
</script>