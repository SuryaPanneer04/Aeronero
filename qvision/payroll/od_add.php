<?php
Session_start();
require '../../connect.php';
$user_id=$_SESSION['userid'];
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
<h3 class="card-title"><font size="5">  Add Claim</font></h3>
 <a onclick="return back_od()" style="float: right;" data-toggle="modal" class="btn">Back</a>
</div>

<form method="POST" id="fupForm" name="fupForm" action="">

 <table class="table table-bordered">
 <tr>
    <td>Employee Name</td>
	<?php
	$stmts = $con->prepare("SELECT user_id,full_name,candidate_id FROM z_user_master where user_id='$user_id'");
									
											   $stmts->execute(); 
                                               $rows = $stmts->fetch();
											   $emp_name=$rows['full_name'];
											   $candid_id=$rows['candidate_id'];
											   ?>
    <td><input type="text" name="Employee_name" value="<?php echo $emp_name;?>" id="Employee_name" class="form-control" readonly>
    <td><input type="hidden" name="candidate_id" value="<?php echo $candid_id;?>" id="candidate_id" class="form-control" readonly>
     </td>
    </tr>	
   <tr>
    <td>Date</td>
    <td colspan="5"><input type="date" class="form-control"  id="date" name="date" ></td>
   </tr>
   <tr>
    <td>Travel Type</td>
    <td><select name="travel" id="travel" onchange="travelstatus(this.value)" class="form-control">
      <option value="">Select Travel Type</option>
     <?php
        $emp_sql = $con->query("SELECT * FROM travel_master ");
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
		<input type="text" class="form-control" placeholder="Enter Kms" id="kms" name="kms"></td>	
     </tr>
     <tr>
     <td>Customer Name</td>
    <td colspan="5"><input type="text" class="form-control" placeholder="Enter Customer Name" id="Customer_name" name="Customer_name"></td>
    </tr>

    <tr>
    <td>Location</td>
    <td colspan="5"><input type="text" class="form-control" placeholder="Enter Location" id="Location" name="Location"></td>
    </tr>
    <tr>
    <td>Purpose of Visit</td>
    <td colspan="5"><input type="text" class="form-control" placeholder="Enter Purpose" id="Purpose" name="Purpose"></td>
    </tr>
										
	<!--<tr>
    <td>Distance</td>
    <td colspan="5"><input type="text" class="form-control" placeholder="Enter Distance" id="distance" name="distance"></td>
    </tr>-->
	<tr>
    <td>Amount</td>
    <td colspan="5"><input type="text" class="form-control" placeholder="Enter Amount" id="amount" name="amount"></td>
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
                 url: '/ssinfo1/qvision/payroll/insert_od.php',
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
				processData: false,
                success:function(data)  
                {  
                    alert('Claim Requested Successfully'); 
                  
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
</script>
