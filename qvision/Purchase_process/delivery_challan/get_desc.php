<?php
require '../../../connect.php';
include("../../../user.php");
$state = $_REQUEST["id"];


$sql=$con->query("SELECT * FROM  product_master where id ='$state'");

?>
<option value="">Select Specification</option>

<?php
   while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["id"];?>"><?php echo $row["description"];?></option>
<?php
}

?>