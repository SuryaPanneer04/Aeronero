<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid=$_SESSION['candidateid'];

					$ennq_id=$_REQUEST['id'];

					
					$stmte=$con->prepare("SELECT cd.*,enq.status as customer_status,enq.id as enquiry_id,enq.id,enq.created_by as enquiry_created,enq.*,ncm.*,ncm.id as clients_id,npm.*,npm.id as plant_ids FROM enquiry enq left join new_client_master ncm on (enq.id=ncm.enquiry_id) left join customer_details cd on (enq.id=cd.id) left join new_plant_master npm on (ncm.id=npm.client_id) where enq.id='$ennq_id'");
					//echo "SELECT cd.*,cd.status as customer_status,enq.id as enquiry_id,enq.id,enq.created_by as enquiry_created,enq.*,ncm.*,ncm.id as clients_id,npm.*,npm.id as plant_ids FROM enquiry enq left join new_client_master ncm on (enq.id=ncm.enquiry_id) left join customer_details cd on (enq.id=cd.id) left join new_plant_master npm on (ncm.id=npm.client_id) where enq.id='$ennq_id'";
					/* echo "SELECT cd.*,cd.status as customer_status,enq.id as enquiry_id,enq.customer_id,enq.created_by as enquiry_created,enq.*,ncm.*,ncm.id as clients_id,npm.*,npm.id as plant_ids FROM enquiry enq left join new_client_master ncm on (enq.id=ncm.enquiry_id) left join customer_details cd on (enq.customer_id=cd.id) left join new_plant_master npm on (ncm.id=npm.client_id) where enq.customer_id='$ennq_id'"; */
					/* echo "SELECT cd.*,cd.status as customer_status,enq.id as enquiry_id,enq.customer_id,enq.created_by as enquiry_created,enq.*,ncm.*,ncm.id as clients_id,npm.*,npm.id as plant_ids FROM enquiry enq left join new_client_master ncm on (enq.id=ncm.enquiry_id) left join customer_details cd on (enq.customer_id=cd.id) left join new_plant_master npm on (ncm.id=npm.client_id) where enq.id='$ennq_id'"; */
					/* echo "SELECT cd.*,enq.id as enquiry_id,enq.customer_id,ncm.*,npm.* FROM enquiry enq left join new_client_master ncm on (enq.id=ncm.enquiry_id) left join customer_details cd on (enq.customer_id=cd.id) left join new_plant_master npm on (ncm.id=npm.client_id) where enq.customer_id='$cust_id'"; */

					$stmte->execute(); 
					$sel_qry = $stmte->fetch();
					$enqiry_id=$sel_qry['id'];
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
<section class="wage_content">
<div class="card card-primary">
<div class="card-header">
	<center><h3 class="card-title"><b>CLIENT DETAILS FORM</b></h3></center>
	<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>
</div>

<!--form method="POST" name="form" id="form" action="" autocomplete="off"-->
<form method="POST" id="fupForm4" name="fupForm4" action="" >

		
		<table class="table table-bordered" id="new_taba">
			<tr>
			<td>Customer Code</td>
		<td colspan="5"><input type="text" class="form-control"   id="cus_code" value="<?php echo $sel_qry['enquiry_code']; ?>" name="cus_code" readonly></td>

			
				 <!--<input type="hidden" class="form-control"   id="get_id" value="< ?php echo $id; ?>" name="get_id" readonly>-->
				 <input type="hidden" class="form-control"   id="plant_id" value="<?php echo $sel_qry['plant_ids'];  ?>" name="plant_id" readonly>
				 <input type="hidden" class="form-control"   id="enquiry_id" value="<?php echo $sel_qry['enquiry_id'];  ?>" name="enquiry_id" readonly>
				 <input type="hidden" class="form-control"   id="clients_id" value="<?php echo $sel_qry['clients_id'];  ?>" name="clients_id" readonly>
		
        
			</tr>
			<tr>
				<td>Client Org Name*</td>
				<td colspan="3">
					<input type="text" class="form-control" id="txt_org_name" name="txt_org_name" value="<?php echo $sel_qry['Company_name']; ?>" readonly> 
						
				</td>
				<td>Client Org Type:</td>
   <td colspan="2">
   <?php
   $org_id=$sel_qry['org_type'];

   $qry=$con->prepare("SELECT id,organization_type from org_type_master where id='$org_id'"); 
   
					$qry->execute(); 
					$qrys = $qry->fetch();
					?>
     <input type="text" class="form-control" id="client_type" name="client_type" value="<?php echo $qrys['organization_type']; ?>" readonly> 
	</td>
		
<tr>
<td>Call type *</td>
		<td colspan="3">
		 <?php
   $call_id=$sel_qry['Call_type'];

   $qrz=$con->prepare("SELECT id,name from calls_master where id='$call_id'"); 
   
					$qrz->execute(); 
					$qryz = $qrz->fetch();
					?>
		 <input type="text" class="form-control" id="call_type" name="call_type" value="<?php echo $qryz['name']; ?>" readonly> </td>
   <td>Website </td>
   <td colspan="2"><input type="text" class="form-control" value="<?php echo $sel_qry['website']; ?>" id="txt_website" name="txt_website" readonly></td>
   <!--<input type="hidden" value="< ?php echo $id;?>" name="cus_id" id="cus_id" >-->

