<?php
Session_start();
require '../../connect.php';
$user_id=$_SESSION['userid'];
 $id = $_REQUEST['id'];
$candid_iddd=$_SESSION['candidateid'];
$stmt = $con->prepare("SELECT a.file as file,a.travel_type as travel_type,a.candidate_id as candid_id,a.kms as kms,a.amount as amount,a.customer_name as customer_name,a.purpose as purpose,a.date as date,a.location as visit_loc,b.* FROM claim_request a left JOIN staff_master b on (a.candidate_id=b.candid_id) WHERE a.id='$id'");
 
$stmt->execute();
$row = $stmt->fetch();
$travel_type=$row['travel_type'];
$candid_id=$row['candid_id'];
$date=$row['date'];
$newDate = date("d-m-Y", strtotime($date));
?>
<head>
    <link rel="stylesheet" href="qvision/commonstyle.css">
    </head>
		<style>
.card-primary:not(.card-outline)>.card-header{
background-color:#009EE3 !important;
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

    <div class="card-header" style="background-color:#009EE3 !important;">

        <center><h3 class="card-title"><b>OD EDIT</b></h3></center>
        <a onclick="return back_od()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
    </div>

<form method="POST" id="fupForm" name="fupForm" action="">

 <table class="table table-bordered">
 <tr>
    <td>Employee Name</td>
	<?php
	$stmts = $con->prepare("SELECT user_id,full_name,candidate_id FROM z_user_master where candidate_id='$candid_iddd'");
					//echo "SELECT user_id,full_name,candidate_id FROM z_user_master where candidate_id='$candid_iddd'";
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
    <td>Claim Type</td>
    <td><input type="text" name="traveltpyee" id="traveltpyee" class="form-control" value="<?php echo $travel_type; ?>"></td>
    </tr>
    <tr>
    <td>Location</td>
    <td colspan="5"><input type="text" class="form-control" value="<?php echo $row['visit_loc']; ?>" placeholder="Enter Location" id="Location" name="Location"></td>
    </tr>
    <tr>
    <td>Purpose of Visit</td>
    <td colspan="5"><input type="text" class="form-control" value="<?php echo $row['purpose']; ?>" placeholder="Enter Purpose" id="Purpose" name="Purpose"></td>
    </tr>
	<tr>
    <td>Amount</td>
    <td colspan="5"><input type="text" class="form-control" value="<?php echo $row['amount']; ?>" placeholder="Enter Amount" id="amount" name="amount"></td>
    </tr>
	<tr id="dep2">
		<td>Attached File(s)</td>
		<td colspan="5">
            <?php
            $docs_stmt = $con->prepare("SELECT document_title, document_name FROM claim_document WHERE claim_id='$id'");
            $docs_stmt->execute();
            $documents = $docs_stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($documents) > 0) {
                echo "<table class='table table-sm table-bordered'><tr><th>Document Name</th><th>File</th></tr>";
                foreach($documents as $doc) {
                    echo "<tr><td>" . ($doc['document_title'] ? htmlspecialchars($doc['document_title']) : 'Document') . "</td>";
                    echo "<td><a href='qvision/claim/Uploads/".$doc['document_name']."' download='".$doc['document_name']."'>".$doc['document_name']."</a></td></tr>";
                }
                echo "</table>";
            } else if($row['file']) {
                echo "<a href='qvision/claim/Uploads/".$row['file']."' download='".$row['file']."'>".$row['file']."</a>";
            } else {
                echo "No documents attached.";
            }
            ?>
        </td>
     </tr>
    
    <tr>
    <td colspan="6"><center><input type="submit" name="submit" class="btn btn-success submitBtn" value="Update"></center></td>
    </tr>
										
	 </table>
</form>
<br>
</div>


<script>
 $(document).ready(function(){  
		$("form[name='fupForm']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);
  
           $.ajax({  
                 url: 'qvision/claim/od_update.php',
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
				processData: false,
                success:function(data)  
                {  
                    alert('Claim updated Successfully'); 
                  
				  back_od();
                }  
           });  
      });  
	   }); 

	
 function back_od()
   {

  $.ajax({
                type: "POST",
                url: "qvision/claim/od.php",
                success: function (data)
                {
                    $("#main_content").html(data);
                }
            })
 }
 
$( document ).ready(function() {
   travelstatus(document.getElementById('traveltpyee').value);
});

function travelstatus(value) {
    if(value == '1' || value == '4') {
        document.getElementById('dep1').style.visibility = "visible";
        document.getElementById('amount').setAttribute('readonly', 'readonly');
    } else {
        document.getElementById('dep1').style.visibility = "collapse";
        document.getElementById('amount').removeAttribute('readonly');
    }
}

function kms_cal(b) {
	
	var typeoftravel=document.getElementById('traveltpyee').value;
	if(typeoftravel==1){
    var a = 2.5;
    var result = a * b;
    document.getElementById("amount").value = result;
	}
	else if(typeoftravel==4)
	{
		var a = 7;
    var result = a * b;
    document.getElementById("amount").value = result;
	}
}
</script>
