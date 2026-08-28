<?php
require '../config.php';
include("../user.php");
$userrole=$_SESSION['userrole'];
?>
<div class="container">
<div class="card mb-3">

    <div class="card-header">
        <h3 class="card-title"><b>DAILY TASK LIST</b></h3>
    </div>

<form method="POST" name="add_name" enctype="multipart/form-data">
 <br>
<table class="table table-bordered">
<tr>
     <td>Employee name </td>
      <td>
         <select class="form-control" name="emp_name" id="emp_name" onchange="task_view()">
		 <option value="0">-- Select Employee --</option>
		 <?php
		  $emp_sql=$con->query("SELECT id, emp_name, status FROM staff_master WHERE status = 1 ");
		  while($emp_sql_res=$emp_sql->fetch(PDO::FETCH_ASSOC))
		   {
			?>
		  <option value="<?php echo $emp_sql_res['id']; ?>"><?php echo $emp_sql_res['emp_name']; ?></option>
		  <?php
		  }
		  ?>
         </select> 
     </td>
</tr>
</table> <br><br>

<table id="example1" class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Employee Name</th>
                    <th>Task Name</th>
                    <th>Description</th>
                    <th>Assigned Date</th>
                    <th>Status</th>
                    <th>Completed Date</th>
                </tr>
            </thead>

            <tbody id="task_list">
               
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
</form>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

function task_view(){
    let id = $('#emp_name').val()
    
    $.ajax({
            type: "POST",
            url: "Daily_Task/daily_task_viewlist.php?id=" + id,
            success: function (data)
            {
                $("#task_list").html(data); 
            }
        })
}
</script>