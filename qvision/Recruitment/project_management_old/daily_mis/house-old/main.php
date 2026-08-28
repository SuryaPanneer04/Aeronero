<?php
require '../../../../../connect.php';
require '../../../../../user.php';

$userrole = $_SESSION['userrole'];
?>
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
		
		</style>
	</head>
	<body>
		<section class="content">
			<div class="card">
				<div class="card-body">
					<!--<input class="btn btn-primary" type="button" value="Leave Master" onclick="leave_master_view()"> 
					<input class="btn btn-success" type="button" value="Leave Mapping" onclick="leaves_mapping_view()">
					<input class="btn btn-warning" type="button" value="Leave Mapping with Staff" onclick="staff_leave_mapping_view()">
					<input class="btn btn-warning" type="button" value="Leave Openings" onclick="staff_leave_opening_view()">
					<input class="btn btn-success" type="button" value="Leave Balance" onclick="leave_balance_view()"><br>-->
					<input class="btn button2" type="button" value="Attire Form" onclick="attire_soww()">
					
					<input class="btn button1" type="button" value="House Keeping Sheet" onclick="house()">				
<?php if($userrole == 'R002' || $userrole == 'R001' || $userrole == 'R003' || $userrole == 'ROLE-017' || $userrole == 'R007'){ ?>					
					<input class="btn button" type="button" value="Attire Reports" onclick="attire_reports()">
					<input class="btn button3" type="button" value="House Reports" onclick="house_reports()">
				<!--	<input class="btn button" type="button" value="Staff Leave Master" onclick="leave_master_app()">-->
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
function attire_soww()
    {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/project_management/daily_mis/attire_form/attire/attire.php",
            success: function (data) {
                $("#main_content").html(data);
            }
        })
    }
 
 function house()
{
	
	$.ajax({
    type:"GET",
    url:"qvision/Recruitment/project_management/daily_mis/attire_form/house/house.php",
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}

function attire_reports()
    {
        $.ajax({
            type: "GET",
            url: "qvision/Recruitment/project_management/daily_mis/attire_form/attire/reports.php",
            success: function (data) {
                $("#leave_view").html(data);
            }
        })
    }
	function house_reports()
    {
        $.ajax({
            type: "GET",
            url: "qvision/Recruitment/project_management/daily_mis/attire_form/house/reports.php",
            success: function (data) {
                $("#leave_view").html(data);
            }
        })
    }
	function attire()
    {
        $.ajax({
            type: "GET",
            url: "qvision/Recruitment/project_management/daily_mis/attire_form/attire/attire.php",
            success: function (data) {
                $("#leave_view").html(data);
            }
        })
    }
</script>
