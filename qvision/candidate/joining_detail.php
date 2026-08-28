<?php
require '../../connect.php';
$cid=$_REQUEST['id'];

$sql=$con->query("select c.status as candidate_status,c.*,d.*,dm.* from candidate_form_details c left join designation_master d on c.position=d.id left join z_department_master dm on c.department=dm.id where c.id='$cid' order by c.id desc limit 1");
$fet=$sql->fetch();
$desgn_name = $fet['designation_name'];
$desgn_id = $fet['position'];
$dep_name = $fet['dept_name'];
$dep_id = $fet['department'];
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

.bold{
	font-weight: bold;
}
</style>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Candidate View</font></h3>
				<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"></i>Back</a>
              </div>


   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td colspan="6"><center><b>Application for Candidate</b></center></td>
        </tr>
	 <form method="POST" enctype="multipart/form-data" id="fupform">	
	    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $cid;?>">

		<tr>
        <td>Designation: *</td>
        <td colspan="2">
		<select class="form-control" id="position" name="position" required>

<?php 
   if(($fet['candidate_status']==1 || $fet['candidate_status']==4 || $fet['candidate_status']==41 || $fet['candidate_status']==100 || $fet['candidate_status']==40)){
?>
		<option value="<?php echo $desgn_id; ?>"> <?php echo $desgn_name; ?></option>	
<?php } ?>

		<option value="">Choose designation</option>
		<?php $stmt1 = $con->query("SELECT * FROM `designation_master` WHERE status='1' AND dep_id!='0'");
		while ($row1 = $stmt1->fetch()) {?>
		<option value="<?php echo $row1['id']; ?>"> <?php echo $row1['designation_name']; ?> </option>
		<?php } ?>
		</select>
		</td>
	


		<td>Department: *</td>
		<td colspan="2">
		<select class="form-control" id="tech_department" name="tech_department" required >

