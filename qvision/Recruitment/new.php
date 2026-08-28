<?php
require '../../connect.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];
$sql=$con->query("select * from candidate_form_details  
INNER JOIN designation_master ON candidate_form_details.position = designation_master.id where candidate_form_details.id='$candidateid'");
$data=$sql->fetch();

$sql2=$con->query("select * from emp_personal_details where emp_id='$candidateid'");
$sts=$sql2->fetch();
if($sts){
$emp_pd_id= $sts['id'];
$emp_pd_sts= $sts['status'];
}
else
{
	$emp_pd_sts=0;
	$emp_pd_id=NULL;
}
?>


<div class="card card-primary">
   <section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header p-2">
<ul class="nav nav-pills">

    <li class="nav-item">
        <a class="nav-link active"
           href="#for_employment"
           data-toggle="tab">
            Application for Employment
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link"
           href="#education_qualification"
           data-toggle="tab">
            Educational Qualifications
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link"
           href="#certification_details"
           id="certificationTab"
           onclick="return openCertificationPopup();">
            Certification Details
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link"
            href="#employment_details"
            id="employmentTab"
            data-toggle="tab">
            Employment Details
        </a>
    </li>

</ul>
</div> <!-- /.card-header -->
<div class="card-body">
<div class="tab-content">
    <div class="active tab-pane" id="for_employment">

                                    <!--Employee personal details -->
	
	<form id="fupForm" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td colspan="6"><center><b>Application for Employment</b></center></td>
        </tr>
        <tr>
        <tr>
        <td>Post Applied for:</td>
        <td colspan="5"><input type="text" class="form-control" id="position" name="position" value="<?php echo isset($sts['position']) && $sts['position'] != '' ? $sts['position'] : (isset($data['designation_name']) ? $data['designation_name'] : ''); ?>" ></td>
        </tr>
        <tr>
        <td colspan="6"><center><b>Personal Details</b></center></td>
        </tr>
        <tr>
        <td>Name of the candidate:</td>
        <td colspan="5"><input type="text" class="form-control" id="name" name="name" value="<?php echo isset($sts['name']) && $sts['name'] != '' ? $sts['name'] : (isset($data['first_name']) ? $data['first_name'] : ''); ?>" ></td>
        </tr>
        <tr>
        <td>Father's Name:</td>
        <td colspan="5"><input type="text" class="form-control" id="fathers_name" name="fathers_name" value="<?php echo isset($sts['fathers_name']) && $sts['fathers_name'] != '' ? $sts['fathers_name'] : (isset($data['father_name']) ? $data['father_name'] : ''); ?>"  ></td>
        </tr>
        <tr>
        <td>Date of Birth:</td>
        <td colspan="5"><input type="date" class="form-control" id="DOB" name="DOB" value="<?php echo isset($sts['DOB']) && $sts['DOB'] != '' ? $sts['DOB'] : (isset($data['dob']) ? $data['dob'] : ''); ?>" ></td>
        </tr>
        <tr>
        <td>Communication Address:</td>
        <td colspan="5"><input type="text" class="form-control" id="communication_address" name="communication_address" value="<?php echo isset($sts['communication_address']) && $sts['communication_address'] != '' ? $sts['communication_address'] : (isset($data['address']) ? $data['address'] : ''); ?>"  ></td>
        </tr>
        <tr>
        <td>Permanent Address:</td>
        <td colspan="5"><input type="text" class="form-control" id="permanent_address" name="permanent_address" value="<?php echo isset($sts['permanent_address']) && $sts['permanent_address'] != '' ? $sts['permanent_address'] : (isset($data['paddress']) ? $data['paddress'] : ''); ?>" ></td>
        </tr>
        <tr>
        <td>Telephone no. (Mobile/others):</td>
        <td colspan="5"><input type="text" class="form-control" id="mobile_num" name="mobile_num" value="<?php echo isset($sts['mobile_num']) && $sts['mobile_num'] != '' ? $sts['mobile_num'] : (isset($data['phone']) ? $data['phone'] : ''); ?>" onchange="CheckIndianNumber(this.value)" maxlength="10" ></td>
        </tr>
        <tr>
        <td>Email ID:</td>
        <td colspan="5"><input type="text" class="form-control" id="email_id" name="email_id" value="<?php echo isset($sts['email_id']) && $sts['email_id'] != '' ? $sts['email_id'] : (isset($data['mail']) ? $data['mail'] : ''); ?>" onchange="ValidateEmail(this.value)" ></td>
        </tr>
	    <tr>
        <td>Aadhar Number:*</td>
		<td colspan="2"><input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo isset($sts['aadhar_num']) && $sts['aadhar_num'] != '' ? $sts['aadhar_num'] : (isset($data['adharnumber']) ? $data['adharnumber'] : ''); ?>" maxlength="14" placeholder="Enter Adhaar No. with Space" required></td>
        <td colspan='2' style="border-right:none;"><input type="file" class="form-control file" id="file" name="files[]" /></td>
		<td colspan='2' style="border-left:none;">
	    <a href="qvision/Recruitment/uploads/<?php echo isset($sts['adharcard_number']) ? $sts['adharcard_number'] : '';?>" download="<?php echo isset($sts['adharcard_number']) ? $sts['adharcard_number'] : '';?>" ><?php echo isset($sts['adharcard_number']) ? $sts['adharcard_number'] : '';?></a> 
	   <input type="hidden" value="<?php echo isset($sts['adharcard_number']) ? $sts['adharcard_number'] : '';?>" name="aadharattach" >
	  </td>
        </tr>
		<tr>
        <td>Pan Number:*</td>
        <td colspan="2"><input type="text" class="form-control" id="pannumber" name="pannumber" value="<?php echo isset($sts['pan_num']) && $sts['pan_num'] != '' ? $sts['pan_num'] : (isset($data['pannumber']) ? $data['pannumber'] : ''); ?>" maxlength="10" placeholder="Enter Pancard No" required></td>
        <td colspan='2' style="border-right:none;"><input type="file" class="form-control file" id="file1" name="files1[]" /></td>
		<td colspan='2' style="border-left:none;">
	    <a href="qvision/Recruitment/uploads/<?php echo isset($sts['pan_number']) ? $sts['pan_number'] : '';?>" download="<?php echo isset($sts['pan_number']) ? $sts['pan_number'] : '';?>" ><?php echo isset($sts['pan_number']) ? $sts['pan_number'] : '';?></a> 
	    <input type="hidden" value="<?php echo isset($sts['pan_number']) ? $sts['pan_number'] : '';?>" name="panattach" >
	    </td>
	   </tr>
	   
	   <tr>
        <td>Voter ID:</td>
        <td colspan="2"><input type="text" class="form-control" id="voternumber" name="voternumber" value="<?php echo isset($sts['Voter_no']) && $sts['Voter_no'] != '' ? $sts['Voter_no'] : (isset($data['voternumber']) ? $data['voternumber'] : ''); ?>" maxlength="10" placeholder="Enter Votert No."></td>
        <td colspan='2' style="border-right:none;"><input type="file" class="form-control file" id="file2" name="files2[]" /></td>
		<td colspan='2' style="border-left:none;">
	    <a href="qvision/Recruitment/uploads/<?php echo isset($sts['voter_id']) ? $sts['voter_id'] : '';?>" download="<?php echo isset($sts['voter_id']) ? $sts['voter_id'] : '';?>" ><?php echo isset($sts['voter_id']) ? $sts['voter_id'] : '';?></a> 
	    <input type="hidden" value="<?php echo isset($sts['voter_id']) ? $sts['voter_id'] : '';?>" name="voterattach" >
	    </td>
	   </tr>

      <tr>		
       <td>Reference Contact Person Name :</td>
       <td colspan="5">
        <input type="text" class="form-control" id="cpn" name="cpn" value="<?php echo isset($sts['contact_person']) ? $sts['contact_person'] : '';?>" >
       </td>
      </tr>
       
      <tr>		
       <td>Reference Contact Person Relationship :</td>
       <td colspan="5">
        <input type="text" class="form-control" id="cpr" name="cpr" value="<?php echo isset($sts['emergency_contact_relationship']) ? $sts['emergency_contact_relationship'] : '';?>" >
    </td>
      </tr>

      <tr>		
       <td>Reference Contact Person Mobile.No :</td>
       <td colspan="5">
        <input type="text" class="form-control" id="cpm" name="cpm" value="<?php echo isset($sts['emergency_num']) ? $sts['emergency_num'] : '';?>"  maxlength="10">
    </td>
      </tr>

       <?php 
if($emp_pd_sts!=1){
	?>
        <tr>  
        <td colspan="6"> 
		<input type="hidden" name="cid" id="cid" value="<?php echo $candidateid;?>">
		<input type="hidden" name="id" id="id" value="<?php echo $emp_pd_id;?>">
		<input type="hidden" name="emp_status" id="emp_status" value="<?php echo $emp_pd_sts;?>">
		<input type="submit" name="submit" class="btn btn-success submitBtn" value="SUBMIT"/>
		</td>
		</tr>
<?php } ?>

        </table>
        <!-- /.post -->
    </form>
    </div>
	
<script>                               //Application for Employment
$(document).ready(function(){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'qvision/Recruitment/submit.php',
            data: new FormData(this),
            contentType: false,
            processData:false,
            success: function(data){
      if(data=="")
      { 
        alert("Entry Unsuccessfull");
		//console.warn("data");
		application();
      }
      else
      {
		alert("Application form Entry Successfully Completed.Then fill out the EDUCATIONAL QUALIFICATIONS");
	   // console.warn("data");
		application();
      }
    }   
        });
    });
	
