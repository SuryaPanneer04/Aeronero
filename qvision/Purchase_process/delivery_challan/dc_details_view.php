<?php
require '../../../connect.php'; 

$cost_id = $_REQUEST['cost_no']; //CostSheetId.
$grn = $_REQUEST['grn']; //grn Id.
?>

<script src="qvision/Purchase_process/delivery_challan/selectAllChkbx_jsFile.js"> //For SelectAll / Deselect All Checkbox using JS.</script> 

<table class="table table-striped table-bordered table-hover display nowrap"  id="new_tab" style="width:100%" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered">
	 
	 <tbody id="cost_sheett">
     <tr>
		  <th style="width: 2%;"> S.No </th>
		  <th style=" WIDTH: 4%;">Product Name</th>
		  <th style=" WIDTH: 4%;">Product Spec</th>
		  <th style=" WIDTH: 4%;">Qty</th>
		  <!-- <th style=" WIDTH: 4%;">Serial Number</th> -->
		  <th style=" WIDTH: 4%;">Remark</th>		          
	</tr>

    <?php 
    $select_costSheet = $con-> query("Select b.* from purchase_generate a left join cost_sheet_entry b on a.cost_sheets_id = b.id where b.id='$cost_id'");
    $i=1;
    while($costDetails = $select_costSheet->fetch()){
    ?>
    <tr>
		<td> <?php echo $i++ ;?> </td>
		<td>  <input type="hidden" name="costSheetId" value="<?php echo $costDetails['id'];?>">
			<input type="text" name="pro_name[]" class="form-control" value="<?php echo $costDetails['product_name'];?>" readonly> </td>		
		<td>  <textarea name="desc_1[]" class="form-control" readonly> <?php echo $costDetails['description'];?> </textarea> </td>
		<td>  <input type="text" name="qty[]" class="form-control" value="<?php echo $costDetails['qty'];?>" > </td>
		<!-- <td>  <input type="text" name="serial_no[]"  class="form-control" > </td> -->
		<td>  <textarea name="remark[]" class="form-control" > </textarea> </td> 
	</tr>	

    <?php } ?>


	<table id="new_tab" width="300px" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered table-striped">
		<tbody id="cost_sheett">
			<tr>
				<th><input type="checkbox" class="chkAll" name="select_all" > Select / Deselect All</th>
				<th>Serial Number</th>
				<th>GRN Number</th>
			</tr>
        <?php
            $grn_generated_code = $con ->query("select * from grn_entry where grn_id = '$grn' and status= 1 order by status");
            $i =1;
			while($grncode = $grn_generated_code -> fetch())		
	       {
		?>
                <tr>
                    <td>
                    <?php if($grncode['status']==1){ ?>
                        <input type="checkbox" name="chk[]" class="approveCheck" value="<?php echo $grncode['id'];?>">
                    <?php } ?>
                    </td>
                    
                    <td>
                        <input type="text" id="serialnumber<?php echo $i; ?>" name="serialnumber[]" class="form-control" value="<?php echo $grncode['serial_no']; ?>" readonly>
                    </td> 
                    
                    <td>
                        <input type="text" id="grn<?php echo $i; ?>" name="grnnumber[]" class="form-control" value="<?php echo $grncode['grn_number']; ?>" readonly>
                    </td> 
                </tr>
<?php $i =$i + 1; 
}  ?>
		</tbody>
	</table>


    <tr>
     <td colspan="6"> <input type="submit" name="submit" class="btn btn-success submitBtn" value="Generate DC"> </td>
    </tr>

</tbody>
  </table>

