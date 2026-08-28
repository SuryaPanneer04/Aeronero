<?php
require '../config.php';
include("../../user.php");
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT a.id as enquiry_id,a.status as enquiry_status,a.*,b.*,c.*,d.*,e.*,f.name as eqp_name,f.*  FROM enquiry a left join calls_master b on (a.call_type=b.id) left join z_department_master c on (a.Department=c.id) left join staff_master d on(a.employee=d.candid_id) left join products_master e on(a.product=e.Product_id) left join product_services f on (a.list=f.id)where a.id='$id'");

/*  echo "SELECT a.id as enquiry_id,a.status as enquiry_status,a.*,b.*,c.*,d.*,e.*,f.name as eqp_name,f.*  FROM enquiry a left join calls_master b on (a.call_type=b.id) left join z_department_master c on (a.Department=c.id) left join staff_master d on(a.employee=d.candid_id) left join products_master e on(a.product=e.Product_id) left join product_services f on (a.list=f.id)where a.id='$id'";  */

$stmt->execute(); 
$row = $stmt->fetch();
?>
<div class="card card-primary">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>View Enquiry</b></h3></center>
		<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"></i>Back</a>
              </div>
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="qvision/images/logo123.jpg" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
        </tr>
         <?php
					$client_value=$row['Client_type'];
					if($client_value==1){
						$clients_type="Existing";
					}else{
					    $clients_type="New";	
					}
					
					?>
		  <tr>
		<td>Client Type:</td>
		<td colspan="5"><input type="text" class="form-control" value="<?php echo $clients_type; ?>" id="Client_type" name="Client_type" readonly></td>
        </tr>
        
       <tr>
			<td>Call_type:</td>
			<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $row['enquiry_id']; ?>">
			<?php
			$Call_type=$row['Call_type'];
			$stmtC = $con->query("SELECT * FROM calls_master where id='$Call_type'");
							$rowC = $stmtC->fetch();?>
			<td colspan="5"><input type="text" class="form-control" value="<?php echo $rowC ['name']; ?>" id="Call_type" name="Call_type" readonly></td>
        </tr>
        <tr>
			<td>Date</td>
			<td colspan="5"><input type="text" class="form-control"  value="<?php echo $row ['date']; ?>" id="date" name="date" readonly></td>
			</tr>
        <tr>
			<td>Company Name</td>
			<td colspan="5">
			 <input type="text" class="form-control"  value="<?php echo $row ['Company_name']; ?>" id="Company_name" name="Company_name" placeholder="Enter Company" readonly></td>
			
        </tr>
        <tr>
       <td>Location</td>
        <td colspan="5"><input type="text" class="form-control" value="<?php echo $row ['Location']; ?>" id="Location" name="Location" readonly></td>
        </tr>
        <tr>
        <td>Address</td>
        <td colspan="5"><input type="text" class="form-control" value="<?php echo $row ['Address']; ?>" id="Address" name="Address" readonly></td>
        </tr>
        
         <tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control " id="txt_area_1" name="txt_area_1" value="<?php echo $row ['area']; ?>" readonly></td>
				<td colspan="2"><input type="text" class="form-control pin" id="txt_pincode_1" name="txt_pincode_1" value="<?php echo $row ['pincode']; ?>" readonly></td>
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
				<td colspan="2"><input type="text" class="form-control " value="<?php echo $row ['it_name']; ?>" id="txt_client_name_1" name="txt_client_name_1" placeholder ="Client name" readonly></td>
				<td colspan="2"><input type="text" class="form-control " value="<?php echo $row ['it_designation']; ?>" id="txt_client_desig_1" name="txt_client_desig_1" placeholder ="Client Designation" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" class="form-control mob" id="txt_mobileone_1" value="<?php echo $row ['it_mob1']; ?>" name="txt_mobileone_1" readonly></td>
				<td colspan="2"><input type="text" class="form-control amob" id="txt_mobiletwo_1" value="<?php echo $row ['it_mob2']; ?>" name="txt_mobiletwo_1" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><input type="text" value="<?php echo $row ['it_mail1']; ?>" class="form-control mail" id="txt_mail_idone_1" name="txt_mail_idone_1" readonly></td>
				<td colspan="2"><input type="text" value="<?php echo $row ['it_mail2']; ?>" class="form-control amail" id="txt_mail_idtwo_1" name="txt_mail_idtwo_1" readonly></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="4"><input type="text" value="<?php echo $row ['it_landno']; ?>" class="form-control " id="txt_landno_1" name="txt_landno_1" readonly></td>
				</td>
			</tr>
			
		<tr>
        <td>Product/Service</td>
		<?php
                 $Product=$row['Product'];

				 if($Product=='1')
				 {
					 $Product_value="Product";
				 }elseif($Product=='2')
				 {
					 $Product_value="Services";
				 }elseif($Product=='3')
				 {
					 $Product_value="Solution";
				 }
				?>
        <td colspan="5"><input type="text" value="<?php echo $Product_value; ?>" name="Product" class="form-control" id="Product" readonly></td>
        </tr>
		<tr>
		<td></td>
		<?php
		$list=$row['list'];
			$stmtl = $con->query("SELECT * FROM product_services where id='$list'");
							$rowl = $stmtl->fetch();?>
		 <td colspan="5"><input type="text" value="<?php echo $rowl ? $rowl['name'] : ''; ?>" class="form-control" name="services" id="services" readonly>		
		</td>
        </tr>
		<tr>
        <td>Remarks</td>
        <td colspan="5">
			<input type="text"  id="Feedback" name="Feedback" value="<?php echo $row ['Feedback']; ?>" class="form-control"  readonly>
		</td>
        </tr>
		<tr>
        <td>Followup Date</td>
        <td colspan="5">
			<input type="text"  id="Follup" name="Follup" value="<?php echo $row ['Follup']; ?>" class="form-control"  readonly>
		</td>
        </tr>
		
		<tr>
		<td>Company:</td>
		<td colspan="5">
		<input type="text"  id="companys" name="companys" value="<?php echo $row ['companys']; ?>" class="form-control"  readonly >
		</td>
        </tr>
		
		 
		 <tr>
		<td>Department :</td>
		<td colspan="5"><input type="text" class="form-control" id="Department" name="Department"  value="<?php echo $row ['dept_name']; ?>" readonly></td>
        </tr>
		<tr>
		<td>Employee :</td>
		<td colspan="5">
		 <input type="text" class="form-control" name="employee" id="employee" value="<?php echo $row ['emp_name']; ?>" readonly></td>
        </tr>

        </table>
        <!-- /.post -->
 
				  <br>
				  <br>
				  <table class="table table-bordered">
