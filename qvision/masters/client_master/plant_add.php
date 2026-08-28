<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
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
</style>
<div class="card card-primary">
<div class="card-header">
	<center><h3 class="card-title"><b>PLANT DETAILS FORM</b></h3></center>
	<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>
</div>

<!--form method="POST" name="form" id="form" action="" autocomplete="off"-->
<form method="POST" name="form" id="form" action="" >
	<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
		
		<table class="table table-bordered" id="new_tab">
			<tr>
				<td>Client Org Name*</td>
				<td colspan="2">
					<select required aria-required="true" class="form-control" id="txt_org_name" name="txt_org_name" onchange="getcode(value)"> 
						<option value="">Choose Org Name</option>
						<?php $stmt3 = $con->query("SELECT id,org_type,org_name FROM new_client_master order by id desc");
						while ($row3 = $stmt3->fetch()) {?>
						<option value="<?php echo $row3['org_type'].'-'.$row3['org_name'].'-'.$row3['id']; ?>"> <?php echo $row3['org_name']; ?></option>
						<?php }  ?>
					</select>
				</td>
				<td colspan="2"><input type="text" name="client_code" id="client_code" class="form-control" readonly> </td>
			</tr>
			
			<div id="product_detail">
			</div>
			<td>Location</td>
			<td colspan="4"><input type="text" class="form-control" id="Location" name="Location" placeholder="Enter Plant Location" required></td>
			<tr>
				<td>State *</td>
				<td colspan="5">
					<select class="form-control" name="state_1" id="state_1" onchange="getcitydata(1,this.value);getgstdata(1,this.value)" required>
					<option value="">Choose State</option>
					<?php $stmt = $con->query("SELECT id,statename FROM states where country_id = 101");
					while ($row = $stmt->fetch()) {?>
					<option value="<?php echo $row['id']; ?>"> <?php echo $row['statename']; ?> </option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>City *</td>
				<td colspan="5"><select class="form-control" name="city_1" id="city_1"  required></select></td>
			</tr>
			<tr id="txt_gst_noo">
				<td>GST NO</td>
				<td colspan="4"><input type="text" class="form-control gst form-control mandatory" style="text-transform:uppercase" id="txt_gst_no" name="txt_gst_no"   title="Please enter valid GST number. E.g. 12ABCDE1234A5A6" placeholder="Enter GST Number"></td>
				<input type="hidden" name="txt_duplicate_gstno" id="txt_duplicate_gstno">
			</tr>
			<tr id="txt_pan_noo">
				<td>PAN NO</td>
				<td colspan="4"><input type="text"  style="text-transform:uppercase" class="form-control pan" id="txt_pan_no_1" name="txt_pan_no_1" maxlength="10" title="Please enter valid PAN number. E.g. AAAAA1234A" placeholder="Enter PAN Number"></td>
				<input type="hidden" name="txt_duplicate_panno" id="txt_duplicate_panno">
			</tr>
			<tr>
				<td>Company Address *</td>
				<td colspan="4"><input type="text" class="form-control" id="txt_address_1" name="txt_address_1" placeholder =" Enter The Address"></td>
			</tr>
			<tr>
			   <td>Contact Person *</td>
			   <td colspan="2"><input type="text" class="form-control" id="txt_client_name" name="txt_client_name" Placeholder="Customer Name"></td>
			  
			   <td colspan="2"><input type="text" class="form-control" id="txt_client_desig" name="txt_client_desig" placeholder="Customer  Designation" ></td>
			</tr>

		<tr>
		   <td>Mobile No1 * </td>
		   <td colspan="2"><input type="text" class="form-control" id="txt_mobile1" name="txt_mobile1" required placeholder="Mobile No1"></td>
			
		   <td colspan="2"><input type="text" class="form-control" id="txt_mobile2" name="txt_mobile2" placeholder="Mobile No2"></td>
		</tr>
		<tr>
		   <td>Email Id 1 *</td>
		   <td colspan="2"><input type="text" class="form-control" id="txt_mail_id1" name="txt_mail_id1" required placeholder="Email Id 1"></td>
		
		   <td colspan="2"><input type="text" class="form-control" id="txt_mail_id2" name="txt_mail_id2" placeholder="Email Id 2"></td>
		</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control " id="txt_area_1" name="txt_area_1" placeholder ="Area"></td>
				<td colspan="2"><input type="text" class="form-control pin" id="txt_pincode_1" name="txt_pincode_1" placeholder ="Pincode"></td>
			</tr>
			<tr>
				<td>IT Department</td>
				<td colspan="2"><input type="mail" class="form-control " id="txt_client_name_1" name="txt_client_name_1" placeholder ="Client name"></td>
				<td colspan="2"><input type="text" class="form-control " id="txt_client_desig_1" name="txt_client_desig_1" placeholder ="Client Designation"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control mob" id="txt_mobileone_1" maxlength="10" name="txt_mobileone_1" placeholder ="Enter Your Mobile Number"></td>
				<td colspan="2"><input type="text" class="form-control amob" id="txt_mobiletwo_1" maxlength="10" name="txt_mobiletwo_1" placeholder ="Enter Your alternate mobile number"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="mail" class="form-control mail" id="txt_mail_idone_1" name="txt_mail_idone_1" placeholder ="Enter Your Mail id"></td>
				<td colspan="2"><input type="mail" class="form-control amail" id="txt_mail_idtwo_1" name="txt_mail_idtwo_1" placeholder ="Enter Your alternate Mail id"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="4"><input type="text" class="form-control " id="txt_landno_1" name="txt_landno_1" placeholder ="Land Line No"></td>
				</td>
			</tr>
			<tr>
				<td>Purchase Department</td>
				<td colspan="2"><input type="text" class="form-control " id="pur_name_1" name="pur_name_1" placeholder ="Name"></td>
				<td colspan="2"><input type="text" class="form-control " id="pur_designation_1" name="pur_designation_1" placeholder ="Designation"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control " id="pur_contact_1" name="pur_contact_1" placeholder ="Contact Number"></td>
				<td colspan="2"><input type="mail" class="form-control purmail" id="pur_mail_1" name="pur_mail_1" placeholder ="MailId"></td>
			</tr>
			<tr>
				<td>Finance Department</td>
				<td colspan="2"><input type="text" class="form-control " id="fin_name_1" name="fin_name_1" placeholder ="Name"></td>
				<td colspan="2"><input type="text" class="form-control " id="fin_designation_1" name="fin_designation_1" placeholder ="Designation"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control " id="fin_contact_1" name="fin_contact_1" placeholder ="Contact Number"></td>
				<td colspan="2"><input type="mail" class="form-control finmail" id="fin_mail_1" name="fin_mail_1" placeholder ="MailId"></td>
			</tr>
			<tr>
				<td>Status *</td>
				<td colspan="4">
					<select required aria-required="true"  class="form-control" name="status_1" id="status_1">
					<option value="1">Active</option>
					<option value="0">InActive</option>
					</select>
				</td>
			</tr> 
			
		</table>
	
	<div style="text-align:right;">
	<input type="button" name="save" value="SAVE" onclick="plant_insert(event)" class="btn btn-primary btn-md">
	<br/>
	</div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">    
 //client_code
 function getcode(v)
 {
	
	 $.ajax({
		 type:"get",
		 url:"qvision/masters/client_master/get_clientcode.php?client="+v,
		 success:function(data)
		 {
			 $('#client_code').val(data)
		 }
		 
	 })
 }
 
 
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

//company mobile 1
$(document).ready(function(){             
$("#txt_mobile1").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;    
  if(!regex.test(inputvalues)){      	
  $("#txt_mobile1").val("");    
  alert("Please Enter Valid Mobile Number");    
  return regex.test(inputvalues);    
  }    
});      
    
}); 

