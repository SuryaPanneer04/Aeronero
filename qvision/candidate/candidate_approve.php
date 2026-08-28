<?php
require '../../connect.php';
$cid=$_REQUEST['id'];
$accept_id=$_REQUEST['accept_id'];

$sql=$con->query("select *,c.status as cstatus,c.interview_round_level as round from candidate_form_details c left join jobdescription_master d on c.position=d.id left join z_department_master dm on c.department=dm.id where c.id='$cid' order by c.id desc limit 1");
$fet=$sql->fetch();
$rid=$fet['resource_id'];
$status=$fet['cstatus'];
?>
<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
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
	     <h3 class="card-title"> <b>Candidate Details View</b></h3>
		<a onclick="to_list()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"> </i>Back</a> <br>
     </div>

   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">		
        <tr>
        <td colspan="6"><center><b>Application for Candidate</b></center></td>
        </tr>
	
	<?php
    $sql4=$con->query("select c.id,c.position,c.status as c_status, dm.designation_name as dsgn_name from candidate_form_details c  left join designation_master dm on c.position=dm.id where c.id='$cid'");
	
	$fet4=$sql4->fetch(PDO::FETCH_ASSOC);
    $status= $fet4['c_status'];
	 
	?>
       
	  <?php 
	  if($status == 40 || $status == 19 || $status ==20 || $status ==22 || $status ==23 || $status ==100 ){
	?>
	     <tr>
        <td>Post Applied for: *</td>
        <td colspan="5">
		<input type="text" class="form-control" id="position" name="position" value="<?php echo $fet4['dsgn_name'];?>" readonly>
		</td>
        </tr>
		
	  <?php } else { ?>
	  
	    <tr>
        <td>Post Applied for: *</td>
        <td colspan="5">
		<input type="text" class="form-control" id="position" name="position" value="<?php echo $fet['tittle'];?>" readonly>
		</td>
        </tr>
		
	<?php } ?>
	  
	    <tr>
			<td>Interview Round Level:</td>
			<td colspan="5">
				<input type="text" class="form-control" name="round" id="round" value="<?php echo $fet['round']; ?>"readonly >
			</td>	
        </tr>

        <tr>
        <td colspan="6"><center><b>Personal Details</b></center></td>
        </tr>
		
        <tr>
        <td>First Name: *</td>
        <td colspan="2"><input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $fet['first_name'];?>" readonly ></td>
		<td>Last Name: *</td>
        <td colspan="2"><input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $fet['last_name'];?>" readonly></td>
        </tr>
		
    <tr>
	  <td>Gender:</td>
	   <td colspan="2"> 
		  <label> <input type="radio" name="gender" value="male" <?php if($fet['gender']=="male"){ echo "checked";} else{echo "disabled";} ?> >
		  &nbsp;Male </label>  
	   </td>
		
	  <td colspan="2"> 
		  <label> <input type="radio" name="gender" value="female" <?php if($fet['gender']=="female"){ echo "checked";} else{echo "disabled";}?> >
		  &nbsp;Female </label>
	  </td>
    </tr>
		
        <tr>
        <td>Mobile Number: *</td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $fet['phone'];?>" readonly></td>
        </tr>
		
       <tr>
        <td>Alternate Mobile Number: </td>
        <td colspan="5"><input type="text" class="form-control" id="a_phone" name="a_phone" value="<?php echo $fet['alternative_phone'];?>"readonly></td>
        </tr>
		
        <tr>
        <td>Email ID : *</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" value="<?php echo $fet['mail'];?>"readonly></td>
        </tr>
		
        <tr>
        <td>Aadhar Number: </td>
        <td colspan="4"><input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $fet['adharnumber'];?>"readonly></td>
        </tr>
		
		<tr>
        <td>Educational Details: *</td>
        <td colspan="4"><input type="text" class="form-control" id="educationalDetails" name="educationalDetails" value="<?php echo $fet['educationalDetails'];?>"readonly></td>
        </tr>
			
			<?php 
		if($fet['EmployeeStatus']=="Fresher")
		{
			?>
			
		<tr>
        <td>Employement Status:</td>
        <td colspan="4">	
			<input type="text" class="form-control" id="EmployeeStatus" name="EmployeeStatus" value="<?php echo "Fresher";?>" readonly>
				
		</td>
        </tr>
		
		<tr id='employee_new'>
		<td>Year of Passout </td>
        <td colspan="4"><input type="text" class="form-control" id="year_of_pass" name="year_of_pass" value="<?php echo $fet['year_of_pass'];?>" readonly></td>
        </tr>
		
			<?php 
		}
		else
		{
			?>
			
		<tr>
        <td>Employement Status:</td>
        <td colspan="4">	
			<input type="text" class="form-control" id="EmployeeStatus" name="EmployeeStatus" value="<?php echo "Experience";?>"readonly>
				
		</td>
        </tr>
		
		<tr id='employee_status'>
        <td>Company Name:</td>
        <td colspan="2"><input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $fet['companyname'];?>"readonly></td>
		<td>No of Year Experience:</td>
        <td colspan="2"><input type="number" class="form-control" id="no_of_year" name="no_of_year" value="<?php echo $fet['no_of_year'];?>"readonly></td>
        </tr>
		
			<?php 
		}
			?>
        
		<tr>
		<td>Resume:<td>
		<a href="qvision/Resource/Resource_form/resume_upload/<?php echo $fet['resume'];?>" download="<?php echo $fet['resume']; ?>" style="font-weight: 900;"><?php echo $fet['resume']; ?></a>
		</tr>
 </table>
        <!-- /.post -->

