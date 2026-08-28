<?php
require '../../connect.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];

$userrole=$_SESSION['userrole'];

  
?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="Qvision\commonstyle.css">
<style>
.right{
	
	margin-right:2px;
}
</style>

</head>
<body>
<div  class="card card-primary">
     <div class="card-header">
    <h2 class="card-title"><font size="4"><b>Purchase Order list</b></font> </h2>
	</div>
    <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
    <thead>
		<th>SL.No</th>		
		<th>CS Number</th>	
        <th>Quote Number</th>		
		<th>SO Number</th>   
		<th>PO Date</th>
		<th><strong> Action</strong></th>
      </thead>
      <tbody>
      <?php
	  
	  $emp_sql=$con->query("SELECT id,cost_sheet_no,quote_no,so_number,po_date FROM po_generate where po_upload_status=2 and finance_status=1 and md_status=1 and marketing_status=1 order by id desc" );
	 /* echo "SELECT id,cost_sheet_no,quote_no,so_number,po_date FROM po_generate where po_upload_status=2 and finance_status=1 and md_status=1 and marketing_status=1 order by id desc"; */
     
      $cnt=1;
      while($data =$emp_sql->fetch(PDO::FETCH_ASSOC))
	  {
		  $var = $data['po_date'];;
        $date= date("d-m-Y", strtotime($var) );
       ?>
      <tr>
      <td><?php echo $cnt; ?>.</td>
	       <td><?php echo $data['cost_sheet_no']; ?></td>
	        <td><?php echo $data['quote_no']; ?></td>
            <td><?php echo $data['so_number']; ?></td>	 
	        <td><?php echo $date; ?></td>
       
		<td>
	     <button class="btn btn-info" data-id="<?php echo $data['id']; ?>" onclick="purchse_order_view(<?php echo $data['id']; ?>)">
	     <i class="fa fa-eye"></i>View</button>
		 <button class="btn btn-success right" data-id="<?php echo $data['id']; ?>" onclick="purchse_order_edit(<?php echo $data['id']; ?>)">
	     <i class="fa fa-edit"></i>Edit</button>
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
function purchse_order_view(v) {
  $.ajax({
    type: "POST",
    url: "qvision/Purchase_process/purchse_order_view.php?id=" + v,
    success: function(data) {
      $("#main_content").html(data);
    },
    error: function(xhr) {
      alert("Error " + xhr.status + ": " + xhr.statusText);
    }
  });
}

function purchse_order_edit(v) {
  $.ajax({
    type: "POST",
    url: "qvision/Purchase_process/purchse_order_edit.php?id=" + v,
    success: function(data) {
      $("#main_content").html(data);
    },
    error: function(xhr) {
      alert("Error " + xhr.status + ": " + xhr.statusText);
    }
  });
}

$(function () 
	{
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });

  });


</script>
</body>
</html>