// File type validation
    var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
    $(".file").change(function() {
        for(i=0;i<this.files.length;i++){
            var file = this.files[i];
            var fileType = file.type;
			
            if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
                alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
                $(".file").val('');
                return false;
            }
        } 
    });	
		
});

  //mobile no validation
  function CheckIndianNumber(b)   
    {  
		var a = /[6-9]{1}[0-9]{9}$/;  
        if (a.test(b))   
        {  
            //alert("Your Mobile Number Is Valid.")  
        }   
        else   
        {  
            alert("Your Mobile Number Is Not Valid.")  
			$('#mobile_num').val('');
        }   
    };

//reference mobile number
$('#cpm').change(function(){
    var b = $('#cpm').val()
    var a = /[6-9]{1}[0-9]{9}$/;  
        if (a.test(b))   
        {  
            //alert("Your Mobile Number Is Valid.")  
        }   
        else   
        {  
            alert("Your Mobile Number Is Not Valid.")  
			$('#cpm').val('');
        }   
}) 

    //Email address
	 function ValidateEmail(email) 
	 {
		 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            //var address = document.getElementById[email].value;
            if (reg.test(email) == false) 
            {
                alert('Invalid Email Address');
				$('#email_id').val('');
            }
 }

 //aadhar 
// function validation() {   
//     var regexp=/^[2-9]{1}[0-9]{3}\s{1}[0-9]{4}\s{1}[0-9]{4}$/;           
//     var x=document.getElementById("adharnumber").value;
//     if(regexp.test(x)){
//         //window.alert("Valid Aadhar no.");
//     }
// 	else{ 
// 		window.alert("Invalid Aadhar no.");
// 		$('#adharnumber').val('');
//     }
// }
	   
