<?php
require '../../connect.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];
$quoteid=$_REQUEST['id'];
$sql=$con->query("SELECT a.cost_sheet_no,a.quote_no,a.so_number,a.po_upload,b.file_amount,b.file_upload,c.warrenty FROM po_generate a left join cost_sheet_entry b on (a.cost_sheet_no=b.cost_sheet_no) left join terms_and_condition c on (a.cost_sheet_no=c.cost_sheet_no) where a.po_upload_status='2' and a.id='$quoteid'");
//echo "SELECT a.cost_sheet_no,a.quote_no,a.so_number,a.po_upload,b.file_upload,c.warrenty FROM po_generate a left join cost_sheet_entry b on (a.cost_sheet_no=b.cost_sheet_no) left join terms_and_condition c on (a.cost_sheet_no=c.cost_sheet_no) where a.po_upload_status='2' and a.id='$quoteid'";
$feth=$sql->fetch();
?>
   <div class="card card-info">
              <div class="card-header">
               <h2 class="card-title"><font size="4"><b>Purchase Order Detail</b></font> </h2> 
				            
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
			
   <form method="POST" id="pos_data" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">     
	    <tr>
			<td>
			  Cost sheet no : <?php echo $feth['cost_sheet_no']; ?><br/>
			  Cost Price Doc :<u><a href="/ssinfo_updated/qvision/BusinessProcess/po_approval/uploads/<?php echo $feth['file_upload'];?>" target="_blank"><?php echo $feth['file_upload'];?></a></u>		
			</td>
             <td>			
			  Quote number : <?php echo $feth['quote_no'];?><br/>
			</td>
			<td>
			 SO number : <?php echo $feth['so_number']; ?><br/>		
			 Po Doc : <u><a href="/ssinfo_updated/qvision/BusinessProcess/po_approval/uploads/<?php echo $feth['po_upload'];?>" target="_blank"><?php echo $feth['po_upload'];?></a></u>		
			</td>
		</tr>
		</table>
		
		<?php 
		$cno=$feth['cost_sheet_no'];
		$cost=$con->query("select * from cost_sheet_entry where cost_sheet_no='$cno'");
		?>
		<table class="table table-bordered table-striped">
		 <th>SPECIFICATION</th>
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
		  <td colspan="3" align="center"> <b>Net Amount : </b></td><td colspan="3" align="center"><?php echo $cfet['net_amt']; ?> <br>
		  </td>
		
		  <td colspan="3" align="center"><b>Gst Persentage <?php echo $cfet['gst_per']; ?>%</b></td>
		  <td colspan="3" align="center"><?php echo $cfet['gst_amt']; ?><br>
		  </td>
		</tr>
		<tr>
		  <td colspan="6" align="center"><b>Grand Total : </b></td><td colspan="6" align="center"><?php echo $cfet['grand_amt']; ?><br>
		  </td>
		</tr>
		</tbody>
		
<script>
function back()
    {
		
    $.ajax({
    type:"POST",
    url:"qvision/Purchase_process/purchase_order_list.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }

</script>