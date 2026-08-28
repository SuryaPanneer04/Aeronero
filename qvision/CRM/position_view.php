<?php
require '../config.php';
include("../user.php");
$id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT a.id as enquiry_id,a.status as enquiry_status,a.client_type as clients_type,a.*,b.*,c.*,d.*,e.*,f.name as eqp_name,f.*,g.status as client_master_status,g.org_type as client_org_type,g.*,h.state,h.city,h.client_id,h.gst_no,h.pan_no  FROM enquiry a left join calls_master b on (a.call_type=b.id) left join z_department_master c on (a.Department=c.id) left join candidate_form_details d on(a.employee=d.id) left join products_master e on(a.product=e.Product_id) left join product_services f on (a.list=f.id) left join  new_client_master g on (a.client_id=g.id) left join new_plant_master h on(a.client_id=h.client_id)where a.id='$id'");

/*  echo "SELECT a.id as enquiry_id,a.status as enquiry_status,a.client_type as clients_type,a.*,b.*,c.*,d.*,e.*,f.name as eqp_name,f.*,g.status as client_master_status,g.org_type as client_org_type,g.*,h.state,h.city,h.client_id,h.gst_no,h.pan_no  FROM enquiry a left join calls_master b on (a.call_type=b.id) left join z_department_master c on (a.Department=c.id) left join candidate_form_details d on(a.employee=d.id) left join products_master e on(a.product=e.Product_id) left join product_services f on (a.list=f.id) left join  new_client_master g on (a.client_id=g.id) left join new_plant_master h on(a.client_id=h.client_id)where a.id='$id'";  */


$stmt->execute(); 
$row = $stmt->fetch();

$id=$row['enquiry_id'];

$area=$row['area'];
$Location=$row['Location'];
$pincode=$row['pincode'];
$it_name=$row['it_name'];
$it_designation=$row['it_designation'];
$it_mob1=$row['it_mob1'];
$it_mob2=$row['it_mob2'];
$it_mail1=$row['it_mail1'];
$it_mail2=$row['it_mail2'];
$it_landno=$row['it_landno'];

?>
<div class="card card-info">
<div class="card-header">
	<center><h3 class="card-title"><b>VIEW CLIENT DETAILS</b></h3></center>
	<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"></i>Back</a>
</div>

