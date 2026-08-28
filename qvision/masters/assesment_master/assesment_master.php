<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<head>
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

    <link rel="stylesheet" href="Qvision\commonstyle.css">
 </head>
<div  class="card card-primary">

 <div class="card-header">
  <h3 class="card-title"><font size="5"> ASSESMENT MASTER </font></h3>
	 <a onclick=" add_asses()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-plus"></i> ADD</a>
</div>

 <div class="card-body">
    <table id="example1" class="dataTables-example table table-bordered">
    <thead>
      <th>S.No</th>
      <th>Assesment</th>
      <th>Status</th>
      <th>Action</th>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT * FROM z_assesment_master ");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $emp_res['id']; ?></td>
      <td><?php echo $emp_res['assesment_name']; ?></td>
      
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
	   <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="edit_asses (<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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










<script>
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
<script>
		function add_asses()
    {
		
  $.ajax({
    type:"POST",
    url:"qvision/masters/assesment_master/new_asses.php",
    success:function(data){
    $("#main_content").html(data);
    }
    }) 
  }
   function edit_asses(v)
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/assesment_master/edit_asses.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
   
   
</script>