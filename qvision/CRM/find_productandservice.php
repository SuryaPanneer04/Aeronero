<?php
require '../../connect.php';
include("../../user.php");
$Product = $_REQUEST["Product"];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Service Table</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%; /* Adjusted width to fit the screen */
    }
    th, td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    th {
      background-color: #f2f2f2;
    }
    select, input[type="text"] {
      width: 80%;
      padding: 5px;
    }
  </style>
</head>
<body>

 <input type="button" class="delete-row btn btn-danger" value="Delete" style="float:right;" onclick="deleteRow('new_tab')"/>&nbsp;&nbsp;&nbsp;&nbsp;
	                 <input type="button" class="add-row btn btn-success" value="Add " onclick="appendfun()" style="float:right;"><br/><br/>
 <div class="card-body">
 <table class="table table-striped table-bordered table-hover display nowrap"  id="new_tab" style="width:380%" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered">
	 <!--table class="table table-striped table-bordered table-hover display nowrap"  id="new_tab" style="width:100%"-->
	 	<tbody id="cost_sheett">
			
		  <tr>
		  <th style="width: 2%;">
			    <input type="checkbox" name="select-all" id="select-all" onclick="toggle(this); required" >
		      </th>
		     
		       <th style=" WIDTH: 6%;">PRODUCT NAME</th>
		       <th style=" WIDTH: 6%;">PRODUCT ID</th>
			   <th style=" WIDTH: 3%;">DESCRIPTION</th>
		       <th style=" WIDTH: 3%;">QTY</th>
		       
		       <!--th style=" WIDTH: 6%;">UNIT</th-->
		       <th style=" WIDTH: 4%;">UNIT RATE</th>
		       <Th style=" WIDTH: 5%;" formula="cost*qty" summary="sum" >Purchase Amount</th>
			   <th colspan='2'  style=" WIDTH: 9%;">Dist Margin %</th>
			   <th colspan='2' style=" WIDTH: 8%;">Overall Margin</th>
			   <th  style=" WIDTH: 5%;">Selling Price</th>
			    
		       <th colspan='2' style=" WIDTH: 9%;">Logistics %</th>
		      <th colspan='2'  style=" WIDTH: 9%;">Service Cost %</th>
			  <th style="WIDTH:4%;">Total Amount</th>
		      <th colspan='2'  style=" WIDTH: 8%;">GST Cost %</th>
		      <th colspan='2'  style=" WIDTH: 7%;">IGST Cost %</th>
		       <th style="WIDTH:4%;">Total Amount With GST</th>
		       
			   <th style="WIDTH:4%;" >Choose Vendor</th>
		       <th style="WIDTH:85%;">Upload</th>  
		 </tr>
         <tr>
		     <td>
			     <input type="checkbox" name="chk[]">
		     </td>
			 <td>
			<select class="form-control" onchange="prodcutname(this.value); desname(1, this.value); hsncode(1, this.value)" id="product_name1" name="product_name[]">
        <option value="" disabled selected>Select Product Name</option>
        <?php 
        $query = $con->query("SELECT id, name, hsn_code FROM product_master");
        while ($row_fetch = $query->fetch()) {?>
            <option value="<?php echo $row_fetch['name'] . '-' . $row_fetch['id']; ?>"><?php echo $row_fetch['name']; ?></option>
        <?php } ?>
    </select>
	<input type="hidden" name="hsn_code[]" id="hsn_code1" >
					
				 </td>
		     <td>	
 <select name="product_id[]" id="product_id1" class="form-control">
					
					 </select>			 
				 </td>
				 <td>
					 <select name="description[]" id="description1" style="height: 200px; width:300px;white-space: normal;" class="form-control">
						
					 </select>
				 </td>
		     <td>
			     <input type="text" id="qty1" name="qty[]" style="width:77%" onchange="totalIt()" class="form-control" ></td>
		     <!--td>
			     <input type="text" id="unit1" name="unit[]" style="width:100%" class="form-control" placeholder="eg.Nos,Box "></td-->
		     <td>
			     <input type="text" id="cost1" name="cost[]" style="width:100%" onchange="totalIt()" class="form-control" ></td>
		     <td>
			     <input type="text" id="price1" name="price[]"  style="width:100%" onchange="totalIt()" readonly value="0.00" class="form-control">
		     </td>
			 <td>
		         <INPUT type="text" id="dist_per1" name="dist_per[]" style="width:100%" class="form-control dist_per"  onchange="totalIt()" placeholder="%">
		     </td>
		     <td>
		         <INPUT type="text" id="dist_amt1" name="dist_amt[]" style="width:100%" class="form-control"  placeholder="0.00" readonly>
		     </td>
			  <td>
		         <INPUT type="text" id="com_per1" name="com_per[]" style="width:100%" class="form-control com_per"  onchange="totalIt()" placeholder="%">
		     </td>
		     <td>
		         <INPUT type="text" id="com_amt1" name="com_amt[]" style="width:100%" class="form-control"  placeholder="0.00" readonly>
		     </td>
		     <td>
			 <INPUT type="text" id="sel_amt1" name="sel_amt[]" style="width:100%" class="form-control"  placeholder="0.00" readonly>
		     </td>

		     <td>
			     <input type="text" id="log_per1"  name="log_per[]" style="width:100%" class="form-control log_per " onchange="totalIt()" placeholder="%" >
		     </td>
		     <td>
			     <input type="text" id="log_amt1" name="log_amt[]" style="width:100%" class="form-control"  placeholder="0.00" readonly>
		     </td>		
		     <td> 
		         <INPUT type="text" id="eng_per1" name="eng_per[]" style="width:100%" class="form-control eng_per"  onchange="totalIt()" placeholder="%">
		     </td>		  
		     <td>
		         <INPUT type="text" id="eng_amt1" name="eng_amt[]" style="width:100%" class="form-control " placeholder="0.00" readonly>
		     </td>	
			<td>
		         <INPUT type="text" id="col_item1" name="col_item[]" style="width:100%" class="form-control"  placeholder="0.00" readonly>
		     </td>
             <td> 

				  <select class="form-control" id="gst_per1" name="gst_per[]" onchange="grandtotal();totalIt();" style="float:left; width: 80%" required>
			          <option value="">----- Choose GST % -----</option>
			          <option value="3">3 %</option>
			          <option value="5">5 %</option>
			          <option value="12">12 %</option>
			          <option value="18">18 %</option>
			          <option value="28">28 %</option>
		           </select>
		     </td>		  
		     <td>
		         <INPUT type="text" id="gst_amt1" name="gst_amt[]" style="width:100%" class="form-control " placeholder="0.00" readonly>
		     </td>	
			<td> 
		         <INPUT type="text" id="igst_per1" name="igst_per[]" style="width:100%" class="form-control"  onchange="grandtotal();totalIt();" placeholder="%" required>
		     </td>		  
		     <td>
		         <INPUT type="text" id="igst_amt1" name="igst_amt[]" style="width:100%" class="form-control " placeholder="0.00" readonly required>
		     </td>				 
		     <td>
		         <INPUT type="text" id="tot_item1" name="tot_item[]" style="width:106%" class="form-control"  placeholder="0.00" readonly>
		     </td>
			  <td align="left">
		     <b><select class="form-control" id="vendor_name1" name="vendor_name[]" style="width:76%;" required>
    <option disabled selected>-- Select vendor --</option>
	
				
				 <?php $stmt = $con->query("SELECT id,vendor_name FROM doller_vendor_mastor");
				while ($row = $stmt->fetch()) {?>
				 <option value="<?php  echo $row['id'];?>"> <?php echo $row['vendor_name']; ?> </option>
			<?php } ?>
		</select> 

		  </td>
			  <td style="width:69%;">
		         <INPUT type="file" id="image1" name="image[]" class="form-control">
		     </td>
			 
	      </tr>	
		  </tbody>
      </table> 
	  </div>
      <table id="dataTable4" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
	      <tr>
		     <td colspan="3" align="center"><b>Profit Percentage%</b></td>
		 
		     <td align="right">
		         <INPUT type="text" id="mar_pper" name="mar_pper" class="form-control" style="width:58% !important;" readonly>
		    </td>
			<td colspan="3" align="center"><b>Profit Amount</b></td>
		 
		     <td align="right">
		         <INPUT type="text" id="mar_aamt" name="mar_aamt" class="form-control" style="width:58% !important;" placeholder="0.00" readonly>
		    </td>
		  </tr>
		  <tr>
		     <td colspan="5" align="center"><b>Total Amount</b></td>
		 
		     <td colspan="3" align="right">
		         <INPUT type="text" id="total_item" name="total_item" class="form-control" style="width:40% !important;" placeholder="0.00" readonly>
		    </td>
		  </tr>

		 <tr>
		     <td colspan="5" align="center"><b>Grand Total</b></td>
		     <td colspan="3" align="right">
		         <INPUT type="text" id="grand_total" name="grand_total" class="form-control" style="width:40% !important;" placeholder="0.00" readonly>
		     </td>
		 </tr>

	 </table>
