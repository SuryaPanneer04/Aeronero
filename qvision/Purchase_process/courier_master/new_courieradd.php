<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];

$challan_id = $_REQUEST['id'];
$emp_sql = $con->query("SELECT * FROM challan_entry where id='$challan_id'");
$emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC);
?>
<head>
<style>
.card-header{
background: #007bff !important;
}
</style>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
 </head>
<div class="card card-primary">
   <div class="card-header">
   <center><h3 class="card-title"><b>Courier Details</b></h3></center>
	<a onclick="lr_courier_back()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
 </div>

<form method="POST" action="" name="courier_form">
<table class="table table-bordered">

<tr>
<td>Invoice Number</td>
<td colspan="2">
    <input type="text" name="invoice_no" class="form-control" value="<?php echo $emp_res['invoice_no'];?>" readonly>
    <input type="hidden" name="challanId" id="challanId" value="<?php echo $challan_id;?>" >
</td>
</tr>

<tr>
<td>LR/Courier Details</td>
<td colspan="2">
	<textarea id="lr_details"  class="form-control" name="lr_details">  </textarea>
</td>
</tr>
</table>
<input type="submit" name="submit" id="submit" style="float: right;" class="btn btn-info" value="Submit" /> 
</form>
</div>

<script>  
 $(document).ready(function(){  
      var i=1;  
      
	  $("form[name='courier_form']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);	  
let id = document.querySelector('#challanId').value;
           $.ajax({  
                url:"qvision/Purchase_process/courier_master/insert_lr_courier.php?id= "+ id,  
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
    processData: false,
                success:function(data)  
                {  
                    alert('Inserted successfully'); 
                     lr_courier();
                }  
           });  
      });  
 });  
 </script>
<script>


function lr_courier_back()
{
	lr_courier();
}
</script>