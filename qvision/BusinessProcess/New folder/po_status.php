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
	<h3 class="card-title"><font size="5">PO STATUS</font></h3></div>
	<div class="card-body">
    <table class="table table-striped table-bordered table-hover display nowrap"  id="example1" style="width:100%">
      <thead>
		  <th>#</th>
		  <th>Quote Number</th>
		  <th>Cost Sheet Number</th>
		  <th>SO Number</th>
		  <th>Finance Status</th>
		  <!--th>Service Status</th-->
		  <th>Marketing Status</th>
		  <th>Action</th>
      </thead>
      <tbody>
      <?php
//$candidateid=$_SESSION['candidateid'];
//$userrole=$_SESSION['userrole'];
	
     $cnt=1;

	$quote=$con->query("select * from po_generate where po_upload_status='1' or po_upload_status='2' order by id desc");
//echo "select * from quote_generate where po_upload_status='1' ";
      while($quote_list = $quote->fetch(PDO::FETCH_ASSOC))
	  {
		  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $quote_list['quote_no']; ?></td>
      <td><?php echo $quote_list['cost_sheet_no']; ?></td>	
      <td><?php echo $quote_list['so_number']; ?></td>	
<td><?php  $fstatus=$quote_list['finance_status'];
if($fstatus=='1')
{
	echo '<span style="color:green;text-align:center;"><b> Approved  <b/></span>';
}
elseif($fstatus=='2')
{
	echo '<span style="color:red;text-align:center;"><b> Rejected  <b/></span>';
}
?></td>	  
<!--td><!?php $mstatus=$quote_list['service_status'];
if($mstatus=='1')
{
	echo '<span style="color:green;text-align:center;"><b> Approved  <b/></span>';
}
elseif($mstatus=='2')
{
	echo '<span style="color:red;text-align:center;"><b> Rejected  <b/></span>';
}
?></td-->	  
	<td><?php $sstatus=$quote_list['marketing_status'];
if($sstatus=='1')
{
	echo '<span style="color:green;text-align:center;"><b> Approved  <b/></span>';
}
elseif($sstatus=='2')
{
	echo '<span style="color:red;text-align:center;"><b> Rejected  <b/></span>';
}
?></td>	  
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
