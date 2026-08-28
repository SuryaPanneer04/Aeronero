

<?php
require '../../connect.php';
require '../../user.php';
$userid = $_SESSION['userid'];
  $userrole = $_SESSION['userrole'];
$candidateid = $_SESSION['candidateid'];
 $id = $_REQUEST['id'];

$stmt = $con->prepare("SELECT a.file as file,a.status as status,a.travel_type as travel_type,a.candidate_id as candid_id,a.kms as kms,a.amount as amount,a.customer_name as customer_name,a.purpose as purpose,a.date as date,a.location as visit_loc FROM claim_request a left JOIN staff_master b on (a.candidate_id=b.candid_id) WHERE a.id='$id'");

$stmt->execute();
$row = $stmt->fetch();
$travel_type=$row['travel_type'];
 $candid_id=$row['candid_id'];
 $status=$row['status'];
$date=$row['date'];
$newDate = date("d-m-Y", strtotime($date));
?>
<head>
    <link rel="stylesheet" href="qvision/commonstyle.css">
    </head>
		<style>
.card-primary:not(.card-outline)>.card-header{
background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
.btn-dark{
	background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black !important;
}
</style>

<div class="card card-info">

    <div class="card-header" style="background-color:#ff8b3d;">

        <center><h3 class="card-title"><b>OD VIEW</b></h3></center>
        <a onclick="back_od()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
    </div>


<form method="POST" id="fupForm" name="fupForm" action="">

 <table class="table table-bordered">
 <tr>
    <td>Employee Name</td>
	<?php
	$stmts = $con->prepare("SELECT user_id,full_name,candidate_id FROM z_user_master where candidate_id='$candid_id'");
									//echo "SELECT user_id,full_name,candidate_id FROM z_user_master where user_id='$user_id'";
											   $stmts->execute(); 
                                               $rows = $stmts->fetch();
											   $emp_name=$rows['full_name'];
											   $candid_id=$rows['candidate_id'];
											   ?>
    <td><input type="text" name="Employee_name" value="<?php echo $emp_name?>" id="Employee_name" class="form-control" readonly>
	<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $id; ?>"readonly>
     </td>
    </tr>	
   <tr>
    <td>Date</td>
    <td colspan="5"><input type="text" class="form-control"  id="date" name="date" value="<?php echo $newDate; ?>" readonly></td>
   </tr>
   <tr>
    <td>Travel Type</td>
	<?php
	
	$stmtt = $con->prepare("SELECT * FROM travel_master where id='$travel_type'");
									
											   $stmtt->execute(); 
                                               $rowt = $stmtt->fetch();
											   $travel_typez=$rowt['travel_type'];
											   ?>
    <td colspan="5"><input type="text" class="form-control" value="<?php echo $travel_typez; ?>" placeholder="Enter Amount" id="travel" name="travel" readonly></td>
    </tr>
 <tr id="dep3">
		<td>Kms</td>
		<td colspan="5">
		<input type="text" class="form-control" value="<?php echo $row['kms']; ?>" placeholder="Enter Kms" id="kms" name="kms" readonly></td>	
     </tr>
     <tr>
     <td>Customer Name</td>
    <td colspan="5"><input type="text" class="form-control" value="<?php echo $row['customer_name']; ?>" placeholder="Enter Customer Name" id="Customer_name" name="Customer_name" readonly></td>
    </tr>

    <tr>
    <td>Location</td>
    <td colspan="5"><input type="text" class="form-control" value="<?php echo $row['visit_loc']; ?>" placeholder="Enter Location" id="Location" name="Location" readonly></td>
    </tr>
    <tr>
    <td>Purpose of Visit</td>
    <td colspan="5"><input type="text" class="form-control" value="<?php echo $row['purpose']; ?>" placeholder="Enter Purpose" id="Purpose" name="Purpose" readonly></td>
    </tr>

<?php //echo$candidateid; ?>
		
	<!--<tr>
    <td>Distance</td>
    <td colspan="5"><input type="text" class="form-control" placeholder="Enter Distance" id="distance" name="distance"></td>
    </tr>-->
	<tr>
    <td>Amount</td>
    <td colspan="5"><input type="text" class="form-control" value="<?php echo $row['amount']; ?>" placeholder="Enter Amount" id="amount" name="amount" readonly></td>
    </tr>
    <tr id="dep3">
		<td>Attach File</td>
		
		  <td colspan="5"><a href="qvision/claim/Uploads/<?php echo $row['file']; ?>" download="<?php echo $row['file']; ?>"><?php echo $row['file']; ?></a>	</td>
     </tr>
<?php
	/*
	$stmtd = $con->prepare("SELECT dep_id FROM staff_master where candid_id='$candidateid'");
									
											   $stmtd->execute(); 
                                               $rowd = $stmtd->fetch();
											   $dep_id=$rowd['dep_id'];
		$stmte = $con->prepare("SELECT candid_id FROM staff_master where dep_id='$dep_id' and head_status='1'");
      //  echo "SELECT candid_id FROM staff_master where dep_id='$dep_id' and head_status='1'";		
			   $stmte->execute(); 
			   $rowe = $stmte->fetch();
			   $candid_approve_id=$rowe['candid_id'];	
       */
      
       



       // First Query: Get dep_id
// First Query: Get dep_id
$stmtd = $con->prepare("SELECT dep_id FROM staff_master WHERE candid_id = ?");
$stmtd->execute([$candidateid]);
$rowd = $stmtd->fetch(PDO::FETCH_ASSOC);

if (!$rowd) {
    die("Error: No department found for candidate ID $candidateid.");
}

$dep_id = $rowd['dep_id'];

// Second Query: Get candid_id of department head
$stmte = $con->prepare("SELECT candid_id FROM staff_master WHERE dep_id = ? AND head_status = '1'");
$stmte->execute([$dep_id]);
$rowe = $stmte->fetch(PDO::FETCH_ASSOC);

if (!$rowe) {
    die("Error: No head found for department ID $dep_id.");
}

$candid_approve_id = $rowe['candid_id'];

               



           


//echo $candidateid;
//echo $candid_approve_id;
//if($status==1 && $candidateid == $candid_approve_id){  
/////////////////////  For Temp use to approve the claim for Dec month claim only ./////////////////////
if($status==1 && $userrole == 'R008'){

	
?><tr>
      <td colspan="6"><center>
      <input type="button" class="btn btn-success btn-md"   name="Approve" onclick="od_approve()" value="Approve">
	  <input type="button" class="btn btn-danger btn-md"   name="Reject" onclick="od_reject()" value="Reject">  </center>  </td>
  </tr>
  <?php 	
}


?>
	

	 </table>
</form>
<br>
</div>

<script>
  function ShowHideDiv(z) {
		//alert(z);
			  if(z=='cash')
			{
			
        var ddlPassport = document.getElementById("fupForm");
    //    var dvPassport = document.getElementById("dep4");
     
       
       
      
      document.getElementById("dep4").style.display = "revert";
       
		
			}
			else
			{
      // var dvPassport = document.getElementById("dep4");
	  	
        document.getElementById('dep4').style.display = "none";
		
			} 
			if(z=='online')
			{
			
        var ddlPassport = document.getElementById("fupForm");
       document.getElementById('dep2').style.display = "revert";
       
      
     
       
		
			}
			else
			{
       document.getElementById("dep2").style.display = "none"; 
		
			} 
    }
</script>

<script>
 //function back_od()
   //{
  //claim_request
 //}
 
 
 function od_approve() {  
//debugger; 
    var id = $('#get_id').val();
    var data = $('form').serialize();
    var valuee = 2;
    
    // Append both id and appsts to the URL string
    var url = 'qvision/claim/od_approve_update.php?id=' + id + '&appsts=' + valuee;
    
    $.ajax({
        type: 'GET',
        data: data, // Send serialized form data as usual
        url: url, // Include id and appsts in the URL
        success: function(data) {
           
                alert("Update Successfully");
                back_od()
            
        }
    });
}

	function back_od() {
			  
			  
			  $.ajax({
                type: "POST",
                url: "qvision/claim/claim_fin_list.php",
                success: function (data)
                {
                    $("#main_content").html(data);
                }
            })
           
        }
	function od_reject() {
    var id = $('#get_id').val();
    var data = $('form').serialize();
    var valuess = 4;
    
    // Append both id and appsts to the URL string
    var url = 'qvision/claim/od_approve_update.php?id=' + id + '&appsts=' + valuess;
    
    $.ajax({
        type: 'GET',
        data: data, // Send serialized form data as usual
        url: url, // Include id and appsts in the URL
        success: function(data) {
           
                alert("Update Successfully");
				 back_od()
                //claim_request();
            }
        
    });
}

	
	$(document).ready(function(){  
		$("form[name='fupForm']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);
  
           $.ajax({  
                 url: 'qvision/claim/payment.php',
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
				processData: false,
                success:function(data)  
                {  
                    alert('Payment Added Successfully'); 
                  
				  claim_request()
                }  
           });  
      });  
	   }); 
	   
