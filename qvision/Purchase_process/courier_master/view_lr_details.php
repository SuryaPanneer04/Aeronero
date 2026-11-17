<?php
require '../../../connect.php';
include("../../../user.php");
$idd=$_REQUEST['id'];
$stmt = $con->prepare("SELECT b.id as lr_id,b.lr_details,a.invoice_no,b.file_upload  FROM challan_entry  a left join  lr_courier_details b on b.challan_id = a.id where a.id='$idd'"); 

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
</table>
</form>
 </div>
<script>
function back_ctc()
{
  lr_courier();
}
</script>

