<?php
require '../../connect.php';

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
     <div class="card-header" style="background-color: #f1cc61 !important;">
    <h2 class="card-title"><font size="4"><b>Vendor Quote List</b></font> </h2>
	</div>
    <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
    <thead>
		<th>SL.No</th>		
		<th>Specification</th>		
		<th>Cost sheet No</th>   
		<th>SO Number</th>     
		<th>Status</th>     
		<th><strong> Action</strong></th>
      </thead>
      <tbody>
      <?php
	  
	  
	  $emp_sql=$con->query("SELECT a.id as po_id,a.specification,a.cost_sheet_id,a.so_number,a.status as po_status,a.purchase_type,b.id,b.cost_sheet_no FROM purchase_vendor_master a left join cost_sheet_entry b on(a.cost_sheet_id=b.id) where a.status=4 order by a.id desc" );//group by a.specification
	  
	  
     
      $cnt=1;
      while($data =$emp_sql->fetch(PDO::FETCH_ASSOC))
	  {
        $po_id=$data['po_id'];
        $so_number=$data['so_number'];
        $specification=$data['specification'];
       ?>
      <tr>
      <td><?php echo $cnt; ?>.</td>
	       <td><?php echo $data['specification']; ?></td>
	       <td><?php echo $data['cost_sheet_no']; ?></td>
	        <td><?php echo $data['so_number']; ?></td> 
	        <td><?php  $po_id; 
			$costs = $con->query("select COUNT(*) as count from purchase_vendor_master where so_number='$so_number' and specification='$specification'and status=4");
			$costs->execute(); 
			$row = $costs->fetch();
			$count=$row['count'];
			if($count==0)
{
	echo '<span style="color:red;text-align:center;"><b> Vendor Not Approved<b/></span>';
}else{
	echo '<span style="color:green;text-align:center;"><b> Vendor Approved<b/></span>';
}
			?></td> 
	        
       
		<td>


	     <button class="btn btn-info" data-id="<?php echo $data['po_id']; ?> ?>" onclick="purchse_process_view(<?php echo $data['po_id']; ?>)"><i class="fa fa-eye"></i></button>
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
</script>
<script>
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