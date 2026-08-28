<?php
require '../../connect.php';
include("../../user.php");

error_reporting(0);

$cusid=$_REQUEST['id'];

$userrole=$_SESSION['userrole'];
 $candidateid=$_SESSION['candidateid'];
 $candidddddddd='';
   $select=$con->query("SELECT a.id as enquiry_id,a.status as enquiry_status,a.created_by as enquiry_created,a.*,b.*,c.* from enquiry a left join new_client_master b on (a.id=b.enquiry_id) left join new_plant_master c on (b.id=c.client_id)  where a.id='$cusid'"); 
   // echo "<pre>";
   // echo "SELECT a.id as enquiry_id,a.status as enquiry_status,a.created_by as enquiry_created,a.*,b.*,c.* from enquiry a left join new_client_master b on (a.id=b.enquiry_id) left join new_plant_master c on (b.id=c.client_id)  where a.id='$cusid'"; 
   // echo "</pre>";

				//	$select->execute(); 
					$sel_qry = $select->fetch();
					$id=$sel_qry['enquiry_id'];

					
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
<div class="card-header" style="background:#ff8b3d !important;">
	<center><h3 class="card-title"><b>CLIENT DETAILS FORM</b></h3></center>
	<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>
</div>

<!--form method="POST" name="form" id="form" action="" autocomplete="off"-->
<form method="POST" name="form" id="form" action="" >

		
		<table class="table table-bordered" id="new_taba">
			<tr>
			<td>Customer Code</td>
		<td colspan="3"><input type="text" class="form-control"   id="cus_code" value="<?php echo $sel_qry['enquiry_code']; ?>" name="cus_code" readonly></td>
		<td>Clinet Code</td>
		<td colspan="2"><input type="text" class="form-control"   id="client_code" value="<?php echo $sel_qry['client_code']; ?>" name="client_code" readonly></td>
			
				 <input type="hidden" class="form-control"   id="get_id" value="<?php echo $id; ?>" name="get_id" readonly>
		
        
			</tr>
			<tr>
				<td>Client Org Name*</td>
				<td colspan="3">
					<input type="text" class="form-control" id="txt_org_name" name="txt_org_name" value="<?php echo $sel_qry['Company_name']; ?>" readonly> 
						
				</td>
				<td>Client Org Type:</td>
   <td colspan="2">
   <?php
   $org_id=$sel_qry['Client_type'];

   $qry=$con->prepare("SELECT id,organization_type from org_type_master where id='$org_id'"); 
   
					$qry->execute(); 
					$qrys = $qry->fetch();
					?>
     <input type="text" class="form-control" id="client_type" name="client_type" value="<?php echo $qrys['organization_type']; ?>" readonly> 
	</td>
		
<tr>

   <td>Website </td>
   <td colspan="5"><input type="text" class="form-control" value="<?php echo $sel_qry['website']; ?>" id="txt_website" name="txt_website" readonly></td>
   <input type="hidden" value="<?php echo $cusid;?>" name="cus_id" id="cus_id" >

