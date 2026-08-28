<?php
require '../../connect.php';
include'../../user.php';
$userrole=$_SESSION['userrole']; 
$userid=$_SESSION['candidateid'];

// echo "Role: " . var_export($userrole, true) . " | UserID: " . var_export($userid, true);
?>
<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
</style>
<div  class="card card-primary">
              <div class="card-header" style="background-color:#ff8b3d !important;color:white !important;">
            <h3>Interview Allocated List</h3>
          </div> <br>
     
    <!-- Main content -->
  
	 <?php			

	 if($userrole=='R003')  //HR
	 { 
    ?> 
			 
    <table id="example1" class="table table-bordered">
      <thead>
		  <th> ID</th>		  
		  <th>Name</th>
		  <th>Position</th>
		  <th>Status</th>
		  <th>Tools</th>
      </thead>
      <tbody>
      <?php
      $candid=$userid;
	  $sel=$con->query("select * from staff_master where candid_id='$candid'");
	  $fet=$sel->fetch();
	  $sid=$fet['id'];
	  
       $emp_sql=$con->query("SELECT *,d.tittle as dname,c.status as csts,c.id as id,dm.designation_name FROM candidate_form_details c left join jobdescription_master d on c.position=d.id left join designation_master dm on c.position=dm.id where c.old_status=0 and  c.id in(select candid_id from candidate_round_details where person_id='$sid') ORDER by c.id DESC"); 
	//echo "SELECT *,d.tittle as dname,c.status as csts,c.id as id,dm.designation_name FROM candidate_form_details c left join jobdescription_master d on c.position=d.id left join designation_master dm on c.position=dm.id where c.old_status=0 and  c.id in(select candid_id from candidate_round_details where person_id='$sid') ORDER by c.id DESC";
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
	  
	  $dsgn_name = $emp_res['designation_name'];
      $position = $emp_res['position'];
      ?>
	  
      <tr>
		  <td><?php echo $i; ?></td>
		  
		  <td><?php echo $emp_res['first_name']." ".$emp_res['last_name']; ?></td>
		 
		 <?php 
 // if($position== is_numeric($position)){
	if($emp_res['csts']==19 || $emp_res['csts']==20  || $emp_res['csts']==22  || $emp_res['csts']==23  || $emp_res['csts']==40 ){
	?>
		  <td><?php echo $dsgn_name; ?></td>
		  
  <?php } else{ ?>
  
           <td> <?php echo $emp_res['tittle']; ?> </td>
  <?php } ?>
  
		
		  <td>
<?php  
//  if(($emp_res['csts'] == 3))
// {
// echo '<span style="color:orange;text-align:center;"><b>PENDING</b></span>';
// }

// if(($emp_res['csts']==1))  
// {
// echo '<span style="color:blue;text-align:center;"><b>Waiting List</b></span>';

// }

// if(($emp_res['csts']==4))  
// {
// echo '<span style="color:green;text-align:center;"><b>Question Allocated</b></span>';

// }

// if(($emp_res['csts']==7))  
// {
// echo '<span style="color:red;text-align:center;"><b>Sales level Rejected</b></span>';

// }

// if(($emp_res['csts']==5))  
// {
// echo '<span style="color:blue;text-align:center;"><b>Sales level selected  </b></span>';
// }
// if(($emp_res['csts']==8))  
// {
// echo '<span style="color:green;text-align:center;"><b> Selected </b></span>';
// }
// if(($emp_res['csts']==9))  
// {
// echo '<span style="color:red;text-align:center;"><b> Rejected </b></span>';
// }
// if(($emp_res['csts']==13))  
// {
// echo '<span style="color:green;text-align:center;"><b>Service level Selected</b></span>';

// }if(($emp_res['csts']==15))  
// {
// echo '<span style="color:red;text-align:center;"><b>Service level Rejected</b></span>';

// }
// if(($emp_res['csts']==16))  
// {
// echo '<span style="color:red;text-align:center;"><b>Selected by MD</b></span>';

// }

// if(($emp_res['csts']==18))  
// {
// echo '<span style="color:red;text-align:center;"><b>MD Level Rejected</b></span>';

// }
// if(($emp_res['csts']==19))  
// {
// echo '<span style="color:red;text-align:center;"><b>Application Form Sent</b></span>';

// }
// if(($emp_res['csts']==20))  
// {
// echo '<span style="color:red;text-align:center;"><b>Waiting For Document Approve</b></span>';

// }
// if(($emp_res['csts']==22))  
// {
// echo '<span style="color:green;text-align:center;"><b>Document Approved</b></span>';

// }
// if(($emp_res['csts']==23))  
// {
// echo '<span style="color:blue;text-align:center;"><b>Staff Type allocated</b></span>';

// }

// if(($emp_res['csts']==32))  
// {
// echo '<span style="color:blue;text-align:center;"><b>Rejected</b></span>';

// }
// if(($emp_res['csts']==35))  
// {
// echo '<span style="color:green;text-align:center;"><b>HR Level Selected</b></span>';

// }
// if(($emp_res['csts']==37))  
// {
// echo '<span style="color:red;text-align:center;"><b>HR Level Rejected</b></span>';

// }
// if(($emp_res['csts']==41))  
// {
// echo '<span style="color:green;text-align:center;"><b>Selected</b></span>';

// }
 ?>	
 
 



 <?php 

 if(($emp_res['csts']==11) || ($emp_res['csts']==41))  
{

echo '<span style="color:green;text-align:center;"><b>Selected</b></span>';
}
if(($emp_res['csts']==12))  
{
echo '<span style="color:red;text-align:center;"><b>Rejected</b></span>';

}
if(($emp_res['csts']==0))  
{
echo '<span style="color:green;text-align:center;"><b>SELECTED FOR  TECHNICAL</b></span>';

}
if(($emp_res['csts']==1))  
{
echo '<span style="color:blue;text-align:center;"><b>Waiting List</b></span>';

}
if(($emp_res['csts']==2))  
{
echo '<span style="color:blue;text-align:center;"><b>Candidate form submitted</b></span>';

}
if(($emp_res['csts']==3))  
{
echo '<span style="color:orange;text-align:center;"><b>PENDING</b></span>';

}
if(($emp_res['csts']==4))  
{
echo '<span style="color:green;text-align:center;"><b>Question Allocated</b></span>';

}
if(($emp_res['csts']==6))  
{
echo '<span style="color:blue;text-align:center;"><b>Technical one Waiting List</b></span>';

}
if(($emp_res['csts']==7))  
{
echo '<span style="color:red;text-align:center;"><b>HR level Selected / Sales Level Rejected</b></span>';

}
if(($emp_res['csts']== 8))  
{
echo '<span style="color:green;text-align:center;"><b>HR level Selected / Accounts level Selected</b></span>';

}
if(($emp_res['csts']== 9))  
{
echo '<span style="color:green;text-align:center;"><b>HR level Selected / Accounts level rejected</b></span>';
}
if(($emp_res['csts']==5))  
{
echo '<span style="color:green;text-align:center;"><b>HR level Selected /  Sales level selected   </b></span>';
}

if(($emp_res['csts']==13))  
{
echo '<span style="color:green;text-align:center;"><b>HR level Selected / Service Level Selected </b></span>';

}
if(($emp_res['csts']==14))  
{
echo '<span style="color:red;text-align:center;"><b>Technical two Waiting List</b></span>';

}
if(($emp_res['csts']==15))  
{
echo '<span style="color:red;text-align:center;"><b>HR level Selected / Service Level Rejected</b></span>';

}
if(($emp_res['csts']==16))  
{
echo '<span style="color:green;text-align:center;"><b>MD Approved</b></span>';

}
if(($emp_res['csts']==17))  
{
echo '<span style="color:red;text-align:center;"><b>MD Level Waiting List</b></span>';

}
if(($emp_res['csts']==18))  
{
echo '<span style="color:red;text-align:center;"><b>MD Level Rejected</b></span>';

}
if(($emp_res['csts']==19))  
{
echo '<span style="color:red;text-align:center;"><b>Application Form Sent</b></span>';

}
if(($emp_res['csts']==20))  
{
echo '<span style="color:red;text-align:center;"><b>Waiting For Document Approve</b></span>';

}
if(($emp_res['csts']==22))  
{
echo '<span style="color:red;text-align:center;"><b>Document Approved</b></span>';

}
if(($emp_res['csts']==23))  
{
echo '<span style="color:blue;text-align:center;"><b>Staff Type allocated</b></span>';

}
if(($emp_res['csts']==24))  
{
echo '<span style="color:blue;text-align:center;"><b>Staff</b></span>';

}
if(($emp_res['csts']==30))  
{
echo '<span style="color:blue;text-align:center;"><b>Waiting For Assessment Approve</b></span>';

}
if(($emp_res['csts']==32))  
{
echo '<span style="color:blue;text-align:center;"><b>Rejected</b></span>';

}
if(($emp_res['csts']==35))  
{
echo '<span style="color:green;text-align:center;"><b>HR Level Selected</b></span>';

}
if(($emp_res['csts']==37))  
{
echo '<span style="color:red;text-align:center;"><b>HR Level Rejected</b></span>';

}
if(($emp_res['csts']==40))  
{
echo '<span style="color:green;text-align:center;"><b>Selected</b></span>';

}
 
?>
 </td>
		<?php 
		$csel=$con->query("select status from candidate_round_details where candid_id='$emp_id' and person_id='$sid'");
		$cfet=$csel->fetch();
		$cstatus=$cfet['status'];
		?>
		
		  <td>
		  <?php if($cstatus == 3){
			  ?>
		  <button class="btn btn-primary" data-id="<?php echo $emp_res['id']; ?>" onclick="hr_insert(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-plus"></i>Enter Feedback</button>
		 <?php }  ?>
		 <?php  if($cstatus == 6){?>
		   <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="technical_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
	<?php } ?>
	   <?php  if( $cstatus ==35 || $cstatus ==37 || $cstatus ==13 || $cstatus ==15){?>
	   <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id'];?>" onclick="hr_view(<?php echo $emp_res['id']; ?>)"> View</button>
	 <?php 
	 }
	 ?>
		 </td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      
      </table>
	  <?php 
				}
				else if(($userrole=='R008' && $userid=='4') || ($userrole=='R010' && $userid=='2')) //sales 
				{?>
	<table id="example1" class="table table-bordered">
	   <thead>
		<tr>
		  <th>Id</th>
		  <th>Candidate Name</th>
		  <th>Position</th>
		  <th>Status</th>
		  <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
	  $candid=$userid;
	  $sel=$con->query("select * from staff_master where candid_id='$candid'");
	  $fet=$sel->fetch();
	  $sid=$fet['id'];
	  
      $emp_sql=$con->query("SELECT *,c.status As csts,c.id As cid,dm.designation_name  FROM candidate_form_details c LEFT JOIN jobdescription_master d ON c.position=d.id LEFT JOIN designation_master dm ON c.position=dm.id WHERE c.id IN(SELECT candid_id FROM candidate_round_details WHERE person_id='$sid') ORDER BY c.id DESC");

	  //echo "SELECT *,c.status As csts,c.id As cid,dm.designation_name  FROM candidate_form_details c LEFT JOIN jobdescription_master d ON c.position=d.id LEFT JOIN designation_master dm ON c.position=dm.id WHERE c.id IN(SELECT candid_id FROM candidate_round_details WHERE person_id='$sid') ORDER BY c.id DESC";
	 
		  
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['cid'] ;
      $emp_sts = $emp_res['csts'] ;
	  $dsgn_name = $emp_res['designation_name'];
      $position = $emp_res['position'];
	
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  
		  <td><?php echo $emp_res['first_name']." ".$emp_res['last_name']; ?></td>
<?php 
  //if($position == is_numeric($position)){
	if($emp_res['csts']==19 || $emp_res['csts']==20  || $emp_res['csts']==22  || $emp_res['csts']==23  || $emp_res['csts']==40 ){
	  ?>
		  <td><?php echo $dsgn_name; ?></td>
		  
  <?php } else{ ?>
  
           <td><?php echo $emp_res['tittle']; ?></td>
  <?php } ?>		  

<td>
<?php  
 if(($emp_sts == 3))
{
echo '<span style="color:orange;text-align:center;"><b>PENDING</b></span>';
}

if(($emp_res['csts']==1))  
{
echo '<span style="color:blue;text-align:center;"><b>Waiting List</b></span>';

}

if(($emp_res['csts']==4))  
{
echo '<span style="color:green;text-align:center;"><b>Question Allocated</b></span>';

}

if(($emp_res['csts']==7))  
{
echo '<span style="color:red;text-align:center;"><b>sales level Rejected</b></span>';

}

if(($emp_res['csts']==5))  
{
echo '<span style="color:green;text-align:center;"><b> sales level selected   </b></span>';
}
if(($emp_res['csts']==8))  
{
echo '<span style="color:green;text-align:center;"><b>Accounts level Selected </b></span>';
}
if(($emp_res['csts']==9))  
{
echo '<span style="color:red;text-align:center;"><b>Accounts level Rejected </b></span>';
}
if(($emp_res['csts']==13))  
{
echo '<span style="color:green;text-align:center;"><b>Service level Selected</b></span>';

}
if(($emp_res['csts']==15))  
{
echo '<span style="color:green;text-align:center;"><b>Service level Rejected</b></span>';

}
if(($emp_res['csts']==16))  
{
echo '<span style="color:green;text-align:center;"><b>Selected by MD</b></span>';

}

if(($emp_res['csts']==18))  
{
echo '<span style="color:red;text-align:center;"><b>MD Level Rejected</b></span>';

}
if(($emp_res['csts']==19))  
{
echo '<span style="color:red;text-align:center;"><b>Application Form Sent</b></span>';

}
if(($emp_res['csts']==20))  
{
echo '<span style="color:orange;text-align:center;"><b>Waiting For Document Approve</b></span>';

}
if(($emp_res['csts']==22))  
{
echo '<span style="color:green;text-align:center;"><b>Document Approved</b></span>';

}
if(($emp_res['csts']==23))  
{
echo '<span style="color:green;text-align:center;"><b>Staff Type allocated</b></span>';

}

if(($emp_res['csts']==32) || ($emp_res['csts']==12))  
{
echo '<span style="color:red;text-align:center;"><b>Rejected</b></span>';

}
if(($emp_res['csts']==35))  
{
echo '<span style="color:green;text-align:center;"><b>HR Level Selected</b></span>';

}
if(($emp_res['csts']==37))  
{
echo '<span style="color:red;text-align:center;"><b>HR Level Rejected</b></span>';

}
if(($emp_res['csts']==41))  
{
echo '<span style="color:green;text-align:center;"><b>Selected</b></span>';

}
 ?>		  
 </td>
	<?php 
		$csel=$con->query("select status from candidate_round_details where candid_id='$emp_id' and person_id='$sid'");
		$cfet=$csel->fetch();
		$cstatus=$cfet['status'];
		?>
		  <td><?php if($cstatus == 3){
			  ?>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_id; ?>" onclick="feedback_insert(<?php echo $emp_id; ?>)"> <i class="fa fa-plus"></i>Enter Feedback</button>
		 <?php }  ?>
		 <!-- ?php  if($emp_sts == 5 ){?>
		   <button class="btn btn-success btn-sm edit btn-flat" data-id="< ?php echo $emp_id; ?>" onclick="technical_edit(< ?php echo $emp_id; ?>)"><i class="fa fa-edit"></i> Edit</button < ?php } ?>  -->
	
	   <?php  if($cstatus == 4 || $cstatus == 5  || $cstatus == 13 || $cstatus == 8){?>
	   <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_id; ?>" onclick="feedback_view(<?php echo $emp_id; ?>)"> View</button> <!--feedback_view technical_view-->
	 <?php }
	 ?>
		 </td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
				<?php } 
				else if($userrole=='R001') //MD
				{?>
	<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
	   <thead>
		<tr>
		  <th>Id</th>
		  <th>Candidate Name</th>
		  <th>Position</th>
		  <th>Status</th>
		  <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
       $candid=$userid;
	  $sel=$con->query("select * from staff_master where candid_id='$candid'");
	  $fet=$sel->fetch();
	  $sid=$fet['id'];
	  
       $emp_sql=$con->query("SELECT *,d.tittle as dname,c.status as csts,c.id as id,dm.designation_name FROM candidate_form_details c left join jobdescription_master d on c.position=d.id left join designation_master dm on c.position=dm.id where c.old_status=0 and  c.id in(select candid_id from candidate_round_details where person_id='$sid') order by c.id desc"); 
	   
	   
	   $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'];
	  $dsgn_name = $emp_res['designation_name'];
      $position = $emp_res['position'];
      ?>
      <tr>
	  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['first_name']." ". $emp_res['last_name']; ?></td>
		 
<?php 
  //if($position== is_numeric($position)){
	if($emp_res['csts']==19 || $emp_res['csts']==20  || $emp_res['csts']==22  || $emp_res['csts']==23  || $emp_res['csts']==40 ){
	  ?>
		  <td><?php echo $dsgn_name; ?></td>
		  
  <?php } else{ ?>
  
           <td><?php echo $emp_res['dname']; ?></td>
  <?php } ?>

  
	
<td>
<?php  
 if(($emp_res['csts'] == 3))
{
echo '<span style="color:orange;text-align:center;"><b>PENDING</b></span>';
}

if(($emp_res['csts']==1))  
{
echo '<span style="color:blue;text-align:center;"><b>Waiting List</b></span>';

}

if(($emp_res['csts']==4))  
{
echo '<span style="color:green;text-align:center;"><b>Question Allocated</b></span>';

}

if(($emp_res['csts']==7))  
{
echo '<span style="color:red;text-align:center;"><b>Rejected</b></span>';

}

if(($emp_res['csts']==5))  
{
echo '<span style="color:blue;text-align:center;"><b> selected for next level </b></span>';
}
if(($emp_res['csts']==8) || ($emp_res['csts']==41))  
{
echo '<span style="color:green;text-align:center;"><b> Selected </b></span>';
}
if(($emp_res['csts']==9) || ($emp_res['csts']==12))  
{
echo '<span style="color:red;text-align:center;"><b> Rejected </b></span>';
}
if(($emp_res['csts']==16))  
{
echo '<span style="color:red;text-align:center;"><b>Selected by MD</b></span>';

}

if(($emp_res['csts']==18))  
{
echo '<span style="color:red;text-align:center;"><b>MD Level Rejected</b></span>';

}
if(($emp_res['csts']==19))  
{
echo '<span style="color:red;text-align:center;"><b>Application Form Sent</b></span>';

}
if(($emp_res['csts']==20))  
{
echo '<span style="color:red;text-align:center;"><b>Waiting For Document Approve</b></span>';

}
if(($emp_res['csts']==22))  
{
echo '<span style="color:green;text-align:center;"><b>Document Approved</b></span>';

}
if(($emp_res['csts']==23))  
{
echo '<span style="color:blue;text-align:center;"><b>Staff Type allocated</b></span>';

}

if(($emp_res['csts']==32))  
{
echo '<span style="color:blue;text-align:center;"><b>Rejected</b></span>';

}
if(($emp_res['csts']==35))  
{
echo '<span style="color:blue;text-align:center;"><b>HR Level Selected</b></span>';

}
if(($emp_res['csts']==37))  
{
echo '<span style="color:blue;text-align:center;"><b>HR Level Rejected</b></span>';

}
 ?>		  
 </td>
	<?php 
		$csel=$con->query("select status from candidate_round_details where candid_id='$emp_id' and person_id='$sid'");
		
		$cfet=$csel->fetch();
		 $cstatus=$cfet['status'];
		
		?>   
		   <td>
		   <?php if( $cstatus =='3'){
			  ?>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="md_insert(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-plus"></i>Enter Feedback </button> <?php }  ?>
		  <?php  if($cstatus == 17 || $cstatus ==14){?>
		  
		   <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="md_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit<?php } ?></button>
		   
		   <?php  if($cstatus == 18|| $cstatus ==16 ){?>  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="md_view(<?php echo $emp_res['id']; ?>)"> View</button>
	 <?php } ?>
		 </td>
      </tr>
      <?php
      	$i++;
	  }
      ?>
      </tbody>
      </table>
				<?php 
				}