//pan number validation fix
$("#pannumber").change(function () {      
    var inputvalues = $(this).val().toUpperCase(); // Auto-convert to uppercase
    $(this).val(inputvalues); // Set the capitalized value back to the input box
    
    var regex = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/; // Added ^ for strict exact match
    
    if(!regex.test(inputvalues)){      
        $("#pannumber").val("");    
        alert("Invalid PAN No. Please enter a valid format (e.g., ABCDE1234F)");    
        return false;    
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

</script>
                                   <!--Employee Education -->
<?php 
$sql3=$con->query("select eq.emp_id,eq.education,eq.status from emp_qualification eq where emp_id='$candidateid' && status=1");
$sts3=$sql3->fetch();
if($sts3)
$edu_sts= $sts3['status'];
else
$edu_sts=0;	
?>
 
    <div class="tab-pane" id="education_qualification">
	<form id="fupForm1" class="form-horizontal" method="POST" enctype="multipart/form-data">
    <table class="table table-bordered" id="new_tab">
    <tr>
    <td colspan="10"><center><b>Educational Qualifications (In descending order of qualifications attained)</b></center></td>
    </tr>
    <tr>
      <th>S.No</th>
      <th>Education</th>
      <th>Name of Institution/University</th>
      <th>Degree</th>
      <th>Field of Specialization</th>
      <th>Year of Passing</th>
      <th>Percentage</th>
      <th>Attachment</th>
	  <th>
	    <input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
        <input type="button" class="btn btn-danger" id="certificate_row_remove"  value="Remove">
      </th>
    </tr>
    
    <?php 
        $sel=$con->query("select * from emp_qualification where emp_id='$candidateid' order by id asc");	
		$i=1;
        $educationRowcount = $sel->rowCount();
		if($educationRowcount){
			$getcount=1;
		}
		else
		{
			$getcount=0;
		}
if($getcount == 0){ ?>

<tr>
      <td>
	  <input type="checkbox" class="chk" name="chk[]" id="chk_1" style="width:15px;height:20px;"/>
	  </td>
      <td><input type="text" class="form-control" id="Examination_passed_1" name="examination_passed[]"  required></td>
      <td><input type="text" class="form-control" id="instute_1" name="instute[]"  required></td>
      <td><input type="text" class="form-control" id="degree_1" name="degree[]"  required> </td>
      <td><input type="text" class="form-control" id="field_1" name="field[]"  ></td> 	
      <td><input type="text" class="form-control" id="passing_1" name="passing[]"  required></td>
      <td><input type="text" class="form-control" id="percentage_1" name="percentage[]" required></td>
	 
      <td colspan="2">
	  <input type="file" class="form-control" id="attachment_1" name="attachment[]" />
	  </td>
</tr>


    <?php
} else{
	 while($row=$sel->fetch())
	{
	  $employeid = $row['id'];
	?>
    <tr>
      <td>
	  <input type="checkbox" class="chk" name="chk[]" id="chk_1" style="width:15px;height:20px;"/>
	  <input type="hidden" class="id" name="employeeid[]" id="employeeid_1" value="<?php echo $row['id']; ?>" />
	  </td>
      <td><input type="text" class="form-control" id="Examination_passed_1" name="examination_passed[]" value="<?php echo $row['education']; ?>" required></td>
      <td><input type="text" class="form-control" id="instute_1" name="instute[]" value="<?php echo $row['institution_name']; ?>" required></td>
      <td><input type="text" class="form-control" id="degree_1" name="degree[]" value="<?php echo $row['degree']; ?>" required> </td>
      <td><input type="text" class="form-control" id="field_1" name="field[]" value="<?php echo $row['field_of_specialization']; ?>" ></td> 	
      <td><input type="text" class="form-control" id="passing_1" name="passing[]" value="<?php echo $row['year_of_passing']; ?>" required></td>
      <td><input type="text" class="form-control" id="percentage_1" name="percentage[]"  value="<?php echo $row['percentage']; ?>" required></td>
	 
      <td style="border-right:none;">
	  <input type="file" class="form-control" id="attachment_1" name="attachment[]" />
	  </td>
	  <td style="border-left:none;">
	  <!--<a href="qvision/Recruitment/education_certificate/" download="<?php echo $row['attachment']; ?>" ><?php echo $row['attachment']; ?></a>--> 
	   <input type="hidden" value="<?php echo $row['attachment']; ?>" name="attach[]" id="attachhh">
	  </td>
    </tr>
	<?php
   $i++;
	}
}
	?>
    </table>
	
    <table>
    <tr> 
	<td colspan="6">
		<input type="hidden" name="cid" id="cid" value="<?php echo $candidateid;?>">
		<input type="submit" name="submit" class="btn btn-success submitBtn" value="SUBMIT"/>
    </td>
	</tr>

    </table>
    </form>
    <!-- /.tab-pane -->
    </div>
	
<script>                            //Educational Qualifications
$(document).ready(function(){
    // Submit form data via Ajax
    $("#fupForm1").on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'qvision/Recruitment/employee_educational_insert.php',  
            data: new FormData(this),
            contentType: false,
            processData: false,
           success: function(data){
    if(data == 1 || data == "1") 
    {
        alert("Application form Entry Successfully Completed. Then fill out the EDUCATIONAL QUALIFICATIONS");
        application();
    }
    else
    { 
        alert("Entry Unsuccessfull! Database error.");
        application();
    }
}
        });
    });
	
    // File type validation  //Educational Qualifications
    var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
    $("#attachment_1").change(function() {
        for(i=0;i<this.files.length;i++){
            var file_attach = this.files[i];
            var fileType_attach = file_attach.type;
			
            if(!((fileType_attach == match[0]) || (fileType_attach == match[1]) || (fileType_attach == match[2]) || (fileType_attach == match[3]) || (fileType_attach == match[4]) || (fileType_attach == match[5]))){
                alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
                $("#attachment_1").val('');
                return false;
            }
        }
    });
});

