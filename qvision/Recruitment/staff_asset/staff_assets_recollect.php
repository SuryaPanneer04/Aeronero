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
            </thead>
            <tbody>
              <?php
              if ($userrole == 'R003' || $candidateid == '42') {
                $emp_sql = $con->query("SELECT a.staff_id as staff_id,sm.emp_name,a.asset_master_id,a.id as sid,a.status as status FROM staff_access_request a join staff_master sm on a.staff_id=sm.id where a.status!=1 ORDER BY a.id DESC");
              } else {
                $emp_sql = $con->query("SELECT a.staff_id as staff_id,sm.emp_name,a.asset_master_id,a.id as sid,a.status as status FROM staff_access_request a join staff_master sm on a.staff_id=sm.id where a.status!=1 ORDER BY a.id DESC");
              }

              $i = 1;
              while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
                $staffid = $emp_res['staff_id'];
              ?>
                <tr>
                  <!-- 1. ID -->
                  <td><?php echo $i; ?></td>
                  
                  <!-- 2. Employee Name -->
                  <td><?php echo $emp_res['emp_name']; ?></td>
                  
                  <!-- 3. Assets -->
                  <td>
                    <?php
                      $aids = trim($emp_res['asset_master_id']);
                      $aids = rtrim($aids, ',');
                      if(!empty($aids)){
                          $ass = $con->query("SELECT name FROM assets_master WHERE id IN ($aids)");
                          $asset_names = [];
                          if($ass){
                              while ($afet = $ass->fetch()) {
                                  $asset_names[] = $afet['name'];
                              }
                              echo implode(", ", $asset_names);
                          }
                      } else {
                          echo "-";
                      }
                    ?>
                  </td>
                  
                  <!-- 4. Submited -->
                  <td>
                    <?php 
                    $disasset = $con->query("SELECT DISTINCT m.name 
                                             FROM staff_asset_list s 
                                             LEFT JOIN assets_master m ON (s.asset_id = m.id OR s.asset_id = m.name) 
                                             WHERE (s.status=2 OR s.status=3) AND s.asset_request_id='".$emp_res['sid']."' AND s.staff_id='$staffid'");
                    $sub_names = [];
                    if($disasset){
                        while ($asdes = $disasset->fetch()) {
                            if(!empty($asdes['name'])) {
                                $sub_names[] = $asdes['name'];
                            }
                        }
                        echo !empty($sub_names) ? implode(", ", $sub_names) : "-";
                    }
                    ?>
                  </td>
                  
                  <!-- 5. Status -->
                  <td>
                    <?php
                    $check_col = $con->query("SELECT id FROM staff_asset_list WHERE asset_request_id='".$emp_res['sid']."' AND status=3");
                    $is_collected = ($check_col && $check_col->rowCount() > 0);
                    
                    if ($is_collected || $emp_res['status'] == 6) {
                      echo "Collected"; 
                    } else if (!empty($sub_names)) { 
                      echo "Returned"; 
                    } else {
                      echo "Pending";
                    }
                    ?>
                  </td>
                  
                  <!-- 6. Action -->
                  <td>
                    <?php
                    // Collect aagala AND Submitted items iruntha mattum thaan Collect button varum!
                    if (!$is_collected && $emp_res['status'] != 6) {
                        if (!empty($sub_names)) { 
                        ?>
                          <button class="btn btn-warning btn-sm edit btn-flat" style="background-color: #f0ad4e; border-color: #eea236; color: white;" data-id="<?php echo $emp_res['sid']; ?>" onclick="staff_asset_recollect(<?php echo $emp_res['sid']; ?>)"><i class="fa fa-edit"></i> Collect</button>
                        <?php
                        }
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