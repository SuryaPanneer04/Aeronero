<?php
require '../../../connect.php';
$quoteid=$_REQUEST['id'];
$sql=$con->query("SELECT distinct a.cost_sheet_no,a.approved_by,a.status as cs_status,a.enquiry_id,b.* FROM cost_sheet_entry a 
inner join po_generate b on (a.cost_sheet_no=b.cost_sheet_no) where b.id='$quoteid'");
$fet=$sql->fetch();
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
<div  class="card card-primary">
              <div class="card-header">
                <h3 style="float: left;">PO DETAILS</h3>
		 
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>BACK</a>
              </div>

 
			
   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
	<input type="hidden" class="form-control" id="enquiry_id" name="enquiry_id" value="<?php echo $fet['enquiry_id']; ?>" readonly>
	<input type="hidden" class="form-control" id="cost_sheet_no" name="cost_sheet_no" value="<?php echo $fet['cost_sheet_no']; ?>" readonly>
    <table class="table table-bordered">
        
      
	  
		<tr >
			<td>Quote number</td>
			<td colspan="5"><input type="text" class="form-control" name="quote_no" id="quote_no" value="<?php echo $fet['quote_no'];?>" readonly>
			</td>
		</tr>
		<tr>
			<td>Cost sheet no:</td>
			<td colspan="5"><input type="text" class="form-control" name="qdate" id="qdate" value="<?php echo $fet['cost_sheet_no']; ?>" readonly>
			</td>
		</tr>
		<tr>
			<td>SO Number:</td>
			<td colspan="5"><input type="text" class="form-control" name="qdate" id="qdate" value="<?php echo $fet['so_number']; ?>" readonly>
			</td>
		</tr>
		
		</table>
		<?php 
		$cno=$fet['cost_sheet_no'];
		$cost=$con->query("select * from cost_sheet_entry where cost_sheet_no='$cno'");
		?>
		<table class="table table-bordered table-striped">
		  <th>SPECIFICATION</th>
		  <th>QTY</th>
		  
		 
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
				
			  
		</tr>
			<?php
		$i++;
		}
		?>
		<?php 
		$cost1=$con->query("select * from cost_sheet_entry where cost_sheet_no='$cno'");
		$cfet=$cost1->fetch()?>
	
		 <tr>
		  <!--<td colspan="6" align="center"><b>Net Amount</b></td-->
		 
		 
		
      </table>
     <?php 
	  $fstatus=$fet['finance_status'];
	 $marstatus=$fet['marketing_status'];
	 $serstatus=$fet['service_status'];
	 if($fstatus=='1' and $serstatus=='0' and $marstatus=='1' )
	 {
		 ?>
		 <tr>  
        <td colspan="6"><input type="button" class="btn btn-success" name="save" id="<?php echo $quoteid; ?>" onclick="approve_po(this.id)" style="float:right;" value="Approve"></td>
         <td colspan="6"><input type="button" class="btn btn-danger" name="reject" id="<?php echo $quoteid;?>" onclick="reject_po(this.id)" style="float:right;" value="Reject"></td>
        </tr> 
	 <?php
	 }
	 else
	 {
		 
	 }
	 ?>
       
		<div id="remark" >
		<tr>
		<td>Remarks:</td>
		<td colspan="5"><input type="text" name="remarks" id="remarks" class="form-control"></td>
		</tr>
		<tr>
		<td >
		<input type="button" name="submit" class="btn btn-success" id="<?php echo $quoteid;?>" onclick="submit_po(this.id)" style="float:right" value="Submit">
		</tr>
		</div>
        </table>
        <!-- /.post -->
    </form>
    </div>

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
	service_po_approve();
}

</script>
<script>

function approve_po(v)
{
	//alert(v);
	var enquiry_id  = document.getElementById("enquiry_id").value;
	var cost_sheet_no  = document.getElementById("cost_sheet_no").value;
	$.ajax({
		type:"post",
		data:"id="+v+'&cost_sheet_no='+cost_sheet_no+'&enquiry_id='+enquiry_id,
		url:"qvision/BusinessProcess/po_approval/service_po_submit.php?id="+v+'&cost_sheet_no='+cost_sheet_no+'&enquiry_id='+enquiry_id,
		success:function(data)
		{
			if(data==1)
			{
				alert("//not approved//");
				service_po_mail();
				service_po_approve();
			}
			else
			{
				alert("Approved Successfully");
				//service_po_mail();
				service_po_approve();
			}
		}
	})
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
		url:"qvision/BusinessProcess/po_approval/service_po_reject.php?id="+v+"&remark="+remark,
		success:function(data)
		{
			if(data==1)
			{
				alert("Rejected Successfully");
				service_po_approve();
			}
			else
			{
				service_po_approve("**not approved**");
			}
		}
	});
}
</script>




