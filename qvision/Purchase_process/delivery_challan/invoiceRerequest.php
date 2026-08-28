<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

$invoiceId    = $_REQUEST['invoice'];
$purchase_id    = $_REQUEST['id'];
$stmt = $con->prepare("SELECT a.id,a.warrenty,a.price,a.cost_sheet_id,a.purchase_type,a.specification,a.upload,a.so_number,a.vendor_id, a.status,b.id as cost_id,b.cost_sheet_no as cost_no,b.qty,c.quote_no FROM purchase_vendor_master a left join cost_sheet_entry b on(a.cost_sheet_id=b.id) left join quote_generate c on b.cost_sheet_no = c.cost_sheet_no  where a.id='$purchase_id'" );  //a.status=2
 

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

$stmts = $con->prepare("SELECT id as po_id,vendor_name from doller_vendor_mastor where id='$vendor_id'" ); 		
$stmts->execute(); 
$rows = $stmts->fetch();
?>

<style>
.table>tbody>tr>td{
    padding: 4px !important;
}
.table {
        margin-bottom: 0px !important;
}
</style>
<div class="card card-info">
	  <div class="card-header">
	 <h2 class="card-title"><font size="4"><b>Invoice Re-Request</b></font> </h2>
     <a onclick="invoice_rerequest()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
    </div>
	
     
	<form  method="post" enctype="multipart/form-data" autocomplete="off">
<table class="table table-bordered">
<tr>
<td><b>Cost Sheet No</b></td>
<td colspan="4">
    <input type="text" class="form-control" id="cost_sheet_no" value="<?php echo $row['cost_no'];?>" name="cost_sheet_no" readonly>
</td>
</tr>
<tr>
<td><b>Quote No</b></td>
<td colspan="4"><input type="text" class="form-control" id="quoteno" value="<?php echo $row['quote_no'];?>" name="quoteno" readonly></td>
</tr>
<tr>
<td><b>Product</b></td>
<td colspan="4"><input type="text" class="form-control" id="specification" value="<?php echo $row['specification'];?>" name="specification" readonly></td>
<input type="hidden" class="form-control" id="vendor_id" value="<?php echo $purchase_id;?>" name="vendor_id" readonly></td>
</tr>
<tr>
<td><b>Vendor Name</b></td>
<td colspan="4"><input type="text" class="form-control" id="txt_org_name" value="<?php echo $rows['vendor_name'];?>" name="txt_org_name" readonly></td>
</td>
</tr>

<tr>
<td><b>Client Request(Qty)</b></td>
<td colspan="2"><input type="text" class="form-control" id="txt_org_name" value="<?php echo $row['qty'];?>" name="txt_org_name" readonly></td>

<td><b>Price</b></td>
<td colspan="2"><input type="text" class="form-control" id="txt_org_name" value="<?php echo $row['price'];?>" name="txt_org_name" readonly></td>
</tr>

<!-- <tr>
<td><b>Warrenty</b></td>
<td colspan="2"><input type="text" class="form-control" id="txt_org_name" value="<?php echo $row['warrenty'];?>" name="txt_org_name" readonly></td>

<?php
$stmtz = $con->prepare("SELECT a.id,a.cost_sheet_no,b.cost_sheet_id,b.specification,c.product_name,c.request_remarks,c.quantity as extra_qty from cost_sheet_entry a left join purchase_vendor_master b on(a.id=b.cost_sheet_id) left join purchase_requistion_entry c on(a.description=c.description) where b.specification='$specification' and a.id='$cost_id'" ); 


	
$stmtz->execute(); 
$rowz = $stmtz->fetch();

?>
<td><b>Purchase Request(Qty)</b></td>
<td colspan="2"><input type="text" class="form-control" id="txt_org_name" value="<?php echo $rowz['extra_qty'];?>" name="txt_org_name" readonly></td>
</tr>
<tr>
<td><b>Purchase Request Remark</b></td>
<td colspan="4"><input type="text" class="form-control" id="txt_org_name" value="<?php echo $rowz['request_remarks'];?>" name="txt_org_name" readonly></td>
</tr> -->
<!-- <tr>
<td><b>Document</b></td>
<td colspan="2"><a href="/ssinfo_updated/qvision/Purchase_Process/files/<?php echo $row['upload'];?>" target="_blank"><?php echo  $row['upload'];?></a> </td>
<td><b>Vendor Status</b></td>
<td colspan="2"><input type="text" class="form-control" id="txt_org_name" value="<?php echo $status;?>" name="txt_org_name" readonly></td>
</tr>
<tr>
</tr> -->

</table>