<!------------------------------------------------------------------------------------------------------------------------->
<input type="button" class="delete-row btn btn-danger" value="Delete" style="float:right;" onclick="deleteservice('new_servicetab')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" class="add-row btn btn-success" value="Add " onclick="addRow()" style="float:right;"><br/><br/>
<div class="card-body">
 <table class="table table-striped table-bordered table-hover display nowrap"  id="new_servicetab" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered">
  <thead>
    <tr>
      <th>Select</th> <!-- New column for checkboxes -->
      <th>Service</th>
      <th>Manday</th>
      <th>No of days</th>
      <th>HR cost</th>
      <th>Admin Charges</th>
      <th>Total</th>
      <th>Gst</th>
      <th>Gst amt</th>
      <th>Net total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><input type="checkbox" name="chk[]"></td> <!-- Checkbox for deletion -->
      <td>
        <select name="service[]">
          <option value="nd">--Choose Service--</option>
          <?php
            $sql = $con->query("SELECT * FROM `service_master` order by service_id asc");
            while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
          ?>
            <option value="<?php echo $row['service_id'];?>"><?php echo $row['service_name'];?></option>
          <?php
            }
          ?>
        </select>
      </td>
      <td><input type="text" name="manday[]"></td>
      <td><input type="text" name="no_of_days[]"></td>
      <td><input type="text" name="hr_cost[]"></td>
      <td><input type="text" name="admin_charges[]"></td>
      <td><input type="text" name="total[]"></td>
      <td><input type="text" name="gst[]"></td>
      <td><input type="text" name="gst_amt[]"></td>
      <td><input type="text" name="net_total[]"></td>
    </tr>
  </tbody>
