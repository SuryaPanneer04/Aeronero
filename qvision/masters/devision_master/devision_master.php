<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
      <div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">DIVISION MASTER LIST </font></h3>
                <a onclick="add_devision()" style="float: right;" data-toggle="modal" class="btn">ADD</a>
              </div>
              <div class="card-body">
       <!-- <table class="dataTables-example table table-striped table-bordered table-hover" id="example1"> -->
       <table class="table table-striped table-bordered table-hover display nowrap"  id="example1" style="width:100%">

       <thead>
      <th>#</th>
      <th>Department Id</th>
	   <th>Division Name</th>
      <th>Status</th>
      <th>Action</th>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT z.dept_name,d.div_name,d.status AS dstatus,d.id AS did FROM division_master d join z_department_master z on d.dep_id=z.id");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['dept_name']; ?></td>
	  <td><?php echo $emp_res['div_name']; ?></td>
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
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['did']; ?>" onclick="division_edit(<?php echo $emp_res['did']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
		function add_devision()
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/devision_master/new_devision.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function division_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/devision_master/edit_devision.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
   
</script>