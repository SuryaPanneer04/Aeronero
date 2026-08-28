<!DOCTYPE html>
<html>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">  Leave Balance</font></h3>
				<input type="button" style="float:right;" class="btn btn-danger" name="back" value="BACK" onclick="leave_balance_view()">
				</input>
              </div>
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
	<tr>
        <td colspan="6"><center><b>Leave Balance</b></center></td>
        
        <tr>
        <td>Staff id</td>
        <td colspan="5"><input type="text" class="form-control" placeholder=" satff id" id="staff_id" name="staff_id" ></td>
        </tr>
		<tr>
        <td>Emp Code</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="emp code"  id="emp_code" name="emp_code" ></td>
        </tr>
		<tr>
        <td>Emp Name</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="emp name" id="name" name="emp_name" ></td>
        </tr>
		
		
       
		 <tr>
        <td>Payroll Month</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="payroll month" id="month" name="payroll_month" ></td>
        </tr>
		
        
        <tr>
        <td>Casual Leave</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="leave type" id="leave_type" name="Casual_Leave" ></td>
        </tr>
		<tr>
        <td>Sick Leave</td>
                <td colspan="5"><input type="id" class="form-control" placeholder="leave type " id="leave_type" name="Sick_Leave" ></td>
        </tr>
		
        <tr>
        <td>Privilege Leave</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="leave type" id="leave_type" name="Privilege_Leave" ></td>
        </tr>
		

	   
	<tr>
		 
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_leave()" value="save"></td>

		<td> <button type="button" class="btn btn-primary" onclick="leave_mapping_view();">Cancel</button></td>
        </tr></tr>
        </table>
		<div id="leave_view">
     </div>
        <!-- /.post -->
    </form>
        </div>
		</html>
		 <script>
	function leave_balance_view()
	{
		$.ajax({
		type:"POST",
		url:"Leave_Management/leave_balance/leave_balance_view.php",
		success:function(data){
		$("#leave_view").html(data);
		
		}
		})
	}
    
   
function insert_leave()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
	alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
    url:'Leave_Management/leave_master/insert_leave.php',
	
    success:function(data)
    {
      
        alert("Entry Successfully");
leave_master_view()
      
      
    }       
    });
    }
    </script>
