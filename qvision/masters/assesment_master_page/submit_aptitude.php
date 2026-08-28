<?php
require '../../../connect.php';
include("../../../user.php");

$question = $_REQUEST['question'];

foreach($question as $q1){
    $questions .= $q1.",";

   //echo $questions.",";
}
//echo $questions;


//$id=$_REQUEST['sno'];
// for($i=0; $i<=1; $i++){

// 	if(isset($_POST['question'])){

	
// $question=$_POST['question'][$i];


$sql=$con->query("INSERT INTO master_page (`aptitude`) VALUES ('$questions')"); 
echo "insert into master_page(`aptitude`) values ('$questions')";
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