<?php
require '../../../connect.php';
include("../../../user.php");
$uploadDir = 'uploads/';
$userrole = $_SESSION['userrole'];
$user = $_SESSION['userid'];
$candidateid = $_SESSION['candidateid'];

if (isset($_POST['idd']) || isset($_FILES['attachfile'])) {
    $id = $_REQUEST['idd'];
    $enquiry_id = $_REQUEST['idd'];
    $filesArr3 = $_FILES['attachfile'];
    $sco = trim($_REQUEST['sco']);

    // Create uploads folder if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Upload file 
    $uploadedFile = '';
    if (!empty($filesArr3['name'])) {
        foreach ($filesArr3['name'] as $key => $val) {
            if (!empty($filesArr3['name'][$key])) {
                $fileName = basename($filesArr3['name'][$key]);
                $targetFilePath = $uploadDir . $fileName;
                if (move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)) {
                    $uploadedFile = $fileName;
                }
            }
        }
    }

    $flow = 1;

    // FIX 1: Use LEFT JOIN so it works even if crm_calls_feedback has no rows yet, and take the latest feedback
    $aa = $con->query("SELECT a.*, a.department as dd, a.employee as em, 
                              b.id as idd, b.feedback, b.feedback_date, b.date as f_date 
                       FROM crm_calls a 
                       LEFT JOIN crm_calls_feedback b ON a.id = b.calls_id 
                       WHERE a.id = '$enquiry_id' 
                       ORDER BY b.id DESC LIMIT 1");
    $a1 = $aa->fetch(PDO::FETCH_ASSOC);

    $feedbackid    = !empty($a1['idd']) ? $a1['idd'] : 0;
    $cust_type     = !empty($a1['cust_type']) ? $a1['cust_type'] : 1;
    $client_id     = !empty($a1['client_id']) ? $a1['client_id'] : 0;
    $ind_client_id = !empty($a1['ind_client_id']) ? $a1['ind_client_id'] : 0;
    $feedback      = $a1['feedback'] ?? '';
    $feedback_date = $a1['feedback_date'] ?? date('Y-m-d');
    $Follup        = !empty($a1['f_date']) ? $a1['f_date'] : date('Y-m-d');
    $date          = !empty($a1['f_date']) ? $a1['f_date'] : date('Y-m-d');
    $Call_type     = $a1['call_type'] ?? '';
    $Client_type   = !empty($a1['client_type']) ? $a1['client_type'] : 1;
    $client_name   = $a1['client_name'] ?? '';
    $contact       = $a1['contact'] ?? '';
    $whatsapp      = $a1['whatsapp'] ?? '';
    $email         = $a1['email'] ?? '';
    $website       = $a1['website'] ?? '';
    $address       = $a1['address'] ?? '';
    $Product       = $a1['Product'] ?? '';
    $list          = $a1['services'] ?? '';

    $dep = $con->query("SELECT * FROM staff_master WHERE candid_id='$candidateid'");
    $depp = $dep->fetch(PDO::FETCH_ASSOC);
    $department_id = !empty($depp['dep_id']) ? $depp['dep_id'] : ($a1['dd'] ?? 0);

    $employee_id   = $candidateid;
    $Company_name  = $a1['client_org'] ?? '';
    $flag          = '2';

    // Generate enquiry_code (Default to E if Client_type is not 2)
    if ($Client_type == 2) {
        $enq = $con->query("SELECT * FROM enquiry WHERE `enquiry_code` LIKE 'N%'");
        $enq_count = $enq->rowCount();
        if ($enq_count == 0) {
            $enquiry_code = 'N0001';
        } else {
            $stmte = $con->prepare("SELECT MAX(ID) as max_id FROM enquiry WHERE `enquiry_code` LIKE 'N%'");
            $stmte->execute();
            $rowe = $stmte->fetch();
            $maxi_id = $rowe['max_id'];

            $stmtv = $con->prepare("SELECT id, enquiry_code FROM enquiry WHERE id='$maxi_id'");
            $stmtv->execute();
            $rowv = $stmtv->fetch();

            $find_fe = substr($rowv['enquiry_code'], 0, 2);
            $find_se = substr($rowv['enquiry_code'], 2, 4);
            $final_enqno = str_pad((int)$find_se + 1, 3, '0', STR_PAD_LEFT);
            $enquiry_code = $find_fe . $final_enqno;
        }
    } else {
        $enq = $con->query("SELECT * FROM enquiry WHERE `enquiry_code` LIKE 'E%'");
        $enq_count = $enq->rowCount();
        if ($enq_count == 0) {
            $enquiry_code = 'E0001';
        } else {
            $stmte = $con->prepare("SELECT MAX(ID) as max_id FROM enquiry WHERE `enquiry_code` LIKE 'E%'");
            $stmte->execute();
            $rowe = $stmte->fetch();
            $maxi_id = $rowe['max_id'];

            $stmtv = $con->prepare("SELECT id, enquiry_code FROM enquiry WHERE id='$maxi_id'");
            $stmtv->execute();
            $rowv = $stmtv->fetch();

            $find_fe = substr($rowv['enquiry_code'], 0, 2);
            $find_se = substr($rowv['enquiry_code'], 2, 4);
            $final_enqno = str_pad((int)$find_se + 1, 3, '0', STR_PAD_LEFT);
            $enquiry_code = $find_fe . $final_enqno;
        }
    }

    // FIX 2: Use a Prepared Statement so special characters / quotes don't break the INSERT
    $insertStmt = $con->prepare("INSERT INTO enquiry (
        `enquiry_code`, `Call_type`, `cust_type`, `Calls_id`, `Calls_feedbackid`, 
        `date`, `Client_type`, `Company_name`, `Address`, `it_name`, `Client_id`, 
        `Product`, `list`, `feedback`, `Follup`, `Department`, `employee`, 
        `created_by`, `created_on`, `ind_client_id`, `verified_file`, `requirement`
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?
    )");

    $inserted = $insertStmt->execute([
        $enquiry_code, $Call_type, $cust_type, $enquiry_id, $feedbackid,
        $date, $Client_type, $Company_name, $address, $client_name, $client_id,
        $Product, $list, $feedback, $Follup, $department_id, $employee_id,
        $user, $ind_client_id, $uploadedFile, $sco
    ]);

    if (!$inserted) {
        $err = $insertStmt->errorInfo();
        echo "SQL Error: " . $err[2];
        exit;
    }

    $enqid = $con->lastInsertId();

    // Update crm_calls safely
    $updCalls = $con->prepare("UPDATE crm_calls SET department=?, employee=?, enquiry_id=?, status='3', verified_file=?, requirement=? WHERE id=?");
    $updCalls->execute([$department_id, $employee_id, $enqid, $uploadedFile, $sco, $id]);

    // Update enquiry flag & status
    if ($cust_type == 2) {
        $cc = $con->query("SELECT * FROM individual_form WHERE id='$ind_client_id'");
        $cc1 = $cc->rowCount();
        $new_status = ($cc1 == 0) ? '2' : '3';
        $con->query("UPDATE `enquiry` SET `flag`='$flag', `status`='$new_status' WHERE id='$enqid'");
    } else {
        $bb = $con->query("SELECT * FROM new_client_master a JOIN new_plant_master b ON (a.id=b.client_id) WHERE a.id='$client_id'");
        $bb1 = $bb->rowCount();
        $new_status = ($bb1 == 0) ? '2' : '3';
        $con->query("UPDATE `enquiry` SET `flag`='$flag', `status`='$new_status', `Client_id`='$client_id' WHERE id='$enqid'");
    }

    echo "1";
}
?>