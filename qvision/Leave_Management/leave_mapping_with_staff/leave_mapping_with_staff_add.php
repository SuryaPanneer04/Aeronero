<!DOCTYPE html>
<html>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">  Leave Mapping with Staff</font></h3>
				<input type="button" style="float:right;" class="btn btn-danger" name="back" value="BACK" onclick="leave_mapping_with_staff()">
				</input>
              </div>
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
	<tr>
        <td colspan="6"><center><b>Leave Mapping with Staff</b></center></td>
        
        <tr>
        <td>Staff Type id</td>
        <td colspan="5"><input type="id" class="form-control" placeholder=" satff id" id="staff_type_id" name="staff_type_id" ></td>
        </tr>
		<tr>
        <td>Staff Type</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="staff type"  id="staff_type" name="staff_type" ></td>
        </tr>
       
		 <tr>
        <td>Leave Type id</td>
                <td colspan="5"><input type="id" class="form-control" placeholder="leave type id" id="leave_type_id" name="leave_type_id" ></td>
        </tr>
		
        <tr>
        <td>Leave Type</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="leave type" id="leave_type" name="leave_type" ></td>
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
		 
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="leave_mapping_with_staff_insert()" value="save"></td>

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
	function leave_mapping_with_staff()
	{
		$.ajax({
		type:"POST",
		url:"Leave_Management/leave_mapping_with_staff/leave_mapping_with_staff.php",
		success:function(data){
		$("#leave_view").html(data);
		
		}
		})
	}
    
   
function leave_mapping_with_staff_insert()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
	alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
    url:'Leave_Management/leave_mapping_with_staff/leave_mapping_with_staff_insert.php',
	
    success:function(data)
    {
      
        alert("Entry Successfully");
leave_master_view()
      
      
    }       
    });
    }
    </script>
