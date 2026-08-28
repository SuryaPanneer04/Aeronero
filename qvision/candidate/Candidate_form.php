<?php
require '../../connect.php';
include('../../user.php');

include_once("function.php");
$resource_id=$_SESSION['resource_id'];
$new=new DB_con ();
$fetch=$new->fetchdata($resource_id);
$fet=$fetch->fetch();
?>
<div class="card card-primary">
   <form id="fupForm1" method="POST" action="/ssinfo1/qvision/candidate/candidate_submit.php" enctype="multipart/form-data" >
 
    <table class="table table-bordered">
   	  <tr>
        <td colspan="6"><center><b>Application for Candidate</b></center></td>
        </tr>
	
		<tr>
			<td>Post Applied for: </td>
			<td colspan="5">
				<input type="text" class="form-control" id="position" name="position" value="<?php echo $fet['tittle']; ?>" readonly></td>	
			</td>
		</tr>
        <tr>
        <td colspan="6"><center><b>Personal Details</b></center></td>
        </tr>
		
        <tr>
        <td>First Name: </td>
        <td colspan="2"><input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $fet['first_name']; ?>" readonly ></td>
		<td>Last Name: </td>
        <td colspan="2"><input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $fet['last_name']; ?>" readonly></td>
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
        <td>Father's Name:</td>
        <td colspan="5"><input type="text" class="form-control" id="father_name" name="father_name" Autocomplete="off"></td>
        </tr>
		
        <tr>
        <td>Date of Birth:</td>
        <td colspan="5"><input type="date" class="form-control" id="dob" name="dob" Autocomplete="off"></td>
        </tr>
		
        <tr>
        <td>Communication Address: </td>
        <td colspan="5"><input Autocomplete="off" type="text" class="form-control" id="address" name="address" required></td>
        </tr>
		
        <tr>
        <td>Permanent Address:</td>
        <td colspan="5"><input Autocomplete="off" type="text" class="form-control" id="paddress" name="paddress" ></td>
        </tr>
		
        <tr>
        <td>Mobile Number: </td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $fet['mobile']; ?>" readonly></td>
        </tr>
		
       <tr>
        <td>Alternate Mobile Number: </td>
        <td colspan="5"><input type="text" class="form-control" id="a_phone" name="a_phone" value="<?php echo $fet['whatsapp']; ?>" ></td>
        </tr>
		
        <tr>
        <td>Email ID : </td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" value="<?php echo $fet['mail']; ?>" readonly></td>
        </tr>
		
        <tr>
        <td>Aadhar Number:* </td>
        <td colspan="4"><input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $fet['aadhar_no']; ?>" ></td>
        </tr>
		
        <tr>
        <td>Pan Number:</td>
        <td colspan="4"><input Autocomplete="off" type="text" class="form-control" id="pannumber" name="pannumber"></td>
        </tr>
		
        <tr>
        <td>Voter ID (Optional):</td>
        <td colspan="4"><input  Autocomplete="off" type="text" class="form-control" id="voternumber" name="voternumber"></td>
        </tr>
		
		<tr>
        <td>Driving License (Optional):</td>
        <td colspan="4"><input  Autocomplete="off" type="text" class="form-control" id="dl" name="dl"></td>
        </tr>
		
		<tr>
        <td>Educational Details: </td>
        <td colspan="4"><input type="text" class="form-control" id="educationalDetails" name="educationalDetails" value="<?php echo $fet['degree']; ?>" readonly></td>
        </tr>
		
        <tr>
        <td>Employement Status:</td>
        <td colspan="4">	
		<input type="text" class="form-control" id="EmployeeStatus" name="EmployeeStatus"  value="<?php echo $fet['employement_status']; ?>" readonly>
		</td>
        </tr>
		
		<tr id='employee_new'>
		<td>Year of Passout </td>
        <td colspan="4"><input type="text" class="form-control" id="year_of_pass" name="year_of_pass" value="<?php echo $fet['year_of_pass']; ?>" readonly ></td>
        </tr>
		
		<tr id='employee_status'>
        <td>Company Name:</td>
        <td colspan="2"><input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $fet['company_name']; ?>" readonly></td>
		
		<td>No of Year Experience:</td>
        <td colspan="2"><input type="text" class="form-control" id="no_of_year" name="no_of_year" value="<?php echo $fet['year_experience']; ?>" readonly></td>
        </tr>
		
		<tr>
        <td>Photo:</td>
        <td colspan="5">
		<input type="file" class="form-control" id="photo" name="photo[]"  required />
		</td>
        </tr>
		
		<tr>
        <td>Resume: </td>
        <td colspan="5">
		 <input type="file" class="form-control" id="file" name="file[]" required>
		</td>
        </tr>
		
        <tr>  
         <td colspan="6">
		 <input type="submit" class="btn btn-success" name="submit"  value="Save" style="float: right;">
		 </td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

<script type="text/javascript">  
//aadhar Number 
// function validation() {   
    // var regexp=/^[2-9]{1}[0-9]{3}\s{1}[0-9]{4}\s{1}[0-9]{4}$/;           
    // var x=document.getElementById("adharnumber").value;
    // if(regexp.test(x)){
        //window.alert("Valid Aadhar no.");
    // }
	// else{ 
		// window.alert("Invalid Aadhar no.");
		// $('#adharnumber').val('');
    // }
// }  
//pan number
      
$("#pannumber").change(function () {      
var inputvalues = $(this).val();      
  var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;    
  if(!regex.test(inputvalues)){      
  $("#pannumber").val("");    
  alert("invalid PAN no");    
  return regex.test(inputvalues);    
  }    
});      
  
//voter id
$("#voternumber").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^([a-zA-Z]){3}([0-9]){7}?$/g;   
  if(!regex.test(inputvalues)){      
  $("#voternumber").val("");    
  alert("invalid voter no");    
  return regex.test(inputvalues);    
  }    
});  


 // Photo type validation
    var matches = ['image/jpeg', 'image/png', 'image/jpg'];
    $("#photo").change(function() {
        for(i=0;i<this.files.length;i++){
            var fileP = this.files[i];
            var fileTypes = fileP.type;
			
            if(!((fileTypes == matches[0]) || (fileTypes == matches[1]) || (fileTypes == matches[2]) )){
                alert('Sorry, only JPG, JPEG, & PNG files are allowed to upload.');
                $("#photo").val('');
                return false;
            }
        }
    });
	
   // Resume type validation
 var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    $("#file").change(function() {
        for(i=0;i<this.files.length;i++){
            var file = this.files[i];
            var fileType = file.type;
			
            if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) )){
                alert('Sorry, only PDF & DOC files are allowed to upload.');
                $("#file").val('');
                return false;
            }
        }
    });



$(document).ready(function(){
	var refer = <?php echo json_encode($fet['company_name']); ?> ;
	
	if(refer==''){
      	$('#employee_status').hide();	
	}
	else{
		$('#employee_new').hide();
	}
})              
</script>


