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
<div class="card card-primary">
    <div class="card-header">
<h2 class="card-title"><font size="5">QUOTE LIST </font> </h2></div>
<div class="card-body">
<table class="table table-striped table-bordered table-hover display nowrap"  id="example1" style="width:100%">

      <thead>
		  <th>#</th>
		  <th>Quote Number</th>
		  <th>Cost Sheet Number</th>
		  <th>SO Number</th>
		  <th>Status</th>
		  <th>Action</th>
      </thead>
      <tbody>
      <?php
	
     $cnt=1;
	 if($count==1)
{
	$quote=$con->query("select * from po_generate where po_upload_status ='1' order by id desc");

      while($quote_list = $quote->fetch(PDO::FETCH_ASSOC))
	  {
		$m_approved_id = $quote_list['marketing_approved_by'];  
		$md_approved_id = $quote_list['md_approved_by'];  
		$f_approved_id = $quote_list['finance_approved_by'];  
		 
		 $stmtf = $con->prepare("SELECT emp_name from staff_master where candid_id ='$f_approved_id' "); 	
		 //echo "SELECT emp_name from staff_master where candid_id ='$approved_id'";
		 $stmtf->execute(); 
		 $rowf = $stmtf->fetch();
		 $finance_emp_name = $rowf['emp_name'];
		 
		 $mtmtf = $con->prepare("SELECT emp_name from staff_master where candid_id ='$m_approved_id' "); 	
		 //echo "SELECT emp_name from staff_master where candid_id ='$approved_id'";
		 $mtmtf->execute(); 
		 $rowm = $mtmtf->fetch();
		 $market_emp_name = $rowm['emp_name'];
		 
		 $mdtmtf = $con->prepare("SELECT emp_name from staff_master where candid_id ='$md_approved_id' "); 	
		 //echo "SELECT emp_name from staff_master where candid_id ='$approved_id'";
		 $mdtmtf->execute(); 
		 $rowmd = $mdtmtf->fetch();
		 $md_emp_name = $rowmd['emp_name'];
		  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $quote_list['quote_no']; ?></td>
      <td><?php echo $quote_list['cost_sheet_no']; ?></td>	
      <td><?php echo $quote_list['so_number']; ?></td>	
<td><?php  
$mstatus=$quote_list['marketing_status']; 
$md_status=$quote_list['md_status']; 
$finance_status=$quote_list['finance_status']; 
 $marketing_approved_by=$quote_list['marketing_approved_by']; 
 $md_approved_by=$quote_list['md_approved_by']; 
 $finance_approved_by=$quote_list['finance_approved_by']; 


 
 
 if($mstatus==1)
{
	if($mstatus==1 && $md_status==0){
		 
	echo '<span style="color:green;text-align:center;"><b>Marketing Level-1 Approved By <b/></span>';
	echo $market_emp_name;
	echo '<span style="color:red;text-align:center;"><b><br> And Waiting For Marketing Level-2 Approvel<b/></span>';
	}elseif($mstatus==1 && $md_status==1 && $finance_status==0){
		 echo '<span style="color:green;text-align:center;"><b>Marketing Level-1 Approved By <b/></span>';
	    echo $market_emp_name;
		echo '<span style="color:green;text-align:center;"><b><br> And Marketing Level-2 Approved By <b/></span>';
	echo $md_emp_name;
	echo '<span style="color:red;text-align:center;"><b><br> And Waiting For Finance Approvel<b/></span>'; 
		 
	}elseif($mstatus==1 && $md_status==1 && $finance_status==1){
		 echo '<span style="color:green;text-align:center;"><b>Marketing Level-1 Approved By <b/></span>';
	    echo $market_emp_name;
		echo '<span style="color:green;text-align:center;"><b><br> And Marketing Level-2 Approved By <b/></span>';
	echo $md_emp_name;
	echo '<span style="color:red;text-align:center;"><b><br> And Finance Approved By<b/></span>'; 
		echo $finance_emp_name; 
	}elseif($mstatus==1 && $md_status==1 && $finance_status==2){
		 echo '<span style="color:green;text-align:center;"><b>Marketing Level-1 Approved By <b/></span>';
	    echo $market_emp_name;
		echo '<span style="color:green;text-align:center;"><b><br> And Marketing Level-2 Approved By <b/></span>';
	echo $md_emp_name;
	echo '<span style="color:red;text-align:center;"><b><br> And Finance Rejected By<b/></span>'; 
		echo $finance_emp_name; 
	}elseif($mstatus==1 && $md_status==2){
		 echo '<span style="color:green;text-align:center;"><b>Marketing Level-1 Approved By <b/></span>';
	echo $market_emp_name;
	echo '<span style="color:red;text-align:center;"><b><br> Marketing Level-2 Rejected By<b/></span>'; 
	echo $md_emp_name;
	}
}
else if($mstatus==2){
	echo '<span style="color:red;text-align:center;"><b>Marketing Level-1 Rejected By<b/></span>';
	echo$market_emp_name;
	
}else if($mstatus==0){
	echo '<span style="color:red;text-align:center;"><b>PO uploaded & Waiting For Marketing Level-1 Approvel<b/></span>';
}
 
 
 
 
?>


</td>	  
	<td>  
   <?php if($mstatus=='0'){ ?>
	<button class="btn btn-info" data-id="<?php echo $quote_list['id']; ?>" onclick="service_po_view(<?php echo $quote_list['id']; ?>)"><i class="fa fa-eye"></i></button>
	 <?php }?>
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


function service_po_view(v)
{
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/BusinessProcess/po_approval/marketing_po_approve.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function back_ctc()
	{
		marketing_po_approve()
	}
	
	$(function () 
	{
     $(document).ready(function() {
    $('#example1').DataTable( {
        "scrollY": 400,
        "scrollX": true
    } );
	} );
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
