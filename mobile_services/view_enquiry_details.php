<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);
header('Content-Type: application/json');

require('../connect.php');

$id =  $_REQUEST['id'];
$call_source_id = $_REQUEST['call_source_id'];

// $query = $con->prepare("SELECT 
//                 a.cust_type,a.call_type,a.client_type,a.client_org,a.client_name,a.contact,
//                 a.whatsapp,a.email,a.alternative_mail,a.website,a.address,a.Product,a.services,
//                 a.remarks,a.image,
//                 b.feedback,b.feedback_date,b.date AS follow_up_date,
//                 c.full_name, c.user_id,c.department,
//                 cm.name,
//                 ps.name AS productName
//             FROM crm_calls_feedback b 
//             LEFT JOIN crm_calls a ON a.id = b.calls_id
//             -- FROM crm_calls a
//             -- LEFT JOIN crm_calls_feedback b ON a.id = b.calls_id
//             LEFT JOIN z_user_master c ON a.created_by = c.user_id
//             LEFT JOIN calls_master cm ON a.cust_type =cm.id
//             LEFT JOIN product_services ps ON ps.id = a.services
//             WHERE a.id = '" . $id . "' ORDER BY a.id DESC");
// $query->execute();
// $row = $query->fetchAll(PDO::FETCH_ASSOC);

// echo json_encode([
//     'status' => 'success',
//     'data' => $row
// ]);


$query = $con->prepare("SELECT
        a.id, a.cust_type, a.call_type, a.client_type, a.client_org, a.client_name,
        a.contact, a.whatsapp, a.email, a.alternative_mail, a.website,
        a.address, a.Product, a.services, a.remarks, a.image,a.status,a.drop_remark,

        b.feedback, b.feedback_date, b.date AS follow_up_date,

        c.full_name, c.user_id, c.department,
        cm.name AS call_name,
        ps.name AS productName,
        zdm.dept_name,
        sm.emp_name
        FROM crm_calls a
        LEFT JOIN crm_calls_feedback b ON a.id = b.calls_id
        LEFT JOIN z_user_master c ON a.created_by = c.user_id
        LEFT JOIN calls_master cm ON a.cust_type = cm.id
        LEFT JOIN product_services ps ON ps.id = a.services
        LEFT JOIN z_department_master zdm ON zdm.id = a.department 
        LEFT JOIN staff_master sm ON sm.id = a.employee     
        WHERE a.id = :id
        ORDER BY b.id DESC
    ");

$query->execute([':id' => $id]);
$rows = $query->fetchAll(PDO::FETCH_ASSOC);

if (!$rows) {
    echo json_encode([
        'status' => 'error',
        'message' => 'No data found'
    ]);
    exit;
}

/* CALL DETAILS (take from first row) */
$call = [
    'id'               => $rows[0]['id'],
    'status'           => $rows[0]['status'],
    'cust_type'        => $rows[0]['cust_type'],
    'call_type'        => $rows[0]['call_type'],
    'client_type'      => $rows[0]['client_type'],
    'client_org'       => $rows[0]['client_org'],
    'client_name'      => $rows[0]['client_name'],
    'contact'          => $rows[0]['contact'],
    'whatsapp'         => $rows[0]['whatsapp'],
    'email'            => $rows[0]['email'],
    'alternative_mail' => $rows[0]['alternative_mail'],
    'website'          => $rows[0]['website'],
    'address'          => $rows[0]['address'],
    'Product'          => $rows[0]['Product'],
    'services'         => $rows[0]['services'],
    'remarks'          => $rows[0]['remarks'],
    'drop_remark'      => $rows[0]['drop_remark'],
    'image'            => $rows[0]['image'],
    'full_name'        => $rows[0]['full_name'],
    'user_id'          => $rows[0]['user_id'],
    'call_name'        => $rows[0]['call_name'],
    'productName'      => $rows[0]['productName'],
    'department'       => $rows[0]['dept_name'],
    'employee'         => $rows[0]['emp_name'],
];

/* FEEDBACK LIST */

$feedbacks = [];

foreach ($rows as $row) {
    if ($row['feedback'] !== null) {
        $feedbacks[] = [
            'feedback'        => $row['feedback'],
            'feedback_date'   => $row['feedback_date'],
            'follow_up_date'  => $row['follow_up_date']
        ];
    }
}

echo json_encode([
    'status' => 'success',
    'data' => [
        'call' => $call,
        'feedbacks' => $feedbacks
    ]
]);

exit;
