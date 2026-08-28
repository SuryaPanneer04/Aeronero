<?php
//purchase_generate =  Initial status = 0,
//purchase_generate =  Request to finance Approve for invoice raising  status =1,
//purchase_generate =  finance Approve to invoice  status =2,
//purchase_generate =  finance Reject to invoice  status =3,

require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

?>
<div  class="card card-primary">
     <div class="card-header" style="background-color: #f1cc61 !important;">
	<h2 class="card-title"><font size="5"><b>Invoice Re- Request</b></font> </h2></div>
	<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
		  <th>SL.No</th>
		  <th>Cost Sheet Number</th>
		  <th>SO Number</th>
		  <th>Status</th>
		  <th>Action</th>
      </thead>
      <tbody>
      <?php
     $cnt=1;

	$quote=$con->query("select a.id as pur_invoice_id, b.id,b.cost_sheet_no,b.so_number,a.status from purchase_generate a left join purchase_vendor_master b on a.purchase_id = b.id  where a.status = 3 order by a.id desc");

      while($quote_list = $quote->fetch(PDO::FETCH_ASSOC))
	  {
  ?>

      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $quote_list['cost_sheet_no']; ?></td>      
      <td><?php echo $quote_list['so_number']; ?></td>	
      <td>  
      <?php
        if($quote_list['status'] == 0){
                        echo '<span style="color: red;text-align:center;"><b> Customization </b></span>'; //Data Inserted && send to customization.
                    }
                    else if($quote_list['status']==1){
                        echo '<span style="color: blue;text-align:center;"><b> Request to finance approve </b></span>'; //Request to finance approve.
                    }
                    else if($quote_list['status']==2){
                        echo '<span style="color: green;text-align:center;"><b> Approved </b></span>'; //finance approved.
                    }
                    else if($quote_list['status']==3){
                      echo '<span style="color: red;text-align:center;"><b> Rejected </b></span>'; //finance rejected.
                  }
                    ?>
		 
	</td>
	<td>  

	<button class="btn btn-info" onclick="invoice_apprequest(<?php echo $quote_list['id']; ?>,<?php echo $quote_list['pur_invoice_id'];?>)"><i class="fa fa-edit"></i></button>
	
		 
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


function invoice_apprequest(v,id)
{
	$.ajax({
	type:"POST",
    url:"qvision/Purchase_process/delivery_challan/invoiceRerequest.php?id="+v+ "&invoice="+id,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}

	
	$(function () 
	{
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
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
