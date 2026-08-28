<?php
require '../config.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
?>
<style>
  .card-primary:not(.card-outline)>.card-header {
    background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header, .card-primary:not(.card-outline)>.card-header a {
    color: #e95a16 !important;
}
.card-primary:not(.card-outline)>.card-header, .card-primary:not(.card-outline)>.card-header a {
    color: #3c0808 !important;
    background-color: #17a2b8;
}
.btn-dark {
    border-color: #17a2b8;
}
.page-item.active .page-link {
    background-color: #d79475;
    border-color: #df8459;
}
.page-link:hover {
    color: #f1cc61;
}
  </style>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Lead LIST</font></h3>
			
			
              </div>
              <!-- /.card-header -->
              <div class="card-body">
    <table id="example1" class="table table-bordered">
      <thead>
	  <th>S.No</th>
      <th>Call</th>
      <th>Date</th>
      <th>Company Name</th>
      <th>Location</th>
      <th>Contact Number</th>
      <th>Mail Id</th>
      <th>Feedback</th>
     <th>Foll UP Date </th>
	 <th>Assign Company</th>
	<th>Department</th>
	<th>Employee</th>
	<th>Status</th>
	<th>Action</th>
      </thead>
      <tbody>
      <?php
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

	 if($userrole=='ROLE-007' ){
		 $datas=$con->query("SELECT a.id as enquiry_id,a.status as enquiry_status,a.it_name as client_name,a.it_designation as client_designation,a.it_mob1 as client_mob1,a.it_mob2 as client_mob2,a.it_mail1 as client_mail1,a.it_mail2 as client_mail2,a.it_landno as client_land,a.*,b.*,c.*,d.*,e.status as client_ststs,e.*  FROM enquiry a
	   left JOIN calls_master b ON (a.Call_type=b.id)
	  left join z_department_master c ON (a.Department=c.id)
	  left JOIN staff_master d ON (a.employee=d.candid_id) left join new_client_master e on (a.Client_id=e.id) where a.employee='$candidateid' and a.status='2'");
	  
	  /* echo "SELECT enquiry.id as enquiry_id,enquiry.mail as enquiry_mailid,enquiry.status as enquiry_status,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*,new_client_master.status as client_ststs,new_client_master.*  FROM `enquiry`
	   left JOIN calls_master ON enquiry.Call_type=calls_master.id
	  left join z_department_master ON enquiry.Department=z_department_master.id
	  left JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id left join new_client_master on enquiry.Client_id=new_client_master.id where enquiry.employee='$candidateid' and enquiry.status='2'"; */
	  
	 } else {
      $datas=$con->query("SELECT a.id as enquiry_id,a.status as enquiry_status,a.it_name as client_name,a.it_designation as client_designation,a.it_mob1 as client_mob1,a.it_mob2 as client_mob2,a.it_mail1 as client_mail1,a.it_mail2 as client_mail2,a.it_landno as client_land,a.*,b.*,c.*,d.*,e.status as client_ststs,e.*  FROM enquiry a
	   left JOIN calls_master b ON (a.Call_type=b.id)
	  left join z_department_master c ON (a.Department=c.id)
	  left JOIN staff_master d ON (a.employee=d.candid_id) left join new_client_master e on (a.Client_id=e.id) where a.employee='$candidateid' and a.status='2'");
	  
	 /*  echo "SELECT enquiry.id as enquiry_id,enquiry.mail as enquiry_mailid,enquiry.status as enquiry_status,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*,new_client_master.status as client_ststs,new_client_master.*  FROM `enquiry`
	   left JOIN calls_master ON enquiry.Call_type=calls_master.id
	  left join z_department_master ON enquiry.Department=z_department_master.id
	  left JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id left join new_client_master on enquiry.Client_id=new_client_master.id
	  where  enquiry.status='2'"; */
	 }
     $cnt=1;
      while($enquiry = $datas->fetch(PDO::FETCH_ASSOC))
	  {
		  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $enquiry['name']; ?></td>
      <td><?php echo $enquiry['date']; ?></td>
      <td><?php echo $enquiry['Company_name']; ?></td>
      <td><?php echo $enquiry['Location']; ?></td>
      <td><?php echo $enquiry['client_mob1']; ?></td>
      <td><?php echo $enquiry['client_mail1']; ?></td>
      <td><?php echo $enquiry['Feedback']; ?></td>
	    <td><?php echo $enquiry['Follup']; ?></td>
		
		  <td>
		  <?php 
		  if($enquiry['companys']==1)
		  {
			  echo "Bluebase Software Services Pvt Ltd";
	  } else {
		  echo "Bluebase Software Services Private Limited";
	  }
		  ?>
		  
		  
		  </td>
	   <td><?php echo $enquiry['dept_name']; ?></td>
	    <td><?php echo $enquiry['emp_name']; ?></td>
	      <td><?php if($enquiry['client_ststs']==2){ 
	               echo '<span style="color:green;text-align:center;"><b>Client Approved</b></span>';  
				}else{ 
				   echo '<span style="color:red;text-align:center;"><b>Waiting For Approval</b></span>'; 
				}				
			?>
	   </td>
		 <td>  
	<?php
	if($enquiry['Product']==1){
	?>
  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="proposal_edit(<?php echo $enquiry['enquiry_id']; ?>)"><i class="fa fa-edit"></i> Edit</button>

	<?php } else {?>
		
		<?php
	}
	?>
	<button class="btn btn-info" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="proposal_view(<?php echo $enquiry['enquiry_id']; ?>)"><i class="fa fa-eye"></i></button>
	
	<?php if($enquiry['enquiry_status']==2 && $enquiry['Client_type']==2 && $enquiry['flag']==0){
				 
			 ?>	
			
		<button class="btn btn-danger" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="client_masterss(<?php echo $enquiry['enquiry_id']; ?>)">Create Client Master</button>
		 <?php
			 }
			 ?>
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
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<script>
function client_masterss(v){
	//  alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/CRM/client_insert.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}

		function add_enquree()
    {
    $.ajax({
    type:"POST",
    url:"qvision/CRM/enquiry_add.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function proposal_edit(v){
	 // alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/CRM/proposal_edit.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function proposal_view(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/CRM/position_view.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function back_ctc()
	{
		lead()
	}
    </script>
</script>