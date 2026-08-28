<?php
require '../../../connect.php';
include("../../../user.php");
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
				
			<?php if($userrole  == 'R003' || $userrole  == 'R014' ){  ?>

					<input class="btn button3" type="button" value="Asset" onclick="staff_assets()">
					<input class="btn button5" type="button" value="Company email ID" onclick="mail_generation()">
					<input class="btn button1" type="button" value="Mediclaim Insurance" Onclick="mediclaim_insurance()">	 	
					<input class="btn button4" type="button" value="Life Insurance" onclick="life_insure()">
			<?php } ?>
			<?php if($userrole  == 'R003'){  ?>

			<input class="btn button" type="button" value="Admin view" onclick="asset_view_admin()">
			<?php } ?>

					<input class="btn button6" type="button" value="Asset View" onclick="asset_view_emp()">

				<!-- 	<input class="btn button6" type="button" value="Leave Approved List" >
					<input class="btn button5" type="button" value="Leave Reject List" > -->
					
				</div>
			</div>
			<div class="card">
				<div id="leave_view">
				</div>
			</div>
		</section>
	</body>
</html>

<script>
    function staff_assets()
    {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset/staff_asset.php",
            success: function (data) {
                $("#leave_view").html(data);
            }
        })
    }

	function mail_generation()
    {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset/mail_generation/mail_generate.php",
            success: function (data) {
                $("#leave_view").html(data);
            }
        })
    }

	function life_insure()
    {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset/life_insurance/life_insurance_list.php",
            success: function (data) {
                $("#leave_view").html(data);
            }
        })
    }

	function asset_view_emp()
    {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset/asset_view.php",
            success: function (data) {
                $("#leave_view").html(data);
            }
        })
    }

	function asset_view_admin()
    {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset/admin_access.php",
            success: function (data) {
                $("#leave_view").html(data);
            }
        })
    }

	function mediclaim_insurance()
    {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset/mediclaim_insurance/view_mediclaim.php",
            success: function (data) {
                $("#leave_view").html(data);
            }
        })
    }
</script>
