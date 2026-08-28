<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
if(($userrole =='R008')||($userrole =='R005')||($userrole =='R004')) {
	
	$enq_id=$_REQUEST['id'];
}else{
	
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
<div class="wage_content">
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title" style="float: left;"><font size="5">COST SHEET LIST</font></h3>
			  <!-- <a onclick=" back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a> -->
              </div>
			  <br>
	<table class="table table-striped table-bordered table-hover display nowrap"  id="example1" style="width:100%">
      <thead>
		  <th>Sl.no.</th>
		  <th>Call</th>
		  <th>Date</th>
		  <th>Client</th>
		  <th>Contact Name</th>
		  <!--<th>Location</th>
		  <th>Contact Number</th>
		  <th>Mail Id</th>
		  <th>Feedback</th>-->
		  <th>Follow UP Date </th>
		  <!--<th>Assign Company</th>-->
		  <th>Department</th>
		  <th>Account Manager</th>
		  <th>Status</th>
		  <th>Action</th>
      </thead>
      <tbody>
      <?php
	  $candidateid=$_SESSION['candidateid'];

// $roll_query =$con->prepare("SELECT code from z_role_master where");
// $roll_query->execute(); 
// $row = $roll_query->fetch();

	if(($userrole=='R008')||($userrole =='R005')||($userrole =='R004')) {
		  $datas=$con->query("SELECT enquiry.id as enquiry_id,enquiry.it_name as client_name,enquiry.status as enquiry_status,enquiry.approved_by as approved_by,enquiry.mail as enquiry_mailid,enquiry.created_by as enquiry_created,enquiry.*,calls_master.*,z_department_master.*,staff_master.* FROM `enquiry`
		   left JOIN calls_master ON (enquiry.Call_type=calls_master.id)
		   left join z_department_master ON (enquiry.Department=z_department_master.id)
		   left JOIN staff_master ON (enquiry.employee=staff_master.candid_id) 
		   where (enquiry.status='3' OR enquiry.status='4' OR enquiry.status='5' OR enquiry.status='6' OR enquiry.status='7' OR enquiry.status='8' OR enquiry.status='9' OR enquiry.status='10' OR enquiry.status='11') and enquiry.created_by='$candidateid' and enquiry.id='$enq_id' order by enquiry.id desc");
		   
	}else{
		
		$datas=$con->query("SELECT enquiry.id as enquiry_id,enquiry.it_name as client_name,enquiry.status as enquiry_status,enquiry.approved_by as approved_by,enquiry.mail as enquiry_mailid,enquiry.created_by as enquiry_created,enquiry.*,calls_master.*,z_department_master.*,staff_master.* FROM `enquiry`
		   left JOIN calls_master ON (enquiry.Call_type=calls_master.id)
		   left join z_department_master ON (enquiry.Department=z_department_master.id)
		   left JOIN staff_master ON (enquiry.employee=staff_master.candid_id)  
		   where (enquiry.status='3' OR enquiry.status='4' OR enquiry.status='5' OR enquiry.status='6' OR enquiry.status='7' OR enquiry.status='8' OR enquiry.status='9' OR enquiry.status='10' OR enquiry.status='11') order by enquiry.id desc");
	}
		    /* echo "SELECT enquiry.id as enquiry_id,enquiry.client as client_name,enquiry.status as enquiry_status,enquiry.approved_by as approved_by,enquiry.mail as enquiry_mailid,enquiry.created_by as enquiry_created,enquiry.*,calls_master.*,z_department_master.*,staff_master.* FROM `enquiry`
		   left JOIN calls_master ON (enquiry.Call_type=calls_master.id)
		   left join z_department_master ON (enquiry.Department=z_department_master.id)
		   left JOIN staff_master ON (enquiry.employee=staff_master.id)  
		   where (enquiry.status='3' OR enquiry.status='4' OR enquiry.status='5' OR enquiry.status='6' OR enquiry.status='7' OR enquiry.status='8' OR enquiry.status='9' OR enquiry.status='10' OR enquiry.status='11') and enquiry.created_by='$candidateid' order by enquiry.id DESC";  */
		   
		   /* echo "SELECT enquiry.id as enquiry_id,enquiry.client as client_name,enquiry.status as enquiry_status,enquiry.approved_by as approved_by,enquiry.mail as enquiry_mailid,enquiry.created_by as enquiry_created,enquiry.*,calls_master.*,z_department_master.*,staff_master.* FROM `enquiry`
		   left JOIN calls_master ON (enquiry.Call_type=calls_master.id)
		   left join z_department_master ON (enquiry.Department=z_department_master.id)
		   left JOIN staff_master ON (enquiry.employee=staff_master.id)  
		   where (enquiry.status='3' OR enquiry.status='4' OR enquiry.status='5' OR enquiry.status='6' OR enquiry.status='7' OR enquiry.status='8' OR enquiry.status='9' OR enquiry.status='10' OR enquiry.status='11') and enquiry.created_by='$candidateid'"; */
		   
		  /*  echo "SELECT enquiry.id as enquiry_id,enquiry.client as client_name,enquiry.status as enquiry_status,enquiry.approved_by as approved_by,enquiry.created_by as enquiry_created,enquiry.*,calls_master.*,z_department_master.*,staff_master.* FROM `enquiry`
		   INNER JOIN calls_master ON enquiry.Call_type=calls_master.id
		   INNER join z_department_master ON enquiry.Department=z_department_master.id
		   INNER JOIN staff_master ON enquiry.employee=staff_master.id  
		   where enquiry.status='3' OR enquiry.status='4' OR enquiry.status='5' OR enquiry.status='6' OR enquiry.status='7' 
		   OR enquiry.status='8' OR enquiry.status='9' OR enquiry.status='10'  OR enquiry.status='11' order by enquiry.id desc"; */
		
     $cnt=1;
      while($enquiry = $datas->fetch(PDO::FETCH_ASSOC))
	  { 
		 $approved_id = $enquiry['approved_by'];
		 
		 $stmt = $con->prepare("SELECT emp_name from staff_master where candid_id ='$approved_id' "); 	
		 //echo "SELECT emp_name from staff_master where candid_id ='$approved_id'";
		 $stmt->execute(); 
		 $row = $stmt->fetch();
		 $emp_name = ($row) ? $row['emp_name'] : '';
		 //echo $emp_name;
	  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $enquiry['name']; ?></td>
      <td><?php echo $enquiry['date']; ?></td>
      <td><?php echo $enquiry['Company_name']; ?></td>
	  <td><?php echo $enquiry['client_name']; ?></td>
      <!--<td><?php echo $enquiry['Location']; ?></td>
      <td><?php echo $enquiry['Mobile']; ?></td>
      <td><?php echo $enquiry['enquiry_mailid']; ?></td>
      <td><?php echo $enquiry['Feedback']; ?></td>-->
	  <td><?php echo $enquiry['Follup']; ?></td>
	  
	   <td><?php echo $enquiry['dept_name']; ?></td>
	   <td><?php echo $enquiry['emp_name']; ?></td>
	   <td><?php 
	   if($enquiry['enquiry_status']==3){ 
	               echo '<span style="color:green;text-align:center;"><b>Enquiry Added & </b></span>';  
	               echo '<span style="color:red;text-align:center;"><b>Waiting for Cost Sheet</b></span>'; 
				}else if($enquiry['enquiry_status']==4){ 
				   echo '<span style="color:green;text-align:center;"><b>Cost Sheet Generated & </b></span>'; 
				   echo '<span style="color:red;text-align:center;"><b>Waiting For Quote Generate</b></span>'; 
				}else if($enquiry['enquiry_status']==5){ 
				   echo '<span style="color:green;text-align:center;"><b>Quote Generated By </b></span>';?>
				<?php echo $emp_name; echo '<span style="color:red;text-align:center;"><b>"And Waiting for Quote Send"</b></span>'; ?> 
				<?php }
				else if($enquiry['enquiry_status']==15){ 
				   echo '<span style="color:green;text-align:center;"><b>Quote Generated By </b></span>';?>
				<?php echo $emp_name; echo '<span style="color:red;text-align:center;"><b>"And Waiting for MD Approval"</b></span>'; ?> 
				<?php }
				
				else if($enquiry['enquiry_status']==6){ ?>
				<?php echo '<span style="color:green;text-align:center;"><b>Quote Sended & </b></span>';   
				 echo '<span style="color:red;text-align:center;"><b> Waiting for PO Upload</b></span>';  
				}else if($enquiry['enquiry_status']==7){ 
				
				 echo '<span style="color:green;text-align:center;"><b>PO Uploaded</b></span>'; 
				/* $enquiry_id=$enquiry['enquiry_id'];
				$stmtq = $con->prepare("SELECT cost_sheet_no,enquiry_id from cost_sheet_entry where enquiry_id ='$enquiry_id' "); 	
				 $stmtq->execute(); 
				 $rowq = $stmtq->fetch();
				 $cs_no = ($rowq) ? $rowq['cost_sheet_no'] : '';
				 $stmtp = $con->prepare("SELECT * from po_generate where cost_sheet_no ='$cs_no'"); 	
				 $stmtp->execute(); 
				 $rowp = $stmtp->fetch();
				 $marketing_status = ($rowp) ? $rowp['marketing_status'] : '';
				 $marketing_approved_by = ($rowp) ? $rowp['marketing_approved_by'] : '';
				 $stmtv = $con->prepare("SELECT * from z_user_master where candidate_id ='$marketing_approved_by'"); 	
				 $stmtv->execute(); 
				 $rowv = $stmtv->fetch();
				 $marketing_mem = ($rowv) ? $rowv['full_name'] : '';
				 if($enquiry['enquiry_status']==7 && $marketing_status==0){
					 echo '<span style="color:green;text-align:center;"><b>PO Uploded & </b></span>'; 
					  echo '<span style="color:red;text-align:center;"><b> Waiting For Marketing Level 1 Approval</b></span>';
				 } elseif($enquiry['enquiry_status']==7 && $marketing_status==2){
					 echo '<span style="color:red;text-align:center;"><b>PO Rejected By </b></span>'; 
					 echo $marketing_mem; 
				 } */
				 }
				 else if($enquiry['enquiry_status']==8){  
				 $enquiry_id=$enquiry['enquiry_id'];
				 $stmtq = $con->prepare("SELECT cost_sheet_no,enquiry_id from cost_sheet_entry where enquiry_id ='$enquiry_id' "); 	
				 $stmtq->execute(); 
				 $rowq = $stmtq->fetch();
				 $cs_no = ($rowq) ? $rowq['cost_sheet_no'] : '';
				 $stmtp = $con->prepare("SELECT * from po_generate where cost_sheet_no ='$cs_no'"); 	
				 $stmtp->execute(); 
				 $rowp = $stmtp->fetch();
				 $marketing_status = ($rowp) ? $rowp['md_status'] : '';
				 $marketing_approved_by = ($rowp) ? $rowp['md_approved_by'] : '';
				 $stmtv = $con->prepare("SELECT * from z_user_master where candidate_id ='$marketing_approved_by'"); 	
				 $stmtv->execute(); 
				 $rowv = $stmtv->fetch();
				 $marketing_mem = ($rowv) ? $rowv['full_name'] : '';
				 if($enquiry['enquiry_status']==8 && $marketing_status==0){
					 echo '<span style="color:green;text-align:center;"><b>Marketing Level 1 Approved</b></span>'; 
					  echo '<span style="color:red;text-align:center;"><b> Waiting For Marketing Level 2 Approval</b></span>';
				 } elseif($enquiry['enquiry_status']==8 && $marketing_status==2){
					 echo '<span style="color:red;text-align:center;"><b>PO Rejected By </b></span>'; 
					 echo $marketing_mem; ;
				 }	
				}else if($enquiry['enquiry_status']==9){  
				  $enquiry_id=$enquiry['enquiry_id'];
				 $stmtq = $con->prepare("SELECT cost_sheet_no,enquiry_id from cost_sheet_entry where enquiry_id ='$enquiry_id' "); 	
				 $stmtq->execute(); 
				 $rowq = $stmtq->fetch();
				 $cs_no = ($rowq) ? $rowq['cost_sheet_no'] : '';
				 $stmtp = $con->prepare("SELECT * from po_generate where cost_sheet_no ='$cs_no'"); 	
				 $stmtp->execute(); 
				 $rowp = $stmtp->fetch();
				 $marketing_status = ($rowp) ? $rowp['finance_status'] : '';
				 $marketing_approved_by = ($rowp) ? $rowp['finance_approved_by'] : '';
				 $stmtv = $con->prepare("SELECT * from z_user_master where candidate_id ='$marketing_approved_by'"); 	
				 $stmtv->execute(); 
				 $rowv = $stmtv->fetch();
				 $marketing_mem = ($rowv) ? $rowv['full_name'] : '';
				 if($enquiry['enquiry_status']==9 && $marketing_status==0){
					 echo '<span style="color:green;text-align:center;"><b>Marketing Level 2 Approved</b></span>'; 
					  echo '<span style="color:red;text-align:center;"><b> Waiting For Finance Approval</b></span>';
				 } elseif($enquiry['enquiry_status']==9 && $marketing_status==2){
					 echo '<span style="color:red;text-align:center;"><b>PO Rejected By </b></span>'; 
					 echo$marketing_mem;
				 }		  
				}	
				else if($enquiry['enquiry_status']==10){ 
				$enquiry_id=$enquiry['enquiry_id'];
				 $stmtq = $con->prepare("SELECT cost_sheet_no,enquiry_id from cost_sheet_entry where enquiry_id ='$enquiry_id' "); 	
				 $stmtq->execute(); 
				 $rowq = $stmtq->fetch();
				 $cs_no = ($rowq) ? $rowq['cost_sheet_no'] : '';
				 $stmtp = $con->prepare("SELECT * from po_generate where cost_sheet_no ='$cs_no'"); 	
				 $stmtp->execute(); 
				 $rowp = $stmtp->fetch();
				 $marketing_status = ($rowp) ? $rowp['finance_status'] : '';
				 if($enquiry['enquiry_status']==10 && $marketing_status==2){
					 echo '<span style="color:red;text-align:center;"><b>PO Rejected By Finance</b></span>'; 
				 } elseif($enquiry['enquiry_status']==9 && $marketing_status==1){
					 echo '<span style="color:green;text-align:center;"><b>PO Approved By Finance</b></span>'; 
					 echo '<span style="color:red;text-align:center;"><b>Waiting For Purchase</b></span>'; 
				 }	
				}
				else if($enquiry['enquiry_status']==11){  ?>
				  <?php echo '<span style="color:green;text-align:center;"><b>Marketing Level 2 Rejected</b></span>';
				}	
				 else if($enquiry['enquiry_status']==12){  ?>
				 <?php echo '<span style="color:green;text-align:center;"><b>Finance Approved & </b></span>'; 
				  echo '<span style="color:red;text-align:center;"><b>Waiting for Purchase</b></span>'; 
                  }else if($enquiry['enquiry_status']==13){  ?>
				 <?php echo '<span style="color:green;text-align:center;"><b>Finance Rejected</b></span>';  
                  }/* else if($enquiry['enquiry_status']==9){  ?>
				 <?php echo '<span style="color:green;text-align:center;"><b>Service Approved & </b></span>'; 
				  echo '<span style="color:red;text-align:center;"><b>Waiting for Purchase</b></span>';  
				}*/				
			?>
	   </td>
	   <td>  
	<?php
	if($enquiry['enquiry_status']==3){ ?>
	<button class="btn btn-info" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="costsheet_view(<?php echo $enquiry['enquiry_id']; ?>)"><i class="fa fa-eye"></i></button>
	<?php }elseif($enquiry['enquiry_status']==4 )
	{ ?>
		 <?php
		$enquiry_id= $enquiry['enquiry_id'];
$stmt_enq = $con->prepare("SELECT id,enquiry_id from cost_sheet_entry where enquiry_id='$enquiry_id' "); 
		/* echo"SELECT id,enquiry_id from cost_sheet_entry where enquiry_id='$enquiry_id' "; */ 
$stmt_enq->execute(); 
$row_enq = $stmt_enq->fetch();
$costsheet_id = ($row_enq) ? $row_enq['id'] : '';

	 $stmt = $con->prepare("SELECT a.id as costsheet_id,a.*,b.*,e.*,f.*,g.*,b.org_name as company_name,a.status as costsheet_status from cost_sheet_entry a 
		 left join new_client_master b on(b.id=a.client_id) 
		 left join product_services f on (f.id = a.business_id)
		 left JOIN staff_master e ON e.candid_id=a.candid_id 
		 left join z_user_master g ON (g.candidate_id = e.id)
		 where a.id='$costsheet_id' "); 
		/* echo "SELECT a.id as costsheet_id,a.*,b.*,e.*,f.*,g.*,b.org_name as company_name,a.status as costsheet_status from cost_sheet_entry a 
		 left join new_client_master b on(b.id=a.client_id) 
		 left join product_services f on (f.id = a.business_id)
		left JOIN staff_master e ON e.candid_id=a.candid_id 
		left join z_user_master g ON (g.candidate_id = e.id)
		where a.id='$costsheet_id' "; 
		 */
$stmt->execute(); 
$row = $stmt->fetch();
?>
<input type="hidden" class="form-control" id="enquiry_id" name="enquiry_id" value="<?php echo $row['enquiry_id']; ?>" readonly>
			   <input type="hidden" class="form-control" id="cost_sheet_no" name="cost_sheet_no" value="<?php echo $row['cost_sheet_no']; ?>" readonly>
			   <input type="hidden" class="form-control" id="costsheet_id" name="costsheet_id" value="<?php echo $row['costsheet_id']; ?>" readonly>
			   <input type="hidden" class="form-control" id="old_quote_no" name="old_quote_no" value="<?php echo $row['old_quote_no']; ?>" readonly>
			   <input type="hidden" class="form-control" id="business_id" name="business_id" value="<?php echo $row['business_id']; ?>" readonly>
			   <input type="hidden" class="form-control" id="mapping_id" name="mapping_id" value="<?php echo $row['mapping_id']; ?>" readonly>

	<button class="btn btn-success" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="quote_gen('<?php echo $row['cost_sheet_no']; ?>', '<?php echo $row['enquiry_id']; ?>', '<?php echo $row['costsheet_id']; ?>', '<?php echo $row['old_quote_no']; ?>', '<?php echo $row['business_id']; ?>')">Generate Quote</button>
	
	<?php }else{  	} ?>
	</td>
	
      </tr>
      <?php
	  $cnt=$cnt+1;
      }
	//}
      ?>
      </tbody>
      </table>
     </div>


     </div>
	 <script>
function quote_gen(id, enquiry_id, costsheet_id, old_quote_no, business_id)
{
	
	/*var id    = document.getElementById("cost_sheet_no").value;
	var enquiry_id  = document.getElementById("enquiry_id").value;
	var costsheet_id  = document.getElementById("costsheet_id").value;
	var old_quote_no  = document.getElementById("old_quote_no").value;
	var business_id  = document.getElementById("business_id").value;*/

   $('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');
	$.ajax({
	type:'GET',
	data:"id="+id+'&costsheet_id='+costsheet_id+'&old_quote_no='+old_quote_no+'&enquiry_id='+enquiry_id+'&business_id='+business_id,
	url:"qvision/BusinessProcess/quotation/costsheetz_approve_update.php",
	success:function(data)
	{      
		alert("Quote Generated Successfully");
		    Cost_sheet()
				  
	}       
	});
}
 </script>
 
	  <script>
$(document).ready(function() {
    $('#dataTable').DataTable( {
         "scrollY": 500,
        "scrollX": true
    } );
} );
</script>
<script>
// $('table').DataTable();

function costsheet_view(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/BusinessProcess/quotation/cost_sheet_add.php?id="+v +"&&page_id="+ '1',
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function back_ctc()
	{
		enquiry()
	}
	
 	$(function () {
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
 