</script>

<script>
    function check() // education
    {
    var len=$('#new_tab tr').length;	
    len=len+1; 
    $('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"></td><td><input type="text" class="form-control" id="Examination Passed_'+len+'" name="examination_passed[]" required></td><td><input type="text" class="form-control" id="instute_'+len+'" name="instute[]" required></td><td><input type="text" class="form-control" id="degree_'+len+'" name="degree[]" required></td><td><input type="text" class="form-control" id="field_'+len+'" name="field[]"></td><td><input type="text" class="form-control" id="passing_'+len+'" name="passing[]" required></td><td><input type="text" class="form-control" id="percentage_'+len+'" name="percentage[]" required></td><td colspan="2"><input type="file" class="form-control" id="attachment_'+len+'" name="attachment[]"></td></tr>'); 
    }

    $('#certificate_row_remove').click(function(){
    $('input:checkbox:checked.chk').map(function(){
    var id=$(this).val();
    var le=$('#new_tab tr').length;

    if(le==1)
    {
    alert("You Can't Delete All the Rows");
    }
    else
    {
    $('.row_'+id).remove();
    }

    });
    });
	</script>
	
	                        <!-- Employee Certificate details upload -->
<?php 
$sql4=$con->query("select * from emp_certification ec where emp_id='$candidateid' ");
$sts4=$sql4->fetch();
if($sts4)
$certificate_sts= $sts4['status'];
else
	$certificate_sts=0;

