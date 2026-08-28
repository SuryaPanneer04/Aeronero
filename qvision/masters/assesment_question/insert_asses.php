<?php
require '../../../connect.php';
include("../../../user.php");

if(isset($_REQUEST['submit'])){

	$question_type   =    $_REQUEST['name'];
	$question         =   $_REQUEST['question'];
	$option1          =   $_REQUEST['option_a'];
	$option2          =   $_REQUEST['option_b'];
	$option3          =   $_REQUEST['option_c'];
	$option4          =   $_REQUEST['option_d'];
	$status           =   $_REQUEST['option'];
	
	
	
	$insert_sql=$con->query("INSERT INTO asses_question(question_type,question, option_a, option_b, option_c, option_d, answer)
	VALUES ('$question_type','$question','$option1','$option2','$option3','$option4','$status')");

echo "INSERT INTO asses_question(question_type,question, option_a, option_b, option_c, option_d, answer)
VALUES ('$question','$option1','$option2','$option3','$option4','$status')";
	
	
	if($insert_sql)
{
	echo "1";
	
}else{
echo "2";
}
}
?>