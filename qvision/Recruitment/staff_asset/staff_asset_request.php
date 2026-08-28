<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];
$created_by = $_SESSION['candidateid']; 
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'list';

if ($action == 'insert') {
    $staff_id = $_POST['staff_id'];
    
    $assets_needed = $_POST['assets_needed'];
    
    $cand_sql = $con->query("SELECT candid_id FROM staff_master WHERE id='$staff_id'");
    $cand_res = $cand_sql->fetch();
    $candid_id = $cand_res['candid_id'];
    
    $ins_sql = "INSERT INTO staff_access_request (candid_id, staff_id, asset_master_id, cug_status, status, created_by) VALUES ('$candid_id', '$staff_id', '$assets_needed', 'No', 1, '$created_by')";
    $con->query($ins_sql);
    $assets_request_id = $con->lastInsertId();

    echo "success";
    exit; 
}
?>
<style>
.card-body { max-width: 131% !important; }
</style>
<head>
  <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<?php
if ($action == 'add') {
?>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><font size="5">Create New Asset Request</font></h3>
            <a onclick="staff_asset_req_list()" style="float: right; cursor: pointer;" class="btn btn-danger btn-sm">Back</a>
        </div>
        <div class="row content">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="card-body">
                        <form role="form" id="new_req_form" onsubmit="submit_request(event)">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td style="width: 30%; font-weight: bold;">Select Employee:</td>
                                    <td>
                                        <select class="form-control" name="staff_id" required>
                                            <option value="">-- Select Employee --</option>
                                            <?php
                                            $st_sql = $con->query("SELECT * FROM staff_master WHERE emp_name IS NOT NULL AND TRIM(emp_name) != '' ORDER BY emp_name ASC");
                                            while($st = $st_sql->fetch()){
                                                echo "<option value='".$st['id']."'>".$st['emp_name']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Select Assets Needed:</td>
                                    <td>
                                         <select class="form-control" name="assets_needed" required>
                                            <option value="">-- Select Assets --</option>
                                            <?php
                                           $ast_sql = $con->query("SELECT DISTINCT m.id, m.name FROM assets_master m JOIN assets_form_detail a ON m.prefix_code = a.prefix WHERE m.name IS NOT NULL AND TRIM(m.name) != '' AND a.status = 1 ORDER BY m.name ASC");
                                           while($ast = $ast_sql->fetch()){
                                                echo "<option value='".$ast['id']."'>".$ast['name']."</option>";
                                            }
                                            ?>
                                        </select>
                                    
                                      </td>
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-primary" style="float:right;">Submit Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
} elseif ($action == 'view') {
    $id = $_REQUEST['id'];
    $view_sql = $con->query("SELECT sm.emp_name, a.asset_master_id, a.status FROM staff_access_request a JOIN staff_master sm ON a.staff_id=sm.id WHERE a.id='$id'");
    $res = $view_sql->fetch(PDO::FETCH_ASSOC);
?>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><font size="5">View Asset Request Details</font></h3>
            <a onclick="staff_asset_req_list()" style="float: right; cursor:pointer;" class="btn btn-danger btn-sm">Back</a>
        </div>
        <div class="row content">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th style="width: 30%;">Employee Name</th>
                                <td><?php echo $res['emp_name']; ?></td>
                            </tr>
                            <tr>
    <th>Requested Assets</th>
    <td>
        <?php 
       
        $aids = $res['asset_master_id'];
        if(!empty($aids)){
            $ass_sql = $con->query("SELECT name FROM assets_master WHERE id IN ($aids)");
            $asset_names = [];
            while ($afet = $ass_sql->fetch()) {
                $asset_names[] = $afet['name'];
            }
            echo implode(", ", $asset_names);
        } else {
            echo "-";
        }
        ?>
    </td>
</tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
} else {
?>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title"><font size="5">Staff Asset Request List</font></h3>
        <a onclick="add_staff_asset_request()" style="float: right; cursor: pointer;" class="btn btn-primary">ADD REQUEST</a>
      </div>

      <div class="row content">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="card-body">
              <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
                <thead>
                  <th>ID</th>
                  <th>Employee Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php
                  $emp_sql = $con->query("SELECT sm.emp_name, a.id AS sid, a.status FROM staff_access_request a JOIN staff_master sm ON a.staff_id=sm.id WHERE a.status = 1");
                  $i = 1;
                  while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $emp_res['emp_name']; ?></td>
                      <td><?php if ($emp_res['status'] == 1) { echo "Pending"; } ?></td>
                      <td>
                        <button class="btn btn-info btn-sm edit btn-flat" onclick="view_request(<?php echo $emp_res['sid']; ?>)">View</button>
                      </td>
                    </tr>
                  <?php $i++; } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
} 
?>

<script>
  $(document).ready(function() {
    if ($.fn.DataTable.isDataTable('#example1')) {
        $('#example1').DataTable().destroy();
    }
    $('#example1').DataTable({ responsive: true });
  });

  function staff_asset_req_list() {
    $.ajax({
      type: "POST",
      url: "qvision/Recruitment/staff_asset/staff_asset_request.php", 
      success: function(data) {
        $("#main_content").html(data);
      }
    });
  }

  function add_staff_asset_request() {
    $.ajax({
      type: "POST",
      url: "qvision/Recruitment/staff_asset/staff_asset_request.php?action=add",
      success: function(data) {
        $("#main_content").html(data);
      }
    });
  }

  function view_request(v) {
    $.ajax({
      type: "POST",
      url: "qvision/Recruitment/staff_asset/staff_asset_request.php?action=view&id=" + v,
      success: function(data) {
        $("#main_content").html(data);
      }
    });
  }

  function submit_request(e) {
    e.preventDefault();
    var formData = $('#new_req_form').serialize();
    
    $.ajax({
        type: "POST",
        url: "qvision/Recruitment/staff_asset/staff_asset_request.php?action=insert",
        data: formData,
        success: function(response) {
           
            alert("Asset Request Submitted Successfully!");
            staff_asset_req_list(); 
        },
        error: function() {
            alert("Error in saving data!");
        }
    });
  }
</script>