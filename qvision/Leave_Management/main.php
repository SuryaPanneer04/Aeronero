<?php
require '../../connect.php';
include("../../user.php");
$userrole = $_SESSION['userrole'];
//echo $userrole;
?>
<script>
function leave_app_list()
{
	$.ajax({
            type: "POST",
            url:"qvision/Leave_Management/leave_request/approved_list.php",
            success: function (data) {
                $("#leave_view").html(data);
            }
        })
}
function leave_reject_list()
{
	$.ajax({
            type: "POST",
            url:"qvision/Leave_Management/leave_request/rejected_list.php",
            success: function (data) {
                $("#leave_view").html(data);
            }
        })
}

</script>
<!DOCTYPE html>
<html>
	<head>
		<style>

		.button {
		  background-color:#ab7ae0;
		  border: none;
		  color: white;
		  padding: 8px 12px;
		  text-align: center;
		  font-size: 15.5px;
		  margin: 10px 6px;
		  opacity: 0.6;
		  transition: 0.3s;
		  display: inline-block;
		  text-decoration: none;
		  cursor: pointer;
		}

		.button:hover {opacity: 1} 
         
		 .button1{
		  background-color: #03e8fc;
		  border: none;
		  color: white;
		  padding: 8px 12px;
		  text-align: center;
		  font-size: 15.5px;
		  margin: 10px 6px;
		  opacity: 0.6;
		  transition: 0.3s;
		  display: inline-block;
		  text-decoration: none;
		  cursor: pointer;
		}

		.button1:hover {opacity: 1}
		
		.button2{
		  background-color: #f37fb7;
		  border: none;
		  color: white;
		  padding: 8px 12px;
		  text-align: center;
		  font-size: 15.5px;
		  margin: 10px 6px;
		  opacity: 0.6;
		  transition: 0.3s;
		  display: inline-block;
		  text-decoration: none;
		  cursor: pointer;
		}

		.button2:hover {opacity: 1}
		
		.button3{
		  background-color: #3c9ae8;
		  border: none;
		  color: white;
		  padding: 8px 12px;
		  text-align: center;
		  font-size: 15.5px;
		  margin: 10px 6px;
		  opacity: 0.6;
		  transition: 0.3s;
		  display: inline-block;
		  text-decoration: none;
		  cursor: pointer;
		}

		.button3:hover {opacity: 1}
		
		.button4{
		  background-color: #d7bc6f;
		  border: none;
		  color: black;
		  padding: 8px 12px;
		  text-align: center;
		  font-size: 15.5px;
		  margin: 10px 6px;
		  opacity: 0.6;
		  transition: 0.3s;
		  display: inline-block;
		  text-decoration: none;
		  cursor: pointer;
		}
		.button5:hover {opacity: 1}
		.button5{
		  background-color: #eb1a1a;
		  border: none;
		  color: black;
		  padding: 8px 12px;
		  text-align: center;
		  font-size: 15.5px;
		  margin: 10px 6px;
		  opacity: 0.6;
		  transition: 0.3s;
		  display: inline-block;
		  text-decoration: none;
		  cursor: pointer;
		}
		.button4:hover {opacity: 1}
		
		
		</style>
	</head>
	<body>
		<!-- <section class="content"> -->
			<div class="card">
				<div class="card-body">
					<!--<input class="btn btn-primary" type="button" value="Leave Master" onclick="leave_master_view()"> 
					<input class="btn btn-success" type="button" value="Leave Mapping" onclick="leaves_mapping_view()">
					<input class="btn btn-warning" type="button" value="Leave Mapping with Staff" onclick="staff_leave_mapping_view()">
					<input class="btn btn-warning" type="button" value="Leave Openings" onclick="staff_leave_opening_view()">
					<input class="btn btn-success" type="button" value="Leave Balance" onclick="leave_balance_view()"><br>-->
					<input class="btn button3" type="button" value="Leave Request" onclick="leave_request()">
					
				<?php 
				$is_hr_menu = (isset($_GET['menu']) && $_GET['menu'] == 'hr') ? true : false;
				if($userrole=="R003" && $is_hr_menu)
				{?>
					<input class="btn button2" type="button" value="Staff Leave Update" onclick="leave_update()">
					<input class="btn button" type="button" value="Staff Leave Master" onclick="leave_master_app()">
					<input class="btn button4" type="button" value="Leave Approve List" onclick="leave_app_list()">
					<input class="btn button5" type="button" value="Leave Rejected List" onclick="leave_reject_list()">
					<?php
					}
					else if($userrole=="R008"){
						?>					
					<input class="btn button1" type="button" value="Staff Leave Approve" onclick="leave_app()">
					<?php } ?>
					
				
				
				</div>
			</div>
			<div class="card">
				<div class="card-body">
				<div id="leave_view">
				</div>
				</div>
			</div>
		</section>
	</body>
</html>


<script>

 function leave_master_view()
{
	
	$.ajax({
    type:"GET",
    url:'qvision/Leave_Management/leave_master/leave_master_view.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}
function leaves_mapping_view()
{
	$.ajax({
    type:"GET",
    url:'qvision/Leave_Management/leave_mapping/leave_mapping_view.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}
function staff_leave_mapping_view()
{
	$.ajax({
    type:"GET",
    url:'qvision/Leave_Management/leave_mapping_with_staff/leave_mapping_with_staff.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}

function staff_leave_opening_view()
{
	$.ajax({
    type:"GET",
    url:'qvision/Leave_Management/leave_opening/leave_opening_view.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}

function leave_balance_view()
{
	$.ajax({
    type:"GET",
    url:'qvision/Leave_Management/leave_balance/leave_balance_view.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}

function leave_request()
{
	$.ajax({
    type:"GET",
    url:'qvision/Leave_Management/leave_request/leave_request.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}

function leave_update()
{
	$.ajax({
    type:"GET",
    url:'qvision/Leave_Management/leave_request/leave_update.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
} 

function leave_app()
{
	$.ajax({
    type:"GET",
    url:'qvision/Leave_Management/leave_request/leave_approve_list.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
} 

function leave_master_app()
{
	$.ajax({
    type:"GET",
    url:'qvision/Leave_Management/leave_request/leave_master_form.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}

</script>