else if($userrole=='R004' || $userrole=='ROLE-004')//Service
				{?>
	<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
	   <thead>
		<tr>
		  <th>Id</th>
		  <th>Candidate Name</th>
		  <th>Position</th>
		  <th>Status</th>
		  <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $candid=$userid;
	  $sel=$con->query("select * from staff_master where candid_id='$candid'");
	  $fet=$sel->fetch();
	  $sid=$fet['id'];
	  
       $emp_sql=$con->query("SELECT *,d.tittle as dname,c.status as csts,c.id as id,dm.designation_name FROM candidate_form_details c left join jobdescription_master d on c.position=d.id left join designation_master dm on c.position=dm.id where c.id in(select candid_id from candidate_round_details where person_id='$sid')"); 
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
	  $dsgn_name = $emp_res['designation_name'];
      $position = $emp_res['position'];
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  
		  <td><?php echo $emp_res['first_name']; ?></td>
<?php 
  //if($position== is_numeric($position)){
	if($emp_res['csts']==19 || $emp_res['csts']==20  || $emp_res['csts']==22  || $emp_res['csts']==23  || $emp_res['csts']==40 ){
	  ?>
		  <td><?php echo $dsgn_name; ?></td>
		  
  <?php } else{ ?>
  
           <td><?php echo $emp_res['dname']; ?></td>
  <?php } ?>
  
  
		<?php 
		$csel=$con->query("select status from candidate_round_details where candid_id='$emp_id' and person_id='$sid'");
		
		$cfet=$csel->fetch();
		$cstatus=$cfet['status'];
		
		?>
	
<td>
<?php  
 if(($emp_res['csts'] == 3))
{
echo '<span style="color:orange;text-align:center;"><b>PENDING</b></span>';
}

if(($emp_res['csts']==1))  
{
echo '<span style="color:blue;text-align:center;"><b>Waiting List</b></span>';

}

if(($emp_res['csts']==4))  
{
echo '<span style="color:green;text-align:center;"><b>Question Allocated</b></span>';

}

if(($emp_res['csts']==7))  
{
echo '<span style="color:red;text-align:center;"><b>Rejected</b></span>';

}

if(($emp_res['csts']==5))  
{
echo '<span style="color:orange;text-align:center;"><b> PENDING </b></span>';
}
if(($emp_res['csts']==8) || ($emp_res['csts']==41))  
{
echo '<span style="color:green;text-align:center;"><b> Selected </b></span>';
}
if(($emp_res['csts']==9) || ($emp_res['csts']==12))  
{
echo '<span style="color:red;text-align:center;"><b> Rejected </b></span>';
}
if(($emp_res['csts']==13))  
{
echo '<span style="color:green;text-align:center;"><b> Selected </b></span>';
}
if(($emp_res['csts']==15))  
{
echo '<span style="color:red;text-align:center;"><b> Rejected </b></span>';
}

if(($emp_res['csts']==16))  
{
echo '<span style="color:red;text-align:center;"><b>Selected by MD</b></span>';

}

if(($emp_res['csts']==18))  
{
echo '<span style="color:red;text-align:center;"><b>MD Level Rejected</b></span>';

}
if(($emp_res['csts']==19))  
{
echo '<span style="color:red;text-align:center;"><b>Application Form Sent</b></span>';

}
if(($emp_res['csts']==20))  
{
echo '<span style="color:red;text-align:center;"><b>Waiting For Document Approve</b></span>';

}
if(($emp_res['csts']==22))  
{
echo '<span style="color:green;text-align:center;"><b>Document Approved</b></span>';

}
if(($emp_res['csts']==23))  
{
echo '<span style="color:blue;text-align:center;"><b>Staff Type allocated</b></span>';

}

if(($emp_res['csts']==32))  
{
echo '<span style="color:blue;text-align:center;"><b>Rejected</b></span>';

}
if(($emp_res['csts']==35))  
{
echo '<span style="color:blue;text-align:center;"><b>HR Level Selected</b></span>';

}
if(($emp_res['csts']==37))  
{
echo '<span style="color:blue;text-align:center;"><b>HR Level Rejected</b></span>';

}
 ?>		  
 </td>
		
		  <td><?php if($cstatus == 3){
		 ?>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="technical1_insert(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-plus"></i> Enter Feedback</button>
		 <?php }  ?>
		 <?php  if($cstatus == 14){ ?>
		   <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="technical1_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
	<?php } ?>
	   <?php  if($cstatus == 13|| $cstatus ==15){?> 
	   <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="technical1_view(<?php echo $emp_res['id']; ?>)"> View</button>
	 <?php } ?>
		 </td>
      </tr>
      <?php
      
	  $i++;
	  }
      ?>
      </tbody>
      </table>
