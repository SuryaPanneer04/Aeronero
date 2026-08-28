<?php
require '../../../connect.php';
include("../../../user.php");

// $user_id =$_SESSION['userid'];

    $question_type=$_REQUEST['name'];
	$question=$_REQUEST['question'];
	$option1=$_REQUEST['option_a'];
	$option2=$_REQUEST['option_b'];
	$option3=$_REQUEST['option_c'];
	$option4=$_REQUEST['option_d'];
	$status=$_REQUEST['option'];




	$insert_sql11=$con->query("INSERT INTO `asses_question` (`question_no`, `question_type`,`question`,`option_a`,  `option_b`, `option_c`, `option_d`, `answer`, `status`) VALUES (null, '".$question_type."','".$question."','".$option1."','".$option2."','".$option3."','".$option4."','".$status."', '1')");

echo "insert into `asses_question` (`question_no`, `question_type`,`question`,`option_a`,  `option_b`, `option_c`, `option_d`, `answer`, `status`) values (null, '".$question_type."','".$question."','".$option1."','".$option2."','".$option3."','".$option4."','".$status."', '1')";
	
	
	if($insert_sql11)
{
	echo "Question Added Sucessfully";
	
}
else{
echo "Question not added";
}

?>


<!-- INSERT INTO `asses_question` (`question_no`, `question_type`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `answer`, `status`) VALUES (NULL, 'logical', 'testtttt', 't1', 't2', 't3', 't4', 'd', '1'); -->









