<?php
require '../../connect.php';
?>
<style>
  .card-primary:not(.card-outline)>.card-header {
    background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header, .card-primary:not(.card-outline)>.card-header a {
    color: #e95a16 !important;
}
.card-primary:not(.card-outline)>.card-header, .card-primary:not(.card-outline)>.card-header a {
    color: #3c0808 !important;
    background-color: #ed5d00;
}
.btn-dark {
    border-color: #ed5d00;
}
.page-item.active .page-link {
    background-color: #d79475;
    border-color: #df8459;
}
.page-link:hover {
    color: #f1cc61;
}
.btn-success {
    background-color: #f76621;
    border-color: #f76621;
}   

.select2-container--default .select2-selection--single .select2-selection__rendered{
    
    line-height: 18px !important;
}	
.select2 select2-container select2-container--default select2-container--below{
	max-width: 503px !important;
}
	
</style>   

<div class="card card-primary">
				  <div class="card-header">
					
								  <center><h3 class="card-title"><b>New Enquiry</b></h3></center>
			<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"></i>Back</a>
				  </div>
		<form method="POST" enctype="multipart/form-data">
		<!-- Post -->
			<table class="table table-bordered">
				<tr>
					<td><center><img src="qvision/images/logo123.jpg" alt="bluebase" style="width:100px;height:50px;"></center></td>
					<td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
				</tr>			  
				<tr>
					<td colspan="6"><center><b>Add Enquiries</b></center></td>
				</tr>
				<tr>
					<td>Client Type:</td>
					<td colspan="5">
					<select class="form-control" id="Client_type" name="Client_type" onchange="clientstatus(this.value)">
						<option value="">Choose Type</option>
						<option value="1">Existing</option>
						<option value="2">New</option>				
					</select>
					</td>
				</tr>
			   <tr>
					<td>Call_type:</td>
					<td colspan="5">
						<select class="form-control" id="Call_type" name="Call_type" >
							<option value="">Choose Type</option>
							<?php $stmt = $con->query("SELECT * FROM calls_master ");
							while ($row = $stmt->fetch()) {?>
							<option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
						<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Date</td>
					<td colspan="5"><input type="date" class="form-control" placeholder="Select Date" id="date" name="date" ></td>
				</tr>
				<tr id="companyold">
					<td>Company Name</td>
					<td colspan="5">
					<select class="form-control" name="Company_name" id="Company_name"  onchange="compvalue(this.value)">
					<option value="">Choose Type</option>
							<?php 
							$query = $con->query("SELECT distinct org_name FROM new_client_master");
							while ($row_fetch = $query->fetch()) {?>			
							<option value="<?php echo $row_fetch['org_name']; ?>"> <?php echo $row_fetch['org_name']; ?> </option>
							<?php } ?>
                     </select>
					</td>
				</tr>
				<tr id="companynew">
					<td>Company Name</td>
					<td colspan="5">
					    <input type="text" class="form-control" name="new_company_name" id="new_company_name" autocomplete="off">
					</td>									
				</tr>
				<tr id="old">
				   <td>Location</td>
					<td colspan="5">
	                    <select class="form-control" name="location" id="location"  onchange="locationchange(this.value)"></select>
					</td>									
				</tr>
				<tr id="new">
					<td>Location</td>
					<td colspan="5">
					    <input type="text" class="form-control" name="newlocation" id="newlocation" autocomplete="off">
					</td>									
				</tr>
				<tr>
					<td>Address</td>
					<td colspan="5"><input type="text" class="form-control" placeholder="Enter Address"  id="Address" name="Address" autocomplete="off"></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2"><input type="text" class="form-control " id="txt_area_1" name="txt_area_1" placeholder ="Area" autocomplete="off"></td>
					<td colspan="2"><input type="text" class="form-control pin" id="txt_pincode_1" name="txt_pincode_1" placeholder ="Pincode" autocomplete="off"></td>
					<td colspan="2"><input type="hidden" class="form-control pin" id="client_exist_id" name="client_exist_id"></td>
				</tr>
				<tr>
					<td>Client Department</td>
					<td colspan="5">
						<select class="form-control" id="client_depart" name="client_depart" onchange="clientchange(this.value)">
							<option value="">Choose Client Department</option>
							<option value="1">IT Department</option>
							<option value="2">Purchase Department</option>
							<option value="3">Finance Department</option>		
									
						</select>
					</td>
				</tr>
				<tr>
					<td>Client Details</td>
					<td colspan="2"><input type="mail" class="form-control " id="txt_client_name_1" name="txt_client_name_1" placeholder ="Client name" autocomplete="off"></td>
					<td colspan="2"><input type="text" class="form-control " id="txt_client_desig_1" name="txt_client_desig_1" placeholder ="Client Designation" autocomplete="off"></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2"><input type="text" class="form-control mob" id="txt_mobileone_1" maxlength="10" name="txt_mobileone_1" placeholder ="Enter Your Mobile Number" autocomplete="off"></td>
					<td colspan="2"><input type="text" class="form-control amob" id="txt_mobiletwo_1" maxlength="10" name="txt_mobiletwo_1" placeholder ="Enter Your alternate mobile number" autocomplete="off"></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2"><input type="mail" class="form-control mail" id="txt_mail_idone_1" name="txt_mail_idone_1" placeholder ="Enter Your Mail id" autocomplete="off"></td>
					<td colspan="2"><input type="mail" class="form-control amail" id="txt_mail_idtwo_1" name="txt_mail_idtwo_1" placeholder ="Enter Your alternate Mail id" autocomplete="off"></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="4"><input type="text" class="form-control " id="txt_landno_1" name="txt_landno_1" placeholder ="Land Line No" autocomplete="off"></td>
					</td>
				</tr>
					
				<tr>
					<td>Product/Service</td>
					<td colspan="5">
						<select name="Product" class="form-control" id="Product">
							<option>Select</option>
							<option value="1">Product</option>
							<option value="2">Services</option>
							<option value="3">Solution</option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="5">
					 <select class="form-control" name="services" id="services" required></select>				
					</td>
				</tr>
				<tr>
					<td>Remarks</td>
					<td colspan="5">
						<input type="text"  id="Feedback" name="Feedback" class="form-control"  placeholder="Enter Feedback" required="true" autocomplete="off">
					</td>
				</tr>
				<tr>
					<td>Followup Date</td>
					<td colspan="5">
						<input type="date"  id="Follup" name="Follup" class="form-control"  placeholder="Enter Follup" required="true">
					</td>
				</tr>
				<tr>
					<td>Company:</td>
					<td colspan="5">
						<input type="text"  id="companys" name="companys" value="Bluebase Software Services Private Limited" class="form-control"  readonly required="true">
					</td>
				</tr>			 
				<tr id="dep1">
					<td>Department :</td>
					<td colspan="5">
						<select class="form-control" id="Department" name="Department" >
							<option value="">Choose Type</option>
							<?php $stmt = $con->query("SELECT * FROM z_department_master ");
							while ($row = $stmt->fetch()) {?>
							<option value="<?php echo $row['id']; ?>"> <?php echo $row['dept_name']; ?> </option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr id="emp1">
					<td>Employee :</td>
					<td colspan="5">
						<select class="form-control" name="employee" id="employee" required></select>
					</td>
				</tr>
				<tr id="dep2">
					<td>Department</td>
					<td colspan="5">
						<input type="hidden"  id="Departments_id" name="Departments_id" class="form-control"  readonly required="true">
						<input type="text"  id="Departments" name="Departments" class="form-control"  readonly required="true">
					</td>
				</tr>
				<tr id="emp2">
					<td>Employee</td>
					<td colspan="5">
						<input type="hidden"  id="employees_id" name="employees_id" class="form-control"  readonly required="true">
						<input type="text"  id="employees" name="employees" class="form-control"  readonly required="true">
					</td>
				</tr>
					<td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_enqurie()" value="save"></td>				
			</table>
		</form>
    </div>
<script>
/* 	$("#Company_name").select2( {
	placeholder: "Company_name",
	allowClear: true
	} ); */
	
function compvalue(comval)
{

var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("location").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","CRM/get_loc_value.php?comval="+comval,true);
xmlhttp.send();
}
</script>
<script>
/* function depvalue(depart)
{
 var Client_type=$('#Client_type').val();

//alert(Client_type)

 if(Client_type==1){	
var company_name= document.getElementById('Company_name').value;
//alert (company_name)
var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("client_depart").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","CRM/get_dep_value.php?depart="+depart+'&company_name='+company_name,true);
xmlhttp.send();
}
} */
</script>

<script>
function locationchange(location) 

{

 var Client_type=$('#Client_type').val();

 var company_name=$('#Company_name').val();

 if(Client_type==1){

$.ajax({
url: "qvision/CRM/find_client.php",
type: "get",
data: {
location:location,
company_name:company_name
},
cache: false,
success: function(data){
	//alert(data);
var split=data.split("=");
//alert(split[0]);

$('#Address').val(split[0]);
$('#txt_area_1').val(split[1]);
$('#txt_pincode_1').val(split[2]);
$('#Departments').val(split[3]);
$('#employees').val(split[4]);
$('#Departments_id').val(split[5]);
$('#employees_id').val(split[6]);
$('#client_exist_id').val(split[7]);

$('#Address').attr('readonly', 'readonly');
$('#txt_area_1').attr('readonly', 'readonly');
$('#txt_pincode_1').attr('readonly', 'readonly');
}
});
}

}
</script>

<script>
    function insert_enqurie()
    {
    var id=0;

    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
    url:'qvision/CRM/insert_enqurie.php',	
    success:function(data)
    {      
        alert("Entry Successfull");
		enquiry()
		          
    }       
    });

    }
	
</script>
<script>	
		$(document).ready(function() {
$('#Department').on('change', function() {

var department_id = this.value;
//alert(department_id);
$.ajax({
url: "qvision/CRM/find_emp.php",
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
</script>
<script>
$(document).ready(function() {
$('#Product').on('change', function() {

var Product = this.value;

$.ajax({
url: "qvision/CRM/find_services.php",
type: "POST",
data: {
Product: Product
},
cache: false,
success: function(result){
$("#services").html(result);

}
});
});
});   
</script>
<script>
function clientstatus(value)
{
	//alert(value)
if(value=='1')
{
document.getElementById('dep1').style.visibility = "hidden";
document.getElementById('emp1').style.visibility = "hidden";
document.getElementById('new').style.visibility = "hidden";
document.getElementById('companynew').style.visibility = "hidden";
document.getElementById('dep2').style.visibility = "visible";
document.getElementById('old').style.visibility = "visible";
document.getElementById('companyold').style.visibility = "visible";
document.getElementById('emp2').style.visibility = "visible";
}
else
{
document.getElementById('new').style.visibility = "visible";
document.getElementById('companynew').style.visibility = "visible";
document.getElementById('dep1').style.visibility = "visible";
document.getElementById('emp1').style.visibility = "visible";
document.getElementById('old').style.visibility = "hidden";
document.getElementById('companyold').style.visibility = "hidden";
document.getElementById('dep2').style.visibility = "hidden";
document.getElementById('emp2').style.visibility = "hidden";
}
}

   </script>
<script>
function back_ctc()
{
enquiry()	
}
</script>
<script>
//Pincode Validation
 $(document).ready(function(){             
$(".pin").change(function () {      
var inputvalues = $(this).val();      
  var regex =/^(\d{4}|\d{6})$/;    
  if(!regex.test(inputvalues)){      	
  $(".pin").val("");    
  alert("Please Enter Valid PINCODE");    
  return regex.test(inputvalues);    
  }    
});      
    
});

//Mobile Number Validation
 $(document).ready(function(){            
$(".mob").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;    
  if(!regex.test(inputvalues)){      	
  $(".mob").val("");    
  alert("Please Enter Valid Mobile Number");    
  return regex.test(inputvalues);    
  }    
});      
    
});  

$(document).ready(function(){             
$(".amob").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;    
  if(!regex.test(inputvalues)){      	
  $(".amob").val("");    
  alert("Please Enter Valid Alternate Mobile Number");    
  return regex.test(inputvalues);    
  }    
});      
    
}); 

 //Mail validations
 $(document).ready(function(){             
$(".mail").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
  if(!regex.test(inputvalues)){      	
  $(".mail").val("");    
  alert("Please Enter Valid IT Mail ID");    
  return regex.test(inputvalues);    
  }    
});      
    
});  

$(document).ready(function(){             
$(".amail").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
  if(!regex.test(inputvalues)){      	
  $(".amail").val("");    
  alert("Please Enter Valid Alternate Mail ID");    
  return regex.test(inputvalues);    
  }    
});      
    
});  

