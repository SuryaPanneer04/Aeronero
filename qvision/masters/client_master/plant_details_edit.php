<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$id=$_REQUEST['id'];
	
$stmt = $con->prepare("SELECT a.*,b.* FROM new_client_master a left join new_plant_master b ON (a.id=b.client_id)where b.id='$id'"); 

$stmt->execute(); 
$row = $stmt->fetch();

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
	<center><h3 class="card-title"><b>PLANT DETAILS	</b></h3></center>
	<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>
</div>
<form method="POST" name="form" id="plant_details_form" action="">
	<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
			
		<table class="table table-bordered" id="new_tab">
			<tr>
				<td>Client Org Name</td>
				<td colspan="5"><input type="text" class="form-control" id="txt_org_name" name="txt_org_name" value="<?php echo $row['org_name'];?>" readonly></td>
			</tr>
			<tr>
				<td>Client Org Type</td>
				<?php
					$org_namee=$row['org_type'];
					$stmts = $con->prepare("SELECT * FROM org_type_master where id='$org_namee'"); 
					$stmts->execute(); 
					$row1 = $stmts->fetch();
				?>
				<td colspan="5"><input type="text" class="form-control" id="txt_org_type" name="txt_org_type" value="<?php echo $row1['organization_type'];?>" readonly>
					<input type="hidden" class="form-control" id="txt_org_name_id" name="txt_org_name_id" value="<?php echo$org_namee;?>">
				</td>
			</tr>
			<tr>
				<td>Location</td>
				<td colspan="4"><input type="text" class="form-control" id="Location" name="Location" value="<?php echo $row['location'];?>" required></td>
			</tr>
			<tr>
				<td>State</td>
				<?php
					$state_id=$row['state'];
					$stmt1 = $con->prepare("SELECT * FROM states where id='$state_id'"); 
					$stmt1->execute(); 
					$row3 = $stmt1->fetch();
				?>
				<td colspan="5">
					<select class="form-control" name="state_1" id="state_1" onchange="getcitydata(1,this.value);getgstdata(1,this.value)" required>
						<option value="<?php echo $row3['id'];?>"><?php echo $row3['statename'];?></option>
						<?php $stmt = $con->query("SELECT id,statename FROM states where country_id = 101");
						while ($row2 = $stmt->fetch()) {?>
						<option value="<?php echo $row2['id']; ?>"> <?php echo $row2['statename']; ?> </option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>City</td>
				<?php
					$city_id=$row['city'];
					$stmt2 = $con->prepare("SELECT * FROM cities where id='$city_id'"); 
					$stmt2->execute(); 
					$row4 = $stmt2->fetch();
				?>
				<td colspan="5">
					<select class="form-control" name="city_1" id="city_1" required>
						<option value="<?php echo $row4['id'];?>"><?php echo $row4['city_name'];?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td>GST NO</td>
				<td colspan="4"><input type="text" class="form-control gst form-control mandatory" placeholder="Enter GST No" id="txt_gst_no" maxlength="15" name="txt_gst_no" value="<?php echo $row['gst_no'];?>"></td>
				<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $id;?>"readonly>
			</tr>
			<tr>
				<td>PAN NO</td>
				<td colspan="4"><input type="text"  style="text-transform:uppercase" class="form-control pan" placeholder="Enter PAN No" maxlength="10" id="txt_pan_no_1" name="txt_pan_no_1" maxlength="10" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" title="Please enter valid PAN number. E.g. AAAAA1234A" value="<?php echo $row['pan_no'];?>"></td>
				<input type="hidden" name="txt_duplicate_panno" id="txt_duplicate_panno">
			</tr>
			<tr>
				<td>Company Address</td>
				<td colspan="4"><input type="text" class="form-control" placeholder="Enter Address" id="txt_address_1" name="txt_address_1" value="<?php echo $row['address'];?>"></td>
			</tr>
			<tr>
			   <td>Contact Person *</td>
			   <td colspan="2"><input type="text"  value="<?php echo $row['contact_person'];?>" class="form-control" id="txt_client_name" name="txt_client_name" Placeholder="Customer Name"></td>
			  
			   <td colspan="2"><input type="text" value="<?php echo $row['designation'];?>" class="form-control" id="txt_client_desig" name="txt_client_desig" placeholder="Customer  Designation" ></td>
			</tr>

		<tr>
		   <td>Mobile No1 * </td>
		   <td colspan="2"><input type="text" value="<?php echo $row['mobile1'];?>" class="form-control" id="txt_mobile1" name="txt_mobile1" required placeholder="Mobile No1"></td>
			
		   <td colspan="2"><input type="text" value="<?php echo $row['mobile2'];?>" class="form-control" id="txt_mobile2" name="txt_mobile2" placeholder="Mobile No2"></td>
		</tr>
		<tr>
		   <td>Email Id 1 *</td>
		   <td colspan="2"><input type="text" value="<?php echo $row['email1'];?>" class="form-control" id="txt_mail_id1" name="txt_mail_id1" required placeholder="Email Id 1"></td>
		
		   <td colspan="2"><input type="text" value="<?php echo $row['email2'];?>" class="form-control" id="txt_mail_id2" name="txt_mail_id2" placeholder="Email Id 2"></td>
		</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control " placeholder="Enter Area" id="txt_area_1" name="txt_area_1" value="<?php echo $row['area'];?>"></td>
				<td colspan="2"><input type="text" class="form-control pin" placeholder="Enter Pincode" id="txt_pincode_1" name="txt_pincode_1" value="<?php echo $row['pincode'];?>"></td>
			</tr>
			<tr>
				<td>IT Department</td>
				<td colspan="2"><input type="text" class="form-control " placeholder="Enter Client Name" id="txt_client_name_1" name="txt_client_name_1" value="<?php echo $row['it_name'];?>"></td>
				<td colspan="2"><input type="text" class="form-control " placeholder="Enter Client Designation" id="txt_client_desig_1" name="txt_client_desig_1" value="<?php echo $row['it_designation'];?>"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control " placeholder="Enter Moblie Number" id="txt_mobileone_1" name="txt_mobileone_1" value="<?php echo $row['it_mob1'];?>"></td>
				<td colspan="2"><input type="text" class="form-control " placeholder="Enter Alternate Moblie Number" id="txt_mobiletwo_1" name="txt_mobiletwo_1" value="<?php echo $row['it_mob2'];?>"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control mail" placeholder="Enter Mail ID" id="txt_mail_idone_1" name="txt_mail_idone_1" value="<?php echo $row['it_mail1'];?>"></td>
				<td colspan="2"><input type="text" class="form-control amail" placeholder="Enter Alternate Mail ID" id="txt_mail_idtwo_1" name="txt_mail_idtwo_1" value="<?php echo $row['it_mail2'];?>"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="4"><input type="text" class="form-control " id="txt_landno_1" name="txt_landno_1" placeholder="Enter landline No" value="<?php echo $row['it_landno'];?>"></td>
				</td>
			</tr>
			<tr>
				<td>Purchase Department</td>
				<td colspan="2"><input type="text" class="form-control " id="pur_name_1" name="pur_name_1" placeholder ="Name" value="<?php echo $row['pur_name'];?>"></td>
				<td colspan="2"><input type="text" class="form-control purmail" id="pur_designation_1" name="pur_designation_1" placeholder ="Designation" value="<?php echo $row['pur_designation'];?>"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control " id="pur_contact_1" name="pur_contact_1" placeholder ="Contact Number" value="<?php echo $row['pur_contact'];?>"></td>
				<td colspan="2"><input type="text" class="form-control " id="pur_mail_1" name="pur_mail_1" placeholder ="MailId" value="<?php echo $row['pur_mail'];?>"></td>
			</tr>
			<tr>
				<td>Finance Department</td>
				<td colspan="2"><input type="text" class="form-control " id="fin_name_1" name="fin_name_1" placeholder ="Name" value="<?php echo $row['fin_name'];?>"></td>
				<td colspan="2"><input type="text" class="form-control " id="fin_designation_1" name="fin_designation_1" placeholder ="Designation" value="<?php echo $row['fin_designation'];?>"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control " id="fin_contact_1" name="fin_contact_1" placeholder ="Contact Number" value="<?php echo $row['fin_contact'];?>"></td>
				<td colspan="2"><input type="text" class="form-control finmail" id="fin_mail_1" name="fin_mail_1" placeholder ="MailId" value="<?php echo $row['fin_mail'];?>"></td>
			</tr>
			<tr>
				<td>Status</td>
				<td colspan="4">
					<select  class="form-control" name="status" id="status" >
					<?php
						$status_value=$row['status'];
						if($status_value==1){ $value="Active"; 
						}else{ $value="In Active";}
					?>
						<option value="<?php echo $value;?>"><?php echo $value;?></option>
						<option value="1">Active</option>
						<option value="2">InActive</option>
					</select>
				</td>
			</tr>
		</table>
	
	<div style="text-align:center;">
	<input type="button" name="save" value="UPDATE" onclick="plant_detail_insert(event)" class="btn btn-primary btn-md">
	<br/>
	
</form>

<script type="text/javascript"> 

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
 });           
  </script>
