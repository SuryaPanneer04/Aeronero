<!DOCTYPE html>
<html>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">  Leave Openings</font></h3>
				<input type="button" style="float:right;" class="btn btn-danger" name="back" value="BACK" onclick="leave_opening_view()">
				</input>
              </div>
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
	<tr>
        <td colspan="6"><center><b>Leave Openings</b></center></td>
        
        <tr>
        <td>Staff id</td>
        <td colspan="5"><input type="text" class="form-control" placeholder=" satff id" id="staff_id" name="staff_id" ></td>
        </tr>
		
       
		 <tr>
        <td>Staff Type id</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="staff type id" id="staff_type_id" name="staff_type_id" ></td>
        </tr>
		
        <tr>
        <td>Date of Joining</td>
                <td colspan="5"><input type="date" class="form-control" placeholder="date of joining" id="doj" name="doj" ></td>
        </tr>
		 <tr>
        <td>From Date</td>
                <td colspan="5"><input type="date" class="form-control" placeholder="from date" id="from_date" name="from_date" ></td>
        </tr>
        <td>Leave Type id</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="leave type id" id="leave_type_id" name="leave_type_id" ></td>
        </tr>
		
        <tr>
        <td>Leave Name</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="leave name" id="leave_name" name="leave_name" ></td>
        </tr>
		<tr>
        <td>leave op Balance</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="leave op balance " id="leave_op_balance" name="leave_op_balance" ></td>
        </tr>
		
       <tr>     		
<td>Status</td>
<td colspan="5">
<select id="status" name="status" class="form-control" >
 

    <option value="1">Active</option>
	 <option value="2"> IN Active</option>

</select>
</td>

       </td>
	   </tr>

	   
	<tr>
		 
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="leave_opening_insert()" value="save"></td>

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
	function leave_opening_view()
	{
		$.ajax({
		type:"POST",
		url:"Leave_Management/leave_opening/leave_opening_view.php",
		success:function(data){
		$("#leave_view").html(data);
		
		}
		})
	}
    
   
function leave_opening_insert()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
	alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
    url:'Leave_Management/leave_opening/leave_opening_insert.php',
	
    success:function(data)
    {
      
        alert("Entry Successfully");
leave_opening_view()
      
      
    }       
    });
    }
    </script>
