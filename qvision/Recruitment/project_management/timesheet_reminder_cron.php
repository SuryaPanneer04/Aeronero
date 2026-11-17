<?php
date_default_timezone_set('Asia/Kolkata');

// Check if today is Sunday (0) and exit if it is
$day = date('w');
if ($day == 0) { 
    exit("It's Sunday. No alerts will be sent.");
}

require __DIR__ . '/../connect.php'; 

// Load PHPMailer based on the existing paths used in the project
require __DIR__ . '/../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';

// Fetch all active employees that have an email id
$staff_query = $con->query("SELECT full_name, email_id FROM z_user_master WHERE email_id IS NOT NULL AND email_id != ''"); 
$staff_query->execute(); 
$users = $staff_query->fetchAll(PDO::FETCH_ASSOC);

$successCount = 0;
$failCount = 0;

foreach ($users as $row) {
    $FULLNAME = trim($row['full_name']); 
    $SENDMAIL = trim($row['email_id']);

    if(empty($SENDMAIL) || !filter_var($SENDMAIL, FILTER_VALIDATE_EMAIL)) {
        continue;
    }

    $mail = new PHPMailer;
    // $mail->SMTPDebug = 2; // Enable for debugging
    $mail->IsSMTP(true); 
    $mail->Port = 465;
    $mail->Host = 'mail.bluebase.in';        
    $mail->SMTPAuth = true;                              
    $mail->Username = 'surya@bluebase.in';
    $mail->Password = 'Surya@2026#';                           
    $mail->SMTPSecure = 'tls';                            
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ]
    ];
    
    $mail->From = 'surya@bluebase.in';		
    $mail->FromName = 'Aeronero Alert'; 
    $mail->AddAddress($SENDMAIL, $FULLNAME);		
    $mail->WordWrap = 50;			
    $mail->IsHTML(true);							

    $mail->Subject = 'Reminder: Update Your Daily Task / Timesheet';			
    
    $mail->Body  = "Dear " . $FULLNAME . ",<br/><br/>";	
    $mail->Body .= "This is an automated reminder to update your daily tasks / timesheet for today.<br/><br/>";
    $mail->Body .= "Please log into the portal and complete your submission before end of the day.<br/><br/>";
    $mail->Body .= "Regards,<br/>Aeronero Management";

    if (!$mail->send()) {
        echo "Failed to send to $SENDMAIL: " . $mail->ErrorInfo . "<br/>";
        $failCount++;
    } else {
        echo "Reminder sent successfully to $SENDMAIL.<br/>";
        $successCount++;
    }
}

echo "<br/><b>Cron Summary:</b> $successCount sent, $failCount failed.";
?>
