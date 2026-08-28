<?php 
require '../../../connect.php';
$Acc_managerid=$_REQUEST['manager_id'];
?>
                    <input type="button" class="btn btn-danger" value="Delete" style="float:right;" onclick="deleteRow1('dataTable1')"/>&nbsp;&nbsp;&nbsp;&nbsp;
	                <input type="button" class="btn btn-success" value="Add " style="float:right;" onclick="addRow1('dataTable1')" ><br/><br/>
	 <table id="dataTable1" width="200px" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered">
		  <tr>
		      <th>
			    <input type="checkbox" name="select-all" id="select-all" onclick="toggle(this); required">
		      </th>
		       <th>SPECIFICATION</th>
		       <th>QTY</th>
		       <th>UNIT</th>
		       <th>UNIT RATE</th>
		       <th>VENDOR</th>
		       <th>Quote</th>
		       <Th formula="cost*qty" summary="sum">Amount</th>
		       <th colspan='2'>Logistics</th>
		      <th colspan='2'>Service Cost</th>
		       <th colspan='2'>Overall Margin</th>
		       <th>Total Amount</th>
		 </tr>
         <tr>
		     <td>
			     <input type="checkbox" name="chk[]">
		     </td>
		     <td>
			     <input type="text" id="item1" name="item[]" class="form-control"></td>
		     <td>
			     <input type="text" id="qty1" name="qty[]" onchange="totalIt1()" class="form-control"></td>
		     <td>
			     <input type="text" id="unit1" name="unit[]" class="form-control" placeholder="eg.Nos,Box"></td>
		     <td>
			     <input type="text" id="cost1" name="cost[]" onchange="totalIt1()" class="form-control"></td>
		    <td>
			     <input type="text" id="vendor" name="vendor[]"  class="form-control"></td>
		    <td>
			     <input type="file" id="files" name="files[]"  class="form-control"></td>
		     <td>
			     <input type="text" id="price1" name="price[]" onchange="totalIt1()" readonly value="0.00" class="form-control">
		     </td>
		     <td>
			     <input type="text" id="log_per1" name="log_per[]" class="form-control log_per " onchange="totalIt1()" placeholder="%">
		     </td>
		     <td>
			     <input type="text" id="log_amt1" name="log_amt[]" class="form-control"  placeholder="0.00" readonly>
		     </td>		
		     <td> 
		         <INPUT type="text" id="eng_per1" name="eng_per[]" class="form-control eng_per"  onchange="totalIt1()" placeholder="%">
		     </td>		  
		     <td>
		         <INPUT type="text" id="eng_amt1" name="eng_amt[]" class="form-control " placeholder="0.00" readonly>
		     </td>
		  
		     <td>
		         <INPUT type="text" id="com_per1" name="com_per[]" class="form-control com_per"  onchange="totalIt1()" placeholder="%">
		     </td>
		     <td>
		         <INPUT type="text" id="com_amt1" name="com_amt[]" class="form-control"  placeholder="0.00" readonly>
		     </td>
		
		     <td>
		         <INPUT type="text" id="col_item1" name="col_item[]" class="form-control"  placeholder="0.00" readonly>
		     </td>
		
	      </tr>	
      </table>
      <table id="dataTable" width="200px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
	      <tr>
		     <td colspan="4" align="center"><b>Total Amount</b></td>
		 
		     <td align="right">
		         <INPUT type="text" id="total_item" name="total_item" class="form-control" style="width:30% !important;" placeholder="0.00">
		    </td>
		  </tr>
		  <tr>
             <td><b>Gst Percentage</b></td>
             <td colspan="3">
		           <select class="form-control" id="gst_per" name="gst_per" onchange="grandtotal()" style="float:left; width: 40%" required>
			          <option value="">----- Choose GST % -----</option>
			          <option value="18">18 %</option>
			          <option value="28">28 %</option>
		           </select>
		     </td>
	         <td align="right">
		          <INPUT type="text" id="gst_val" name="gst_val" class="form-control" onchange="grandtotal()" style="width:30% !important;" placeholder="0.00">
	         </td>
         </tr>
	     <tr>

             <td><b>IGST Percentage</b></td>

             <td colspan="3"><input type="number" style="float:left; width: 40%" class="form-control"  onchange="grandtotal()"  name="igst_per" id="igst_per" placeholder="Enter IGST Percentage"></td>
		     <td align="right">
		         <INPUT type="text" id="igst_val" name="igst_val" class="form-control" style="width:30% !important;" placeholder="0.00">
	         </td>
         </tr>
		 <tr>
		     <td colspan="4" align="center"><b>Grand Total</b></td>
		     <td colspan="2" align="right">
		         <INPUT type="text" id="grand_total" name="grand_total" class="form-control" style="width:30% !important;" placeholder="0.00" readonly>
		     </td>
		 </tr>
		  <tr>
		  <td colspan="4"><b>Vendor name *</b></td>
		  <td align="left">
		     <b><select class="form-control" id="vendor_name" name="vendor_name" style="width:30%;" required>
    <option disabled selected>-- Select vendor --</option>
	
				
				 <?php $stmt = $con->query("SELECT id,vendor_name FROM doller_vendor_mastor");
				while ($row = $stmt->fetch()) {?>
				 <option value="<?php  echo $row['id'];?>"> <?php echo $row['vendor_name']; ?> </option>
			<?php } ?>
		</select> 

		  </td>
		</tr>
		<tr>
		  <td colspan="4"><b>Cost Price Upload</b></td>
		  <td align="left">
		     <b><input type="file" name="file[]" id="file" />
		  </td>
		</tr>
		<tr>
		  <td colspan="4"><b>Cost Price Amount</b></td>
		  <td align="left">
		     <b><input type="text" name="amount" id="amount" class="form-control" style="width:30%;"/>
		  </td>
		</tr>		
	 
	          <tr>
                   <td><b>Cost Date</b></td>
                   <td colspan="4"><input type="date" style="float:left; width: 40%" class="form-control"  name="chost_date" id="chost_date" required></td>
		 
             </tr>
	                   <?php
	                      $stmt = $con->prepare("select a.*,b.*,c.* from staff_master a inner join designation_master b on 
		                  (b.id = a.design_id) inner join z_user_master c on (c.candidate_id=a.id) where a.id = '$Acc_managerid' ");

		                   $stmt->execute(); 
		                   $row_fetch = $stmt->fetch();
	                   ?>

	          <tr>
		           <td><b> Employee Name </b></td>
		           <td colspan="4"><?php echo $row_fetch['emp_name']; ?> </td>
		     </tr>
	          <tr> 
		           <td><b>Designation </b></td>
		           <td colspan="4"><?php echo $row_fetch['designation_name']; ?></td>
		     </tr>
		      <tr> 
		           <td><b> Mobile No </b></td>
		           <td colspan="4"> <?php echo $row_fetch['mobile_no']; ?></td>
		     </tr>
		      <tr> 
		           <td><b> Email Id </b></td>
		           <td colspan="4"><?php echo $row_fetch['email_id']; ?>
		                  <input type="hidden" id="candid_id" readonly value='<?php echo $row_fetch['candid_id']; ?>'></td>
		     </tr>
		
		
     </table>
	 <br>
		<div style="text-align:center;font-weight:bold;"><b><u>TERMS AND CONDITION</u></b></div><br/>
		
		<table class="table table-bordered">
	   <tr>
         <td><b>VALIDITY :</b></td>
         <td colspan="3"><textarea name="validity" class="form-control" rows="2" cols="60">ONE WEEK FROM THE DATE OF QUOTE. PRICES PREVAILING AT THE TIME OF SUPPLY & BILLING WILL ONLY APPLY</textarea></td>
		 
       </tr>
	   <tr>
         <td><b>PAYMENT</b></td>
         <td colspan="3"><textarea name="payment" class="form-control" rows="2" cols="60">100% IN ADVANCE ALONG WITH FORMAL PURCHASE ORDER.PAYMENTS SHOULD BE MADE EITHER BY CHEQUE, DD, RTGS AND NEFT IN FAVOUR OF SS INFORMATION SYSTEMS PVT LTD, PAYABLE AT CHENNAI. CASH PAYMENTS WILL BE NULL & VOID</textarea></td>
		 
       </tr>
	   
	   <tr>
         <td><b>BANK NAME :</b></td>
         <td colspan="3"><input type="text" style="float:left; width: 30%" name="bank_name" id="bank_name" class="form-control" readonly></td>
		 
       </tr>
	   
	   <tr>
         <td><b>CURRENT A/C NO:</b></td>
         <td colspan="3"><input type="text" style="float:left; width: 30%" name="account_no" id="account_no"class="form-control" readonly></td>
		 
       </tr>
	   <tr>
         <td><b>IFSC CODE :</b></td>
         <td colspan="3"><input type="text" style="float:left; width: 30%" name="ifsc_code"  id="ifsc_code" class="form-control" readonly></td>
		 
       </tr>
	   <tr>
         <td><b>IMPORTANT</b></td>
         <td colspan="3"><textarea name="important"  class="form-control" rows="2" cols="60">YOUR PO SHOULD BE IN FAVOUR OF <br/> SS INFORMATION SYSTEMS PVT LTD, No.1/102, First Floor, Periyar Pathai (West),100 Feet Road, Arumbakkam,Chennai-500 105. INDIA</textarea></td>
		 
       </tr>
	   <tr>
         <td><b>DELIVERY :</b></td>
         <td colspan="3"><textarea name="delivery" class="form-control" rows="2" cols="60">AS FOR THE OEM WITHIN 1 - 2 WEEKS , WITHIN 2 - 2 WEEKS , WITHIN 2 - 3 WEEKS, WITHIN 3 - 4 WEEKS  FROM THE DATE OF RECEIPT OF PAYMENT.SHIPPING COSTS WILL BE LEVIED IN FINAL INVOICE AS MAY BECOME APPLICABLE.</textarea></td>
		 
       </tr>
	   <tr>
         <td><b>WARRANTY :</b></td>
         <td colspan="3"><textarea name="warrenty" class="form-control" rows="2" cols="60">AS PER OEM.</textarea></td>
		 
       </tr>
	  	  
        </table>
        		
		                  <input type="submit" name="submit" class="btn btn-success submitBtn" value="SAVE">
  </form>	  
	<!-- Sub Total: <input type="text" readonly="readonly" id="total"><br><input type="submit" value="Create Invoice">-->
   
 