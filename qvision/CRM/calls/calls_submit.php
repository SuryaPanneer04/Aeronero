<?php

require '../../../connect.php';
include("../../../user.php");

header('Content-Type: application/json');

$user = $_SESSION['userid'];
$uploadDir = 'uploads/';

function fail($msg = "Failed") {
    echo json_encode(["status"=>0, "message"=>$msg]);
    exit;
}

/* ---------- BASIC CHECK ---------- */
if (
    empty($_POST['cust_type']) ||
    empty($_POST['Call_type'])
) {
    fail("Required fields missing");
}

/* ---------- VALUES ---------- */
$cust_type   = $_POST['cust_type'];
$Call_type   = $_POST['Call_type'];
$Client_type = $_POST['client_type'] ?? '';
$client_type1= $_POST['client_type1'] ?? '';

$client_name = $_POST['client_name'] ?? '';
$contact     = $_POST['contact'] ?? '';
$whatsapp    = $_POST['whatsapp'] ?? '';
$email       = $_POST['email'] ?? '';
$mail        = $_POST['mail'] ?? '';
$website     = $_POST['website'] ?? '';
$address     = $_POST['address'] ?? '';
$Product     = $_POST['Product'] ?? '';
$services    = $_POST['services'] ?? 12;
$remarks     = $_POST['remarks'] ?? '';

$feedback       = $_POST['feedback1'] ?? [];
$feedback_date  = $_POST['feedback_date1'] ?? [];
$fed_date       = $_POST['fed_date1'] ?? [];

$flag = 1;
$role_id = 'R018';
$uploadedFile = '';
$call_id = 0;

/* ---------- FILE UPLOAD ---------- */
if (!empty($_FILES['attachfile']['name'][0])) {
    foreach ($_FILES['attachfile']['name'] as $key => $name) {
        if ($_FILES['attachfile']['error'][$key] == 0) {
            $fileName = time().'_'.$name;
            move_uploaded_file($_FILES['attachfile']['tmp_name'][$key], $uploadDir.$fileName);
            $uploadedFile = $fileName;
        }
    }
}

/* =======================================================
   ONLY ONE PATH WILL EXECUTE BELOW
   ======================================================= */

/* COMPANY EXISTING */
if ($Client_type == 1) {

    $Company_name = $_POST['client_orgg'] ?? '';
    if (!$Company_name) fail("Company required");

    [$client_org_id, $client_org_name] = explode('-', $Company_name);

    $con->exec("
        INSERT INTO crm_calls
        (cust_type,call_type,client_type,client_org,client_id,client_name,role_id,
        contact,whatsapp,email,alternative_mail,website,address,Product,services,
        created_by,created_on,status,flag,image,remarks)
        VALUES
        ('$cust_type','$Call_type','1','$client_org_name','$client_org_id',
        '$client_name','$role_id','$contact','$whatsapp','$email','$mail',
        '$website','$address','$Product','$services',
        '$user',NOW(),1,'$flag','$uploadedFile','$remarks')
    ");

    $call_id = $con->lastInsertId();
}

/* COMPANY NEW */
elseif ($Client_type == 2) {

    if (!$client_name) fail("Company name required");

    $con->exec("
        INSERT INTO crm_calls
        (cust_type,call_type,client_type,client_org,client_name,role_id,
        contact,whatsapp,email,alternative_mail,website,address,Product,services,
        created_by,created_on,status,flag,image,remarks)
        VALUES
        ('$cust_type','$Call_type','2','Prospect Company',
        '$client_name','$role_id','$contact','$whatsapp','$email','$mail',
        '$website','$address','$Product','$services',
        '$user',NOW(),1,'$flag','$uploadedFile','$remarks')
    ");

    $call_id = $con->lastInsertId();
}

/* INDIVIDUAL */
elseif ($client_type1 == 3 || $client_type1 == 4) {

    $Company_name = 'Individual Customer';
    $ind_client_id = 0;

    if ($client_type1 == 4) {
        $client_org = $_POST['client_org'] ?? '';
        if (!$client_org) fail("Individual required");

        $stmt = $con->query("SELECT id FROM individual_form WHERE client_name='$client_org'");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $ind_client_id = $row['id'] ?? 0;
        $client_name = $client_org;
    }

    $con->exec("
        INSERT INTO crm_calls
        (client_org,cust_type,call_type,client_type,client_name,role_id,
        contact,whatsapp,email,alternative_mail,address,Product,services,
        created_by,created_on,status,flag,ind_client_id,image,remarks)
        VALUES
        ('$Company_name','$cust_type','$Call_type','$client_type1',
        '$client_name','$role_id','$contact','$whatsapp','$email','$mail',
        '$address','$Product','$services',
        '$user',NOW(),1,'$flag','$ind_client_id','$uploadedFile','$remarks')
    ");

    $call_id = $con->lastInsertId();
}

if ($call_id == 0) fail("Insert failed");

/* ---------- FEEDBACK ---------- */
foreach ($feedback as $i => $fb) {
    if (!empty($fb)) {
        $con->exec("
            INSERT INTO crm_calls_feedback
            (calls_id,feedback,feedback_date,date,created_by,created_on)
            VALUES
            ('$call_id','$fb','".$feedback_date[$i]."','".$fed_date[$i]."',
            '$user',NOW())
        ");
    }
}

/* ---------- SUCCESS ---------- */
echo json_encode([
    "status" => 1,
    "message" => "Call Added Successfully"
]);
exit;