<script>
function plant_detail_insert(event)
{
	var data = $('#plant_details_form').serialize();
	//alert(data)
	
	var gst_value = document.getElementById("txt_gst_no").value;
	//alert(gst_value)
     var pan_value = document.getElementById("txt_pan_no_1").value;
	 //alert(pan_value)
	var orge_type = document.getElementById("txt_org_name_id").value;
		//alert(orge_type)
		//alert($orge_type_value[0])
		
		if(orge_type != '7')
		{
			if(gst_value == ""){
				alert("Please Enter GST Number");
				
			event.preventDefault();
		    }else{
				//alert(data)
				$.ajax({
					type:'GET',
					data:data,	
					url:'qvision/masters/client_master/plant_update.php',
					success:function(result)
					{	
						//alert(result)
						 if(result=='1')
						{
							
						alert("Plant Details Updated Successfully");
						  client_master()
						}else{
							event.preventDefault();
				 
			}
					}       
				});
			}
		}else if(orge_type == "7")
		{
			if(pan_value == ""){
				alert("Please Enter PAN Number");
				
			event.preventDefault();	
			}else{
				//alert(data)
				$.ajax({
					type:'GET',
					data:data,	
					url:'qvision/masters/client_master/plant_update.php',
					success:function(result)
					{
                        alert(result)
					     if(result=='1')
						{
							
						alert("Plant Details Updated Successfully");
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

</script>
<script>

function getcitydata(v,c){

			  //alert(c);

			
			  $.ajax({
				  url: "qvision/masters/client_master/find_city.php?state_id="+c,
                   type: "GET",

success: function(data){
	
$("#city_"+v).html(data);
}
});
 }
 
 function getgstdata(v,c){
	 //alert(c);
	var states_id = document.getElementById("state_1").value;
	//alert(states_id);
	  $.ajax({
		  url: "qvision/masters/client_master/find_gst.php?city_id="+c+"&states_id="+states_id,
		   type: "GET",
		   dataType: 'json',              
		   success:function(data){
			 $.each(data, function(index, element) {
				$('#txt_gst_no').val(element.gst_no);
			 });
		   }
	  });
}
 
 
$('#row_remove').click(function(){
$('input:checkbox:checked.chk').map(function(){
var id=$(this).val();
var le=$('#new_tab tr').length;

if(le==1)
{
alert("You Can't Delete All Rows");
}
else
{
$('.row_'+id).remove();
}

});
});


</script>