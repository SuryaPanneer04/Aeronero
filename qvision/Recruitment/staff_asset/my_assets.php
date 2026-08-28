<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];

$candidateid = $_SESSION['candidateid'];
$staff = $con->query("SELECT * FROM staff_master WHERE candid_id='$candidateid'");
$sfet = $staff->fetch();
$staff_id = $sfet['id'];
?>

<head>
  <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<style>
.card-body {
    max-width: 100% !important;
    overflow-x: scroll !important;
}
</style>

<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">
      <font size="5">My Assets & Lifecycle Dashboard</font>
    </h3>
  </div>

  <div class="row content">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="card-body">
          <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
            <thead>
              <th>ID</th>
              <th>Employee Name</th>
              <th>Access</th>
              <th>Date</th>
              <th>Return Date</th>
              <th>Status</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php
              // Fetching both created_on and modified_on for smart date tracking
              $emp_sql = $con->query("SELECT sm.emp_name, a.asset_master_id, a.id as sid, a.status as status, a.created_on, a.modified_on FROM staff_access_request a JOIN staff_master sm ON a.staff_id=sm.id WHERE (a.staff_id = '$staff_id' OR a.candid_id = '$candidateid') ORDER BY a.id DESC");
              
              $i = 1;
              while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  
                  <td><?php echo $emp_res['emp_name']; ?></td>
                  
                  <td>
                    <?php
                    $aids = trim($emp_res['asset_master_id']);
                    $aids = rtrim($aids, ','); 
                    
                    if(!empty($aids)){
                        $ass = $con->query("SELECT name FROM assets_master WHERE id IN ($aids)");
                        $asset_names = [];
                        
                        if($ass){
                            while($afet = $ass->fetch()) {
                                $asset_names[] = $afet['name'];
                            }
                            echo implode(", ", $asset_names);
                        }
                    } else {
                        echo "-";
                    }
                    ?>
                  </td>

                  <!-- 1. Allocated / Given Date -->
                  <td>
                    <?php 
                    if(isset($emp_res['created_on']) && !empty($emp_res['created_on']) && $emp_res['created_on'] != '0000-00-00 00:00:00') {
                        echo date('d-m-Y', strtotime($emp_res['created_on']));
                    } else {
                        echo date('d-m-Y'); 
                    }
                    ?>
                  </td>

                  <!-- 2. Return Date Column -->
                  <td>
                    <?php 
                    $st = $emp_res['status'];
                    if ($st == 5 || $st == 6 || $st == 'Returned' || $st == 'Collected') {
                        if(isset($emp_res['modified_on']) && !empty($emp_res['modified_on']) && $emp_res['modified_on'] != '0000-00-00 00:00:00') {
                            echo date('d-m-Y', strtotime($emp_res['modified_on']));
                        } else {
                            echo date('d-m-Y'); 
                        }
                    } else {
                        echo "-";
                    }
                    ?>
                  </td>
                  
                  <!-- Status Column -->
                  <td>
                    <?php
                    if ($st == 1) {
                      echo "Pending";
                    } elseif ($st == 2) {
                      echo "Allocated";
                    } elseif ($st == 3) {
                      echo "Accepted";
                    } elseif ($st == 4) {
                      echo "Head Approved";
                    } elseif ($st == 5 || $st == 'Returned') {
                      echo "Returned";
                    } elseif ($st == 6 || $st == 'Collected') {
                      echo "Collected";
                    } else {
                      echo $st;
                    }
                    ?>
                  </td>
                  
                  <!-- Action Column with Exact Orange Button matching Image 2 -->
                  <td>
                    <?php if ($st >= 1) { ?>
                      <button class="btn btn-sm edit btn-flat" style="background-color: #ea5c0b !important; border-color: #ea5c0b !important; color: #ffffff !important; font-weight: 500; padding: 4px 12px; border-radius: 3px;" onclick="my_asset_view(<?php echo $emp_res['sid']; ?>)"><i class="fa fa-edit"></i> View</button>
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
    if ($.fn.DataTable.isDataTable('#example1')) {
        $('#example1').DataTable().destroy();
    }
    $('#example1').DataTable({
      responsive: true
    });
  });

  function my_asset_view(v) {
    $.ajax({
      type: "POST",
      url: "qvision/Recruitment/staff_asset/staff_asset_view.php?id=" + v + "&from=my_assets",
      success: function(data) {
        $("#main_content").html(data);
      }
    });
  }
</script>