
<?php
require '../../connect.php';
include("../../../user.php");
 $id=$_REQUEST['id']; 
$userrole=$_SESSION['userrole'];

$stmt = $con->prepare("SELECT a.id as enquiry_id,a.status as enquiry_status,
c.id as dep_id,d.id as candi_id,a.Company_name as comp_name,a.*,b.*,c.*,d.*,z.contact as crm_contact,z.whatsapp as wts_num,z.email as crm_email  FROM `enquiry` a
	   join calls_master b ON a.Call_type=b.id
	   join z_department_master c ON a.Department=c.id
	   join candidate_form_details d ON a.employee=d.id
	   left join crm_calls z on (a.id=z.enquiry_id)
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
$it_name=$row['it_name'];
$crm_contact=$row['crm_contact'];
$wts_num=$row['wts_num'];
$crm_email=$row['crm_email'];

?>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i> Individual Form
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
</div>
<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" name="fupForm" id="fupForm" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
      
		<tr>
        <td>Client Name</td>
        <td colspan="5"><input type="text" class="form-control" id="client_name" value="<?php echo  $it_name;?>" readonly name="client_name"></td>
        </tr>
      <tr>
        <td>Contact Number*</td>
		<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id;?>">
        <td colspan="5"><input type="text" class="form-control mob" maxlength="10" id="contact" value="<?php echo $crm_contact;?>" placeholder="Enter Contact No" name="contact" ></td>
        </tr>
		
		<tr>
        <td>Whatsapp Number</td>
        <td colspan="5"><input type="text" class="form-control wmob" maxlength="10" id="whatsapp" value="<?php echo $wts_num;?>" placeholder="Enter Whatsapp No" name="whatsapp" ></td>
        </tr>
		  <tr>
        <td>Email Id*</td>
        <td colspan="5"><input type="mail" class="form-control mail" id="email" value="<?php echo $crm_email;?>"placeholder="Enter Email" name="email"></td>
        </tr>
		
			<tr >
        <td>Pan No*</td>
        <td colspan="5"><input type="text" class="form-control pan" maxlength="10" id="pan" placeholder="Enter Pan" name="pan"></td>
        </tr>
		<tr>
				<td>State*</td>
				<td colspan="5">
					<select class="form-control" name="state" id="state" onchange="getcitydata(this.value)" required>
					<option value="">Choose State</option>
					<?php $stmt = $con->query("SELECT id,statename FROM states where country_id = 101");
					while ($row = $stmt->fetch()) {?>
					<option value="<?php echo $row['id']; ?>"> <?php echo $row['statename']; ?> </option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>City*</td>
				<td colspan="5"><select class="form-control" name="city" id="city"  required></select></td>
			</tr>
			<tr >
        <td>Address</td>
        <td colspan="5"> <textarea id="address" name="address" rows="4" cols="50">

</textarea></td>
        </tr>
		
  
	<!--  <tr>
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
		<td>Attach File</td>
		<td colspan="5">
		<input type="file" class="form-control"  id="attachfile" name="attachfile[]"></td>	
     </tr>
    -->
		 </table>
       
		 <td colspan="6"><input type="button" name="save" value="SAVE" onclick="ind_insert(event)" class="btn btn-primary btn-md"></td>
	
    </form>
    </div>
<script>
function ind_insert(event)
{
	
	var data = $('form').serialize();
	//alert(data)
	//alert(data)
	var client_name  = document.getElementById("client_name").value;
	var id  = document.getElementById("id").value;
	var contact  = document.getElementById("contact").value;
	
	var whatsapp    = document.getElementById("whatsapp").value;
	var email  = document.getElementById("email").value;
	var pan=document.getElementById("pan").value;
	var address=document.getElementById("address").value;
	var state=document.getElementById("state").value;
	var city=document.getElementById("city").value;
	
	
	$.ajax({
		type:'GET',
		//data: data + "&" + "field="+field,
		data:'client_name='+client_name+'&id='+id+'&contact='+contact+'&whatsapp='+whatsapp+'&email='+email+'&pan='+pan+'&address='+address+'&state='+state+'&city='+city,
		 url:"qvision/CRM/calls/insert_individual.php",
		success:function(result)
		{
			//alert(result)
						 if(result==1)
						{	
                           alert("Form Details Added Successfully")					
						  Cost_sheet()
						}else if(result==0){
							alert("Please Give Pan Number / Pan Number already exists..");
						}else if(result==3){
							alert("Please Fill All Details");
						}else{
							event.preventDefault();
				 
			}
			
		   
		}       
	});
	
}


	function back()
{
  Cost_sheet()
}
	
	function clientstatus(value)
    {
        if (value == '1')
        {
              var ddlPassport = document.getElementById("fupForm");
			  document.getElementById("old").style.display = "revert";

        } else
        {
           document.getElementById("old").style.display = "none";

        }
		if (value == '2')
        {
              var ddlPassport = document.getElementById("fupForm");
			  document.getElementById("dep1").style.display = "revert";

        } else
        {
           document.getElementById("dep1").style.display = "none";

        }
		if (value == '3')
        {
              document.getElementById("dep1").style.display = "none";
			    document.getElementById("old").style.display = "none";
			    document.getElementById("web").style.display = "none";

        } else
        {
          

        }
    }
	</script><script>
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

  //Mobile Number Validation      
$(".mob").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;    
  if(!regex.test(inputvalues)){      	
  $(".mob").val("");    
  alert("Please Enter Valid Mobile Number");    
  return regex.test(inputvalues);    
  }    
});

$(".wmob").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;    
  if(!regex.test(inputvalues)){      	
  $(".wmob").val("");    
  alert("Please Enter Valid Mobile Number");    
  return regex.test(inputvalues);    
  }    
});
    

$(".mail").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
  if(!regex.test(inputvalues)){      	
  $(".mail").val("");    
  alert("Please Enter Valid Mail ID");    
  return regex.test(inputvalues);    
  }    
}); 

  //PAN NUMBER validation            
$(".pan").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^([a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1})+$/;    
 
  if(!regex.test(inputvalues)){      	
  $(".pan").val("");    
  alert("Please Enter Valid PAN Number");    
  return regex.test(inputvalues);    
  }    
});   

function getcitydata(c){

			  $.ajax({
				  url: "qvision/masters/client_master/find_city.php?client="+c,
                   type: "GET",
					success: function(data){

					$("#city").html(data);
					}
					});
 }
</script>