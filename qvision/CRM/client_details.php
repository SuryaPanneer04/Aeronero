<?php 
require '../../connect.php';
$client_type=$_REQUEST['ctype'];

if($client_type==1)	
	{
		?>
<tr>
        <td>Address</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Address" id="Address" name="Address" readonly></td>
        </tr>
        
        <tr>
       <td>City</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Location" id="Location" name="Location" readonly></td>
        </tr>
       
         <tr>
        <td>Contact Person Name *</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Client Name" id="Client" name="Client" id="Client" readonly></td>
        </tr>
		 <tr>
        <td>Designation</td>
        <td colspan="5">
			<input type="text"  id="Designation" name="Designation" class="form-control"  placeholder="Enter Designation" required="true" readonly>
		</td>
        </tr>
		 <tr>
        <td>Contact Number</td>
        <td colspan="5">
			<input type="text"  id="Number" name="Number" class="form-control"  maxlength="10" placeholder="Enter Number" required="true" readonly>
		</td>
        </tr>
		<tr>
        <td>Mail Id</td>
        <td colspan="5">
			<input type="mail"  id="mail" name="mail" class="form-control"  placeholder="Enter mail" required="true" readonly>
		</td>
        </tr>
		<?php 
	}
	else
	{
		?>
		<tr>
        <td>Address</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Address" id="Address" name="Address" ></td>
        </tr>
        
        <tr>
       <td>City</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Location" id="Location" name="Location" ></td>
        </tr>
       
         <tr>
        <td>Contact Person Name *</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Client Name" id="Client" name="Client" id="Client" required></td>
        </tr>
		 <tr>
        <td>Designation</td>
        <td colspan="5">
			<input type="text"  id="Designation" name="Designation" class="form-control"  placeholder="Enter Designation" required="true">
		</td>
        </tr>
		 <tr>
        <td>Contact Number</td>
        <td colspan="5">
			<input type="text"  id="Number" name="Number" class="form-control"  maxlength="10" placeholder="Enter Number" required="true">
		</td>
        </tr>
		<tr>
        <td>Mail Id</td>
        <td colspan="5">
			<input type="mail"  id="mail" name="mail" class="form-control"  placeholder="Enter mail" required="true" readonly>
		</td>
        </tr>
		<?php
	}
		?>