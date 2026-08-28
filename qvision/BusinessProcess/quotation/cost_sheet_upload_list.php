<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];

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
<h3 class="card-title"><font size="5">COST SHEET UPLOAD</font></h3></div>
<div class="card-body">
<table class="table table-striped table-bordered table-hover display nowrap"  id="example1" style="width:100%">
      <thead>
	  <th>#</th>
	  <th>Cost sheet No</th>
      <th>Product / Service</th>
      <th>Quote Type</th> 
	  <th>Client Name</th>
      <th>Employee Name</th>
	  <th>Status</th>
	  <th>Action</th>
      </thead>
      <tbody>
	  <?php 
	    
        $user_id = $_SESSION['userid'];
	    $userrole = $_SESSION['userrole'];
 
      $datas=$con->query("SELECT a.id as costsheet_id,a.status as cs_status,a.*,b.*,e.*,f.* from cost_sheet_entry a 
		    inner join client_master b on(b.id = a.client_id) 
		    inner join product_services f on (f.id = a.business_id)
		    inner join staff_master e ON e.candid_id=a.candid_id  where a.status ='1'
		    group by a.cost_sheet_no  order by a.id desc");
/* echo "SELECT a.id as costsheet_id,a.status as cs_status,a.*,b.*,e.*,f.* from cost_sheet_entry a 
		    inner join client_master b on(b.id = a.client_id) 
		    inner join product_services f on (f.id = a.business_id)
		    inner join staff_master e ON e.candid_id=a.candid_id  where a.status ='1'
		    group by a.cost_sheet_no  order by a.id desc";
  */
/*  echo "SELECT a.id as costsheet_id,a.*,b.*,e.*,f.* from cost_sheet_entry a 
			inner join client_master b on(b.id = a.client_id) 
			inner join `product/services` f on (f.id = a.business_id)
			inner join staff_master e ON e.candid_id=a.candid_id  where a.status ='1' and a.created_by ='$staff_id' 
			group by a.cost_sheet_no  order by a.id desc"; */

	/*    if($userrole == 'R001'){
		   
		   $datas=$con->query("SELECT a.id as costsheet_id,a.*,b.*,e.*,f.* from cost_sheet_entry a 
		        inner join client_master b on(b.id=a.client_id) 
		        inner join `product/services` f on (f.id = a.business_id)
		        inner join staff_master e ON e.candid_id=a.candid_id  where a.log_per<='30' OR a.log_per<='40' and a.eng_per<='30' OR a.eng_per<='40' and a.status ='1' limit 1");
				
				echo "SELECT a.id as costsheet_id,a.*,b.*,e.*,f.* from cost_sheet_entry a 
		        inner join client_master b on(b.id=a.client_id) 
		        inner join `product/services` f on (f.id = a.business_id)
		        inner join staff_master e ON e.candid_id=a.candid_id  where a.log_per<='30' OR a.log_per<='40' and a.eng_per<='30' OR a.eng_per<='40' and a.status ='1' limit 1";
	   }else{
		   }  */
       /*$userrole=$_SESSION['userrole'];
       $user_id = $_SESSION['userid'];
		 if(($userrole =='R005')||($userrole =='R004')){
			 $rollfetch = $con->query("SELECT a.id as costsheet_id,a.*,b.*,e.*,f.* from cost_sheet_entry a 
			  inner join client_master b on(b.id=a.client_id) 
			  inner join `product/services` f on (f.id = a.business_id)
			  inner join staff_master e ON e.candid_id=a.candid_id  where  a.status ='1' limit 1");
			 $stmt->execute(); 
			 $row = $stmt->fetch();
			 $created_by =$row['created_by'];
			 
			 $check_roll = $con->query("SELECT user_group_code from z_user_master where user_id = '$created_by' ");
		
			$check_roll->execute(); 
			$row       = $check_roll->fetch();
			$user_roll = $row['user_group_code']; 
			if($user_roll=='R006'){
				 $datas=$con->query("SELECT a.id as costsheet_id,a.*,b.*,e.*,f.* from cost_sheet_entry a 
		          inner join client_master b on(b.id=a.client_id) 
		          inner join `product/services` f on (f.id = a.business_id)
		          inner join staff_master e ON e.candid_id=a.candid_id  where  a.status ='1' limit 1");
			}else if($user_roll=='R005'){
				  $datas=$con->query("SELECT a.id as costsheet_id,a.*,b.*,e.*,f.* from cost_sheet_entry a 
		          inner join client_master b on(b.id=a.client_id) 
		          inner join `product/services` f on (f.id = a.business_id)
		          inner join staff_master e ON e.candid_id=a.candid_id  where  a.status ='1' limit 1");
			}
		} */
	  ?>
      <?php
	
	   
     $cnt=1;
      while($data =$datas->fetch(PDO::FETCH_ASSOC))
	  {
	  ?>
      <tr>
		  <td><?php echo $cnt;?>.</td>
		  <td><?php echo $data['cost_sheet_no']; ?></td>
		  <td><?php 
		  if($data['mapping_id'] =='1'){ echo "Product"; 
		  }elseif($data['mapping_id'] =='2'){ echo "Service";
		  }elseif($data['mapping_id'] =='3'){ echo "Solution";
		  }
		  ?></td>
		  <td><?php if($data['quote_type']=='1'){ echo "INR"; }else{ echo "Doller";}?></td>
		 
		  <td><?php echo $data['client_name']; ?></td>
		  <td><?php echo $data['emp_name']; ?></td>
		  <td><?php if($data['cs_status']==1){ 
	               echo '<span style="color:green;text-align:center;"><b>cost sheet uploaded & </b></span>'; 
	               echo '<span style="color:red;text-align:center;"><b> Waiting for cost price Upload</b></span>'; 
				
				}				
			?></td>
		  <td>  
			 <button class="btn btn-info" data-id="<?php echo $data['costsheet_id']; ?>" onclick="cost_sheet_view(<?php echo $data['costsheet_id']; ?>)">
			 <i class="fa fa-eye"></i></button>
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
        "scrollX": true
    } );
} );
</script>
<script>
//$(function () {
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
	type:"POST",
	url:"qvision/BusinessProcess/quotation/cost_sheet_upload_form.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
</script>