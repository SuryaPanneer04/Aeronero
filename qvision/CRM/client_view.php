<?php
require '../../connect.php';
include("../../user.php");
$id=$_REQUEST['id'];
//echo$id;
$userrole=$_SESSION['userrole'];

$sql=$con->query("select * from customer_details");
$cou=$sql->rowCount();

if($cou == 0)
{
	$customer_code='CT0001';
	//echo $customer_code;
}
else
{
	$add=$cou+1;
   //$customer_code="CT000".$add;
   
   $stmtz=$con->prepare("SELECT MAX(ID)as max_id FROM customer_details"); 
					$stmtz->execute(); 
					$rowz = $stmtz->fetch();
					$max_id=$rowz['max_id'];
$stmtw=$con->prepare("SELECT id,customer_code FROM customer_details where id='$max_id'"); 
//echo "SELECT id,customer_code FROM customer_details where id='$max_id'";
					$stmtw->execute(); 
					$roww = $stmtw->fetch();
					$cus_code=$roww['customer_code'];
					
					$find_f = substr($roww['customer_code'], 0, 2);
					$find_s = substr($roww['customer_code'], 2, 4);
					//echo $find_f;echo "<br/>";
					//echo $find_s;echo "<br/>";
					$final_csno = str_pad($find_s + 1, 4, 0, STR_PAD_LEFT);
					//echo $final_csno;echo "<br/>";
					//echo $c_value= $find_s+1;
					$customer_code=$find_f.$final_csno;
					//echo $customer_code;
} 
$stmt = $con->prepare("select * from customer_details where id='$id'");
//echo "select * from customer_details where id='$id'";

$stmt->execute(); 
$rowv = $stmt->fetch();


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
<form method="POST" name="form" id="form" action="" >

		
		<table class="table table-bordered" id="new_tab">
			<tr>
			<td>Customer Code</td>
		<td colspan="3"><input type="text" class="form-control"   id="cus_code" value="<?php echo $rowv['customer_code']; ?>" name="cus_code" readonly></td>
		<td>Clinet Code</td>
		<td colspan="2"><input type="text" class="form-control"   id="cus_code" value="<?php echo $customer_code; ?>" name="cus_code" readonly></td>
			
				 
		
        
			</tr>
			<tr>
				<td>Client Org Name*</td>
				<td colspan="3">
					<input type="text" class="form-control" id="txt_org_name" name="txt_org_name" value="<?php echo $rowv['customer_name']; ?>" readonly> 
						
				</td>
				<td>Client Org Type:</td>
   <td colspan="2">
     <select name="client_type" id="client_type" class="form-control">
		<option value="">Select Type</option>
		<?php
		$sql=$con->query("SELECT * FROM org_type_master ");
		$i=1;
		while($cmp = $sql->fetch(PDO::FETCH_ASSOC))
		{
		  ?>
		  <option value="<?php echo $cmp['id'];?>"><?php echo $cmp['organization_type'];?></option>
		  <?php
		}
		  ?>
	  </select>
	</td>
		
<tr>
<td>Call type *</td>
		<td colspan="3">
		<select class="form-control" id="Call_type" name="Call_type" required="true">
		<option value="">Choose Type</option>
		<?php $stmt = $con->query("SELECT * FROM calls_master ");
		while ($row = $stmt->fetch()) {?>
		<option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
		<?php } ?>
		</select></td>
   <td>Website </td>
   <td colspan="2"><input type="text" class="form-control" value="<?php echo $rowv['customer_website']; ?>" id="txt_website" name="txt_website"></td>

