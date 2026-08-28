<?php
require '../../../connect.php';
$resourceid=$_REQUEST['id'];
$sql=$con->query("SELECT *,s.status as status FROM resource_form_detail s left join jobdescription_master m on s.position=m.id join source_master sm on s.source=sm.id where s.id='$resourceid'");

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
   <h3 class="card-title"><font size="5">Resource Form Edit</font></h3>
    <a onclick="back_to_list()"  style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"></i>Back</a>
  </div>
   <form role="form" method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
	   <tr id="get_name">
		    <td >Source: </td>
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
			<td colspan="5"><input type="date" class="form-control" name="consl_date" id="consl_date" value="<?php echo $fet['date']; ?>">
			</td>
		</tr>
		
        <tr>
			<td>Post Applied for: </td>
			<td colspan="5">
				<input type="text" class="form-control" name="position" id="position" value="<?php echo $fet['tittle']; ?>" readonly>
			</td>	
        </tr>

         <tr>
		    <td >Client Org Name</td>
			<td colspan="5">
			<input type="text" class="form-control" id="client_org_name" name="client_org_name"  value="<?php echo $fet['client_org_name']; ?>"readonly>
			</td>
        </tr> 
	  
		<tr>
		<td>Location</td>
        <td><input type="text" class="form-control" id="location" name="location" value="<?php echo $fet['location']; ?>"readonly></td>
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
			<td>First Name:</td>
			<td colspan="2"><input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $fet['first_name']; ?>" ></td>
			<td>Last Name: </td>
			<td colspan="2"><input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $fet['last_name']; ?>"></td>
        </tr>
		
    <tr>
	 <td>Gender:</td>
	   <td colspan="2">
	     <label>
		<input type="radio" name="gender" value="male" <?php if($fet['gender']=="male"){ echo "checked";} else{ } ?> >&nbsp;Male</label>
	   </td>
	   
	  <td colspan="2">
	   <label>
		<input type="radio" name="gender" value="female" <?php if($fet['gender']=="female"){ echo "checked";} else{ } ?> >&nbsp;Female</label>
		</td>
	</tr>
	
        <tr>
        <td>Mobile Number: </td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $fet['mobile']; ?>" maxlength="10" onchange="CheckIndianNumber(this.value)"> </td>
        </tr>
        <tr>
        <td>WhatsApp Number: </td>
        <td colspan="5"><input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?php echo $fet['whatsapp']; ?>" maxlength="10" onchange="CheckIndianNumber1(this.value)"></td>
        </tr>
        <tr>
        <td>Email ID : </td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" value="<?php echo $fet['mail']; ?>" onchange="ValidateEmail(this.value)"></td>
        </tr>
        <tr>
        <td>Aadhar Number: </td>
        <td colspan="4">
		<input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $fet['aadhar_no']; ?>" maxlength="14"  onchange="validation()">
		</td>
        </tr>
        
		<tr>
		<td colspan="6"><center><b>Educational Qualification</center></b></td>
		</tr>
		<tr>
        <td>Degree: </td>
        <td colspan="4"><input type="text" class="form-control" id="degree" name="degree" value="<?php echo $fet['degree'];?>">
		</td>
        </tr>
		
       <tr>
        <td>University: </td>
        <td colspan="4"><input type="text" class="form-control" id="university" name="university" value="<?php echo $fet['university']; ?>">
		</td>
        </tr>
    
		<tr id='employee_new1'>
		<td>Percentage</td>
        <td colspan="4"><input type="text" class="form-control" id="percentage" name="percentage" value="<?php echo $fet['percentage']; ?>"></td>
        </tr>
		<tr>
        <td>Employement Status:</td>
        <td colspan="4">	
		<input type="text" class="form-control" id="emp_status" name="emp_status" value="<?php echo $fet['employement_status']; ?>" readonly>
		</td>
        </tr>	
      <?php 
      if($fet['employement_status']=="Experience")
     {
	?>
	<tr id='employee_status'>
        <td>Company Name:</td>
        <td colspan="2"><input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $fet['company_name']; ?>" readonly></td>
		<td>No of Year Experience:</td>
        <td colspan="2"><input type="number" class="form-control" id="no_of_year" name="no_of_year" value="<?php echo $fet['year_experience']; ?>" readonly></td>
        </tr>
	<?php
    }
   else
    {
	?>
	<tr id='employee_new'>
		<td>Year of Passout </td>
        <td colspan="4"><input type="text" class="form-control" id="year_of_pass" name="year_of_pass" value="<?php echo $fet['year_of_pass']; ?>"></td>
        </tr>
<?php
   }
   ?>	
   		<tr>
		<td>Resume:<td>
		<a href="qvision/Resource/Resource_form/resume_upload/<?php echo $fet['resume'];?>" download="<?php echo $fet['resume']; ?>"><?php echo $fet['resume']; ?></a>
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
        <td colspan="2"><input type="text" class="form-control" id="certificate" name="certificate" value="<?php echo $fet['certification']; ?>" readonly></td>
		</tr >
		<tr id='validity'>
		<td>Validity:</td>
        <td colspan="2"><input type="text" class="form-control" id="validity" name="validity" value="<?php echo $fet['validity']; ?>" readonly></td>
		<td>Certified From:</td>
        <td colspan="2"><input type="text" class="form-control" id="cer_from" name="cer_from" value="<?php echo $fet['certified_from']; ?>" readonly></td>		
        </tr>
		<?php
		}
		else
		{
			
		}
		?>
		
		<tr>  
        <td colspan="6">
		<input type="hidden" name="rid" id="rid" value="<?php echo $resourceid;?>">
		<input type="button" class="btn btn-success" name="save" onclick="resource_update()" style="float:right;" value="Update"></td>
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

 //Current Date  
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
let date = $('#consl_date').val()
// Set Minimum date, the date is restrict before current date, choose only from current date.
document.getElementById("consl_date").setAttribute("min", date);

})

 function back_to_list()
 {
	 resource_list()
	 
 }
 
