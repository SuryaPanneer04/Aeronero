<!DOCTYPE html>
<html>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">  Add Leave</font></h3>
				<input type="button" style="float:right;" class="btn btn-danger" name="back" value="BACK" onclick="leave_master_view_back()">
				</input>
              </div>
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
	<tr>
        <td colspan="6"><center><b>Add Leave</b></center></td>
        
        <tr>
        <td>Date</td>
        <td colspan="5"><input type="date" class="form-control"  id="from_date" name="from_date" ></td>
        </tr>
        <tr>
       <td>Leave Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="leave Name" id="leave_name" name="leave_name"></td>
		
        </tr>
		<tr>
        <td>Month</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="Month" id="Month" name="days_per_month" ></td>
        </tr>
		
        <tr>
        <td>Year</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="Year" id="Year" name="days_per_year" ></td>
        </tr>
		
		<tr>
		<td>is_cummulative</td>
	  <td colspan="5" >   
      
   
      <select name="is_cummulative" id="is_cummulative" class="form-control">
	  
      <option value="yes">Yes</option>
      <option value="no">No</option>
	  
      </select></tr> 
		
<td>Status</td>
<td colspan="5">
<select id="status" name="status" class="form-control" >
 

    <option value="1">Active</option>
	 <option value="2"> IN Active</option>

</select>
</td>
</tr>
		 
		 
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="leave_master_insert()" value="save"></td>

		<td> <button type="button" class="btn btn-primary" onclick="leave_master_view();">Cancel</button></td>
        </tr></tr>
        </table>
		<div id="leave_view">
     </div>
        <!-- /.post -->
    </form>
        </div>
		</html>
		 <script>
	function leave_master_view_back()
	{
		$.ajax({
		type:"POST",
		url:"Leave_Management/leave_master/leave_master_view.php",
		success:function(data){
		$("#leave_view").html(data);
		}
		})
	}
    
   
function leave_master_insert()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
	alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
    url:'leave_management/leave_master/leave_master_insert.php',
	
    success:function(data)
    {
      
        alert("Entry Successfully");
leave_master_view()
      
      
    }       
    });
    }
    </script>
