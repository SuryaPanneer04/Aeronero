<?php
Session_start();
include '../../../connect.php';
//include '../../user.php';
$user_id=$_SESSION['userid'];

?>

<html>
<div  class="card card-primary">
              <div class="card-header" style="background-color:#ff8b3d;">
                <h3 class="card-title"><font size="5">  Leave Request</font></h3>
				<input type="button" style="float: right;background-color:black;border:1px solid black;" class="btn btn-danger" name="back" value="BACK" onclick="leave_mapping_view()">
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
									<?php
									$stmts = $con->prepare("SELECT user_id,full_name,candidate_id FROM z_user_master where user_id='$user_id'");
									//echo "SELECT user_id,full_name,candidate_id FROM z_user_master where user_id='$user_id'";
											   $stmts->execute(); 
                                               $rows = $stmts->fetch();
											   $emp_name=$rows['full_name'];
											   $candid_id=$rows['candidate_id'];


												   ?>
												   <input type="hidden" class="form-control" id="candids_id" value="<?php echo $candid_id; ?>" name="candids_id" >
												   <input type="text" class="form-control" id="full_name" value="<?php echo$emp_name; ?>" name="full_name" readonly>
									</td>														
								</tr>
								<tr>
								<td colspan="2">Leave Type</td>
								<td colspan="2">
									<select class="form-control" id="leave_type" name="leave_type" onchange="leve_check(this.value)">
										<option value=""> Choose Leave Type </option>
										<?php $stmt = $con->query("SELECT * FROM master_leave where status=1 ORDER BY id ASC");
										while ($row = $stmt->fetch()) {
											?>
											<option value="<?php echo $row['id']; ?>"> <?php echo $row['leave_name']; ?> </option>
									<?php } ?>
									</select>
								</td>
								<td colspan="2">Leave Eligible From</td>
									<td colspan="2"><input type="text" class="form-control"  id="lveapp" name="lveapp" readonly></td>
								</tr>								
								 <tr>
									<td colspan="2">From Date</td>
									<td colspan="2"><input type="date" class="form-control"  id="from_date" name="from_date" ></td>
									<td colspan="2">To Date</td>
									<td colspan="2"><input type="date" class="form-control"  id="to_date" name="to_date" ></td>
								</tr>
								<!--<tr>
									<td colspan="2">Leave Counts</td>
									<?php
									$stmtz = $con->prepare("SELECT a.*,b.* FROM z_user_master a left join leave_masters b on (a.candidate_id=b.candid_id) where emp_name='$emp_name'");
											   $stmtz->execute(); 
                                               $rowz = $stmtz->fetch();
											   $count=$rowz['total_leave'];
											   $balance=$rowz['balance_leave'];
											   ?>
									<td colspan="2"><input type="text" class="form-control" id="count"  name="count" placeholder="Type.." readonly></td>
									<td colspan="2">Balance Leave</td>
									<td colspan="2"><input type="text" class="form-control" placeholder="balance_leave"  id="balance_leave" name="balance_leave" readonly ></td>
								</tr>-->								
								<tr>		 
									<td colspan="2">Reason For Leave :</td>
									<td colspan="2"><input type="text" class="form-control" id="reason" name="reason" placeholder="Type.." ></td>
									<td colspan="2">Upload Certificate :</td>
									<td colspan="2">  <input type="file" name="uploadfile"  value=""/></td>
									
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
                url:"qvision/Leave_Management/leave_request/insert_leave.php",  
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
    processData: false,
                success:function(data)  
                {  
					alert('Leave Requested Successfully'); 
                    leave_management()
				
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
					url:"qvision/Leave_Management/leave_request/insert_leave.php",
					success: function (data) {
						alert("Leave Requested Successfully")
                        leave_management()
					}
				})  
			}  
	</script>		
	<script>		
	function leve_check(back)
    {
		var candid_id = document.getElementById("candids_id").value;

		//alert(candid_id)
		//alert()
        $.ajax({
            type: "GET",
            data:{back:back,
			candid_id:candid_id,
			},
            url: "qvision/leave_management/leave_request/share_leave.php",
            success: function (data) {
				
                 var split = data.split(",");
				 
               $('#balance_leave').val(split[1]);
               $('#count').val(split[2]);
               $('#lveapp').val(split[3]);
               
                
            }
        })
    }
	</script>
	<script>
	function leave_mapping_view()
    {
	leave_management()	
	}
	</script>
	</html>