<?php 
	}
else if(($userrole=='R008' && $userid=='48') || ($userrole=='R008' && $userid=='4'))//Accounts
{  ?>
	<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
	   <thead>
		<tr>
		  <th>Id</th>
		  <th>Candidate Name</th>
		  <th>Position</th>
		  <th>Status</th>
		  <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $candid=$userid;
	  $sel=$con->query("select * from staff_master where candid_id='$candid'");
	  $fet=$sel->fetch();
	  $sid=$fet['id'];
	  
       $emp_sql=$con->query("SELECT *,d.tittle as dname,c.status as csts,c.id as id,dm.designation_name FROM candidate_form_details c left join jobdescription_master d on c.position=d.id left join designation_master dm on c.position=dm.id where c.id in(select candid_id from candidate_round_details where person_id='$sid')"); 
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
	  $dsgn_name = $emp_res['designation_name'];
      $position = $emp_res['position'];
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  
		  <td><?php echo $emp_res['first_name']; ?></td>
<?php 
  //if($position== is_numeric($position)){
	if($emp_res['csts']==19 || $emp_res['csts']==20  || $emp_res['csts']==22  || $emp_res['csts']==23  || $emp_res['csts']==40 ){
	  ?>
		  <td><?php echo $dsgn_name; ?></td>
		  
  <?php } else{ ?>
  
           <td><?php echo $emp_res['dname']; ?></td>
  <?php } ?>

  
  
		<?php 
		$csel=$con->query("select status from candidate_round_details where candid_id='$emp_id' and person_id='$sid'");
		
		$cfet=$csel->fetch();
		$cstatus=$cfet['status'];
		
		?>
	
<td>
<?php  
 if(($emp_res['csts'] == 3))
{
echo '<span style="color:orange;text-align:center;"><b>PENDING</b></span>';
}

if(($emp_res['csts']==1))  
{
echo '<span style="color:blue;text-align:center;"><b>Waiting List</b></span>';

}

if(($emp_res['csts']==4))  
{
echo '<span style="color:green;text-align:center;"><b>Question Allocated</b></span>';

}

if(($emp_res['csts']==7))  
{
echo '<span style="color:red;text-align:center;"><b>Rejected</b></span>';

}

if(($emp_res['csts']==5))  
{
echo '<span style="color:orange;text-align:center;"><b> Selected </b></span>';
}
if(($emp_res['csts']==8))  
{
echo '<span style="color:green;text-align:center;"><b> Selected </b></span>';
}
if(($emp_res['csts']==9) || ($emp_res['csts']==12))  
{
echo '<span style="color:red;text-align:center;"><b> Rejected </b></span>';
}
if(($emp_res['csts']==13))  
{
echo '<span style="color:green;text-align:center;"><b> Selected </b></span>';
}
if(($emp_res['csts']==15))  
{
echo '<span style="color:red;text-align:center;"><b> Rejected </b></span>';
}

if(($emp_res['csts']==16))  
{
echo '<span style="color:red;text-align:center;"><b>Selected by MD</b></span>';

}

if(($emp_res['csts']==18))  
{
echo '<span style="color:red;text-align:center;"><b>MD Level Rejected</b></span>';

}
if(($emp_res['csts']==19))  
{
echo '<span style="color:red;text-align:center;"><b>Application Form Sent</b></span>';

}
if(($emp_res['csts']==20))  
{
echo '<span style="color:red;text-align:center;"><b>Waiting For Document Approve</b></span>';

}
if(($emp_res['csts']==22))  
{
echo '<span style="color:green;text-align:center;"><b>Document Approved</b></span>';

}
if(($emp_res['csts']==23))  
{
echo '<span style="color:blue;text-align:center;"><b>Staff Type allocated</b></span>';

}

if(($emp_res['csts']==32))  
{
echo '<span style="color:blue;text-align:center;"><b>Rejected</b></span>';

}
if(($emp_res['csts']==35))  
{
echo '<span style="color:blue;text-align:center;"><b>HR Level Selected</b></span>';

}
if(($emp_res['csts']==37))  
{
echo '<span style="color:blue;text-align:center;"><b>HR Level Rejected</b></span>';

}
if(($emp_res['csts']==41))  
{
echo '<span style="color:green;text-align:center;"><b>Selected</b></span>';

}
 ?>		  
 </td>
		
		  <td><?php if($cstatus == 3){
		 ?>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="acc_insert(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-plus"></i> Enter Feedback</button>
		 <?php }  ?>
		 <?php  if($cstatus == 14){ ?>
		   <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="acc_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
	<?php } ?>
	   <?php  if($cstatus == 13 || $cstatus ==8 || $cstatus ==9){?> 
	   <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="acc_view(<?php echo $emp_res['id']; ?>)"> View</button>
	 <?php } ?>
		 </td>
      </tr>
      <?php
      
	  $i++;
	  }
      ?>
      </tbody>
      </table>
