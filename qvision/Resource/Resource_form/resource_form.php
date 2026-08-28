<?php
require '../../../connect.php';
?>

<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
</style>

<div class="card card-primary">
  <div class="card-header">
   <h3 class="card-title"><font size="5">Resource Form</font></h3>
   <!-- a onclick="back_to_rsrcelist()"  style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"> </i>Back</a -->
  </div>
   <form method="POST" enctype="multipart/form-data"  id="fupForm1"> 
    <table class="table table-bordered">
    
	   <tr>
		    <td>Source: *</td>
			<td colspan="5">
			<select class="form-control" id="source" name="source" onchange="get_consname(this.value)" required>
			<option value="">Choose Source</option>
			<?php $stmt = $con->query("SELECT * FROM source_master where status=1");
			while ($row = $stmt->fetch()) 
			{?>
			<option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
			<?php 
			} ?>
			</select>
			</td>
      </tr>
		
		<tr id="cname">
			<td>Consultant Name:</td>
			<td colspan="5">
			<select  id="consl_name" name="consl_name" class="form-control">
		      <option value=""> Choose Consultant </option>
		       <?php $sql = $con->query("SELECT * FROM consultant_master WHERE status =1 ");
		        while ($row3 = $sql->fetch()) 
		        {
	        	?>
		        <option value="<?php echo $row3['consultant_id']; ?>"> <?php echo $row3['consultant_name']; ?> </option>
		       <?php 
		       } 
	           ?>
		   </select>
			</td>
		</tr>
		

		<tr id="refer_type">
        <td>Referal Type</td>
        <td colspan="5">
		<select class="form-control" id="referal_type" name="referal_type" onchange="get_referal(this.value)">
		<option value="">Choose Referal Type</option>
		<option value="Internal Referal">Internal Referal</option>
		<option value="External Referal">External Referal</option>
        </select> 
		</td>		
		</tr>	
	   
	   <tr id="internal_refer_name">
	    <td>Referal Name</td>
        <td colspan="5">
		<select  id="get_ref_name" name="get_ref_name" class="form-control">
		<option value=""> Choose Referal </option>
		<?php $stmt1 = $con->query("SELECT * FROM staff_master WHERE status=1");
		while ($row1 = $stmt1->fetch()) 
		{
		?>
		<option value="<?php echo $row1['id']; ?>"> <?php echo $row1['emp_name']; ?> </option>
		<?php 
		} 
	   ?>
		</select>
		</td>
	   </tr>
	   
	    <tr id="external_refer_name">
		    <td>Referal Name:</td>
			<td colspan="5"><input type="text" class="form-control" name="get_ref_name2" id="get_ref_name2"  Autocomplete="off">
			</td>
       </tr>
	   
		<tr>
			<td>Date:*</td>
			<td colspan="5"><input type="date" class="form-control" name="consl_date" id="consl_date" required>
			</td>
		</tr>
		
		<tr>
		<td>Post Applied for: *</td>
<td colspan="5">
    <select class="form-control" id="position" name="position" onchange="getclientandlocation(this.value);" required>
        <option value="">Choose JD</option>
        <?php
        $stmt1 = $con->query("SELECT distinct *, j.status as status, j.id as jid FROM `jobdescription_form_details` j JOIN jobdescription_master m ON j.jobdescription_id=m.id WHERE m.status=1 and j.status=5");
        $uniqueData = array(); // Store unique data
        
        while ($row1 = $stmt1->fetch()) {
            $uniqueKey = $row1['id'] . '.' . $row1['jdcode'];
            if (!in_array($uniqueKey, $uniqueData)) {
                $uniqueData[] = $uniqueKey; // Store unique key to prevent duplicates
                ?>
                <option value="<?php echo $uniqueKey; ?>"> <?php echo $row1['tittle'] . ' ' . $row1['jdcode']; ?> </option>
                <?php
            }
        }
        ?>
    </select>
