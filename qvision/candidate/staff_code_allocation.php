<?php
require '../../connect.php';
$cid=$_REQUEST['id'];
$sql=$con->query("select *,c.status as cstatus from candidate_form_details c left join designation_master d on c.position=d.id left join z_department_master dm on c.department=dm.id where c.id='$cid' order by c.id desc limit 1");
//echo "select *,c.status as cstatus from candidate_form_details c left join designation_master d on c.position=d.id left join z_department_master dm on c.department=dm.id where c.id='$cid' order by c.id desc limit 1";
$fet=$sql->fetch();
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
<div class="header">
  <a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"></i>Back</a>
</div>
   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td colspan="6"><center><b>Application for Candidate</b></center></td>
        </tr>
        <tr>
        <td>Post Applied for: *</td>
        <td colspan="5">
		<input type="text" class="form-control" id="companys" name="companys" value="<?php echo $fet['designation_name'];?>" readonly>
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
		<?php
		$deptid = isset($fet['department']) ? $fet['department'] : 0;
		$getdeptname = $con->query("SELECT * FROM `z_department_master` where id='$deptid' and status=1");
		$depnamee = $getdeptname->fetch();
		$dpnameefgeted = $depnamee ? $depnamee['id'] : 0;
		?>
		<input type="hidden" class="form-control" id="department" name="department" value="<?php echo $dpnameefgeted;?>" readonly>
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
        <td colspan="5"><input type="text" class="form-control" id="address" name="address" value="<?php echo $fet['address'];?>" readonly></td>
        </tr>
        <tr>
        <td>Permanent Address:</td>
        <td colspan="5"><input type="text" class="form-control" id="paddress" name="paddress" value="<?php echo $fet['paddress'];?>" readonly></td>
        </tr> -->
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
        <td>Aadhar Number: *</td>
        <td colspan="4"><input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $fet['adharnumber'];?>"readonly></td>
        </tr>
        <!-- <tr>
        <td>Pan Number:</td>
        <td colspan="4"><input type="text" class="form-control" id="pannumber" name="pannumber" value="<?php echo $fet['pannumber'];?>"readonly></td>
        </tr>
        <tr>
        <td>Voter ID:</td>
        <td colspan="4"><input type="text" class="form-control" id="voternumber" name="voternumber" value="<?php echo $fet['voternumber'];?>"readonly></td>
        </tr> -->
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
			<input type="text" class="form-control" id="empstats" name="empstats" value="<?php echo "Fresher";?>"readonly>
				
		</td>
        </tr><tr id='employee_new'>
		<td>Year of Passout </td>
        <td colspan="4"><input type="text" class="form-control" id="year_of_pass" name="year_of_pass" value="<?php echo $fet['year_of_pass'];?>"readonly></td>
        </tr>
			<?php 
		}
		else
		{
			?>
			<tr>
        <td>Employement Status:</td>
        <td colspan="4">	
			<input type="text" class="form-control" id="empstats" name="empstats" value="<?php echo "Experience";?>"readonly>
				
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
		<a href="qvision/Resource/Resource_form/resume_upload/<?php echo $fet['resume'];?>" download="<?php echo $fet['resume']; ?>"><?php echo $fet['resume']; ?></a>
		</tr>

<table class="table table-bordered">
<h3><center>Staff Type</center></h3>
<tr>
<td>Staff Type:*</td>
<td colspan="5">
<select id="staff_type" name="staff_type" class="form-control" onchange="generateStaffCode()"> 
<option value="" data-code="">Select Type</option>
<?php   
$stype=$con->query("select * from prefixcode_master where status=1");
while($sdata=$stype->fetch())
{
?>	
<option value="<?php echo $sdata['id'];?>" data-code="<?php echo $sdata['code'];?>"><?php echo $sdata['name'];?></option>

<?php 	
}

?>
</select><br>
<h3>Staff Code:*</h3>
<input type="text" class="form-control" id="staffcode" name="staffcode" value="" style="width:100%" readonly/>

<script>
function generateStaffCode() {
    var sel = document.getElementById("staff_type");
    var code = sel.options[sel.selectedIndex].getAttribute("data-code");
    var cid = document.getElementById("cid").value;
    if(code && cid) {
        document.getElementById("staffcode").value = code + cid;
    } else {
        document.getElementById("staffcode").value = "";
    }
}
</script>
</td>
</tr>



<tr>
<td colspan="6">
<input type="hidden" name="cid" id="cid" value="<?php echo $cid;?>">
<input type="button" name="staff_code_update" id="staff_code_update" class="btn btn-success" onclick="staff_code_updation();" style="float:right;" value="Update" >
</td>
</tr>
       
        </table>
        
    </form>
    </div>
</div>

<script>
$(document).ready(function()
{
	document.getElementById('site').style.visibility = "hidden";
});

function get_detail(v)
{
	if(v==1)
	{
		document.getElementById('site').style.visibility = "visible";
	    document.getElementById('location').style.visibility = "visible";
    } 

else
{
	document.getElementById('site').style.visibility = "hidden";
	document.getElementById('location').style.visibility = "hidden";
}
}

function get_location(v)
{
	 $.ajax({		
		type:"POST",
		url:"qvision/candidate/site_location.php?sid="+v,
		success:function(data)
		{
			$("#location").html(data);
		}
	});
}

function staff_code_updation()
{
	//debugger;
	var field=1;
	//var emp_code=value("staffcode");
	var empcode = document.getElementById("staffcode").value;
	//alert("code:"+empcode);
 	var data = $('form').serialize();
	$.ajax({
		type:'GET',
	    data: data + "&" + "field=" +field,
		url:'qvision/candidate/update_staff_code.php',
		success:function(data)
		{
			if(data==0)
			{
				alert("Staff Type not updated ");
				//window.location.href="login/logout.php";
				interview_candidate_list();
			}
			else
			{
				console.warn("updatecode:"+data);
				alert("Staff Type updated successfully");
				interview_candidate_list();
			}	
		}       
	}); 
}

function back_ctc()
{
		$.ajax({
		type:'POST',
		url:'qvision/candidate/candidate_list.php',
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
</script>