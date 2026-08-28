<?php 
require '../../../../../connect.php';
include("../../../../../user.php");
 $emp = $_REQUEST['id'];
 $datetimepicker1 = $_REQUEST['date'];
$cur = date('Y-m-d');
$cur1 = date('Y-m-d', strtotime('-1 day', strtotime($cur)))	;
$attire = $con->query("select * from attire_form where emp_no='$emp' and date='$datetimepicker1'");

$att = $attire->rowCount();
if($att == 0){
?>

<td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="attire_insert()" value="save"></td>	

<?php } ?>