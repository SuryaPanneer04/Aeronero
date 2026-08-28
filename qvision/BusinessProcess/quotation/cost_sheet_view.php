<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole = $_SESSION['userrole'];
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
                <h3 class="card-title" style="float: left;"><font size="5">COST SHEET APPROVE</font></h3>
				  <!--<a onclick=" back_CS()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>-->
              </div>
<br>
<table class="table table-striped table-bordered table-hover display nowrap"  id="example1" style="width:100%">

     <!-- <table id="example1" class="table table-bordered table-striped"> -->
      <thead>
	  <th>#</th>
	  <th>Cost sheet No </th>
      <th>Product / Service </th>
      <th>Quote Type</th> 
	  <th>Client Name</th>
      <th>Employee Name</th>
	  <th>Status</th>
	  <th>Action</th>
      </thead>
      <tbody>
	  <?php 
	    
        $user_id = $_SESSION['userid'];
		$staff_id =array();
	    $userrole = $_SESSION['userrole'];
		$check_dept = $con->query("select dep_id from staff_master where candid_id ='$candidateid' ");
	    //$check_head = $con->query("select * from staff_master where reporting_person ='$candidateid' ");
		//echo "select dep_id from staff_master where candid_id ='$candidateid' ";echo "<br/>";
		$check_dept->execute(); 
		$row           = $check_dept->fetch();
		$department_id = $row['dep_id'];
		$check_staff = $con->query("select candid_id from staff_master where dep_id ='$department_id' ");
		//echo "select candid_id from staff_master where dep_id ='$department_id' ";echo "<br/>";
		
		while($data =$check_staff->fetch(PDO::FETCH_ASSOC))
	    {
			
			array_push($staff_id,$data['candid_id']);	
	    }
	      $staff_list = implode("','",$staff_id);
		  
		
 if($userrole =='R001')//MD
 { 
      $datas=$con->query("
							SELECT 
								a.id AS costsheet_id,
								a.status AS cs_status,
								a.cost_sheet_no,
								a.business_id,
								a.quote_type,
								a.candid_id,
								b.org_name,
								e.emp_name AS employee_name,
								f.*
							FROM cost_sheet_entry a
							LEFT JOIN new_client_master b 
								ON b.id = a.client_id
							LEFT JOIN product_services f 
								ON f.id = a.business_id
							LEFT JOIN staff_master e 
								ON e.candid_id = a.candid_id
							WHERE a.status='0'
							GROUP BY a.cost_sheet_no
							ORDER BY a.id DESC
							");
			
			
 }
 else
 {
	$datas=$con->query("
						SELECT 
							a.id AS costsheet_id,
							a.status AS cs_status,
							a.cost_sheet_no,
							a.business_id,
							a.quote_type,
							a.candid_id AS cs_candid_id,
							b.org_name,
							e.emp_name AS employee_name,
							f.*
						FROM cost_sheet_entry a
						LEFT JOIN new_client_master b 
							ON b.id = a.client_id
						LEFT JOIN product_services f 
							ON f.id = a.business_id
						LEFT JOIN staff_master e 
							ON e.candid_id = a.candid_id
						WHERE a.status='1'
						GROUP BY a.cost_sheet_no
						ORDER BY a.id DESC
						");
			
	
 }	 
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
		 
		  <td><?php echo $data['org_name']; ?></td>
		  <td><?php echo $data['employee_name']; ?></td>
		  <td><?php if($data['cs_status']==1){ 
	               echo '<span style="color:green;text-align:center;"><b>Cost Sheet Generated & </b></span>'; 
	               echo '<span style="color:red;text-align:center;"><b> Waiting for Approval</b></span>'; 
				}else if($data['cs_status']==3){ 
				   //echo '<span style="color:brown;text-align:center;"><b>Cost Sheet Generated * Waiting For Upload</b></span>'; 
				}else if($data['cs_status']==4){ 
				   //echo '<span style="color:brown;text-align:center;"><b>Waiting For Approve </b></span>'; 
				}else if($data['cs_status']==5){ 
					//echo '<span style="color:brown;text-align:center;"><b>Waiting for Cost Sheet</b></span>'; 
				}				
			?>
	   </td>
		  <td> 
           <?php if($data['cs_status']=='1'){ 		 ?> 
			 <button class="btn btn-info" data-id="<?php echo $data['costsheet_id']; ?>" onclick="cost_sheet_view(<?php echo $data['costsheet_id']; ?>)">
			 <i class="fa fa-eye"></i></button>
			  <?php  }	
			 elseif($data['cs_status']=='0' && $userrole=='R001'){ 		 ?> 
			 <button class="btn btn-info" data-id="<?php echo $data['costsheet_id']; ?>" onclick="cost_sheet_view(<?php echo $data['costsheet_id']; ?>)">
			 <i class="fa fa-eye"></i></button>
			  <?php  }	
			  
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
	type:"POST",
	url:"qvision/BusinessProcess/quotation/cost_sheet_approve.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
</script>

<script>
function back_CS()

	{
		Cost_sheet_approve()

	}
</script>