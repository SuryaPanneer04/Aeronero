<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from appraisal_rounds where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

 <div class="card card-primary">
   <div class="card-header">
  <h3 class="card-title"><font size="5">APPRAISAL ROUND</font></h3>
	<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"></i>Back</a>
 </div>

<form role="form" name="" action="" method="post" enctype="multipart/type">
<table class="table table-bordered">

<tr>
<td>Name:</td>
<td colspan="5">
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>">
<input type="text" class="form-control" id="name" name="name" value="<?php echo  $row['name'];?>">
</td>
</tr>


<tr>
<td>Status</td>
<td colspan="2">

<select class="form-control" name="status" id="status">
<?php

if($sta==0)
{
	?>
<option value="0">InActive</option>
<option value="1">Active</option>
<?php	
}
else{
	?>
	<option value="1">Active</option>
	<option value="0">InActive</option>
	<?php
}
?>

</select>
</td>
</tr>
 
</table>


<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="round_update()" value="Update"> 

</form>
</div>

<script>
 function round_update()
    {
    var id=$('#id').val();
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
	data: data + "&" + "id="+id,
    url:'qvision/masters/appraisal_round_master/update_appraisal_rounds.php',

    success:function(data)
    {
      if(data!='')
      { 
        alert('Not updated');
        appraisal_round_master()
      }
      else
      {
        alert("Updated Successfully");
		appraisal_round_master()
      }
      
    }       
    });
    }
	
function back()
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/appraisal_round_master/appraisal_rounds.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
	</script>