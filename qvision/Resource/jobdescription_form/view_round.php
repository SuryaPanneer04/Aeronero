<?php
include '../../../connect.php';
$id = $_REQUEST['id'];

$jd = $con -> query("SELECT `interview_round_level` FROM `jobdescription_master` WHERE id = '$id'");
$levelDetail = $jd -> fetch();
?>

<td>Interview Round Level</td>
<td colspan="5"><input type="text" class="form-control" id="round" name="round" value="<?php echo $levelDetail['interview_round_level']; ?>" readonly></td>
