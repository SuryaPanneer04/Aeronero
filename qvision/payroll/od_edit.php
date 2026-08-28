<?php
Session_start();
require '../../connect.php';
$user_id=$_SESSION['userid'];
$id = $_REQUEST['id'];

$stmt = $con->prepare("SELECT a.*,a.location as visit_loc,b.* FROM manual_att a left JOIN staff_master b on (a.candidate_id=b.candid_id) WHERE a.id='$id'");
 
$stmt->execute();
$row = $stmt->fetch();
$travel_type=$row['travel_type'];
$candid_id=$row['candid_id'];
$date=$row['date'];
$newDate = date("d-m-Y", strtotime($date));
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
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


<div class="card card-primary">
<div class="card-header">
<h3 class="card-title"><font size="5">OD EDIT</font></h3>
 <a onclick="return back_od()" style="float: right;" data-toggle="modal" class="btn">Back</a>
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
    <td><select name="travel" id="travel" onchange="travelstatus(this.value)" class="form-control">
      <option value="<?php echo$rowt['id'];?>"><?php echo$rowt['travel_type'];?></option>
     <?php

        $emp_sql = $con->query("SELECT * FROM travel_master where travel_type!='$travel_typez'");
		
		
		
         $i = 1;
         while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
         ?>
       <option value="<?php echo $emp_res['id']; ?>"><?php echo $emp_res['travel_type']; ?></option>
       <?php
        }
         ?>
    </select></td>
    </tr>
 <tr id="dep1">
		<td>Kms</td>
		<td colspan="5">
		<input type="text" class="form-control" value="<?php echo $row['kms']; ?>" placeholder="Enter Kms" id="kms" name="kms"></td>	
     </tr>
     <tr>
     <td>Customer Name</td>
    <td colspan="5"><input type="text" class="form-control" value="<?php echo $row['customer_name']; ?>" placeholder="Enter Customer Name" id="Customer_name" name="Customer_name"></td>
    </tr>

    <tr>
    <td>Location</td>
    <td colspan="5"><input type="text" class="form-control" value="<?php echo $row['visit_loc']; ?>" placeholder="Enter Location" id="Location" name="Location"></td>
    </tr>
    <tr>
    <td>Purpose of Visit</td>
    <td colspan="5"><input type="text" class="form-control" value="<?php echo $row['purpose']; ?>" placeholder="Enter Purpose" id="Purpose" name="Purpose"></td>
    </tr>
										
	<!--<tr>
    <td>Distance</td>
    <td colspan="5"><input type="text" class="form-control" placeholder="Enter Distance" id="distance" name="distance"></td>
    </tr>-->
	<tr>
    <td>Amount</td>
    <td colspan="5"><input type="text" class="form-control" value="<?php echo $row['amount']; ?>" placeholder="Enter Amount" id="amount" name="amount"></td>
    </tr>
     <tr id="dep2">
		<td>Attach File</td>
		<td colspan="5">
		<input type="file" class="form-control"  id="attachfile_1" name="attachfile[]"></td>	
     </tr>
    <tr>
    <td colspan="6"><input type="submit" name="submit" class="btn btn-success submitBtn" value="SAVE"></td>
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
                 url: '/ssinfo1/qvision/payroll/od_update.php',
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
				processData: false,
                success:function(data)  
                {  
                    alert('Claim updated Successfully'); 
                  
				  iozd()
                }  
           });  
      });  
	   }); 

	
 function back_od()
   {
   $.ajax({
   type: "POST",
   url: "qvision/payroll/od.php",
   success: function (data) {
   $("#main_content").html(data);
   }
  })
 }
 
$( document ).ready(function() {
   //alert( "ready!" );


  function travelstatus(value)
{
	//alert(value)
if(value=='1')
{

document.getElementById('dep1').style.visibility = "visible";
document.getElementById('dep2').style.visibility = "visible";

}
else
{

document.getElementById('dep1').style.visibility = "collapse";
document.getElementById('dep2').style.visibility = "collapse";

}
}

});
</script>
