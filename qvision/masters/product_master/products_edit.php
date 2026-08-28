<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$id = $_REQUEST['id'];

$stmt = $con->prepare("SELECT * from product_master where id='$id'");
$stmt->execute();  
$row = $stmt->fetch();
 $description=$row['description'];
 $name=$row['name']
?>
<div class="card card-info">
<div class="card-header" style="background-color:#ff8b3d;">

<center><h3 class="card-title"><b>PRODUCTS EDIT</b></h3></center>
<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>

<form  method="post" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>

</tr>
<tr>
 <td>Product ID</td>
                <td colspan="2"><input type="text" class="form-control" value="<?php echo $row['product_id'];?>" id="product_id" name="product_id" placeholder="Enter Product ID" required></td>
<td>Product Name</td>
<td colspan="2">
<select required aria-required="true" class="form-control" name="product_name" id="product_name" required>
                      <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
						<?php
								$stmt2 = $con->prepare("SELECT Product_id,Product_name FROM products_master where Product_name!='$name'");		
								$stmt2->execute(); 										
								while($row2 = $stmt2->fetch()){
						?>
					<option value="<?php echo $row2['Product_name']; ?>"><?php echo $row2['Product_name']; ?></option>
						<?php 
							}
						?>
                    </select></td>

<input type="hidden" class="form-control" id="id_value" name="id_value" value="<?php echo $row['id'];?>" >
</tr>
<tr>
<td>Model Name</td>
               <td colspan="2"><input type="text" class="form-control" value="<?php echo $row['model_name'];?>" id="model_name" name="model_name" placeholder="Enter Model Name" required></td>
<td>Product Type</td>
<td colspan="2">
					<select required aria-required="true"  class="form-control" name="product_type" id="product_type" required>
<?php
$type=$row['type'];

if($type=="NonIt Asset")
{
	?>
<option value="2">NonIt Asset</option>
<option value="1">It Asset</option>
<?php	
}
elseif($type=="It Asset"){
	?>
	<option value="1">It Asset</option>
	<option value="2">NonIt Asset</option>
	<?php
}else{
?>
	<option value="">Select Status</option>
	<option value="1">It Asset</option>
	<option value="2">NonIt Asset</option>
	<?php
}
?>
					</select>
				</td>
</tr>
<tr>
<td>Description</td>
			<td colspan="5">
			<textarea id="desc" name="desc" class="form-control" style="height:133px"><?php echo $description; ?></textarea></td>



</tr>
<tr>
<td>HSN Code</td>
<td colspan="2"><input type="text" class="form-control" id="hsn_code" name="hsn_code" value="<?php echo $row['hsn_code'];?>" ></td>
				<td>Status*</td>
				<td colspan="4">
					<select required aria-required="true"  class="form-control" name="statusz" id="statusz">
<?php
$sta=$row['status'];
if($sta==2)
{
	?>
<option value="2">InActive</option>
<option value="1">Active</option>
<?php	
}
elseif($sta==1){
	?>
	<option value="1">Active</option>
	<option value="2">InActive</option>
	<?php
}else{
?>
	<option value="">Select Status</option>
	<option value="1">Active</option>
	<option value="0">InActive</option>
	<?php
}
?>

					</select>
				</td>
</tr>

</table>
<div style="text-align:left;">
<input type="button" name="save" value="SAVE" onclick="productz_edit_insert(event)" class="btn btn-primary btn-md">
<br/>
</div>
</form>
</div>
<script>
function back_ctc()
{
Product_master()
}



function productz_edit_insert(event)
{	
    var status=document.getElementById("statusz");
	if(status==''){
		alert("Please Select Status")
		event.preventDefault();
	}else{
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:data,
		url:"qvision/masters/product_master/products_update.php",
		success:function(result)
		{

						 if(result=='1')
						{	
                           alert("Product Updated Successfully")					
						  product_master()	
						}else{
							alert("Product Updated Successfully")
							event.preventDefault();
				 
			}
			
		   
		}       
	});
	
}
}
</script>
