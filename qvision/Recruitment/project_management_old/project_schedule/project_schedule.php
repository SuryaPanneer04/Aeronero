

<?php
require '../../../../config.php';
require '../../../../user.php';
$userrole=$_SESSION['userrole'];
?>

<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Project Schedule List</font></h3>
			<a onclick="return add_project_schedule()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  New Project Schedule</a>
			
              </div>
  
              <div class="card-body">
			  
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
    
      <thead>
	   <th>ID</th>
	  <th>Client</th>
	  <th>Project Name</th>
	        <th>Modules</th>
<th>Employee</th>
  <th>No Of Working Hours</th>   
  <th>Date</th>
<th>Action</th>
      </thead>
      <tbody>
      <?php
 /* $emp_sql=$con->query("SELECT p.client,p.project_name,pt.modules,sm.emp_name,pt.no_of_working_hours,pt.date,pt.id AS ptid,pt.status FROM project_schedule pt join staff_master sm on pt.employees=sm.id join project p on pt.client=p.id and pt.project_name=p.id
");*/
	 $emp_sql=$con->query("SELECT * FROM project_schedule");
	 //echo "SELECT sm.emp_name,s.stationaries,s.system_or_laptop,s.id_card,s.cug,s.access_card,s.erp_access,s.mail_id,s.id AS sid FROM staff_asset s join staff_master sm on s.emp_name=sm.id";
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
	        <td><?php echo $emp_res['client']; ?></td>

      <td><?php echo $emp_res['project_name']; ?></td>

      <td><?php echo $emp_res['modules']; ?></td>
	  <td><?php echo $emp_res['employees']; ?></td>
<td><?php echo $emp_res['no_of_working_hours']; ?></td>
     	  <td><?php echo $emp_res['date']; ?></td>

<td>
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="project_schedule_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
	function add_project_schedule()
    {
    $.ajax({

    type:"POST",
    url:"/qvision/Recruitment/project_management/project_schedule/new_project_schedule.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }

    </script>
