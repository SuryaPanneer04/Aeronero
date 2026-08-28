<?php
require '../../../connect.php';
include("../../../user.php");
 $id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM `products_master` WHERE Product_id='$id'"); 
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
	</style>
<!-- <section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card"> -->
<div class="card card-primary">
<div class="card-header">
<!-- <i class="fa fa-table"></i>Product Edit -->
<center><h3 class="card-title"><font size="5">EDIT PRODUCT</font></h3></center>
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary">BACK</a>
</div>
<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <!-- <tr>
        <td><center><img src="../../Recruitment/image/userlog/quadsel.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
        </tr> -->
      
      
     
        <tr>
       <td>Product Name</td>
	   <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $row['Product_id']; ?>">
        <td colspan="5"><input type="text" class="form-control" name="product_name" id="product_name" value="<?php echo  $row['Product_name'];?>" ></td>
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
        
		

	
	
		<tr>
        <td colspan="6"><input type="button" class="btn btn-success" style="float:right;" name="save" onclick="product()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>
    </div> </div> </div>
<script>
	function back()
	
	{
		Product_master()

	}
	</script>
    <script>
    function product()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
     url:"qvision/masters/Product_master/product_update.php",
    success:function(data)
    {      
        alert("Entry Successfully");
	Product_master()

		          
    }       
    });
    }
	
	

    </script>
