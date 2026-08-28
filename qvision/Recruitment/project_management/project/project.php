

<?php
require '../../../../config.php';
require '../../../../user.php';
$userrole=$_SESSION['userrole'];
?>

<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Project List</font></h3>
			<a onclick="return add_project()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  New Project</a>
			
              </div>
  
              <div class="card-body">
			  
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
    
      <thead>
	   <th>ID</th>
	        <th>Client</th>
<th>Project Name</th>
 <th>Project Timeline</th>
   <th>No Of Working Hours</th> 
   <th>Action</th>
      </thead>
      <tbody>
      <?php
$emp_sql=$con->query("SELECT cm.client_name,p.project_name,p.project_timeline,p.no_of_working_hours,p.id AS pid FROM project p join client_master cm on p.client=cm.id 
");
	  
	 //echo "SELECT sm.emp_name,s.stationaries,s.system_or_laptop,s.id_card,s.cug,s.access_card,s.erp_access,s.mail_id,s.id AS sid FROM staff_asset s join staff_master sm on s.emp_name=sm.id";
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['client_name']; ?></td>
	  <td><?php echo $emp_res['project_name']; ?></td>
<td><?php echo $emp_res['project_timeline']; ?></td>
<td><?php echo $emp_res['no_of_working_hours']; ?></td>
	<td>				
		<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['pid']; ?>" onclick="project_edit(<?php echo $emp_res['pid']; ?>)"><i class="fa fa-edit"></i> Edit</button>
					</td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
       </table>
				
              </div>
              <!-- /.card-body -->
            </div>
<script>
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
				responsive: true
		});
	});
</script>
<script>
		function add_project()
    {
    $.ajax({
    type:"POST",
    url:"/qvision/Recruitment/project_management/project/new_project.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }

    </script>