</td>
		</tr>

		<tr>
	     <td>Client Org Name*</td>
		 <td>
		 <select required aria-required="true" class="form-control" id="Client_Org_Name" name="Client_Org_Name" onchange="locationget(this.value);" >
				<option value="">Client Org Name</option>
			    </select>
				<br>
				<select required aria-required="true" class="form-control" id="location" name="location">
				<option value="">Location</option>
			    </select>
				</td>
		 </tr>
			<div id="product_detail">
			</div>
			<tr>
				
			</tr>
        <tr>
			<td colspan="6"><center><b>Personal Details</b></center></td>
        </tr>
		
        <tr>
			<td>First Name: *</td>
			<td colspan="2"> <input type="text" class="form-control" id="first_name" name="first_name" Autocomplete="off" required> </td>
			<td>Last Name: *</td>
			<td colspan="2"> <input type="text" class="form-control" id="last_name" name="last_name" Autocomplete="off" required> </td>
        </tr>
		
         <tr>
			<td>Gender:</td>
			<td colspan="2"> <label>
		    <input type="radio" name="gender" value="male" checked>&nbsp;Male</label>
			</td>
			<td colspan="2">
	        <label>	<input type="radio" name="gender" value="female">&nbsp;Female</label>
		    </td>
	     </tr>
       
       
	   <tr>
        <td>Mobile Number: *</td>
        <td colspan="5"> <input type="text" class="form-control" id="phone" name="phone" onchange="CheckIndianNumber(this.value)" Autocomplete="off" maxlength="10" required></td>
        </tr>
		
        <tr>
        <td>WhatsApp Number: </td>
        <td colspan="5"> <input type="text" class="form-control" id="whatsapp" name="whatsapp" onchange="CheckIndianNumber1(this.value)" Autocomplete="off" maxlength="10"></td>
        </tr>
		
        <tr>
        <td>Email ID : *</td>
        <td colspan="5"> <input type="text" class="form-control" id="mail" name="mail" onchange="ValidateEmail(this.value)" Autocomplete="off" required></td>
        </tr>
		
        <tr>
        <td>Aadhar Number: </td>
        <td colspan="4">
		<input type="text" class="form-control" id="adharnumber" name="adharnumber"   Autocomplete="off"  maxlength="14">
		</td>
        </tr>
		
    
		<tr>
		<td colspan="6"><center><b>Educational Qualification</center></b></td>
		</tr>
		
		<tr>
        <td>Degree: *</td>
        <td colspan="4"> <input type="text" class="form-control" id="degree" name="degree" Autocomplete="off" required>
		</td>
        </tr>
		
       <tr>
        <td>University: </td>
        <td colspan="4"> <input type="text" class="form-control" id="university" name="university" Autocomplete="off">
		</td>
        </tr>
		
		<tr id='employee_new1'>
		<td>Percentage</td>
        <td colspan="4"> <input type="text" class="form-control" id="percentage" name="percentage" Autocomplete="off" ></td>
        </tr>
		
		<tr>
        <td>Employement Status:</td>
        <td colspan="4">	
		<select class="form-control" id="EmployeeStatus" name="EmployeeStatus" onchange="emp_status(this.value)">
		<option value="">Choose Employeement Status</option>
		<option value="Fresher">Fresher</option>
		<option value="Experience">Experience</option>
		</select>
		</td>
        </tr>
		
		<tr id='employee_new'>
		<td>Year of Passout </td>
        <td colspan="4"><input type="text" class="form-control" id="year_of_pass" name="year_of_pass" Autocomplete="off" ></td>
        </tr>
		
		<tr id='employee_status'>
        <td>Company Name:</td>
        <td colspan="2"><input type="text" class="form-control" id="companyname" name="companyname" Autocomplete="off"></td>
		<td>No of Year Experience:</td>
        <td colspan="2"><input type="text" class="form-control" id="no_of_year" name="no_of_year" Autocomplete="off"></td>
        </tr>
		
		<tr>
		<td colspan="6"><center><b>Certification Details</center></b></td>
		</tr>
		
		<tr>
        <td>Certification:</td>
        <td colspan="4">	
		<select class="form-control" id="cer_status" name="cer_status" onchange="cer_status1(this.value)">
		<option value="">Choose Certification Status</option>
		<option value="YES">Yes</option>
		<option value="NO">No</option>
		</select>
		</td>
        </tr>	
		
		<tr id='certificate_status'>
        <td>Certificate: *</td>
        <td colspan="2"><input type="text" class="form-control" id="certificate" name="certificate" Autocomplete="off" ></td>
		</tr>
		
		<tr id='validity'>
		<td>Validity From: *</td>
        <td colspan="2"><input type="date" class="form-control" id="validity" name="validity" ></td>
		<td>Validity To: *</td>
        <td colspan="2"><input type="date" class="form-control" id="cer_from" name="cer_from" ></td>
        </tr>
		
		<tr>
        <td>Resume: *</td>
        <td colspan="5">
		 <input type="file" class="form-control" id="file" name="file[]" accept=".doc,.docx,.pdf" required>
		</td>
        </tr>
		 
   <tr>  
    <td colspan="6">
	<input type="submit" class="btn btn-success" name="save"  style="float:right;" value="save" > <!--onclick="resource_formS()" -->
    </td>
   </tr>
		
        </table>
        <!-- /.post  -->
    </form>
    </div>



  <script type="text/javascript"> 
