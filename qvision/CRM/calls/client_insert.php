
<?php
require '../../../connect.php';
include("../../../user.php");
 $id=$_REQUEST['id']; 
$userrole=$_SESSION['userrole'];

$stmt = $con->prepare("SELECT a.id as enquiry_id,a.status as enquiry_status,a.calls_id,
c.id as dep_id,d.id as candi_id,a.Company_name as comp_name,a.*,b.*,c.*,d.*  FROM `enquiry` a
	   join calls_master b ON a.Call_type=b.id
	   join z_department_master c ON a.Department=c.id
	   join candidate_form_details d ON a.employee=d.id
where a.id='$id'");

$stmt->execute(); 
$row = $stmt->fetch();

$enquiry_id=$row['enquiry_id'];
$company_name=$row['company_name'];
$calls_id=$row['calls_id'];

?>
<div class="card card-info">
<div class="card-header">

<center><h3 class="card-title"><b>CLIENT DETAILS FORM</b></h3></center>
<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"></i>Back</a>
</div>

<form  method="post" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td><center><img src="qvision/images/logo123.jpg"  style="width:200px;height:100px;"></center></td>
<td colspan="5"><center><h1><b>Bluebase Software Services Private Limited</b></h1></center></td>
</tr>


<tr>
				<td>Department </td>
				<td colspan="2">
					<input type="hidden" class="form-control" id="Department_id" 
					name="Department_id" value="<?php echo  $row['dep_id'];?>">
	                <input type="text" class="form-control Department" id="Department" 
					name="Department" value="<?php echo  $row['dept_name'];?>" readonly>
				</td>
				<td>Employee </td>
				<td colspan="2">
					
					<input type="hidden" class="form-control" id="employee_id" name="employee_id" 
					value="<?php echo  $row['candi_id'];?>" >
					<input type="text" class="form-control" id="employee" name="employee" 
					value="<?php echo  $row['first_name'];?>" readonly>
				</td>
			</tr>
<tr>
				<td>Client Org Name</td>
				<td colspan="2"><input type="text" class="form-control" 
				id="txt_org_name" name="txt_org_name" value="<?php echo  $row['comp_name'];?>" readonly></td>
				<td>Client Org Type*</td>
				<td colspan="2">
					<select name="client_type" class="form-control" id="client_type">
						<option value="">Select Type</option>
						<option value="1">PVT</option>
						<option value="2">LLP</option>
						<option value="3">PL</option>
						<option value="4">Proprietorship</option>
						<option value="5">Partnership</option>
						<option value="6">Government</option>
						<option value="7">Education</option>
						<option value="8">SEZ</option>
					</select>
				</td>
			</tr>
<tr>
<td>PAN Number*</td>
<td colspan="2"><input type="text" class="form-control" id="pan_num" onmouseout="pan_check(this.value)" name="pan_num" placeholder="Enter PAN Number" oninput="this.value = this.value.toUpperCase()" required></td>
<td>Website</td>
<td colspan="2">
<input type="hidden" class="form-control" id="idee" name="idee" value="<?php echo $enquiry_id;?>">
<input type="hidden" class="form-control" id="calls_id" name="calls_id" value="<?php echo $calls_id;?>">
<input type="text" class="form-control" id="txt_website" name="txt_website" placeholder="Enter Website Name"></td>
</tr>
<tr>
<td>IMS Status</td>
<td colspan="4">
<select name="ims_status" class="form-control" id="ims_status" >
		<option disabled="disabled">Select type</option>
		<option value="0">Inactive</option>
		<option value="1">Active</option>
		

		</select>
</td>
</tr>
</table>
<div style="text-align:left;">
<input type="button" name="save" value="SAVE" onclick="quotation_insert(event)" class="btn btn-primary btn-md">
<br/>
</div>
</form>
</div>

<script>
function pan_check(a){
	alert(a)
}

function back_ctc()
{
Cost_sheet()
}

</script>
<script>
$(document).ready(function() {
$('#Department').on('change', function() {

var department_id = this.value;
//alert(department_id);
$.ajax({
url: "qvision/masters/client_master/find_emp.php",
type: "POST",
data: {
department_id: department_id
},
cache: false,
success: function(result){
$("#employee").html(result);
}
});
});
});


function quotation_insert(event)
{
	
	var data = $('form').serialize();
	var department_id  = document.getElementById("Department_id").value;
	var employee_id  = document.getElementById("employee_id").value;
	var org_name  = document.getElementById("txt_org_name").value;
	
	var org_type    = document.getElementById("client_type").value;
	if(org_type==''){
		alert('Kindly Enter the Client Org Type')
		return false;
	}
	var website  = document.getElementById("txt_website").value;
	var pan=document.getElementById("pan_num").value;
	if(pan==''){
		alert('Kindly Enter the PAN Number')
		return false;
	}
	var idee=document.getElementById("idee").value;
	var calls_id=document.getElementById("calls_id").value;
	var ims_status=document.getElementById('ims_status').value;
	if(ims_status==''){
		alert('Kindly Enter the IMS Status')
		return false;
	}
	$.ajax({
		type:'GET',
		data:'department_id='+department_id+'&employee_id='+employee_id+'&org_name='+org_name+'&org_type='+org_type+'&website='+website+'&pan='+pan+'&idee='+idee+'&calls_id='+calls_id+'&ims_status='+ims_status,
		url:'qvision/CRM/calls/insert_client.php',
		success:function(result)
		{

						 if(result==1)
						{	
                           alert("Client Details Added Successfully")					
						  Cost_sheet()
						}else if(result==0){
							alert("Please Fill All Correct Details");
						}
						else if(result==2){
							alert("Pan Number Already Exists");
						}else{
							event.preventDefault();
				 
			}
		
		}       
	});
	
}

//pan number
      
$("#pan_num").change(function () {      
var inputvalues = $(this).val();      
  var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;    
  if(!regex.test(inputvalues)){      
  $("#pan_num").val("");    
  alert("Invalid PAN No");    
  return regex.test(inputvalues);    
  }    
}); 


function pan_check(pan_no)
    {
        $.ajax(
		{
            type: "GET",
            data:
			{
				pan_no:pan_no,

			},
            url: "Qvsion/CRM/calls/pan_check.php",
            success: function (data) 
			{
				if(data==1)
				{
					alert('PAN Number Already Exists')
					$("#pan_num").val("");
				}else
				{
					
				}                              
            }
        })
    }
</script>
