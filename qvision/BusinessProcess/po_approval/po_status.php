<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

$sql=$con->query("select * from staff_master where candid_id='$candidateid' and head_status='1'");
$count=$sql->rowcount();
if($count==1)
{
	$quote=$con->query("select * from po_generate where po_upload_status='1' ");
}
else
{
	
	$quote="";
}
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
	<h3 class="card-title"><font size="5">SOF STATUS</font></h3></div>
	<div class="card-body">
    <table class="table table-striped table-bordered table-hover display nowrap"  id="example1" style="width:100%">
      <thead>
		  <th>#</th>
		  <th>Company Name</th>
		  <th>Client Name</th>
		  <th>Quote Number</th>
		  <th>Cost Sheet Number</th>
		  <th>SO Number</th>		  
		  <th>Marketing-1 Status</th>
		  <th>Marketing-2 Status</th>
		  <th>Finance Status</th>
		  <th>Purchase Status</th>
		  <th>Action</th>
      </thead>
      <tbody>
      <?php
//$candidateid=$_SESSION['candidateid'];
//$userrole=$_SESSION['userrole'];
	
     $cnt=1;

	/* $quote=$con->query("select * from po_generate where po_upload_status='1' or po_upload_status='2' order by id desc"); */
	
	$quote=$con->query("
SELECT DISTINCT
a.id,
a.quote_no,
a.cost_sheet_no,
a.so_number,
a.marketing_status,
a.marketing_approved_by,
a.md_status,
a.md_approved_by,
a.finance_status,
a.finance_approved_by,
b.cost_sheet_no,
b.enquiry_id,
c.id AS enqs_id,
c.Company_name,
d.client_name AS Client,
a.purchase_invoice_sts AS pi_sts
FROM po_generate a
LEFT JOIN cost_sheet_entry b
    ON a.cost_sheet_no = b.cost_sheet_no
LEFT JOIN enquiry c
    ON b.enquiry_id = c.id
LEFT JOIN client_master d
    ON c.Client_id = d.id
WHERE a.po_upload_status IN ('1','2')
ORDER BY a.id DESC
");
	
	 /* echo "select a.id,a.quote_no,a.cost_sheet_no,a.so_number,a.marketing_status,a.marketing_approved_by,
	a.md_status,a.md_approved_by,a.finance_status,a.finance_approved_by,b.cost_sheet_no,b.enquiry_id,c.id as enqs_id,c.Company_name,c.Client from po_generate a left join cost_sheet_entry b on(a.cost_sheet_no=b.cost_sheet_no) left join enquiry c  on(b.enquiry_id=c.id)where (a.po_upload_status='1' or a.po_upload_status='2') order by id desc"; */
//echo "select * from quote_generate where po_upload_status='1' ";
      while($quote_list = $quote->fetch(PDO::FETCH_ASSOC))
	  {

		  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $quote_list['Company_name']; ?></td>
      <td><?php echo $quote_list['Client']; ?></td>
      <td><?php echo $quote_list['quote_no']; ?></td>
      <td><?php echo $quote_list['cost_sheet_no']; ?></td>	
      <td><?php echo $quote_list['so_number']; ?></td>	
  
<td>
<?php $mstatus=$quote_list['marketing_status'];
$mstatus_approved=$quote_list['marketing_approved_by'];
if($mstatus=='1')
{
	$sql1=$con->query("SELECT full_name,candidate_id FROM z_user_master  where candidate_id='$mstatus_approved'");
$fet1=$sql1->fetch();
$empm_name=$fet1['full_name'];
	echo '<span style="color:green;text-align:center;"><b>SOF Approved By </b></span>';?>
				<?php echo $empm_name;
}
elseif($mstatus=='2')
{
	$sql1=$con->query("SELECT full_name,candidate_id FROM z_user_master  where candidate_id='$mstatus_approved'");
$fet1=$sql1->fetch();
$empm_name=$fet1['full_name'];

	echo '<span style="color:red;text-align:center;"><b>SOF Rejected by <b/></span>';
	 echo $empm_name;
}else{
	echo '<span style="color:red;text-align:center;"><b> Waiting For Approval<b/></span>';
}
?>
</td>	

	<td>
		<?php $sstatus=$quote_list['md_status'];
	$md_approved=$quote_list['md_approved_by'];
if($sstatus=='1')
{
	$sql1=$con->query("SELECT full_name,candidate_id FROM z_user_master  where candidate_id='$md_approved'");
$fet1=$sql1->fetch();
$emps_name=$fet1['full_name'];
	echo '<span style="color:green;text-align:center;"><b>SOF Approved By </b></span>';?>
				<?php echo $emps_name;
}
elseif($sstatus=='2')
{
	$sql1=$con->query("SELECT full_name,candidate_id FROM z_user_master  where candidate_id='$md_approved'");
$fet1=$sql1->fetch();
$emps_name=$fet1['full_name'];
	echo '<span style="color:red;text-align:center;"><b>SOF Rejected By </b></span>';?>
				<?php echo $emps_name;
}else{
	echo '<span style="color:red;text-align:center;"><b> Waiting For Approval<b/></span>';
}
?>
</td>

<td>
	<?php 
$fstatus=$quote_list['finance_status'];
$finance_approved=$quote_list['finance_approved_by'];

if($quote_list['pi_sts']==1){
	$sql1=$con->query("SELECT full_name,candidate_id FROM z_user_master  where candidate_id='$finance_approved'");
$fet1=$sql1->fetch();
$empd_name=$fet1['full_name'];

	echo '<span style="color:green;text-align:center;"><b>SOF Approved By </b></span>', $empd_name; 

}	
else{


if($fstatus=='1')
{
	
	$sql1=$con->query("SELECT full_name,candidate_id FROM z_user_master  where candidate_id='$finance_approved'");
$fet1=$sql1->fetch();
$empd_name=$fet1['full_name'];
	echo '<span style="color:green;text-align:center;"><b>SOF Approved By </b></span>';?>
				<?php echo $empd_name; echo '<span style="color:red;text-align:center;"><b>"And Waiting For Purchase"</b></span>';
}
elseif($fstatus=='2')
{
	$sql1=$con->query("SELECT full_name,candidate_id FROM z_user_master  where candidate_id='$finance_approved'");
$fet1=$sql1->fetch();
$empd_name=$fet1['full_name'];
	echo '<span style="color:red;text-align:center;"><b>SOF Rejected By </b></span>';?>
				<?php echo $empd_name;
}else{
	echo '<span style="color:red;text-align:center;"><b> Waiting For Approval<b/></span>';
}
}
?>
</td>

<td>
	<?php  
if($quote_list['pi_sts']==1){

	echo '<span style="color:green;text-align:center;"><b> Purchased Successfully</b></span>';

}	
else{

$fstatus=$quote_list['finance_status'];
$finance_approved=$quote_list['finance_approved_by'];
if($fstatus=='1')
{
	
	$sql1=$con->query("SELECT full_name,candidate_id FROM z_user_master  where candidate_id='$finance_approved'");
$fet1=$sql1->fetch();
$empd_name=$fet1['full_name'];
	echo '<span style="color:green;text-align:center;"><b>In-Process</b></span>';

}
elseif($fstatus=='2')
{
	$sql1=$con->query("SELECT full_name,candidate_id FROM z_user_master  where candidate_id='$finance_approved'");
$fet1=$sql1->fetch();
$empd_name=$fet1['full_name'];
	echo '<span style="color:red;text-align:center;"><b>SOF Rejected By </b></span>';?>
				<?php echo $empd_name;
}
else{
	echo '<span style="color:red;text-align:center;"><b> Waiting For Finance Approval<b/></span>';
}
}
?>
</td>	

	<td>  

	<button class="btn btn-info" data-id="<?php echo $quote_list['id']; ?>" onclick="po_status_view(<?php echo $quote_list['id']; ?>)"><i class="fa fa-eye"></i></button>
	</td>
      </tr>
      <?php
	  $cnt=$cnt+1;
      }

      ?>
      </tbody>
      </table>

     
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


function po_status_view(v)
{
	  //alert(v);
	 $.ajax({
	type:"POST",
	url:"qvision/BusinessProcess/po_approval/po_status_view.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	}) 
}
function back_ctc()
	{
		lead()
	}
	


	
    </script>
