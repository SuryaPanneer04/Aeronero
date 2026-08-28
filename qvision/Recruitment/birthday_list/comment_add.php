<?php
require '../../../connect.php';

if(isset($_REQUEST['submit']))
{
	$comments = $_REQUEST['comment'];
	
	$statement = $con->prepare("INSERT INTO birthday (comments) VALUES ('$comments')");
	$sql = $statement->execute();
	if($sql)
	{
		echo "Success";
	}
	else
	{
		echo "Failed to insert comment";
	}
}
?>
