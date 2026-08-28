<?php
require '../../connect.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
$idvalue=$_REQUEST['id'];


$sql=$con->query("SELECT id,cost_sheet_id,so_number,purchase_type from purchase_vendor_master where id='$idvalue'");

$feth=$sql->fetch();

$pur_type=$feth['purchase_type'];

$cost_sheet_id=$feth['cost_sheet_id'];



?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<body>
<div class="card card-primary">
     <div class="card-header">
    <h2 class="card-title"><font size="4"><b>Vendor Quote List</b></font> </h2>
	<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
	</div>
    <div class="card-body">
    <table id="example1" class="table table-bordered table-striped" style="width: 125%;">
    <thead>
		<th>SL.No</th>		    
		<th>CS No</th>   
		<th>Vendor Name</th>   
		<th>Price</th>   
		<th>Upload</th>   
		<th>Status</th>   
		<th  style="width: 14%;"><strong> Action</strong></th> 
      </thead>
      <tbody>
      <?php	  
	  $emp_sql=$con->query("SELECT a.id as po_id,a.warrenty,a.price,a.upload,a.cost_sheet_id,a.purchase_type,a.so_number,a.vendor_id,
	  a.status as po_status,b.id,b.cost_sheet_no FROM purchase_vendor_master a left join cost_sheet_entry b on(a.cost_sheet_id=b.id) where a.purchase_type='$pur_type' and a.cost_sheet_id='$cost_sheet_id'" );
	 /* echo "SELECT a.id as po_id,a.warrenty,a.price,a.upload,a.cost_sheet_id,a.purchase_type,a.so_number,a.vendor_id,
	  a.status as po_status,b.id,b.cost_sheet_no FROM purchase_vendor_master a left join cost_sheet_entry b on(a.cost_sheet_id=b.id) where a.purchase_type='$pur_type' and a.cost_sheet_id='$cost_sheet_id'"; */
	 $count=$emp_sql->rowCount();
      $cnt=1;
      while($data =$emp_sql->fetch(PDO::FETCH_ASSOC))
	  {
$vendor = $data['vendor_id'];
$vendor_name = "Vendor Not Found"; // Default fallback text
if (!empty($vendor)) {
    $vendor_sql = $con->query("SELECT id, vendor_name FROM doller_vendor_mastor WHERE id='$vendor'");
    $v_data = $vendor_sql->fetch(PDO::FETCH_ASSOC);
    if ($v_data && isset($v_data['vendor_name'])) {
        $vendor_name = $v_data['vendor_name'];
    }
}
       ?>
      <tr>
      <td><?php echo $cnt; ?>.</td>
	       <td><?php echo $data['cost_sheet_no']; ?></td>
	       <td><?php echo $vendor_name; ?></td>
	        <td><?php echo $data['price']; ?></td> 
	        <td><a href="/ssinfo_updated/qvision/Purchase_Process/files/<?php echo $data['upload'];?>" target="_blank"><?php echo  $data['upload'];?></a> </td> 
			<td><?php if($data['po_status']==1){ 
	               echo '<span style="color:red;text-align:center;"><b>Not Accepted</b></span>';  
				}else{ 
				   echo '<span style="color:green;text-align:center;"><b>Accepted</b></span>'; 

				}?>
				</td>
		<td>
	     <button class="btn btn-success" data-id="<?php echo $data['po_id']; ?>" onclick="select_vendor(<?php echo $data['po_id']; ?>)">Accept</button>
		  <button class="btn btn-info" data-id="<?php echo $data['id']; ?>" onclick="purchse_order_view(<?php echo $data['id']; ?>)">
	     <i class="fa fa-eye"></i></button>
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
	
function back_ctc()
{
purchase_order_list()	
}

function select_vendor(value)
{
	$.ajax({
	type:'GET',
	data:"value="+value,
	url:"qvision/Purchase_process/purchse_vendor_approve.php",
	success:function(data)
	{      
		alert("Vendor Approved Successfully");
        purchase_order_list()
				  
	}       
	});
}
</script>

</body>
</html>