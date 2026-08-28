<?php
require '../../connect.php';
include("../../user.php");
$id=$_REQUEST['id'];

 
$stmt = $con->prepare("select a.status as client_master_status,a.id as client_id,a.org_name,a.*,b.*,c.*,f.it_name as client_name,f.it_designation as client_designation,f.it_mob1 as client_mob1,f.it_mob2 as client_mob2,f.state as state,f.it_mail1 as client_mail1,f.it_mail2 as client_mail2,f.it_landno as client_land,e.*,f.* from new_client_master a left join z_department_master b on (a.department_id=b.id) left join candidate_form_details c on (a.employee_id = c.id) left join org_type_master e on (a.org_type=e.id) left join new_plant_master f on(a.id=f.client_id)where a.id='$id'"); 

$stmt->execute();


$row = $stmt->fetch();

 
echo $state = $row['state'];
$city = $row['city'];

?>

<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">CLIENT DETAILS FORM</font></h3>
				<a onclick="back_ctc22()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"></i>Back</a>
             </div>
<form method="POST" name="form" id="form" action="/KerliERP/masters/client_master/client_submit.php">

<table class="table table-bordered">
		<tr>
			<td><center><img src="/KerliERP/Recruitment/image/userlog/quadsel.png"  style="width:200px;height:100px;"></center></td>
			<td colspan="5"><center><h1><b>Bluebase Software Services Private Limited</b></h1></center></td>
		</tr>	
		<table class="table table-bordered" id="new_tab">
			<tr>
				<td>Department </td>
				<td colspan="2">

	                <input type="text" class="form-control" id="Department" name="Department" value="<?php echo $row['dept_name'];?>" readonly>
					<input type="hidden" class="form-control" id="client_id" name="client_id" value="<?php echo $id;?>" readonly>
				</td>
				<td>Employee </td>
				<td colspan="2">
				<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id;?>">

		        <input type="text" class="form-control" id="employee" name="employee" value="<?php echo $row['first_name'];?>" readonly></td>
			</tr>
			<tr>
				<td>Client Org Name</td>
				<td colspan="2"><input type="text" class="form-control" id="txt_org_name" value="<?php echo $row['org_name'];?>" name="txt_org_name" placeholder="Enter Client Name" readonly></td>
				<td>Client Org Type</td>
				<td colspan="2">
				<?php 
				
				$org_num=$row['org_type'];
				if($org_num==1)
				{
				$org_type="PVT";						
				}elseif($org_num==2)
				{
				$org_type="LLP";	
				}elseif($org_num==3)
				{
				$org_type="PL";	
				}elseif($org_num==4)
				{
				$org_type="Proprietorship";	
				}elseif($org_num==5)
				{
				$org_type="Partnership";	
				}elseif($org_num==6)
				{
				$org_type="Government";	
				}elseif($org_num==7)
				{
				$org_type="Education";	
				}elseif($org_num==8)
				{
				$org_type="SEZ";	
				}												
				?>
					<input type="text" class="form-control" id="client_type" name="client_type" value="<?php echo $org_type;?>" readonly>
				</td>
			</tr>
			<tr>
				<td>Website</td>
				<td colspan="4"><input type="text" class="form-control" id="txt_website" name="txt_website" value="<?php echo $row['website'];?>" readonly></td>
			</tr>
			
			<div id="product_detail">
			</div>
			<td>Location</td>
			<td colspan="4"><input type="text" class="form-control" id="Location" name="Location" value="<?php echo $row['location'];?>" readonly></td>
			<tr>
				<td>State*</td>
				<td colspan="5">
				<?php 
					$stmt1 = $con->query("SELECT id,state_name FROM state_code where state_code = $state");
					$rows = $stmt1->fetch();
					$states=$rows['state_name'];
				?>
				<input type="text" class="form-control" id="state" name="state" value="<?php echo $states;?>" readonly>										
				</td>
			</tr>
			<?php 

					$stmt2 = $con->query("SELECT id,city_name FROM cities where id = '$city'");
				
					$rows2 = $stmt2->fetch();
					$cityv=$rows2['city_name'];
				?>
			<tr>
				<td>City*</td>
				<td colspan="5"><input type="text" class="form-control" id="state" name="state" value="<?php echo $cityv;?>" readonly></select></td>
			</tr>
			<tr>
				<td>GST NO</td>
				<td colspan="4"><input type="text" class="form-control gst form-control mandatory" value="<?php echo $row['gst_no'];?>" id="txt_gst_no" name="txt_gst_no"  readonly></td>
			</tr>
			<tr id="txt_pan_noo">
				<td>PAN NO</td>
				<td colspan="4"><input type="text" class="form-control gst form-control mandatory" id="txt_pan_no_1" name="txt_pan_no_1" value="<?php echo $row['pan_no'];?>" readonly></td>
			</tr>
			<tr>
				<td>Company Address</td>
				<td colspan="4"><input type="text" class="form-control" value="<?php echo $row['address'];?>" id="txt_address_1" name="txt_address_1" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control " id="txt_area_1" name="txt_area_1" value="<?php echo $row['area'];?>" readonly></td>
				<td colspan="2"><input type="text" class="form-control pin" id="txt_pincode_1" value="<?php echo $row['pincode'];?>" name="txt_pincode_1" readonly></td>
			</tr>
            <tr>
				<td>Client Department</td>
				<td colspan="5">
				<?php
                   $client_dep=$row['client_department'];
				
				 if($client_dep=='1')
				 {
					 $client_department="IT Department";
				 }elseif($client_dep=='2')
				 {
					 $client_department="Purchase Department";
				 }elseif($client_dep=='3')
				 {
					 $client_department="Finance Department";
				 }else{
					$client_department="Others"; 
				 }
				?>
					<input type="text" class="form-control" value="<?php echo $client_department; ?>" id="client_depart" name="client_depart" readonly>
				</td>
			</tr>
			<tr>
				<td>Client Details</td>
				<td colspan="2"><input type="mail" class="form-control " value="<?php echo $row['client_name'];?>" id="txt_client_name_1" name="txt_client_name_1" readonly></td>
				<td colspan="2"><input type="text" class="form-control " value="<?php echo $row['client_designation'];?>" id="txt_client_desig_1" name="txt_client_desig_1" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control mob" value="<?php echo $row['client_mob1'];?>" id="txt_mobileone_1" maxlength="10" name="txt_mobileone_1" readonly></td>
				<td colspan="2"><input type="text" class="form-control amob" value="<?php echo $row['client_mob2'];?>" id="txt_mobiletwo_1" maxlength="10" name="txt_mobiletwo_1" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="mail" class="form-control mail" value="<?php echo $row['client_mail1'];?>"id="txt_mail_idone_1" name="txt_mail_idone_1" readonly></td>
				<td colspan="2"><input type="mail" class="form-control amail" value="<?php echo $row['client_mail2'];?>" id="txt_mail_idtwo_1" name="txt_mail_idtwo_1" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="4"><input type="text" class="form-control " value="<?php echo $row['client_land'];?>" id="txt_landno_1" name="txt_landno_1" readonly></td>
				</td>
			</tr>			
			<tr>
				<td>Status*</td>
				<td colspan="4">
				<?php				
					$client_status=$row['client_master_status'];
					if($client_status=1)
					{
						$status_value="Active";	
					}else{
						$status_value="InActive";		
					}
				
				?>
					<input type="text" class="form-control gst form-control mandatory" id="status" name="status" value="<?php echo $status_value;?>" readonly>
				</td>
			</tr> 
			
		</table>
	</table>

<center>
<?php if ( $row['client_master_status']==1){
	?>
 <input type="button" class="btn btn-success btn-lg"" id="save" name="save" onclick="approved()" value="Approve">

<input type="button" class="btn btn-danger btn-lg"" id="save" name="save" onclick="rejected()" value="Rejected">
<?php }
?>
</center>
</form>
 </div>
 

 
<script>
function back_ctc22()
{
cost_sheet_approval()
}
function approved()
{

var id = document.getElementById("client_id").value;

$.ajax({
type:'GET',
data:"idee="+id,

url:'qvision/CRM/ims_accounts_approval.php',
success:function(data)
{
if(data==1)
{ 
alert('Not');
}
else
{
alert("Approved Successfully");
cost_sheet_approval()
}
}           
});
}
function rejected()
{
var id = document.getElementById("client_id").value;
$.ajax({
type:'GET',
data:"idee="+id,

url:'qvision/CRM/ims_accounts_rejected.php',
success:function(data)
{
if(data==1)
{ 
alert('Not');
}
else
{
alert("Client Rejected");
cost_sheet_approval()
}
}           
});
}



</script>

