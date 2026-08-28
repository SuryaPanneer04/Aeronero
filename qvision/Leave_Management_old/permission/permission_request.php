<?php
Session_start();
include '../../../connect.php';
//include '../../user.php';
$user_id=$_SESSION['userid'];

?>

<html>

<div class="card card-info">
              <div class="card-header" style="background-color: #f1cc61; !important">
                <h3 class="card-title"><font size="5"> Permission Request</font></h3>
				<input type="button" style="float:right;" class="btn btn-danger" name="back" value="BACK" onclick="leave_mapping_view()">
				</input>
              </div>
			  <div class="card-body">
					<form method="POST" name="permission" id="permission" enctype="multipart/form-data">
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
								<!--<tr>
								<td colspan="2">Leave Type</td>
								<td colspan="2">
									<select class="form-control" id="leave_type" name="leave_type" onchange="leve_check(this.value)">
										<option value=""> Choose Leave Type </option>
										< ?php $stmt = $con->query("SELECT id,leave_name,status FROM master_leave where status=1 ORDER BY id ASC");
										while ($row = $stmt->fetch()) {
											?>
											<option value="< ?php echo $row['id']; ?>"> < ?php echo $row['leave_name']; ?> </option>
									< ?php } ?>
									</select>
								</td>
								<td colspan="2">Leave Eligible From</td>
									<td colspan="2"><input type="text" class="form-control"  id="lveapp" name="lveapp" readonly></td>
								</tr>-->								
								 <tr>
									<td colspan="2">From Date</td>
									<td colspan="6"><input type="date" class="form-control"  id="from_date" name="from_date" ></td>
									
								</tr>
								<tr>
									<td colspan="2">Permission From</td>
									
											  
									<td colspan="2"><input type="time" name="time"  class="form-control" onchange="onTimeChange()" id="timeInput" step="3600" max="16:00"/><small>Office hours are 9am to 6pm</small></td>
									<td colspan="2">Permission To</td>
									
											  
									<td colspan="2"><input type="time" name="time1"  class="form-control timz" onchange="offTimeChanges(),timecheck(this.value)" id="timeInput1" step="3600" readonly></td>
									
								</tr>								
								<tr>		 
									<td colspan="2">Reason For Permission :</td>
									<td colspan="2"><input type="text" class="form-control" id="reason" name="reason" placeholder="Type.." ></td>
									<td colspan="2">Upload Certificate (optional):</td>
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
		function timecheck(c)
		{
			var formtime=document.getElementById("timeInput").value;
			var totime=c;

			var from=parseInt(prompt(formtime)); 
			var To=parseInt(prompt(totime)); 
			alert(from)
			alert(totime)

			var calc=(from-To);
			alert(calc)
		}
		</script> 
		<script> 
		
		
var inputEle = document.getElementById('timeInput');


function onTimeChange() {
  var timeSplit = inputEle.value.split(':'),
    hours,
    minutes,
    meridian;
  hours = timeSplit[0];
  minutes = timeSplit[1];
  
  var hourz=hours;
  if (hours > 12) {
    meridian = 'PM';
    hours -= 12;
  } else if (hours < 12) {
    meridian = 'AM';
    if (hours == 0) {
      hours = 12;
    }
  } else {
    meridian = 'PM';
  }

 var hourx="2";
  
  

  var result = parseFloat(hourz)+parseFloat(hourx);

var valz=(result + ':' + minutes);

  var vall=(hourz + ':' + minutes);

  var vals="16:00";

  
   if(vall>vals){
	  alert('Please Select Time Before 4PM'); 
       document. getElementById("timeInput"). value = "";	  
       document. getElementById("timeInput1"). value = "";	  
                    
  }else{
	  
	  document.getElementById("timeInput").value = vall;
	  document.getElementById("timeInput1").value = valz;
  } 
  
}
		
 $(document).ready(function(){  
     
	  $("form[name='permission']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);	  
           $.ajax({  
                url:"qvision/Leave_Management/permission/insert_permission.php",  
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
    processData: false,
                success:function(data)  
                {  
					alert('Permission Requested Successfully'); 
                    leave_management()
				
				}				
           });  
      });  
 });  
 </script>
 <script>
 var enputEle = document.getElementById('timeInput1');


function offTimeChanges() {
  var timeSplit = enputEle.value.split(':'),
    hours,
    minutes,
    meridian;
  hours = timeSplit[0];
  minutes = timeSplit[1];
  if (hours > 12) {
    meridian = 'PM';
    hours -= 12;
  } else if (hours < 12) {
    meridian = 'AM';
    if (hours == 0) {
      hours = 12;
    }
  } else {
    meridian = 'PM';
  }
  alert(hours + ':' + minutes + ' ' + meridian);
}
 </script>
 		
	 <script>
	  	/*function leave_request_insert()
			{

				var datas = $('form').serialize();
				alert(datas)
				  $.ajax({
					type: "GET",
					data:datas,
					url:"qvision/Leave_Management/leave_request/insert_leave.php",
					success: function (data) {
						var split = data.split(",");
				 
               //$('#balance_leave').val(split[1]);
						alert("Leave Requested Successfully")
                        leave_management()
					}
				})  
			}  */
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
            url: "qvision/Leave_management/leave_request/share_leave.php",
            success: function (data) {
				//alert(data)
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
	permission()	
	}
	</script>
	</html>
