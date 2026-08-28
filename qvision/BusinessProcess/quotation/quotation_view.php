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
<div  class="card card-primary">
              <div class="card-header">
                <h3 style="float: left;">QUOTATION/PROPOSAL APPROVAL</h3>
		  		  <a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>Back</a>
		
              </div>
           
              <div class="card-body">
	
     <table id="example1" class="table table-bordered table-striped">
      <thead>
	  <th>#</th>
	  <th>Quote No </th>
      <th>Product/Service </th>
      <th>Quote Type</th>
	  <th>Company Name</th>
	  <th>Client Name</th>
      <th>Employee Name</th>
	  <th>Action</th>
      </thead>
      <tbody>
      <?php
$candidateid=$_SESSION['candidateid'];
$userrole   =$_SESSION['userrole'];

        $check_head = $con->query("SELECT * from staff_master where reporting_person = '$user_id' ");
	
		/* $check_head->execute(); 
		$row             = $check_head->fetch();
		$staff_id = $row['id']; */ 

     while($data = $check_head->fetch(PDO::FETCH_ASSOC)){
		 
		 $staff_id = $data['id'];

		 $datas = $con->query("SELECT a.id as quote_id, a.*, b.*, c.*, e.*, d.* FROM quotation_entry a 
    LEFT JOIN client_master b ON (b.id = a.client_id) 
    LEFT JOIN doller_vendor_mastor c ON (c.id = a.vendor_id)
    LEFT JOIN company_master d ON (d.id = a.company_id)
    LEFT JOIN emp_personal_details e ON (e.emp_id = a.candid_id) 
    WHERE a.created_by = '$staff_id' AND a.status = '1' ORDER BY a.id DESC");
	  
     $cnt=1;
      while($data = $datas->fetch(PDO::FETCH_ASSOC))
	  {
		  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
	  <td><?php echo $data['quote_no']; ?></td>
      <td><?php
	  if($data['business_id'] =='1'){ echo "Product"; 
	  }elseif($data['business_id'] =='2'){ echo "Service";
	  }elseif($data['business_id'] =='3'){ echo "Solution";
	  }
	  ?></td>
      <td><?php if($data['quote_type']=='1'){ echo "INR"; }else{ echo "Doller";}?></td>
      <td><?php echo $data['companyname']; ?></td>
      <td><?php echo $data['client_name']; ?></td>
	  <td><?php echo $data['name']; ?></td>
	  <td>  
	     <button class="btn btn-info" data-id="<?php echo $data['quote_id']; ?>" onclick="quote_proposal_view(<?php echo $data['quote_id']; ?>)">
   <i class="fa fa-eye"></i>
</button>
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




function quote_proposal_view(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/BusinessProcess/quotation/quotation_approve.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function back_ctc()
	{
		Quotation_approve()
	}
</script>