<?php 
   if(($fet['candidate_status']==1 || $fet['candidate_status']==4 || $fet['candidate_status']==41 || $fet['candidate_status']==100 || $fet['candidate_status']==40)){
	?>
		<option value="<?php echo $dep_id; ?>"> <?php echo $dep_name; ?></option>
<?php }  ?>

		<option value="">Choose Department</option>
		<?php $stmt = $con->query("SELECT * FROM z_department_master where status=1");
		while ($row = $stmt->fetch()) {?>
		<option value="<?php echo $row['id']; ?>"> <?php echo $row['dept_name']; ?> </option>
		<?php } ?>
		</select></td>
        </tr>
		
		 <tr>
	      <td> </td>
	      <td colspan="2"> </td>
		  
	<?php if($fet['candidate_status']==5 || $fet['candidate_status']==8 || $fet['candidate_status']==13 || $fet['candidate_status']==16 || $fet['candidate_status']==41 || $fet['candidate_status']==100 ){ ?>
	
		<td colspan="2"> <a onclick="candidate_form()" style="float: right;" data-toggle="modal" class="btn btn-success">UPDATE</a> </td>
		
    <?php } ?>
        </tr>
	</form>
	
	
        <tr>
        <td colspan="6"><center><b>Personal Details</b></center></td>
        </tr>
        <tr>
        <td>First Name: *</td>
        <td colspan="2"><input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $fet['first_name'];?>"  ></td>
		<td>Last Name: *</td>
        <td colspan="2"><input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $fet['last_name'];?>" ></td>
        </tr>
		
     <tr>
	  <td>Gender:</td>
	   <td colspan="2"> 
		  <label> <input type="radio" name="gender" value="male" <?php if($fet['gender']=="male"){ echo "checked";} else{echo "disabled";} ?> >
		  &nbsp;Male </label>  
	   </td>
		
	  <td colspan="2"> 
		  <label> <input type="radio" name="gender" value="female" <?php if($fet['gender']=="female"){ echo "checked";} else{echo "disabled";}?> > &nbsp;Female </label>
	  </td>
    </tr>
		
        <!-- <tr>
        <td>Father's Name:</td>
        <td colspan="5"><input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo $fet['father_name'];?>"readonly></td>
        </tr>
        <tr>
        <td>Date of Birth:</td>
        <td colspan="5"><input type="date" class="form-control" id="dob" name="dob" value="<?php echo $fet['dob'];?>"readonly></td>
        </tr>
        <tr>
        <td>Address Communication: *</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address" value="<?php echo $fet['address'];?>"readonly></td>
        </tr>
        <tr>
        <td>Permanent Address:</td>
        <td colspan="5"><input type="text" class="form-control" id="paddress" name="paddress" value="<?php echo $fet['paddress'];?>" readonly></td>
        </tr> -->
        <tr>
        <td>Mobile Number: *</td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $fet['phone'];?>" onchange="CheckIndianNumber(this.value)" Autocomplete="off" maxlength="10"></td>
        </tr>
       <tr>
        <td>Alternate Mobile Number: </td>
        <td colspan="5"><input type="text" class="form-control" id="a_phone" name="a_phone" value="<?php echo $fet['alternative_phone'];?>" onchange="CheckIndianNumber1(this.value)" Autocomplete="off" maxlength="10"></td>
        </tr>
        <tr>
        <td>Email ID : *</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" value="<?php echo $fet['mail'];?>" onchange="ValidateEmail(this.value)"></td>
        </tr>
        <tr>
        <td>Aadhar Number: *</td>
        <td colspan="4"><input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $fet['adharnumber'];?>"></td>
        </tr>
        <!-- <tr>
        <td>Pan Number:</td>
        <td colspan="4"><input type="text" class="form-control" id="pannumber" name="pannumber" value="<?php echo $fet['pannumber'];?>"readonly></td>
        </tr>
        <tr>
        <td>Voter ID:</td>
        <td colspan="4"><input type="text" class="form-control" id="voternumber" name="voternumber" value="<?php echo $fet['voternumber'];?>"readonly></td>
        </tr>
		<tr>
        <td>Driving License:</td>
        <td colspan="4"><input type="text" class="form-control" id="dl" name="dl" value="<?php echo $fet['driving_license'];?>"readonly></td>
        </tr> -->
		<tr>
        <td>Educational Details: *</td>
        <td colspan="4"><input type="text" class="form-control" id="educationalDetails" name="educationalDetails" value="<?php echo $fet['educationalDetails'];?>"></td>
        </tr>

	 <tr>
        <td>Employement Status:</td>
        <td colspan="4">	
		<select class="form-control" id="EmployeeStatus" name="EmployeeStatus" onchange="emp_status(this.value)">
		<option value="<?php echo $fet['EmployeeStatus']; ?>"><?php echo $fet['EmployeeStatus']; ?></option>
		<option value="">Choose Employeement Status</option>
		<option value="Fresher">Fresher</option>
		<option value="Experience">Experience</option>
		</select>
		</td>
        </tr>
		
		<tr id='employee_new'>
		<td>Year of Passout </td>
        <td colspan="4"><input type="text" class="form-control" id="year_of_pass" name="year_of_pass" value="<?php echo $fet['year_of_pass'];?>" ></td>
        </tr>
		
		<tr id='employee_status'>
        <td>Company Name:</td>
        <td colspan="2"><input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $fet['companyname'];?>"></td>
		<td>No of Year Experience:</td>
        <td colspan="2"><input type="number" class="form-control" id="no_of_year" name="no_of_year" value="<?php echo $fet['no_of_year'];?>"></td>
        </tr>


       <!-- <tr>
		<td>Photo:<td>
		<td><a href="/ssinfo1/qvision/candidate/photo/<?php echo $fet['photo'];?>" download="<?php echo $fet['photo']; ?>"><?php echo $fet['photo']; ?></a></td>
		</tr> -->

		<tr>
		<td>Resume:<td>
		<a href="qvision/Resource/Resource_form/resume_upload/<?php echo $fet['resume'];?>" download="<?php echo $fet['resume']; ?>"><?php echo $fet['resume']; ?></a>
		</tr>


<table class="table table-bordered" id="recruiter_page">
<h3><center>Joining Details</center></h3>
<tbody>
<tr>
<td>Designation</td>
<td colspan="2">
<?php 
$des=$con->query("select * from designation_master where status=1");

