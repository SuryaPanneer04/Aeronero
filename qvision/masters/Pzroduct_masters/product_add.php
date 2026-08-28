<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];

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
<!-- <i class="fa fa-table"></i> Product  Add -->
<center><h3 class="card-title"><font size="5">ADD PRODUCT</font></h3></center>
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
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Product" id="product_name" name="product_name"></td>
        </tr>
      
		<tr>
		<td>Status</td>
		<td colspan="2">
		<select class="form-control" name="status" id="status">
		<option value="1">Active</option>
		<option value="0">InActive</option>
		</select>
		</td>
		</tr>
       
		
		
		
		 
		
		
        <td colspan="6"><input type="button" class="btn btn-success" style="float:right;" name="save" onclick="insert_product()" value="save"></td>
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
			 function insert_product()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
  url:"qvision/masters/Product_master/product_submit.php",
    success:function(data)
    {      
        alert("Entry Successfully");
		Product_master()
		          
    }       
    });
    }
	
	</script>