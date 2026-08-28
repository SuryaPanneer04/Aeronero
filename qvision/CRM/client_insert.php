<?php
require '../../connect.php';
include("../../user.php");
$id=$_REQUEST['id'];

$userrole=$_SESSION['userrole'];
$candidateid=$_SESSION['candidateid'];

$stmtc = $con->prepare("select candid_id,emp_name from staff_master where candid_id='$candidateid'");


$stmtc->execute(); 
$rowc = $stmtc->fetch();
$sale_person=$rowc['emp_name'];
	
	$stmtd= $con->prepare("select candidate_id,department from z_user_master where candidate_id='$candidateid'");


$stmtd->execute(); 
$rowd = $stmtd->fetch();
$depart_id=$rowd['department'];

$stmt = $con->prepare("select * from customer_details where id='$id'");


$stmt->execute(); 
$rowv = $stmt->fetch();
$customer_code=$rowv['customer_code'];
$customer_id=$rowv['id'];
$customer_follow=$rowv['cus_follo_date'];

$sqlq=$con->query("select * from new_client_master");
$couq=$sqlq->rowCount();


if($couq == 0)
{
	$client_code='QC0001';
	
}
else
{
	$add=$couq+1;
   
   
   $stmta=$con->prepare("SELECT MAX(ID)as max_id FROM new_client_master"); 
					$stmta->execute(); 
					$rowa = $stmta->fetch();
					$maxi_id=$rowa['max_id'];
$stmtc=$con->prepare("SELECT id,client_code FROM new_client_master where id='$maxi_id'"); 

					$stmtc->execute(); 
					$rowc = $stmtc->fetch();
					$cus_codes=$rowc['client_code'];

					$find_fi = substr($rowc['client_code'], 0, 2);
					$find_si = substr($rowc['client_code'], 2, 4);
					$final_clno = str_pad($find_si + 1, 4, 0, STR_PAD_LEFT);

					$client_code=$find_fi.$final_clno;

} 


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
<section class="wage_content">
<div class="card card-primary">
<div class="card-header" style="background:#ff8b3d !important;">
	<center><h3 class="card-title"><b>CLIENT DETAILS FORM</b></h3></center>
	<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>
</div>


<form method="POST" id="fupForm3" name="fupForm3" action="" >

		
		<table class="table table-bordered" id="new_tab">
			<tr>
			<td>Customer Code</td>
		<td colspan="5"><input type="text" class="form-control"   id="cus_code" value="<?php echo $customer_code; ?>" name="cus_code" readonly></td>
		<!--<td>Clinet Code</td>
		<td colspan="2"><input type="hidden" class="form-control"   id="client_code" value="< ?php echo $client_code; ?>" name="client_code" readonly></td>-->
		<input type="hidden" class="form-control"   id="client_code" value="<?php echo $client_code; ?>" name="client_code" readonly>
			<input type="hidden" class="form-control"   id="customer_id" value="<?php echo $customer_id; ?>" name="customer_id" readonly>
				 
		
        
			</tr>
			<tr>
				<td>Client Org Name*</td>
				<td colspan="3">
					<input type="text" class="form-control" id="txt_org_name" name="txt_org_name" value="<?php echo $rowv['customer_name']; ?>"> 
						
				</td>
				<td>Client Org Type:</td>
   <td colspan="2">
     <select name="client_org_type" id="client_org_type" class="form-control" required="true">
		<option value="">Select Type</option>
		<?php
		$sql=$con->query("SELECT * FROM org_type_master ");
		$i=1;
		while($cmp = $sql->fetch(PDO::FETCH_ASSOC))
		{
		  ?>
		  <option value="<?php echo $cmp['id'];?>"><?php echo $cmp['organization_type'];?></option>
		  <?php
		}
		  ?>
	  </select>
	</td>
		
<tr>

   <td>Website </td>
   <td colspan="5"><input type="text" class="form-control" value="<?php echo $rowv['customer_website']; ?>" id="txt_website" name="txt_website"></td>
   <input type="hidden" value="<?php echo $id;?>" name="cus_id" id="cus_id" >

