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
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title" style="float: left;"><font size="5">QUOTE SEND LIST</font></h3>
		  
		<!--  <a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>-->
		      </div>
           
    <div class="card-body">
	<table class="table table-striped table-bordered table-hover display nowrap"  id="example1" style="width:100%">
      <thead>
	  <th>#</th>
	 
	  <th>Quote No </th>
      <th>Product/Service </th>
      <th>Quote Type</th> 
	  <th>Client Name</th>
      <th>Employee Name</th>
	  
      </thead>
      <tbody>
	
      <?php
	  
	  $client=$con->query("select distinct enquiry_id from cost_sheet_entry order by id desc");
	  $cnt=1;
	  while($cli=$client->fetch()){
		  $enquiry=$cli['enquiry_id'];
	  $roll_query =$con->prepare("SELECT code from z_role_master");
	$roll_query->execute(); 
	$row = $roll_query->fetch();
	if(($userrole !='R096')) {

		 $datas=$con->query("SELECT distinct a.enquiry_id,h.id as quote_id,a.id as costsheet_id,a.status as cs_status,a.cost_sheet_no as cs_no,a.candid_id as quote_approve_id,a.*,b.*,e.*,f.*,h.quote_no as hquote_no,h.* from cost_sheet_entry a 
		        left join new_client_master b on(a.client_id=b.id) 
		        left join product_services f on (a.business_id=f.id)
		        left join staff_master e ON (a.candid_id=e.candid_id)  
				left join quote_generate h on(a.cost_sheet_no=h.cost_sheet_no)
				where a.enquiry_id='$enquiry' and h.quote_no!='' group by a.enquiry_id");
				
				
	}else{
		
		$datas=$con->query("SELECT a.id as costsheet_id,a.status as cs_status,a.cost_sheet_no as cs_no,a.candid_id as quote_approve_id,a.*,b.*,e.*,f.*,h.quote_no as hquote_no,h.id as quote_id,h.* from cost_sheet_entry a 
		        left join new_client_master b on(a.client_id=b.id) 
		        left join product_services f on (a.business_id=f.id)
		        left join staff_master e ON (a.candid_id=e.candid_id)  
				left join quote_generate h on(a.cost_sheet_no=h.cost_sheet_no)
				where (a.status !='1' or   a.status !='2') and  h.quote_no!='' group by a.cost_sheet_no  order by a.id desc");
	}
		
     
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
		 
		  <td>
		  <select name="quote_no" id="quote_<?php echo $cnt; ?>" class="quote_no" style="height:35px;" class="quote_no">
			<option value="">---Select Quote Number---</option>
			<?php
			

			$datas1=$con->query("select q.id as quote_id,q.quote_no,c.enquiry_id from quote_generate q left join cost_sheet_entry c ON q.cost_sheet_id=c.id  where c.enquiry_id='$enquiry'");
				
				  while($data1 =$datas1->fetch(PDO::FETCH_ASSOC))
				{
			?>
			<option value="<?php echo $data1['quote_id']; ?>"><?php echo $data1['quote_no']; ?></option>
				<?php } ?>
		  </td>
		  <td><?php 
		  if($data['mapping_id'] =='1'){ echo "Product"; 
		  }elseif($data['mapping_id'] =='2'){ echo "Service";
		  }elseif($data['mapping_id'] =='3'){ echo "Solution";
		  }
		  ?></td>
		  <td><?php if($data['quote_type']=='1'){ echo "INR"; }else{ echo "Doller";}?></td>
		 
		  <td><?php echo $data['org_name']; ?></td>
		  <td><?php echo $data['emp_name']; ?></td>
		
		 
      </tr>
      <?php
	  
      //}
	 }
	 $cnt=$cnt+1;
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

 $(document).ready(function(){
	
    $("#example1").on('change','.quote_no',function(){
		var ids = $(this).val();
         /* var currentRow=$(this).closest("tr"); 
		var id=currentRow.find("td:eq(0)").html();
        var quote_id=currentRow.find("td:eq(1)").html();	 */	 
        
	
           jQuery.ajax({

      url: "qvision/BusinessProcess/quotation/quotation_select.php",
      type: "GET",
      data: {
        ids: ids
		
      },
     // dataType: "html",
      success: function(data) {
        $("#main_content").html(data);
      } 
    });         
   });
});   

/* function quotes_reviese(){
	var cnt='<?php echo $cnt; ?>';
	alert(cnt);
	/* $.ajax({
	type:"POST",
	url:"qvision/BusinessProcess/quotation/quotation_select.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	}) */
//} 
	

    </script>

