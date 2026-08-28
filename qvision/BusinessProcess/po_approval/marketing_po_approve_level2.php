<?php
require '../../../connect.php';
$quoteid=$_REQUEST['id'];
/* $sql=$con->query("SELECT distinct a.cost_sheet_no,a.approved_by,a.status as cs_status,a.enquiry_id,b.* FROM cost_sheet_entry a 
inner join po_generate b on (a.cost_sheet_no=b.cost_sheet_no) where b.id='$quoteid'"); */
$sql=$con->query("SELECT distinct a.cost_sheet_no,a.approved_by,a.status as cs_status,a.enquiry_id,b.*,c.*,p.* FROM cost_sheet_entry a 
inner join po_generate b on (a.cost_sheet_no=b.cost_sheet_no)left join new_client_master c on (a.client_id=c.id)left join new_plant_master p on (c.org_name=p.client_org_name) where b.id='$quoteid'");
$fet=$sql->fetch();
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
	<style>
	.card-primary:not(.card-outline)>.card-header{
		background-color: #f1cc61 !important;
	}
	</style>
<div  class="card card-primary">
              <div class="card-header">
                <h3 style="float: left;">PO APPROVAL</h3>
				            
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger">BACK</a>
              </div>
              </div>
           
              <div class="card-body">
              <table class="table table-striped table-bordered table-hover display nowrap"  id="example1" style="width:100%">

		
			
   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
	<input type="hidden" class="form-control" id="enquiry_id" name="enquiry_id" value="<?php echo $fet['enquiry_id']; ?>" readonly>
	<input type="hidden" class="form-control" id="cost_sheet_no" name="cost_sheet_no" value="<?php echo $fet['cost_sheet_no']; ?>" readonly>
    <table class="table table-bordered">
        
        <tr>
			<td colspan="6"><center><b>Quote Detail</b></center></td>
        </tr>
	  <tr >
			<td>Company Name</td>
			<td colspan="5"><input type="text" class="form-control" name="quote_no" id="quote_no" value="<?php echo $fet['org_name'];?>" readonly>
			</td>
		</tr>
		<tr >
			<td>Client Name</td>
			<td colspan="5"><input type="text" class="form-control" name="quote_no" id="quote_no" value="<?php echo $fet['contact_person'];?>" readonly>
			</td>
		</tr>
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
		<tr>
			<td>PO Document:</td>
			<td colspan="5"><a href="/qvision/BusinessProcess/po_approval/uploads/<?php echo $fet['po_upload'];?>" download="<?php echo $fet['po_upload']; ?>"><?php echo $fet['po_upload']; ?></a>
			</td>
		</tr>
		</table>
		<?php 
		$cno=$fet['cost_sheet_no'];
		$cost=$con->query("select * from cost_sheet_entry where cost_sheet_no='$cno'");
		?>
		<table class="table table-bordered table-striped" style="width:130%;">
		  <th>Product ID</th>
		 <th>Product Name</th>
		 <th>Description</th>
		  <th>QTY</th>
		  <th>UNIT RATE</th>
		  <th formula="cost*qty" summary="sum">Purchase Amount</th>
		  <th colspan='2'>Dist Margin %</th>
		  <th colspan='2'>Overall Margin</th>
		  <th>Selling Price</th>
		  <th colspan='2'>Logistics</th>
		  <th colspan='2'>Service Cost</th>
		  <th>Total Amount</th>
		  <th colspan='2'>GST</th>
		  <th colspan='2'>IGST</th>
		   <th>Total Amount with GST</th>
		<tbody>
		<?php 
		$i=1;
		while($dis=$cost->fetch())
		{
			?>
			<tr>
			
		     <td>
		     <INPUT type="hidden" id="cost_sheet_no" name="cost_sheet_no" class="form-control" value="<?php echo $dis['cost_sheet_no']; ?>" readonly="readonly">
			 <?php echo $dis['product_id']; ?></td>
			  <td><?php echo $dis['product_name']; ?></td>
			  <td><?php echo $dis['description']; ?></td>
			  <td><?php echo $dis['qty']; ?></td>
			  <td><?php echo $dis['unit_rate']; ?></td>
			  <td><?php echo $dis['total_price']; ?></td>
			  <td><?php echo $dis['dist_per']; ?></td>
			  <td><?php echo $dis['dist_amt']; ?></td>
			  <td><?php echo $dis['com_per']; ?></td>
			  <td><?php echo $dis['com_amt']; ?></td>
			  <td><?php echo $dis['sel_price']; ?></td>
			  <td><?php echo $dis['log_per']; ?></td>
			  <td><?php echo $dis['log_amt']; ?></td>
			  <td><?php echo $dis['eng_per']; ?></td>
			  <td><?php echo $dis['eng_amt']; ?></td>
			  <td><?php echo $dis['total_amt']; ?></td>
			  <td><?php echo $dis['gst_per']; ?></td>
			  <td><?php echo $dis['gst_amt']; ?></td>
			  <td><?php echo $dis['igst_per']; ?></td>
			  <td><?php echo $dis['igst_amount']; ?></td>
			  <td><?php echo $dis['total_gst']; ?></td>
		</tr>
			<?php
		$i++;
		}
		?>
		<?php 
		$cost1=$con->query("select * from cost_sheet_entry where cost_sheet_no='$cno'");
		$cfet=$cost1->fetch()?>
	 <tr>
		  <td colspan="5" align="center"><b>Profit Per</td>
		 
		  <td colspan="5"align="right">
		    <INPUT type="text" id="total_item" name="total_item" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $cfet['mar_per']; ?>" readonly="readonly">
		  </td>
		   <td colspan="5" align="center"><b>Profit Amount</td>
		 
		  <td colspan="6"align="right">
		    <INPUT type="text" id="total_item" name="total_item" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $cfet['mar_amt']; ?>" readonly="readonly">
		  </td>
		  
		</tr>
		 <tr>
		  <td colspan="11" align="center"><b>Net Amount</b></td>
		 
		  <td colspan="11"align="right">
		    <INPUT type="text" id="total_item" name="total_item" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $cfet['net_amt']; ?>" readonly="readonly">
		  </td>
		</tr>
		<!--<tr>
		  <td colspan="11" align="center"><b>GST Persentage <?php echo $cfet['gst_per']; ?>%</b></td>
		  <td colspan="11" align="right">
		    <INPUT type="text" id="gst_per" name="gst_per" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $cfet['gst_amt']; ?>" readonly="readonly">
		  </td>
		</tr>
		<tr>
		  <td colspan="11" align="center"><b>IGST Persentage <?php echo $cfet['igst_per']; ?>%</b></td>
		  <td colspan="11" align="right">
		    <INPUT type="text" id="igst_per" name="igst_per" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $cfet['igst_amount']; ?>" readonly="readonly">
		  </td>
		</tr>-->
		
		
		<tr>
		  <td colspan="11" align="center"><b>Grand Total</b></td>
		  <td colspan="11" align="right">
		    <INPUT type="text" id="grand_total" name="grand_total" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $cfet['grand_amt']; ?>" readonly="readonly">
		  </td>
		</tr>
		</tbody>
		
      </table>
     <?php 
	 $marstatus=$fet['marketing_status'];
	 $finstatus=$fet['finance_status'];
	 $mdstatus=$fet['md_status'];
	 if($mdstatus=='0' and $finstatus=='0' and $marstatus=='1')
	 {
		 ?>
		 <tr>  
        <td colspan="11"><input type="button" class="btn btn-success" name="save" id="<?php echo $quoteid; ?>" onclick="approve_po_level2(this.id)" style="float:right;margin: 5px;" value="Approve"></td>
         <td colspan="11"><input type="button" class="btn btn-danger" name="reject" id="<?php echo $quoteid;?>" onclick="reject_po(this.id)" style="float:right;margin: 5px;" value="Reject"></td>
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
		<input type="button" name="submit" class="btn btn-success" id="<?php echo $quoteid;?>" onclick="submit2_po(this.id)" style="float:right" value="Submit">
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
		marketing_po_approve();
	}

	</script>
	<script>
function submit2_po(v)
{
	//alert(v);
	var remark=$('#remarks').val();
	$.ajax({
		type:"post",
		data:"id="+v+"&remark="+remark,
		url:"qvision/BusinessProcess/po_approval/marketing_po_reject_level2.php?id="+v+"&remark="+remark,
		success:function(data)
		{
			
				alert("Rejected Successfully");
				marketing_po_approve();
			
		}
	});
}
</script>
<script>

function approve_po_level2(v)
{
	//alert(v);
	var enquiry_id  = document.getElementById("enquiry_id").value;
	var cost_sheet_no  = document.getElementById("cost_sheet_no").value;
	$.ajax({
		type:"post",
		data:"id="+v+'&cost_sheet_no='+cost_sheet_no+'&enquiry_id='+enquiry_id,
		url:"qvision/BusinessProcess/po_approval/marketing_po_submit_level2.php?id="+v+'&cost_sheet_no='+cost_sheet_no+'&enquiry_id='+enquiry_id,
		success:function(data)
		{
				marketing_po_mail();
				alert("Level 2 Approved Successfully");
				
				marketing_po_approve2();
			
		}
	})
}
</script>

<script>
function marketing_po_mail()
    {
        var cost_sheet_no1  = document.getElementById("cost_sheet_no").value;
		//alert(cost_sheet_no1);
		
        $.ajax({
            type: "POST",
			data:"costsheet_no="+cost_sheet_no1,
            url: "qvision/BusinessProcess/po_approval/marketing_po_mail_post_level2.php?costsheet_no="+cost_sheet_no1,
            success: function (data) {
               // $("#main_content").html(data);
            }
        })
    }
</script>
<script>
	
    function marketing_po_approve()
    {
        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/po_approval/marketing_po_approve_level2_list.php",
            success: function (data) {
                $("#main_content").html(data);
            }
        })
    }
	</script>


