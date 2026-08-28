<?php
require '../../../connect.php';
require '../../../user.php';
$userrole=$_SESSION['userrole'];
?>

<div  class="card card-primary">
              <div class="card-header" style="background-color: #f1cc61;">
                <h3 class="card-title" ><font size="5">Time Sheet Report</font></h3>
			
              </div>
  
              <div class="card-body">
			  
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
    
		<thead>
            <tr>
                <th>SL.No</th>
                <th>Emp Code</th>
                <th>Employee Name</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
      <tbody>
      <?php
// $emp_sql=$con->query("SELECT a.id as emp_id,a.*,b.* from time_sheet a left join staff_master b on(a.staff_id=b.candid_id)");
$emp_sql=$con->query("SELECT a.id as emp_id,a.*,b.* from time_sheet a left join staff_master b on(a.staff_id=b.candid_id) ORDER BY a.id DESC");

// echo "SELECT a.id as emp_id,a.*,b.* from time_sheet a left join staff_master b on(a.staff_id=b.candid_id)";

	

	 //echo "SELECT sm.emp_name,s.stationaries,s.system_or_laptop,s.id_card,s.cug,s.access_card,s.erp_access,s.mail_id,s.id AS sid FROM staff_asset s join staff_master sm on s.emp_name=sm.id";
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['emp_code']; ?></td>
      <td><?php echo $emp_res['emp_name']; ?></td>
	  <td><?php echo $emp_res['date']; ?></td>

	<td>	

		<button class="btn btn-primary btn-sm view btn-flat" data-id="<?php echo $emp_res['emp_id']; ?>" onclick="report_view(<?php echo $emp_res['emp_id']; ?>)"><i class="fa fa-eye"></i> View</button>
		
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
	
 function report_view(v)
    {
    $.ajax({
    type:"POST",
    url:"qvision/Recruitment/project_management/view_time_sheet.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
    </script>