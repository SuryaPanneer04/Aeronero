<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];

?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">PRODUCT LIST</font></h3>
			<a onclick="add()" style="float: right;" data-toggle="modal" class="btn btn-primary">ADD</a>
              </div>
              <div class="card-body">
                <!-- <table id="example1" class="table table-bordered table-striped"> -->
                <table class="table table-striped table-bordered table-hover display nowrap"  id="example1" style="width:100%">

                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Product Name</th>
					<th>Status</th>
					 <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
<?php

$sql=$con->query("SELECT * FROM `products_master`");
$cnt=1;
 while($products_master = $sql->fetch(PDO::FETCH_ASSOC))
{
	
?>
<tr>
<td><?php echo $cnt;?>.</td>
<td><?php echo $products_master['Product_name'];?></td>
<td>
	  <?php 
	  if($products_master['status'] ==1)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	  <?php }else {
		  
		 echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';
		 ?>
      <?php }?>
	 
	  
     </td>
<td>

							<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $products_master['Product_id']; ?>" onclick="product_edit(<?php echo $products_master['Product_id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
</td>

</tr>
<?php 
$cnt=$cnt+1;
 }?></tbody>
                  
                </table>
              </div>
            </div>
            <script>
$(document).ready(function() {
    $('#example1').DataTable( {
        "scrollX": true
    } );
} );
</script>
			<script>
  // $(function () {
  //   $("#example1").DataTable({
  //     "responsive": true,
  //     "autoWidth": false,
  //   });
  //   $('#example2').DataTable({
  //     "paging": true,
  //     "lengthChange": false,
  //     "searching": false,
  //     "ordering": true,
  //     "info": true,
  //     "autoWidth": false,
  //     "responsive": true,
  //   });
  // });

   function product_edit(v){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/masters/Product_master/Product_edit?id="+v,
	 
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function back()
	
	{
		Product_master()

	}
  
function add()
	{
		$.ajax({
		type:"POST",
		url:"qvision/masters/Product_master/product_add.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
</script>