<table id="dataTable" width="300px" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered">
		 <thead>
			<tr>
			  
			  <th>PRODUCT</th>
			  <th>QTY</th>
			  <th>UNIT RATE</th>
			  <th>AMOUNT </th>

			</tr>
		 </thead>
		  <tbody>
		<?php  
		$cost_sheet_no=$row['cost_no'];
		 $query= $con->query("SELECT * from purchase_vendor_master where  id='$purchase_id'"); 
				 
		    //echo "SELECT * from purchase_vendor_master where status ='2' and cost_sheet_no='$cost_sheet_no'"; 
			  
			$cnt=1; 
		 while($cost = $query->fetch(PDO::FETCH_ASSOC)){ 
		    
			 /* echo "hi";
			 echo "SELECT a.id as costsheet_id,a.*,b.*,e.* from cost_sheet_entry a 
				 inner join client_master b on(b.id=a.client_id) 
				 inner join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='1' and a.cost_sheet_no='$cost_sheet_no'"; */
				 
				//echo  $cnt;  	 
		?>
		<tr>
		 
		  <td>
		    <INPUT type="hidden" id="cost_sheet_no" name="cost_sheet_no" class="form-control" value="<?php echo $cost['cost_sheet_no']; ?>" readonly="readonly">
			<?php echo $cost['specification']; ?></td>

		  <td>
			<?php echo $cost['unit_qty']; ?></td>
			
		  <td>
			<?php echo $cost['unit_cost']; ?></td>
		  <td>
			<?php echo $cost['price']; ?></td>

		  

		
		
		  
		  <!--<td>
		    <INPUT type="button" class="btn btn-success" value="Add " onclick="addRow('dataTable')" />
	        <INPUT type="button" class="btn btn-danger" value="Delete" onclick="deleteRow('dataTable')" />
		   </td>-->
		</tr>
		 <?php $cnt++; } ?>
		</tbody>
		<?php  

		$query1= $con->query("SELECT * from purchase_vendor_master where  id='$purchase_id' order by id desc"); 

		// echo "SELECT * from purchase_vendor_master where  cost_sheet_no='$cost_sheet_no' order by id desc";
				 
				 $query1->execute(); 
                 $row1 = $query1->fetch();				 


				  

				 ?>
	   <table id="dataTable" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >

		<tr>
		  <td colspan="5" align="center"><b>GST Percentage <?php echo $row1['gst_per']; ?>%</b></td>
		  <td colspan="3" align="right">
		    <INPUT type="text" id="gst_per" name="gst_per" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['gst_val']; ?>" readonly="readonly">
		  </td>
		</tr>
		<tr>
		  <td colspan="5" align="center"><b>iGST Percentage <?php echo $row1['igst_per']; ?>%</b></td>
		  <td colspan="3" align="right">
		    <INPUT type="text" id="igst_per" name="igst_per" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['igst_val']; ?>" readonly="readonly">
		  </td>
		</tr>
		<tr>
		  <td colspan="5" align="center"><b>Discount Percentage <?php echo $row1['disc_per']; ?>%</b></td>
		  <td colspan="3" align="right">
		    <INPUT type="text" id="discount" name="discount" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['discount']; ?>" readonly="readonly">
		  </td>
		</tr>
		<tr>
		  <td colspan="5" align="center"><b>Grand Total</b></td>
		  <td colspan="3" align="right">
		    <INPUT type="text" id="grand_total" name="grand_total" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['grand_total']; ?>" readonly="readonly">
		  </td>
		</tr>
<?php 
	$request=$con->query("select id,invoice_reject_remark from purchase_generate  where purchase_id = '$purchase_id ' ");

    $invreqst = $request->fetch(PDO::FETCH_ASSOC);
?>        
        <tr>
<td align="center"><b> Reject Remark</b></td>
<td colspan="5">
    <input type="hidden" name="poGen" id="poGen" value="<?php echo $invreqst['id'];?>">
    <textarea class="form-control"  name="invoice_reject_remark" readonly> <?php echo $invreqst['invoice_reject_remark'];?> </textarea> 
</td>
</td>
</tr>	
	  </table>
 
	  </table>


	  <div style="text-align:center;"> 
		    <input type="button" class="btn btn-success" id="save" name="save" onclick="approve_invoice_re_req(<?php echo $invoiceId; ?>)"  style="margin: 5px;" value="Re-Request">
		    <!-- <input type="button" class="btn btn-danger" id="save" name="save"  onclick="openForm()"  style="margin: 5px;" value="Reject"> -->
		</div>
<br/>
</div>
</form>
</div>
     </div>	
	<!-- Sub Total: <input type="text" readonly="readonly" id="total"><br><input type="submit" value="Create Invoice">-->	
  </div>
   <!--<button class="open-button" onclick="openForm()">Open Form</button>-->

		<div class="form-popup" id="myForm">
		  <form action="" class="form-container">
			<h3>Vendor Reject Remark</h3>

			<label for="email"><b>Remark</b></label>
			<input type="text" placeholder="Enter Remark" name="remark" id ="remark" required>
          
			<button type="button" class="btn" onclick="revise_invoice(<?php echo $invoiceId; ?>)">Submit</button>
			<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
		  </form>
		</div>
  
  
  <style>
/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 400px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 25px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
   
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
 
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
  

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

function approve_invoice_re_req(v)
{
	var pogenid  = document.getElementById("poGen").value;
   
	$.ajax({
	type:'GET',
	data:"id="+ pogenid ,
    url:"qvision/Purchase_process/delivery_challan/re_request_toApprove.php",
	success:function(data)
	{      
		alert("Approved Successfully");
		invoice_rerequest()
				  
	}       
	});
}

function revise_invoice(v)
{

	var id    = document.getElementById("vendor_id").value;
	var remark    = document.getElementById("remark").value;
 	$.ajax({
	type:'GET',
	data:"id="+v+'&remark='+remark,
	url:"qvision/Purchase_process/delivery_challan/finance_invoice_reject.php?id="+v+'&remark='+remark,
	success:function(data)
	{      
		alert("Invoice Rejected");
        invoice_approve()
				  
	}       
	}); 
}
</script>