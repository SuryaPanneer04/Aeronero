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
      <font size="5"> Staff Asset List </font>
    </h3>
  </div>

  <div class="row content">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="table-responsive">
            <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
              <thead>
                <th>ID</th>
                <th>Employee Name</th>
                <th>Access</th>
                <th>Status</th>
                <th>Action</th>
              </thead>
             <tbody>
               <?php
                // ✅ BUG FIXED: Removed hardcoded HR ID trap (R003/42) and used LEFT JOIN so Status 2 items will 100% show up!
                $emp_sql = $con->query("SELECT sm.emp_name, a.asset_master_id, a.id as sid, a.status as status FROM staff_access_request a LEFT JOIN staff_master sm ON (a.staff_id = sm.id OR a.candid_id = sm.candid_id) WHERE a.status = 2 ORDER BY a.id DESC");
                
                // SQL Error irukka nu check pandrom
                if($emp_sql === false) {
                    echo "<tr><td colspan='5' style='color:red;'><b>SQL Error:</b> Data fetch aagala, Database query check pannunga!</td></tr>";
                } else {
                    $i = 1;

                    while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            
                            <td>
                                <?php 
                                if($emp_res['emp_name'] != '') {
                                    echo $emp_res['emp_name']; 
                                } else {
                                    echo "<span style='color:red;'>Name Missing in DB</span>";
                                }
                                ?>
                            </td>
                        
                            <td>
                                <?php
                                $aids = $emp_res['asset_master_id'];
                                if(!empty($aids)){
                                    $ass = $con->query("SELECT * FROM assets_master WHERE id IN ($aids)");
                                    if($ass){
                                        while ($afet = $ass->fetch()) {
                                            echo $afet['name'];
                                        }
                                    }
                                }
                                ?>
                            </td>
                            
                            <td>
                                <?php
                                if ($emp_res['status'] == 1) { echo "Pending"; }
                                elseif ($emp_res['status'] == 2) { echo "Allocated"; }
                                elseif ($emp_res['status'] == 3) { echo "Accepted"; }
                                elseif ($emp_res['status'] == 4) { echo "Head Approved"; }
                                elseif ($emp_res['status'] == 5) { echo "Returned"; }
                                elseif ($emp_res['status'] == 6) { echo "Collected"; }
                                else { echo "<span style='color:orange;'>Unknown Status (" . $emp_res['status'] . ")</span>"; }
                                ?>
                            </td>
                            
                            <td>
                                <?php
                                if ($emp_res['status'] == 2) {
                                ?>
                                    <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['sid']; ?>" onclick="staff_asset_page(<?php echo $emp_res['sid']; ?>)"><i class="fa fa-edit"></i> Accept</button>
                                <?php
                                }
                                if ($emp_res['status'] == 3 || $emp_res['status'] == 4 || $emp_res['status'] == 5 || $emp_res['status'] == 6) {
                                ?>
                                    <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['sid']; ?>" onclick="staff_asset_view(<?php echo $emp_res['sid']; ?>)"><i class="fa fa-edit"></i> View</button>
                                <?php
                                }
                                if ($emp_res['status'] == 1) {
                                ?>
                                    <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['sid']; ?>" onclick="staff_asset_view(<?php echo $emp_res['sid']; ?>)"><i class="fa fa-edit"></i> View</button>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
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

  function staff_asset_page(v) {
    $.ajax({
      type: "POST",
      url: "qvision/Recruitment/staff_asset/staff_asset_accept.php?id=" + v,
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }
</script>