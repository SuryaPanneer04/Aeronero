<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT a.*,b.* FROM new_client_master a left join new_plant_master b ON (a.id=b.client_id)where b.id='$id'"); 
//echo "SELECT a.*,b.*  FROM new_client_master a left join new_plant_master b ON (a.id=b.client_id)where b.id='$id'";

$stmt->execute(); 
$row = $stmt->fetch();
?>
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

<center><h3 class="card-title"><b>PLANT DETAILS</b></h3></center>
<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>
</div>

<form method="POST" name="form" id="form" action="">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">

	
<table class="table table-bordered" id="new_tab">
<tr>
<td>Client Org Name</td>
<td colspan="5">
<input type="text" class="form-control" id="txt_org_name" name="txt_org_name" value="<?php echo  $row['org_name'];?>" readonly></td>
</tr>
<tr>
<td>Client Org Type</td>
<td colspan="5">
<?php
$org_namee=$row['org_type'];
$stmts = $con->prepare("SELECT * FROM org_type_master where id='$org_namee'"); 
$stmts->execute(); 
$row1 = $stmts->fetch();
?>
<input type="text" class="form-control" id="org_type" name="org_type" value="<?php echo  $row1['organization_type'];?>" readonly></td>
</tr>
<tr>
<td>Website</td>
<td colspan="5">
<input type="text" class="form-control" id="txt_website" name="txt_website" value="<?php echo  $row['website'];?>" readonly></td>
</tr>
<td>Location</td>
<td colspan="4"><input type="text" class="form-control" id="Location" name="Location" value="<?php echo  $row['location'];?>" readonly></td>

<tr>
<td>State</td>
<?php
$state_id=$row['state'];
$stmt1 = $con->prepare("SELECT * FROM states where id='$state_id'"); 
$stmt1->execute(); 
$row2 = $stmt1->fetch();
?>
<td colspan="4"><input type="text" class="form-control" id="txt_State" name="txt_State" value="<?php echo  $row2['statename'];?>" readonly></td>
</tr>
<tr>
<td>City</td>
<?php
$city_id=$row['city'];
$stmt2 = $con->prepare("SELECT id,city_name FROM cities where id='$city_id'"); 
$stmt2->execute(); 
$row3 = $stmt2->fetch();
?>
<td colspan="4"><input type="text" class="form-control" id="txt_City" name="txt_City" value="<?php echo  $row3['city_name'];?>" readonly></td>
</tr>
<tr> 
<td>GST NO</td>
<td colspan="4"><input type="text" class="form-control" id="txt_gst_no" name="txt_gst_no" value="<?php echo  $row['gst_no'];?>" readonly>
</td>
</tr>
<tr>
<td>PAN NO</td>
<td colspan="4"><input type="text" class="form-control" id="txt_pan_no" name="txt_pan_no" value="<?php echo  $row['pan_no'];?>" readonly>
</tr>

<tr>
<td>Company Address</td>

<td colspan="4"><input type="text" class="form-control" id="txt_address_1" name="txt_address_1" value="<?php echo  $row['address'];?>" readonly></td>
</tr>
<tr>
<td></td>
<td colspan="2"><input type="text" class="form-control " id="txt_area_1" name="txt_area_1" value="<?php echo  $row['area'];?>" readonly></td>
<td colspan="2"><input type="text" class="form-control" id="txt_pincode_1" name="txt_pincode_1" value="<?php echo  $row['pincode'];?>" readonly></td>
</tr>

<tr>
<td>IT Department</td>
<td colspan="2"><input type="text" class="form-control " id="txt_client_name_1" name="txt_client_name_1" value="<?php echo  $row['it_name'];?>" readonly></td>
<td colspan="2"><input type="text" class="form-control " id="txt_client_desig_1" name="txt_client_desig_1" value="<?php echo  $row['it_designation'];?>" readonly></td>
</tr>
<tr>
<td></td>
<td colspan="2"><input type="text" class="form-control " id="txt_mobileone_1" name="txt_mobileone_1" value="<?php echo  $row['it_mob1'];?>" readonly></td>
<td colspan="2"><input type="text" class="form-control " id="txt_mobiletwo_1" name="txt_mobiletwo_1" value="<?php echo  $row['it_mob2'];?>" readonly"></td>
</tr>

<tr>
<td></td>
<td colspan="2"><input type="text" class="form-control " id="txt_mail_idone_1" name="txt_mail_idone_1" value="<?php echo  $row['it_mail1'];?>" readonly></td>
<td colspan="2"><input type="text" class="form-control " id="txt_mail_idtwo_1" name="txt_mail_idtwo_1" value="<?php echo  $row['it_mail1'];?>" readonly></td>
</tr>
<tr>
<td></td>
<td colspan="4"><input type="text" class="form-control " id="txt_landno_1" name="txt_landno_1" value="<?php echo  $row['it_landno'];?>" readonly></td>
</td>
</tr>




<tr>
<td>Purchase Department</td>
<td colspan="2"><input type="text" class="form-control " id="pur_name_1" name="pur_name_1" value="<?php echo  $row['pur_name'];?>" readonly></td>
<td colspan="2"><input type="text" class="form-control " id="pur_designation_1" name="pur_designation_1" value="<?php echo  $row['pur_designation'];?>" readonly></td>
</tr>
<tr>
<td></td>
<td colspan="2"><input type="text" class="form-control " id="pur_contact_1" name="pur_contact_1" value="<?php echo  $row['pur_contact'];?>" readonly></td>
<td colspan="2"><input type="text" class="form-control " id="pur_mail_1" name="pur_mail_1" value="<?php echo  $row['pur_mail'];?>" readonly></td>
</tr>




<tr>
<td>Finance Department</td>
<td colspan="2"><input type="text" class="form-control " id="fin_name_1" name="fin_name_1" value="<?php echo  $row['fin_name'];?>" readonly></td>
<td colspan="2"><input type="text" class="form-control " id="fin_designation_1" name="fin_designation_1" value="<?php echo  $row['fin_designation'];?>" readonly></td>
</tr>
<tr>
<td></td>
<td colspan="2"><input type="text" class="form-control " id="fin_contact_1" name="fin_contact_1" value="<?php echo  $row['fin_contact'];?>" readonly></td>
<td colspan="2"><input type="text" class="form-control " id="fin_mail_1" name="fin_mail_1" value="<?php echo  $row['fin_mail'];?>" readonly></td>
</tr>





<tr>



<td>Status</td>
<td colspan="5">
<?php
$status_value=$row['status'];
if($status_value==1){ $value="Active"; 
}else{ $value="In Active";}

?>
<input type="text" class="form-control" id="status_1" name="status_1" value="<?php echo $value;?>" readonly></td>
</tr>
</table>
</form>
<script>
function back_ctc()
{
  $.ajax({
    type:"POST",
    url:"qvision/masters/client_master/client_master.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}