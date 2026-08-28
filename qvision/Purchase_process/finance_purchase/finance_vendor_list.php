<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

$sql=$con->query("select * from staff_master where candid_id='$candidateid' and head_status='1'");
$count=$sql->rowcount();
if($count==1)
{
	$quote=$con->query("select a.status,a.so_number,a.cost_sheet_id,b.id,b.cost_sheet_no from purchase_vendor_master a left join cost_sheet_entry b on (a.cost_sheet_id=b.id) where a.status='2' ");
}
else
{
	
	$quote="";
}
?>
<div  class="card card-primary">
     <div class="card-header" style="background-color: #f1cc61 !important;">
	<h2 class="card-title"><font size="5"><b>Vendor PO Approve List</b></font> </h2></div>
	<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
		  <th>SL.No</th>
		  <th>Specification</th>
		  <th>Cost Sheet Number</th>
		  <th>SO Number</th>
		  <th>Status</th>
		  <th>Remarks</th>
		  <th>Action</th>
      </thead>
      <tbody>
      <?php
//$candidateid=$_SESSION['candidateid'];
//$userrole=$_SESSION['userrole'];
	
     $cnt=1;
	 if($count==1)
{
	$quote=$con->query("select a.status as po_status,a.specification,finance_status,a.id as po_id,a.so_number,a.cost_sheet_id,a.*,b.id,b.cost_sheet_no from purchase_vendor_master a left join cost_sheet_entry b on (a.cost_sheet_id=b.id) where a.status='1' order by a.id desc");
/* echo "select a.status as po_status,a.specification,finance_status,a.id as po_id,a.so_number,a.cost_sheet_id,a.*,b.id,b.cost_sheet_no from purchase_vendor_master a left join cost_sheet_entry b on (a.cost_sheet_id=b.id) where a.status='2' "; */

      while($quote_list = $quote->fetch(PDO::FETCH_ASSOC))
	  {
		  
		  $f_approved_id = $quote_list['finance_approved_by'];  
		$s_approved_id = $quote_list['service_approved_by'];
		$finance_remark = $quote_list['finance_remarks'];
		$finance_status = $quote_list['finance_status'];
		$service_remark = $quote_list['service_remark'];
		$service_status = $quote_list['service_status'];
		$marketing_remark = $quote_list['marketing_remark'];
		$marketing_status = $quote_list['marketing_status'];
		if($finance_remark!=''){

		  $remark=$quote_list['finance_remarks'];


	  }elseif($service_remark!=''){

		  $remark=$quote_list['service_remark'];

	  }elseif($marketing_remark!=''){

		  $remark=$quote_list['marketing_remark'];


	  }else{
	  $remark='';
	  }
		  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
	  <td><?php echo $quote_list['specification'];?></td>
      <td><?php echo $quote_list['cost_sheet_no']; ?></td>      
      <td><?php echo $quote_list['so_number']; ?></td>	
<td><?php  
$fstatus=$quote_list['finance_status'];
if($fstatus=='1'){
	echo '<span style="color:green;text-align:center;"><b> Approved  <b/></span>';
}else if($fstatus=='2'){
	echo '<span style="color:green;text-align:center;"><b> Rejected  <b/></span>';
}else{
	
	echo '<span style="color:red;text-align:center;"><b> Waiting for Finance Approval<b/></span>';
}

?></td>	   
   <td><?php echo $remark	; ?></td>
	<td>  
<<button class="btn btn-info" data-id="<?php echo $quote_list['po_id']; ?>" onclick="vendors_view(<?php echo $quote_list['po_id']; ?>)"><i class="fa fa-edit"></i></button>
<button class="btn btn-success right" data-id="<?php echo $quote_list['po_id']; ?>" onclick="vendors_view_edit(<?php echo $quote_list['po_id']; ?>)">
	     <i class="fa fa-eye"></i></button>	
		 
	</td>

      </tr>
      <?php
	  $cnt=$cnt+1;
      }
}
      ?>
      </tbody>
      </table>

     
     </div>

<script>
function vendors_view_edit(v)
{
	  	$.ajax({
	type:"POST",
	url:"qvision/Purchase_process/finance_purchase/finance_edit_view.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}

function vendors_view(v)
{
	  	$.ajax({
	type:"POST",
	url:"qvision/Purchase_process/finance_purchase/finance_vendor_view.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function back_ctc()
	{
		finance_vendor_approve()
	}
	
	$(function () 
	{
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

	
    </script>
