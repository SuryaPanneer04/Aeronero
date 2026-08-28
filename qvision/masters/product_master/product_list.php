<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];

?>
<style>
td {
  font-size: 20px;
}
</style>
<div  class="card card-primary">
              <div class="card-header" style="background-color:#ff8b3d;">
                <h3 class="card-title" ><font size="5">Product List</font> </h3>
			<a onclick="pro_duct_add()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-plus"></i> ADD</a>
			<br>
			<br>
              </div>
              <!-- /.card-header --><br>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL.No</th>
                    <th>Product NAME</th>
					<th>HSN Code</th>
					<th>GST Code</th>
					<th>Product Type</th>
					<th>Status</th>
					 <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
<?php

$sql=$con->query("SELECT * FROM `product_master`");
$cnt=1;
 while($product = $sql->fetch(PDO::FETCH_ASSOC))
{
	
?>
<tr>
<td><?php echo $cnt;?>.</td>
<td><?php echo $product['name'];?></td>
<td><?php echo $product['hsn_code'];?></td>
<td><?php echo $product['gst_code'];?></td>
<td><?php echo $product['type'];?></td>
<td>
	  <?php 
	  if($product['status'] ==1)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	  <?php }else {
		  
		 echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';
		 ?>
      <?php }?>
	 
	  
     </td>
<td>

							<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $product['id']; ?>" onclick="product_edit(<?php echo $product['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
</td>

</tr>
<?php 
$cnt=$cnt+1;
 }?></tbody>
                  
                </table>
				
				
              </div>
              <!-- /.card-body -->
            </div>
			<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

   function product_edit(v){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/masters/product_master/products_edit.php?id="+v,	 
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}

</script>  
<script>  
function pro_duct_add()

	{
		$.ajax({
		type:"POST",
		url:"qvision/masters/product_master/products_add.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
</script>