<form method="POST" name="form" id="form" action="" autocomplete="off">
	<table class="table table-bordered">
		<tr>
			<td><center><img src="/KerliERP/Recruitment/image/userlog/quadsel.png"  style="width:200px;height:100px;"></center></td>
			<td colspan="5"><center><h1><b>Bluebase Software Services Private Limited</b></h1></center></td>
		</tr>	
		<table class="table table-bordered" id="new_tab">
			<tr>
				<td>Department </td>
				<td colspan="2">

	                <input type="text" class="form-control" id="Department" name="Department" value="<?php echo  $row['dept_name'];?>" readonly>
				</td>
				<td>Employee </td>
				<td colspan="2">
					<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id;?>">
					<input type="text" class="form-control" id="employee" name="employee" value="<?php echo  $row['first_name'];?>" readonly>
				</td>
			</tr>
			<tr>
				<td>Client Org Name</td>
				<td colspan="4"><input type="text" class="form-control" id="txt_org_name" value="<?php echo  $row['Company_name'];?>" name="txt_org_name" placeholder="Enter Client Name" readonly></td>
			 	<!--td>Client Org Type</td>
				<td colspan="2">
				<!?php 
				
				$org_num=$row['client_org_type'];
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
					<input type="text" class="form-control" id="org_type" name="org_type" value="<!?php echo  $org_type;?>" readonly>
				</td--> 
				
			</tr>
			
			<!--tr>
				<td>Website</td>
				<td colspan="4"><input type="text" class="form-control" id="txt_website" name="txt_website" value="<!?php echo $row['website'];?>" readonly></td>
			</tr-->
			
			<div id="product_detail">
			</div>
			<td>Location</td>
			<td colspan="4"><input type="text" class="form-control" value="<?php echo$Location;?>" id="Location" name="Location" placeholder="Enter Plant Location" readonly></td>
			
			<!--tr>
			<td>State</td>
			<!?php
			$state_id=$row['state'];
			$stmt1 = $con->prepare("SELECT * FROM states where id='$state_id'"); 
			$stmt1->execute(); 
			$row2 = $stmt1->fetch();
			?>
			<td colspan="4"><input type="text" class="form-control" id="txt_State" name="txt_State" value="<!?php echo  $row2['statename'];?>" readonly></td>
			</tr-->
			
			<!--tr>
				<td>City</td>
					<!?php
					$city_id=$row['city'];
					$stmt2 = $con->prepare("SELECT id,city_name FROM cities where id='$city_id'"); 
					$stmt2->execute(); 
					$row3 = $stmt2->fetch();
					?>
				<td colspan="4"><input type="text" class="form-control" id="txt_City" name="txt_City" value="<!?php echo  $row3['city_name'];?>" readonly></td>
			</tr-->
			
			<!--tr id="txt_gst_noo">
				<td>GST NO</td>
				<td colspan="4"><input type="text" class="form-control" id="txt_gst_no" name="txt_gst_no"  value="<!?php echo  $row['gst_no'];?>"readonly></td>
				<input type="hidden" name="txt_duplicate_gstno" id="txt_duplicate_gstno">
			</tr-->
			
			<!--tr id="txt_pan_noo">
				<td>PAN NO</td>
				<td colspan="4"><input type="text"  class="form-control" id="txt_pan_no_1" name="txt_pan_no_1" value="<!?php echo  $row['pan_no'];?>" readonly></td>
				<input type="hidden" name="txt_duplicate_panno" id="txt_duplicate_panno">
			</tr-->
			<tr>
				<td>Company Address</td>
				<td colspan="4"><input type="text" class="form-control" id="txt_address_1" name="txt_address_1" value="<?php echo $row['Address'];?>"placeholder =" Enter The Address" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control " id="txt_area_1" name="txt_area_1" value="<?php echo $area;?>" readonly></td>
				<td colspan="2"><input type="text" class="form-control pin" id="txt_pincode_1" value="<?php echo $pincode;?>" name="txt_pincode_1" readonly></td>
			</tr>
			<tr>
				<td>Client Department</td>
				<?php
                 $client_dep=$row['client_department'];

				 if($client_dep==1)
				 {
					 $client_department="IT Department";
				 }elseif($client_dep==2)
				 {
					 $client_department="Purchase Department";
				 }elseif($client_dep==3)
				 {
					 $client_department="Finance Department";
				 }elseif($client_dep==4)
				 {
					$client_department="Others"; 
				 }else{
					$client_department=""; 
				 }
				?>
				<td colspan="5">
					<input type="mail" class="form-control " value="<?php echo $client_department;?>" id="txt_mail1" name="txt_mail1" readonly>
				</td>
			</tr>
			<tr>
				<td>Client Details</td>
				<td colspan="2"><input type="mail" class="form-control " value="<?php echo $it_name;?>" id="txt_client_name_1" name="txt_client_name_1" readonly></td>
				<td colspan="2"><input type="text" class="form-control " value="<?php echo $it_designation;?>" id="txt_client_desig_1" name="txt_client_desig_1" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control mob" value="<?php echo $it_mob1;?>" id="txt_mobileone_1" maxlength="10" name="txt_mobileone_1" readonly></td>
				<td colspan="2"><input type="text" class="form-control amob" value="<?php echo $it_mob2;?>" id="txt_mobiletwo_1" maxlength="10" name="txt_mobiletwo_1" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="mail" class="form-control mail" value="<?php echo $it_mail1;?>"id="txt_mail_idone_1" name="txt_mail_idone_1" readonly></td>
				<td colspan="2"><input type="mail" class="form-control amail" value="<?php echo $it_mail1;?>" id="txt_mail_idtwo_1" name="txt_mail_idtwo_1" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="4"><input type="text" class="form-control " value="<?php echo $it_landno;?>" id="txt_landno_1" name="txt_landno_1" readonly></td>
				</td>
			</tr>			
			<tr>
				<td>Status*</td>
				<td colspan="4">
				<?php
				$status_value=$row['status'];
				if($status_value==1)
				{ 
			    $value="Active"; 
				}else{ 
				$value="In Active";
				}
				?>
				<input type="text" class="form-control " value="<?php echo $value;?>" id="status" name="status" readonly></td>
			</tr> 
			
		</table>
	</table>
	<br>
				  <br>
		<table class="table table-bordered">
			<h3><center>Feedback Entry Details</center></h3>
				<tbody>
					<?php

					$sql=$con->query("SELECT * FROM  feedback_enquiry_crm where enquiry_id='$id'");
				//echo"SELECT * FROM  feedback_enquiry_crm where enquiry_id='$id'"; 

					$cnt=1;
					while($rows = $sql->fetch(PDO::FETCH_ASSOC))

					{
						
							?>
					<tr>
					<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $id; ?>">
					<td>Feedback</td>
					<td><input type="text" class="form-control" id="feedback_1" name="feedbacks[]" value="<?php echo  $rows['Feedback']; ?>" readonly></td>



					<td>Feedback Date:</td><td colspan="1"><input type="text" class="form-control" id="date_1" name="dates[]" value="<?php echo  $rows['feedback_date']; ?>" readonly></td>

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
                
				<?php if($row['enquiry_status']==1){
				 
			 ?>
              <input type="button" class="btn btn-success" id="save" name="save" onclick="enquiry_accept()" value="Save">
			   <br>
			  <br>
			 
			   <input type="button" class="btn btn-primary" id="save" name="save" onclick="change_status()" value="Generate Lead">
			 	 <?php
			 }
			 ?>
			
       <?php
            $sql2 = $con->query("SELECT status FROM same_address WHERE `enquiry_id`= '$id' ");
			$row2 = $sql2->fetch(PDO::FETCH_ASSOC);
            $status = $row2['status'];
			
			if($status!=1){
        ?>			

		<table class="table table-bordered">	
		 <h3><center>Ship to Address</center></h3>
             <tr>
			    <td> 
				<input type="checkbox"  id="same_address" name="same_address" onclick="same_location()" value="<?php echo $id;?> ">Same Address
                </td>				
             </tr>	
			 
			  <tr>
					<td>Location</td>
					<td colspan="5">
					    <input type="text" class="form-control" name="newlocation" id="newlocation" autocomplete="off" placeholder ="Location">
					</td>									
				</tr>
				
				<tr>
					<td>Address</td>
					<td colspan="5"><input type="text" class="form-control" placeholder="Enter Address"  id="Address" name="Address" autocomplete="off"></td>
				</tr>
				
				<tr>
				    <td> </td>
					<td colspan="2"><input type="text" class="form-control " id="area_1" name="area_1" placeholder ="Area" autocomplete="off"></td>
					<td colspan="2"><input type="text" class="form-control pin" id="pincode_1" name="pincode_1" placeholder ="Pincode" autocomplete="off"></td>
				</tr>
				
			<tr>
			 <td>
			  <input type="button" class="btn btn-success" id="submit" name="submit" onclick="same_addressvalue()" value="Save">
			 </td>  
			</tr>
			
		</table>
		<?php
			}
		?>
		
		
		 <?php
            $sql2 = $con->query("SELECT * FROM same_address WHERE `enquiry_id`= '$id' ");
			$row2 = $sql2->fetch(PDO::FETCH_ASSOC);
            $status = $row2['status'];
			
		 if ($row['enquiry_status']==2 && $row['client_master_status']==2 && $status==1)  {
					
		?>
				
				
    <table class="table table-bordered">	
     <h3><center>Ship to Address</center></h3>
	 <tr>
		<td>Location</td>
		<td colspan="5">
			<input type="text" class="form-control" name="newlocation" id="newlocation" value="<?php echo $row2['location'];?>" readonly>
		</td>									
	 </tr>
				
	<tr>
		<td>Address</td>
		<td colspan="5">
		  <input type="text" class="form-control"  id="Address" name="Address" value="<?php echo $row2['address'];?>" readonly>
		</td>
	</tr>
				
	<tr>
		<td> </td>
		<td colspan="2">
		  <input type="text" class="form-control " id="area_1" name="area_1" value="<?php echo $row2['area'];?>" readonly>
		</td>
		<td colspan="2">
		  <input type="text" class="form-control pin" id="pincode_1" name="pincode_1" value="<?php echo $row2['pincode'];?>" readonly>
		</td>
	</tr>
				
	<tr>
		<td>
		<input type="button" class="btn btn-primary" id="save" name="save" onclick="Quote_status()" value="Generate Cost Sheet">
		</td>  
	</tr>
			
</table>
				
				
		
              
		
		
			 <?php
				}
				?>
    </form>
			   
			
			  
            </div>
	
<script>
 function same_addressvalue()
    {
   var id=$('#get_id').val();
   var data = $('form').serialize();
     //alert(data);
	
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
    url:'/KerliERP/CRM/insert_address.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not');
      }
      else
      {
        alert("Updated Successfully");
	    lead()
      }
      }           
    });
    }

 
  //Pincode Validation
 $(document).ready(function(){             
$(".pin").change(function () {      
var inputvalues = $(this).val();      
  var regex =/^(\d{4}|\d{6})$/;    
  if(!regex.test(inputvalues)){      	
  $(".pin").val("");    
  alert("Please Enter Valid PINCODE");    
  return regex.test(inputvalues);    
  }    
});      
    
});
</script>
	
<script>
function same_location() 
{
 var data = $('form').serialize();
 
$.ajax({
url: "/KerliERP/CRM/find_same_address.php",
type: "get",
data: data,
cache: false,
processData: false,
success: function(data)
{
var split=data.split("=");

$('#newlocation').val(split[0]);
$('#Address').val(split[1]);
$('#area_1').val(split[2]);
$('#pincode_1').val(split[3]);


$('#newlocation').attr('readonly', 'readonly');
$('#Address').attr('readonly', 'readonly');
$('#area_1').attr('readonly', 'readonly');
$('#pincode_1').attr('readonly', 'readonly');

}
});
}

</script>	





	
<script>
 function enquiry_accept()
    {
    var id=$('#get_id').val();
	//alert(id);
 var data = $('form').serialize();
 
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
	
    url:'/KerliERP/CRM/accept_enquiry.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not');
      }
      else
      {
        alert("Update Successfully");
	 enquiry()
      }
      }           
    });
    }
	
		
 function Quote_status()
    {
    var id=$('#get_id').val();
	//alert(id);
 var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
	
    url:'/KerliERP/CRM/quote_enquiry.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not');
      }
      else
      {
        alert("Costsheet Generated");
	    lead()
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