?>	
   <div class="tab-pane" id="certification_details" >
    <form   method="POST" id="emp_education"  enctype="multipart/form-data">
    <table class="table table-bordered" id="new_tab1">
    <tr>
    <td colspan="10"><center><b>Certification Details</b></center></td>
    </tr>
    <tr>
      <th>S.No</th>
      <th>Certification Name:</th>
      <th>Certification Number:</th>
      <th>Validity From:</th>
      <th>Validity To:</th>
	  <th>Attachment</th>
	  <th>
	  <input type="button" class="btn btn-success" id="new_row1" name="new_row1" onclick="check1()" value="Add">
      <input type="button" class="btn btn-danger" id="certificate_row1_remove" value="Remove">
      </th>
    </tr>
 
  <?php 
     $certificate=$con->query("select * from emp_certification ec where emp_id='$candidateid' order by id ASC");	
	 $c=1;

     $certificateRowcount = $certificate->rowCount();

    if($certificateRowcount == 0){ ?>
     <tr>
        <td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/></td>
        <td><input type="text" class="form-control" id="certifcatename_1" name="certifcatename[]"  required></td>
        <td><input type="text" class="form-control" id="certifcatnumber_1" name="certifcatenumber[]"  required></td>
        <td><input type="date" class="form-control" id="validityfrom_1" name="validityfrom[]" ></td>
        <td><input type="date" class="form-control" id="validityto_1" name="validityto[]" ></td>
        <td colspan='2'><input type="file" class="form-control" id="certifcatefile_1" name="certifcatefile[]" ></td>
      </tr>  

 <?php
    } else {

	 while($certifcate_row=$certificate->fetch())
	{
	  $validatefrom=date('Y-m-d', strtotime($certifcate_row['validity_from']));
      $validateto=date('Y-m-d', strtotime($certifcate_row['validity_to']));
	?> 
    <tr>
      <td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/>
	   <input type="hidden" class="id" name="candidid[]" id="candidid_1" value="<?php echo $certifcate_row['id']; ?>" /></td>
      <td><input type="text" class="form-control" id="certifcatename_1" name="certifcatename[]" value="<?php echo $certifcate_row['certification_name']; ?>" required></td>
      <td><input type="text" class="form-control" id="certifcatnumber_1" name="certifcatenumber[]" value="<?php echo $certifcate_row['certification_number']; ?>" required></td>
      <td><input type="date" class="form-control" id="validityfrom_1" name="validityfrom[]" value="<?php echo $validatefrom; ?>" ></td>
      <td><input type="date" class="form-control" id="validityto_1" name="validityto[]" value="<?php echo $validateto; ?>" ></td>
      <td style="border-right:none;"><input type="file" class="form-control" id="certifcatefile_1" name="certifcatefile[]" ></td>
	  
	  <td style="border-left:none;">
	  <a href="qvision/Recruitment/certificates/<?php echo $certifcate_row['attachment'];?>" download="<?php echo $certifcate_row['attachment']; ?>" ><?php echo $certifcate_row['attachment']; ?></a> 
	   <input type="hidden" value="<?php echo $certifcate_row['attachment']; ?>" name="certificate_attach[]">
	  </td>
    </tr>  
   <?php 
    $c++;
	}
}
   ?> 	
     </table>
    <table>
    <tr>
	<td colspan="7">
	 <input type="hidden" name="cid" id="cid" value="<?php echo $candidateid;?>">
	 <input type="submit" name="submit" class="btn btn-success submitBtn" value="SUBMIT"/>
	</td>
	</tr>
    </table>
    </form>
    <!-- /.tab-pane -->
    </div>
    <!-- /.tab-pane -->
	
<script>                        //Certification Details
$(document).ready(function(){           
    // Submit form data via Ajax
    $("#emp_education").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'qvision/Recruitment/employee_certificate_insert.php',
            data: new FormData(this),
            contentType: false,
            processData:false,
           
            success: function(data){
      if(data==0)
      { 
        alert("Entry Unsuccessfull");
		console.warn("datass");
		application();
      }
      else
      {
		alert('Certification Details form entry Successfully Completed.Then fill out the EMPLOYEMENT DETAILS');
        console.warn("data");

		application();
      }
      
    }   
        });
    });
	
    // File type validation
    var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
    $("#certifcatefile_1").change(function() {
        for(i=0;i<this.files.length;i++){
            var file_certificate = this.files[i];
            var fileType_certificate = file_certificate.type;
			
            if(!((fileType_certificate == match[0]) || (fileType_certificate == match[1]) || (fileType_certificate == match[2]) || (fileType_certificate == match[3]) || (fileType_certificate == match[4]) || (fileType_certificate == match[5]))){
                alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
                $("#certifcatefile_1").val('');
                return false;
            }
        }
    });
});
</script>

	<script>
	function check1() // Certificate
	{
	var len1=$('#new_tab1 tr').length;	
	len1=len1+1; 
	$('#new_tab1').append('<tr class="row_'+len1+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len1+'" value="'+len1+'"></td><td colspan="1"><input type="text" class="form-control" id="certifcatename_'+len1+'" name="certifcatename[]" required></td><td colspan="1"><input type="text" class="form-control" id="certifcatenumber'+len1+'" name="certifcatenumber[]" required></td><td colspan="1"><input type="date" class="form-control" id="validityfrom_'+len1+'" name="validityfrom[]" required></td><td colspan="1"><input type="date" class="form-control" id="validityto_'+len1+'" name="validityto[]" required></td><td colspan="2"><input type="file" class="form-control" id="certifcatefile_'+len1+'" name="certifcatefile[]" required></td></tr>'); 
	}

    $('#certificate_row1_remove').click(function(){
    $('input:checkbox:checked.chk').map(function(){
    var idd=$(this).val();
    var lee=$('#new_tab1 tr').length;

    if(lee==1)
    {
    alert("You Can't Delete All the Rows");
    }
    else
    {
    $('.row_'+idd).remove();
    }

    });
    });
