<?php
include '../../../connect.php';
$id = $_REQUEST['id'];

$jd = $con -> query("SELECT `approval_level` FROM `jobdescription_master` WHERE id = '$id'");
$levelDetail = $jd -> fetch();

?>
<td>Approval Level</td>
<td colspan="5"><input type="text" class="form-control" id="approve" name="approve" value="<?php echo $levelDetail['approval_level']; ?>" readonly></td>
