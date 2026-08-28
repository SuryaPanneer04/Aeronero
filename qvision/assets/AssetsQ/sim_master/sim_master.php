<?php
require '../../config.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
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
</style>

<div  class="card card-primary">
   <div class="card-header">
    <h3 class="card-title"><font size="5"> Sim List </font></h3>
	<a onclick="sim_excel()"  style="float: right;padding: 4px 6px 7px 5px;position: relative;left: -3px;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-plus"></i>EXCEL</a>
	<a onclick=" add_sim()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ADD</a>
  </div>


					
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
  
   <!-- /.card-header -->
      <div class="card-body">
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
		 
   
    <thead>
      <th>S.No</th>
      <th>Provider Name</th>
      <th>Phone Number</th>
      <th>Activation Date</th>
	  <th>Status</th>
	  <th>Action</th>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT * FROM sim_master ");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['provider_name']; ?></td>
      <td><?php echo $emp_res['phone_no']; ?></td>
      <td><?php echo $emp_res['activation_date']; ?></td>
	  <td>
	  <?php
	  if($emp_res['status']==1)
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
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="sim_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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

  
<script>
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
<script>
		function add_sim()
    {
    $.ajax({
    type:"POST",
    url:"/KerliERP/AssetsQ/sim_master/new_sim.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function sim_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"/KerliERP/AssetsQ/sim_master/edit_sim.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  } 
  function sim_excel(v)
    {
    $.ajax({
    type:"POST",
    url:"AssetsQ/sim_master/sim_excels.php?",
    success:function(data){
   $("#main_content").html(data);
    }
    })
    }
   
</script>