</script>

                                  <!-- Employee Experience -->
<?php 
$sql5=$con->query("select ed.emp_id,ed.status,ed.total_experience from emp_exp_detail ed where ed.emp_id='$candidateid' ");
$expRow = $sql5->rowCount();
$sts5=$sql5->fetch();
if($sts5){
$emp_exp_sts= $sts5['status'];
$emp_exp_freshr= $sts5['total_experience'];
}
else
{
	$emp_exp_sts=0;
	$emp_exp_freshr=0;
}
?>
    <div class="tab-pane" id="employment_details" >

      <input type="hidden" id="expr" name="expr" value="" >
      <input type="hidden" id="ests" name="ests" value="" >
      <table class="table table-bordered">
      <tr> 
        <td colspan="5">Are you a Experience?</td>
        <td colspan="5"> 
          <select class="form-control" id="conformexp" name="conformexp" onchange="conformExperinece(this.value)"> 
        <?php if($emp_exp_freshr == 'Fresher') {  ?>
            <option value="<?php echo $sts5['total_experience']; ?>"> <?php echo $sts5['total_experience']; ?> </option>

     <?php   }  ?>
             
            <option> --- Select --- </option> 
            <option value="Experience"> Experience </option> 
            <option value="Fresher"> Fresher </option> 
          </select> 
        </td>
    </tr>
      </table>
      
	  <form method="POST" id="emp_educations"  enctype="multipart/form-data">
    <table class="table table-bordered" id="new_tab2">
    <tr>
    <td colspan="10"><center><b>Employment Details</b></center></td>
    </tr>
	
    <tr>
	<th>S.No</th>
    <th>Name of the Organization</th>
    <th colspan="2">Designation (With Specific field Mentioned where Worked/working)</th>
    <th>From</th>
    <th>To</th>
    <th>Total Years of Experience</th>
	<th>Attachement</th>
	<th>
	  <input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check2()" value="Add">
	  <input type="button" class="btn btn-danger" id="certificate_row2_remove" value="Remove">
	</th>
    </tr>
	
	<?php 
     $exp=$con->query("select * from emp_exp_detail where emp_id='$candidateid' ");	
	 $e=1;
     $expRowcount = $exp->rowCount();

     if($expRowcount == 0){ ?>
        <tr>
        <td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/></td>
        <td><input type="text" class="form-control" id="organization_1" name="organization[]"  required ></td>
        <td colspan="2"><input type="text" class="form-control" id="Designation_1" name="designation[]"  required ></td>
        <td><input type="date" class="form-control" id="From_1" name="from[]" required ></td>
        <td><input type="date" class="form-control" id="to_1" name="to[]" required ></td>
        <td><input type="number" class="form-control" id="yearofexperience_1" name="yearofexperience[]" required ></td>
        
        <td colspan="2"><input type="file" class="form-control" id="exp_1" name="exp[]" ></td>

        </tr>
 








        <?php
} else {
    while ($experience = $exp->fetch()) {
        // Check if 'from_date' and 'to_date' are not null or empty before using strtotime
        $expfrom = !empty($experience['from_date']) ? date('Y-m-d', strtotime($experience['from_date'])) : '';
        $expto = !empty($experience['to_date']) ? date('Y-m-d', strtotime($experience['to_date'])) : '';

        // Ensure that all values passed to htmlspecialchars() are not NULL
        $organization = !empty($experience['organization_name']) ? htmlspecialchars($experience['organization_name']) : '';
        $designation = !empty($experience['designation']) ? htmlspecialchars($experience['designation']) : '';
        $total_experience = isset($experience['total_experience']) ? htmlspecialchars($experience['total_experience']) : '';
        $exp_attachment = !empty($experience['exp_attachment']) ? htmlspecialchars($experience['exp_attachment']) : '';
    ?> 
    <tr>
        <td>
            <input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/>
            <input type="hidden" class="id" name="expid[]" id="expid_1" value="<?php echo $experience['id']; ?>" />
        </td>
        <td>
            <input type="text" class="form-control" id="organization_1" name="organization[]" 
                   value="<?php echo $organization; ?>" required>
        </td>
        <td colspan="2">
            <input type="text" class="form-control" id="Designation_1" name="designation[]" 
                   value="<?php echo $designation; ?>" required>
        </td>
        <td>
            <input type="date" class="form-control" id="From_1" name="from[]" value="<?php echo $expfrom; ?>" required>
        </td>
        <td>
            <input type="date" class="form-control" id="to_1" name="to[]" value="<?php echo $expto; ?>" required>
        </td>
        <td>
            <input type="number" class="form-control" id="yearofexperience_1" name="yearofexperience[]" 
                   value="<?php echo $total_experience; ?>" required>
        </td>
        <td style="border-right:none;">
            <input type="file" class="form-control" id="exp_1" name="exp[]">
        </td>
        <td style="border-left:none;">
            <?php if (!empty($exp_attachment)) { ?>
                <a href="qvision/Recruitment/experience_certificate/<?php echo $exp_attachment; ?>" 
                   download="<?php echo $exp_attachment; ?>">
                    <?php echo $exp_attachment; ?>
                </a>
            <?php } ?>
            <input type="hidden" value="<?php echo $exp_attachment; ?>" name="exp_attach[]">
        </td> 
    </tr>
 
    <?php
    }
   
}
?>

    <tr>
        <td colspan="7">
            <input type="hidden" name="cid" id="cid" value="<?php echo htmlspecialchars($candidateid); ?>">
            <input type="submit" name="submit" id="yes" class="btn btn-success submitBtn" value="SUBMIT"/>
            <button type="button" class="btn btn-danger" name="no" id="no" onclick="noexp()">SUBMIT</button>
        </td>
    </tr>
