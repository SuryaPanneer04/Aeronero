<?php
require '../../../connect.php';
include("../../../user.php");
$costsheet_id=$_REQUEST['id'];
$userrole = $_SESSION['userrole'];
$candidateid=$_SESSION['candidateid'];
if($userrole=='R001' or 'R010')
{
	$stmt = $con->prepare("SELECT a.id as costsheet_id,a.*,b.*,e.*,f.*,g.*,b.org_name as company_name,a.status as costsheet_status,a.created_by as emp_created,a.enquiry_id as eeqq from cost_sheet_entry a 
		 left join new_client_master b on(b.id=a.client_id) 
		 left join product_services f on (f.id = a.business_id)
		left JOIN staff_master e ON e.candid_id=a.candid_id 
		left join z_user_master g ON (g.candidate_id = e.id)
		where a.id='$costsheet_id' "); 
		
 
}
else
{
	
	$stmt = $con->prepare("SELECT a.id as costsheet_id,a.*,b.*,e.*,f.*,g.*,b.org_name as company_name,a.status as costsheet_status,a.created_by as emp_created from cost_sheet_entry a 
		 left join new_client_master b on(b.id=a.client_id) 
		 left join product_services f on (f.id = a.business_id)
		left JOIN staff_master e ON e.candid_id=a.candid_id 
		left join z_user_master g ON (g.candidate_id = e.id)
		where a.id='$costsheet_id' and a.status ='1'  "); 
		/* echo "SELECT a.id as costsheet_id,a.*,b.*,e.*,f.*,g.*,b.org_name as company_name,a.status as costsheet_status,a.created_by as emp_created from cost_sheet_entry a 
		 left join new_client_master b on(b.id=a.client_id) 
		 left join product_services f on (f.id = a.business_id)
		left JOIN staff_master e ON e.candid_id=a.candid_id 
		left join z_user_master g ON (g.candidate_id = e.id)
		where a.id='$costsheet_id' and a.status ='1'  ";  */
}
		
/* echo "SELECT a.id as costsheet_id,a.*,b.*,e.*,f.*,g.* from cost_sheet_entry a 
		 inner join client_master b on(b.id=a.client_id) 
		 inner join product_services f on (f.id = a.business_id)
		INNER JOIN staff_master e ON e.candid_id=a.candid_id 
		inner join z_user_master g ON (g.candidate_id = e.id)
		where a.id='$costsheet_id'  and a.status ='1' "; */
		
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
   // $name = $row['name'];
 //}

//$company_id = $row['company_id'];
$edit_status  = $row['edit_status'];
$enquiry_id  = $row['enquiry_id'];

	$chwck = $con->prepare("SELECT MAX(id) as las_max,edit_status,enquiry_id,cost_sheet_no from cost_sheet_entry where enquiry_id='$enquiry_id'"); 
		
		
$chwck->execute(); 
$raw = $chwck->fetch();

$las_max  = $raw['las_max'];
$las_status  = $raw['edit_status'];



$emp_created  = $row['emp_created'];
$client_id  = $row['client_id'];
$quote_type = $row['quote_type'];
$vendor_id  = $row['vendor_id'];
$design_id  = $row['design_id'];
$cost_sheet_no = $row['cost_sheet_no'];
$company_name = $row['company_name'];
$costsheet_status = $row['costsheet_status'];

	$client=$row['client'];//echo $client;echo '****';
	$full_name=$row['full_name'];//echo $full_name;echo '****';
	$user_name=$row['user_name'];//echo $user_name;echo '****';
	$org_name=$row['org_name']; //echo $org_name;echo '****';


?>

	
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
	
<section class="wage_content">
<div  class="card card-primary">
              <div class="card-header">
                <h3 style="float: left;"><font size="5">COST SHEET APPROVE</font></h3>
		 		  <a onclick=" back()" style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i> BACK</a>
		
              </div>
 
	<form action="" method="post" enctype="multipart/form-data">
	  <div class="card-body">
	 <div class="form-group row">
		    <div class="col-sm-3"><b>Product/Service/Solution</b>
				<input type="hidden" class="form-control" id="enquiry_id" name="enquiry_id" value="<?php echo $row['eeqq']; ?>" readonly>
			   <input type="hidden" class="form-control" id="costsheet_id" name="costsheet_id" value="<?php echo $row['costsheet_id']; ?>" readonly>
			   <input type="hidden" class="form-control" id="las_status" name="las_status" value="<?php echo $las_status; ?>" readonly>
			   <input type="hidden" class="form-control" id="old_quote_no" name="old_quote_no" value="<?php echo $row['old_quote_no']; ?>" readonly>
			   <input type="hidden" class="form-control" id="business_id" name="business_id" value="<?php echo $row['business_id']; ?>" readonly>
	           <input type="text" class="form-control" id="pro_ser_id" name="pro_ser_id" value="<?php echo $pro_ser_type; ?>" readonly>
			   <input type="hidden" class="form-control" id="mapping_id" name="mapping_id" value="<?php echo $row['mapping_id']; ?>" readonly>
			</div>
			<!--<div class="col-sm-4">
				<select class="form-control" id="company_id" name="company_id" readonly="readonly">
					
					<?php $query = $con->query("SELECT * FROM company_master where id='$company_name'");
						  while ($row_fetch = $query->fetch()) {?>
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['companyname']; ?> </option>
					<?php } ?>
				</select>
			</div>-->
			<div class="col-sm-3"><b>Client Name</b>
				<select class="form-control" id="org_name" name="org_name" readonly required> <!--onchange="showDiv(this)"-->
					
					<?php $query1 = $con->query("SELECT * FROM new_client_master where org_name ='$company_name'");
					//echo "SELECT * FROM client_master where client_name ='$client_name'";
						  while ($row_fetch = $query1->fetch()) {?>
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['org_name']; ?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="col-sm-3"><b>Client Contact Person Name</b>
				<select class="form-control" id="client_id" name="client_id" readonly required> <!--onchange="showDiv(this)"-->
					
					<?php $query2 = $con->query("SELECT *,p.id as id FROM new_client_master c join new_plant_master p on org_name=client_org_name where org_name ='$company_name'");
					//echo "SELECT * FROM client_master where client_name ='$client_name'";
						  while ($row_fetch = $query2->fetch()) {?>
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['contact_person']; ?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="col-sm-3"><b>Quote Currency Type</b>
				<select class="form-control" id="quote_type" name="quote_type" readonly="readonly"> <!--onchange="showDiv(this)"-->
					<?php if($quote_type =='1'){ ?>
					<option value="1">INR</option>
					<?php }else{ ?>
					<option value="2">$</option>
					<?php } ?>
				</select>
			</div>
			
			
			
			
			
			</div>
		  

 <table id="dataTable" width="300px" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;width: 126%;" class="table table-bordered">
		 <thead>
			<tr>
			  <th>PRODUCT NAME</th>
			  <th>PRODUCT ID</th>
			  
			  <th style="width: 157%;">DESCRIPTION</th>
			  <th>QTY</th>

			  <th>UNIT RATE</th>
			  <th formula="cost*qty" summary="sum">Purchase Amount</th>
			  <th colspan='2'>Dist Margin %</th>
			   <th colspan='2'>Overall Margin</th>
			   <th>Selling Price</th>
			  <th colspan='2'>Logistics</th>
			  <th colspan='2'>Service Cost</th>
			  <th>Total AMOUNT</th>
			  <th colspan='2'>GST</th>
			  <th colspan='2'>IGST</th>
			 <th>Total AMOUNT with GST</th>
			  
			  <th>Vendor</th>
			</tr>
		 </thead>
		  <tbody>
		<?php  
		 $query3= $con->query("SELECT a.id as costsheet_id,a.*,b.*,e.*,v.* from cost_sheet_entry a 
				 left join client_master b on(b.id=a.client_id) 
				 left join staff_master e ON e.candid_id=a.candid_id join doller_vendor_mastor v on a.vendor_id=v.id
				 where a.cost_sheet_no='$cost_sheet_no' order by a.id asc"); 
				 
		     /* echo "SELECT a.id as costsheet_id,a.*,b.*,e.* from cost_sheet_entry a 
				 left join client_master b on(b.id=a.client_id) 
				 left join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='1' or a.status ='0'  and a.cost_sheet_no='$cost_sheet_no' order by a.id desc"; */
			   $cnt=1; 
		 while($cost = $query3->fetch(PDO::FETCH_ASSOC)){ 
		    
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
			<?php echo $cost['product_name']; ?></td>
		  <td>
		  <?php echo $cost['product_id']; ?></td>
		  
		  <td>
		  <?php echo $cost['description']; ?></td>
		  <td>
			<?php echo $cost['qty']; ?></td>		
		  <td>
			<?php echo $cost['unit_rate']; ?></td>
		  <td>
			<?php echo $cost['total_price']; ?></td>
			 <td>
			<?php echo $cost['dist_per']; ?>
		</td>
		<td>
			<?php echo $cost['dist_amt']; ?>
		</td>
			<td >
		   <?php echo $cost['com_per']; ?>
		</td>
		<td>
		  <?php echo $cost['com_amt']; ?>
		</td>
		<td>
		  <?php echo $cost['sel_price']; ?>
		</td>
		
		  <td>
			<?php echo $cost['log_per']; ?>
		</td>
		<td>
			<?php echo $cost['log_amt']; ?>
		</td>
		
		<td> 
		    <?php echo $cost['eng_per']; ?>
		</td>
		  
		<td>
		  <?php echo $cost['eng_amt']; ?>
		</td>
		<td >
		  <?php echo $cost['total_amt']; ?>
		</td>
		 <td>
		  <?php echo $cost['gst_per']; ?>
		</td> 
	<td>
		  <?php echo $cost['gst_amt']; ?>
		</td>
		<td>
		  <?php echo $cost['igst_per']; ?>
		</td>
		<td>
		  <?php echo $cost['igst_amount']; ?>
		</td>
		<td>
		  <?php echo $cost['total_gst']; ?>
		</td>
		<td >
		  <?php echo $cost['vendor_name']; ?>
		</td>
		
		
		  
		  <!--<td>
		    <INPUT type="button" class="btn btn-success" value="Add " onclick="addRow('dataTable')" />
	        <INPUT type="button" class="btn btn-danger" value="Delete" onclick="deleteRow('dataTable')" />
		   </td>-->
		</tr>
		 <?php $cnt++; } ?>
		</tbody>
		<?php  $query1= $con->query("SELECT count(a.cost_sheet_no) as row_count, a.id as costsheet_id,sum(a.com_per) as com_per_val,a.*,b.*,e.* from cost_sheet_entry a 
				 left join client_master b on(b.id=a.client_id) 
				 
				 left join staff_master e ON e.candid_id=a.candid_id
				 where a.cost_sheet_no='$cost_sheet_no' order by a.id desc"); 
		
				 
			/* 	 echo "SELECT count(a.cost_sheet_no) as row_count, a.id as costsheet_id,sum(a.com_per) as com_per_val,a.*,b.*,e.*,v.vendor_name as vendor_name from cost_sheet_entry a 
				 inner join client_master b on(b.id=a.client_id) 
				 inner join doller_vendor_mastor v on a.vendor_id=v.id
				 inner join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='1' and a.cost_sheet_no='$cost_sheet_no' order by a.id desc";
				  */
				/*  echo "SELECT a.id as costsheet_id,sum(a.com_per) as com_per_val,a.*,b.*,e.* from cost_sheet_entry a 
				 inner join client_master b on(b.id=a.client_id) 
				 inner join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='1' and a.cost_sheet_no='$cost_sheet_no' order by a.id desc"; */
				 
				 $query1->execute(); 
                 $row1 = $query1->fetch();				 
				 $costsheet_date_str  = $row1['costsheet_date'];
				  $row_count  = $row1['row_count'];
				  $com_per_val  = $row1['com_per_val'];
				  $mar_per = $com_per_val / $row_count;
				  //echo  $row_count;
				  
				 $com_per  = $row1['com_per'];
				 //print_r($com_per);
                 $costsheet_date = date('d-m-Y', strtotime($costsheet_date_str));	
				 ?>
	   <table id="dataTable" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
	   <tr>
	    <td colspan="10" align="right"><b>Profit Percentage%</b></td>
		 
		  <td align="right">
		    <INPUT type="text" id="total_item" name="total_item" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['mar_per']; ?>" readonly="readonly">
		  </td>
		   <td colspan="9" align="right"><b>Profit Amount</b></td>
		 
		  <td align="right">
		    <INPUT type="text" id="total_item" name="total_item" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['mar_amt']; ?>" readonly="readonly">
		  </td>
		  
	<tr>
	</tr>
		  <td colspan="20" align="right"><b>Net Amount</b></td>
		 
		  <td align="right">
		    <INPUT type="text" id="total_item" name="total_item" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['net_amt']; ?>" readonly="readonly">
		  </td>
		</tr>

		<tr>
		
		  <td colspan="20" align="right"><b>Grand Total</b></td>
		  <td align="right">
		    <INPUT type="text" id="grand_total" name="grand_total" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['grand_amt']; ?>" readonly="readonly">
		  </td>
		</tr>
	  </table>	
	  </table>
	
	 <table id="dataTable" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
	 <thead>
	 <th>Vendor Name</th>
	 <th>Document</th>
	 <!--th>Cost Price</th-->
	 </thead>
	 <?php 
	 //echo $cost_sheet_no;
	 $vsel=$con->query("select cost_sheet_no,file_upload from cost_sheet_entry where cost_sheet_no='$cost_sheet_no'");

	 while($vdis=$vsel->fetch())
	 {
		 ?>
		 <tr>
		  
		 <td align="left"><a href="qvision/BusinessProcess/quotation/uploads/<?php echo $vdis['file_upload'];?>" target="_blank"><?php echo $vdis['file_upload'];?></a>
				 
			  </td>
		  <!--td align="left"><b>
		    <!?php echo $vdis['cost_price']; ?>
		  </td-->
		</tr>
		 <?php 
	 }
	 
	 ?>
	   </table>
	     <table id="dataTable" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered">
		<tr>
		  <td colspan="5"><b>Cost Sheet Date</b></td>
		  <td align="left"><b>
		    <?php echo $costsheet_date; ?>
		  </td>
		</tr>
		<!--tr>
		  <td colspan="5"><b>Cost Price Upload</b></td>
		  <td align="left"><b>
		   <a href="qvision/BusinessProcess/quotation/uploads/<!?php echo $row1['file_upload'];?>" target="_blank"><!?php echo $row1['file_upload'];?>
		  </td>
		</tr>
		<tr>
		  <td colspan="5"><b>Cost Price Amount</b></td>
		  <td align="left"><b>
		    <!?php echo $row1['file_amount']; ?>
		  </td>
		</tr-->
		 <tr>
		  <td colspan="5"><b>Employee Name</b></td>
		  <td align="left">
		     <b><input type="text" id="emp_name" style ="border:none;" value="<?php echo $row['emp_name'];?>" readonly>
		  </td>
		</tr>
		<?php $query1=  $con->prepare("select position,mail as eemail,phone as mobb from candidate_form_details where 
		id ='$emp_created'");

         	$query1->execute(); 
            $row3 = $query1->fetch();
		?>
		

				  
		  <td colspan="5"><b>Designation Name</b></td>
		  <td align="left">
		     <b><?php echo $row3['position'];?>
		  </td>
		</tr>
		
		 <tr>
		  <td colspan="5"><b>Phone No</b></td>
		  <td align="left">
		     <b><?php echo $row3['mobb'];?>
		  </td>
		</tr>
		 <tr>
		  <td colspan="5"><b>Email Id</b></td>
		  <td align="left">
		     <b><?php echo $row3['eemail'];?>
			  <input type="hidden" id="candid_id" value ="<?php echo $row['candid_id'];?>" readonly>
		  </td>
		</tr>
	 </table>
	 <br/>
   <div class="col-sm-12"></div>
   <div class="col-sm-6">
	
	 
		  <?php  //echo $row['mapping_id'];echo "<br/>"; echo $com_per;
	  
	  $query2= $con->query("SELECT head_status from staff_master where candid_id ='$candidateid' "); 
	  //echo "SELECT head_status from staff_master where candid_id ='$candidateid' ";
				 $query2->execute(); 
                 $row1 = $query2->fetch();
				 $head_status  = $row1['head_status'];
	 /*  
		  if($row['mapping_id'] =='1'){
			  if(($mar_per<='8')&&($userrole =='R001')){ ?>
			    <input type="button" class="btn btn-success" id="save" name="save"  onclick="openForm()"  value="Revise Cost Sheet">
		        <input type="button" class="btn btn-success" id="save" name="save" onclick="approve_costsheet()"  value="Approve Cost Sheet">
				<a onclick="return back()" data-toggle="modal" class="btn btn-primary"></i>Back</a><br/><br/>
		    <?php }else if(($mar_per>='8')&&($head_status=='1')){  ?>
			    <input type="button" class="btn btn-success" id="save" name="save"  onclick="openForm()"  value="Revise Cost Sheet">
		        <input type="button" class="btn btn-success" id="save" name="save" onclick="approve_costsheet()"  value="Approve Cost Sheet">
				<a onclick="return back()" data-toggle="modal" class="btn btn-primary"></i>Back</a><br/><br/>
		 <?php }else{?>
		        <a onclick="return back()" data-toggle="modal" class="btn btn-primary"></i>Back</a><br/><br/>
		 <?php }?>
		  <?php }else if($row['mapping_id'] =='2'){
			  if(($mar_per<='30')&&($userrole =='R001')){?>
			    <input type="button" class="btn btn-success" id="save" name="save"  onclick="openForm()"  value="Revise Cost Sheet">
		        <input type="button" class="btn btn-success" id="save" name="save" onclick="approve_costsheet()"  value="Approve Cost Sheet">
				<a onclick="return back()" data-toggle="modal" class="btn btn-primary"></i>Back</a><br/><br/>
		    <?php }
			else if(($mar_per>='8')&&($head_status=='1'))
			{ ?>
			    <input type="button" class="btn btn-success" id="save" name="save"  onclick="openForm()"  value="Revise Cost Sheet">
		        <input type="button" class="btn btn-success" id="save" name="save" onclick="approve_costsheet()"  value="Approve Cost Sheet">
				<a onclick="return back()" data-toggle="modal" class="btn btn-primary"></i>Back</a><br/><br/>
		 <?php }else{?>
		        <a onclick="return back()" data-toggle="modal" class="btn btn-primary"></i>Back</a><br/><br/>
		 <?php }?>
		  <?php }else if($row['mapping_id'] =='3'){
			  if(($mar_per<='35')&&($userrole =='R001')){ ?>
			    <input type="button" class="btn btn-success" id="save" name="save"  onclick="openForm()"  value="Revise Cost Sheet">
		        <input type="button" class="btn btn-success" id="save" name="save" onclick="approve_costsheet()"  value="Approve Cost Sheet">
				<a onclick="return back()" data-toggle="modal" class="btn btn-primary"></i>Back</a><br/><br/>
		    <?php }
			else if(($mar_per>='8')&&($head_status=='1'))
			{ ?>
			    <input type="button" class="btn btn-success" id="save" name="save"  onclick="openForm()"  value="Revise Cost Sheet">
		        <input type="button" class="btn btn-success" id="save" name="save" onclick="approve_costsheet()"  value="Approve Cost Sheet">
				<a onclick="return back()" data-toggle="modal" class="btn btn-primary"></i>Back</a><br/><br/>
		 <?php }else{?>
		        <a onclick="return back()" data-toggle="modal" class="btn btn-primary"></i>Back</a><br/><br/>
		<?php } 
		 } ?>
	 
	  */
	 
	 if(($head_status=='1') && ($costsheet_status =='1'))
	 {
		 
	 ?>
	 <input type="button" class="btn btn-success" id="save" name="save"  onclick="openForm()"  value="Revise Cost Sheet">
		        <input type="button" class="btn btn-success" id="save" name="save" onclick="approve_costsheet()"  value="Approve Cost Sheet">
				<a onclick="return back()" data-toggle="modal" class="btn btn-primary"></i>Back</a><br/><br/>
				
	<?php 				
	 }
	 elseif(($userrole =='R001') && ($costsheet_status =='20'))
	 {
		?>
		<!--input type="button" class="btn btn-success" id="save" name="save"  onclick="openForm()"  value="Revise Cost Sheet"-->
		        <input type="button" class="btn btn-success" id="save" name="save" onclick="approve_costsheet()"  value="Approve Cost Sheet">
				<a onclick="return back()" data-toggle="modal" class="btn btn-primary"></i>Back</a><br/><br/>
			
	<?php 		
	 }
	 ?>
   </div><br/>
   
	
		
	</form>	
</div>
     </div>	
	<!-- Sub Total: <input type="text" readonly="readonly" id="total"><br><input type="submit" value="Create Invoice">-->
  </div>
   <!--<button class="open-button" onclick="openForm()">Open Form</button>-->

		<div class="form-popup" id="myForm">
		  <form action="" class="form-container">
			<h3>Cost Sheet Remark</h3>

			<label for="email"><b>Remark</b></label>
			<input type="text" placeholder="Enter Remark" name="remark" id ="remark" required>
          
			<button type="button" class="btn" onclick="revise_costsheet()">Submit</button>
			<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
		  </form>
		</div>
  
  
  </div>
  
  <style>
/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 400px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 25px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
   
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
 
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
  
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
<script>
function back()

	{
		Cost_sheet_approve()

	}
function approve_costsheet()
{
	
	var data  = $('form').serialize();
	
	var las_status    = document.getElementById("las_status").value;
	
	var id    = document.getElementById("cost_sheet_no").value;
	var enquiry_id  = document.getElementById("enquiry_id").value;
	
	var costsheet_id  = document.getElementById("costsheet_id").value;
	//alert(costsheet_id)
	var old_quote_no  = document.getElementById("old_quote_no").value;
	var business_id  = document.getElementById("business_id").value;
	//alert(old_quote_no)
   $('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');
   
   if(las_status==1){
	$.ajax({
	type:'GET',
	data:"id="+id+'&costsheet_id='+costsheet_id+'&old_quote_no='+old_quote_no+'&enquiry_id='+enquiry_id+'&business_id='+business_id,
	url:"qvision/BusinessProcess/quotation/costsheet_rev_update.php",
	success:function(data)
	{      
		alert("****Approved Successfully****");
		    Cost_sheet_approve();
				  
	}       
	});
   }else{
	   $.ajax({
	type:'GET',
	data:"id="+id+'&costsheet_id='+costsheet_id+'&old_quote_no='+old_quote_no+'&enquiry_id='+enquiry_id+'&business_id='+business_id,
	url:"qvision/BusinessProcess/quotation/costsheet_approve_update.php",
	success:function(data)
	{      
		alert("****Approved Successfully****");
		    Cost_sheet_approve();
				  
	}       
	});
   }
}
function revise_costsheet()
{
//alert()
	//var data  = $('form').serialize();old_quote_no
	
	var enquiry_id  = document.getElementById("enquiry_id").value;
	var cost_sheet_no    = document.getElementById("cost_sheet_no").value;
	var remark    = document.getElementById("remark").value;
	//alert(cost_sheet_no)
    //alert(remark)
	 $('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');
 	$.ajax({
	type:'GET',
	data:"cost_sheet_no="+cost_sheet_no+'&remark='+remark+'&enquiry_id='+enquiry_id,
	url:"qvision/BusinessProcess/quotation/costsheet_revise_update.php",
	success:function(data)
	{      
		alert("revised Successfully");
		    Cost_sheet_approve();
				  
	}       
	}); 
}
</script>