</tr>		
			</tr>
			
			<div id="product_detail">
			</div>
			<td>Location*</td>
			<td colspan="5"><input type="text" class="form-control" id="Location" name="Location" placeholder="Enter Plant Location" ></td>
			<tr>
				<td>State *</td>
				<td colspan="5">
					<select class="form-control" name="state_1" id="state_1" onchange="getcitydata(1,this.value);getgstdata(1,this.value)" required>
					<option value="">Choose State</option>
					<?php $stmt = $con->query("SELECT id,statename FROM states where country_id = 101");
					while ($row = $stmt->fetch()) {?>
					<option value="<?php echo $row['id']; ?>"> <?php echo $row['statename']; ?> </option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>City *</td>
				<td colspan="5"><select class="form-control" name="city_1" id="city_1"  required></select></td>
			</tr>
			<tr id="txt_gst_noo">
				<td>GST NO</td>
				<td colspan="5"><input type="text" class="form-control gst form-control mandatory" style="text-transform:uppercase" id="txt_gst_no" name="txt_gst_no"  maxlength="15" title="Please enter valid GST number. E.g. 12ABCDE1234A5A6" placeholder="Enter GST Number"></td>
				<input type="hidden" name="txt_duplicate_gstno" id="txt_duplicate_gstno">
			</tr>
			<tr id="txt_pan_noo">
				<td>PAN NO</td>
				<td colspan="5"><input type="text"  style="text-transform:uppercase" class="form-control pan" id="txt_pan_no_1" name="txt_pan_no_1" maxlength="10" title="Please enter valid PAN number. E.g. AAAAA1234A" placeholder="Enter PAN Number"></td>
				<input type="hidden" name="txt_duplicate_panno" id="txt_duplicate_panno">
			</tr>
			<tr>
				<td>Company Address *</td>
				<td colspan="5"><input type="text" class="form-control" value="<?php echo $rowv['customer_address'];?>" id="txt_address_1" name="txt_address_1" placeholder =" Enter The Address"></td>
			</tr>
			<tr>
			   <td>Contact Person *</td>
			   <td colspan="3"><input type="text" class="form-control" value="<?php echo $rowv['customer_person'];?>" id="txt_client_name" name="txt_client_name" Placeholder="Customer Name"></td>
			  
			   <td colspan="2"><input type="text" class="form-control" id="txt_client_desig" name="txt_client_desig" placeholder="Customer  Designation" ></td>
			</tr>

		<tr>
		   <td>Mobile No1 * </td>
		   <td colspan="3"><input type="text" class="form-control" id="txt_mobile1" value="<?php echo $rowv['customer_contact']; ?>" name="txt_mobile1" maxlength="10" required placeholder="Mobile No1"></td>
			
		   <td colspan="2"><input type="text" class="form-control" id="txt_mobile2" name="txt_mobile2" maxlength="10" placeholder="Mobile No2"></td>
		</tr>
		<tr>
		   <td>Email Id 1 *</td>
		   <td colspan="3"><input type="text" class="form-control" value="<?php echo $rowv['customer_mail']; ?>" id="txt_mail_id1" name="txt_mail_id1" required placeholder="Email Id 1"></td>
		
		   <td colspan="2"><input type="text" class="form-control" id="txt_mail_id2" name="txt_mail_id2" placeholder="Email Id 2"></td>
		</tr>
			<tr>
				<td></td>
				<td colspan="3"><input type="text" class="form-control " id="txt_area_1" name="txt_area_1" placeholder ="Area"></td>
				<td colspan="2"><input type="text" class="form-control pin" id="txt_pincode_1" name="txt_pincode_1" placeholder ="Pincode"></td>
			</tr>
			<tr>
				<td>IT Department</td>
				<td colspan="3"><input type="mail" class="form-control " id="txt_client_name_1" name="txt_client_name_1" placeholder ="Client name"></td>
				<td colspan="2"><input type="text" class="form-control " id="txt_client_desig_1" name="txt_client_desig_1" placeholder ="Client Designation"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><input type="text" class="form-control mob" id="txt_mobileone_1" maxlength="10" name="txt_mobileone_1" placeholder ="Enter Your Mobile Number"></td>
				<td colspan="2"><input type="text" class="form-control amob" id="txt_mobiletwo_1" maxlength="10" name="txt_mobiletwo_1" placeholder ="Enter Your alternate mobile number"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><input type="mail" class="form-control mail" id="txt_mail_idone_1" name="txt_mail_idone_1" placeholder ="Enter Your Mail id"></td>
				<td colspan="2"><input type="mail" class="form-control amail" id="txt_mail_idtwo_1" name="txt_mail_idtwo_1" placeholder ="Enter Your alternate Mail id"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="5"><input type="text" class="form-control " id="txt_landno_1" name="txt_landno_1" placeholder ="Land Line No"></td>
				</td>
			</tr>
			<tr>
				<td>Purchase Department</td>
				<td colspan="3"><input type="text" class="form-control " id="pur_name_1" name="pur_name_1" placeholder ="Name"></td>
				<td colspan="2"><input type="text" class="form-control " id="pur_designation_1" name="pur_designation_1" placeholder ="Designation"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><input type="text" class="form-control " id="pur_contact_1" name="pur_contact_1" placeholder ="Contact Number"></td>
				<td colspan="2"><input type="mail" class="form-control purmail" id="pur_mail_1" name="pur_mail_1" placeholder ="MailId"></td>
			</tr>
			<tr>
				<td>Finance Department</td>
				<td colspan="3"><input type="text" class="form-control " id="fin_name_1" name="fin_name_1" placeholder ="Name"></td>
				<td colspan="2"><input type="text" class="form-control " id="fin_designation_1" name="fin_designation_1" placeholder ="Designation"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><input type="text" class="form-control " id="fin_contact_1" name="fin_contact_1" placeholder ="Contact Number"></td>
				<td colspan="2"><input type="mail" class="form-control finmail" id="fin_mail_1" name="fin_mail_1" placeholder ="MailId"></td>
			</tr>
			<tr>
        <td>Product / Service *</td>
        <td colspan="5">
		<select name="Product" class="form-control" id="Product" onchange="productstatus(this.value)">
		<option>Select</option>
		<option value="1">Product</option>
		<option value="2">Service</option>
		<option value="3">Solution</option>
		</select>
		</td>
        </tr>
		
	<tr>
        <td></td>
        <td colspan="5">
		 <select class="form-control" name="services" id="services">

</select>
		
		</td>
        </tr>
		<tr>

        <td>Enquiry Details *</td>

        <td colspan="5">
			<input type="text"  id="Feedback" name="Feedback" class="form-control"  placeholder="About Enquiry ...." required="true">
		</td>
        </tr>
		<tr>
        <td>Followup Date *</td>
        <td colspan="5">
			<input type="date"  id="Follup" name="Follup" class="form-control"  placeholder="Enter Follup date" required="true">
		</td>
        </tr>
		
		 <tr>
		<td>Assign To Department </td>
		<td colspan="5">
		<select class="form-control" id="Department" onchange="getempdata(this.value)" name="Department" >
		<option value="">Choose Type</option>
		<?php $stmt = $con->query("SELECT * FROM z_department_master ");
		while ($row = $stmt->fetch()) {?>
		<option value="<?php echo $row['id']; ?>"> <?php echo $row['dept_name']; ?> </option>
		<?php } ?>
		</select></td>
        </tr>
		<tr>
		<td>Assign To Employee </td>
		<td colspan="5">
		 <select class="form-control" name="employee_1" id="employee_1" required>

</select></td>
        </tr>
		
		<tr>


		  <td colspan="5"><b>Document Upload*</b></td>
		  <td align="left">
		     <b><input type="file" name="file[]" id="file" />
		  </td>
		</tr>
			
		</table>
	
	<div style="text-align:right;">
	<input type="button" name="save" value="SAVE" onclick="plant_insert(this.value)" class="btn btn-primary btn-md">
	<br/>
	</div>
	<table class="table table-bordered">
<h3><center>Feedback Entry Details</center></h3>
<br>
<tbody>

<?php

$sql=$con->query("SELECT * FROM  feedback_enquiry_crm where enquiry_id='$id'");

$cnt=1;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows['enquiry_id']; ?>">
<td>Feedback</td>
<td><input type="text" class="form-control" id="feedback_1" name="feedbacks[]" value="<?php echo  $rows['Feedback']; ?>" readonly></td>



<td>Feedback Date </td><td colspan="1"><input type="date" class="form-control" id="date_1" name="dates[]" value="<?php echo  $rows['feedback_date']; ?>" readonly></td>

</tr>
<?php 
$cnt=$cnt+1;
 }?>
 </tbody>
 
      </table>
	  <br>
	  <br>
	  <?php if($row['enquiry_status']==1){
				 
			 ?>
				  <table class="table table-bordered" id="new_tab">
    <tr>
   
    </tr>
    <tr>
      <th>#</th>
      <th>Feedback</th>
      <th>Feedback Followup Date</th>
     
    </tr>
    
    
    <tr>
      <td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/></td>
    
      <td><input type="text" class="form-control" id="feedback_1" name="feedback[]"></td>
      <td><input type="date" class="form-control" id="date_1" name="date[]"></td>
     
      <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
      <input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
    </td>
    </tr>
   
     
    </table>
	 	 <?php
			 }
			 ?>