</form>

    
	










    
	
    <!-- table class="table table-bordered">
    <tr>		
    <td> Overall Experience :</td>
    <td colspan="5"><input type="text" class="form-control" id="overallexp" name="overallexp"></td>
    </tr>
    </table>
    <table class="table table-bordered">
    <tr>		
    <td> Reference Name & Number :</td>
    <td colspan="5"><input type="text" class="form-control" id="reference" name="reference"></td>
    </tr>
    <tr>		
    <td>Signature:</td>
    <td colspan="5"><input type="text" class="form-control" id="signature" name="signature"></td>
    </tr>
    <tr>		
    <td>Date:</td>
    <td colspan="5"><input type="date" class="form-control" id="interview_date" name="interview_date"></td>
    </tr>
    </table -->


  
<script>                     // Employment Details
$(document).ready(function(){
    // Submit form data via Ajax
    $("#emp_educations").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'qvision/Recruitment/employee_employment_insert.php',
            data: new FormData(this),
            contentType: false,
            processData:false,
            success: function(data){
      if(data==0)
      { 
        alert("Entry Unsuccessfull");
		application();
      }
      else
      {
		alert('Application form Entry Successfully Completed.');
       // application();
       window.location.href= 'login/login.php';
      }
      
    }   
        });
    });
	
    // File type validation
    var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
    $("#file").change(function() {
        for(i=0;i<this.files.length;i++){
            var file = this.files[i];
            var fileType = file.type;
			
            if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
                alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
                $("#file").val('');
                return false;
            }
        }
    });

    $('#new_tab2').hide();
    $('#yes').hide();  //submit button when experience
    $('#no').hide(); //submit button when fresher

    let expstsatus = $('#expr').val();
    let ests = $('#ests').val();

    if(expstsatus == 'Fresher' && ests ==1){

        document.getElementById("conformexp").setAttribute("disabled", "disabled");
    }
});








function conformExperinece(v)
{
    // -----------------------------------------
    // --- Select ---
    // -----------------------------------------
    if (v == '--- Select ---' || v == '')
    {
        $('#new_tab2').hide();
        $('#yes').hide();
        $('#no').hide();

        return;
    }


    // -----------------------------------------
    // EXPERIENCE
    // -----------------------------------------
    if (v == 'Experience')
    {
        // Show experience details
        $('#new_tab2').show();

        // Show Experience submit button
        $('#yes').show();

        // Hide Fresher submit button
        $('#no').hide();

        // IMPORTANT:
        // Do NOT show popup
        return;
    }


    // -----------------------------------------
    // FRESHER
    // -----------------------------------------
    if (v == 'Fresher')
    {
        // Show popup ONLY for Fresher
        $('#employmentModal').modal({
            backdrop: 'static',
            keyboard: false
        });

        return;
    }
}

