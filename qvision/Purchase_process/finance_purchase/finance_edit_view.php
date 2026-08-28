<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

$purchase_id    = $_REQUEST['id'];
$stmt = $con->prepare("SELECT a.id,a.warrenty,a.price,a.cost_sheet_id,a.purchase_type,a.specification,a.upload,a.so_number,a.vendor_id,
a.status,b.id as cost_id,b.cost_sheet_no as cost_no,b.qty FROM purchase_vendor_master a left join cost_sheet_entry b on(a.cost_sheet_id=b.id) where a.status=1 and a.id='$purchase_id'" );  //a.status=2 
 
		
$stmt->execute(); 
$row = $stmt->fetch();
$vendor_id  = $row['vendor_id'];
$specification  = $row['specification'];
$cost_id= $row['cost_id'];

$statu  = $row['status'];
if($statu==1)
{
	$status="Active";
}else{
	$status="InActive";
}

$stmts = $con->prepare("SELECT id as po_id, vendor_name FROM doller_vendor_mastor WHERE id='$vendor_id'"); 		
$stmts->execute(); 
$rows = $stmts->fetch(PDO::FETCH_ASSOC);
if (!$rows) {
    $rows = ['vendor_name' => 'Vendor Not Found'];
}
?>

<style>
.form-control{
-webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 0%);
}
.table>tbody>tr>td{
    padding: 4px !important;
}
.table {
        margin-bottom: 0px !important;
}
</style>
<div class="card card-info">
	  <div class="card-header">
	 <h2 class="card-title"><font size="4"><b>Vendor Approve</b></font> </h2></div>
	
     
	<form  method="post" enctype="multipart/form-data" autocomplete="off">
<table class="table table-bordered">

<tr>
<td><b>Specification</b></td>
<td colspan="4"><input type="text" class="form-control" id="specification" value="<?php echo $row['specification'];?>" name="specification" readonly></td>
<input type="hidden" class="form-control" id="vendor_id" value="<?php echo $purchase_id;?>" name="vendor_id" readonly></td>
</tr>
<tr>
<td><b>Vendor Name</b></td>
<td colspan="4"><input type="text" class="form-control" id="txt_org_name" value="<?php echo $rows['vendor_name'];?>" name="txt_org_name" readonly></td>
<input type="hidden" class="form-control" id="vendor_id" value="<?php echo $purchase_id;?>" name="vendor_id" readonly></td>
</tr>
<tr>
<td><b>Warrenty</b></td>
<td colspan="2"><input type="text" class="form-control" id="txt_org_name" value="<?php echo $row['warrenty'];?>" name="txt_org_name" readonly></td>

<td><b>Price</b></td>
<td colspan="2"><input type="text" class="form-control" id="txt_org_name" value="<?php echo $row['price'];?>" name="txt_org_name" readonly></td>
</tr>
<tr>
<td><b>Quantity</b></td>
<td colspan="2"><input type="text" class="form-control" id="txt_org_name" value="<?php echo $row['qty'];?>" name="txt_org_name" readonly></td>
<?php
$stmtz = $con->prepare("SELECT a.id,a.cost_sheet_no,b.cost_sheet_id,b.specification,c.product_name,c.request_remarks,c.quantity as extra_qty FROM cost_sheet_entry a LEFT JOIN purchase_vendor_master b ON(a.id=b.cost_sheet_id) LEFT JOIN purchase_requistion_entry c ON(a.description=c.description) WHERE b.specification='$specification' AND a.id='$cost_id'"); 
$stmtz->execute(); 
$rowz = $stmtz->fetch(PDO::FETCH_ASSOC);
if (!$rowz) {
    $rowz = [
        'extra_qty' => '0',
        'request_remarks' => 'No Remarks Found'
    ];
}
?>
<td><b>Purchase Request</b></td>
<td colspan="2"><input type="text" class="form-control" id="txt_org_name" value="<?php echo $rowz['extra_qty'];?>" name="txt_org_name" readonly></td>
</tr>
<tr>
<td><b>Request Remark</b></td>
<td colspan="4"><input type="text" class="form-control" id="txt_org_name" value="<?php echo $rowz['request_remarks'];?>" name="txt_org_name" readonly></td>
</tr>
<tr>
<td><b>Document</b></td>
<td colspan="2"><a href="/ssinfo_updated/qvision/Purchase_Process/files/<?php echo $row['upload'];?>" target="_blank"><?php echo  $row['upload'];?></a> </td>
<td><b>Vendor Status</b></td>
<td colspan="2"><input type="text" class="form-control" id="txt_org_name" value="<?php echo $status;?>" name="txt_org_name" readonly></td>
</tr>
<tr>
</tr>
</table>
<br/>
</form>
</div>

<script>
function back()

	{
		finance_vendor_approve()
	}

</script>