?>
<select name="approved_desig" id="approved_desig" class="form-control">
<option value="">Select Designation</option>
<?php 
while($dis=$des->fetch())
{
?>
	<option data-name="<?php echo $dis['designation_name'];?>" value="<?php echo $dis['id'];?>"><?php echo $dis['designation_name'];?></option>
	<?php
}
?>
</select>
</td>
</tr>
<tr>
<td>CTC (Annual basis)</td>
<td colspan="2"><input type="text" class="form-control" id="approved_ctc" name="approved_ctc" ></td>
</tr>
<tr>
<td>Joining Date</td>
<td colspan="2"><input type="date" class="form-control" id="joining_date" name="joining_date" ></td>
</tr>
<tr>
<td>Reporting Person</td>
<td colspan="2">
<?php 
$staf=$con->query("select * from staff_master");
?>
<select name="report_person" id="reporting_person" class="form-control">
<option value="">--Select Reporting Person--</option>
<?php 
while($staid=$staf->fetch())
{
?>
	<option value="<?php echo $staid['emp_name'];?>"><?php echo $staid['emp_name'];?></option>
	<?php
}
?>
</select>
</td>
</tr>

 <table class="table table-bordered">

<tr> 
	<th colspan="4" style="background: darkgray;"><center>  Components </center></th>
	<th colspan="1" style="background: darkgray;"> <center> Per Month</center></th>
	<th colspan="1" style="background: darkgray;"> <center> Per Annum </center></th>
</tr>
<tr>
	<td colspan="4"><b> Fixed Gross Month</b></td>
	<td colspan="1"><input type="text" class="form-control month bold" id="m_grossfixednew" name="m_grossfixednew" value="0"> </td>
	<td colspan="1"><input type="text" class="form-control annual bold" id="p_grossfixednew" name="p_grossfixednew" value="0"  > </td>
</tr>
<tr>
	<td colspan="4">Basic </td>
	<td colspan="1"><input type="text" class="form-control month" id="mbasicnew" name="mbasicnew"  value="0" > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pbasicnew" name="pbasicnew"  value="0" > </td>
</tr>

<tr>
	<td colspan="4"> HRA</td>
	<td colspan="1"><input type="text" class="form-control month" id="mHRAnew" name="mHRAnew" value="0" > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pHRAnew" name="pHRAnew" value="0" > </td>
</tr>
<tr>
	<td colspan="4"> Other Allowances </td>
	<td colspan="1"><input type="text" class="form-control month" id="mOtherallowancesnew" name="mOtherallowancesnew" value="0"  > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pOtherallowancesnew" name="pOtherallowancesnew" value="0"  > </td>
</tr>
<tr>
	<td colspan="4"> Site Allowances</td>
	<td colspan="1"><input type="text" class="form-control month" id="mSiteallowancesnew" name="mSiteallowancesnew" value="0"  > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pSiteallowancesnew" name="pSiteallowancesnew"  value="0" > </td>
</tr>
<tr>
	<td colspan="4"> Advance Bonus</td>
	<td colspan="1"><input type="text" class="form-control month" id="mAdvancenew" name="mAdvancenew" value="0"  > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pAdvancenew" name="pAdvancenew"  value="0" > </td>
</tr>
<tr>
	<td colspan="4"> Employee_PF</td>
	<td colspan="1"><input type="text" class="form-control month" id="mEmployee_PFnew" name="mEmployee_PFnew" value="0"  > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pEmployee_PFnew" name="pEmployee_PFnew" value="0" > </td>
</tr>
<tr>
	<td colspan="4">Employee_ESIC </td>
	<td colspan="1"><input type="text" class="form-control month" id="mEmployee_ESICnew" name="mEmployee_ESICnew" value="0"  > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pEmployee_ESICnew" name="pEmployee_ESICnew" value="0" > </td>
</tr>
<tr>
	<td colspan="4"> Professional_Tax</td>
	<td colspan="1"><input type="text" class="form-control month" id="mProfessional_Taxnew" name="mProfessional_Taxnew" value="0"  > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pProfessional_Taxnew" name="pProfessional_Taxnew"value="0" > </td>
</tr>
<tr>
	<td colspan="4">TDS </td>
	<td colspan="1"><input type="text" class="form-control month" id="mTDSnew" name="mTDSnew" value="0"> </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pTDSnew" name="pTDSnew" value="0" > </td>
</tr>
<tr>
	<td colspan="4"> Club EE</td>
	<td colspan="1"><input type="text" class="form-control month" id="mClubEEnew" name="mClubEEnew" value="0" > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pClubEEnew" name="pClubEEnew" value="0" > </td>
</tr>
<tr>
	<td colspan="4">Total_Deductions_Employee </td>
	<td colspan="1"><input type="text" class="form-control month" id="mTotal_Deductions_Employeenew" name="mTotal_Deductions_Employeenew" value="0"  > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pTotal_Deductions_Employeenew" name="pTotal_Deductions_Employeenew" value="0" > </td>
