<?php
require '../../connect.php';
error_reporting(0);
$candid_id=$_REQUEST['candid_id'];
$leave_type=$_REQUEST['leave_type'];


$show=$con->query("select balance_leave from leave_masters where candid_id='$candid_id' and leave_type='$leave_type'");
$shows=$show->fetch();
$balance_leave=$shows['balance_leave'];

if($balance_leave!='0' || $leave_type==4){
?>
<td colspan="8"><input type="submit" class="btn btn-success" name="submit" id="submit" value="save">
<?php
}
?>