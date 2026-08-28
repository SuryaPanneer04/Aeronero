<?php
require '../../connect.php';
$id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM leave_master WHERE id='$id'"); 
//echo "SELECT id, from_date, leave_name, days_per_month, days_per_year, is_cummulative, status FROM 'leave_master' WHERE id='$id'"; 
$stmt->execute(); 
$row = $stmt->fetch();

?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> LEAVE  EDIT
<a onclick="back_leave_master_view()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<div class="card-body" id="printableArea">
<form method="POST" action="" enctype="multipart/type">
<table class="table table-bordered">

<tr rowspan="6">
<td >From Date</td>
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $row[0]; ?>"></td>

<td colspan="5">

<input type="date" class="form-control" id="Year" name="from_date" value="<?php echo  $row[1]; ?>"></td>
</tr>


<tr rowspan="6">
<td >Leave Name</td>
<td colspan="5"><input type="text" class="form-control" id="leave_name" name="leave_name" value="<?php echo  $row[2]; ?>"></td>
</tr>

<tr>

<td>Status</td>
<td colspan="5">
<select id="status" name="status" class="form-control" >
 
<?php 
if($row[3] ==1)
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
<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="leave_master_update()" value="Update"> 
</form>
</div>
</div>
</div>
<script>
	function back_leave_master_view()
	{
		$.ajax({
		type:"POST",
		url:"Leave_Management/leave_master/leave_master_view.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
    function leave_master_update()
    {
    var id=$('#id').val();
	//alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
    url:'Leave_Management/leave_master/leave_master_update.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
		
		leave_master_view()
      }
      
    }       
    });
    }
    </script>
