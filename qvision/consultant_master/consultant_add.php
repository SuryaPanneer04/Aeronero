<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
	<style>
	.card-primary:not(.card-outline)>.card-header{
		background-color: #f1cc61 !important;
	}
	</style>
<div  class="card card-primary">
              <div class="card-header">
                <h3 style="float: left;"><font size="5">NEW CONSULTANT</font></h3>
		 		  <a onclick=" back()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
		
              </div>
           
<form method="POST" action="">
<table class="table table-bordered">

	  <tr>
       <td>Consultant Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Consultant Name" id="C_name" name="C_name"></td>
        </tr>
        
        
         <tr>
        <td>Consultant Organization Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Consultant Organization Name"  name="org_name" id="org_name"></td>
        </tr>
		 <tr>
        <td>Mobile Number *</td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" onchange="CheckIndianNumber(this.value)" placeholder="+91"required></td>
        </tr>
        
        <tr>
        <td>Alternate Mobile Number</td>
        <td colspan="5"><input type="text" class="form-control" id="whatsapp" name="whatsapp" onchange="CheckIndianNumber1(this.value)" placeholder="+91"></td>
        </tr>
        <tr>
        <td>Email Id  *</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" required onchange="ValidateEmail(this.value)"></td>
        </tr>
              
		<tr>
        <td>Alternate Email Id</td>
        <td colspan="5"><input type="text" class="form-control" id="alt_mail" name="alt_mail"  onchange="ValidateEmail1(this.value)"></td>
        </tr>
        <tr>
        <td>Percentage</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Consultant Percentage" id="Percentage" name="Percentage"></td>
        </tr>
        <tr>
        <td>Status</td>
        <td colspan="4">	
		<select class="form-control" id="cer_status" name="cer_status" required>
		<option value="">Choose  Status</option>
		<option value="1">Active</option>
		<option value="2">In Active</option>
		</select>
		</td>
        </tr>	
		<td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_con()" value="save" style="float:right;"></td>
        </tr>
        </table>
</form>
</div>
<script>
		function back()
    {
 consultant_master()
  }
</script>
  <script>
  $(document).ready(function() {
$('#code').on('change', function() {
var code = this.value;
//alert(code);
$.ajax({
url: "qvision/user_role/find_role.php",
type: "get",
data: {
code: code
},
cache: false,
success: function(data){
	//alert(data);
var split=data.split("=");
//alert(split[0]);

$('#role_code').val(split[0]);

//alert(split[1]);
}
});

});

});
    function insert_con()
    {
    var id=0;
    var data = $('form').serialize();
	//alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
	url:"qvision/consultant_master/consultant_insert.php",
    success:function(data)
    {
      if(data=='0')
      { 
         alert("No Data choose");
         consultant_master()
      }
      else
      {
		 alert('Entry Successfully');
		consultant_master()
      }
      
    }       
    });
    }
	
	 function CheckIndianNumber(b)   
    {  
         var a = /^\d{10}$/;  
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
	
	function CheckIndianNumber1(b)   
    {  
         var a = /^\d{10}$/;  
        if (a.test(b))   
        {  
            //alert("Your Mobile Number Is Valid.")  
        }   
        else   
        {  
            alert("Your Mobile Number Is Not Valid.")  
			$('#a_phone').val('');
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
  function ValidateEmail1(email) 
	 {
		 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            //var address = document.getElementById[email].value;
            if (reg.test(email) == false) 
            {
                alert('Invalid Email Address');
                //return (false);
				$('#alt_mail').val('');
            }
 }
    </script>
