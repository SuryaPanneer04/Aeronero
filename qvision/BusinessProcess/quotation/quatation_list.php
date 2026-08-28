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
<div class="content-wrapper" style="padding-left: 100px;">
	<div  class="card card-primary">
<div class="card-header">
	 <h1 class="card-title"><font size="5">QUOTATION LIST</font> </h1></div>
    <div class="card-body">
     <table id="example1" class="table table-bordered table-striped">


   
      <thead>
	 <th>#</th>
	  <th>Cost sheet No </th>
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
$userrole=$_SESSION['userrole'];

if($userrole=='ROLE-014' ){
    $datas=$con->query("SELECT a.id as costsheet_id, a.*, b.*, e.*, d.* 
        FROM cost_sheet_entry a 
        LEFT JOIN client_master b ON (b.id = a.client_id) 
        LEFT JOIN company_master d ON (d.id = a.company_id)
        LEFT JOIN candidate_form_details e ON (e.id = a.candid_id) 
        WHERE a.created_by='$candidateid' AND a.status ='1'");
}
else 
{
    $datas=$con->query("SELECT a.id as costsheet_id, a.*, b.*, e.*, d.* 
        FROM cost_sheet_entry a 
        LEFT JOIN client_master b ON (b.id = a.client_id) 
        LEFT JOIN company_master d ON (d.id = a.company_id)
        LEFT JOIN candidate_form_details e ON (e.id = a.candid_id) 
        WHERE a.status ='1'");
}
	 
     $cnt=1;
      while($data = $datas->fetch(PDO::FETCH_ASSOC))
	  {
		  ?>
   <tr>
	  <td><?php echo $cnt;?>.</td>
	  <td><?php echo $data['cost_sheet_no']; ?></td>
      <td><?php
	  if($data['business_id'] =='1'){ echo "Product"; 
	  }elseif($data['business_id'] =='2'){ echo "Service";
	  }elseif($data['business_id'] =='3'){ echo "Solution";
	  }
	  ?></td>
      <td><?php if($data['quote_type']=='1'){ echo "INR"; }else{ echo "Doller";}?></td>
      <td><?php echo $data['companyname']; ?></td>
      <td><?php echo $data['client_name']; ?></td>
	  <td><?php echo $data['first_name']; ?></td>
	  <td>  
	     <button class="btn btn-info" data-id="<?php echo $data['costsheet_id']; ?>" onclick="quotation_add(<?php echo $data['costsheet_id']; ?>)">
	     <i class="fa fa-eye"></i></button>
	  </td>
      </tr>
      <?php
	  $cnt=$cnt+1;
      }
      ?>
      </tbody>
      </table>
    
<!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
	</div>
	</div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<script>
function quotation_add(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/BusinessProcess/quotation/quotation_add.php?id="+v,
	success:function(data)
	{
		$(".content").html(data);
	}
	})
}

	
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

	
    </script>