function getclientandlocation(val) {
  var clientorg = $('#Client_Org_Name');
  
  clientorg.empty();
  var optionval = "Client Org Name"; // Placeholder text for the first option

  // Append the placeholder option at the top
  clientorg.append($('<option disabled selected value="">'+ optionval +'</option>'));
  
  // Extract the ID part from the combined val
  var valArray = val.split('.');
  var id = valArray[0];

  $.ajax({
    type: "POST",
    url: "qvision/Resource/Resource_form/clientandloactionget.php?id=" + id,
    success: function (data) {
      var data2 = data.split("||");
      var twodataln = data2.length;
      
      for (var j = 0; j < twodataln - 1; j++) {
        clientorg.append($('<option value="' + data2[j] + '">' + data2[j] + '</option>'));
      }
    }
  });
}

  function locationget(val)
  {
	  var postapplied = $('#position').val();
      // Extract the ID part from the combined postapplied val
      var postappliedArray = postapplied.split('.');
      var postappid = postappliedArray[0];

	   var select = $('#location');
			select.empty();

	   $.ajax({
	type:"POST",
	url:"qvision/Resource/Resource_form/getloactionfromorgname.php?id="+val+"&postappid="+postappid,
	success:function(data)
	{
		  var data2=data.split("||");
		  
		  var twodataln=data2.length;
		        
		  
		  for( var j=0;j< (twodataln-1);j++)
		  {
				   select.append($('<option value="' + data2[j] + '">' + data2[j] + '</option>'));
		  }
	}
	});
  }
  
  //mobile no validation
    function CheckIndianNumber(b)   
    {  
        //var a = /^\d{10}$/;
		var a = /[6-9]{1}[0-9]{9}$/;  
        if (a.test(b))   
        {  
            //alert("Your Mobile Number Is Valid.")  
        }   
        else   
        {  
            alert("Your Mobile Number Is Not Valid.")  
			$('#phone').val('');
        }   
    };