</tr>
<tr>
	<td colspan="4"><b>Net Salary</b></td>
	<td colspan="1"><input type="text" class="form-control month" id="mnetsalarynew" name="mnetsalarynew" value="0" > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="Pnetsalaryneww" name="Pnetsalaryneww" value="0"> </td>
</tr>
<tr>
	<td colspan="4">Employer_PF</td>
	<td colspan="1"><input type="text" class="form-control month" id="mEmployer_PFnew" name="mEmployer_PFnew" value="0" > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pEmployer_PFnew" name="pEmployer_PFnew"value="0" > </td>
</tr>
<tr>
	<td colspan="4">Employer_ESIC</td>
	<td colspan="1"><input type="text" class="form-control month" id="mEmployer_ESICnew" name="mEmployer_ESICnew" value="0" > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pEmployer_ESICnew" name="pEmployer_ESICnew" value="0" > </td>
</tr>
<tr>
	<td colspan="4"> Club ER</td>
	<td colspan="1"><input type="text" class="form-control month" id="mClubERnew" name="mClubERnew" value="0" > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pClubERnew" name="pClubERnew" value="0" > </td>
</tr>
<tr>
	<td colspan="4">Total_deduction_Employer</td>
	<td colspan="1"><input type="text" class="form-control month" id="mTotal_deduction_Employernew" name="mTotal_deduction_Employernew" value="0" > </td>
	<td colspan="1"><input type="text" class="form-control annual" id="pTotal_deduction_Employernew" name="pTotal_deduction_Employernew" value="0" > </td>
</tr>

<tr>
	<td colspan="4"><b>Fixed</b></td>
	<td colspan="1"><input type="text" class="form-control bold" id="m_fixednew" name="m_fixednew" value="0" > </td>
	<td colspan="1"><input type="text" class="form-control bold" id="p_fixednew" name="p_fixednew" value="0" > </td>
</tr>
</div>

</table>


<?php 
   if(($fet['candidate_status']==1 || $fet['candidate_status']==4 || $fet['candidate_status']==41 || $fet['candidate_status']==100 || $fet['candidate_status']==40 || $fet['candidate_status']==16)){
	?>
<tr>
<td> </td>
<td><input type="button" class="btn btn-success" name="save" id="<?php echo $cid;?>" onclick="joining_update(this.id)" style="float:right;" value="Send provisional offer letter"></td>
</tr>
<?php } ?>

</tbody>
</table>
    </form>
    </div>



<script>

$(document).ready (function(){
	
	$('#employee_status').hide();
    $('#employee_new').hide();

	let employeests = $('#EmployeeStatus').val();

	if(employeests == 'Fresher'){
		$('#employee_status').hide();
        $('#employee_new').show();
	}
	else{
		$('#employee_status').show();
        $('#employee_new').hide();
	}
});

function back_ctc()
{
	
	$.ajax({
		type:"POST",
		url:"qvision/candidate/candidate_list.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
}
	  
	function joining_update(e)
	{ 
	  let des = document.getElementById('approved_desig')
	  let designation = des.options[des.selectedIndex].getAttribute('data-name')

	    let sal_data = $('form').serialize()
		var desig=$('#position').val();
		var ctc=$('#approved_ctc').val();
		var jdate=$('#joining_date').val();
		var phone=$('#phone').val();
		var r_person=$('#reporting_person').val();
		
	// Prevent multiple clicks
	$('#'+e).prop('disabled', true);
	$('#'+e).val('Sending...');

	$.ajax({
	type:"POST",
	data: sal_data,
	url:"qvision/candidate/send_application_form.php?id="+e+"&desig="+desig+"&ctc="+ctc+"&jdate="+jdate+"&phone="+phone+"&designation="+designation+"&report_person="+r_person,//now chnages
	//url:"/ssinfo1/qvision/candidate/send_application_form.php?id="+e+"&desig="+desig+"&ctc="+ctc+"&jdate="+jdate+"&phone="+phone+"&designation="+designation+"&report_person="+r_person,
	success:function(data)
	{
		$('#'+e).prop('disabled', false);
		$('#'+e).val('Send provisional offer letter');
		
		alert("Provisional letter sent successfully");
		
		console.warn("mssssss:"+data);
			interview_candidate_list();
	   $('#table_view').html(data);
	},
	error:function()
	{
		$('#'+e).prop('disabled', false);
		$('#'+e).val('Send provisional offer letter');
		alert("Error in sending provisional letter");
	}
	})
	}

 function candidate_form()
    {
    var id=$('#id').val();
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
	data: data + "&" + "id="+id,
	url:'qvision/candidate/candidate_department_update.php',//now change it
	//url:'/ssinfo1/qvision/candidate/candidate_department_update.php',
    success:function(data)
    {
      if(data==0)
      { 
        alert('Not updated');
        interview_candidate_list();
      }
      else
      {
        alert("Updated Successfully");
		interview_candidate_list();
      }
      
    }       
    }); 
   }