</tr>		
			</tr>
			
			<div id="product_detail">
			</div>
			<td>Location*</td>
			<td colspan="5"><input type="text" class="form-control" id="Location" name="Location" placeholder="Enter Plant Location" required="true"></td>
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
				<td colspan="5"><input type="text" class="form-control gst form-control mandatory" style="text-transform:uppercase" id="txt_gst_no" name="txt_gst_no"  maxlength="15" title="Please enter valid GST number. E.g. 12ABCDE1234A5A6" placeholder="Enter GST Number"required="true" ></td>
				<input type="hidden" name="txt_duplicate_gstno" id="txt_duplicate_gstno" >
			</tr>
			<tr id="txt_pan_noo">
				<td>PAN NO</td>
				<td colspan="5"><input type="text"  style="text-transform:uppercase" class="form-control pan" id="txt_pan_no" name="txt_pan_no" maxlength="10" title="Please enter valid PAN number. E.g. AAAAA1234A" placeholder="Enter PAN Number"></td>
				<input type="hidden" name="txt_duplicate_panno" id="txt_duplicate_panno">
			</tr>
			<tr>
				<td>Company Address *</td>
				<td colspan="5"><input type="text" class="form-control" value="<?php echo $rowv['customer_address'];?>" id="txt_address" name="txt_address" placeholder =" Enter The Address" required="true"></td>
			</tr>
			<tr>
			   <td>Contact Person *</td>
			   <td colspan="3"><input type="text" class="form-control" value="<?php echo $rowv['customer_person'];?>" id="cs_name" name="cs_name" required="true"></td>
			  
			   <td colspan="2"><input type="text" class="form-control" id="cs_dess" name="cs_dess" placeholder="Customer  Designation" required="true"></td>
			</tr>

		<tr>
		   <td>Mobile No1 * </td>
		   <td colspan="3"><input type="text" class="form-control" id="txt_mobile1" value="<?php echo $rowv['customer_contact']; ?>" name="txt_mobile1" maxlength="10" required placeholder="Mobile No1" required="true"></td>
			
		   <td colspan="2"><input type="text" class="form-control" id="txt_mobile2" name="txt_mobile2" maxlength="10" placeholder="Mobile No2"></td>
		</tr>
		<tr>
		   <td>Email Id 1 *</td>
		   <td colspan="3"><input type="text" class="form-control" value="<?php echo $rowv['customer_mail']; ?>" id="txt_mail_id1" name="txt_mail_id1" required placeholder="Email Id 1" required="true"></td>
		
		   <td colspan="2"><input type="text" class="form-control" id="txt_mail_id2" name="txt_mail_id2" placeholder="Email Id 2"></td>
		</tr>
			<tr>
				<td></td>
				<td colspan="3"><input type="text" class="form-control " id="txt_area" name="txt_area" placeholder ="Area"></td>
				<td colspan="2"><input type="text" class="form-control pin" id="txt_pincode" name="txt_pincode" placeholder ="Pincode"></td>
			</tr>
			<tr>
				<td>IT Department</td>
				<td colspan="3"><input type="mail" class="form-control " id="txt_client_name" name="txt_client_name" placeholder ="Client name"></td>
				<td colspan="2"><input type="text" class="form-control " id="txt_client_desig" name="txt_client_desig" placeholder ="Client Designation"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><input type="text" class="form-control mob" id="txt_mobileone" maxlength="10" name="txt_mobileone" placeholder ="Enter Your Mobile Number"></td>
				<td colspan="2"><input type="text" class="form-control amob" id="txt_mobiletwo" maxlength="10" name="txt_mobiletwo" placeholder ="Enter Your alternate mobile number"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><input type="mail" class="form-control mail" id="txt_mail_idone" name="txt_mail_idone" placeholder ="Enter Your Mail id"></td>
				<td colspan="2"><input type="mail" class="form-control amail" id="txt_mail_idtwo" name="txt_mail_idtwo" placeholder ="Enter Your alternate Mail id"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="5"><input type="text" class="form-control " id="txt_landno" name="txt_landno" placeholder ="Land Line No"></td>
				</td>
			</tr>
			<tr>
				<td>Purchase Department</td>
				<td colspan="3"><input type="text" class="form-control " id="pur_name" name="pur_name" placeholder ="Name"></td>
				<td colspan="2"><input type="text" class="form-control " id="pur_designation" name="pur_designation" placeholder ="Designation"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><input type="text" class="form-control " id="pur_contact" name="pur_contact" placeholder ="Contact Number"></td>
				<td colspan="2"><input type="mail" class="form-control purmail" id="pur_mail" name="pur_mail" placeholder ="MailId"></td>
			</tr>
			<tr>
				<td>Finance Department</td>
				<td colspan="3"><input type="text" class="form-control " id="fin_name" name="fin_name" placeholder ="Name"></td>
				<td colspan="2"><input type="text" class="form-control " id="fin_designation" name="fin_designation" placeholder ="Designation"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><input type="text" class="form-control " id="fin_contact" name="fin_contact" placeholder ="Contact Number"></td>
				<td colspan="2"><input type="mail" class="form-control finmail" id="fin_mail" name="fin_mail" placeholder ="MailId"></td>
			</tr>
			
			<!--<tr>
        <td>Product / Service *</td>
        <td colspan="5">
		<select name="Product" class="form-control" id="Product"  onchange="productstatus(this.value)" required="true">
		<option value="">Select</option>
		<option value="1">Product</option>
		<option value="2">Service</option>
		<option value="3">Solution</option>
		</select>
		</td>
        </tr>-->
		
	<!--<tr>
        <td></td>
        <td colspan="5">
		 <select class="form-control" name="services" id="services">

