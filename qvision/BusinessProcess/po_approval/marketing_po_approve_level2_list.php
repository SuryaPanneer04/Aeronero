<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

$sql = $con->query("
    SELECT *
    FROM staff_master
    WHERE candid_id='$candidateid'
    AND head_status IN (1,2)
");
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
		  <th>Company Name</th>
		  <th>Client Name</th>
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
	//$quote=$con->query("select * from po_generate where po_upload_status ='1' order by id desc");
$quote=$con->query("SELECT distinct a.cost_sheet_no,a.approved_by,a.status as cs_status,a.enquiry_id,a.business_id,c.*,p.*,e.* FROM cost_sheet_entry a 
left join new_client_master c on (a.client_id=c.id)left join new_plant_master p on (c.id=p.client_id) left join po_generate e on(a.cost_sheet_no=e.cost_sheet_no)
where (e.po_upload_status ='1' || e.po_upload_status ='2') order by e.id desc");
      while($quote_list = $quote->fetch(PDO::FETCH_ASSOC))
	  {
		  		$mstatus = $quote_list['marketing_status'];
 

		
if($mstatus==0){}
else
{
	$m_approved_id = $quote_list['marketing_approved_by'];
	
		 $mtmtf = $con->prepare("SELECT emp_name from staff_master where candid_id ='$m_approved_id' "); 	
		 //echo "SELECT emp_name from staff_master where candid_id ='$approved_id'";
		 $mtmtf->execute(); 
		 $rowm = $mtmtf->fetch();
		 $market_emp_name = $rowm['emp_name'];
}
	
$md_status=$quote_list['md_status']; 
	if($md_status==0){}
else
{
	$s_approved_id = $quote_list['md_approved_by'];
	$stmts = $con->prepare("SELECT emp_name from staff_master where candid_id ='$s_approved_id' "); 	
		 //echo "SELECT emp_name from staff_master where candid_id ='$approved_id'";
		 $stmts->execute(); 
		 $rows = $stmts->fetch();
		 $md_emp_name = $rows['emp_name'];
}

$fstatus=$quote_list['finance_status'];
if($fstatus==0){}
else
{
	$f_approved_id = $quote_list['finance_approved_by'];  
		
		 
		 $stmtf = $con->prepare("SELECT emp_name from staff_master where candid_id ='$f_approved_id' "); 	
		 //echo "SELECT emp_name from staff_master where candid_id ='$approved_id'";
		 $stmtf->execute(); 
		 $rowf = $stmtf->fetch();
		 $finance_emp_name = $rowf['emp_name'];
}
		
		 		 
		  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $quote_list['org_name']; ?></td>
      <td><?php echo $quote_list['contact_person']; ?></td>
      <td><?php echo $quote_list['quote_no']; ?></td>
      <td><?php echo $quote_list['cost_sheet_no']; ?></td>	
      <td><?php echo $quote_list['so_number']; ?></td>
<td><?php  $md_status=$quote_list['md_status']; 
 $mstatus=$quote_list['marketing_status']; 
 $fstatus=$quote_list['finance_status']; 
/* if($fstatus==1)
{
	echo '<span style="color:green;text-align:center;"><b> Approved  <b/></span>';
}
else if($fstatus==2){
	echo '<span style="color:green;text-align:center;"><b> Rejected<b/></span>';
}else if($quote_list['service_status']=='0'){
    echo '<span style="color:green;text-align:center;"><b> Finance Approved By '; ?><?php echo $finance_emp_name;?>/<?php  echo ' And Waiting For Service Approval <b/></span>'; 
}else if($quote_list['marketing_status']=='0'){
    echo '<span style="color:green;text-align:center;"><b> Marketing Approved By '; ?><?php echo $finance_emp_name;?>/<?php  echo ' And Waiting For Service Approval <b/></span>'; 
}else if($quote_list['service_status']=='1'){
    echo '<span style="color:green;text-align:center;"><b> Service Approved By ';  ?><?php echo $service_emp_name;?>/<?php  echo '<span style="color:red;text-align:center;"><b>And Waiting For Marketing Approval <b/></span>'; 
	} */
 
 if($md_status==1)
{
		if($md_status==1 && $mstatus==1 && $fstatus ==0){
	 
	echo '<span style="color:green;text-align:center;"><b>Marketing Level-1 Approved By <b/></span>';
	echo $market_emp_name;

	echo '<span style="color:green;text-align:center;"><b><br> And  Marketing Level-2 Approved By<b/></span>';
	echo $md_emp_name;
	echo '<span style="color:red;text-align:center;"><b><br> And  Waiting For Finance Approvel<b/></span>';
	}elseif($md_status==1 && $mstatus==1 && $fstatus ==1){

		 echo '<span style="color:green;text-align:center;"><b>Marketing Level-1 Approved By <b/></span>';
	echo $market_emp_name;

	echo '<span style="color:green;text-align:center;"><b><br> Marketing Level-2 Approved By<b/></span>'; 
	echo $md_emp_name;

	echo '<span style="color:green;text-align:center;"><b><br> Finance Approved By<b/></span>'; 
	echo $finance_emp_name;
	}elseif($md_status==1 && $mstatus==1 && $fstatus ==2){

		 echo '<span style="color:green;text-align:center;"><b>Marketing Level-1 Approved By <b/></span>';
	echo $market_emp_name;
	
	echo '<span style="color:green;text-align:center;"><b><br> Marketing Level-2 Approved By<b/></span>'; 
	echo $md_emp_name;
	
	echo '<span style="color:red;text-align:center;"><b><br> Finance Rejected By<b/></span>'; 
	echo $finance_emp_name;
	}
}
elseif($md_status==2){
	if($md_status==2 && $mstatus==1){
		
		 echo '<span style="color:green;text-align:center;"><b>Marketing Level-1 Approved By <b/></span>';
	echo $market_emp_name;				 
		echo '<span style="color:red;text-align:center;"><b><br> And Marketing Level-2 Rejected By <b/></span>';
	echo $md_emp_name;		 
	}
}elseif($md_status==0){
	if($md_status==0 && $mstatus==1){
		
		 echo '<span style="color:green;text-align:center;"><b>Marketing Level-1 Approved By <b/></span>';
		echo $market_emp_name;
		echo '<span style="color:red;text-align:center;"><b><br> Waiting For Marketing Level-2 Approval<b/></span>';
	 
	}elseif($md_status==0 && $mstatus==0){

		echo '<span style="color:red;text-align:center;"><b><br> Waiting For Marketing Level-1 Approval<b/></span>';
	 
	}
}
?></td>	  
	<td>  
   <?php // if($md_status=='0'){ ?>
	<button class="btn btn-info" data-id="<?php echo $quote_list['id']; ?>" onclick="marketing_po_view2(<?php echo $quote_list['id']; ?>)"><i class="fa fa-eye"></i></button>
	 <?php //} ?>
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


function marketing_po_view2(v)
{
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/BusinessProcess/po_approval/marketing_po_approve_level2.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function back_ctc()
	{
		marketing_po_approve2()
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