<?php
$sqll=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,count(*) as hrow FROM candidate_round_details c left join staff_master s on c.person_id=s.id left join interview_rounds i on c.round_id=i.id where c.candid_id='$cid' and c.status='35'");
$cnt=1;
$k=0;
$hrows11 = $sqll->fetch(PDO::FETCH_ASSOC);
if($hrows11['hrow']!=0){
?>

<table class="table table-bordered" id="hr">
<h3><center>HR Department</center></h3>
<tr> 
<td>HR Name</td>
<td colspan="2"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $hrows11['ename']; ?>" readonly></td>
</tr>
</table>


<table class="table table-bordered" id="recruiter_page_hr">
<!-- <h3><center>HR Round Feedback Details</center></h3> -->
<tbody>
<?php
$sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,c.*,s.*,i.*,d.*,r.* FROM candidate_round_details c 
join staff_master s on c.person_id=s.id 
join interview_rounds i on c.round_id=i.id 
JOIN hr_domain_entries d ON c.candid_id=d.candids_id
join interview_round_name r on d.round_name_id=r.id where c.candid_id='$cid' and c.status='35'");
$cnt=1;
$k=0;
while($hrows2 = $sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<td><?php echo  $hrows2['Sec_name']; ?></td>
<td colspan="2">
<input type="text" class="form-control" id="section_name1" name="section_name1" value="<?php echo  $hrows2['feedback']; ?>" readonly></td>
</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }?>
 </tbody>
  </table> 
<?php
}

$accept_dtime= $con->query("SELECT `id`,`candidateID`,`staff_id`,`available_date`,`available_time` FROM `candidate_accept_reject` where id='$accept_id'");
$datetime = $accept_dtime->fetch();
$approvedBystaff = $datetime['staff_id'];

$staff_name =$con->query("select emp_name from staff_master where id ='$approvedBystaff'");
$Byname = $staff_name->fetch();
?>
 
 <!-- schedule interview to candidate after Manager accept the candidate  -->
<table class="table table-bordered"> 
<tr>
	<td colspan="6"><center><b>Interview Schedule</center></b></td>
</tr>
<tr>
	<td>Manager Name </td>
	<td colspan="5"><input type="text" class="form-control" name="acceptedBy" value="<?php echo $Byname['emp_name'];?>" readonly></td>
</tr>
<tr>
	<td>Available Date & Time </td>
	<td><input type="text" class="form-control" name="accept_date" value="<?php echo $datetime['available_date'];?>" readonly></td>
	<td><input type="text" class="form-control" name="accept_time" value="<?php echo $datetime['available_time'];?>" readonly></td>
</tr>
<tr>
<td>Round </td>
		<td colspan="5">
		<select class="form-control" id="round_type" name="round_type" onchange="chng_qn(this.value)">
		<option value="">Select round</option>
		<?php $stmt22 = $con->query("SELECT * FROM interview_rounds where status=1");
		while ($row22 = $stmt22->fetch()) 
		{
		?>
		<option value="<?php echo $row22['id'];?>"> <?php echo $row22['name'];?></option>
		<?php 
		}
		?>
		</select>
		</td>
	</tr>
	
	<tr id="change_qn">
	 
   </tr>	

		<tr id="do">
		<td>Type of Interview:*</td>
        <td colspan="5">
		<select  class="form-control" id="feedback" name="feedback" onchange="get_date(this.value)" required>
		<option value="">-- Select Type of Interview --</option>
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
		<td><input type="hidden" name="rid" id="rid" value=" "> </td>
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="send_mailto_candidate(<?php echo $accept_id; ?>)" style="float:right;" value="Send Mail"></td>
        </tr>
</table>

    </form>
    </div>

<script>
$(document).ready(function(){
	$('#int_date').hide()
	$('#meet_link').hide()
})

 function to_list()
 {
	 interview_candidate_list(); 
 }

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

function send_mailto_candidate(id)
{
	//alert(id);
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
    	
	var data=$('form').serialize();
	$.ajax({
		type:"GET",
		data: data,
		url:"qvision/candidate/send_interview_mail.php?i_time="+intr_time+"&accept_id="+id,
		success:function(data)
		{
			alert("Mail Sent Successfully");
			interview_candidate_list();
		}
	})
 } 
}
function chng_qn(v)
{
	  $.ajax({
		type:"GET",
		url:"qvision/candidate/get_qn.php?id=" +v,
		success:function(data)
		{
			$('#change_qn').html(data);
		}
		
	})  
}
</script>