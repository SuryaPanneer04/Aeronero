<?php
require '../../../connect.php';
include("../../../user.php");
$idd=$_REQUEST['id'];
$stmt = $con->prepare("SELECT a.id as lr_id,a.lr_details,b.invoice_no,a.file_upload  FROM lr_courier_details a left join challan_entry b on a.challan_id = b.id where b.id='$idd'"); 

$stmt->execute(); 
$row = $stmt->fetch();
?>
<head>
<style>
.card-header{
background: #007bff !important;
}
</style>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
 </head>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">LR/Courier Form</font></h3>
				<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
             </div>
<form method="POST" name="form" id="form" >

<table class="table table-bordered">
<tr>
   <td>Invoice NO</td>
   <td colspan="3"><input type="text" class="form-control" id="invoice_no" name="invoice_no" maxLength="15" value="<?php echo  $row['invoice_no'];?>" readonly></td>
</tr>
<tr>
   <td>Courier / LR Details</td>
   <td colspan="3">
      <textarea class="form-control" id="lr_details" name="lr_details"  readonly><?php echo  $row['lr_details'];?> </textarea>
   </td>
</tr>
<tr>
   <td>Courier Upload</td>
   <td>
      <a href="qvision/Purchase_process/courier_master/courier_file/<?php echo  $row["file_upload"];?>" download="<?php echo  $row["file_upload"]; ?>"><?php echo  $row["file_upload"]; ?></a>
   </td>

</tr>

		<tr>
        <td> Installation </td>
        <td colspan="5">
			<select class="form-control" name="confrmInstal" id="cnform" onchange="installset(this.value)">
				<option>  -- Select -- </option>
				<option value="1"> YES </option>
				<option value="2">  NO </option>
			</select>
		</td>
        </tr>
		
<tr id="remark">
   <td>Remark to Installation</td>
   <td>
   <textarea class="form-control" name="remark" >  </textarea>
   </td>

</tr>

</table>
<input type="hidden" name="challan_id" value="<?php echo $idd; ?>">
<input type="submit" class="btn btn-info" value="Send">
</form>
 </div>
 
<script>
$(document).ready(function(){
$('#remark').hide();

})
            $("form[name='form']").on("submit", function(ev) {
            ev.preventDefault();
            var formData = new FormData(this);
let cnform = document.querySelector('#cnform').value;

            $.ajax({
                url: "qvision/Purchase_process/courier_master/initiate_installation.php?conform= "+ cnform,
                method: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                        alert('Updated Successfully');
                        lr_courier()
                }
            });
        });


function back_ctc()
{
  lr_courier();
}

	function installset(v){
      
	if(v == 2){
		$('#remark').hide();
	}else{
		$('#remark').show();
	}
	
	}
</script>

