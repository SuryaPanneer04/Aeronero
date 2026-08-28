<?php
require '../../connect.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

  
?>
<!DOCTYPE HTML>
<html>
<head>
<style>
.right{
	
	margin-right:2px;
}
</style>

</head>
<body>
<div  class="card card-primary">
     <div class="card-header">
    <h2 class="card-title"><font size="4"><b>Purchase Order List</b></font> </h2>
	</div>
    <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
    <thead>
		<th>SL.No</th>		
		<th>Specification</th>		
		<th>Cost sheet No</th>   
		<th>SO Number</th>   
		<th colspan='2'><strong> Action</strong></th>

      
      </thead>
      <tbody>
      <?php
	  
	  
	  $emp_sql=$con->query("SELECT a.id,a.specification,a.so_number,a.status,b.id,b.cost_sheet_no FROM purchase_vendor_master a left join cost_sheet_entry b on(a.id=b.id) where a.status=1 " );
	  echo "SELECT a.id,a.specification,a.so_number,a.status,b.id,b.cost_sheet_no FROM purchase_vendor_master a left join cost_sheet_entry b on(a.id=b.id) where a.status=1 ";
     
      $cnt=1;
      while($data =$emp_sql->fetch(PDO::FETCH_ASSOC))
	  {

       ?>
      <tr>
      <td><?php echo $cnt; ?>.</td>
	       <td><?php echo $data['specification']; ?></td>
	       <td><?php echo $data['cost_sheet_no']; ?></td>
	        <td><?php echo $data['so_number']; ?></td> 
       
		<td>
	     <button class="btn btn-info" data-id="<?php echo $data['id']; ?>" onclick="purchse_order_view(<?php echo $data['id']; ?>)">
	     <i class="fa fa-eye"></i></button>
		 <button class="btn btn-success right" data-id="<?php echo $data['id']; ?>" onclick="purchse_order_edit(<?php echo $data['id']; ?>)">
	     <i class="fa fa-edit"></i></button>
	    </td>
      
      </tr>
      <?php
	  $cnt=$cnt+1;
      }
      ?>
       </tbody>
      </table>
    </div>
<!-- /.content -->
</div>

<script>
		function purchse_process_view(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/Purchase_process/purchse_process_view.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function purchse_process_edit(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/Purchase_process/purchse_process_edit.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
</script>
</body>
</html>