<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$candidid=$_SESSION['candidateid'];
//echo $candidid;
$jid=$_REQUEST['jid'];
$sql=$con->query("SELECT *,j.status as status,j.id as jid,j.created_by FROM `jobdescription_form_details` j join jobdescription_master m on j.jobdescription_id=m.id where j.id='$jid'");

$sfet=$sql->fetch();
$status = $sfet['status'];
$approve = $sfet['approval_level'];
$round = $sfet['interview_round_level'];
//$reporting_person = $sfet['reportingPerson'];

// $reportingId = $con -> query("Select candid_id from staff_master where id='$reporting_person'");
// $staffId = $reportingId -> fetch();
// $reportingPersonID = $staffId['candid_id']; 
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<style>
.card-primary:not(.card-outline)>.card-header{
	background-color:#009EE3 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}
/* .btn-danger {
    background-color: #1da348;
    border-color: #1da348;
} */
/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 400px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: #bdbdbd;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 25px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
   
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
 
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
</head>

<div class="card card-primary">
<div class="card-header">
<h3 class="card-title"><font size="5">Job Description</font></h3>
<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"> </i>Back</a>
</div>

<div class="card-body">
<div class="table-responsive">
<form method="POST" id="fupform" autocomplete="off">
<table class="table table-bordered">
	   <tr>
		    <td>JD Title</td>
			<td colspan="5">
			<input type="text" class="form-control" id="jd_title" name="jd_title" value="<?php echo $sfet['tittle']; ?>"readonly >
			</td>
      </tr>

	 <!-- <tr>
		    <td>Approval Level</td>
			<td colspan="5">
			<input type="text" class="form-control" id="approve" name="approve" value="<?php echo $sfet['approval_level']; ?>"readonly >
			</td>
      </tr>-->

	  <!-- <tr>
		    <td>Interview Round Level</td>
			<td colspan="5">
			<input type="text" class="form-control" id="round" name="round" value="<?php echo $sfet['interview_round_level']; ?>"readonly >
			</td>
      </tr> -->
		
		<tr>
		<td>Location</td>
        <td><input type="text" class="form-control" id="location" name="location" value="<?php echo $sfet['location']; ?>"readonly></td>
		</tr>
		
		<!-- <tr>
		<td>Shift Timing (24 Hrs) </td>
        <td><input type="text" class="form-control" id="shift_timing" name="shift_timing" value="<?php echo $sfet['shift_timing'];?>" readonly></td>
		</tr>
		
		<tr>
		<td>Weekly Off </td>
        <td><input type="text" class="form-control" id="weekly_off" name="weekly_off" value="<?php echo $sfet['weekly_off'];?>" readonly></td>
		</tr>
		
		<tr>
		<td>Experience</td>
        <td><input type="text" class="form-control" id="experience" name="experience" value="<?php echo $sfet['experience']; ?>"readonly></td>
		</tr>
		
		<tr>
		<td>Education Qualification</td>
        <td><input type="text" class="form-control" id="education" name="education" value="<?php echo $sfet['education']; ?>"readonly></td>
		</tr> -->
		
		<!-- <tr>
		<td>Certification</td>
        <td><input type="text" class="form-control" id="certificate" name="certificate" value="<?php echo $sfet['certifications']; ?>"readonly></td>
		</tr>

		<tr>
		<td>Roles & Responsibilities</td>
        <td><input type="text" class="form-control" id="roles" name="roles" style="height: 176px;" value="<?php echo $sfet['roles']; ?>"readonly></td>
		</tr>

		<tr>
		<td>Skills Required</td>
        <td><input type="text" class="form-control" id="skills" name="skills" style="height: 176px;" value="<?php echo $sfet['skills']; ?>"readonly></td>
		</tr>

		<tr>
		<td>Initiate Date</td>
        <td colspan="2"><input type="text" class="form-control" id="date_joining" name="date_joining" value="<?php echo $sfet['joining_date']; ?>"readonly></td>
        </tr> -->

		<!-- <tr>
		<td>Date To Be Closed</td>
        <td colspan="2"><input type="text" class="form-control" id="date_close" name="date_close" value="<?php echo $sfet['closed_date']; ?>"readonly></td>
        </tr>

		<tr>
		<td>Replacement For</td>
        <td colspan="2">
		<?php
		$person=$sfet['replacement'];
		if($person == ''){
	    ?>		 
		 <input type="text" class="form-control" id="replacement" name="replacement" value="NIL" readonly>
		<?php
		}
		else if($person == 'new')
		{
			?>
					 <input type="text" class="form-control" id="replacement" name="replacement" value="New" readonly>

			<?php
			
		}
		else{
		$replace1=$con->query("SELECT emp_name FROM staff_master where id='$person'");
		$refet=$replace1->fetch();
		?>
		<input type="text" class="form-control" id="replacement" name="replacement" value="<?php echo $refet['emp_name']; ?>" readonly>
		<?php } ?> </td>
        </tr>
		
		<tr>
		<td>CTC PA (In Lakhs)</td>
        <td colspan="2"><input type="text" class="form-control" id="ctc" name="ctc" value="<?php echo $sfet['ctc']; ?>" readonly></td>
        </tr>
		
	  <tr>
		<td>No Of Position</td>
        <td colspan="2"><input type="text" class="form-control" id="no_of_postion" name="no_of_postion" value="<?php echo $sfet['no_of_position']; ?>" readonly></td>
       </tr>
	   <!-- <input type="hidden" id="report_person" name="report_person" value="<?php echo $reportingPersonID;?>">  -->
		
	   <?php 
	   		$approved_by=$sfet['flag'];
		if($approved_by){
		    $test = explode(',',$sfet['flag']);
		?> -->
	   <tr>
		<td>Approved by</td>
        <td colspan="2">
		<?php
		for($i=0;$i<count($test);$i++){
		$approval=$con->query("SELECT id,emp_name FROM staff_master where candid_id='$test[$i]'");
		$jd_approval_by=$approval->fetch();
		$by_approved[]= $jd_approval_by['emp_name'];
		}
		?>
		<input type="text" class="form-control" id="approve_by" name="approve_by" value="<?php foreach($by_approved as $key => $value) {  echo  $value,' ,  '; } ?>" readonly></td>
       </tr>
<?php } ?>


	<?php
        if($status==6){ //Approve to CEO 
	?>
       <tr>	
        <td colspan="2">	  
         <input type="button" class="btn btn-success" id="save" name="save" data-id="<?php echo $sfet['jid']; ?>" onclick="approve_jd(<?php echo $sfet['jid']; ?>)"  value="Approve Job Description">
		<input type="button" class="btn btn-danger" id="save1" name="save1[]"  onclick="openForm(<?php echo $sfet['jid'];?>)"  value="Reject with Remark">
		</td>
		</tr>

		<?php
	 }else if($status==6 && $approve==2){
       ?>  
		<tr>	
        <td colspan="2">	   
         <input type="button" class="btn btn-success" id="save" name="save" data-id="<?php echo $sfet['jid']; ?>" onclick="approve_jd(<?php echo $sfet['jid']; ?>)"  value="Approve">
		<input type="button" class="btn btn-danger" id="save1" name="save1[]"  onclick="openForm(<?php echo $sfet['jid'];?>)"  value="Reject with Remark">
		</td>
		</tr>
     <?php
	 }
		?>
	</table>
	</form>
     </div>
              <!-- /.card-body -->
     </div>
<div class="form-popup" id="myForm">
		  <form action="" class="form-container">
			<h3>Reject Remark</h3>
			
			<input type="text" placeholder="Enter Remark" name="remark" id ="remark" required>
          
			<button type="button" class="btn" id="popup" onclick="reject_jd(<?php echo $sfet['jid']; ?>)">Submit</button>
			<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
		  </form>
		</div>

<script>
function back()
	{
		job_description_approval()
	}

 function approve_jd(V)
{
	// debugger;
	var data  = $('form').serialize(); 
	$.ajax({
	type:'POST',
	data:data,
	url:'qvision/Resource/jobdescription_form/job_description_approval_update.php?jid='+V,
	success:function(data)
	{  
        if(data.trim() == 'Md only update') {
            alert("Only MD can approve this Job Description.");
        } else {
		    alert("Approved Successfully");
		    job_description_approval();
        }
	}       
	});
}

 function reject_jd(V)
{
	let remark = $('#remark').val()
	let approve = $('#approve').val()
	//let reporting = $('#report_person').val()  // +"&reportingPerson="+reporting
	$.ajax({
	type:'POST',
	url:'qvision/Resource/jobdescription_form/job_description_reject.php?jid='+V+"&remark="+remark+"&approve="+approve,
	success:function(data)
	{      
		alert("Rejected");
		job_description_approval()
	}       
	});
}

 function openForm() {
  document.getElementById("myForm").style.display = "block";
  $('#remark').val('');
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
} 
</script>
