<?php
require '../../../connect.php';
$dept_id = $_REQUEST['dept_id'];
?>
<option value="0">---------</option>
<?php
// Fetch divisions mapped to this department
$div_sql = $con->query("SELECT id, div_name FROM division_master WHERE dep_id='$dept_id' AND status=1");
while($div_sql_res = $div_sql->fetch(PDO::FETCH_ASSOC))
{
?>
<option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['div_name']; ?></option>
<?php
}
?>
