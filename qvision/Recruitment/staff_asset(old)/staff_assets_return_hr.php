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
      <font size="5">Staff Asset List</font>
    </h3>
  </div>

  <div class="row content">
    <div class="col-lg-12">
      <div class="panel panel-default">

        <!-- /.card-header -->
        <div class="card-body">
          <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">


            <thead>
              <th>ID</th>
              <th>Employee Name</th>
              <th>Assets</th>
              <th>Pending</th>
              <!--th>Status</th-->
              <th>Action</th>
              <!--th>Tools</th-->
            </thead>
            <tbody>
              <?php
                $emp_sql = $con->query("SELECT a.staff_id as staff_id, sm.emp_name, a.asset_master_id, a.id as sid, a.status as status 
                                        FROM staff_access_request a 
                                        JOIN staff_master sm ON a.staff_id=sm.id 
                                        WHERE a.status=3 
                                        AND a.id IN (SELECT asset_request_id FROM staff_asset_list WHERE status=1 AND asset_id != 0) 
                                        GROUP BY a.staff_id");
                
                $i = 1;
                while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
                  $staffid = $emp_res['staff_id'];
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
                  
                
                   <td>
                    <?php 
                    $disasset = $con->query("SELECT DISTINCT m.name FROM staff_asset_list s JOIN assets_form_detail a ON s.asset_id=a.id JOIN assets_master m ON a.asset_name=m.name WHERE s.status=1 AND s.staff_id='$staffid'");
                    $pending_names = [];
                    if($disasset){
                        while ($asdes = $disasset->fetch()) {
                            $pending_names[] = $asdes['name'];
                        }
                        $unique_pending = array_unique($pending_names);
                        echo !empty($unique_pending) ? implode(", ", $unique_pending) : "-";
                    }
                    ?>
                  </td>

                  <td>
                    <?php
                    if ($emp_res['status'] == 3) {
                    ?>
                      <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['sid']; ?>" onclick="staff_asset_return_hr(<?php echo $emp_res['sid']; ?>)"><i class="fa fa-edit"></i> Return</button>
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

  function staff_asset_return_hr(v) {
    $.ajax({
      type: "POST",
      url: "qvision/Recruitment/staff_asset/get_assets_return.php?id=" + v,
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }
</script>