<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];

?>
<style>
  .card-primary:not(.card-outline)>.card-header {
    background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header, .card-primary:not(.card-outline)>.card-header a {
    color: #e95a16 !important;
}
.card-primary:not(.card-outline)>.card-header, .card-primary:not(.card-outline)>.card-header a {
    color: #3c0808 !important;
    background-color: #ed5d00;
}
.btn-dark {
    border-color: #ed5d00;
}
.page-item.active .page-link {
    background-color: #d79475;
    border-color: #df8459;
}
.page-link:hover {
    color: #f1cc61;
}
.card-primary:not(.card-outline)>.card-header{
	background-color: #df8459 !important;
}
.btn-dark{
	background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
}
  </style>
  <style>
.card-info:not(.card-outline)>.card-header a {
	color: #3c0808 !important;
	background-color: #ed5d00;
}
.btn-dark{
	background-color: rgb(237, 93, 0);
	color: rgb(60, 8, 8) !important;
	border-color: rgb(237, 93, 0);
}
	.card-primary:not(.card-outline)>.card-header{
		background-color: #f1cc61 !important;
	}
	
</style>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include DataTables library -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

	<script>
$(document).ready(function() {
    $('#dataTable').DataTable( {
         "scrollY": 400,
        "scrollX": true
    } );
} );
</script>
<script>
function costpo_view(v){
	 //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/BusinessProcess//po_approval/po_upload.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}

function costz_view(v){
	 //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/BusinessProcess/quotation/quotation_send_view.php?id="+v+"&page_id="+ '0', //"page_id =0 " To find page for Quotation send  back button action. 
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}

function cost_view(v){
	 //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/BusinessProcess/quotation/cost_sheet_add.php?id="+v+"&page_id="+ '0', //"page_id =0 " To find page for cost sheet back button action. 
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}

function lead_view(v){
	 //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/CRM/proposal.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function back()
	{
		enquiry()
	}
	
    // $(document).ready(function() {
	// 	$('.dataTables-example').DataTable({
	// 			responsive: true
	// 	});
	// });
	
 function client_masterss(v){
	//  alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/CRM/client_insert.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
 function ctc_view(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/CRM/enquiry_view.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
  function enquiry_edit(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/CRM/enquiry_edit.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function add()
	{
		$.ajax({
		type:"POST",
		url:"qvision/CRM/enquiry_add.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
	

	
	function lead_view(v){
//alert(v)
	$.ajax({
	type:"POST",
	url:"qvision/CRM/proposal.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function view_enquiry_details(v)
{
		$.ajax({
		type:"POST",		
		url:"qvision/CRM/client_details_view.php?id="+v,
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
	function view_enquiry_appproval(v)
	{
		$.ajax({
		type:"POST",		
		url:"qvision/CRM/client_insert_approval.php?id="+v,
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
function editcussss(v)
{
	$.ajax({
		type:"POST",		
		url:"qvision/CRM/client_edit_view.php?id="+v,
		success:function(data){
		$("#main_content").html(data);
		}
		})
}
</script>
	<div  class="card card-primary">
              <div class="card-header" style="background-color:#ff8b3d !important;">
                <h3 class="card-title" style="float: left;"><font size="5">Customer LIST</font></h3>
		 
		
              </div>
			  <!--
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Enquiry List</font> </h3>
			<a onclick="add()" style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  New Enquiry</a>
		
              </div>-->
           
              <div class="card-body">
               		  
       <!-- <table id="dataTable" class="table table-bordered table-striped"> -->
	   <table class="table table-striped table-bordered table-hover display nowrap"  id="dataTable" style="width:100%">

      <thead>
	  <th>#</th>
      <th>Enquiry Code</th>
      <th>Client</th>
      <th>Contact_Name</th>
      <th>Contact Number</th>
      <th>Follow Up Date </th>
	  <th>Employee</th>
	  <th>Status </th>
	  <th style="width:16%" >Action</th>
      </thead>
      <tbody>
      <?php
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
echo $userrole;
	  if ($userrole=='R001' || $userrole=='R014'|| $userrole=='R007' || $userrole=='R004' || $userrole=='R006' || $userrole=='R010' ||  $userrole=='R008'){

      $datas=$con->query("SELECT enquiry_code,enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.flag as enquiry_flag ,enquiry.remark as enqqqremakr,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	   left JOIN calls_master ON enquiry.Call_type=calls_master.id
	  left join z_department_master ON enquiry.Department=z_department_master.id
	  left JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id where enquiry.status!=1 ORDER BY enquiry.id DESC");
	  
	   // echo "SELECT enquiry_code,enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.flag as enquiry_flag ,enquiry.remark as enqqqremakr,enquiry.Client_id as client,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	  //  left JOIN calls_master ON enquiry.Call_type=calls_master.id
	  // left join z_department_master ON enquiry.Department=z_department_master.id
	  // left JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id where enquiry.status!=1 ORDER BY enquiry.id DESC"; 
	 } 
	  else if($userrole=='R002' ||$userrole=='R003' ||  $userrole=='R008' || $userrole=='R009' ){
		 $datas=$con->query("SELECT enquiry_code,enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.flag as enquiry_flag,enquiry.remark as enqqqremakr,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	   left JOIN calls_master ON enquiry.Call_type=calls_master.id
	  left join z_department_master ON enquiry.Department=z_department_master.id
	  left JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id  where (enquiry.employee='$candidateid' or enquiry.created_by='$candidateid') and enquiry.status!=1 ORDER BY enquiry.id DESC");
	  
	  //  echo "SELECT enquiry_code,enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.flag as enquiry_flag,enquiry.remark as enqqqremakr,enquiry.client as client,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	  //  left JOIN calls_master ON enquiry.Call_type=calls_master.id
	  // left join z_department_master ON enquiry.Department=z_department_master.id
	  // left JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id  where (enquiry.employee='$candidateid' or enquiry.created_by='$candidateid') and enquiry.status!=1 ORDER BY enquiry.id DESC"; 
	 }else{

	 	$datas=$con->query("SELECT enquiry_code,enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.flag as enquiry_flag,enquiry.remark as enqqqremakr,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	   left JOIN calls_master ON enquiry.Call_type=calls_master.id
	  left join z_department_master ON enquiry.Department=z_department_master.id
	  left JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id  where (enquiry.employee='$candidateid' or enquiry.created_by='$candidateid') and enquiry.status!=1 ORDER BY enquiry.id DESC");



	 }
     $cnt=1;
      while($enquiry = $datas->fetch(PDO::FETCH_ASSOC))
	  {
		  if($enquiry['enquiry_code']!='')
		  {
			$enyurycode=$enquiry['enquiry_code'];
		  }
		  else
		  {
			$enyurycode="NULL";
		  }
		  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $enyurycode; ?></td>
      <td><?php echo $enquiry['Company_name']; ?></td>
      <td><?php echo $enquiry['it_name']; ?></td>
      <td><?php if($enquiry['Mobile'])echo $enquiry['Mobile']; else echo "NULL"; ?></td>
     <td><?php echo $enquiry['Follup']; ?></td>
	<td><?php echo $enquiry['first_name']; ?></td>
	<td><?php
	 $enquiry_flag=$enquiry['enquiry_flag'];
    $enquiry_status=$enquiry['enquiry_status'];
	$remark=$enquiry['enqqqremakr'];

if($enquiry['enquiry_status']==2 || $enquiry['enquiry_status']==20)
	{
		echo '<span style="color:green;text-align:center;"><b>New Client Details Added</b></span>';
		echo '<span style="color:red;text-align:center;"><b>/Waiting For New Client Approval </b></span>';
		
	}
	if($enquiry['enquiry_status']==25)
	{
		echo '<span style="color:red;text-align:center;"><b>New Client Rejected</b></span>';
		echo '<span style="color:red;text-align:center;"><b>'.$remark.'</b></span>';
		
	}
elseif($enquiry['enquiry_status']==3)
{

echo '<span style="color:green;text-align:center;"><b>New Client Approved</b></span>';
echo '<span style="color:red;text-align:center;"><b>/ And Waiting For Quote</b></span>';
}
elseif($enquiry['enquiry_status']==4)
	
{
	echo '<span style="color:green;text-align:center;"><b>Cost Sheet Added</b></span>';
echo '<span style="color:red;text-align:center;"><b> / Waiting For Quote Approval</b></span>';
}
elseif($enquiry['enquiry_status']==5)
	
{
echo '<span style="color:green;text-align:center;"><b>Cost Sheet Approved</b></span>';
echo '<span style="color:red;text-align:center;"><b>/ Waiting For Quote Generate</b></span>';
}
elseif($enquiry['enquiry_status']==6)
	
{
echo '<span style="color:green;text-align:center;"><b>Quote Generated</b></span>';
echo '<span style="color:red;text-align:center;"><b>/ Waiting For SOF Upload</b></span>';
}

elseif($enquiry['enquiry_status']==7)
	
{
echo '<span style="color:green;text-align:center;"><b>SOF Uploaded </b></span>';
echo '<span style="color:red;text-align:center;"><b>/ And Waiting For SOF Approval</b></span>';
}
elseif($enquiry['enquiry_status']==8)
	
{
echo '<span style="color:green;text-align:center;"><b>SOF Approved By Marketing Level-1</b></span>';
}
elseif($enquiry['enquiry_status']==9)
	
{
echo '<span style="color:green;text-align:center;"><b>SOF Approved By Marketing Level-2</b></span>';
}
elseif($enquiry['enquiry_status']==10)
	
{
echo '<span style="color:green;text-align:center;"><b>SOF Approved By Finance</b></span>';
echo '<span style="color:red;text-align:center;"><b>/ Waiting For Purchase</b></span>';
}
elseif($enquiry['enquiry_status']==11) // After PO Sent.
	
{
echo '<span style="color:green;text-align:center;"><b> Purchase Order Sent </b></span>';
}else{}
?>
</td>
	<td>				
		
		
			<?php
			$enq_value= $enquiry['enquiry_status'];
			
			
			if($enquiry['enquiry_status']==3)
			{?>
			
				<button class="btn btn-primary" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="cost_view(<?php echo $enquiry['enquiry_id']; ?>)">Add Quotation</button>
				<?php 
			}elseif($enquiry['enquiry_status']==5)
			{?>
				<button class="btn btn-primary" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="costz_view(<?php echo $enquiry['enquiry_id']; ?>)">Quote Send view</button>
				<?php 
			} elseif($enquiry['enquiry_status']==6)
			{?>
				<button class="btn btn-primary" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="costpo_view(<?php echo $enquiry['enquiry_id']; ?>)">SOF Upload List</button>
				<?php 
			}  
			
			 else if($enquiry['enquiry_status']==2)
			
			{
				?>
					<button class="btn btn-info" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="view_enquiry_details(<?php echo $enquiry['enquiry_id']; ?>)">view</i></button>
					<?php
			} 
			else if($enquiry['enquiry_status']==20 && $userrole=='R008'){
?>
					<button class="btn btn-info" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="view_enquiry_appproval(<?php echo $enquiry['enquiry_id']; ?>)">inititate</i></button>

<?php

			}
			else if($enquiry['enquiry_status']==25)
			
			{
			?>
		
					<button class="btn btn-info" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="editcussss(<?php echo $enquiry['enquiry_id']; ?>)">Edit</i></button>
					<?php
			} 
			?>
	</td>
      </tr>
      <?php
	  $cnt=$cnt+1;
      }
      ?>
      </tbody>
       </table>
				

              </div>
              <!-- /.card-body -->
            </div>
		
