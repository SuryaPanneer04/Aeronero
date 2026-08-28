<?php
require '../../../connect.php';
include("../../../user.php");

$name = $_REQUEST['namee'];
$question = $_REQUEST['question'];

foreach($question as $q1){
    $questions .= $q1.",";

   //echo $questions.",";
}
echo $questions;
echo $name;
exit;

//$id=$_REQUEST['sno'];
// for($i=0; $i<=1; $i++){

// 	if(isset($_POST['question'])){

	
// $question=$_POST['question'][$i];


$sql=$con->query("UPDATE master_page SET verbal = '$questions' WHERE name='$name'"); 
echo "update master_page set verbal = '$questions' WHERE name='$name'";
// }

// }
//$insert_sql11=$con->query("INSERT INTO logical_master (`sno`,`question`) VALUES ( '".$id."'  , '".$question."')"); 

// $update_sql = $con->query("UPDATE logical_master SET  sno = '$id', question='$question'");

if($sql)
{
	echo "values inserted";
}
else

{ 
	echo "values not inserted";
}



?>