<?php
//purchase_vendor_master Status = 1 is  insert record compare or backtoback without approve.
//purchase_vendor_master Status = 2 is  finance Approve and backtoback directly sts=2 not go for approve.
//purchase_vendor_master Status = 3 is  After GRN Generate PVM close.
//purchase_vendor_master Status = 4 is  PO Send to vendor.
//purchase_vendor_master Status = 5 is  EDD date against PO.
//purchase_vendor_master Status = 6 is  Ship to and Terms are updated.
//purchase_vendor_master Status = 7 is  GRN Generated for all qty without pending && send to purchase upload.
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
?>
<div  class="card card-primary">
     <div class="card-header" style="background-color: #f1cc61 !important;">
	 <h1 class="card-title"><font size="5"><b>Vendor PO	List</b></font> </h1></div>
    <div class="card-body">
     <table id="example1" class="table table-bordered table-striped">
      <thead>
	  <th>SL.No</th>
	  <th>Vendor Name</th>
	  <th>Cost Sheet No </th>
	  <th>SO No</th>
	  <th>Status</th>
	  <th>Action</th>
      </thead>
      <tbody>
	
      <?php
		 $datas=$con->query( "select distinct a.id as vo_id,a.status as vo_status,a.vendor_id,a.specification,a.so_number,a.cost_sheet_id,a.finance_status,a.service_status,a.marketing_status, b.cost_sheet_no,b.id as cost_id,c.id as vendors_id,c.vendor_name from purchase_vendor_master a left join cost_sheet_entry b on (a.cost_sheet_id=b.id) left join doller_vendor_mastor c on (a.vendor_id=c.id)where a.status='2' || a.status='4' || a.status='5' || a.status='6' group by a.vendor_id order by a.id desc ");


	 /* echo "select distinct a.id as vo_id,a.status as vo_status,a.vendor_id,a.specification,a.so_number,a.cost_sheet_id,a.finance_status,
	a.service_status,a.marketing_status, b.cost_sheet_no,b.id as cost_id,c.id as vendors_id,c.vendor_name from purchase_vendor_master a left join cost_sheet_entry b on (a.cost_sheet_id=b.id) left join doller_vendor_mastor c on (a.vendor_id=c.id)where a.status='2' group by a.vendor_id"; */
	 
	    
     $cnt=1;
      while($data =$datas->fetch(PDO::FETCH_ASSOC))
	  {
	  ?>
      <tr>
		  <td><?php echo $cnt;?>.</td>
		  <td><?php echo $data['vendor_name']; ?></td>
		  <td><?php echo $data['cost_sheet_no']; ?></td>
		  <td><?php echo $data['so_number']; ?></td>
		  <td><?php if($data['vo_status']==2){
         	echo '<span style="color: red; text-align: center;"><b> Update Ship & Terms <b/></span>';

		  }else if($data['vo_status']==6){
			echo '<span style="color: red; text-align: center;"><b> PO to Send <b/></span>';

		 }else if($data['vo_status']==4){
			echo '<span style="color: green; text-align: center;"> <b> PO Sent Successfully/ </span style="color: red; text-align: center;"><span>Waiting for EDD Update </b> </span>';
		  }else if($data['vo_status']==5){
			echo '<span style="color: green; text-align: center;"><b> EDD Updated Successfully </b></span>';
		  }
		   ?></td>


		  <td> 
		  <?php 
		    // $so = $data['so_number'];
		    // $PVMID = $con->query("select id as idcnt from purchase_vendor_master where status='6' && so_number='$so'"); 
			// $pvm = $PVMID->fetch();
		    // $PVM_ID = $pvm['idcnt'];

		    // $shipTo = $con->query("select count(*) as cnt from ship_terms where pvm_id='$PVM_ID'"); 
		    // $ship = $shipTo->fetch();

		  if($data['vo_status']== 2){ ?> 
		  <button class="btn btn-success"  onclick="update_shipto_terms(<?php echo $data['cost_id']; ?>)">  Ship To and Terms</button>
		  <?php } if($data['vo_status']== 6){ ?>
			 <button class="btn btn-info" data-id="<?php echo $data['cost_id']; ?>" onclick="vendor_proposal_view(<?php echo $data['cost_id']; ?>)"> <i class="fa fa-eye"></i></button>
		<?php } if($data['vo_status']== 4){ ?>
			 <button class="btn btn-primary"  onclick="updateEDD(<?php echo $data['cost_id']; ?>)"> Update EDD</button>
	    <?php } ?>
		  </td>
      </tr>
      <?php
	  $cnt=$cnt+1;
	 }
      ?>
      </tbody>
      </table>
      </div>
</div>

<script>
$(function () {
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

function vendor_proposal_view(v) {
  $.ajax({
    type: "POST",
    url: "qvision/Purchase_process/vendor_po_generate/vendor_po_send_view.php?id=" + v,
    success: function(data) {
      $("#main_content").html(data);
    },
    error: function(xhr) {
      alert("Error " + xhr.status + ": " + xhr.statusText);
    }
  });
}


function updateEDD(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/Purchase_process/vendor_po_generate/update_edd.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}


function update_shipto_terms(v) {
  $.ajax({
    type: "POST",
    url: "qvision/Purchase_process/vendor_po_generate/update_shipto_terms.php?id=" + v,
    success: function(data) {
      $("#main_content").html(data);
    },
    error: function(xhr) {
      alert("Error " + xhr.status + ": " + xhr.statusText);
    }
  });
}

</script>
