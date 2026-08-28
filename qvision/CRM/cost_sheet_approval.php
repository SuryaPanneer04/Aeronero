<?php
require '../../connect.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];


?>

<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Client List</font></h3>
		
			
              </div>
              <!-- /.card-header -->
              <div class="card-body">
			  
       <table id="dataTable" class="table table-bordered table-striped">
    
      <thead>
	  <th>#</th>
     <th>Client_name</th>
	 <th>Organization_name</th>
	 <th>Client_designation</th>
	 <th>Mobile_no</th>
	 <th>Email_id</th>
	 <th>Status</th>
     <th>Action</th>
      </thead>
      <tbody>
      <?php
	  $datas=$con->query("SELECT a.id as id,a.status as client_status,a.flow,a.id,a.org_name,a.ims_status,b.client_id,d.id as enquiry_id,b.it_name as client_name,b.it_designation as client_designation,b.it_mob1 as client_mob1,b.it_mob2 as client_mob2,b.it_mail1 as client_mail1,b.it_mail2 as client_mail2,b.it_landno as client_land,d.Company_name FROM new_client_master a join new_plant_master b on(a.id=b.client_id) left join enquiry d on(a.id=d.Client_id) where a.status=1");
	  
	  
	 $cnt=1;
      while($enquiry = $datas->fetch(PDO::FETCH_ASSOC))
	  {  
   
		
		$client_name= $enquiry['client_name']; 
		$client_desg= $enquiry['client_designation']; 
		$client_num= $enquiry['client_mob1']; 
		$it_num1= $enquiry['client_mob2']; 
		$client_mail= $enquiry['client_mail1']; 			
		$it_mail1= $enquiry['client_mail2']; 			
		$ims_status= $enquiry['ims_status']; 			
		
		  ?>
      <tr>
	  <td><?php echo $cnt;?></td>
      <td><?php echo $client_name;?></td>
	  <td><?php echo $enquiry['org_name'];?></td>
	  <td><?php echo $client_desg;?></td>
	   <td><?php echo $client_num;?></td>
	  <td><?php echo $client_mail;?></td>
	<td><?php if($enquiry['client_status']==1)
		{

echo '<span style="color:blue;text-align:center;"><b>Pending</b></span>';
}
if($enquiry['client_status']==2)
{

echo '<span style="color:green;text-align:center;"><b>Approved</b></span>';
}
if($enquiry['client_status']==3)
{

echo '<span style="color:red;text-align:center;"><b>Rejected</b></span>';
}
		?></td>
	<td>	
<?php
if($ims_status==0)
{
?>	
		<button class="btn btn-info" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="client_masterss(<?php echo $enquiry['enquiry_id']; ?>)"><i class="fa fa-eye"></i></button>
<?php
}else{
	?>
	<button class="btn btn-info" data-id="<?php echo $enquiry['id']; ?>" onclick="ims_masterss(<?php echo $enquiry['id']; ?>)"><i class="fa fa-eye"></i></button>
<?php
}			
?>
	</td>
      </tr>
      <?php
	  $cnt=$cnt+1;
      }
	  
	   $datasa=$con->query("SELECT a.status as status,b.id as enquiry_id,a.client_name as client_name,a.contact as contact,a.email as email FROM individual_form a join enquiry b on(a.id=b.ind_client_id) where a.status=1");
	   $cnt=1;
      while($enquirya = $datasa->fetch(PDO::FETCH_ASSOC))
	  {  
   
		
		$client_name= $enquirya['client_name']; 
		$client_desg= 'Nil'; 
		$client_num= $enquirya['contact']; 
		
		$client_mail= $enquirya['email']; 			
		
		
		  ?>
      <tr>
	  <td><?php echo $cnt;?></td>
      <td><?php echo $client_name;?></td>
	  <td><?php echo 'Individual Customer';?></td>
	  <td><?php echo $client_desg;?></td>
	   <td><?php echo $client_num;?></td>
	  <td><?php echo $client_mail;?></td>
	<td><?php if($enquirya['status']==1)
		{

echo '<span style="color:blue;text-align:center;"><b>Pending</b></span>';
}
if($enquirya['status']==2)
{

echo '<span style="color:green;text-align:center;"><b>Approved</b></span>';
}
if($enquirya['status']==3)
{

echo '<span style="color:red;text-align:center;"><b>Rejected</b></span>';
}
		?></td>
	<td>				
		<button class="btn btn-info" data-id="<?php echo $enquirya['enquiry_id']; ?>" onclick="client_masterss(<?php echo $enquirya['enquiry_id']; ?>)"><i class="fa fa-eye"></i></button>
				

	</td>
      </tr>
      <?php
	  $cnt=$cnt+1;
      }
      ?>
      </tbody>
       </table>
				
              </div>
              <!-- /.card-body -->
            </div>
<script>
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
				responsive: true
		});
	});
</script>
<script>
	function ims_masterss(a){

		$.ajax({
	type:"POST",
	 
	url:"qvision/CRM/client_ims_appoval.php?id="+a,
	success:function(data)
	{
		 $("#main_content").html(data);
	}
	})
	}
  function client_masterss(v){
	//  alert(v);
	$.ajax({
	type:"POST",
	 
	url:"qvision/CRM/client_insert_approval.php?id="+v,
	success:function(data)
	{
		 $("#main_content").html(data);
	}
	})
}

function back_ctc()
	{
		enquiry()
	}
    </script>
