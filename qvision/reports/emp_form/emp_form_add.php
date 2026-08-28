<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$user_id =$_SESSION['userid'];
/* $sqlq=$con->query("select * from new_client_master");
$couq=$sqlq->rowCount();


if($couq == 0)
{
	$client_code='CL0001';
	
}
else
{
	$add=$couq+1;
   
   
   $stmta=$con->prepare("SELECT MAX(ID)as max_id FROM new_client_master"); 
					$stmta->execute(); 
					$rowa = $stmta->fetch();
					$maxi_id=$rowa['max_id']; */
$stmtc=$con->prepare("SELECT a.*,b.*,c.id,c.designation_name as designation_name,a.id as aidd FROM staff_master a left join candidate_form_details b on (a.candid_id=b.id) left join designation_master c on (a.div_id=c.id) where a.id='$user_id'"); 

					$stmtc->execute(); 
					$rowc = $stmtc->fetch();
					$emp_code=$rowc['emp_code'];
					$emp_name=$rowc['emp_name'];
					$joining_date=$rowc['joining_date'];
					$designation_name=$rowc['designation_name'];
					$sidd=$rowc['aidd'];

					/* $find_fi = substr($rowc['client_code'], 0, 2);
					$find_si = substr($rowc['client_code'], 2, 4);
					//echo $find_fi;echo "<br/>";
					//echo $find_si;echo "<br/>";
					$final_clno = str_pad($find_si + 1, 4, 0, STR_PAD_LEFT);

					$client_code=$find_fi.$final_clno; */

//} 
?>
 <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
		<style>