</select>
		
		</td>
        </tr>-->
		<!--<tr>

        <td>Enquiry Details *</td>

        <td colspan="5">
			<input type="text"  id="Feedback" name="Feedback" class="form-control"  placeholder="About Enquiry ...." required="true">
		</td>
        </tr>
		<tr>
        <td>Followup Date *</td>
        <td colspan="5">-->
			<input type="hidden"  id="Follup" name="Follup" value="<?php echo $customer_follow;?>" class="form-control"  placeholder="Enter Follup date" required="true">
		<!--</td>
        </tr>-->
		 <tr>
		<td>Branch Details *</td>
		<td colspan="5">
		<select class="form-control" id="branch_type" name="branch_type" onchange="branchstatus(this.value)" required="true">

		<option value="2">YES</option>
		<option value="1">NO</option>
		
		</select></td>
        </tr>
		<tr id="deps1">
		<td></td>
        <td colspan="3">

			<input type="text"  id="branch_client" placeholder="Enter Client Name" name="branch_client" class="form-control" >
		</td>
		<td colspan="2">

			<input type="text"  id="branch_desg" placeholder="Enter Client Designation" name="branch_desg" class="form-control" >
		</td>
        </tr>
		<tr id="loc1">
		<td></td>
        <td colspan="3">

			<input type="text"  id="branch_mob" placeholder="Mobile Number" name="branch_mob" class="form-control" >
		</td>
		<td colspan="2">

			<input type="text"  id="branch_mail" placeholder="Mail ID" name="branch_mail" class="form-control" >
		</td>
        </tr>
		<tr id="pin1">
		<td></td>
        <td colspan="3">

			<input type="text"  id="branch_location" placeholder="Branch Location" name="branch_location" class="form-control" >
		</td>
		<td colspan="2">

			<input type="text"  id="branch_pin" placeholder="Pincode" name="branch_pin" class="form-control" >
		</td>
        </tr>
        
		<tr id="State1">
				<td>State *</td>
				<td colspan="3">
					<select class="form-control" name="state_2" id="state_2" onchange="getcity(2,this.value);getgst(2,this.value)" >
					<option value="">Choose State</option>
					<?php $stmt = $con->query("SELECT id,statename FROM states where country_id = 101");
					while ($row = $stmt->fetch()) {?>
					<option value="<?php echo $row['id']; ?>"> <?php echo $row['statename']; ?> </option>
					<?php } ?>
					</select>
				</td>
				<td colspan="2"><select class="form-control" name="city_2" id="city_2"></select></td>
			</tr>
			<tr id="City1">
				<td>Branch Address *</td>
				<td colspan="5"><input type="text"  id="branch_address" placeholder="branch_address" name="branch_address" class="form-control" ></td>
			</tr>
			<tr id="gst1">
				<td>Branch GST NO*</td>
				<td colspan="5"><input type="text" class="form-control gsti form-control mandatory" style="text-transform:uppercase" id="branch_gst_no" name="branch_gst_no"  maxlength="15" title="Please enter valid GST number. E.g. 12ABCDE1234A5A6" placeholder="Enter GST Number"></td>
				<input type="hidden" name="txt_duplicate_gstno" id="txt_duplicate_gstno" >
			</tr>
			<tr id="pan1">
				<td>Branch PAN NO</td>
				<td colspan="5"><input type="text"  style="text-transform:uppercase" class="form-control pan" id="branch_pan_no" name="branch_pan_no" maxlength="10" title="Please enter valid PAN number. E.g. AAAAA1234A" placeholder="Enter PAN Number"></td>
				<input type="hidden" name="txt_duplicate_panno" id="txt_duplicate_panno">
			</tr>
		<tr>
		<td>Sales Person Name</td>
		<td colspan="5">
		<input type="text"  id="sale_person" name="sale_person" value="<?php echo $sale_person; ?>" class="form-control"  required="true" readonly></td>
        </tr>
		<tr>
		<td>Credit Period (No of days)</td>
		<td colspan="5">
		<input type="text"  id="credit_period" name="credit_period"  placeholder="Enter Credit Period" class="form-control"  required="true"></td>
        </tr>
		<tr>
		<td>Credit limit (Value in Rs.)</td>
		<td colspan="5">
		<input type="text"  id="credit_limit" name="credit_limit"  placeholder="Enter Credit limit" class="form-control"  required="true"></td>
		<input type="hidden"  id="Department" name="Department"   value="<?php echo $depart_id; ?>" class="form-control"  required="true">
		<input type="hidden"  id="employee" name="employee"   value="<?php echo $candidateid; ?>" class="form-control"  required="true">
        </tr>
		 <!--<tr>
		<td>Assign To Department </td>
		<td colspan="5">
		<select class="form-control" id="Department" onchange="getempdata(this.value)" name="Department" >
		<option value="">Choose Type</option>
		< ?php $stmt = $con->query("SELECT * FROM z_department_master ");
		while ($row = $stmt->fetch()) {?>
		<option value="< ?php echo $row['id']; ?>"> < ?php echo $row['dept_name']; ?> </option>
		< ?php } ?>
		</select></td>
        </tr>
		
		<tr>
		<td>Assign To Employee </td>
		<td colspan="5">
		 <select class="form-control" name="employee" id="employee" required>

