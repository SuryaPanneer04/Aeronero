<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
 $user_id = $_SESSION['userid'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
	<style>
	.card-primary:not(.card-outline)>.card-header{
		background-color: #009EE3 !important;
	}
	</style>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title" style="float: left;"><font size="5">COST SHEET REVISE LIST</font></h3>

				  <a onclick=" back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>

		
              </div>
           

<!--
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
<div  class="card card-primary">
     <div class="card-header">
    <h2 class="card-title"><font size="5">COST SHEET REVISE LIST</font> </h2>
	</div>-->
    <div class="card-body">
     <!-- <table id="example1" class="table table-bordered table-striped"> -->
     <table class="table table-striped table-bordered table-hover display nowrap"  id="example1" style="width:100%">

      <thead>
	  <th>#</th>
	  <th>Cost sheet No </th>
      <th>Product / Service </th>
      <th>Quote Type</th>
	  <th>Company Name</th>
      <th>Employee Name</th>
	  <th>Status</th>
	  <th>Action</th>
      </thead>
      <tbody>
      
      <?php
// WHERE condition ah temporary ah thookiyachu & specific columns mattum edukuram
$datas=$con->query("SELECT a.id as costsheet_id, a.cost_sheet_no, a.business_id, a.quote_type, a.remark, a.status, a.flag, b.org_name, enq.Company_name as enquiry_company, e.emp_name 
    FROM cost_sheet_entry a 
    LEFT JOIN new_client_master b ON b.id = a.client_id 
    LEFT JOIN enquiry enq ON enq.id = a.enquiry_id 
    LEFT JOIN staff_master e ON e.candid_id = a.created_by 
    ORDER BY a.id DESC");

$cnt=1;
if($datas) { 
    while($data =$datas->fetch(PDO::FETCH_ASSOC)) 
    {
?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
	  <td><?php echo $data['cost_sheet_no']; ?></td>
      <td><?php
	  if($data['business_id'] =='1'){ echo "Product"; 
	  }elseif($data['business_id'] =='2'){ echo "Service";
	  }elseif($data['business_id'] =='3'){ echo "Solution";
	  }elseif($data['business_id'] =='4'){ echo "Software";
	  }
	  ?></td>
      <td><?php if($data['quote_type']=='1'){ echo "INR"; }else{ echo "Doller";}?></td>
      <td><?php 
          if(!empty($data['org_name'])) { 
              echo $data['org_name']; 
          } elseif(!empty($data['enquiry_company'])) { 
              echo $data['enquiry_company']; 
          } else {
              echo "-";
          }
      ?></td>
	  <td><?php echo $data['emp_name']; ?></td>
	  <td>
        <?php 
          if($data['flag'] == 1) {
              echo '<span style="color:orange;text-align:center;"><b>Inactive / Old</b></span>';
          } elseif($data['status'] == 0 || $data['status'] == 1) {
              echo '<span style="color:red;text-align:center;"><b>Waiting for Approval</b></span>';
          } elseif($data['status'] == 2) {
    echo '<span style="color:green;text-align:center;"><b>Cost Sheet Approved</b></span><br><span style="color:red;text-align:center;"><b>/ Waiting For Quote</b></span>';
} elseif($data['status'] == 3) {
    echo '<span style="color:green;text-align:center;"><b>Quote Generated</b></span><br><span style="color:red;text-align:center;"><b>/ Waiting To Send Quote</b></span>';
} elseif($data['status'] == 4) {
    echo '<span style="color:green;text-align:center;"><b>Quote Sent</b></span><br><span style="color:red;text-align:center;"><b>/ Waiting For SOF Upload</b></span>';
} elseif($data['status'] == 6) {
              echo '<span style="color:green;text-align:center;"><b>Quote Generated</b></span><br><span style="color:red;text-align:center;"><b>/ Waiting For SOF Upload</b></span>';
          } elseif($data['status'] == 7) { 
              echo '<span style="color:green;text-align:center;"><b>SOF Uploaded </b></span><br><span style="color:red;text-align:center;"><b>/ Waiting For SOF Approve Level 1</b></span>';
          } elseif($data['status'] == 8) { 
              echo '<span style="color:green;text-align:center;"><b>SOF Approved By Marketing Level-1 </b></span><br><span style="color:red;text-align:center;"><b>/ Waiting For SOF Approve Level 2</b></span>';
          } elseif($data['status'] == 9) { 
              echo '<span style="color:green;text-align:center;"><b>SOF Approved By Marketing Level-2 </b></span><br><span style="color:red;text-align:center;"><b>/ Waiting For Finance Approval</b></span>';
          } elseif($data['status'] == 10) { 
              echo '<span style="color:green;text-align:center;"><b>SOF Approved By Finance</b></span><br><span style="color:red;text-align:center;"><b>/ Waiting For Purchase</b></span>';
          } elseif($data['status'] == 11) {
              if($data['business_id'] == '4') { 
                  echo '<span style="color:red;text-align:center;"><b>Waiting for Employee Assign</b></span>';
              } else {
                  echo '<span style="color:green;text-align:center;"><b> Purchase Order Sent </b></span>';
              }
          } elseif($data['status'] >= 30) {
              // BUG FIX: Status 30 illana adhuku mela irundha Employee assigned nu kaatanum
              echo '<span style="color:green;text-align:center;"><b>Employee Assigned / Software Flow Created</b></span>';
          } else {
              echo '<span style="color:black;text-align:center;"><b>Status: '.$data['status'].'</b></span>'; 
          }
        ?>
      </td>
	  <td>  
	     <button class="btn btn-info" data-id="<?php echo $data['costsheet_id']; ?>" onclick="cost_sheet_view(<?php echo $data['costsheet_id']; ?>)">
	     <i class="fa fa-eye"></i></button>
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
    </div>
	</div>
	</div>
  </div>
</section>
</div>
<script>
$(document).ready(function() {
    $('#example1').DataTable( {
        "scrollX": true
    } );
} );
</script>
<script>
// $(function () {
//     $("#example1").DataTable({
//       "responsive": true,
//       "autoWidth": false,
//     });
//     $('#example2').DataTable({
//       "paging": true,
//       "lengthChange": false,
//       "searching": false,
//       "ordering": true,
//       "info": true,
//       "autoWidth": false,
//       "responsive": true,
//     });
//   });




function cost_sheet_view(v){
    //alert(v);
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/quotation/cost_sheet_revise.php",
        data: { id: v }, // BUG FIX: URL-la irunthu thookitu, data vazhiya anuprom
        success: function(data)
        {
            $("#main_content").html(data);
        }
    });
}
function back_ctc()
	{
		Quotation_approve()
	}
    </script>
