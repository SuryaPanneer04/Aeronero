<?php
require '../../connect.php';
include '../../user.php';
$userid=$_SESSION['userid'];

$site=$_REQUEST['sid'];
?>


<td>Location</td>
<td colspan="2">
<select name="location" id="location" class="form-control" >
<option value="">Select Location</option>
<?php
$sel=$con->query("select * from location_master where site_id='$site'");
while($sfet=$sel->fetch())
{
	?>
	<option value="<?php echo $sfet['id'];?>"><?php echo $sfet['location'];?></option>
	<?php
}
?>
</select>
</td>

