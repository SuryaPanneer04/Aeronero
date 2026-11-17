<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);
header('Content-Type: application/json');

require('../connect.php');

$user_id =  $_REQUEST['userId'];
//candidateid == userid
$candidateid = $user_id;

//new feedback insert variable
$type =  $_REQUEST['type'];

if (isset($type) && $type == 'submit') {
    //feedback values
    $userIdValue               = $_POST['userId'] ?? null;
    $callsId                   = $_POST['calls_id'] ?? null;
    $feedback                  = $_POST['feedback'] ?? null;
    $feedback_date             = $_POST['feedback_date'] ?? null;
    $follow_up_date            = $_POST['follow_up_date'] ?? null;

    $sql11 = $con->prepare("INSERT INTO crm_calls_feedback
                (
                    calls_id,
                    feedback,
                    feedback_date,
                    date,
                    created_by,
                    created_on
                )
                VALUES
                (
                    :calls_id,
                    :feedback,
                    :feedback_date,
                    :follow_up_date,
                    :created_by,
                    NOW()
                )
            ");

    $sql11->execute([
        ':calls_id'        => $callsId,
        ':feedback'        => $feedback,
        ':feedback_date'   => $feedback_date,
        ':follow_up_date'  => $follow_up_date,
        ':created_by'      => $userIdValue ?? 1
    ]);


    echo json_encode([
        'status' => 'success',
        'message' => 'Data Inserted Successfully',
    ]);
    exit;
}

//assign the department employee
if (isset($type) && $type == 'assign') {
    $id               = $_POST['id'] ?? null;
    $department       = $_POST['department'] ?? null;
    $employee         = $_POST['employee'] ?? null;

    if ($id != null && $department != null && $employee != null) {
        $sql12 = $con->query("Update crm_calls set department='$department',employee='$employee',status='2' where id='$id'");

        echo json_encode([
            'status' => 'success',
            'message' => 'Updated successfully'
        ]);
        exit();
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'All id required'
        ]);
        exit();
    }
}

//drop function call
if (isset($type) && $type == 'drop') {
    $id               = $_POST['id'] ?? null;
    $remark           = $_POST['remark'] ?? null;

    if ($id != null && $remark != null) {
        $sql12 = $con->query("Update crm_calls set drop_remark='$remark',status='5' where id='$id'");

        echo json_encode([
            'status' => 'success',
            'message' => 'Updated successfully'
        ]);
        exit();
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'All id required'
        ]);
        exit();
    }
}

$sel = $con->query("select a.department,b.head_status from z_user_master a left join staff_master b on (a.candidate_id=b.candid_id) where a.user_id='$user_id'");

$fet = $sel->fetch();
$head_status = $fet['head_status'];
$vel = $con->query("select user_group_code from z_user_master where user_id='$user_id'");
$vet = $vel->fetch();
$user_group_code = $vet['user_group_code'];

if ($head_status == 1) {
    $vel = $con->query("select a.department,a.user_group_code,b.head_status from z_user_master a left join staff_master b on (a.candidate_id=b.candid_id) where a.user_id='$user_id'");
    $vet = $vel->fetch();
    $user_group_code = $vet['user_group_code'];
    $department = $vet['department'];

    $del = $con->query("select user_group_code,department,user_id from z_user_master where department='$department' and user_group_code='$user_group_code'");

    $det = $del->fetch();
    $check_userid = $det['user_id'];
} else {
    $check_userid = 990;
}

// if ($user_group_code === 'R001') {
//     // ADMIN – ALL DATA old
//     $sql = $con->prepare("SELECT a.id,a.client_org,a.created_by as created_by,a.created_on as created_on,a.client_name,b.feedback,b.feedback_date,b.date,a.status,c.full_name FROM `crm_calls` a left join `crm_calls_feedback` b on  (a.id=b.calls_id) left join z_user_master c on (a.created_by=c.user_id)order by a.id desc");
//     $sql->execute();
// } elseif ($user_id == $check_userid) {
//     // // DEPARTMENT USER
//     $sql = $con->prepare("SELECT a.id,a.client_org,a.created_by as created_by,a.created_on as created_on,a.client_name,b.feedback,b.feedback_date,b.date,a.status,c.full_name,c.user_id,c.department FROM `crm_calls` a left join `crm_calls_feedback` b on  (a.id=b.calls_id) left join z_user_master c on (a.created_by=c.user_id) left join staff_master d on (c.candidate_id=d.candid_id) where c.department= :department order by a.id desc");
//     $sql->execute([
//         ':department' => $department
//     ]);
// } else {
//     // NORMAL USER
//     $sql = $con->prepare("
//             SELECT 
//                 a.id,a.client_org,a.client_name,a.created_by,a.created_on,a.status,
//                 b.feedback,b.feedback_date,b.date AS follow_up_date,
//                 c.full_name,c.user_id,c.department
//             FROM crm_calls a
//             LEFT JOIN crm_calls_feedback b ON a.id = b.calls_id
//             LEFT JOIN z_user_master c ON a.created_by = c.user_id
//             WHERE a.created_by = :user_id
//             ORDER BY a.id DESC
//         ");
//     $sql->execute([
//         ':user_id' => $user_id
//     ]);
// }


if ($user_group_code == 'R001' || $user_group_code == 'R003' || $user_group_code == 'R008') {
    $sql = $con->query("SELECT 
                a.id,
                a.client_org,
                a.client_name,
                a.created_on,
                a.contact,
                a.email,
                a.status,
                d.emp_name
            FROM crm_calls a 

            LEFT JOIN crm_calls_feedback b 
                ON a.id = b.calls_id

            LEFT JOIN (
                SELECT user_id, MAX(candidate_id) AS candidate_id
                FROM z_user_master
                GROUP BY user_id
            ) c ON a.created_by = c.user_id

            LEFT JOIN (
                SELECT candid_id, MAX(emp_name) AS emp_name
                FROM staff_master
                GROUP BY candid_id
            ) d ON c.candidate_id = d.candid_id

            ORDER BY a.id DESC;
        ");
} elseif ($user_id == $check_userid) {
    $sql = $con->query("SELECT 
                a.id,
                a.client_org,
                a.client_name,
                a.created_on,
                a.contact,
                a.email,
                a.status,
                d.emp_name
            FROM crm_calls a

            LEFT JOIN crm_calls_feedback b 
                ON a.id = b.calls_id

            LEFT JOIN z_user_master c 
                ON a.created_by = c.user_id

            LEFT JOIN staff_master d 
                ON c.candidate_id = d.candid_id

            WHERE c.department = $department

            ORDER BY a.id DESC;
        ");
} else {
    $sql = $con->query("SELECT
            a.id,
            a.client_org,
            a.client_name,
            a.created_on,
            a.contact,
            a.email,
            a.status,
            d.emp_name
             FROM `crm_calls` a 
            left join z_user_master c on (a.created_by=c.user_id) 
            left join staff_master d on (c.candidate_id=d.candid_id) 
            where (a.employee='$department' or a.created_by='$user_id') 
            group by a.id  
            order by a.id desc;
        ");
}

$data = $sql->fetchAll(PDO::FETCH_ASSOC);

$emp = $con->query("SELECT user_id,full_name,user_name FROM `z_user_master`");
$empData = $emp->fetchAll(PDO::FETCH_ASSOC);


echo json_encode([
    'status' => 'success',
    'id' => $user_id,
    'department' => $department,
    'check' => $check_userid,
    'count'  => count($data),
    'data'   => $data,
    'empData'   => $empData
]);
exit;