$(document).ready(function(){            
$(".purmail").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
  if(!regex.test(inputvalues)){      	
  $(".purmail").val("");    
  alert("Please Enter Valid Purchase Mail ID");    
  return regex.test(inputvalues);    
  }    
});      
    
});

$(document).ready(function(){             
$(".finmail").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
  if(!regex.test(inputvalues)){      	
  $(".finmail").val("");    
  alert("Please Enter Valid Finance Mail ID");    
  return regex.test(inputvalues);    
  }    
});      
    
}); 

function clientchange(client) 

{

 var location=$('#location').val();
 var Company_name=$('#Company_name').val();
 var Client_type=$('#Client_type').val();

//alert(Company_name)


 if(Client_type==1){

document.getElementById('txt_client_name_1').value = "";
document.getElementById('txt_client_desig_1').value = "";
document.getElementById('txt_mobileone_1').value = "";
document.getElementById('txt_mobiletwo_1').value = "";
document.getElementById('txt_mail_idone_1').value = "";
document.getElementById('txt_mail_idtwo_1').value = "";
document.getElementById('txt_landno_1').value = ""; 


$.ajax({
url: "qvision/CRM/select_client.php",
type: "get",
data: 'client='+client+'&location='+location+'&Company_name='+Company_name,
cache: false,
success: function(data){
var split=data.split("=");
//alert(split[7]);
if(split[7]=='1')
{
$('#txt_client_name_1').val(split[0]);
$('#txt_client_desig_1').val(split[1]);
$('#txt_mobileone_1').val(split[2]);
$('#txt_mobiletwo_1').val(split[3]);
$('#txt_mail_idone_1').val(split[4]);
$('#txt_mail_idtwo_1').val(split[5]);
$('#txt_landno_1').val(split[6]);


					$('#txt_client_name_1').attr('readonly', 'readonly');
					$('#txt_client_desig_1').attr('readonly', 'readonly');
					$('#txt_mobileone_1').attr('readonly', 'readonly');
					$('#txt_mobiletwo_1').attr('readonly', 'readonly');
					$('#txt_client_name_1').attr('readonly', 'readonly');
					$('#txt_mail_idone_1').attr('readonly', 'readonly');
					$('#txt_mail_idtwo_1').attr('readonly', 'readonly');
					$('#txt_landno_1').attr('readonly', 'readonly');
	

}else if(split[4]=='2')
{
$('#txt_client_name_1').val(split[0]);
$('#txt_client_desig_1').val(split[1]);
$('#txt_mobileone_1').val(split[2]);
$('#txt_mail_idone_1').val(split[3]);		
}else if(split[4]=='3')
{
$('#txt_client_name_1').val(split[0]);
$('#txt_client_desig_1').val(split[1]);
$('#txt_mobileone_1').val(split[2]);
$('#txt_mail_idone_1').val(split[3]);		
}

}
});
}

}
</script>