</tr>		
			</tr>
			
			<div id="product_detail">
			</div>
			<td>Location*</td>
			
			<td colspan="5"><input type="text" class="form-control" value="<?php echo $sel_qry['Location']; ?>" id="Location" name="Location" placeholder="Enter Plant Location" readonly></td>
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
				<td colspan="5"><input type="text"  style="text-transform:uppercase" class="form-control pan" id="txt_pan_no_1" name="txt_pan_no_1" value="<?php echo $sel_qry['pan_no']; ?>"></td>
				<input type="hidden" name="txt_duplicate_panno" id="txt_duplicate_panno">
			</tr>
			<tr>
				<td>Company Address *</td>
				<td colspan="5"><input type="text" class="form-control" value="<?php echo $sel_qry['address']; ?>" id="txt_address_1" name="txt_address_1" placeholder =" Enter The Address" readonly></td>
			</tr>
			<tr>
			   <td>Contact Person *</td>
			   <td colspan="3"><input type="text" class="form-control" value="<?php echo $sel_qry['it_name']; ?>" id="txt_client_name" name="txt_client_name" Placeholder="Customer Name" readonly></td>
			  
			   <td colspan="2"><input type="text" class="form-control" value="<?php echo $sel_qry['Designation']; ?>" id="txt_client_desig" name="txt_client_desig" placeholder="Customer  Designation" readonly></td>
			</tr>

		<tr>
		   <td>Mobile No1 * </td>
		   <td colspan="3"><input type="text" class="form-control" id="txt_mobile1" value="<?php echo $sel_qry['mobile1']; ?>" name="txt_mobile1" maxlength="10" required placeholder="Mobile No1" readonly></td>
			
		   <td colspan="2"><input type="text" class="form-control"  id="txt_mobile2" value="<?php echo $sel_qry['mobile2']; ?>" name="txt_mobile2" maxlength="10" placeholder="Mobile No2"></td>
		</tr>
		<tr>
		   <td>Email Id 1 *</td>
		   <td colspan="3"><input type="text" class="form-control" value="<?php echo $sel_qry['email1']; ?>" id="txt_mail_id1" name="txt_mail_id1" required placeholder="Email Id 1" readonly></td>
		
		   <td colspan="2"><input type="text" class="form-control" value="<?php echo $sel_qry['email2']; ?>"  id="txt_mail_id2" name="txt_mail_id2" placeholder="Email Id 2"></td>
		</tr>
			<tr>
				<td></td>
				<td colspan="3"><input type="text" class="form-control " value="<?php echo $sel_qry['area']; ?>" id="txt_area_1" name="txt_area_1" placeholder ="Area"></td>
				<td colspan="2"><input type="text" class="form-control pin" value="<?php echo $sel_qry['pincode']; ?>" id="txt_pincode_1" name="txt_pincode_1" placeholder ="Pincode"></td>
			</tr>
			<tr>
				<td>IT Department</td>
				<td colspan="3"><input type="text" value="<?php echo $sel_qry['it_name']; ?>" class="form-control " id="txt_client_name_1" name="txt_client_name_1" placeholder ="Client name"></td>
				<td colspan="2"><input type="text" value="<?php echo $sel_qry['it_designation']; ?>" class="form-control " id="txt_client_desig_1" name="txt_client_desig_1" placeholder ="Client Designation"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><input type="text" value="<?php echo $sel_qry['it_mob1']; ?>" class="form-control mob" id="txt_mobileone_1" maxlength="10" name="txt_mobileone_1" placeholder ="Enter Your Mobile Number"></td>
				<td colspan="2"><input type="text" value="<?php echo $sel_qry['it_mob2']; ?>" class="form-control amob" id="txt_mobiletwo_1" maxlength="10" name="txt_mobiletwo_1" placeholder ="Enter Your alternate mobile number"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><input type="mail" value="<?php echo $sel_qry['it_mail1']; ?>" class="form-control mail" id="txt_mail_idone_1" name="txt_mail_idone_1" placeholder ="Enter Your Mail id"></td>
				<td colspan="2"><input type="mail" value="<?php echo $sel_qry['it_mail2']; ?>" class="form-control amail" id="txt_mail_idtwo_1" name="txt_mail_idtwo_1" placeholder ="Enter Your alternate Mail id"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="5"><input type="text" value="<?php echo $sel_qry['it_landno']; ?>" class="form-control " id="txt_landno_1" name="txt_landno_1" placeholder ="Land Line No"></td>
				</td>
			</tr>
			<tr>
				<td>Purchase Department</td>
				<td colspan="3"><input type="text" value="<?php echo $sel_qry['pur_name']; ?>" class="form-control " id="pur_name_1" name="pur_name_1" placeholder ="Name"></td>
				<td colspan="2"><input type="text" value="<?php echo $sel_qry['pur_designation']; ?>" class="form-control " id="pur_designation_1" name="pur_designation_1" placeholder ="Designation"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><input type="text" value="<?php echo $sel_qry['pur_contact']; ?>" class="form-control " id="pur_contact_1" name="pur_contact_1" placeholder ="Contact Number"></td>
				<td colspan="2"><input type="mail" value="<?php echo $sel_qry['pur_mail']; ?>" class="form-control purmail" id="pur_mail_1" name="pur_mail_1" placeholder ="MailId"></td>
			</tr>
			<tr>
				<td>Finance Department</td>
				<td colspan="3"><input type="text" value="<?php echo $sel_qry['fin_name']; ?>" class="form-control " id="fin_name_1" name="fin_name_1" placeholder ="Name"></td>
				<td colspan="2"><input type="text" value="<?php echo $sel_qry['fin_designation']; ?>" class="form-control " id="fin_designation_1" name="fin_designation_1" placeholder ="Designation"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><input type="text" value="<?php echo $sel_qry['fin_contact']; ?>" class="form-control " id="fin_contact_1" name="fin_contact_1" placeholder ="Contact Number"></td>
				<td colspan="2"><input type="mail" value="<?php echo $sel_qry['fin_mail']; ?>" class="form-control finmail" id="fin_mail_1" name="fin_mail_1" placeholder ="MailId"></td>
			</tr>
			<tr>
        <td>Product / Service *</td>
        <td colspan="5">
		<?php
				   $Product=$sel_qry['Product'];
