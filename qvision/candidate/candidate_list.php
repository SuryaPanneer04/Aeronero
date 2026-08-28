<?php
require '../../connect.php';
include('../../user.php');
$userrole=$_SESSION['userrole'];
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


/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}
/* .btn-danger {
    background-color: #1da348;
    border-color: #1da348;
} */
/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 513px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 400px;
  width:500px;
  padding: 10px;
  background-color: #ffffff;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 25px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
   
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
 
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

/* Add height to Textarea */
.area{
	height: 305px !important;
}
</style>
<div id="table_view">
 <div class="card card-primary">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Interview candidates List</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
	</section>
    <!-- Main content -->
    <!-- <section class="content"> -->
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
    <div class="card-body box-profile">

    <table id="example1" class="table table-bordered">
	   <thead>
		<tr>
		  <th>Id</th>
		  <th>Name</th>
		  <th>Scheduled Date</th>
		  <!-- th>Position</th -->
		  <th>Phone</th>
		  <th>Mail</th>
		  <th>Status</th>	  
		  <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
	  $emp_sql=$con->query("SELECT *,c.id as cid,c.status as status,c.interview_round_level FROM `candidate_form_details` c  left join jobdescription_master d on c.position=d.id left join interview_schedule_detail i on c.resource_id=i.resource_id  where c.old_status=0 and (c.status=2 or c.status=3 or c.status=4 or c.status=6 or c.status=20 or c.status=5 or c.status=7 or c.status=8 or c.status=9 or c.status=13 or c.status=14 or c.status=15 or c.status=16 or c.status=17 or c.status=18 or c.status=19 or c.status=20 or c.status=22 or c.status=23  or c.status=30 or c.status=35 or c.status=37 or c.status=40 or c.status=41 or c.status=12 or c.status=100 or c.status=60 or c.status=70 or c.status=101 ) order by c.id desc");
      $i=1;
	  $no_of_rows = $emp_sql->rowCount(); 
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
	  
      $emp_id = $emp_res['id'] ;
	  $cid = $emp_res['cid'] ;
	  
	  
	  $correct_sta=$con->query("SELECT c.round_id,i.name,c.candid_id,f.first_name,c.status as canstatus FROM `candidate_round_details` c left join interview_rounds i on c.round_id=i.id join candidate_form_details f on c.candid_id=f.id where f.id='$cid' and (c.status=3  or c.status=101)order by  c.id desc limit 1");
	  //echo "SELECT c.round_id,i.name,c.candid_id,f.first_name,c.status as canstatus FROM `candidate_round_details` c left join interview_rounds i on c.round_id=i.id join candidate_form_details f on c.candid_id=f.id where f.id='$cid' and (f.status=3  or f.status=101)order by  c.id desc limit 1";
	  $corfet=$correct_sta->fetch();
	  $sta = '';
	  $canstatus = '';
	  if($corfet){
	  $sta=$corfet['name'];
	  $canstatus=$corfet['canstatus'];
	  }
	  $interview_round = $con->query("SELECT count(*) as round_count FROM `interview_round_level` WHERE candidate_id='$cid'");
	  $round = $interview_round->fetch();

	  $check_accept = $con ->query("select id,status,count(*) as accept_cnt from candidate_accept_reject where candidateID='$cid'");
	  $checking = $check_accept->fetch();
      ?>
      <tr>
	      <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['first_name']." ".$emp_res['last_name']; ?></td>
		  <td><?php echo $emp_res['interview_date']; ?></td>
		  <!-- td>< ?php echo $emp_res['position']; ?></td -->
		  <td><?php echo $emp_res['phone']; ?></td>
		  <td><?php echo $emp_res['mail']; ?></td>

		  <td>
<?php 

 if(($emp_res['status']==1 || $emp_res['status']==4 || $emp_res['status']==100 || $emp_res['status']==40 || $emp_res['status']==41 || $checking['status']==1)&& $emp_res['status']!=19)
{

echo '<span style="color:green;text-align:center;"><b>Selected</b></span>';
}
// if(($emp_res['status']==100) && ($checking['status']==1))
// {
// 	echo '<span style="color:green;text-align:center;"><b>Selected</b></span>';

// }
if(($emp_res['status']==12 ) && ($checking['status']==0))  
{
echo '<span style="color:red;text-align:center;"><b>Rejected</b></span>';

}
if(($emp_res['status']==0))  
{
echo '<span style="color:green;text-align:center;"><b>SELECTED FOR  TECHNICAL</b></span>';

}
if(($emp_res['status']==1))  
{
echo '<span style="color:blue;text-align:center;"><b>Waiting List</b></span>';

}
if(($emp_res['status']==2))  
{
echo '<span style="color:blue;text-align:center;"><b>Candidate form submitted</b></span>';

}
if(($emp_res['status']==3 || $emp_res['status']==101))  
{
echo '<span style="color:red;text-align:center;"><b>Candidate Selected For ' .$sta.' level </b></span>';

}
if(($emp_res['status']==4))  
{
echo '<span style="color:green;text-align:center;"><b>Question Allocated</b></span>';

}
if(($emp_res['status']==6))  
{
echo '<span style="color:blue;text-align:center;"><b>Technical one Waiting List</b></span>';

}
if(($emp_res['status']==7))  
{
echo '<span style="color:red;text-align:center;"><b>HR level Selected / Sales Level Rejected</b></span>';

}
if(($emp_res['status']== 8))  
{
echo '<span style="color:green;text-align:center;"><b>HR level Selected / Accounts level Selected</b></span>';

}
if(($emp_res['status']== 9))  
{
echo '<span style="color:green;text-align:center;"><b>HR level Selected / Accounts level rejected</b></span>';
}
if(($emp_res['status']==5))  
{
echo '<span style="color:green;text-align:center;"><b>HR level Selected / Sales level selected   </b></span>';
}

