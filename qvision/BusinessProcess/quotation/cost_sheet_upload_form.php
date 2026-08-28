<?php
require '../../../connect.php';
include("../../../user.php");
$costsheet_id=$_REQUEST['id'];
//echo $cost_sheet_id;
$userrole = $_SESSION['userrole'];
$stmt = $con->prepare("SELECT a.id as costsheet_id,a.*,b.*,e.*,f.*,g.* from cost_sheet_entry a 
		 inner join client_master b on(b.id=a.client_id) 
		 inner join product_services f on (f.id = a.business_id)
		INNER JOIN staff_master e ON e.candid_id=a.candid_id 
		inner join z_user_master g ON (g.candidate_id = e.id)
		where a.id='$costsheet_id'  and a.status ='1' "); 

$stmt->execute(); 
$row = $stmt->fetch();

if($row['mapping_id'] =='1'){
	  $pro_ser_type = "Product";
   }else if($row['mapping_id'] =='2'){
	  $pro_ser_type = "Service";
   }else if($row['mapping_id'] =='3'){
	  $pro_ser_type = "Solution";
   }
 //if($row['list']!==''){
    $name = $row['name'];
 //}

//$company_id = $row['company_id'];
$client_id  = $row['client_id'];
$quote_type = $row['quote_type'];
$vendor_id  = $row['vendor_id'];
$design_id  = $row['design_id'];
$cost_sheet_no = $row['cost_sheet_no'];


?>

<style>
.form-control{
-webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 0%);
.table>tbody>tr>td{
    padding: 4px !important;
}
.table {
        margin-bottom: 0px !important;
}
</style>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
<div class="card card-info">
	  <div class="card-header">
	    <h2 class="card-title"><font size="4"><b>COST SHEET - VENDOR UPLOAD</b></font> </h2></div> <br/>
		     
	<form action=" qvision/BusinessProcess/quotation/cost_sheet_upload_form.php" method="post" enctype="multipart/form-data">
	  <div class="card-body">
	 <div class="form-group row">
	        <div class="col-sm-4"> Procduct/Service/Solution
				<input type="hidden" class="form-control" id="enquiry_id" name="enquiry_id" value="<?php echo $row['enquiry_id']; ?>" readonly>

			   <input type="hidden" class="form-control" id="_" name="costsheet_id" value="<?php echo $row['costsheet_id']; ?>" readonly>
			   <input type="hidden" class="form-control" id="old_quote_no" name="old_quote_no" value="<?php echo $row['old_quote_no']; ?>" readonly>
	           <input type="text" class="form-control" id="pro_ser_id" name="pro_ser_id" value="<?php echo $pro_ser_type; ?> - <?php echo $name; ?>" readonly>
			   <input type="hidden" class="form-control" id="mapping_id" name="mapping_id" value="<?php echo $row['mapping_id']; ?>" readonly>
			</div>
			<!--<div class="col-sm-4">
				<select class="form-control" id="company_id" name="company_id" readonly="readonly">
					
					<?php $query = $con->query("SELECT * FROM company_master where id='$company_id'");
						  while ($row_fetch = $query->fetch()) {?>
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['companyname']; ?> </option>
					<?php } ?>
				</select>
			</div>-->
			<div class="col-sm-4">Client Name
				<select class="form-control" id="client_id" name="client_id" readonly="readonly"> <!--onchange="showDiv(this)"-->
					
					<?php $query = $con->query("SELECT * FROM client_master where id ='$client_id'");
						  while ($row_fetch = $query->fetch()) {?>
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['client_name']; ?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="col-sm-4">Quote Type
				<select class="form-control" id="quote_type" name="quote_type" readonly="readonly"> <!--onchange="showDiv(this)"-->
					
					<?php if($quote_type =='1'){ ?>
					<option value="1">INR</option>
					<?php }else{ ?>
					<option value="2">$</option>
					<?php } ?>
				</select>
			</div>
		  </div>
		</div>
 <!-- <form action="qvision/BusinessProcess/quotation/cost_sheet_upload_form.php" method="post" enctype="multipart/form-data">
  qvision/BusinessProcess/quotation/cost_sheet_upload_form.php
  <div class="card-body">
	 <div class="form-group row">-->
	 
	  <table id="dataTable" width="300px" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered">
		 <thead>
			<tr>
			  
			  <th>SPECIFICATION</th>
			  <th>QTY</th>
			  <th>UNIT</th>
			  <th>UNIT RATE</th>
			  <th formula="cost*qty" summary="sum">AMOUNT</th>
			  <th colspan='2'>Logistic</th>
			  <th colspan='2'>Engineer</th>
			  <th colspan='2'>Margin</th>
			  <th>Total Items</th>
			</tr>
		 </thead>
		  <tbody>
		<?php  
		 $query= $con->query("SELECT a.id as costsheet_id,a.*,b.*,e.* from cost_sheet_entry a 
				 inner join client_master b on(b.id=a.client_id) 
				 inner join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='1' and a.cost_sheet_no='$cost_sheet_no' order by a.id desc"); 
		     
			   $cnt=1; 
		 while($cost = $query->fetch(PDO::FETCH_ASSOC)){ 
		    
			 /* echo "hi";
			 echo "SELECT a.id as costsheet_id,a.*,b.*,e.* from cost_sheet_entry a 
				 inner join client_master b on(b.id=a.client_id) 
				 inner join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='1' and a.cost_sheet_no='$cost_sheet_no'"; */
				 
				//echo  $cnt;  	 
		?>
		<tr>
		 
		  <td>
		    <INPUT type="hidden" id="cost_sheet_no" name="cost_sheet_no" class="form-control" value="<?php echo $cost['cost_sheet_no']; ?>" readonly="readonly">
			<INPUT type="text" id="item1" name="item[]" class="form-control" value="<?php echo $cost['specification']; ?>" readonly="readonly"></td>
		  <td>
			<INPUT type="text" id="qty1" name="qty[]" onchange="totalIt()" class="form-control" value ="<?php echo $cost['qty']; ?>" readonly="readonly"> </td>
		  <td>
			<INPUT type="text" id="unit1" name="unit[]" class="form-control" value="<?php echo $cost['unit']; ?>" readonly="readonly"> </td>
			
		  <td>
			<INPUT type="text" id="cost1" name="cost[]" onchange="totalIt()" class="form-control" value="<?php echo $cost['unit_rate']; ?>" readonly="readonly"> </td>
		  <td>
			<INPUT type="text" id="price1" name="price[]" onchange="totalIt()" readonly="readonly" value="<?php echo $cost['total_price']; ?>" class="form-control"> </td>
		  <td>
			<input type="text" id="log_per1" name="log_per[]" class="form-control log_per " onchange="totalIt()" placeholder="%" value="<?php echo $cost['log_per']; ?>" >
		</td>
		<td>
			<input type="text" id="log_amt1" name="log_amt[]" class="form-control"  placeholder="0.00" readonly value="<?php echo $cost['log_amt']; ?>" >
		</td>
		
		<td> 
		    <INPUT type="text" id="eng_per1" name="eng_per[]" class="form-control eng_per"  onchange="totalIt()" placeholder="%" value="<?php echo $cost['eng_per']; ?>" readonly>
		</td>
		  
		<td>
		   <INPUT type="text" id="eng_amt1" name="eng_amt[]" class="form-control " placeholder="0.00" readonly value="<?php echo $cost['eng_amt']; ?>" >
		</td>
		  
		<td >
		    <INPUT type="text" id="com_per1" name="com_per[]" class="form-control com_per"  onchange="totalIt()" placeholder="%" value="<?php echo $cost['com_per']; ?>" readonly>
		</td>
		<td >
		   <INPUT type="text" id="com_amt1" name="com_amt[]" class="form-control"  placeholder="0.00" readonly value="<?php echo $cost['com_amt']; ?>" >
		</td>
		
		<td >
		   <INPUT type="text" id="col_item1" name="col_item[]" class="form-control"  placeholder="0.00" readonly value="<?php echo $cost['total_amt']; ?>" >
		</td>
		
		
		  
		  <!--<td>
		    <INPUT type="button" class="btn btn-success" value="Add " onclick="addRow('dataTable')" />
	        <INPUT type="button" class="btn btn-danger" value="Delete" onclick="deleteRow('dataTable')" />
		   </td>-->
		</tr>
		 <?php $cnt++; } ?>
		</tbody>
		<?php  $query1= $con->query("SELECT a.id as costsheet_id,a.*,b.*,e.* from cost_sheet_entry a 
				 inner join client_master b on(b.id=a.client_id) 
				 inner join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='1' and a.cost_sheet_no='$cost_sheet_no' order by a.id desc"); 
				 $query1->execute(); 
                 $row1 = $query1->fetch();
				 $costsheet_date_str  = $row1['costsheet_date'];
				 $com_per  = $row1['com_per'];
                 $costsheet_date = date('d-m-Y', strtotime($costsheet_date_str));	
				 ?>
	   <table id="dataTable" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
	   <tr>
		  <td colspan="5" align="center"><b>Net Amount</b></td>
		 
		  <td align="right">
		    <INPUT type="text" id="total_item" name="total_item" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['net_amt']; ?>" readonly="readonly">
		  </td>
		</tr>
		<tr>
		  <td colspan="5" align="center"><b>Gst Persentage <?php echo $row1['gst_per']; ?>%</b></td>
		  <td colspan="3" align="right">
		    <INPUT type="text" id="gst_per" name="gst_per" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['gst_amt']; ?>" readonly="readonly">
		  </td>
		</tr>
		<tr>
		  <td colspan="5" align="center"><b>Grand Total</b></td>
		  <td colspan="3" align="right">
		    <INPUT type="text" id="grand_total" name="grand_total" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['grand_amt']; ?>" readonly="readonly">
		  </td>
		</tr>
	  </table>	
	  </table>
	
	 <table id="dataTable" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
	   <tr>
		  <td colspan="5"><b>Cost Sheet Date</b></td>
		  <td align="left"><b>
		    <?php echo $costsheet_date; ?>
		  </td>
		</tr>
		 <tr>
		  <td colspan="5"><b>Employee Name</b></td>
		  <td align="left">
		     <b><input type="text" id="emp_name" style ="border:none;" value="<?php echo $row['emp_name'];?>" readonly>
		  </td>
		</tr>
		<?php $query1=  $con->prepare("select designation_name from designation_master where id ='$design_id'");
         	$query1->execute(); 
            $row1 = $query1->fetch();
		?>
		<tr>
		  <td colspan="5"><b>Designation Name</b></td>
		  <td align="left">
		     <b><?php echo $row1['designation_name'];?>
		  </td>
		</tr>
		
		 <tr>
		  <td colspan="5"><b>Phone No</b></td>
		  <td align="left">
		     <b><?php echo $row['mobile_no'];?>
		  </td>
		</tr>
		 <tr>
		  <td colspan="5"><b>Email Id</b></td>
		  <td align="left">
		     <b><?php echo $row['email_id'];?>
			  <input type="hidden" id="candid_id" value ="<?php echo $row['candid_id'];?>" readonly>
		  </td>
		</tr>
		 <tr>
		  <td colspan="5"><b>Vendor name</b></td>
		  <td align="left">
		     <b><select class="form-control" name="vendor_name" style="width:40%;">
    <option disabled selected>-- Select vendor --</option>
	
				
				 <?php $stmt = $con->query("SELECT id,vendor_name FROM doller_vendor_mastor");
				while ($row = $stmt->fetch()) {?>
				 <option value="<?php  echo $row['id'];?>"> <?php echo $row['vendor_name']; ?> </option>
			<?php } ?>
		</select> 

		  </td>
		</tr>
		<tr>
		  <td colspan="5"><b>cost price Upload</b></td>
		  <td align="left">
		     <b><input type="file" name="file"   />
		  </td>
		</tr>
		<tr>
		  <td colspan="5"><b>cost price Amount</b></td>
		  <td align="left">
		     <b><input type="text" name="amount" class="form-control" style="width:40%;"/>
		  </td>
		</tr>
		<tr>
		  <td colspan="6">
		  <input type="submit" class='btn btn-success'name="update" id="update" value="update" />
	
		  </td>
		</tr>
	 </table>
 </div> 
 </div>
	 
	  </form>
	  </div>
     </div>
	 </div>
    
<?php
	if(isset($_POST['update']))
{   
   $amount=$_POST['amount'];
   $enquiry_id=$_POST['enquiry_id'];
   
   $vendor_name=$_POST['vendor_name'];
   $cost_sheet_no=$_POST['cost_sheet_no'];
   $status='2';
 $file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 $folder="uploads/";
 
 /* new file size in KB */
 $new_size = $file_size/1024;  
 /* new file size in KB */
 
 /* make file name in lower case */
 $new_file_name = strtolower($file);
 /* make file name in lower case */
 
 $final_file=str_replace(' ','-',$new_file_name);
 
 if(move_uploaded_file($file_loc,$folder.$final_file))
 {
    echo "successful";
 }else{
	 echo "Error";
 }
 
  $update_query=$con->query("update cost_sheet_entry set vendor_id='$vendor_name',file_upload='$final_file',file_amount='$amount', status='$status' where cost_sheet_no='$cost_sheet_no'");
/*   echo "update cost_sheet_entry set vendor_id='$vendor_name',file_upload='$final_file',file_amount='$amount', status='$status' where cost_sheet_no='$cost_sheet_no'"; */
	$insert_query2= $con->query("Update enquiry set status='5' where id='$enquiry_id'");
	$insert_query2= $con->query("Update cost_sheet_entry set status='2' WHERE cost_sheet_no= '$cost_sheet_no'");
	echo "Update cost_sheet_entry set status='2' WHERE cost_sheet_no= '$cost_sheet_no'";
	echo "<script>
alert('file Uploaded Successfuly');
window.location.href='../../../index.php';
</script>";
        
  
 }

?>

	 
   
   
	
	  
	