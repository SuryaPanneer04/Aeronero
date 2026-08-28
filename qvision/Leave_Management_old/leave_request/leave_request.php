<?php
//Session_start();
include '../../../connect.php';
include '../../../user.php';
$user_id=$_SESSION['userid'];
$candidateid=$_SESSION['candidateid'];

?>

<html>

<div class="card card-info">
              <div class="card-header" style="background:orange;">
                <h3 class="card-title"><font size="5">  Leavesdfghjkl Request</font></h3>
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
									<select class="form-control" id="leave_type" name="leave_type" onchange="leve_check(this.value);change(this.value);show_save(this.value);">
										<option value=""> Choose Leave Type </option>
										<?php 
										$join=$con->query("select joining_date from candidate_form_details where id='$candidateid'");
										$joining=$join->fetch();
										$join_date=$joining['joining_date'];
										$date=date('Y-m-d');
										$ts1 = strtotime($join_date);
										$ts2 = strtotime($date);

										$year1 = date('Y', $ts1);
										$year2 = date('Y', $ts2);

										$month1 = date('m', $ts1);
										$month2 = date('m', $ts2);
										$interval = (($year2 - $year1) * 12) + ($month2 - $month1);

										
										
										if($interval>=8){
										$stmt = $con->query("SELECT id,leave_name,status FROM master_leave where flag!='2' ORDER BY id ASC");
										while ($row = $stmt->fetch()) {
										?>
											<option value="<?php echo $row['id']; ?>"> <?php echo $row['leave_name']; ?> </option>
										<?php } 
											  }
											else{
											$stmt = $con->query("SELECT id,leave_name,status FROM master_leave where flag!='1' ORDER BY id ASC");
										while ($row = $stmt->fetch()) {	
											  ?>
											  <option value="<?php echo $row['id']; ?>"> <?php echo $row['leave_name']; ?> </option>
										<?php } 
											} ?>
									</select>
								</td>
								<td colspan="2">Leave Eligible From</td>
									<td colspan="2"><input type="text" class="form-control"  id="lveapp" name="lveapp" readonly></td>
								</tr>
							
							
							<tr id="change">
							    
							</tr>
							
							
							<tr id="full_day">
							
							</tr>
							
								<tr>
									<td colspan="2">Leave Counts</td>
									<?php
									
/* 									$stmtz = $con->query("SELECT a.*,b.* FROM z_user_master a left join leave_masters b on (a.candidate_id=b.candid_id) where emp_name='$emp_name'");
											   $count=$stmtz->rowCount();
											   if($count>0){
                                               $rowz = $stmtz->fetch();
											   $count=$rowz['total_leave'];
											   $balance=$rowz['balance_leave'];
											   } */
											   ?>
									<td colspan="2"><input type="text" class="form-control" id="total_leave_count"  name="total_leave_count" placeholder="Type.." readonly></td>
									<td colspan="2">Balance Leave</td>
									<td colspan="2"><input type="text" class="form-control" placeholder="balance_leave"  id="balance_leave" name="balance_leave" readonly ></td>
								</tr>								
								<tr>		 
									<td colspan="2">Reason For Leave :</td>
									<td colspan="2"><input type="text" class="form-control" id="reason" name="reason" placeholder="Type.." ></td>
									<td colspan="2">Upload Certificate :</td>
									<td colspan="2">  <input type="file" name="uploadfile"  value=""/></td>
									
								</tr> 
							
								<tr id="show_save">		 
								
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
                url:"Leave_Management/leave_request/insert_leave.php",  
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
    processData: false,
                success:function(data)  
                {  
					alert('Leave Requested Successfully'); 
                    leave_apply()
				
				}				
           });  
      });  
 });  
 </script>
 		
	 <script>
	  /*	function leave_request_insert()
			{

				var datas = $('form').serialize();
				alert(datas)
				  $.ajax({
					type: "GET",
					data:datas,
					url:"Leave_Management/leave_request/insert_leave.php",
					success: function (data) {
						var split = data.split(",");
				 
               //$('#balance_leave').val(split[1]);
						alert("Leave Requested Successfully")
                        leave_management()
					}
				})  
			}*/  
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
            url: "leave_management/leave_request/share_leave.php",
            success: function (data) {
				//alert(data)
                 var split = data.split(",");
				 
               $('#balance_leave').val(split[1]);
			   if(split[1]==0){
				   //alert("You Are Not Eligible For This Leave")
				   
			   }
               $('#total_leave_count').val(split[2]);
               $('#lveapp').val(split[3]);
               
            }
        })
    }
	</script>
	<script>
	function leave_mapping_view()
    {
	leave_apply()	
	}
	</script>
	<script>
		function change(v)
		{
			    $('#fullf_date').hide();
	            $('#from_date').hide();
	            $('#fullt_date').hide();
                $('#to_date').hide();
			if(v==2 || v==4)
			{				
				$.ajax({
				url: "Leave_Management/leave_request/events.php?id="+v,
				success: function (data) 
				{
					if(data==0)
					{
					}
					else
					{
						$('#change').show();
						$('#change').html(data); 
						
					}
				}
			});
			} else {
				$.ajax({
				url: "Leave_Management/leave_request/check.php?id="+v,
				success: function (data) 
				{
							
					if(data==1)
					{
					  $('#full_day').html(data);
					}
					else
					{
						$('#change').show();
						$('#change').html(data); 
						
					}
				}
			});
				//$('#change').hide();
			}
			
				
		}
		function leave_count(){
			
			
			
			var fromdate = new Date($('#from_date').val()); 
		
			var todate = new  Date($('#to_date').val());
			
			var count =  todate  - fromdate;
		    var counts = count / (1000 * 60 * 60 * 24) ; 
			var counting=counts+1;
			
		   document.querySelector('#total_leave_count').value = counting ;
		   
		   
	}
	function show_save(v)
    {
		var candid_id = document.getElementById("candids_id").value;
			
        $.ajax({
            type: "GET",
            data:{leave_type:v,
			candid_id:candid_id,
			},
            url: "leave_management/leave_request/show_save.php",
            success: function (data) {
					$('#show_save').show();
                 $('#show_save').html(data); 
               leave_apply()
            }
        })
    }
	</script>
	
	</html>
