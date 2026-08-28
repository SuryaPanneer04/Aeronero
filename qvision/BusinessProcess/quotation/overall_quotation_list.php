<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
	$userrole=$_SESSION['userrole'];
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
                <h3 class="card-title" style="float: left;"><font size="5">QUOTE SEND LIST</font></h3>
		  
		<!--  <a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>-->
		      </div>
           
    <div class="card-body">
	<table class="table table-striped table-bordered table-hover display nowrap"  id="example1" style="width:100%">
      <thead>
	  <th>#</th>
	  <th>Cost Sheet No </th>
	  <th>Quote No </th>
      <th>Product/Service </th>
      <th>Quote Type</th> 
	  <th>Client Name</th>
      <th>Employee Name</th>
	  <th>Action</th>
      </thead>
      <tbody>
	
      <?php
	  $roll_query =$con->prepare("SELECT code from z_role_master ");
$roll_query->execute(); 
$row = $roll_query->fetch();
	if(($userrole !='R096')) {

		 $datas=$con->query("SELECT a.id as costsheet_id,a.status as cs_status,a.cost_sheet_no as cs_no,a.candid_id as quote_approve_id,a.enquiry_id as test,a.*,b.*,e.*,f.*,h.quote_no as hquote_no,h.* from cost_sheet_entry a 
		        left join new_client_master b on(a.client_id=b.id) 
		        left join product_services f on (a.business_id=f.id)
		        left join staff_master e ON (a.candid_id=e.candid_id)  
				left join quote_generate h on(a.cost_sheet_no=h.cost_sheet_no)
				where a.status !='1' and a.status !='2' and  h.quote_no!='' group by a.cost_sheet_no  order by a.id desc");
				 /* echo "SELECT a.id as costsheet_id,a.status as cs_status,a.cost_sheet_no as cs_no,a.candid_id as quote_approve_id,a.*,b.*,e.*,f.*,h.quote_no as hquote_no,h.* from cost_sheet_entry a 
		        left join new_client_master b on(a.client_id=b.id) 
		        left join product_services f on (a.business_id=f.id)
		        left join staff_master e ON (a.candid_id=e.candid_id)  
				left join quote_generate h on(a.cost_sheet_no=h.cost_sheet_no)
				where a.status !='1' and a.status !='2' and  h.quote_no!='' group by a.cost_sheet_no  order by a.id desc";  */
				
	}else{
		
		$datas=$con->query("SELECT a.id as costsheet_id,a.status as cs_status,a.cost_sheet_no as cs_no,a.candid_id as quote_approve_id,a.*,b.*,e.*,f.*,h.quote_no as hquote_no,h.* from cost_sheet_entry a 
		        left join new_client_master b on(a.client_id=b.id) 
		        left join product_services f on (a.business_id=f.id)
		        left join staff_master e ON (a.candid_id=e.candid_id)  
				left join quote_generate h on(a.cost_sheet_no=h.cost_sheet_no)
				where (a.status !='1' or   a.status !='2') and  h.quote_no!='' group by a.cost_sheet_no  order by a.id desc");
	}
		/*  echo "SELECT a.id as costsheet_id,a.status as cs_status,a.cost_sheet_no as cs_no,a.candid_id as quote_approve_id,a.*,b.*,e.*,f.*,h.quote_no as hquote_no,h.* from cost_sheet_entry a 
		        left join new_client_master b on(a.client_id=b.id) 
		        left join product_services f on (a.business_id=f.id)
		        left join staff_master e ON (a.candid_id=e.candid_id)  
				left join quote_generate h on(a.cost_sheet_no=h.cost_sheet_no)
				where a.status ='2' and a.created_by='$candidateid' and h.quote_no!='' group by a.cost_sheet_no  order by a.id desc"; */
	    
		/* echo "SELECT a.id as costsheet_id,a.status as cs_status,a.*,b.*,e.*,f.*,h.* from cost_sheet_entry a 
		        inner join new_client_master b on(b.id = a.client_id) 
		        inner join product_services f on (f.id = a.business_id)
		        inner join staff_master e ON e.candid_id=a.candid_id  
				inner join quote_generate h on(h.cost_sheet_no=a.cost_sheet_no)
				where a.status ='2' and a.created_by='$candidateid' group by a.cost_sheet_no  order by a.id desc"; */
     $cnt=1;
      while($data =$datas->fetch(PDO::FETCH_ASSOC))
	  {
		  
		   $approved_id = $data['quote_approve_id'];
		 
		 $stmt = $con->prepare("SELECT emp_name from staff_master where candid_id ='$approved_id' "); 	
		 //echo "SELECT emp_name from staff_master where candid_id ='$approved_id'";
		 $stmt->execute(); 
		 $row = $stmt->fetch();
		 $emp_name = $row['emp_name'];
	  ?>
      <tr>
		  <td><?php echo $cnt;?>.</td>
		  <td><?php echo $data['cs_no']; ?></td>
		  <td><?php echo $data['hquote_no']; ?></td>
		  <td><?php 
		  if($data['mapping_id'] =='1'){ echo "Product"; 
		  }elseif($data['mapping_id'] =='2'){ echo "Service";
		  }elseif($data['mapping_id'] =='3'){ echo "Solution";
		  }
		  ?></td>
		  <td><?php if($data['quote_type']=='1'){ echo "INR"; }else{ echo "Doller";}?></td>
		 
		  <td><?php echo $data['org_name']; ?></td>
		  <td><?php echo $data['emp_name']; ?></td>

		  <td>  
		  <?php
		  $edit_status=$data['edit_status'];
		  $cs_status=$data['cs_status'];
		  if($edit_status==0){
			  if($cs_status!=2 && $cs_status!=4 && $cs_status!=7 && $cs_status!=8 && $cs_status!=9 && $cs_status!=10 && $cs_status!=11 && $cs_status!=12 && $cs_status!=12){
		  ?>
			
			  <button class="btn btn-info" data-id="<?php echo $data['costsheet_id']; ?>" onclick="quotes_reviese(<?php echo $data['test']; ?>)">
			Edit</button>
		  <?php
		  }
		  }else{
		  }
		  ?>
		  </td>
      </tr>
      <?php
	  $cnt=$cnt+1;
      //}
	 }
      ?>
      </tbody>
      </table>
      </div>
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

 $(function () {
    $("#dataTable").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
     $('#dataTable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
       "ordering": true,
       "info": true,
      "autoWidth": false,
      "responsive": true,
     });
   });




function quotes_send_view(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/BusinessProcess/quotation/overall_quotation_view.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function back_ctc()
	{
		Quotation_view()
	}
	
function quotes_reviese(v){
	//alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/BusinessProcess/quotation/quotation_revise_edit.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
    </script>

