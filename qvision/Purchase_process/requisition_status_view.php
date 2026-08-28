<?php
require '../../connect.php';
require '../../user.php';
$quoteid=$_REQUEST['id'];

$sql=$con->query("select * from purchase_requistion_entry where id='$quoteid'");
$fet=$sql->fetch();
$fstatus=$fet['req_status'];
$candidiateid=$_SESSION['candidateid'];
?>
   <div class="card card-info">
              <div class="card-header">
       	            
			<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
			
   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        
        <tr>
			<td colspan="6"><center><b>Quote Detail</b></center></td>
        </tr>
	  
		<input type='hidden' id='id' name='id' value=<?php echo $quoteid; ?>>
		
		
		<tr>
		<?php
		if($fstatus==1 || $fstatus==2 || $fstatus==3){
			?>
			<td>Finance Person:</td>
			<?php 
			$sta=$con->query("select * from staff_master where design_id='3'");
			$sfet=$sta->fetch();
			?>
			<td colspan="5"><input type="text" class="form-control" name="qdate" id="qdate" value="<?php echo $sfet['emp_name']; ?>" readonly>
			</td>
			<?php
		}
		elseif($fstatus==4)
		{
		?>
		<td>Purchase Person:</td>
			<?php 
			$sta=$con->query("select * from z_user_master where candidate_id='101'");
			$sfet=$sta->fetch();
			?>
			<td colspan="5"><input type="text" class="form-control" name="qdate" id="qdate" value="<?php echo $sfet['user_name']; ?>" readonly>
			</td>
		
		<?php
		}
		?>
		</tr>
		<?php
		
        //finance
		if($fstatus==1)
		{
			$fstas="Waiting For Finance Approval";
		}
		elseif($fstatus==2)
		{
			$fstas="Finance Approved";
		}
		elseif($fstatus==3)
		{
			$fstas="Finance Rejected";
		}
		elseif($fstatus==4)
		{
			$fstas="Purchase Approved";
		}
		//service
		//echo $sstatus;
		
			?>
			<tr>
		<?php
		if($fstatus==1 || $fstatus==2 || $fstatus==3){
			?>
		<td>Finance Remarks:</td>
		<td colspan="5"><input type="text" name="remarks" id="remarks" class="form-control" value="<?php echo $fstas;?>" readonly></td>
		<?php
		}
		elseif($fstatus==4)
		{
		?>
		<td>Purchase Remarks:</td>
		<td colspan="5"><input type="text" name="remarks" id="remarks" class="form-control" value="<?php echo $fstas;?>" readonly></td>
		
		<?php
		}
		?>
		</tr>
		</table>
		<?php 
		$cost=$con->query("select * from purchase_requistion_entry where id='$quoteid'");
		?>
		<table class="table table-bordered table-striped">
		<th>PRODUCT NAME</th>
		<th>PRODUCT ID</th>
		 <th>DESCRIPTION</th>
		  <th>QTY</th>
		  <th>UNIT</th>
		  <th>UNIT RATE</th>
		  <th formula="cost*qty" summary="sum">AMOUNT</th>
		  <th colspan='2'>Logistic</th>
		  <th colspan='2'>Engineer</th>
		  <th colspan='2'>Margin</th>
		  <th>Total Items</th>
		<tbody>
		<?php 
		$i=1;
		while($dis=$cost->fetch())
		{
			?>
			<tr>
			 <td><?php echo $dis['product_name']; ?></td>
			 <td><?php echo $dis['product_id']; ?></td>
			 <td><?php echo $dis['description']; ?></td>
			  <td><?php echo $dis['quantity']; ?></td>
			  <td><?php echo $dis['units']; ?></td>			
			  <td><?php echo $dis['unit_rates']; ?></td>
			  <td><?php echo $dis['tot_prices']; ?></td>
			  <td><?php echo $dis['logs_per']; ?></td>
			  <td><?php echo $dis['log_amts']; ?></td>
			  <td><?php echo $dis['engs_per']; ?></td>
			  <td><?php echo $dis['eng_amts']; ?></td> 
			  <td><?php echo $dis['coms_per']; ?></td>
			  <td><?php echo $dis['com_amts']; ?></td>
			  <td><?php echo $dis['total_amts']; ?></td>
			
			</tr>
		
		
		
		<tr>
		  <td colspan="6" align="center"><b>Net Amount</b></td>
		 
		  <td colspan="6"align="right">
		    <input type="text" id="total_item" name="total_item" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $dis['net_amts']; ?>" readonly="readonly">
		  </td>
		</tr>
		<tr>
		  <td colspan="6" align="center"><b>Gst Persentage <?php echo $dis['gsts_per']; ?>%</b></td>
		  <td colspan="6" align="right">
		    <INPUT type="text" id="gst_per" name="gst_per" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $dis['gst_amts']; ?>" readonly="readonly">
		  </td>
		</tr>
		<tr>
		  <td colspan="6" align="center"><b>Grand Total</b></td>
		  <td colspan="6" align="right">
		    <INPUT type="text" id="grand_total" name="grand_total" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $dis['grand_amts']; ?>" readonly="readonly">
		  </td>
		</tr>
		
		</tbody>
		<?php
		$i++;
		}
		?>
      </table>
	  <?php
	  if($candidiateid==101 && $fstatus==2){
		  ?>
		<div class="card-header">
               
		<a onclick="return approve_pu()" style="margin-left:400px;" data-toggle="modal" class="btn btn-success">Approve</a>		            
          </div>
        <!-- /.post -->
		<?php
	  }
	  ?>
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

/* $(document).ready(function(){
	//alert("hii");
//document.getElementById('remark').style.visibility = "hidden";
$('#remark').hide();
}) */
</script>
<script>
/* function reject_po(v)
{
	//alert("hii");
	$('#remark').show();
	
	
} */
function back()
	{
		purchase_requisition();
	}

	</script>

<script>

function approve_pu()
{
	
	var id=$('#id').val();
	
	$.ajax({
		type:"post",
		data:"id="+id,
		url:"qvision/Purchase_process/requistion_purcahse_submit.php?id="+id,
		success:function(data)
		{
			$("#main_content").html(data);
		}
	})
}
</script>