$(document).ready(function(){             
$("#txt_mobile2").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;    
  if(!regex.test(inputvalues)){      	
  $("#txt_mobile2").val("");    
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
   // company email 1
$(document).ready(function(){             
$("#txt_mail_id1").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
  if(!regex.test(inputvalues)){      	
  $("#txt_mail_id1").val("");    
  alert("Please Enter Valid Mail ID");    
  return regex.test(inputvalues);    
  }    
});      
    
});  
$(document).ready(function(){             
$("#txt_mail_id2").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
  if(!regex.test(inputvalues)){      	
  $("#txt_mail_id2").val("");    
  alert("Please Enter Valid Alternate Mail ID");    
  return regex.test(inputvalues);    
  }    
});      
    
});  
   
  //PAN NUMBER validation 
 $(document).ready(function(){             
$(".pan").change(function () {      
var inputvalues = $(this).val();      
  var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;    
  if(!regex.test(inputvalues)){      	
  $(".pan").val("");    
  alert("Please Enter Valid PAN Number");    
  return regex.test(inputvalues);    
  }    
});      
    
});     
  
//GST validation  
 $(document).ready(function () 
 {      
$(".gst").change(function () {    
                var inputvalues = $(this).val();    
                var gstinformat = new RegExp('^([0][1-9]|[1-2][0-9]|[3][0-7])([a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9a-zA-Z]{1}[zZ]{1}[0-9a-zA-Z]{1})+$');    
                if (gstinformat.test(inputvalues)) {    
                    return true;    
                } else {    
                    alert('Please Enter Valid GST Number');    
                    $(".gst").val('');    
                    $(".gst").focus();    
                }    
            });          
 });           
  </script>  

