<?php
require '../../config.php';
include("../../user.php");
$id=$_REQUEST['id'];
$userrole=$_SESSION['userrole'];

$stmt = $con->prepare("SELECT a.id as enquiry_id,a.status as enquiry_status,a.email as enquiry_mailid,c.id as dep_id,d.id as candi_id,a.client_org as company_name,a.*,b.*,c.*,d.*  FROM `crm_calls` a
	   join calls_master b ON a.Call_type=b.id
	   join z_department_master c ON a.Department=c.id
	   join candidate_form_details d ON a.employee=d.id
where a.id='$id'");
/* echo "SELECT a.id as enquiry_id,a.status as enquiry_status,a.email as enquiry_mailid,c.id as dep_id,d.id as candi_id,a.client_org as company_name,a.*,b.*,c.*,d.*  FROM `crm_calls` a
	  left join calls_master b ON a.Call_type=b.id
	  left join z_department_master c ON a.Department=c.id
	  left join candidate_form_details d ON a.employee=d.id
where a.id='$id'"; */
/* echo"SELECT enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.mail as enquiry_mailid,z_department_master.id as dep_id,candidate_form_details.id as candi_id,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	  left join calls_master ON enquiry.Call_type=calls_master.id
	  left join z_department_master ON enquiry.Department=z_department_master.id
	  left join candidate_form_details ON enquiry.employee=candidate_form_details.id
where enquiry.id='$id'"; */

$stmt->execute(); 
$row = $stmt->fetch();

$id=$row['enquiry_id'];
//$area=$row['area'];
$company_name=$row['company_name'];
//$Location=$row['address'];
//$pincode=$row['pincode'];
/* $it_name=$row['it_name'];
$it_designation=$row['it_designation'];
$it_mob1=$row['it_mob1'];
$it_mob2=$row['it_mob2'];
$it_mail1=$row['it_mail1'];
$it_mail2=$row['it_mail2'];
$it_landno=$row['it_landno']; */

?>
<div class="card card-info">
<div class="card-header">
	<center><h3 class="card-title"><b>CLIENT DETAILS FORM</b></h3></center>
	<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>

<form method="POST" name="form" id="form" action="" autocomplete="off">
	<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
	<table class="table table-bordered">
		<tr>
			<td><center><img src="/qvision/Recruitment/image/userlog/quadsel.png"  style="width:200px;height:100px;"></center></td>
			<td colspan="5"><center><h1><b>Bluebase Software Services Private Limited</b></h1></center></td>
		</tr>	
		<table class="table table-bordered" id="new_tab">
			<tr>
				<td>Department </td>
				<td colspan="2">
					<input type="hidden" class="form-control" id="Department_id" name="Department_id" value="<?php echo  $row['dep_id'];?>">
	                <input type="text" class="form-control Department" id="Department" name="Department" value="<?php echo  $row['dept_name'];?>" readonly>
				</td>
				<td>Employee </td>
				<td colspan="2">
					<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id;?>">
					<input type="hidden" class="form-control" id="employee_id" name="employee_id" value="<?php echo  $row['candi_id'];?>" >
					<input type="text" class="form-control" id="employee" name="employee" value="<?php echo  $row['first_name'];?>" readonly>
				</td>
			</tr>
			<tr>
				<td>Client Org Name</td>
				<td colspan="2"><input type="text" class="form-control" id="txt_org_name" name="txt_org_name" value="<?php echo  $row['client_org'];?>" readonly></td>
				<td>Client Org Type</td>
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
				<td>Website</td>
				<td colspan="4"><input type="text" class="form-control" id="txt_website" name="txt_website" placeholder="Enter Website Name"></td>
			</tr>
			<div id="product_detail">
			</div>
			<td>Location</td>
			<td colspan="4"><input type="text" class="form-control"  id="Location" name="Location" placeholder="Enter Plant Location" ></td>
			<tr>
				<td>State*</td>
				<td colspan="5">
					<select class="form-control" name="state_1" id="state_1" onchange="getcitydata(1,this.value);getgstdata(1,this.value)" required>
					<option value="">Choose State</option>
					<?php $stmt = $con->query("SELECT id,statename FROM states where country_id = 101");
					while ($row1 = $stmt->fetch()) {?>
					<option value="<?php echo $row1['id']; ?>"> <?php echo $row1['statename']; ?> </option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>City*</td>
				<td colspan="5"><select class="form-control" name="city_1" id="city_1"  required></select></td>
			</tr>
			<tr id="txt_gst_noo">
				<td>GST NO</td>
				<td colspan="4"><input type="text" class="form-control gst form-control mandatory" style="text-transform:uppercase" id="txt_gst_no" name="txt_gst_no"  onclick="makerCheckerField()" maxlength="15" title="Please enter valid GST number. E.g. 12ABCDE1234A5A6" placeholder="Enter GST Number"></td>
				<input type="hidden" name="txt_duplicate_gstno" id="txt_duplicate_gstno">
			</tr>
			<tr id="txt_pan_noo">
				<td>PAN NO</td>
				<td colspan="4"><input type="text"  style="text-transform:uppercase" class="form-control pan" id="txt_pan_no_1" name="txt_pan_no_1" maxlength="10" title="Please enter valid PAN number. E.g. AAAAA1234A" placeholder="Enter PAN Number"></td>
				<input type="hidden" name="txt_duplicate_panno" id="txt_duplicate_panno">
			</tr>
			<tr>
				<td>Company Address</td>
				<td colspan="4"><input type="text" class="form-control" id="txt_address_1" name="txt_address_1" placeholder =" Enter The Address"></td>
			</tr>
		<!--	<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control " id="txt_area_1" name="txt_area_1" value="<?php echo $area;?>" placeholder ="Area"></td>
				<td colspan="2"><input type="text" class="form-control pin" id="txt_pincode_1" value="<?php echo $pincode;?>" name="txt_pincode_1" placeholder ="Pincode"></td>
			</tr>
			<tr>
				<td>Client Department</td>
				<?php
                 $client_dep=$row['client_department'];

				 if($client_dep==1)
				 {
					 $client_department="IT Department";
				 }elseif($client_dep==2)
				 {
					 $client_department="Purchase Department";
				 }elseif($client_dep==3)
				 {
					 $client_department="Finance Department";
				 }elseif($client_dep==4)
				 {
					$client_department="Others"; 
				 }else{
					$client_department=""; 
				 }
				?>
				<td colspan="5">
					<select class="form-control" id="client_depart" name="client_depart">
						<option value="<?php echo $client_department;?>"><?php echo $client_department;?></option>		
					</select>
				</td>
			</tr>
			<tr>
				<td>Client Details</td>
				<td colspan="2"><input type="mail" class="form-control " value="<?php echo $it_name;?>" id="txt_client_name_1" name="txt_client_name_1" placeholder ="Client name"></td>
				<td colspan="2"><input type="text" class="form-control " value="<?php echo $it_designation;?>" id="txt_client_desig_1" name="txt_client_desig_1" placeholder ="Client Designation"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control mob" value="<?php echo $it_mob1;?>" id="txt_mobileone_1" maxlength="10" name="txt_mobileone_1" placeholder ="Enter Your Mobile Number"></td>
				<td colspan="2"><input type="text" class="form-control amob" value="<?php echo $it_mob2;?>" id="txt_mobiletwo_1" maxlength="10" name="txt_mobiletwo_1" placeholder ="Enter Your alternate mobile number"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="mail" class="form-control mail" value="<?php echo $it_mail1;?>"id="txt_mail_idone_1" name="txt_mail_idone_1" placeholder ="Enter Your Mail id"></td>
				<td colspan="2"><input type="mail" class="form-control amail" value="<?php echo $it_mail1;?>" id="txt_mail_idtwo_1" name="txt_mail_idtwo_1" placeholder ="Enter Your alternate Mail id"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="4"><input type="text" class="form-control " value="<?php echo $it_landno;?>" id="txt_landno_1" name="txt_landno_1" placeholder ="Land Line No"></td>
				</td>
			</tr>	-->		
			<tr>
				<td>Status*</td>
				<td colspan="4">
					<select required aria-required="true"  class="form-control" name="status_1" id="status_1">
					<option value="">Select Status</option>
					<option value="1">Active</option>
					<option value="0">InActive</option>
					</select>
				</td>
			</tr> 
			
		</table>
	</table>
	<div style="text-align:right;">
	<input type="button" name="save" value="SAVE" onclick="plant_insert(event)" class="btn btn-primary btn-md">
	<br/>
	</div>
</form>


<script>
/*   function makerCheckerField()
{
	
    var gst_value = document.getElementById("txt_gst_no").value;
    if (gst_value != ""){
		alert(2)
        $('#txt_gst_no').attr('readonly', 'readonly');
    } else {
		alert(3)
        $('#txt_gst_no').removeAttr('readonly');
    }
} */  
</script>
<script>

function getcitydata(v,c){

			  //alert(c);

			
			  $.ajax({
				  url: "/KerliERP/CRM/find_city.php?state_id="+c,
                   type: "GET",
					success: function(data){
						
					$("#city_"+v).html(data);
					}
					});
 }
 
 function getgstdata(v,c){
	var states_id = document.getElementById("state_1").value;

	var company = document.getElementById("txt_org_name").value;

	  $.ajax({
		  url: "/KerliERP/CRM/find_gst.php?city_id="+c+"&states_id="+states_id+"&company="+company,
		   type: "GET",
		   dataType: 'json',              
		   success:function(data){
			 $.each(data, function(index, element) {				 
				$('#txt_gst_no').val(element.gst_no);
				
				var gst_value = document.getElementById("txt_gst_no").value;

					if (gst_value != ""){
						$('#txt_gst_no').attr('readonly', 'readonly');
					} else{
						$('#txt_gst_no').removeAttr('readonly');
					}
			 });
		   }
	  });
}
     
</script>

<script type="text/javascript">    
 
 //Pincode Validation
 /* $(document).ready(function(){             
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

 
   
  //PAN NUMBER validation 
 $(document).ready(function(){             
$(".pan").change(function () {      
var inputvalues = $(this).val();      
  var regex = "[A-Z]{5}[0-9]{4}[A-Z]{1}";    
  if(!regex.test(inputvalues)){      	
  $(".pan").val("");    
  alert("Please Enter Valid PAN Number");    
  return regex.test(inputvalues);    
  }    
});      
    
});     
  
//GST validation  
 $(document).ready(function () {      
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
 });   */         
  </script>  

<script>
function plant_insert()
    {
        var id = 0;
        //alert(id);

        var data = $('form').serialize();
//alert(data);
        $.ajax({
            type: 'GET',
            data: data + "&" + "id=" + id,
            url: 'CRM/calls/insert_client.php',
            success: function (data)
            {
                alert("Entry Successfully");
                calls()

            }
        });
    }
/* function plant_insert(event)
{
	var data = $('form').serialize();

	
	var gst_value = document.getElementById("txt_gst_no").value;
			 
     var pan_value = document.getElementById("txt_pan_no_1").value;
	 
	var orge_type = document.getElementById("client_type").value;
	
	var state_type = document.getElementById("state_1").value;

    if(state_type==''){
		alert("Please Select State"); 
		event.preventDefault();
	 }
	 var city_type = document.getElementById("city_1").value;

    if(city_type==''){
		alert("Please Select City"); 
		event.preventDefault();
	 }
    var status = document.getElementById("status_1").value;

	 if(status==''){
		alert("Please Select Plant Status"); 
		event.preventDefault();
	 }
	 
	if(orge_type==''){
	alert("Please Enter Organization Type");
	event.preventDefault();
	}

	
		if((orge_type == '7')||(orge_type == '8'))
		{
			if(pan_value == ""){
				alert("Please Enter PAN Number");
				
			event.preventDefault();	
			}else{
				//alert(data)
				$.ajax({
					type:'GET',
					data:data,	
					url:'/KerliERP/CRM/insert_client.php',
					success:function(result)
					{	
						//alert(result)
						 if(result=='1')
						{
							
						alert("Client Details Added Successfully");
						  
						  lead()
						}else{
							event.preventDefault();
				 
			}
					}       
				});
			}
		}else if((orge_type != '7')||(orge_type != '8'))
		{
			
			if(gst_value == ""){
				alert("Please Enter GST Number");
				
			event.preventDefault();
		    }else{
				//alert(data)
				$.ajax({
					type:'GET',
					data:data,	
					url:'CRM/calls/insert_client.php',
					success:function(result)
					{
                        //alert(result)
					     if(result==1)
						{
							
						alert("Client Details Added Successfully");
						  calls()
						}else{
							event.preventDefault();
							 
						}						
					}       
				});
			} 
		}
	
		
} */
</script>

<script>
	function back_ctc()
	{
	calls()
	}


	$(document).ready(function() {
	$('#Department').on('change', function() {
	var department_id = this.value;
	//alert(department_id);
	$.ajax({
		url: "/KerliERP/CRM/find_emp.php",
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
<script>
$(document).ready(function(){

 var Department = document.getElementById('Department').value;
 var employee = document.getElementById('employee').value;
 var txt_org_name = document.getElementById('txt_org_name').value;
 var client_type = document.getElementById('client_type').value;
 var txt_address_1 = document.getElementById('txt_address_1').value;
 var txt_area_1 = document.getElementById('txt_area_1').value;
 var txt_pincode_1 = document.getElementById('txt_pincode_1').value;
 var client_depart = document.getElementById('client_depart').value;
 var txt_client_name_1 = document.getElementById('txt_client_name_1').value;
 var txt_client_desig_1 = document.getElementById('txt_client_desig_1').value;
 var txt_mobileone_1 = document.getElementById('txt_mobileone_1').value;
 var txt_mobiletwo_1 = document.getElementById('txt_mobiletwo_1').value;
 var txt_mail_idone_1 = document.getElementById('txt_mail_idone_1').value;
 var txt_mail_idtwo_1 = document.getElementById('txt_mail_idtwo_1').value;
 var txt_landno_1 = document.getElementById('txt_landno_1').value;


 if (Department != ""){
						$("#Department").attr("readonly","readonly");
						
					}else{
						
					$("#Department").removeAttr("readonly");	
					}
					
if (employee != ""){

					$('#employee').attr('readonly', 'readonly');
				} else {

					$('#employee').removeAttr('readonly');
				}	
if (txt_org_name != ""){

					$('#txt_org_name').attr('readonly', 'readonly');
				} else {

					$('#txt_org_name').removeAttr('readonly');
				}					
if (client_type != ""){

					$('#client_type').attr('readonly', 'readonly');
				} else {

					$('#client_type').removeAttr('readonly');
				}					
if (txt_address_1 != ""){

					$('#txt_address_1').attr('readonly', 'readonly');
				} else {

					$('#txt_address_1').removeAttr('readonly');
				}					
					
if (txt_area_1 != ""){

					$('#txt_area_1').attr('readonly', 'readonly');
				} else {

					$('#txt_area_1').removeAttr('readonly');
				}					
					
if (txt_pincode_1 != ""){

					$('#txt_pincode_1').attr('readonly', 'readonly');
				} else {

					$('#txt_pincode_1').removeAttr('readonly');
				}					
if (client_depart != ""){

					$('#client_depart').attr('readonly', 'readonly');
				} else {

					$('#client_depart').removeAttr('readonly');
				}					
					
if (txt_client_name_1 != ""){

					$('#txt_client_name_1').attr('readonly', 'readonly');
				} else {

					$('#txt_client_name_1').removeAttr('readonly');
				}					
					
if (txt_client_desig_1 != ""){

					$('#txt_client_desig_1').attr('readonly', 'readonly');
				} else {

					$('#txt_client_desig_1').removeAttr('readonly');
				}					
if (txt_mobileone_1 != ""){

					$('#txt_mobileone_1').attr('readonly', 'readonly');
				} else {

					$('#txt_mobileone_1').removeAttr('readonly');
				}	
if (txt_mobiletwo_1 != ""){

					$('#txt_mobiletwo_1').attr('readonly', 'readonly');
				} else {

					$('#txt_mobiletwo_1').removeAttr('readonly');
				}	
if (txt_mail_idone_1 != ""){

					$('#txt_mail_idone_1').attr('readonly', 'readonly');
				} else {

					$('#txt_mail_idone_1').removeAttr('readonly');
				}					
if (txt_mail_idtwo_1 != ""){

					$('#txt_mail_idtwo_1').attr('readonly', 'readonly');
				} else {

					$('#txt_mail_idtwo_1').removeAttr('readonly');
				}
if (txt_landno_1 != ""){

					$('#txt_landno_1').attr('readonly', 'readonly');
				} else {

					$('#txt_landno_1').removeAttr('readonly');
				}				
}); 

</script>