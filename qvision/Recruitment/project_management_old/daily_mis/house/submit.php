<?php 
include '../../../../../connect.php';
include("../../../../../user.php");
 
 $datetimepicker1 = $_REQUEST['date'];

$attire = $con->query("select * from house_sheet where date='$datetimepicker1'");
//echo "select * from house_sheet where date='$datetimepicker1'";

$att = $attire->rowCount();
if($att == 0){
?>

<td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="attire_insert()" value="save"></td>	

<?php } ?>