.card-primary:not(.card-outline)>.card-header{
background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
.btn-dark{
	background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black !important;
}
span{
	color:red;
	font-size: 20px;
}
</style>
<div  class="card card-primary">
<div class="card-header">

<center><h3 class="card-title"><b>Employee FORM</b></h3></center>
<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>

<form  method="post" enctype="multipart/form-data" id="emp_form_data" name="emp_form_data" autocomplete="off">

<table class="table table-bordered">
<input type="hidden" name="sid" id="sid" value="<?php echo  $sidd; ?>">
<tr>
<td>Employee Code</td>
<td colspan="4"><input type="text" class="form-control" value="<?php echo $emp_code;?>" id="emp_code" name="emp_code" readonly></td>
<td>Employee Name</td>
<td colspan="4"><input type="text" class="form-control" value="<?php echo $emp_name;?>" id="emp_name" name="emp_name" readonly></td>
</tr>
<tr>
<td>Employee DOJ</td>
<td colspan="4">
<input type="text" class="form-control" value="<?php echo date('d-m-Y',strtotime($joining_date));?>" id="emp_doj" name="emp_doj" readonly></td> 
<input type="hidden" class="form-control" value="<?php echo $joining_date;?>" id="emp_doj_date" name="emp_doj_date" readonly></td> 
<td>Employee Date of Confirmation(DOJ)</td>
<td colspan="4"><input type="text" class="form-control" value="<?php //echo $joining_date;?>" id="emp_doj_exp" name="emp_doj_exp" readonly></td>
</tr>
<tr>
<td>Designation</td>
<td colspan="4"><input type="text" class="form-control" value="<?php echo $designation_name;?>" id="emp_designation" name="emp_designation" readonly></td>

</tr>

<tr>
<td>Employee DOB as per Aadhar <span>*</span></td>
<td colspan="4"><input type="date" class="form-control" id="emp_dob_as_per_aadhar" name="emp_dob_as_per_aadhar" required placeholder="Enter Employee DOB"></td>


<td>Personal Contact No <span>*</span></td>
<td colspan="4"><input type="number" class="form-control" id="personal_contact_no" name="personal_contact_no" required placeholder="Enter Personal Contact No"></td>
</tr>
<tr>
<td>Emergency Contact No <span>*</span> </td>
<td colspan="4"><input type="number" class="form-control" id="emergency_contact_no" name="emergency_contact_no" required placeholder="Enter Emergency Contact No"></td>


<td>Present Address <span>*</span> </td>
<td colspan="4"><input type="text" class="form-control" id="present_address" name="present_address" required placeholder="Enter Present Address"></td>
</tr>

<tr>
<td>Permanent Address <span>*</span> </td>
<td colspan="4"><input type="text" class="form-control" id="permanent_address" name="permanent_address" required placeholder="Enter Permanent Address"></td>


<td>Pan No</td>
<td colspan="4"><input type="text" class="form-control" id="pan_no" name="pan_no" placeholder="Enter Pan No"></td>
</tr>

<tr>
<td>Aadhar No <span>*</span> </td>
<td colspan="4"><input type="text" class="form-control" id="aadhar_no" required name="aadhar_no" placeholder="Enter Aadhar No"></td>


<td>Driving License No</td>
<td colspan="4"><input type="text" class="form-control" id="driving_license_no" name="driving_license_no" placeholder="Enter Driving License No"></td>
</tr>
<tr>
<td>Father Name With Initial <span>*</span> </td>
<td colspan="4"><input type="text" class="form-control" id="father_name_with_initial" name="father_name_with_initial" required placeholder="Enter Father Name With Initial"></td>


<td>Father DOB as per Aadhar <span>*</span> </td>
<td colspan="4"><input type="date" class="form-control" id="father_dob_per_aadhar" required name="father_dob_per_aadhar" placeholder="Enter Father DOB as per Aadhar"></td>
</tr>
<tr>
<td>Mother Name <span>*</span> </td>
<td colspan="4"><input type="text" class="form-control" id="mother_name" name="mother_name" required placeholder="Enter Mother Name"></td>


<td>Mother DOB as per Aadhar <span>*</span> </td>
<td colspan="4"><input type="date" class="form-control" id="mother_dob_per_aadhar" name="mother_dob_per_aadhar" required placeholder="Enter Mother DOB as per Aadhar"></td>
</tr>
<tr>
<td>First Child </td>
<td colspan="4"><input type="text" class="form-control" id="first_child" name="first_child" placeholder="Enter First Child"></td>


<td>First Child DOB</td>
<td colspan="4"><input type="date" class="form-control" id="first_child_dob" name="first_child_dob" placeholder="Enter First Child DOB"></td>
</tr>
<tr>
<td>Second Child Name</td>
<td colspan="4"><input type="text" class="form-control" id="second_child_name" name="second_child_name" placeholder="Enter Second Child Name"></td>


<td>Second Child DOB</td>
<td colspan="4"><input type="date" class="form-control" id="second_child_dob" name="second_child_dob" placeholder="Enter Second Child DOB"></td>
</tr>
</table>
<div style="text-align:left;">
<input type="submit" name="save" value="SAVE"  class="btn btn-primary btn-md">
<br/>
</div>
</form>
</div>
<script>
/* function back_ctc()
{
$.ajax({
type:"POST",
url:"qvision/masters/client_master/client_master.php",
success:function(data){
$("#main_content").html(data);
}
})
} */

/* 
function client_insert()
{
			$.ajax({
		type:'post',
		//data: data + "&" + "field="+field,
		url:'/ssinfo1/qvision/reports/emp_form/emp_form_insert.php',
		success:function(data)
		{
			//alert(result)
						 if(result=='1')
						{	
                           alert("Employee Form Added Successfully")					
						 // client_master()
						}
						else
						{
							event.preventDefault();
				 
						}
		}       
	});
} */
</script>
<script>

$(document).ready(function(){

	//After select DOJ Calc the EXP by subtraction ( currentDate - DOJ ) and set the value to the EXP input.
    let doj = $('#emp_doj_date').val();
    let dojDate = new Date(doj);
    let currentDate = new Date();
    let calexp = dojDate.getMonth() + 9;
  //  let exp = dojDate.getDate() + '-' + calexp + '-' + dojDate.getFullYear() ;
  let exp = dojDate.getFullYear() + '-' + calexp + '-' + dojDate.getDate() ;
    document.querySelector('#emp_doj_exp').value = exp; 
    $('#emp_doj_exp').attr('readonly',true);
		
	
	
    // Submit form data via Ajax
    $("#emp_form_data").on('submit', function(e){
        e.preventDefault();
		
		
          $.ajax({
            type: 'POST',
           url:'/ssinfo1/qvision/reports/emp_form/emp_form_insert.php',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data)
			{
				alert('Submitted successfully')
				employee_form()
			}
          })	
        });
    });
	
</script>