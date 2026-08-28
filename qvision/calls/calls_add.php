<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>

<!-- <section class="content"> -->

<div class="card">
<div class="card-header">

<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
</div>
<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">

    <form method="POST" name="fupForm" id="fupForm" enctype="multipart/form-data">
  
    <table class="table table-bordered">
      
      
        <tr>
        <td colspan="6"><center><b>New Enquiry</b></center></td>
        </tr>
		<tr>
                <td>Call Type</td>
                <td colspan="5">
                    <select class="form-control" id="cust_type" name="cust_type" onchange="callstatus(this.value)">
                        <option value="">Choose Type</option>
						<option value="1">Corporate</option>
                        <option value="2">Individual</option>
						<!--<option value="3">Individual Customer</option>   onchange="get_consultant(this.value)"-->
                        

                    </select></td>
            </tr>
		<tr>
                <td>Call Source</td>
                <td colspan="5">
                    <select class="form-control" id="Call_type" name="Call_type" >
                        <option value="">Choose Source</option>
                        <?php
                        $stmt = $con->query("SELECT * FROM calls_master");
                        while ($row = $stmt->fetch()) {
                            ?>
                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
<?php } ?>
                    </select></td>
            </tr>
		 <tr id="cor2">
                <td>Client Type</td>
                <td colspan="5">
                    <select class="form-control" id="client_type" name="client_type" onchange="clientstatus(this.value)">
                        <option value="">Choose Client Type</option>
						<option value="2">New</option>
                        <option value="1">Existing</option>
						<!--<option value="3">Individual Customer</option>-->
                        

                    </select></td>
            </tr>
			 <tr id="ind1">
                <td>Individual Customer Type</td>
                <td colspan="5">
                    <select class="form-control" id="client_type1" name="client_type1" onchange="cusstatus(this.value)">
                        <option value="">Choose Customer Type</option>
						<option value="3">New</option>
                        <option value="4">Existing</option>
						<!--<option value="3">Individual Customer</option>-->
                        

                    </select></td>
            </tr>
        <tr id="comp1">
        <td>Company Name*</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Company Name" id="client_org1" name="client_org1" ></td>
        </tr>
		<tr id="comp2" style="display:none;">
					<td>Company Name*</td>
					<td colspan="5">
						<select class="form-control" name="client_orgg" onChange="record_fetch(this.value)" id="client_orgg">
						<option value="">Choose Company Name</option>
								<?php 
								$query = $con->query("SELECT distinct org_name,id as org_id FROM new_client_master");
								while ($row_fetch = $query->fetch()) {?>	
								
								<option value="<?php echo $row_fetch['org_id']; ?>-<?php echo $row_fetch['org_name']; ?>"> <?php echo $row_fetch['org_name']; ?> </option>
								<?php } ?>
						</select>
					</td>
				</tr>
		 <tr id="cli1">
        <td>Client Name*</td>
        <td colspan="5"><input type="text" class="form-control" id="client_name" placeholder="Enter Name" name="client_name" onKeyPress="return ValidateAlpha(event);" ></td>
        </tr>
		<script>
		 function ValidateAlpha(evt)
    {
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
         
        return false;
            return true;
    }
		</script>
		<tr id="cli2" style="display:none;">
					<td>Client Name*</td>
					<td colspan="5">
					<select class="form-control" name="client_org" id="client_org"  >
					<option value="">Choose Client Name</option>
							<?php 
							$query = $con->query("SELECT distinct client_name,id FROM individual_form");
							while ($row_fetch = $query->fetch()) {?>	
							
							<option value="<?php echo $row_fetch['client_name']; ?>"> <?php echo $row_fetch['client_name']; ?> </option>
							<?php } ?>
                     </select>
					</td>
				</tr>
      <tr>
        <td>Contact Number*</td>
        <td colspan="5"><input type="text" class="form-control mob" maxlength="10" id="contact" placeholder="Enter Contact No" name="contact" required></td>
        </tr>
		<tr>
        <td>Whatsapp Number</td>
        <td colspan="5"><input type="text" maxlength="10" class="form-control wmob"id="whatsapp" placeholder="Enter Whatsapp No" name="whatsapp"></td>
        </tr>
		  <tr>
        <td>Email Id*</td>
		
        <td colspan="5"><input type="mail" class="form-control finmail" id="email" placeholder="Enter Email" name="email"  required autocomplete="off"></td>
        </tr>
		
		 <tr>
                <td>Alternative Mail_id</td>
                <td colspan="5">
                    <input type="mail"  id="mail" name="mail" class="form-control mail"  placeholder="Enter Mail" >
                </td>
            </tr>
			
			<!--<tr id="pan">
        <td>Pan No*</td>
        <td colspan="5"><input type="text" class="form-control" id="pan" placeholder="Enter Pan" name="pan"></td>
        </tr>-->
			<tr>
        <td>Address*</td>
        <td colspan="5"><input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" required></td>
        </tr>
		
			  <tr id="cor3">
        <td>Website</td>
        <td colspan="5"><input type="text" class="form-control" id="website" placeholder="Enter Website" name="website" ></td>
        </tr>
   
	  <tr>
					<td>Product/Service*</td>
					<td colspan="5">
						<select name="Product" class="form-control" id="Product" onchange="productstatus(this.value)" required>
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
					 <select class="form-control" name="services" id="services" ></select>				
					</td>
				</tr>
				 <tr>
		<td>Attach File</td>
		<td colspan="5">
		<input type="file" class="form-control"  id="attachfile" name="attachfile[]" ></td>
     </tr>
    <tr>
        <td>Remarks</td>
        <td colspan="5"><input type="text" class="form-control" id="remarks" placeholder="Enter Remarks" name="remarks"></td>
        </tr>
		 </table>
        <!-- /.post -->
		
		  <table class="table table-bordered" id="new_tab">
                    <tr>
                    <h3><center>Feedback Entry </center></h3>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Feedback</th>
                        <th>Feedback Date</th>