if(($emp_res['status']==13))  
{
echo '<span style="color:green;text-align:center;"><b>HR level Selected / Service Level Selected </b></span>';

}
if(($emp_res['status']==14))  
{
echo '<span style="color:red;text-align:center;"><b>Technical two Waiting List</b></span>';

}
if(($emp_res['status']==15))  
{
echo '<span style="color:red;text-align:center;"><b>HR level Selected / Service Level Rejected</b></span>';

}
if(($emp_res['status']==16))  
{
echo '<span style="color:green;text-align:center;"><b>MD Approved</b></span>';

}
if(($emp_res['status']==17))  
{
echo '<span style="color:red;text-align:center;"><b>MD Level Waiting List</b></span>';

}
if(($emp_res['status']==18))  
{
echo '<span style="color:red;text-align:center;"><b>MD Level Rejected</b></span>';

}
if(($emp_res['status']==19))  
{
echo '<span style="color:darkblue;text-align:center;"><b> Offer Letter Send</b></span>';

}
if(($emp_res['status']==20))  
{
echo '<span style="color:red;text-align:center;"><b>Waiting For Document Approve</b></span>';

}
if(($emp_res['status']==22))  
{
echo '<span style="color:red;text-align:center;"><b>Document Approved</b></span>';

}
if(($emp_res['status']==23))  
{
echo '<span style="color:blue;text-align:center;"><b>Staff Type allocated</b></span>';

}
if(($emp_res['status']==24))  
{
echo '<span style="color:blue;text-align:center;"><b>Staff</b></span>';

}
if(($emp_res['status']==30))  
{
echo '<span style="color:blue;text-align:center;"><b>Waiting For Assessment Approve</b></span>';

}
if(($emp_res['status']==32)&& ($checking['status']==0))  
{
echo '<span style="color:blue;text-align:center;"><b>Rejected</b></span>';

}
if(($emp_res['status']==35))  
{
echo '<span style="color:green;text-align:center;"><b>HR Level Selected</b></span>';

}
if(($emp_res['status']==37))  
{
echo '<span style="color:red;text-align:center;"><b>HR Level Rejected</b></span>';

}
if(($emp_res['status']==60))  
{
echo '<span style="color:green;text-align:center;"><b>Select By HOD</b></span>';

}
if(($emp_res['status']==70))  
{
echo '<span style="color:red;text-align:center;"><b>Rejected by HOD</b></span>';

}
// if(($emp_res['status']==40 || $emp_res['status']==100) && ($checking['status']==1))  
// {
// echo '<span style="color:green;text-align:center;"><b>Selected</b></span>';

// }
 
?>
</td>
	<td>
	<?php 
		  if($emp_res['status'] == 5 || $emp_res['status'] == 8 || $emp_res['status'] == 13 || $emp_res['status'] == 2 || $emp_res['status'] == 35)
		  {
			  ?>
			  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_edit(<?php echo $emp_res['cid']; ?>)"> Allocate</button>
		  <?php
		  }
		  else if($emp_res['status'] == 4 || $emp_res['status'] == 6 || $emp_res['status'] == 3 || $emp_res['status'] == 14 || $emp_res['status'] == 15 ||  $emp_res['status'] == 17|| $emp_res['status'] == 18|| $emp_res['status'] == 23 || $emp_res['status'] == 24 || $emp_res['status'] == 30 || $emp_res['status'] == 32 || $emp_res['status'] == 35 || $emp_res['status'] == 37 || $emp_res['status'] == 12)
		  {
			 ?> 
			 <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_view(<?php echo $emp_res['cid']; ?>)"> View</button>
			
			 <?php
			 //Check whether the Manager accept or reject the candidate.
		   if($checking['accept_cnt'] > 0 && $checking['status'] == 1){
			?>
			<button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_accept_reject(<?php echo $emp_res['cid']; ?>,<?php echo $checking['id']; ?>)"> Allocate Interview</button> 
		  
			<?php } ?>

		<?php	  
		  }
		 else if( $emp_res['status'] == 5 || $emp_res['status'] == 8 || $emp_res['status'] == 13 || $emp_res['status'] == 16 || $emp_res['status'] == 40 || $emp_res['status'] == 41)
		  {
			 ?> 
			 <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_view(<?php echo $emp_res['cid']; ?>)"> View</button>
			 <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="joining_detail(<?php echo $emp_res['cid']; ?>)"> Initiate offer Letter</button>
		<?php	  
		  }
		  else if($emp_res['status'] == 22)
		  {
			 ?> 
			 <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_view(<?php echo $emp_res['cid']; ?>)"> View</button>
			<button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="staff_code(<?php echo $emp_res['cid']; ?>)"> Staff code allocation</button>
		
			<button class="btn btn-danger btn-sm" onclick="openForm(<?php echo $emp_res['cid']; ?>)"> Reject</button>

		<?php	  
		  }
		  elseif($emp_res['status'] == 19 || $emp_res['status'] == 20 || $emp_res['status'] == 21 )
		   {
			 ?> 
			 <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_view(<?php echo $emp_res['cid']; ?>)"> View</button> 
		<?php
			 //Check whether the Manager accept or reject the candidate.
		   if($checking['accept_cnt'] > 0 && $checking['status'] == 1){
			?>
			<button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_accept_reject(<?php echo $emp_res['cid']; ?>,<?php echo $checking['id']; ?>)"> Allocate Interview</button> 
		  
			<?php } ?>
			
			<!-- button class="btn btn-danger btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="rejection(<?php echo $emp_res['cid']; ?>)">Reject</button> -->
			
		<?php	  
		  } else {
			?>
			<button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_view(<?php echo $emp_res['cid']; ?>)"> View</button>
			<?php
		  }