//alternative no	
	function CheckIndianNumber1(b)   
    {  
        //var a = /^\d{10}$/;
		var a = /[6-9]{1}[0-9]{9}$/;  
        if (a.test(b))   
        {  
            //alert("Your Mobile Number Is Valid.")  
        }   
        else   
        {  
            alert("Your Mobile Number Is Not Valid.")  
			$('#whatsapp').val('');
        }   
    };  
	
	//Email address
	 function ValidateEmail(email) 
	 {
		 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            //var address = document.getElementById[email].value;
            if (reg.test(email) == false) 
            {
                alert('Invalid Email Address');
                //return (false);
				$('#mail').val('');
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
      
</script>


<script>
//consultant name
function get_consname(value)
{
//alert(value);
if(value==2)
{
 $('#cname').show();
 $('#refer_type').hide();
 $('#internal_refer_name').hide();
 $('#external_refer_name').hide();
}
else if(value==8)
{
  $('#refer_type').show();
  $('#cname').hide();
}
else
{
 $('#cname').hide();
 $('#refer_type').hide();
 $('#internal_refer_name').hide();
 $('#external_refer_name').hide();
}
}
$(document).ready (function(){	
	$('#cname').hide();
    $('#refer_type').hide();
    $('#internal_refer_name').hide();
    $('#external_refer_name').hide();
  
//Current Date  
var mintoday = new Date();
var mindd = mintoday.getDate();
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
// Set Minimum date
document.getElementById("consl_date").setAttribute("min", mintoday);
});



//Employeement status
function emp_status(value)
{
	//alert(value);
if(value=="Fresher")
{
$('#employee_status').hide();
$('#employee_new').show();
}
else
{
$('#employee_status').show();
$('#employee_new').hide();
}
}

$(document).ready (function(){
	
	$('#employee_status').hide();
    $('#employee_new').hide();
});




//certification status
function cer_status1(value)
{

            const validity = document.getElementById('validity');
            const certificateInput = document.getElementById('certificate');
            const cerFromInput = document.getElementById('cer_from');

	//alert(value);
 if(value=="YES")
{
document.getElementById('certificate_status').style.visibility = "visible";
document.getElementById('validity').style.visibility = "visible";
validity.setAttribute('required', 'required');
certificateInput.setAttribute('required', 'required');
cerFromInput.setAttribute('required', 'required');

}
else
{
document.getElementById('certificate_status').style.visibility = "hidden";
document.getElementById('validity').style.visibility = "hidden";
validity.removeAttribute('required');
certificateInput.removeAttribute('required');
cerFromInput.removeAttribute('required');

} 
}

// function resource_formS()
// {
// 	var field=1;
// 	var data = $('form').serialize();
// 	$.ajax({
// 		type:'GET',
// 		data: data + "&" + "field="+field,
// 		url:'qvision/Resource/Resource_form/resource_form_submit.php',
// 		success:function(data)
// 		{   
//          if(data==0)
//        { 
//          alert("Form Data has not been Submitted");
// 		 resource_list();
//         }
//        else
//       {
//         alert("Form Data has been Submitted");
// 		resource_list();
//       }
      
//     } 		
// 	});
// }


$(document).ready(function(){
    // Submit form data via Ajax
    $("#fupForm1").on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url:'qvision/Resource/Resource_form/resource_form_submit.php', 
            data: new FormData(this),
            contentType: false,
            processData: false,
            success:function(data)
		    {   
			data = $.trim(data);
            if(data==0){ 
              alert("Form Data has not been Submitted");
			  console.warn("data:"+data);
		      resource_list();
            }
            else{
              alert("Form Data has been Submitted");
			  console.warn("data:"+data);
		      resource_list();
            }
		    },
		    error:function(xhr, status, error) {
			    alert("Server Error: " + error);
		    }
        });
    });

});

 function back_to_rsrcelist()
 {
	 resource_list()
	 
 }

function get_referal(v)
{
	var value=v;
	
	if(value=="Internal Referal")
	{
		$('#internal_refer_name').show();
		$('#external_refer_name').hide();			
	}
	else if(value =="External Referal")
	{
		$('#internal_refer_name').hide();
		$('#external_refer_name').show();	
	}
}

</script>

