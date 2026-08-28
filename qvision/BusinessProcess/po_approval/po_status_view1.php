<?php
require '../../../connect.php';
$quoteid=$_REQUEST['id']; echo $quoteid;
$stmt=$con->prepare("SELECT distinct a.cost_sheet_no,a.enquiry_id,a.business_id,b.*,c.* FROM cost_sheet_entry a 
inner join client_master c on (a.client_id=c.id)
inner join po_generate b on (a.cost_sheet_no=b.cost_sheet_no) where b.id='$quoteid'"); 
//("select * from po_generate where id='$quoteid'");
$stmt->execute(); 
$fet = $stmt->fetch();
//$fet=$sql->fetch();
 $fstatus=$fet['finance_status'];
 $sstatus=$fet['service_status'];
 $mstatus=$fet['marketing_status'];
?>

<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.btn-danger{
	background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black !important;
}
</style>
			  
   <div class="card card-primary">
              <div class="card-header">
                 <h3 style="color:black;" class="card-title"><font size="5">QUOTE DETAIL</font></h3>
				            
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger">BACK</a>
              </div>
			
   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        

        <tr>
			<td colspan="6"><center><b>Quote Detail</b></center></td>
        </tr>
	  <tr >
			<td>Client Name</td>
			<td colspan="5"><input type="text" class="form-control" name="client_id" id="client_id" value="<?php echo $fet['org_name'];?>" readonly>
			</td>
		</tr>
		<tr >

			<td>Quote Number</td>
			<td colspan="5"><input type="text" class="form-control" name="quote_no" id="quote_no" value="<?php echo $fet['quote_no'];?>" readonly>
			</td>
		</tr>
		<tr>
			<td>Cost Sheet No</td>
			<td colspan="5"><input type="text" class="form-control" name="cost_sheet_no" id="cost_sheet_no" value="<?php echo $fet['cost_sheet_no']; ?>" readonly>
			</td>
		</tr>
		<tr>
			<td>SO Number</td>
			<td colspan="5"><input type="text" class="form-control" name="so_number" id="so_number" value="<?php echo $fet['so_number']; ?>" readonly>
			</td>
		</tr>
		<tr>
			<td>Po</td>
			<td colspan="5"><a href="qvision/BusinessProcess/po_approval/uploads/<?php echo $fet['po_upload'];?>" target="_blank"><?php echo $fet['po_upload'];?></a>
			
			</td>
		</tr>
		<tr>
			<td>Finance Person</td>
			<?php 
			$fperso=$fet['finance_approved_by'];
			$sta=$con->query("select * from staff_master where candid_id='$fperso'");
			$sfet=$sta->fetch();
			?>
			<td colspan="5"><input type="text" class="form-control" name="qdate" id="qdate" value="<?php echo $sfet['emp_name']; ?>" readonly>
			</td>
		</tr>
	<?php 
        //finance
		if($fstatus==1)
		{
			$fstas="Approved";
		}
		elseif($fstatus==2)
		{
			$fstas="Rejected";
		}else{
			$fstas="";
		}
		
		//service
		//echo $sstatus;
		if($sstatus==1)
		{
			$sstas="Approved";
		}
        elseif($sstatus==2)
		{
			$sstas="Rejected";
		}else{
			$sstas="";
		}
       //solution		
		if($mstatus==1){
			$mstas="Approved";
				}
		elseif($mstatus==2)
		{
		  $mstas="Rejected";
		}else{
			
			$mstas="";
		}		
			?>
			<tr>
		<td>Finance Remarks</td>
		<td colspan="5"><input type="text" name="remarks" id="remarks" class="form-control" value="<?php echo $fstas;?>" readonly></td>
		</tr>
			<?php 
		
?>	
	<tr>
			<td>Service Person</td>
			<?php 
			$sperso=$fet['service_approved_by'];
			$ssta=$con->query("select * from staff_master where candid_id='$sperso'");			
			$sefet=$ssta->fetch();
			?>
			<td colspan="5"><input type="text" class="form-control" name="qdate" id="qdate" value="<?php echo $sefet['emp_name']; ?>" readonly>
			</td>
		</tr>
			
<?php
/* if($sstatus ='0')
{
 */	?>
	<tr>
		<td>Service Remarks</td>
		<td colspan="5"><input type="text" name="remarks" id="remarks" class="form-control" value="<?php echo $sstas;?>" readonly></td>
		</tr>
	<?php
//}
	?>
		<tr>
			<td>Marketing Person</td>
			<?php 
			$sperso=$fet['marketing_approved_by'];
			$ssta=$con->query("select * from staff_master where candid_id='$sperso'");			
			$sefet=$ssta->fetch();
			?>
			<td colspan="5"><input type="text" class="form-control" name="qdate" id="qdate" value="<?php echo $sefet['emp_name']; ?>" readonly>
			</td>
		</tr>

		
<?php
/* if($mstatus ='0')
{
	 */?>
	<tr>
		<td>Marketing Remarks</td>
		<td colspan="5"><input type="text" name="remarks" id="remarks" class="form-control" value="<?php echo $mstas;?>" readonly></td>
		</tr>
	<?php
//}
	?>
		</table>
		<?php 
		$cno=$fet['cost_sheet_no'];
		$cost=$con->query("select * from cost_sheet_entry where cost_sheet_no='$cno'");
		?>
		<table class="table table-bordered table-striped">
		 <th>SPECIFICATION</th>
		  <th>QTY</th>
		  <th>UNIT</th>
		  <th>UNIT RATE</th>
		  <th formula="cost*qty" summary="sum">AMOUNT</th>
		  <th colspan='2'>LOGISTIC</th>
		  <th colspan='2'>ENGINEER</th>
		  <th colspan='2'>MARGIN</th>
		  <th>TOTAL ITEMS</th>
		<tbody>
		<?php 
		$i=1;
		while($dis=$cost->fetch())
		{
			?>
			<tr>
			 <td>
		     <INPUT type="hidden" id="cost_sheet_no" name="cost_sheet_no" class="form-control" value="<?php echo $dis['cost_sheet_no']; ?>" readonly="readonly">
			 <?php echo $dis['specification']; ?></td>
			  <td><?php echo $dis['qty']; ?></td>
			  <td><?php echo $dis['unit']; ?></td>
				
			  <td><?php echo $dis['unit_rate']; ?></td>
			  <td><?php echo $dis['total_price']; ?></td>
			  <td><?php echo $dis['log_per']; ?></td>
			  <td><?php echo $dis['log_amt']; ?></td>
			  <td><?php echo $dis['eng_per']; ?></td>
			  <td><?php echo $dis['eng_amt']; ?></td> 
			  <td><?php echo $dis['com_per']; ?></td>
			  <td><?php echo $dis['com_amt']; ?></td>
			  <td><?php echo $dis['total_amt']; ?></td>
			
			</tr>
			<?php
		$i++;
		}
		?>
		
		<?php 
		$cost1=$con->query("select * from cost_sheet_entry where cost_sheet_no='$cno'");
		$cfet=$cost1->fetch()?>
		<tr>
		  <td colspan="6" align="center"><b>Net Amount</b></td>
		 
		  <td colspan="6"align="right">
		    <INPUT type="text" id="total_item" name="total_item" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $cfet['net_amt']; ?>" readonly="readonly">
		  </td>
		</tr>
		<tr>
		  <td colspan="6" align="center"><b>GST Percentage <?php echo $cfet['gst_per']; ?>%</b></td>
		  <td colspan="6" align="right">
		    <INPUT type="text" id="gst_per" name="gst_per" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $cfet['gst_amt']; ?>" readonly="readonly">
		  </td>
		</tr>
		<tr>

		  <td colspan="6" align="center"><b>IGst Percentage <?php echo $cfet['igst_per']; ?>%</b></td>

		  <td colspan="6" align="right">
		    <INPUT type="text" id="gst_per" name="igst_per" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $cfet['igst_amount']; ?>" readonly="readonly">
		  </td>
		</tr>
		
		<tr>
		  <td colspan="6" align="center"><b>Grand Total</b></td>
		  <td colspan="6" align="right">
		    <INPUT type="text" id="grand_total" name="grand_total" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $cfet['grand_amt']; ?>" readonly="readonly">
		  </td>
		</tr>
		</tbody>
		
      </table>
    
        <!-- /.post -->
    </form>
    </div>

<script>
$(document).ready(function() {
    $('#example1').DataTable( {
        "scrollY": 400,
        "scrollX": true
    } );
} );
</script>
<script>
$(document).ready(function(){
	//alert("hii");
//document.getElementById('remark').style.visibility = "hidden";
$('#remark').hide();
})
</script>
<script>
function reject_po(v)
{
	//alert("hii");
	$('#remark').show();
	
	
}
function back()
	{
		po_status();
	}

	</script>
	<script>
function submit_po(v)
{
	//alert(v);
	var remark=$('#remarks').val();
	$.ajax({
		type:"post",
		data:"id="+v+"&remark="+remark,
		url:"qvision/BusinessProcess/po_approval/po_reject.php?id="+v+"&remark="+remark,
		success:function(data)
		{
			if(data==1)
			{
				alert("Rejected Successfully");
				po_approve();
			}
			else
			{
				alert("not approved");
			}
		}
	});
}
</script>
<script>

function approve_po(v)
{
	//alert(v);
	$.ajax({
		type:"post",
		data:"id="+v,
		url:"qvision/BusinessProcess/po_approval/po_submit.php?id="+v,
		success:function(data)
		{
			if(data==1)
			{
				alert("Approved Successfully");
				po_approve();
			}
			else
			{
				alert("not approved");
				po_approve();
			}
		}
	})
}
</script>