function od_fy_approve(){
		   var id = $('#get_id').val();
        var data = $('form').serialize();
        $.ajax({
            type: 'GET',
            data: data + "&" + "id=" + id,
            url:'qvision/claim/od_fyn_update.php',
            success: function (data)
            {
                if (data == 0)
                {
                    alert('Not updated');

                } else
                {
                    alert("Update Successfully");
                    claim_request()
                }

            }
        });
	   }
function od_fy_reject(){
		  var id = $('#get_id').val();
        var data = $('form').serialize();
        $.ajax({
            type: 'GET',
            data: data + "&" + "id=" + id,
            url:'qvision/claim/od_fyn_reject.php',
            success: function (data)
            {
                if (data == 0)
                {
                    alert('Not updated');

                } else
                {
                    alert("Update Successfully");
                    claim_request()
                }

            }
        });
	   }
function od_pur_approve(){
	 var id = $('#get_id').val();
        var data = $('form').serialize();
        $.ajax({
            type: 'GET',
            data: data + "&" + "id=" + id,
            url:'qvision/claim/od_pur_approve.php',
            success: function (data)
            {
                if (data == 0)
                {
                    alert('Not updated');

                } else
                {
                    alert("Update Successfully");
                    claim_request()
                }

            }
        });
}
function od_pur_reject(){
	 var id = $('#get_id').val();
        var data = $('form').serialize();
        $.ajax({
            type: 'GET',
            data: data + "&" + "id=" + id,
            url:'qvision/claim/od_pur_reject.php',
            success: function (data)
            {
                if (data == 0)
                {
                    alert('Not updated');

                } else
                {
                    alert("Update Successfully");
                    claim_request()
                }

            }
        });
}
</script>