<th>Followup Date</th>
                    </tr>


                    <tr>
                        <td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/></td>

                        <td><input type="text" class="form-control" id="feedback" name="feedback1[]" required></td>
                        <td><input type="date" class="form-control" id="feedback_date" name="feedback_date1[]"></td>
						<td><input type="date" class="form-control" id="fed_date" name="fed_date1[]"></td>
                        <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
                            <input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
                        </td>
						
						
						
                    </tr>


                </table>
		 <td colspan="6"><input type="submit" class="btn btn-success" name="save" value="save"></td>
	
    </form>
    </div>
    </div>
    </div>
    </div>
   
    </section>
<script>
function record_fetch(a){
	var arr = a.split('-');
	var id = arr[0];
	$.ajax(
		{
			type:'GET',
			data:'id='+id,
			url:"qvision/calls/existing_data.php",
			dataType: 'json',
			success:function(value)
			{
			  if(value != null)
				{ 
					$.each(value, function(index, element)
					{
						$('#client_name').val(element.it_name);
						$('#contact').val(element.it_mob1);
						$('#email').val(element.it_mail1);
						$('#mail').val(element.it_mail2);
						$('#address').val(element.address);
						$('#website').val(element.website);
						
					});
				}  
			}			
		})	
}
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
}
	$(document).ready(function(){  
		$("form[name='fupForm']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);
  
           $.ajax({  
                 url:"qvision/calls/calls_submit.php",
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
				processData: false,
                success:function(data)  
                {  
				 if(data==0)
						{
							
						alert("Calls Not Added");
						  
						 
						}else if(data==1){
                    alert('Calls Added Successfully'); 
                  
				  calls()
                }  }
           });  
      });  
	   }); 
		
	function back()
	
	{
		 calls()

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





function cusstatus(value)
    {
		//alert(value)
        if (value == '4')
        {
			
			 var ddlPassport = document.getElementById("fupForm");
			  document.getElementById("cli2").style.display = "revert";
            
			   

        } else
        {
           document.getElementById("cli2").style.display = "none";

        }
		if (value == '3')
        {
               var ddlPassport = document.getElementById("fupForm");
			  document.getElementById("cli1").style.display = "revert"; 

        } else
        {
           document.getElementById("cli1").style.display = "none";

        } 
		
    }
	

 function callstatus(value)
    {
        if (value == '1')
        {
         
			  var ddlPassport = document.getElementById("fupForm");
			  document.getElementById("cor2").style.display = "revert"; 
			  var ddlPassport = document.getElementById("fupForm");
			  document.getElementById("cor3").style.display = "revert";
			   document.getElementById("cli2").style.display = "none";
			  
        } else
        {
         
           document.getElementById("cor2").style.display = "none";
           document.getElementById("cor3").style.display = "none";
          

        }
		if (value == '2')
        {
			var ddlPassport = document.getElementById("fupForm");
			  document.getElementById("ind1").style.display = "revert";
             document.getElementById("comp1").style.display = "none";
             document.getElementById("comp2").style.display = "none";
            
			  
        } else
        {
          
           document.getElementById("ind1").style.display = "none";
           document.getElementById("ind2").style.display = "none";

        }
	    } 
		


function clientstatus(value)
    {
        if (value == '1')
        {
			
			 var ddlPassport = document.getElementById("fupForm");
			  document.getElementById("comp2").style.display = "revert";
             

        } else
        {
           document.getElementById("comp2").style.display = "none";

        }
		if (value == '2')
        {
              var ddlPassport = document.getElementById("fupForm");
			  document.getElementById("comp1").style.display = "revert";

        } else
        {
           document.getElementById("comp1").style.display = "none";

        } 
	}

</script>
<script>
    function check() // education
    {
        var len = $('#new_tab tr').length;
        len = len + 1;
        $('#new_tab').append('<tr class="row_' + len + '"><td><input type="checkbox" class="chk" name="chk[]" id="chk_' + len + '" value="' + len + '"</td><td><input type="text" class="form-control" id="feedback' + len + '" name="feedback1[]"></td><td><input type="date" class="form-control" id="feedback_date' + len + '" name="feedback_date1[]"></td><td><input type="date" class="form-control" id="fed_date' + len + '" name="fed_date1[]"></td></tr>');
    }



    $('#enquiry_row_remove').click(function () {
        $('input:checkbox:checked.chk').map(function () {
            var id = $(this).val();
            var le = $('#new_tab tr').length;

            if (le == 1)
            {
                alert("You Can't Delete All the Rows");
            } else
            {
                $('.row_' + id).remove();
            }

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
    
 //Mail validations           
$(".finmail").change(function () {      
var inputvalues = $(this).val();      
  var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(inputvalues)){      	
  $(".finmail").val("");    
  alert("Please Enter Valid Mail ID");    
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
</script>
