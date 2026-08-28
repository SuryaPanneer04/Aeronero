<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from company_master where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
	<style>
.card-primary:not(.card-outline)>.card-header{
background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
.btn-dark{
	background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black !important;
}
</style>
<div  class="card card-primary">
              <div class="card-header">
                <h3 style="float: left;"><font size="5">EDIT COMPANY DETAILS</font></h3>
		  		  <a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
		   </div>
<!--
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
<!-- <div class="container-fluid">
<div class="card mb-3"> ->
<div class="card card-primary">
<div class="card-header">
<!-- <i class="fa fa-table"></i> COMPANY DETAILS EDIT ->
<center><h3 class="card-title">COMPANY DETAILS ADD</h3></center>
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>-->
<div class="card-body" id="printableArea">
<form role="form" name="" action="" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td>Company Name</td>
<td colspan="5">
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>"readonly>
<input type="text" class="form-control" id="name" name="name" value="<?php echo $row['companyname'];?>">


</td>
</tr>


<tr>
<td>Address</td>
<td colspan="2"><input type="text" class="form-control" id="address" name="address" value="<?php echo  $row['address'];?>"></td>
</tr>

<tr>
<td>Email</td>
<td colspan="2"><input type="text" class="form-control" id="email_id" name="email_id" value="<?php echo  $row['email_id'];?>"></td>
</tr>
<tr>
<td>Phone No</td>
<td colspan="2"><input type="text" class="form-control" id="phone_no" name="phone_no" value="<?php echo  $row['phone_no'];?>"></td>
</tr>
<tr>
<td>GST No</td>
<td colspan="2"><input type="text" class="form-control" id="gst_no" name="gst_no" value="<?php echo  $row['gst_no'];?>"></td>
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

<input type="button" name="submit" Value="Update"class="btn btn-primary btn-md" style="float:right;" onclick="update_company()">
</form>
</div>
<script>
function back_ctc()
{
 company_master();
}
</script>
<script>
// function update_company()
// {
// 		//   var id=0;
// 	//alert(id);
//     var data = $('form').serialize();
//     $.ajax({
//     type:"POST",
// 	data: data + "&" + "id="+id,
//     url:"qvision/masters/company_master/update_company.php",
//     success:function(){
//   alert("Updated Successfully");
//   company_master();
//     }
//     })
// }
function update_company()
{
    var data = $('form').serialize();

    $.ajax({
        type: "POST",
        url: "qvision/masters/company_master/update_company.php",
        data: data,
        success: function(response){

            if(response.trim() == "1"){
                alert("Updated Successfully");
                company_master();
            }else{
                alert("Update Failed");
                console.log(response);
            }

        },
        error: function(xhr){
            alert("Ajax Error");
            console.log(xhr.responseText);
        }
    });
}
</script>