if($Product==1){
	$product="Product";
}elseif($Product==2){
	$product="Service";
}elseif($Product==3){
	$product="Solution";
}
?>
<input type="text" value="<?php echo $product; ?>" class="form-control" id="Product" name="Product" readonly>
		</td>
        </tr>
		
	<tr>
        <td></td>
        <td colspan="5">
		<?php
		 $list=$sel_qry['list'];
		$qrp=$con->prepare("SELECT id,name FROM product_services where id ='$list'"); 

					$qrp->execute(); 
					$qryp = $qrp->fetch();
					$service=$qryp['name'];
		?>
		 <input type="text" class="form-control" value="<?php echo $service;?>" name="services" id="services" readonly>

		
		</td>
        </tr>
		

       <!-- <tr><td>Enquiry Details *</td>

        <td colspan="5">
			<input type="text"  id="Feedback" name="Feedback" value="< ?php echo $sel_qry['Feedback'];?>" class="form-control"  placeholder="About Enquiry ...." required="true" readonly>
		</td>
        </tr>-->
		<tr>
        <td>Followup Date *</td>
        <td colspan="5">
			<input type="text"  id="Follup" name="Follup"  value="<?php echo $sel_qry['Follup'];?>" class="form-control"  placeholder="Enter Follup date" required="true" readonly>
		</td>
        </tr>
		<tr>
		<!--<td>Assign To Department </td>
		<td colspan="5">

		< ?php 
		$dep_id=$sel_qry['Department'];
		$qrpf = $con->prepare("SELECT id,dept_name FROM z_department_master where id='$dep_id'");
		$qrpf->execute(); 
					$qrypf = $qrpf->fetch();
					$assin=$qrypf['dept_name'];
		?>
		<input type="text"  id="assin" name="assin"  value="< ?php echo $assin;?>" class="form-control" required="true" readonly>
		</td>
        </tr>-->
		<tr>
		<td>Sales Person Name</td>
		<td colspan="5">
<?php
$dd=$sel_qry['enquiry_created'];
$nam=$con->query("SELECT * FROM `staff_master` WHERE id='$dd'");
$qrypf = $nam->fetch();
$candidddddddd=$qrypf['candid_id'];
?>
		<input type="text"  id="sale_person" name="sale_person"  value="<?php echo $qrypf['emp_name'];?>" class="form-control" required="true" readonly>
		</td>
        </tr>
		<!--<tr>
		<td>Credit Period (No of days)</td>
		<td colspan="5">

		<input type="text"  id="credit_period" name="credit_period"  value="<?php echo $sel_qry['credit_period'];?>" class="form-control" required="true" readonly>
		</td>
        </tr>
		<tr>
		<td>Credit limit (Value in Rs.)</td>
		<td colspan="5">

		<input type="text"  id="credit_limit" name="credit_limit"  value="<?php echo $sel_qry['credit_limit'];?>" class="form-control" required="true" readonly>
		</td>
        </tr>-->
		 <!--<tr>
		<td>Assign To Department </td>
		<td colspan="5">

		< ?php 
		$dep_id=$sel_qry['Department'];
		$qrpf = $con->prepare("SELECT id,dept_name FROM z_department_master where id='$dep_id'");
		$qrpf->execute(); 
					$qrypf = $qrpf->fetch();
					$assin=$qrypf['dept_name'];
		?>
		<input type="text"  id="assin" name="assin"  value="< ?php echo $assin;?>" class="form-control" required="true" readonly>
		</td>
        </tr>
		<tr>
		<td>Assign To Employee </td>
		<td colspan="5">
		< ?php
		$employee=$sel_qry['employee'];
		$qrpa = $con->prepare("SELECT candidate_id,full_name FROM z_user_master where candidate_id='$employee'");

		$qrpa->execute(); 
					$qrypa = $qrpa->fetch();
					$assin_emp=$qrypa['full_name'];
					?>
		 <input type="text"  id="assin_emp" name="assin_emp"  value="< ?php echo $assin_emp;?>" class="form-control" required="true" readonly></td>
        </tr>-->
		
		<tr>


		  <td colspan="5"><b>Document Upload*</b></td>
		  <td align="left">
		     <a href="qvision/CRM/uploads/<?php echo $sel_qry['verified_file'];?>" target="_blank"><?php echo $sel_qry['verified_file'];?></a>
		  </td>
		</tr>
			
		</table>
	
	<div style="text-align:right;">
	<!--<input type="button" name="save" value="SAVE" onclick="plant_insert(this.value)" class="btn btn-primary btn-md">-->
	<br/>
	</div>


				  <br>
				  <br>
				  <table class="table table-bordered">
