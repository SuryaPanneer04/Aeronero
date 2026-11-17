<?php
require '../../../connect.php';
session_start();
$userrole=$_SESSION['userrole'];
?>

<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Project Master</font></h3>
			<a onclick="return add_project_master()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  New Project</a>
			
              </div>
  
              <div class="card-body">
			  <div class="table-responsive">
       <table class="dataTables-example table table-striped table-bordered table-hover" id="example1" style="width:100%;">
    
      <thead>
	   <th>ID</th>
    <th>Project Code</th>
<th>Project Name</th>
<th>Country</th>
      </thead>
      <tbody>
      <?php
$emp_sql=$con->query("SELECT * FROM y_project_details ORDER BY project_id DESC");
	  
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['project_code']; ?></td>
	  <td><?php echo $emp_res['project_name']; ?></td>  
      <td><?php echo $emp_res['country']; ?></td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
       </table>
       </div>
				
              </div>
              <!-- /.card-body -->
            </div>
<script>
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
				scrollX: true
		});
	});
</script>
<script>
		function add_project_master()
    {
    $.ajax({
    type:"POST",
    url:"qvision/project_management/project_master/new.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }

</script>