//To calculate the Monthly salary to Annual salary   
function valuetoannum(e){
	let month = e
	let annual = e.parentElement.parentElement.querySelector('.annual')
	annual.value = e.value * 12
}

function valueToGross(){
//    let basic = parseInt(document.getElementById("mbasic").value)
//    let hra = parseInt(document.getElementById("mHRA").value)
//    let lta = parseInt(document.getElementById("mLTA").value)
//    let convy = parseInt(document.getElementById("mConveyance").value)
//    let sa = parseInt(document.getElementById("mSA").value)
   
//    let  b = isNaN(basic) ? 0 : basic;
//    let  h = isNaN(hra) ? 0 : hra;
//    let  l = isNaN(lta) ? 0 : lta;
//    let  c = isNaN(convy) ? 0 : convy;
//    let  s = isNaN(sa) ? 0 : sa;

//    let gross = b + h + l + c + s;

//    document.getElementById('mGS').value = gross ; 
//    document.getElementById('pGS').value = gross * 12 ; 
}

function valueToDeduct(){
	// let provident = parseInt(document.getElementById('memp_pf').value)
	// let insurance = parseInt(document.getElementById('memp_esic').value)
	// let tax = parseInt(document.getElementById('mPT').value)
     
	// let pf = isNaN(provident) ? 0 : provident
	// let esic = isNaN(insurance) ? 0 : insurance
	// let pt = isNaN(tax) ? 0 : tax

	// let total_deduct = pf + esic + pt 
	
	// document.getElementById('mTDEmployee').value = total_deduct
	// document.getElementById('pTDEmployee').value = total_deduct * 12
    
	// let gross_salary = $('#mGS').val()
	// let net = gross_salary -  total_deduct
	
	// document.getElementById('m_netsal').value = net
	// document.getElementById('p_netsal').value = net * 12

}

function valueToEmployerDeduct(){
	// let fund = parseInt(document.getElementById('m_employer_pf').value)
	// let esi = parseInt(document.getElementById('m_employer_esic').value)
     
	// let providentfund = isNaN(fund) ? 0 : fund
	// let Employer_esic = isNaN(esi) ? 0 : esi

	// let employerdeduct = providentfund + Employer_esic 
	// l
	// document.getElementById('m_employer_td').value = employerdeduct
	// document.getElementById('p_employer_td').value = employerdeduct * 12
    
	// //let net_salary = $('#m_netsal').val()
	// let gross_salary = $('#mGS').val()
	// let fixed = parseInt(gross_salary) +  parseInt(employerdeduct)
	
	// document.getElementById('m_fixed').value = fixed
	// document.getEementById('p_fixed').value = fixed * 12

}


//Employeement status
function emp_status(value)
{
	//alert(value);
if(value=="Fresher")
{
$('#employee_status').hide();
$('#employee_new').show();
}
else
{
$('#employee_status').show();
$('#employee_new').hide();
}
}

//Phone number
function CheckIndianNumber(b)   
    {  
		var a = /[6-9]{1}[0-9]{9}$/;  
        if (!(a.test(b)))   
        {  
			alert("Your Mobile Number Is Not Valid.")  
			$('#phone').val('')
        }    
    }

//alternative no	
	function CheckIndianNumber1(b)   
    {  
		var a = /[6-9]{1}[0-9]{9}$/;  
        if (!(a.test(b)))   
        {  
            alert("Your Mobile Number Is Not Valid.")   
			$('#a_phone').val('')
        }     
    } 
	
//Email address
	 function ValidateEmail(email) 
	 {
		 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if (reg.test(email) == false) 
            {
                alert('Invalid Email Address');
				$('#mail').val('');
            }
 }
</script>