</tr>		
			</tr>
			
			<div id="product_detail">
			</div>
			<td>Location*</td>
			
			<td colspan="5"><input type="text" class="form-control" value="<?php echo $sel_qry['location']; ?>" id="Location" name="Location" placeholder="Enter Plant Location" readonly></td>
			<tr>
				<td>State *</td>
				<td colspan="5">
				<?php
				   $state_id=$sel_qry['state'];

				   $qra=$con->prepare("SELECT id,statename FROM states where id ='$state_id'"); 

					$qra->execute(); 
					$qrya = $qra->fetch();
					?>
<input type="text" class="form-control" value="<?php echo $qrya['statename']; ?>" id="statename" name="statename" readonly>
				</td>
			</tr>
			<tr>
				<td>City *</td>
				<?php
				   $city_id=$sel_qry['city'];

				   $qrc=$con->prepare("SELECT id,city_name FROM cities where id ='$city_id'"); 

					$qrc->execute(); 
					$qryc = $qrc->fetch();
					?>
				<td colspan="5"><input type="text" class="form-control" value="<?php echo $qryc['city_name']; ?>" name="city_1" id="city_1"  readonly></td>
			</tr>
			<tr id="txt_gst_noo">
				<td>GST NO</td>
				<td colspan="5"><input type="text" class="form-control gst form-control mandatory" id="txt_gst_no" name="txt_gst_no"  maxlength="15" value="<?php echo $sel_qry['gst_no']; ?>" readonly></td>
				<input type="hidden" name="txt_duplicate_gstno" id="txt_duplicate_gstno">
			</tr>
			<tr id="txt_pan_noo">
				<td>PAN NO</td>
				<td colspan="5"><input type="text"  style="text-transform:uppercase" class="form-control pan" id="txt_pan_no" name="txt_pan_no" value="<?php echo $sel_qry['pan_no']; ?>" ></td>
				<input type="hidden" name="txt_duplicate_panno" id="txt_duplicate_panno">
			</tr>
			<tr>
				<td>Company Address *</td>
				<td colspan="5"><input type="text" class="form-control" value="<?php echo $sel_qry['address']; ?>" id="txt_address" name="txt_address" placeholder =" Enter The Address" readonly></td>
			</tr>
			
			
							      
		<tr>
        <td>Followup Date *</td>
        <td colspan="5">
			<input type="text"  id="Follup" name="Follup"  value="<?php echo $sel_qry['Follup'];?>" class="form-control"  placeholder="Enter Follup date" required="true" readonly>
		</td>
        </tr>
		<tr>

		<tr>
		<td>Sales Person Name</td>
		<td colspan="5">
<?php
$frstname=$con->query("SELECT * FROM `candidate_form_details` WHERE id='$candidateid'");
$namequry = $frstname->fetch();
?>
		<input type="text"  id="sale_person" name="sale_person"  value="<?php echo $namequry['first_name'];?>" class="form-control" required="true" readonly>
		</td>
        </tr>
		<tr>
		<td>Credit Period (No of days)</td>
		<td colspan="5">

		<input type="text"  id="credit_period" name="credit_period"  value="" class="form-control" required="true" >
		</td>
        </tr>
		<tr>
		<td>Credit limit (Value in Rs.)</td>
		<td colspan="5">

		<input type="text"  id="credit_limit" name="credit_limit"  value="" class="form-control" required="true" >
		</td>
        </tr>

		
		<tr>


		  <td colspan="5"><b>Document Upload*</b></td>
		  <td align="left">
		     <a href="qvision/CRM/uploads/<?php echo $sel_qry['verified_file'];?>" target="_blank"><?php echo $sel_qry['verified_file'];?></a>
		  </td>
		</tr>
				 
		</table>
		<tr>
		<?php 
				 if($sel_qry['customer_status']==2){
			 ?>
			 <div style="text-align:right;">
	<input type="submit" name="submit" class="btn btn-success submitBtn" value="Request For Client Approval">
	<br/>
	</div>
			   
			 	 <?php
			  
		}			
			 ?>
</tr>	
		</form>
		<script>
		  $(document).ready(function(){  
		$("form[name='fupForm4']").on("submit", function(ev) {
		 ev.preventDefault();


var formData = new FormData(this);
//$('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');	  
           $.ajax({  
                url:'qvision/CRM/client_edit_insert.php',
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
				processData: false,
                success:function(result)  
                {  
               
                           alert("Client Details Updated Successfully")					
						 customer_db()
                }  
           });  
      });  
	   });  

function back_ctc()
{
	//enquiry()
	customer_db()
}	
/* $(document).ready(function() {
  $('#txt_pan_no').attr('readonly', 'readonly');
}); */
</script>