<?php 
	}
?>

<!-- /.content -->
</div>
  <script>
	$(document).ready(function() {
		$('#example1').DataTable({
				//responsive: true
				    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
		});
	});
  </script>
<script>
		function add_employee()
    {
    $.ajax({
    type:"POST",
    url:"qvision/interview_feedback/interview_feedback.php",
    success:function(data){
     $("#main_content").html(data);
    }
    })
  }
  
    function question_edit(v){
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/feedback_edit.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
function technical_edit(v){
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/technical_edit.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
 function technical1_edit(v){
		//lert(v);
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/final_technical_edit.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
   function technical1_view(v){
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/final_technical_view.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
    function feedback_view(v){
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/feedback_view.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}

    function feedback_insert(v){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/feedback_insert.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}

    function technical1_insert(v){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/finaltechnical_insert.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
} 
function acc_insert(v){
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/accounts_insert.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
  function acc_view(v){
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/accounts_view.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
  function md_insert(v){
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/md_insert.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
  function recruiter_insert(v){
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/recruiter_insert.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
  function md_view(v){
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/md_view.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
function md_edit(v){
		
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/md_edit.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
function admin_view(v)
{
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/admin_view.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}

function hr_insert(v){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/hr_insert.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}
 function hr_view(v){
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/hr_view.php?id="+v,
	success:function(data)
	{
		  $("#main_content").html(data);
	}
	})
}

function mail_Send(id)
{
	$.ajax({
	type:"POST",
	url:"qvision/interview_feedback/mail_send.php?id="+id,
	success:function(data)
	{
		if(data==0)
		{
			alert("Mail Not sent to candidate");
		window.location.href="index.php";
		}
	else
	{
		alert("Mail has been sent to candidate");
		window.location.href="index.php";
		
	}
	}
	})
}
</script>