<h3><center>Feedback Entry Details</center></h3>
<br>
<tbody>

<?php
$ddd=$sel_qry['calls_id'];
$sql=$con->query("SELECT * FROM  crm_calls_feedback where calls_id='$ddd'");

$cnt=1;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows['calls_id']; ?>">
<td>Feedback</td>
<td><input type="text" class="form-control" id="feedback_1" name="feedbacks[]" value="<?php echo  $rows['feedback']; ?>" readonly></td>



<td>Feedback Date </td><td colspan="1"><input type="date" class="form-control" id="date_1" name="dates[]" value="<?php echo  $rows['feedback_date']; ?>" readonly></td>

</tr>
<?php 
$cnt=$cnt+1;
 }?>
 </tbody>
 
      </table>
	  <br>
	  <br>
	  <?php if($sel_qry['enquiry_status']==1){
				 
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
     
      <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="checki()" value="Add">
      <input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
    </td>
    </tr>
   
     
    </table>
	 	 <?php
			 }
			 ?>
                </div>
				<?php if($sel_qry['enquiry_status']==2){
				 
			 ?>
              <input type="button" class="btn btn-success" id="save" name="save" onclick="enquiry_accept(<?php echo $cusid; ?>)" value="Save">
			   <br>
			  <br>
			  <?php if($sel_qry['enquiry_created']==$sel_qry['enquiry_created']){
				 
			 ?>
			   <input type="button" class="btn btn-primary" id="save" name="save" onclick="change_status(<?php echo $cusid; ?>)" value="Request For Client Approval">
			 	 <?php
			  }
			 }
			 ?>
              </form>
			   
			
			  
            </div>
			<script>
//Followup  date 
var mintoday = new Date();
var mindd = mintoday.getDate();
//var date=dd;
var minmm = mintoday.getMonth()+1; //January is 0 so need to add 1 to make it 1!
var minyyyy = mintoday.getFullYear();
if(mindd<10){
  mindate='0'+mindd
}else{
  mindate=mindd
}
if(minmm<10){
  minmm='0'+minmm
}else{
  minmm=minmm
}	
mintoday = minyyyy+'-'+minmm+'-'+mindate;
//alert(mintoday);
document.getElementById("date_1").setAttribute("min", mintoday);


//start max date after six month 
var fptoday = new Date();
var fpmaxdd = fptoday.getDate();
//var date=dd;



//future_year = today.year + ((today.month + 6) // 12)

 //January is 0 so need to add 1 to make it 1!

var today = moment();
var nextMonth = today.add('month', 6);
var nextdate =nextMonth.format('YYYY-MM-DD');
document.getElementById("date_1").setAttribute("max", nextdate);
</script>

<script>
	function enquiry_accept(cusid)
    {
		debugger;
	var id=$('#get_id').val();
	var feedback_1=$('#feedback_1').val();
	var date_1=$('#date_1').val();
	var data = $('form').serialize();
	if(feedback_1=='' || date_1=='')
	{
	alert("Enter all required fields");
	}
else
	{
		
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
		alert("Feedback Added Successfully");
		remainder(id);
       // alert("Update Successfully");
	    customer_db()
		view_enquiry(cusid)
      }
      }           
    });
    }
	}	
 
 
	
		
 function change_status(ids)
    {
    var id=$('#get_id').val();
	//alert(id);
 var data = $('form').serialize();
 alert(ids);
 //$('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');
    $.ajax({
    type:'GET',
    //data: data + "&" + "id="+id,
	
    url:'qvision/CRM/change_status.php?id='+ids,
    success:function(data)
    {
		console.warn("jhgf:"+data);
      if(data==1)
      { 
        alert('Lead Not Generated');
      }
      else
      {
        alert("Client Requested For Approval");
		costsheet_add()
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
	<script>
	function remainder(v)
	{
		 $.ajax({
			type: "POST",
            url:'qvision/CRM/enquiry_feedback_remaindermail.php?get_id='+v,
            success: function (data) {
                $("#main_content").html(data);
            }
        })
		
	}
	
	</script>
	<SCRIPT>
	function back_ctc()
	{
		costsheet_add()
	}
	</SCRIPT>
	