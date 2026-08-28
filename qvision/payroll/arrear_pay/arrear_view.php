<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];

$stmt = $con->query("SELECT a.*,b.emp_name FROM arrear_pay a LEFT JOIN staff_master b ON a.emp_id = b.id WHERE a.id='$id'");
$row = $stmt->fetch();
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header" style="background-color:#ff8b3d;">
<i class="fa fa-table"></i> Arrear View
<a onclick="back_to_arrears()" style="float: right;background-color:black;border:1px solid black;color:white;" data-toggle="modal" class="btn btn-primary"> <i class="fa fa-minus"></i>Back</a>
</div>

<div class="card-body" id="printableArea">
<form method="GET" enctype="multipart/type">

<table class="table table-bordered">
        <tr>
        <td><center><img src="qvision/images/logo123.jpg" alt="bluebase" style="width:150px;height:50px;"></center></td>
        <td colspan="5"><center><b>Quadsel Systems Private Limited</b></center></td>
        </tr>
     
        <tr>
        <td>Employee Name</td>
        <td colspan="5">
		<input type="text" class="form-control" name="emp_name" value="<?php echo $row['emp_name']; ?>" readonly> 
        </td>
        </tr>

        <tr>
         <td>Payroll Month</td>
         <td colspan="5">
		 <input type="text" class="form-control" name="month" value="<?php echo $row['payroll_month']; ?>" readonly>
         </td>
        </tr>
      
		<tr>
         <td>Amount</td>
         <td colspan="5">
          <input type="number" class="form-control" name="arrear_amt" value="<?php echo $row['amount']; ?>" readonly>
         </td>
        </tr>

        <tr>
         <td>Remark</td>
         <td colspan="5">
          <input type="text" class="form-control" name="arrear_remark" value="<?php echo $row['remark']; ?>" readonly>
         </td>
        </tr>
	
        </table>

</form>
</div>
</div>
</div>

<script>
function update_resource(v)
{
	//alert(v);
	 var id=v;
	var data=$('form').serialize();
	$.ajax({
		type:"GET",
		data: data + "&" + "id="+id,
		url:"qvision/masters/resource_master/resource_update.php",
		success:function(data)
		{
			if(data==1)
		{
			alert("Updated successfully");
			resource_master();
		}
		else
		{
			alert("Not Updated");
			resource_master();
		}
		}
	}) 
}
 
function back_to_arrears()
{
    arrear_pay();
}
</script>