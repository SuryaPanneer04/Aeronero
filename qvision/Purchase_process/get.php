<?php
require '../../connect.php';
require '../../user.php';

		$id = $_REQUEST['id'];	
?>		
			 <tr>
                    <th>Sr. No.</th>
                    <th>Serial Number</th>

                </tr>
<?php				
				for($i=0;$i<$id;$i++)		
	{
		?>
                <tr>
                    <td>
                        <input type="checkbox" name="chk[]">
                    </td>
                    
                    <td>
                        <input type="text" id="serialnumber<?php echo $i; ?>" name="serialnumber[]" class="form-control" required>
                    </td>
                  		
                </tr>
				<?php 
	}
	?>