</select></td>
        </tr>-->
		
		<tr>


		  <td colspan="5"><b>Document Upload*</b></td>
		  <td align="left">
		     <b><input type="file" name="file[]" id="file" required="true"/>
		  </td>
		</tr>
			
		</table>
	
	<div style="text-align:right;">
	<input type="submit" name="submit" class="btn btn-success submitBtn" value="Save">
	<br/>
	</div>
</form>

<script>   
function getcity(v,c)
{
	//alert(v);
			  $.ajax({
				  url: "qvision/CRM/find_city.php?state_id="+c,
                   type: "GET",
					success: function(data){
						
					$("#city_"+v).html(data);
					}
					});
}
 
 function getgst(v,c)
 {
	var states_id = document.getElementById("state_1").value;
	var txt_org_name = document.getElementById("txt_org_name").value;

	  $.ajax({
		  url: "qvision/CRM/find_gst.php?city_id="+c+"&states_id="+states_id+"&txt_org_name="+txt_org_name,
		   type: "GET",
		   dataType: 'json',              
		   success:function(data){
			 $.each(data, function(index, element) {
				$('#branch_gst_no').val(element.gst_no);
			 });
		   }
	  });
}
</script>    
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

$(document).ready(function () 
 {      
$(".gsti").change(function () {    
                var inputvalues = $(this).val();    
                var gstinformat = new RegExp('^([0][1-9]|[1-2][0-9]|[3][0-7])([a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9a-zA-Z]{1}[zZ]{1}[0-9a-zA-Z]{1})+$');    
                if (gstinformat.test(inputvalues)) {    
                    return true;    
                } else {    
                    alert('Please Enter Valid GST Number');    
                    $(".gsti").val('');    
                    $(".gsti").focus();    
                }    
            });          
 });  
 
  </script>  
<script>

/* $(document).ready(function() {
$('#Product').on('change', function() {

var Product = this.value;
//alert(Product);
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
function productstatus(value)
{
if(value=='3')
{
document.getElementById('services').style.visibility = "hidden";

}
else
{
document.getElementById('services').style.visibility = "visible";
}
} */
</script>
<script>