<h3><center>Feedback Entry Details</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT * FROM  feedback_enquiry_crm where enquiry_id='$id'");
//echo "SELECT * FROM  feedback_enquiry_crm where enquiry_id='$id'";


$cnt=1;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))

{
	
?>
<tr>

<td>Feedback:</td>
<td><input type="text" class="form-control" id="feedback_1" name="feedbacks[]" value="<?php echo  $rows['Feedback']; ?>" readonly></td>


<td>Feedback Followup Date:</td><td colspan="1"><input type="text" class="form-control" id="date_1" name="dates[]" value="<?php echo  $rows['feedback_date']; ?>" readonly></td>

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
      <td><input type="date" class="form-control" id="date_1" name="f_date[]"></td>
      
     
      <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
      <input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
    </td>
    </tr>
   
     
    </table>
	 	 <?php
			 }
			 ?>
                </div>
				<?php if($row['enquiry_status']==1){
				 
			 ?>
              <input type="button" class="btn btn-success" id="save" name="save" onclick="enquiry_accept()" value="Save">
			   <br>
			  <br>
			  
			   <input type="button" class="btn btn-primary" id="save" name="save" onclick="change_status()" value="Generate Lead">
			 	 <?php
			 }
			 ?>
              </form>
			   
			
			  
            </div>
			
			<script>

	
 function enquiry_accept()
    {
    var id=$('#get_id').val();
	//alert(id);
 var data = $('form').serialize();
 
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
	
    url:'qvision/CRM/accept_enquiry.php',
    success:function(data)
    {
      if(data.trim() == "2")
      { 
        alert("Update Successfully");
	    enquiry();
      }
      else
      {
        alert("Error: " + data);
      }
    }           
    });
    }
	
		
 function change_status()
    {
    var id=$('#get_id').val();
	//alert(id);
 var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
	
    url:'qvision/CRM/change_status.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not');
      }
      else
      {
        alert("Update Successfully");
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
    $('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><input type="text" class="form-control" id="feedback_'+len+'" name="feedback[]"></td><td><input type="date" class="form-control" id="date_'+len+'" name="f_date[]"></td></tr>'); 
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