</form>

<script>
	function enquiry_accept()
    {
	var id=$('#get_id').val();
	var feedback_1=$('#feedback_1').val();
	var date_1=$('#date_1').val();
	//alert(id);
	var data = $('form').serialize();
	if(feedback_1=='' || date_1=='')
	{
	alert("Enter all required fields");
	}
else
	{
		alert("Feedback Added Successfully");
	//$('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
	
	url:'qvision/CRM/accept_enquiry.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not');
      }
      else
      {
		remainder(v);
        alert("Update Successfully");
	 enquiry()
      }
      }           
    });
    }
	}	
 
 
	
		
 function change_status()
    {
    var id=$('#get_id').val();
	//alert(id);
 var data = $('form').serialize();
 $('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
	
    url:'qvision/CRM/change_status.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Lead Not Generated');
      }
      else
      {
        alert("Lead Generated Successfully");
	enquiry()
      }
      }           
    });
    }
	
	</script>
	<script>
    function check() // education
    {
    var len=$('#new_tab tr').length;	
    len=len+1; 
    $('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><input type="text" class="form-control" id="feedback_'+len+'" name="feedback[]"></td><td><input type="date" class="form-control" id="date_'+len+'" name="date[]"></td></tr>'); 
    }



    $('#enquiry_row_remove').click(function(){
    $('input:checkbox:checked.chk').map(function(){
    var id=$(this).val();
    var le=$('#new_tab tr').length;

    if(le==1)
    {
    alert("You Can't Delete All the Rows");
    }
    else
    {
    $('.row_'+id).remove();
    }

    });
    });
	</script>