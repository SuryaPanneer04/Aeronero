<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = isset($_SESSION['userrole']) ? $_SESSION['userrole'] : '';
?>
<style>
#page-wrapper{
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
}
.btn-primary{
	background-color: #ed5d00;
    border-color: #ed5d00;
}
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.btn-danger{
	background-color: #ed5d00;
    border-color: #ed5d00;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black;
}
</style>



  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title" style="color:black !important;"><font size="5">HOD LIST</font></h3>
		<a onclick=" add_hod()" style="float: right;" data-toggle="modal" class="btn btn-danger">ADD</a>
              </div>
			  
			  <br>
			  
<div>
<div class="container-fluid">

   <div class="panel-body">
      <div class="table-responsive">
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
		 
   
    <thead>
      <th>Id</th>
	  <th>Department</th>
	  <th>Employee Name</th>
	  <th>Mail Id</th>
	  <th>Assest</th>
      <th>Others</th>
	  <th>Action</th>
      </thead>
   <tbody>
          <?php
      $emp_sql = $con->query("
        SELECT 
            h.id AS hid, 
            h.asset, 
            h.mail_id, 
            h.others, 
            sm.emp_name, 
            zd.dept_name 
        FROM hod h 
        LEFT JOIN staff_master sm ON h.emp_name = sm.candid_id 
        LEFT JOIN z_department_master zd ON h.dept_name = zd.id
      ");

      if($emp_sql === false) {
          echo "<tr><td colspan='7'>SQL Error in Database Query</td></tr>";
      } else {
          $i=1;
          while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
          {
              $assid = trim($emp_res['asset']);
              $assid = rtrim($assid, ',');
              $asset_names_str = '-';
              
              if(!empty($assid)){
                  $dep_sql = $con->query("SELECT asset FROM staff_asset_master WHERE id IN ($assid)");
                  $anames = [];
                  if($dep_sql){
                      while($afet = $dep_sql->fetch(PDO::FETCH_ASSOC)) {
                          $anames[] = $afet['asset'];
                      }
                      $asset_names_str = implode(", ", $anames); // Clean ah print aagum
                  }
              }
           ?>
          <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $emp_res['dept_name']; ?></td>
              <td><?php echo $emp_res['emp_name']; ?></td>
              
              <td><?php echo $emp_res['mail_id']; ?></td>
              
              <td><?php echo $asset_names_str; ?></td>
              <td><?php echo $emp_res['others']; ?></td>
              <td>
                  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['hid']; ?>" onclick="staff_asset_edit(<?php echo $emp_res['hid']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
</div>
<script>
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
<script>
		function add_hod()
    {
    $.ajax({
    type:"POST",
    url:"qvision/Recruitment/hod/new_hod.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function staff_asset_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"qvision/Recruitment/hod/edit_hod.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
   
</script>