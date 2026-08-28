<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
	<style>
	.card-primary:not(.card-outline)>.card-header{
		background-color: #f1cc61 !important;
	}
	</style>
      <div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">DESIGNATION MASTER LIST</font></h3>
                <a onclick=" add_designation()" style="float: right;" data-toggle="modal" class="btn btn-dark">ADD</a>
              </div>
              <div class="card-body">
              <table class="table table-striped table-bordered table-hover display nowrap"  id="example1" style="width:100%">

       <!-- <table class="dataTables-example table table-striped table-bordered table-hover" id="example1"> -->
    <thead>
      <th>#</th>
      <th>Department Id</th>
	   <th>Designation Name</th>
      <th>Status</th>
      <th>Action</th>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT z.dept_name,d.designation_name,d.status AS dstatus,d.id AS did FROM designation_master d join z_department_master z on d.dep_id=z.id");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['dept_name']; ?></td>
	  <td><?php echo $emp_res['designation_name']; ?></td>
	  <td>
	  <?php
	  if($emp_res['dstatus']==1)
	  {
		  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  }
	  else
	  {
		  echo '<span style="color:red;text-align:center;"><b>Inactive</b></span>';
	  }
	  ?>
	  </td>
    <td>
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['did']; ?>" onclick="designation_edit(<?php echo $emp_res['did']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
    <!-- </div>
  </div>
</div>
</div> -->
</div>
<script>
$(document).ready(function() {
    $('#example1').DataTable( {
        "scrollX": true
    } );
} );
</script>
<!-- <script>
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script> -->
<script>
		function add_designation()
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/designation_master/new_designation.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function designation_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/designation_master/edit_designation.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
</script>