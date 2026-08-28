<?php
require '../../connect.php';
?>
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i>  Add Earnings
<a onclick="earnings_back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>
<div class="card-body">
<form method="POST" enctype="multipart/form-data" id="earningform">
<div class="form-group row">
<div class="col-sm-3"  style="display: flex;">
<label for="month">Month</label>
<input type="number"  class="form-control" id="month" name="month"  style=" margin-left: 30px;" required>
</div>
</div>

<table id="new_po_tr" class="table table-striped table-hover table-bordered">	
<thead>
<tr><th>#</th><th>Employee Name</th><th>Special Allowance</th><th>LTA</th></tr>
</thead>
<tbody>	
<tr class="row_1">	
<td>
<input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/>
</td>

<td>
<select class="form-control" name="emp_name[]" id="emp_name"  required="TRUE">
<option value="0">Select Name</option>
<?php
$isql=$con->query("SELECT id,emp_name,status FROM staff_master where status = 1");			
$i=1;
while($earning_add = $isql->fetch(PDO::FETCH_ASSOC))			
{
?>
<option value="<?php echo $earning_add['id']; ?>"><?php echo $earning_add['emp_name']; ?></option>
<?php 
} 
?>
</select>
</td>
	
<td>
<input type="text" class="form-control" name="spa[]" id="special_allowance" required>
</td>

<td>
<input type="text" class="form-control" name="lta[]" id="lta" required>
</td>

</tr>			
</tbody>
</table>

<table class="table table-bordered">
<tr>
<td style="width:75%">
<input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="add_new_po()" value="Add">
<input type="button" class="btn btn-danger" id="po_row_remove" onclick="po_row_remove()" value="Remove">
</td>
<td style="width:25%">
<input type="submit" class="btn btn-success" name="scale_save" style="float: right;"  value="SUBMIT"> </td>
</tr>
</table>
</div>
</form>
</div>

<script>

function add_new_po()
{
	var len=$('#new_po_tr tr').length;	
	len=len+1;
	$('#new_po_tr').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'" style="width:15px;height:20px;"/></td><td><select class="form-control" name="emp_name[]" id="emp_name'+len+' required="TRUE"><option value="0">Select Name</option><?php $isql=$con->query("SELECT id,emp_name,status FROM staff_master where status = 1");$i=1;while($earning_add = $isql->fetch(PDO::FETCH_ASSOC))	{?><option value="<?php echo $earning_add['id']; ?>"><?php echo $earning_add['emp_name']; ?></option><?php } ?></select></td><td><input type="number" class="form-control" name="spa[]" id="special_allowance'+len+'" required></td><td><input type="number" class="form-control" name="lta[]" id="lta'+len+'" required></td></tr>');
	

}

$('#po_row_remove').click(function()
{
	$('input:checkbox:checked.chk').map(function(){
	var id=$(this).val();
	var le=$('#new_po_tr tr').length;
	if(le==1)
	{
		alert("You Can't Delete All the Rows");
	}
	else
	{
		$('.row_'+id).remove();
	}
	
	});
});


function earnings_back()
{
	$.ajax({
    type:"GET",
    url:'/ssinfo1/qvision/earnings/earnings_upload.php',
    success:function(data){
      $("#earning_view").html(data);
    }
  })
}

$(document).ready(function(){
    // Submit form data via Ajax
    $("#earningform").on('submit', function(e){
        e.preventDefault();
		
		
          $.ajax({
            type: 'POST',
            url:'/ssinfo1/qvision/earnings/earnings_insert.php',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data)
			{
				alert('Submitted successfully')
				earnings()
			}
          })	
        });
    });
</script>