function resource_update()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data: data + "&" + "field="+field,
		url:'qvision/Resource/Resource_form/resource_update.php',
		success:function(data)
		{
			data = $.trim(data);
			if(data==0)
			{
				alert("Update Failed");
				resource_list();
			}
			else
			{
			   alert("Updated successfully");	
			   resource_list();
			}	
		},
		error:function(xhr, status, error) {
			alert("Server Error: " + error);
		}
	});
}

function CheckIndianNumber(b)   
    {  
        //var a = /^\d{10}$/;
		var a = /[6-9]{1}[0-9]{9}$/;  
        if (a.test(b))   
        {  
            //alert("Your Mobile Number Is Valid.")  
        }   
        else   
        {  
            alert("Your Mobile Number Is Not Valid.")  
			$('#phone').val('');
        }   
    };
//alternative no	
	function CheckIndianNumber1(b)   
    {  
        //var a = /^\d{10}$/;
		var a = /[6-9]{1}[0-9]{9}$/;  
        if (a.test(b))   
        {  
            //alert("Your Mobile Number Is Valid.")  
        }   
        else   
        {  
            alert("Your Mobile Number Is Not Valid.")  
			$('#whatsapp').val('');
        }   
    };  
	
	//Email address
	 function ValidateEmail(email) 
	 {
		 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            //var address = document.getElementById[email].value;
            if (reg.test(email) == false) 
            {
                alert('Invalid Email Address');
                //return (false);
				$('#mail').val('');
            }
 }
//aadhar 
function validation() {   
    var regexp=/^[2-9]{1}[0-9]{3}\s{1}[0-9]{4}\s{1}[0-9]{4}$/;           
    var x=document.getElementById("adharnumber").value;
    if(regexp.test(x)){
        //window.alert("Valid Aadhar no.");
    }
	else{ 
		window.alert("Invalid Aadhar no.");
		$('#adharnumber').val('');
    }
}
</script>


