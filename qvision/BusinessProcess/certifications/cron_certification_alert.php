<?php
// cron_certification_alert.php
// This script should be run daily via a Cron Job or Windows Task Scheduler

require '../../../connect.php'; // DB connection
require '../../../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';

// 1. Get Emails of Users with Role 'R001' and 'R008'
$to_emails = [];
$users = $con->query("SELECT email_id FROM z_user_master WHERE user_group_code LIKE '%R001%' OR user_group_code LIKE '%R008%'");
if($users && $users->rowCount() > 0) {
    while($u = $users->fetch(PDO::FETCH_ASSOC)) {
        if(!empty($u['email_id'])) {
            $to_emails[] = $u['email_id'];
        }
    }
}

if(empty($to_emails)) {
    echo "No R001 users found with a valid email ID.\n";
    exit;
}

// 2. Find certifications expiring in exactly 1 month (or less than 1 month, up to 30 days)
$sql = $con->query("SELECT * FROM z_certifications WHERE expiry_date IS NOT NULL AND expiry_date != '0000-00-00' AND expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)");

if($sql && $sql->rowCount() > 0) {
    while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $cert_name = $row['cert_name'];
        $expiry_date = date('d-m-Y', strtotime($row['expiry_date']));
        
        $subject = "Alert: Certification Expiring Soon - $cert_name";
        $message = "Hello Admin,\n\nThis is an automated alert from Aeronero.\n\nYour certification '$cert_name' is expiring on $expiry_date (within 1 month).\nPlease take necessary actions for renewal.\n\nThank you.";
        
        // 3. Setup PHPMailer and Send Email
        $mail = new PHPMailer;
        //$mail->SMTPDebug = 2; // Enable for debugging
        $mail->isSMTP(); 
        $mail->Host = 'mail.bluebase.in';        
        $mail->SMTPAuth = true;
        $mail->Username = 'surya@bluebase.in';
        $mail->Password = 'Surya@2026#';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ];
        
        $mail->setFrom('surya@bluebase.in', 'Aeronero Alert System');
        
        // Add all R001 users
        foreach($to_emails as $email) {
            $mail->addAddress($email);
        }
        
        $mail->Subject = $subject;
        $mail->Body    = $message;
        
        if(!$mail->send()) {
            echo "Message could not be sent for $cert_name. Mailer Error: " . $mail->ErrorInfo . "\n";
        } else {
            echo "Alert sent successfully for $cert_name (Expires: $expiry_date) to " . count($to_emails) . " users.\n";
        }
    }
} else {
    echo "No certifications expiring in the next 1 month.\n";
}
?>

