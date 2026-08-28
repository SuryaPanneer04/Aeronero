<?php
require '../../../connect.php';
include("../../../user.php");

// $ttt = $_POST;
// print_r($ttt);
// exit;
  
    $id=$_REQUEST['question_no'];
	$question   = $_REQUEST['question'];
	$option_a = $_REQUEST['option_a'];
	$option_b   = $_REQUEST['option_b'];
	$option_c      = $_REQUEST['option_c'];
	$option_d      = $_REQUEST['option_d'];
	$answer   = $_REQUEST['answer'];
	

	$update_sql = $con->query("UPDATE asses_question SET question = '$question', option_a = '$option_a', option_b = '$option_b', option_c = '$option_c', option_d = '$option_d', answer = '$answer' WHERE question_no = '$id' ");

	echo "UPDATE asses_question SET question = '$question', option_a='$option_a', option_b='$option_b', option_c='$option_c', option_d='$option_d',  WHERE question_no = '$id' ";

//UPDATE `asses_question` SET `question`='value-3' WHERE `question_no` = 26


if($update_sql)
{
	echo 1;
}
else
{
	echo 0;
}





// // $id=$_REQUEST['question_no'];
// // $question=$_REQUEST['question'];

// // $sql=$con->query("update asses_question set question_no='$question_no',question='$question',option_a='$option_a',option_b=$option_b ,option_c='$option_c',option_d='$option_d'where id='question_no'");
 
// // $sql=$con->query("update z_assesment_master (assesment_name,status,created_by,created_on) values ('$assesment_name','$status','$userid',now())");


?>