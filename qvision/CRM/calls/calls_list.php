<?php
require '../../../connect.php';
include("../../../user.php");

$candidateid = $_SESSION['candidateid'];

$userrole = $_SESSION['userrole'];

 $user_id = $_SESSION['userid'];
 
$sel=$con->query("select a.department,b.head_status from z_user_master a left join staff_master b on (a.candidate_id=b.candid_id) where a.user_id='$user_id'");

$fet=$sel->fetch();
$head_status=$fet['head_status'];
if($head_status==1){
	$vel=$con->query("select a.department,a.user_group_code,b.head_status from z_user_master a left join staff_master b on (a.candidate_id=b.candid_id) where a.user_id='$user_id'");
	$vet=$vel->fetch();
	$user_group_code=$vet['user_group_code'];
	$department=$vet['department'];
	
	$del=$con->query("select user_group_code,department,user_id from z_user_master where department='$department' and user_group_code='$user_group_code'");

	$det=$del->fetch();
	$check_userid=$det['user_id'];
}else{
	$check_userid=990;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- Include DataTables JavaScript -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    
    <!-- Additional DataTables Extensions (if needed) -->
    <!-- Example: Buttons extension -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <!-- Include other required DataTables extensions as needed -->



	</head>
<body>
<div  class="card card-primary" style="margin-left:5% !important;">
    <div class="card-header" style="background-color: #ff8b3d !important;">
        <h3 class="card-title"><font size="5">Enquiry List</font></h3>
		<!-- <a onclick="call_upload()"  style="float: right;    background-color: #da542e;" data-toggle="modal" class="btn btn-default"><i class="fa fa-upload"></i> Upload</a>-->
		 
       <a onclick="add()" style="float: right;background:black;border:1px solid black;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i> ADD</a>

    </div>

    <div class="card-body">
<table id="example" class="display nowrap" style="width:100%">
        <thead>
           <tr>
                    <th>#</th>
                    <th> Date</th>
                    <th> Organisation</th>
                    <th> Client</th>
                   
                    <th> Feedback</th>
                    <th> Feedback Date</th>
                    <th> Followup Date</th>
                    <th>Created By</th>
                   
                  
					 <th>Status</th>
					 <th>Action</th>
				<!--	 <th>Edit</th>
					 <th>Delete</th>-->
                  </tr>
        </thead>
       <tbody>
               <?php
               
            //   echo $check_userid;
if($userrole == 'R001'){
	$sql=$con->query("SELECT a.id,a.client_org,a.created_by as created_by,a.created_on as created_on,a.client_name,b.feedback,b.feedback_date,b.date,a.status FROM `crm_calls` a left join `crm_calls_feedback` b on  (a.id=b.calls_id)order by a.id desc");
}elseif($user_id==$check_userid){

	$sql=$con->query("SELECT a.id,a.client_org,a.created_by as created_by,a.created_on as created_on,a.client_name,b.feedback,b.feedback_date,b.date,a.status,c.user_id,c.department FROM `crm_calls` a left join `crm_calls_feedback` b on  (a.id=b.calls_id) left join z_user_master c on (a.created_by=c.user_id) left join staff_master d on (c.candidate_id=d.candid_id) where c.department=$department order by a.id desc");

	
}else{
	$sql=$con->query("SELECT a.id,a.client_org,a.created_by as created_by,a.created_on as created_on,a.client_name,b.feedback,b.feedback_date,b.date,a.status FROM `crm_calls` a left join `crm_calls_feedback` b on  (a.id=b.calls_id) where (a.employee='$candidateid' or a.created_by='$user_id') group by a.id  order by a.id desc");
}

$cnt=1;
 while($products_master = $sql->fetch(PDO::FETCH_ASSOC))
{
	
?>
<tr>
<td><?php echo $cnt;?>.</td>
<td><?php echo $products_master['created_on'];?></td>
<td><?php echo $products_master['client_org'];?></td>
<td><?php echo $products_master['client_name'];?></td>
<td><?php echo $products_master['feedback'];?></td>
<td><?php echo $products_master['feedback_date'];?></td>
<td><?php echo $products_master['date'];?></td>
<td><?php  $created_by = $products_master['created_by'];
$cc = $con->query("select * from z_user_master where user_id='$created_by'");
$cc1 = $cc->fetch();
echo $cc1['full_name'];?></td>

<td>
	  <?php 
	  if($products_master['status'] ==1)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	  <?php }
	   elseif($products_master['status'] ==2)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	   <?php }
	   elseif($products_master['status'] ==3 || $products_master['status'] ==4)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	  <?php }else {
		  
		 echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';
		 ?>
<?php } ?>
	 
	  
     </td>
     
<td>

							<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $products_master['id']; ?>" onclick="calls_feedback(<?php echo $products_master['id']; ?>)"><i class="fa fa-edit"></i> Feedback</button>
</td>
    
<!--<td>

							<button class="btn btn-default btn-sm edit btn-flat" data-id="<?php echo $products_master['id']; ?>" onclick="calls_edit(<?php echo $products_master['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
</td>

<td>

							<button class="btn btn-danger btn-sm edit btn-flat" data-id="<?php echo $products_master['id']; ?>" onclick="calls_delete(<?php echo $products_master['id']; ?>)"><i class="fa fa-edit"></i> Delete</button>
</td>-->

</tr>
<?php 
$cnt=$cnt+1;
 }
?>
</tbody>
        
    </table>
  <script>
  $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           
            'excelHtml5'
           
            
        ]
    } );
} );

  </script>

 <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
  
<script>
 function call_upload(){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/CRM/calls/call_upload.php",
	 
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}


 function calls_edit(v){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/CRM/calls/calls_edit.php?id="+v,
	 
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}

   function calls_feedback(v){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/CRM/calls/calls_feedback.php?id="+v,
	 
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function back()
	
	{
 cutomer_enquiry()

	}
  
function add()
	{
		$.ajax({
		type:"POST",
		url:"qvision/CRM/calls/calls_add.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
	 function calls_delete(v){
		//alert(v);
		//alert("Are you confirm to Delete");
	$.ajax({
	type:"POST",
	url:"qvision/CRM/calls/calls_delete.php?id="+v,
	 
	success:function(data)
	{
		alert("Deleted Successfully");
		cutomer_enquiry()
	}
	})
}
</script>

</body>
</html>