<script>

function plant_insert(event)
{
	var data = $('form').serialize();

	
	var gst_value = document.getElementById("txt_gst_no").value;
			 
     var pan_value = document.getElementById("txt_pan_no_1").value;
	 
	var orge_type = document.getElementById("txt_org_name").value;
	
	var state_type = document.getElementById("state_1").value;
	var txt_address_1 = document.getElementById("txt_address_1").value;
	var txt_client_name = document.getElementById("txt_client_name").value;
	var txt_mobile1 = document.getElementById("txt_mobile1").value;
	var txt_mail_id1 = document.getElementById("txt_mail_id1").value;
	var txt_client_desig = document.getElementById("txt_client_desig").value;


	 
    if(state_type==''){
		alert("Please Select State"); 
		return false;
	 }
	 var city_type = document.getElementById("city_1").value;

    if(city_type==''){
		alert("Please Select City"); 
		return false;
	 }
    var status = document.getElementById("status_1").value;

	 
    if(txt_address_1==''){
		alert("Please Enter Address"); 
		return false;
	 }
	 if(txt_client_name==''){
		alert("Please Enter Client Name"); 
		return false;
	 }
	  if(txt_client_desig==''){
		alert("Please Enter Client Designation"); 
		return false;
	 }
	 if(txt_mobile1==''){
		alert("Please Enter Mobile Number"); 
		return false;
	 }
	 if(txt_mail_id1==''){
		alert("Please Enter Mail ID"); 
		return false;
	 }
		
	if(orge_type==''){
	alert("Please Enter Organization Type");
	return false;
	}
	if(status==''){
		alert("Please Select Plant Status"); 
		return false;
	 }
	$orge_type_value = orge_type.split("-");
		//alert($orge_type_value[0])
	
	
		if($orge_type_value[0] != '7')
		{
			if(gst_value == "" ){
				alert("Please Enter GST Number");
				
			event.preventDefault();
		    }else{
				//alert(data)
				$.ajax({
					type:'GET',
					data:data,	
					url:'qvision/masters/client_master/plant_submit.php',
					success:function(result)
					{	
						//alert(result)
						 if(result=='1')
						{
							
						alert("Plant Details Added Successfully");
						  
						  client_master()
						}else{
							event.preventDefault();
				 
			}
					}       
				});
			}
		}else if($orge_type_value[0] == "7")
		{
			if(pan_value == ""){
				alert("Please Enter PAN Number");
				
			event.preventDefault();	
			}else{
				//alert(data)
				$.ajax({
					type:'GET',
					data:data,	
					url:'qvision/masters/client_master/plant_submit.php',
					success:function(result)
					{
                        //alert(result)
					     if(result==1)
						{
							
						alert("Plant Details Added Successfully");
						  client_master()
						}else{
							event.preventDefault();
							 
						}						
					}       
				});
			} 
		}
	
		
}
</script>

<script>
	function back_ctc()
	{
	$.ajax({
	type:"POST",
		url:"qvision/masters/client_master/client_master.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}


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

//client type

function client_typestatus(value)
{
if(value=='7')
{
	//alert(1);
	document.getElementById('txt_gst_noo').style.visibility = "hidden";
	document.getElementById('txt_pan_noo').style.visibility = "visible";
}
else
{
	//alert(2);
	document.getElementById('txt_pan_noo').style.visibility = "hidden";
	document.getElementById('txt_gst_noo').style.visibility = "visible";
}
}

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

function getcitydata(v,c)
{
	//alert(c);
			  $.ajax({
				  url: "qvision/masters/client_master/find_city.php?state_id="+c,
                   type: "GET",
					success: function(data){
						
					$("#city_"+v).html(data);
					}
					});
}
 
 function getgstdata(v, c) {
    debugger;
    var states_id = document.getElementById("state_1").value;
    var txt_org_name = document.getElementById("txt_org_name").value;

    $.ajax({
        url: "qvision/masters/client_master/find_gst.php?city_id=" + c + "&txt_org_name=" + txt_org_name,
        type: "GET",
        success: function(data) {
            console.warn(data);
            $('#txt_gst_no').val(data);
        }
    });
}

    
</script>