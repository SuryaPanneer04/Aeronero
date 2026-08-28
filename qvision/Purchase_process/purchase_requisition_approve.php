<?php
require '../../connect.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

$sql=$con->query("select * from purchase_requistion_entry where req_status='2' OR req_status='4'");
$count=$sql->rowcount();

?>
<div  class="card card-primary">
     <div class="card-header">
	<h2 class="card-title"><font size="5"><b>Requistion Status</b></font> </h2></div>
	<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
		  <th>#</th>
		<!--  <th>Cost Sheet Number</th> -->
		  <th>Product</th>
		  <th>Quantity</th>
		  <th>Purchase Status</th>
		  <th>Action</th>
      </thead>
      <tbody>
      <?php
//$candidateid=$_SESSION['candidateid'];
//$userrole=$_SESSION['userrole'];
	
     $cnt=1;

//echo "select * from quote_generate where po_upload_status='1' ";
      while($quote_list = $sql->fetch(PDO::FETCH_ASSOC))
	  {
		  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
   <!--   <td><?php echo $quote_list['cost_sheet_nos']; ?></td>	  	-->
      <td><?php echo $quote_list['product_name']; ?></td>	
	  <td><?php echo $quote_list['quantity']; ?></td>	
<td><?php  $fstatus=$quote_list['req_status'];
if($fstatus=='2')
{
    // Fix: Changed <b/> to </b>
	echo '<span style="color:green;text-align:center;"><b> Waiting For Purchase Approval </b></span>';
}
elseif($fstatus=='4')
{
    // Fix: Changed <b/> to </b>
	echo '<span style="color:green;text-align:center;"><b> Purchase Approved </b></span>';
}
?></td>	  

	<td>  

	<button class="btn btn-info" data-id="<?php echo $quote_list['id']; ?>" onclick="purchase_status_view(<?php echo $quote_list['id']; ?>)"><i class="fa fa-eye"></i></button>
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
function purchase_status_view(v)
{
    // Validate ID silently
    if(!v || v === 0) {
        console.warn("Validation Error: Invalid or missing Requisition ID.");
        return; 
    }

    $.ajax({
        type: "POST",
        // --- RELATIVE PATH FIX: Removed /bbvision/ or /qvision/ from the start ---
        url: "qvision/Purchase_process/purchase_status_view.php?id=" + v,
        success: function(data)
        {
            $("#main_content").html(data);
        },
        error: function(xhr, status, error) {
            console.error("AJAX Request Failed: " + status + " - " + error);
            console.error("Requested URL: " + this.url);
            alert("Error 404: Unable to load the requested page. Please verify the file path or contact the administrator.");
        }
    });
}

function back_ctc()
{
    lead();
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