/* function plant_insert(event)
{
	var data = $('form').serialize();

	
	var gst_value = document.getElementById("txt_gst_no").value;
			 
     var pan_value = document.getElementById("txt_pan_no").value;
	 
	var orge_type = document.getElementById("txt_org_name").value;
	
	var state_type = document.getElementById("state_1").value;
	var txt_address_1 = document.getElementById("txt_address").value;
	var txt_client_name = document.getElementById("txt_client_name").value;
	alert()
	alert(txt_client_name)
	var txt_mobile1 = document.getElementById("txt_mobile1").value;
	var txt_mail_id = document.getElementById("txt_mail_id1").value;
	var client_desig = document.getElementById("txt_client_desig").value;
	var Location = document.getElementById("Location").value;
  if(Location==''){
		alert("Please Enter Location"); 
		event.preventDefault();
	 }
    if(state_type==''){
		alert("Please Select State"); 
		event.preventDefault();
	 }
	 var city_type = document.getElementById("city_1").value;

    if(city_type==''){
		alert("Please Select City"); 
		event.preventDefault();
	 }

if(txt_address_1==''){
	alert("Please Enter Address");
	event.preventDefault();
	}
	if(txt_client_name==''){
	alert("Please Enter Client Name");
	event.preventDefault();
	}
	if(client_desig==''){
	alert("Please Enter Client Designation");
	event.preventDefault();
	}
	if(txt_mobile1==''){
	alert("Please Enter Mobile Number");
	event.preventDefault();
	}
	if(txt_mail_id==''){
	alert("Please Enter Mail ID");
	event.preventDefault();
	}		
	if(orge_type==''){
	alert("Please Enter Organization Type");
	event.preventDefault();
	}

	$orge_type_value = orge_type.split("-");
		//alert($orge_type_value[0])

	
		if($orge_type_value[0] != '7')
		{
			if(gst_value == "" ){
				alert("Please Enter GST Number");
				
			event.preventDefault();
		    }else{
				//alert("Client Details Added Successfully")
				//	$('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');	
				$.ajax({
					type:'GET',
					data:data,	
					url:'qvision/CRM/insert_client_enquiry.php',
					success:function(result)
					{	
						//alert(result)
						  if(result=='1')
						{							
						alert("Client Details Added Successfully");						  
						  enquiry()
						}
						else
						{
							return false;
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
					url:'qvision/CRM/insert_client_enquiry.php',
					success:function(result)
					{
                        //alert(result)
					     if(result==1)
						{
							
						alert("Client Details Added Successfully");
						 lead()
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
		customer_db();
	/* $.ajax({
	type:"POST",
		url:"qvision/masters/client_master/client_master.php",
		success:function(data){
		$("#main_content").html(data);
		}
		}) */
	}


	

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
function getempdata(v)
{
	
			   $.ajax({
				  url: "qvision/CRM/find_emp_det.php?department_id="+v,
                   type: "POST",
					success: function(data){
						
					$("#employee").html(data);
					}
					});
}

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
 
 function getgstdata(v,c)
 {
	var states_id = document.getElementById("state_1").value;
	var txt_org_name = document.getElementById("txt_org_name").value;

	  $.ajax({
		  url: "qvision/masters/client_master/find_gst.php?city_id="+c+"&states_id="+states_id+"&txt_org_name="+txt_org_name,
		   type: "GET",
		   dataType: 'json',              
		   success:function(data){
			 $.each(data, function(index, element) {
				$('#txt_gst_no').val(element.gst_no);
			 });
		   }
	  });
}
 //min date 
var ftoday = new Date();

var fdd = ftoday.getDate();
var fdate=fdd-1;
var fmm = ftoday.getMonth()+1; //January is 0 so need to add 1 to make it 1!
var fyyyy = ftoday.getFullYear();
if(fdate<10){
  first_date='0'+fdate
}else{
  first_date=fdate
}
if(fmm<10){
  first_month='0'+fmm
}else{
  first_month=fmm
}	
//max date fixed
var stoday = new Date();
var sdd = stoday.getDate();
var smm = stoday.getMonth()+1; //January is 0 so need to add 1 to make it 1!
var syyyy = stoday.getFullYear();
if(sdd<10){
  nextdd='0'+sdd
}else{
  nextdd=sdd
}

mintoday = fyyyy+'-'+first_month+'-'+first_date;
maxtoday = syyyy+'-'+smm+'-'+nextdd;
//alert(maxtoday);
document.getElementById("date").setAttribute("min", mintoday);
document.getElementById("date").setAttribute("max", maxtoday);
//end date 
</script>


