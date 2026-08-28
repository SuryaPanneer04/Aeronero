<?php
require '../../config.php';
$id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT id, staff_id, staff_type_id, doj, from_date, leave_type_id, leave_name, leave_op_balance,status FROM leave_opening_balance WHERE id='$id'"); 
//echo "SELECT id, from_date, leave_name, days_per_month, days_per_year, is_cummulative, status FROM 'leave_master' WHERE id='$id'"; 
$stmt->execute(); 
$row = $stmt->fetch();

?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> LEAVE Opening Balance
<a onclick="back_leave_opening_view()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<div class="card-body" id="table_view">
<form method="POST" action="" enctype="multipart/type">
<table class="table table-bordered">

<tr rowspan="6">
<td >Staff  id</td>
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $row[0]; ?>"></td>

<td colspan="5">

<input type="text" class="form-control" id="date" name="staff_id" value="<?php echo  $row[1]; ?>"></td>
</tr>

<tr rowspan="6">
<td >Staff Type id</td>


<td colspan="5">

<input type="text" class="form-control" id="date" name="staff_type_id" value="<?php echo  $row[2]; ?>"></td>
</tr>

<tr rowspan="6">
<td >Date of Joining</td>


<td colspan="5">

<input type="date" class="form-control" id="date" name="doj" value="<?php echo  $row[3]; ?>"></td>
</tr>

<tr rowspan="6">
<td >From Date</td>


<td colspan="5">

<input type="date" class="form-control" id="date" name="from_date" value="<?php echo  $row[4]; ?>"></td>
</tr>


<tr rowspan="6">
<td>Leave Type id</td>
<td colspan="5"><input type="id" class="form-control" id="leave_type_id" name="leave_type_id" value="<?php echo  $row[5]; ?>"></td>
</tr>
<tr rowspan="6">
<td>Leave name</td>
<td colspan="5"><input type="text" class="form-control" id="leave_name" name="leave_name" value="<?php echo  $row[6]; ?>"></td>
</tr>
<tr rowspan="6">
<td>Leave op Balance</td>
<td colspan="5"><input type="text" class="form-control" id="leave_op_balance" name="leave_op_balance" value="<?php echo  $row[7]; ?>"></td>
</tr>






<tr>

<td>Status</td>
<td colspan="5">
<select id="status" name="status" class="form-control" >
 
<?php 
if($row[8] ==1)
{
?>
    <option value="1">Active</option>
	 <option value="2"> IN Active</option>
<?php }else {?>
  <option value="2"> IN Active</option>
  <option value="1">Active</option>
<?php } ?>
</select>
</td>
</tr>

</table>
<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="leave_opening_update()" value="Update"> 
</form>
</div>
</div>
</div>
<script>
	function back_leave_opening_view()
	{
		$.ajax({
		type:"POST",
		url:"Leave_Management/leave_opening/leave_opening_view.php",
		success:function(data){
		$("#table_view").html(data);
		}
		})
	}
    function leave_opening_update()
    {
    var id=$('#id').val();
	//alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
    url:'Leave_Management/leave_opening/leave_opening_update.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
		
		leave_opening_view()
      }
      
    }       
    });
    }
    </script>