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
                <h3 style="float: left;">QUOTE LIST</h3>
		  
		  <!--a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i> Back</a-->
		
              </div>
	
    <table id="example1" class="table table-bordered table-striped">
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
//$candidateid=$_SESSION['candidateid'];
//$userrole=$_SESSION['userrole'];
	
     $cnt=1;
	 if($count==1)
{
	$quote=$con->query("select * from po_generate where po_upload_status='1' order by id desc ");

      while($quote_list = $quote->fetch(PDO::FETCH_ASSOC))
	  {
		  
		$f_approved_id = $quote_list['finance_approved_by'];  
		$s_approved_id = $quote_list['service_approved_by'];
		 
		 $stmtf = $con->prepare("SELECT emp_name from staff_master where candid_id ='$f_approved_id' "); 	
		 //echo "SELECT emp_name from staff_master where candid_id ='$f_approved_id'";
		 $stmtf->execute(); 
		 $rowf = $stmtf->fetch();
		  $finance_emp_name = $rowf['emp_name'];
		 
		 $stmts = $con->prepare("SELECT emp_name from staff_master where candid_id ='$s_approved_id' "); 	
		 //echo "SELECT emp_name from staff_master where candid_id ='$approved_id'";
		 $stmts->execute(); 
		 $rows = $stmts->fetch();
		 $service_emp_name = $rows['emp_name'];
		  
		  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $quote_list['quote_no']; ?></td>
      <td><?php echo $quote_list['cost_sheet_no']; ?></td>	
      <td><?php echo $quote_list['so_number']; ?></td>	
<td><?php  $fstatus=$quote_list['service_status'];
//echo $fstatus;
//echo $finance_emp_name;
if($fstatus=='0'){ 
//echo $finance_emp_name; 
     echo '<span style="color:green;text-align:center;"><b> Finance Approved By </span>';?>
	<?php echo $finance_emp_name;  echo ' <span style="color:red;text-align:center;"><b> And Waiting For Service Approval  </span>';  
}	
else if($fstatus=='1')
{
	echo '<span style="color:green;text-align:center;"><b> Approved  <b/></span>';
}
else if($fstatus=='2'){
	echo '<span style="color:green;text-align:center;"><b> Rejected<b/></span>';
}

?></td>	  

	<td>
		<?php if($fstatus=='0'){ ?>
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
	url:"qvision/BusinessProcess/po_approval/service_po_approve.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function back_ctc()
	{
		service_po_approve()
	}
	
	$(function () 
	{
    $(document).ready(function() {
    $('#dataTable').DataTable( {
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
