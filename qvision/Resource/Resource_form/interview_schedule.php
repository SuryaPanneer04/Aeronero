<?php
require '../../../connect.php';
$resourceid=$_REQUEST['id'];
$sql=$con->query("SELECT * FROM resource_form_detail s left join jobdescription_master m on s.position=m.id join source_master sm on s.source=sm.id where s.id='$resourceid'");
$fet=$sql->fetch();
?>
<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.btn-danger{
	background-color: #ed5d00;
    border-color: #ed5d00;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
</style>
<div class="card card-primary">
     <div class="card-header">
	 <h3 class="card-title"><font size="5">Resource Interview Schedule</font></h3>
		<a onclick="back_to_list()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"> </i>Back</a>
     </div>

   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
	   <tr>
		    <td>Source: *</td>
			<td colspan="5">
			<input type="text" class="form-control" name="source" id="source" value="<?php echo $fet['name']; ?>" readonly>
			</td>
      </tr>
	  
	  <?php 
	   if($fet['source']=="2"){
	  ?>  
		<tr id="cname">
			<td>Consultant Name:</td>
			<td colspan="5"><input type="text" class="form-control" name="consl_name" id="consl_name" value="<?php echo $fet['consultant_name']; ?>" readonly>
			</td>
		</tr>
		<?php
	   }
	   else {
		?>
		<tr id="refer_type">
			<td>Referal Type</td>
			<td colspan="5"><input type="text" class="form-control" id="referal_type" name="referal_type" value="<?php echo $fet['referal_type']; ?>" readonly>
			</td>
		</tr>
		
		<tr id="refer_name">
			<td>Referal Name</td>
			<td colspan="5"><input type="text" class="form-control" id="get_ref_name" name="get_ref_name" value="<?php echo $fet['referal_name']; ?>" readonly>
			</td>
		</tr> 
		
	   <?php 
	   }
	   ?>
		<tr>
			<td>Date:</td>
			<td colspan="5"><input type="date" class="form-control" name="consl_date" id="consl_date" value="<?php echo $fet['date']; ?>"readonly >
			</td>
		</tr>
		
        <tr>
			<td>Post Applied for: *</td>
			<td colspan="5">
				<input type="text" class="form-control" name="position" id="position" value="<?php echo $fet['tittle']; ?>"readonly >
			</td>
        </tr>

		<tr>
			<td>Interview Round Level:</td>
			<td colspan="5">
				<input type="text" class="form-control" name="round" id="round" value="<?php echo $fet['interview_round']; ?>"readonly >
			</td>	
        </tr>
		
        <tr>
			<td colspan="6"><center><b>Personal Details</b></center></td>
        </tr>
		
        <tr>
			<td>First Name: *</td>
			<td colspan="2"><input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $fet['first_name']; ?>"readonly></td>
			<td>Last Name: *</td>
			<td colspan="2"><input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $fet['last_name']; ?>"readonly></td>
        </tr>
		
    <tr>
	 <td>Gender:</td>
	  <td colspan="2">
		<label>
		  <input type="radio" name="gender" value="male" <?php if($fet['gender']=="male"){ echo "checked";} else{echo "disabled";} ?> >&nbsp;Male
		</label>
	   </td>
	   
	   <td colspan="2">
	    <label>
		  <input type="radio" name="gender" value="female" <?php if($fet['gender']=="female"){ echo "checked";} else{echo "disabled";}?>>&nbsp;Female
		</label>
	  </td>
	</tr>
	
        <tr>
        <td>Mobile Number: *</td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $fet['mobile']; ?>"readonly></td>
        </tr>
        <tr>
        <td>WhatsApp Number: </td>
        <td colspan="5"><input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?php echo $fet['whatsapp']; ?>"readonly></td>
        </tr>
        <tr>
        <td>Email ID : *</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" value="<?php echo $fet['mail']; ?>"readonly></td>
        </tr>
        <tr>
        <td>Aadhar Number: *</td>
        <td colspan="4">
		<input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $fet['aadhar_no']; ?>"readonly>
		</td>
        </tr>
       
		<tr>
		<td colspan="6"><center><b>Educational Qualification</center></b></td>
		</tr>
		<tr>
        <td>Degree: *</td>
        <td colspan="4"><input type="text" class="form-control" id="degree" name="degree" value="<?php echo $fet['degree']; ?>"readonly>
		</td>
        </tr>
       <tr>
        <td>University: *</td>
        <td colspan="4"><input type="text" class="form-control" id="university" name="university" value="<?php echo $fet['university']; ?>"readonly>
		</td>
        </tr>
     
		<tr id='employee_new1'>
		<td>Percentage</td>
        <td colspan="4"><input type="text" class="form-control" id="percentage" name="percentage" value="<?php echo $fet['percentage']; ?>"readonly></td>
        </tr>
		<tr>
        <td>Employement Status:</td>
        <td colspan="4">	
		<input type="text" class="form-control" id="emp_status" name="emp_status" value="<?php echo $fet['employement_status']; ?>"readonly>
		</td>
        </tr>	
     <?php 
     if($fet['employement_status']=="Experience")
    {
	 ?>
	<tr id='employee_status'>
        <td>Company Name:</td>
        <td colspan="2"><input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $fet['company_name']; ?>"readonly></td>
		<td>No of Year Experience:</td>
        <td colspan="2"><input type="number" class="form-control" id="no_of_year" name="no_of_year" value="<?php echo $fet['year_experience']; ?>"readonly></td>
        </tr>
	<?php
   }
   else
   {
?>
<tr id='employee_new'>
		<td>Year of Passout </td>
        <td colspan="4"><input type="text" class="form-control" id="year_of_pass" name="year_of_pass" value="<?php echo $fet['year_of_pass']; ?>"readonly></td>
        </tr>
<?php
    }
   ?>	
        <tr>
		<td>Resume:<td>
		<a href="/ssinfo1/qvision/Resource/Resource_form/resume_upload/<?php echo $fet['resume'];?>" download="<?php echo $fet['resume']; ?>"><?php echo $fet['resume']; ?></a>
		</tr>	
		
		<tr>
		<td colspan="6"><center><b>Certification Details</center></b></td>
		</tr>
		<tr>
        <td>Certification:</td>
        <td colspan="4">	
		<input type="text" class="form-control" id="cer_status" name="cer_status" value="<?php echo $fet['certification_status']; ?>" readonly>
		</td>
        </tr>		
		<?php 
		if($fet['certification_status']=="YES")
		{
			?>
			
		<tr id='certificate_status'>
        <td>Certificate:</td>
        <td colspan="2"><input type="text" class="form-control" id="certificate" name="certificate" value="<?php echo $fet['certification']; ?>"readonly></td>
		</tr >
		<tr id='validity'>
		<td>Validity:</td>
        <td colspan="2"><input type="text" class="form-control" id="validity" name="validity" value="<?php echo $fet['validity']; ?>"readonly></td>
		<td>Certified From:</td>
        <td colspan="2"><input type="text" class="form-control" id="cer_from" name="cer_from" value="<?php echo $fet['certified_from']; ?>"readonly></td>		
        </tr>
		<?php
		}
		else
		{
			
		}
		?>
		
	   <tr>
		<td colspan="6"><center><b>Interview Schedule</center></b></td>
		</tr>
		<tr id="do">
		<td>Type of Interview:*</td>
        <td colspan="5">
		<select  class="form-control" id="feedback" name="feedback" onchange="get_date(this.value)" required>
		<option value="">-- Select Type of Inerview --</option>
		<?php
		$sel=$con->query("select * from feedback_master where status=1");
		while($dis=$sel->fetch())
		{
		?>	
		<option value="<?php echo $dis['id'];?>"><?php echo $dis['name'];?></option>
		<?php	
		}
		?>
		</select>
		</td>		
		</tr>
		
		<tr id='int_date'>
        <td>Venue:*</td>
        <td colspan="5"><input type="text" class="form-control" id="venue" name="venue"></td>
		</tr>

		<tr id="meet_link">
		<td colspan="1">Application Name:*</td>
		<td colspan="2"><input type="text" class="form-control" id="app_name" name="app_name" Autocomplete="off" required></td>
		<td colspan="1">virtual Meet Link:*</td>
		<td colspan="1"><input type="text" class="form-control" id="meetLink" name="meetLink" Autocomplete="off" required></td>
		</tr>

		<tr>
        <td>Date:*</td>
        <td colspan="5"><input type="date" class="form-control" id="interview_date" name="interview_date" required></td>
		</tr>

		<tr>
		<td>Time:*</td>
		<td colspan="5"><input type="time" class="form-control" id="interview_time" name="interview_time" Autocomplete="off" required></td>
		</tr>

        <tr>  
		<td><input type="hidden" name="rid" id="rid" value="<?php echo $resourceid;?>">
		<input type="hidden" name="jdcode" id="jdcode" value="<?php echo $fet['jdid']; ?>"></td>
        <td colspan="6"><input type="button" class="btn btn-success" name="save" id="send_mail_btn" onclick="schedule_insert()" style="float:right;" value="Send Mail"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>


<script>
$(document).ready(function(){
	var refer = <?php echo json_encode($fet['referal_type']); ?> ;
	
	if(refer==''){
      	$('#refer_type').hide();	
      	$('#refer_name').hide();	
	}

	$('#int_date').hide()
	$('#meet_link').hide()
	

//interview Date  
var mintoday = new Date();
var mindd = mintoday.getDate();
var minmm = mintoday.getMonth()+1; //January is 0 so need to add 1 to make it 1!
var minyyyy = mintoday.getFullYear();
if(mindd<10){
  mindate='0'+mindd
}else{
  mindate=mindd
}
if(minmm<10){
  minmm='0'+minmm
}else{
  minmm=minmm
}	
mintoday = minyyyy+'-'+minmm+'-'+mindate;
// Set Minimum date, the date is restrict before current date, choose only from current date.
document.getElementById("interview_date").setAttribute("min", mintoday);

})

function get_date(v)
{
	var feed=$('#feedback').val();
	if(feed==2) //Address will visible for Interview
	{
		$('#int_date').show()
		$('#meet_link').hide()
	}
	else if(feed==1)  //Virtual Meet Link Will Visible for Interview
	{
		$('#int_date').hide()
		$('#meet_link').show()
	}
}

function schedule_insert()
{
	let feedback = $("#feedback").val()
	let interview_date = $("#interview_date").val()
	let time = $("#interview_time").val()

	if(feedback =='' || interview_date =='' || time ==''){
		alert('Enter the Required Fields');
	}
	else{

	let s_time = time.split(':')
	if(s_time[0] < 12){
       intr_time = time+ "AM";   
	}else{
	   intr_time = time+ "PM";
	}
    	
	// Prevent multiple clicks
	$('#send_mail_btn').prop('disabled', true);
	$('#send_mail_btn').val('Sending...');

	var data=$('form').serialize();
	$.ajax({
		type:"GET",
		data: data,
		url:"qvision/Resource/Resource_form/schedule_insert.php?i_time="+intr_time,
		success:function(data)
		{
			$('#send_mail_btn').prop('disabled', false);
			$('#send_mail_btn').val('Send Mail');
			
			alert("Mail Sent Successfully")
			resource_list()
		},
		error:function()
		{
			$('#send_mail_btn').prop('disabled', false);
			$('#send_mail_btn').val('Send Mail');
			alert("Error in sending mail")
		}
	})
 } 
}

 function back_to_list()
 {
	 resource_list()	 
 }
</script>
