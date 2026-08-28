<?php
require '../../../connect.php';

$id = $_REQUEST['id'];
$date = date('Y-m-d', strtotime( '+'.$id. 'months'));
?>
<td><label for="fname">End Date:</label></td>
<td><input type="date" id="end_date" name="end_date" class="form-control" value="<?php echo $date; ?>" ></td>