<!--Followup  date-->
<script>
//Followup  date 
var mintoday = new Date();
var mindd = mintoday.getDate();
//var date=dd;
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
//alert(mintoday);
document.getElementById("Follup").setAttribute("min", mintoday);


//start max date after six month 
var fptoday = new Date();
var fpmaxdd = fptoday.getDate();
//var date=dd;



//future_year = today.year + ((today.month + 6) // 12)

 //January is 0 so need to add 1 to make it 1!

var today = moment();
var nextMonth = today.add('month', 6);
var nextdate =nextMonth.format('YYYY-MM-DD');
document.getElementById("Follup").setAttribute("max", nextdate);
</script>   

 <script>
   $(document).ready(function(){
     // File type validation
    var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office','application/text','image/jpeg', 'image/png', 'image/jpg'];
    $("#file").change(function() {
        for(i=0;i<this.files.length;i++)
		{
            var file = this.files[i];
            var fileType = file.type;
			
            if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
                alert('Sorry, only TXT, PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
                $("#file").val('');
                return false;
            }
			 if(!empty($_FILES['file']))
			{
				$path = "uploads/";
				$path = $path . basename( $_FILES['file']['doc_name']);
				$file_name= basename( $_FILES['file']['doc_name']);
				if(move_file($_FILES['file']['tmp_name'], $path)) {
				  echo "The file ".  basename( $_FILES['file']['doc_name']). 
				  " has been uploaded";
				} else{
					echo "There was an error uploading the file, please try again!";
				}
				  $insert_query=$con->query("INSERT INTO upload_file(file_upload) VALUES ('$file_name')");
				 echo "INSERT INTO upload_file(file_upload) VALUES ('$file_name')";
			}
        }
    });
	});
   </script>
   <script>
		  $(document).ready(function(){  
		$("form[name='fupForm3']").on("submit", function(ev) {
		 ev.preventDefault();

var branch_type = document.getElementById("branch_type").value;
//alert(branch_type)

if(branch_type==2){
	
	var branch_client = document.getElementById("branch_client").value;
	var branch_desg = document.getElementById("branch_desg").value;
	var branch_gst_no = document.getElementById("branch_gst_no").value;
	var branch_mob = document.getElementById("branch_mob").value;
	var branch_mail = document.getElementById("branch_mail").value;
	var state_2 = document.getElementById("state_2").value;
	var city_2 = document.getElementById("city_2").value;
	var branch_location = document.getElementById("branch_location").value;
	var branch_pin = document.getElementById("branch_pin").value;
	
	if(branch_client==""){
	alert("Please Enter Branch Client Name")
	return false;
	}
	if(branch_desg==""){
	alert("Please Enter Client Designation")
	return false;
	}
	if(branch_location==""){
	alert("Please Enter Branch location")
	return false;
	}
	if(branch_mob==""){
	alert("Please Enter Branch Mobile Number")
	return false;
	}
	if(branch_mail==""){
	alert("Please Enter Branch Mail ID")
	return false;
	}
	if(branch_gst_no==""){
	alert("Please Enter Branch GST")
	return false;
	}
	if(branch_gst_no==""){
	alert("Please Enter Branch GST")
	return false;
	}
	if(state_2==""){
	alert("Please Select Branch State")
	return false;
	}
	if(city_2==""){
	alert("Please Select Branch City")
	return false;
	}
	
}


var formData = new FormData(this);
//$('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');	  
           $.ajax({  
                url:'qvision/CRM/insert_client_enquiry.php',
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
				processData: false,
                success:function(result)  
                {  
               
                           alert("Client Details Added Successfully")					
						 customer_db()
                }  
           });  
      });  
	   }); 

function branchstatus(value)
{
	//alert(value)
if(value=='1')
{
document.getElementById('deps1').style.display = "none";
document.getElementById('loc1').style.display = "none";
document.getElementById('pin1').style.display = "none";
document.getElementById('State1').style.display = "none";
document.getElementById('City1').style.display = "none";
document.getElementById('gst1').style.display = "none";
document.getElementById('pan1').style.display = "none";

}
else
{
document.getElementById('deps1').style.display = "revert";
document.getElementById('loc1').style.display = "revert";
document.getElementById('pin1').style.display = "revert";
document.getElementById('State1').style.display = "revert";
document.getElementById('City1').style.display = "revert";
document.getElementById('gst1').style.display = "revert";
document.getElementById('pan1').style.display = "revert";

}
}   
</script>