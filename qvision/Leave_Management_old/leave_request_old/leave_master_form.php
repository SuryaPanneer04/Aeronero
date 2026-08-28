<?php
Session_start();
include '../../connect.php';
//include '../../user.php';
$user_id=$_SESSION['userid'];

?>

<html>
<div  class="card card-primary">
              <div class="card-header" style="background-color: #f1cc61; !important">
                <h3 class="card-title"><font size="5">  Leave Master</font></h3>
				<input type="button" style="float:right;" class="btn btn-danger" name="back" value="BACK" onclick="leave_mapping_view()">
				</input>
              </div>
			  <div class="card-body">
					<form method="POST" name="leave" id="leave" enctype="multipart/form-data">
					<!-- Post -->
						<table class="table table-bordered">
							<tr>
								<tr>
									<td colspan="2">Employee Name</td>
									<td colspan="6">
										<select class="form-control" id="emp_name" name="emp_name" onchange="emp_check(this.value)">
											<option value=""> Choose Employee </option>
											<?php $stmt1 = $con->query("SELECT candid_id,emp_name,status FROM staff_master where status=1 ");
											while ($row1 = $stmt1->fetch()) {
												$candid_id=$row1['candid_id'];
												$emp_name=$row1['emp_name'];
												?>
												<option value="<?php echo $candid_id.'-'.$emp_name; ?>"> <?php echo $emp_name; ?> </option>
											<?php } ?>
										</select>
									</td>
									</tr>
									<tr>
										<td colspan="2">Date of Joining</td>
										<td colspan="6"><input type="text" class="form-control" id="doj"  name="doj" placeholder="Type.." readonly>
										<input type="hidden" class="form-control" id="candid_id"  name="candid_id" readonly></td>

									</tr>
									<tr>
										<td colspan="2">Leave Type</td>
										<td colspan="6">
											<select class="form-control" id="leave_type" name="leave_type" >
												<option value=""> Choose Leave Type </option>
												<?php $stmt = $con->query("SELECT * FROM master_leave where status=1");
												while ($row = $stmt->fetch()) {
													?>
													<option value="<?php echo $row['id']; ?>"> <?php echo $row['leave_name']; ?> </option>
												<?php } ?>
											</select>
										</td>
										</tr>
																
									<tr>		 
										<td colspan="8"><input type="submit" class="btn btn-success" name="submit" id="submit" value="save">
										
										<button type="button" class="btn btn-primary" onclick="leave_mapping_view();">Cancel</button></td>
									</tr>
							</tr>
						</table>
					</form>
			</div>
        </div>
		
		<script>  
 $(document).ready(function(){  
     
	  $("form[name='leave']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);	  
           $.ajax({  
                url:"Leave_Management/leave_request/leave_master_insert.php",  
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
				processData: false,
                success:function(data)  
                {  
				var split = data.split("-");
				if(split[1]==1)
				{
					alert('Sorry!! Record Already Found');
				}else{
                    alert('Leave Requested Successfully'); 
                      leave_management()
                }
				}				
           });  
      });  
 });  
 </script>
 		
	 <script>
	  	function leave_request_insert()
			{

				var datas = $('form').serialize();
				alert(datas)
				  $.ajax({
					type: "GET",
					data:datas,
					url:"Leave_Management/leave_request/insert_leave.php",
					success: function (data) {
						alert("Leave Requested Successfully")
                        leave_management()
					}
				})  
			}  
	</script>		
	<script>		
	function emp_check(values)
    {
	$split_candid= values.split("-");
		candid_id=$split_candid[0];
		//alert(candid_id)
        $.ajax({
            type: "GET",
            data:"candid_id="+candid_id,
            url: "Leave_Management/leave_request/get_doj.php",
            success: function (data) {
				
                 var split = data.split(",");
				 
               $('#doj').val(split[1]);
               $('#candid_id').val(split[2]);
  
            }
        })
    }
	
	function leave_mapping_view()
	{
	leave_management()	
	}
	</script>

	</html>
