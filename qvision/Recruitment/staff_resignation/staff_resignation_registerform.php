<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
/* 
    /// EVENTS SCHEDULE FOR RESIGNATION AUTO APPROVE AFTER 1 WEEK FROM APPLIED DATE // SUCCESS QUERY ///

CREATE EVENT IF NOT EXISTS resignation_auto_approve ON SCHEDULE AT CURRENT_TIMESTAMP DO UPDATE `resignation_form_details` SET `hod_reason`='Auto Updated' ,`notice_period`=(DATE_SUB(now(), INTERVAL -60 DAY) ),`hod_accept_status`='Yes',`approved_date`=now(),notice_days= 60,`status`=2 ,`modified_by`='0',`modified_on`=now() WHERE (DATE_SUB(`applied_date`, INTERVAL -7 DAY) <= now()) && status = 1


CREATE EVENT `resignation_auto_approve` ON SCHEDULE EVERY 1 DAY STARTS '2023-01-13 10:34:49.000000' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE `resignation_form_details` SET `hod_reason`='Auto Updated' ,`notice_period`=(DATE_SUB(now(), INTERVAL -60 DAY) ),`hod_accept_status`='Yes',`approved_date`=now(),notice_days= 60,`status`=2 ,`modified_by`='0',`modified_on`=now() WHERE (DATE_SUB(`applied_date`, INTERVAL -7 DAY) <= now()) && status = 1  
*/
require '../../../connect.php';
include("../../../user.php");
$candid = isset($_SESSION['candidateid']) ? $_SESSION['candidateid'] : 0;

$emp_id = '';
$emp_name = '';
$reporting_person = '';

if ($con) {
	$staffsel = $con->query("select e.id, e.emp_name, e.reporting_person as rep_id, r.emp_name as report_name from staff_master e left join staff_master r on e.reporting_person = r.id where e.candid_id='$candid'");
	if ($staffsel) {
		$data1 = $staffsel->fetch();
		$emp_id = isset($data1['id']) ? $data1['id'] : '';  //Emp Staff Master ID.
		$emp_name = isset($data1['emp_name']) ? $data1['emp_name'] : '';
		$reporting_person = isset($data1['report_name']) ? $data1['report_name'] : '';
		
		$current_user = isset($_SESSION['username']) ? $_SESSION['username'] : 'UNKNOWN';
		$db_error = "Logged in as: " . $current_user . " | candid_id: " . $candid . " | report_name: " . $reporting_person;
	} else {
	    $errorInfo = $con->errorInfo();
		$db_error = "SQL Error: " . (isset($errorInfo[2]) ? $errorInfo[2] : 'Unknown SQL error');
	}
}
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">

<style>
    .textheight{
        height: 300px !important;

    }
</style>

</head>
   <div class="card card-primary">
<div id="salary_view"  style="font-family:'Times New Roman', Times, serif;float:left;width:100%;height:100%;position: absolute;top: 150px;left: 50px;">  </div>

     <div class="card-header">
        <center><h3 class="card-title"><b>E-Resignation </b></h3></center>
		<!-- DEBUG INFO: candid=<?php echo $candid; ?> | emp_id=<?php echo $emp_id; ?> | emp_name=<?php echo $emp_name; ?> -->
        <a onclick="back_to_resignationform()" style="float: right;" data-toggle="modal" class="btn">Back</a>
    </div>
			
   <form method="POST" enctype="multipart/form-data" id="resign_form">
    <!-- Post -->
    <table class="table table-bordered">
      
        <tr>
			<td colspan="6">
				<center><b>Resignation Form</b></center>
				<center><span style="color:red; font-size:12px;"><?php echo isset($db_error) ? $db_error : ''; ?></span></center>
			</td>
        </tr>
	   
        <tr>
		<td> Reporting Person :</td>
        <td>
            <input type="text" class="form-control" id="report_to" name="report_to" value="<?php echo htmlspecialchars($reporting_person); ?>" readonly>
        </td>
		</tr>

        <tr>
		<td> Date of Resignation :</td>
        <td>
            <input type="text" class="form-control" id="dor" name="dor" value="<?php echo date('d-m-Y'); ?>" readonly>
        </td>
		</tr>

		<tr>
		<td>Reason of Relieving :</td>
        <td>
            <textarea class="form-control " id="relieve_reason" name="relieve_reason"> </textarea>
        </td>
		</tr>

		<!-- <tr>
		<td>Remarks :</td>
        <td>
            <input type="text" class="form-control" id="remarks" name="remarks">
            <textarea class="form-control textheight" id="remarks" name="remarks"> </textarea>
        </td>
		</tr> -->

        <tr>
		<td>Upload Resignation Letter :</td>
        <td>
            <input type="file" class="form-control" id="resignation_letter" name="resignation_letter[]">
        </td>
		</tr>
			
		 
        <tr>  
        <td colspan="6">
            <!-- <input type="button" class="btn btn-success" name="save" onclick="resign_form()" style="float:right;" value="submit"> -->
            <input type="submit" class="btn btn-success" name="save"  style="float:right;" value="submit" >
        </td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

 

<script>
    $(document).ready(function(){
        $('#salary_view').hide();

    // Submit form data via Ajax
    $("#resign_form").on('submit', function(e){
        e.preventDefault();
        
         $('#salary_view').show();
        $("#salary_view").html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');

        $.ajax({
            type: 'POST',
            url:'qvision/Recruitment/staff_resignation/resignation_submit.php',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success:function(data)
		    {   
			data = $.trim(data);
            if(data==0){ 
              alert("Form Data has not been Submitted");
              $('#salary_view').hide();
		      staff_resignation_form()
            }
            else{
              alert("Form Data has been Submitted");
              $('#salary_view').hide();
		      staff_resignation_form()
            }
		    },
            error:function(xhr, status, error) {
                alert("Server Error: " + error);
                $('#salary_view').hide();
            }
        });
    });

});

// function resign_form()
// {
// 	var data = $('form').serialize();
// 	$.ajax({
// 		type:'GET',
// 		data: data,
// 		url:'qvision/Recruitment/staff_resignation/resignation_submit.php',
// 		success:function(data)
// 		{	
// 			alert("Form Data has been Submitted Successfully");
// 			staff_resignation_form()
// 		}       	
// 	});
// }

function back_to_resignationform(){
    staff_resignation_form()
}


</script>