</table>
</div>

<script>
function addRow() {
  var table = document.getElementById("new_servicetab").getElementsByTagName('tbody')[0];
  var newRow = table.insertRow(-1); // Inserting at -1 will append the new row at the end
  var cell1 = newRow.insertCell(0);
  var cell2 = newRow.insertCell(1);
  var cell3 = newRow.insertCell(2);
  var cell4 = newRow.insertCell(3);
  var cell5 = newRow.insertCell(4);
  var cell6 = newRow.insertCell(5);
  var cell7 = newRow.insertCell(6);
  var cell8 = newRow.insertCell(7);
  var cell9 = newRow.insertCell(8);
  var cell10 = newRow.insertCell(9); // Add a new cell for the "Net total"
  cell1.innerHTML = '<input type="checkbox" name="chk[]">'; // Checkbox
  cell2.innerHTML = '<select name="service[]"><option value="nd">--Choose Service--</option><?php $sql = $con->query("SELECT * FROM `service_master` order by service_id asc");while($row = $sql->fetch(PDO::FETCH_ASSOC)) {?><option value="<?php echo $row['service_id'];?>"><?php echo $row['service_name'];?></option><?php }?></select>';
  cell3.innerHTML = '<input type="text" name="manday[]">';
  cell4.innerHTML = '<input type="text" name="no_of_days[]">';
  cell5.innerHTML = '<input type="text" name="hr_cost[]">';
  cell6.innerHTML = '<input type="text" name="admin_charges[]">';
  cell7.innerHTML = '<input type="text" name="total[]">';
  cell8.innerHTML = '<input type="text" name="gst[]">';
  cell9.innerHTML = '<input type="text" name="gst_amt[]">';
  cell10.innerHTML = '<input type="text" name="net_total[]">'; // Added input for "Net total"
}


function deleteservice(tableID) {
  var table = document.getElementById(tableID);
  var rowCount = table.rows.length;
  for (var i = rowCount - 1; i > 0; i--) {
    var row = table.rows[i];
    var chkbox = row.cells[0].getElementsByTagName('input')[0];
    if (chkbox && chkbox.type === 'checkbox' && chkbox.checked) {
      table.deleteRow(i);
    }
  }
}
</script>

</body>
</html>
