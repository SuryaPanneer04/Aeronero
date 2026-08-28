<?php
require '../../../../config.php';
include("../../../../user.php");
$userrole=$_SESSION['userrole'];

?>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Project To Do List</font></h3>
			
              </div>
			  </div>
              <!-- /.card-header -->
			  <form method="POST"  action="qvision/Recruitment/project_management/project_to_do_list/project_to_do_list_view.php">

              <div class="card-body">
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
		 
   
    <thead>
	<th>ID</th>
       <th>Project Name</th>
	  	  <th>Modules</th>
<th>No Of Working Hours</th>
<th>Date</th>
<th>Action</th>
      <!--th>Tools</th-->
      </thead>
      <tbody>
      <?php
 $emp_sql=$con->query("SELECT id,project_name,modules,no_of_working_hours,date FROM project_schedule");	  
	 //echo "SELECT sm.emp_name,s.stationaries,s.system_or_laptop,s.id_card,s.cug,s.access_card,s.erp_access,s.mail_id,s.id AS sid FROM staff_asset s join staff_master sm on s.emp_name=sm.id";
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>

      <td><?php echo $emp_res['project_name']; ?></td>

	  <td><?php echo $emp_res['modules']; ?></td>
	  	  <td><?php echo $emp_res['no_of_working_hours']; ?></td>

	  <td><?php echo $emp_res['date']; ?></td>

<td>
		  <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>"> View</button>
	  </td>
      
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
	 </form>
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
    $(".content").html(data);
    }
    })
  }
 function project_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"/qvision/Recruitment/project_management/project/edit_project.php?id="+v,
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  
   
</script>
project.php