function noexp(){
    let cid = $('#cid').val()
    let conformexp = $('#conformexp').val()
     $.ajax({
        type:"POST",
        data: cid,
        url: "qvision/Recruitment/employee_employment_update.php?cid="+cid+"&conformexp="+conformexp,
        success: function(data){
            if(data== 1){
                alert('Application form Entry Successfully Completed.')
                window.location.href= 'login/login.php';

            } else{
                alert("Entry Unsuccessfull");
		        application()

            }
        }


     })
}




 function check2() // Experience
{
	 var len2=$('#new_tab2 tr').length;	
	len2=len2+1; 
	$('#new_tab2').append('<tr class="row_'+len2+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len2+'" value="'+len2+'"></td><td><input type="text" class="form-control" id="organization_'+len2+'" name="organization[]" required></td><td colspan="2"><input type="text" class="form-control" id="Designation_'+len2+'" name="designation[]" required></td><td><input type="date" class="form-control" id="From_'+len2+'" name="from[]" required ></td><td><input type="date" class="form-control" id="to_'+len2+'" name="to[]" required></td><td colspan="1"><input type="text" class="form-control" id="yearofexperience_'+len2+'" name="yearofexperience[]" required></td><td colspan="2"><input type="file" class="form-control" id="exp_'+len2+'" name="exp[]" ></td></tr>');  
}
 $('#certificate_row2_remove').click(function(){
    $('input:checkbox:checked.chk').map(function(){
    var id1=$(this).val();
    var le1=$('#new_tab2 tr').length;

    if(le1==1)
    {
    alert("You Can't Delete All the Rows");
    }
    else
    {
    $('.row_'+id1).remove();
    }

    });
    }); 
</script>
	
	

    </div>
    <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
    </div><!-- /.card-body -->
    </div>
    <!-- /.nav-tabs-custom -->
    
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
    </div><!-- /.container-fluid -->
    </section>
	</div>
	
	

	
	
<script> 
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
    </script> 
	
    
<!-- Certification Popup -->
<div class="modal fade" id="certificationModal"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Certification Details
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body text-center">

                <h5>Have you done any certification course?</h5>

                <p class="text-muted">
                    Please select Yes or No.
                </p>

            </div>

            <div class="modal-footer justify-content-center">

                <button type="button"
                        class="btn btn-success"
                        onclick="certificationYes()">
                    Yes
                </button>

                <button type="button"
                        class="btn btn-danger"
                        onclick="certificationNo()">
                    No
                </button>

            </div>

        </div>

    </div>

</div>

<!-- Employment Popup -->
<div class="modal fade" id="employmentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Employment Details
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body text-center">

                <h5>Are you a Fresher?</h5>

                <p class="text-muted">
                    Select Yes if you are a Fresher.
                    Select No if you have previous experience.
                </p>

            </div>

            <div class="modal-footer justify-content-center">

                <button type="button"
                        class="btn btn-success"
                        onclick="fresherYes()">
                    Yes
                </button>

                <button type="button"
                        class="btn btn-danger"
                        onclick="fresherNo()">
                    No
                </button>

            </div>

        </div>
    </div>
</div>

<style>

.modal {
    z-index: 99999 !important;
}

.modal-backdrop {
    z-index: 99998 !important;
}

</style>

<script>

/*
|--------------------------------------------------------------------------
| CERTIFICATION POPUP
|--------------------------------------------------------------------------
*/

function openCertificationPopup()
{
    var modal = $('#certificationModal');

    // IMPORTANT:
    // new.php is loaded inside #main_content.
    // Move modal outside #main_content and put it directly under body.
    if (modal.length && !modal.parent().is('body')) {
        modal.appendTo('body');
    }

    modal.modal({
        backdrop: 'static',
        keyboard: false
    });

    return false;
}


/*
|--------------------------------------------------------------------------
| CERTIFICATION YES
|--------------------------------------------------------------------------
*/

function certificationYes()
{
    $('#certificationModal').modal('hide');

    setTimeout(function()
    {
        $('#certificationTab').tab('show');
    }, 300);
}


/*
|--------------------------------------------------------------------------
| CERTIFICATION NO
|--------------------------------------------------------------------------
*/

function certificationNo()
{
    $('#certificationModal').modal('hide');

    setTimeout(function()
    {
        // Only open Employment Details tab
        // DO NOT open employment popup here
        $('#employmentTab').tab('show');
    }, 300);

    return false;
}

/*
|--------------------------------------------------------------------------
| EMPLOYMENT TAB
|--------------------------------------------------------------------------
*/




/*
|--------------------------------------------------------------------------
| FRESHER = YES
|--------------------------------------------------------------------------
*/

function fresherYes()
{
    $('#employmentModal').modal('hide');

    setTimeout(function()
    {
        // Set dropdown to Fresher
        $('#conformexp').val('Fresher');

        // Hide experience details
        $('#new_tab2').hide();

        // Hide Experience submit button
        $('#yes').hide();

        // Show Fresher submit button
        $('#no').show();

    }, 300);
}

/*
|--------------------------------------------------------------------------
| FRESHER = NO / EXPERIENCE
|--------------------------------------------------------------------------
*/

function fresherNo()
{
    $('#employmentModal').modal('hide');

    setTimeout(function()
    {
        // Set dropdown to Experience
        $('#conformexp').val('Experience');

        // Show experience details
        $('#new_tab2').show();

        // Show Experience submit button
        $('#yes').show();

        // Hide Fresher submit button
        $('#no').hide();

    }, 300);
}

</script>