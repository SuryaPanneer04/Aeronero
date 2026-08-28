<?php
require '../../connect.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

$sql=$con->query("select * from purchase_requistion_entry ");
$count=$sql->rowcount();

?>
<div class="card card-primary">
     <div class="card-header">
	<h2 class="card-title"><font size="5"><b>Requistion Status</b></font> </h2>
	<a onclick="return add_requisiton()"  style="float: right;" data-toggle="modal" class="btn btn-dark">ADD</a>
	</div>
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
if($fstatus=='1')
{
	echo '<span style="color:green;text-align:center;"><b> Waiting For Finance Approval <b/></span>';
}
elseif($fstatus=='2')
{
	echo '<span style="color:green;text-align:center;"><b> Finance Approved <b/></span>';
}
elseif($fstatus=='3')
{
	echo '<span style="color:red;text-align:center;"><b> Finance Rejected <b/></span>';
}
elseif($fstatus=='4')
{
	echo '<span style="color:green;text-align:center;"><b> Purchase Approved <b/></span>';
}
?></td>	  

	<td>  

	<button class="btn btn-info" data-id="<?php echo $quote_list['id']; ?>" onclick="requisition_status_view(<?php echo $quote_list['id']; ?>)"><i class="fa fa-eye"></i></button>
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
function add_requisiton() {
  $.ajax({
    type: "POST",
    url: "qvision/Purchase_process/purchase_requisition.php",
    success: function(data) {
      $("#main_content").html(data);
    },
    error: function(xhr) {
      alert("Error " + xhr.status + ": " + xhr.statusText);
    }
  });
}

function requisition_status_view(v)
{
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/Purchase_process/requisition_status_view.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	});
}
function back_ctc()
	{
		lead()
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