?>
	</td>
      </tr>
      <?php
	  $i++;
      }
      ?>
 <input type="hidden" id='rowcount' name='rowcount' value="<?php echo $no_of_rows; ?>" >
      </tbody>
      </table>
	  </div>
	  </div>


	  <div class="form-popup" id="myForm">
		  <form action="" class="form-container">
			<h3>Reject Remark</h3>
		<textarea class="form-control area" placeholder="Enter Remark" name="remark" id ="remark" required> </textarea> <br>
          <input type="hidden" id="rejectID" name="rejectID">

			<button type="button" class="btn" id="popup" onclick="reject_doc()">Send Mail</button>
			<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
		  </form>
		</div>

	  
<script>
	$(document).ready(function() {
		$('#example1').DataTable({
			"paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
		});
	});

	var rowCount = $('#rowcount').val()


	function candidate_edit(v)
	{
	$.ajax({
	type:"POST",
	url:"qvision/candidate/candidate_round_allocation.php?id="+v,
	success:function(data)
	{
		$("#table_view").html(data);
	}
	})
    }
	  
	function candidate_view(v)
	{	 
	$.ajax({
	type:"POST",
	url:"qvision/candidate/candidate_view.php?id="+v,
	success:function(data)
	{
		$('#table_view').html(data);
	}
	})
    }
	  
	function send_application(v)
	{
	$.ajax({
	type:"POST",
	url:"qvision/candidate/send_application_form.php?id="+v,
	success:function(data)
	{
		alert("Application form sent successfully");
		interview_candidate_list();
	}
	})
	}
	function joining_detail(v)
	{
	$.ajax({
	type:"POST",
	url:"qvision/candidate/joining_detail.php?id="+v,
	success:function(data)
	{
		$('#table_view').html(data);
	}
	})
	}
	 function staff_code(v)
	{
	$.ajax({
	type:"POST",
	url:"qvision/candidate/staff_code_allocation.php?id="+v,
	success:function(data)
	{
		$('#table_view').html(data);
	}
	})
	}
	
	 function rejection(v)
	{
	$.ajax({
	type:"POST",
	url:"qvision/candidate/candidate_rejection.php?id="+v,
	success:function(data)
	{
		$('#table_view').html(data);
	}
	})
	}


function openForm(v) {
  document.getElementById("myForm").style.display = "block";
  $('#remark').val('');

  document.getElementById('rejectID').value=v
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}	

function reject_doc()
{
	let e = $('#rejectID').val();
	let reject = $('#remark').val();

	// Prevent multiple clicks
	$('#popup').prop('disabled', true);
	$('#popup').text('Sending...');

	$.ajax({
	type:"POST",
	url:"qvision/Recruitment/document_reject.php?id="+e+"&reject_remark="+reject,
	success:function(data)
	{
		$('#popup').prop('disabled', false);
		$('#popup').text('Send Mail');
		
		if(data==0)
		{
			alert("Mail Sent Successfully")
			interview_candidate_list()
		}
		else{
			alert("Failed")
			interview_candidate_list()
		}
	},
	error:function()
	{
		$('#popup').prop('disabled', false);
		$('#popup').text('Send Mail');
		alert("Error in sending mail");
	}
  })		  
}

function candidate_accept_reject(v,id)
	{	 
	$.ajax({
	type:"POST",
	url:"qvision/candidate/candidate_approve.php?id="+v+ "&accept_id="+id,
	success:function(data)
	{
		$('#table_view').html(data);
	}
	})
    }
</script>