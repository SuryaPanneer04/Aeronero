<?php
require '../../../connect.php'; 
require '../../../user.php'; 
require 'class/class.phpmailer.php';
require 'class/class.smtp.php';

$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : 0;

$rid = isset($_GET['rid']) ? $_GET['rid'] : '';
$feedback = isset($_GET['feedback']) ? $_GET['feedback'] : '';
$interview_date = isset($_GET['interview_date']) ? $_GET['interview_date'] : '';
$i_time = isset($_GET['i_time']) ? $_GET['i_time'] : '';
$venue = isset($_GET['venue']) ? $_GET['venue'] : '';
$app_name = isset($_GET['app_name']) ? $_GET['app_name'] : '';
$meetLink = isset($_GET['meetLink']) ? $_GET['meetLink'] : '';

$first_name = isset($_GET['first_name']) ? $_GET['first_name'] : '';
$last_name = isset($_GET['last_name']) ? $_GET['last_name'] : '';
$user_name = trim($first_name . " " . $last_name);
$mail_to = isset($_GET['mail']) ? $_GET['mail'] : '';
$position = isset($_GET['position']) ? $_GET['position'] : '';

$created_on = date('Y-m-d');

// Insert into interview_schedule_detail
$sql = "INSERT INTO interview_schedule_detail (resource_id, feedback, interview_date, remarks, status, user_role, created_by, created_on, venue, virtual_link, application_name) 
VALUES ('$rid', '$feedback', '$interview_date', '$i_time', 1, 'ROLE-010', '$userid', '$created_on', '$venue', '$meetLink', '$app_name')";
$con->query($sql);

// Update status to 2 (Interview Scheduled)
$con->query("UPDATE resource_form_detail SET status=2 WHERE id='$rid'");
$con->query("UPDATE candidate_form_details SET status=2 WHERE resource_id='$rid'");

// Send Mail
$mail = new PHPMailer;
$mail->IsSMTP(); 
$mail->Mailer = "smtp";
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = 'suryabluebase@gmail.com';                 
$mail->Password = 'kdhp xnpd kxnr tagx';                           
$mail->SMTPSecure = 'ssl';                            
$mail->Port = 465;
$mail->From = 'suryabluebase@gmail.com';
$mail->FromName = 'Recruitment Team';
$mail->AddAddress($mail_to, $user_name);		

$mail->WordWrap = 50;                                 
$mail->isHTML(true);                                 

$subject = "Interview Schedule - " . $position;			
$html_table = 'Dear ' . $user_name . ',<br><br>';
$html_table .= 'We are pleased to inform you that your interview for the position of <b>' . $position . '</b> has been scheduled.<br><br>';
$html_table .= '<b>Date:</b> ' . date('d-m-Y', strtotime($interview_date)) . '<br>';
$html_table .= '<b>Time:</b> ' . $i_time . '<br>';

if ($feedback == '2') {
    $html_table .= '<b>Venue:</b> ' . $venue . '<br>';
} else {
    $html_table .= '<b>Application:</b> ' . $app_name . '<br>';
    $html_table .= '<b>Meeting Link:</b> <a href="' . $meetLink . '">' . $meetLink . '</a><br>';
}

$html_table .= '<br>Please be available 10 minutes before the scheduled time.<br><br>';
$html_table .= '<h4>Thanks & Regards,</h4><p>Recruitment Team</p>';

$mail->Subject = $subject;
$mail->Body = $html_table;

if(!$mail->send()) {
    echo "0";
} else {
    echo "1";
}
?>
