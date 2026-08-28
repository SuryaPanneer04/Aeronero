<?php
require '../../connect.php';
include("../user.php");
$userrole = $_SESSION['userrole'];
$user_id=$_SESSION['userid'];

?>
<!DOCTYPE html>
<html>
	<head>
		<style>

		.button {
		  background-color:#ab7ae0;
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

		.button:hover {opacity: 1} 
         
		 .button1{
		  background-color: #03e8fc;
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

		.button1:hover {opacity: 1}
		
		.button2{
		  background-color: #f37fb7;
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

		.button2:hover {opacity: 1}
		
		.button3{
		  background-color: #3c9ae8;
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
		  background-color: #f08080;
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
		
		.button6{
		  background-color: #32cd32;
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

		.button6:hover {opacity: 1}
		.card-body{
			min-width: 1083px;
			max-width: 131% !important;
		}
		</style>
	</head>
	<body>
		<section class="content">
			<div class="card">
				<div class="card-body">
					<!--	<input class="btn button" type="button" value="Staff Leave Master" onclick="leave_master_app()"> -->		
					<input class="btn button3" type="button" value="Leave Request" onclick="leave_request()">
					
					<?php
					if($user_id==4){ 
					?>
					<input class="btn button1" type="button" value="Staff Leave Approve" onclick="leave_app()">
		
					<?php } ?>
				<!--	<input class="btn button2" type="button" value="Staff Leave Update" onclick="leave_update()"> -->
				
					<input class="btn button4" type="button" value="Leave List" onclick="leave_list()">
					<?php
					if($user_id==4){ 
					?>
					<input class="btn button6" type="button" value="Leave Approved List" onclick="keave_aap_list()">
					<input class="btn button5" type="button" value="Leave Reject List" onclick="leave_rej_list()">
					<?php 
					}
					?>
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

	
 function leave_request()
    {
        $.ajax({
            type: "POST",
            url: base_url + "Leave_Management/leave_request/leave_request.php",
            success: function (data) {
                $("#main_content").html(data);
            }
        })
    }
 function leave_master_view()
{
	
	$.ajax({
    type:"GET",
    url:'Leave_Management/leave_master/leave_master_view.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}
function leaves_mapping_view()
{
	$.ajax({
    type:"GET",
    url:'Leave_Management/leave_mapping/leave_mapping_view.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}
function staff_leave_mapping_view()
{
	$.ajax({
    type:"GET",
    url:'Leave_Management/leave_mapping_with_staff/leave_mapping_with_staff.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}

function staff_leave_opening_view()
{
	$.ajax({
    type:"GET",
    url:'Leave_Management/leave_opening/leave_opening_view.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}

function leave_balance_view()
{
	$.ajax({
    type:"GET",
    url:'Leave_Management/leave_balance/leave_balance_view.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}

function leave_request()
{
	$.ajax({
    type:"GET",
    url:'Leave_Management/leave_request/leave_request.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}

function leave_update()
{
	$.ajax({
    type:"GET",
    url:'Leave_Management/leave_request/leave_update.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
} 

function leave_app()
{
	$.ajax({
    type:"GET",
    url:'Leave_Management/leave_request/leave_approve_list.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
} 

function leave_master_app()
{
	$.ajax({
    type:"GET",
    url:'Leave_Management/leave_request/leave_master_form.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}
function leave_list()
    {
        $.ajax({
            type: "POST",
            url:"Leave_Management/leave_request/leave_list.php",
            success: function (data) {
                $("#leave_view").html(data);
            }
        })
    }
	function leave_rej_list()
    {
        $.ajax({
            type: "POST",
            url:"Leave_Management/leave_request/leave_rej_list.php",
            success: function (data) {
                $("#leave_view").html(data);
            }
        })
    }
	function keave_aap_list()
    {
        $.ajax({
            type: "POST",
            url:"Leave_Management/leave_request/leave_aap_list.php",
            success: function (data) {
                $("#leave_view").html(data);
            }
        })
    }
</script>
