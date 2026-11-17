
<?php
// leads_data.php — Server-side DataTables endpoint

ob_start();

require_once __DIR__ . '/../../../connect.php';
require_once __DIR__ . '/../../../user.php';

if (ob_get_length()) {
    ob_clean();
}

header('Content-Type: application/json; charset=utf-8');

function leadsJson($response, $status = 200)
{
    http_response_code($status);
    echo json_encode(
        $response,
        JSON_INVALID_UTF8_SUBSTITUTE
    );
    exit;
}

function leadsEscape($value)
{
    return htmlspecialchars(
        (string)($value ?? ''),
        ENT_QUOTES,
        'UTF-8'
    );
}

try {
    $con->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $userId = $_SESSION['userid'] ?? null;
    $userRole = (string)($_SESSION['userrole'] ?? '');
    $candidateId = $_SESSION['candidateid'] ?? '';

    if (!$userId) {
        leadsJson([
            'error' => 'Session expired. Please log in.'
        ], 401);
    }

    // Read DataTables pagination.
    $draw = max(0, (int)($_POST['draw'] ?? 0));
    $start = max(0, (int)($_POST['start'] ?? 0));
    $length = (int)($_POST['length'] ?? 10);
    $length = max(1, min(100, $length));

    $search = trim(
        (string)($_POST['search']['value'] ?? '')
    );

    // Determine department-head permissions.
    $department = '';
    $checkUserId = 990;

    $userStmt = $con->prepare("
        SELECT
            a.department,
            a.user_group_code,
            b.head_status
        FROM z_user_master a
        LEFT JOIN staff_master b
            ON a.candidate_id = b.candid_id
        WHERE a.user_id = :uid
        LIMIT 1
    ");

    $userStmt->execute(['uid' => $userId]);
    $userInfo = $userStmt->fetch(PDO::FETCH_ASSOC);

    if ($userInfo &&
        (int)$userInfo['head_status'] === 1) {

        $department = $userInfo['department'];
        $groupCode = $userInfo['user_group_code'];

        $groupStmt = $con->prepare("
            SELECT user_id
            FROM z_user_master
            WHERE department = :department
              AND user_group_code = :group_code
            LIMIT 1
        ");

        $groupStmt->execute([
            'department' => $department,
            'group_code' => $groupCode
        ]);

        $groupUser = $groupStmt->fetch(PDO::FETCH_ASSOC);

        if ($groupUser) {
            $checkUserId = $groupUser['user_id'];
        }
    }

    // Preserve original role-based access.
    $accessConditions = [];
    $accessParams = [];

    if ($userRole === 'R001') {

        // Admin can view all leads.

    } elseif (
        (string)$userId === (string)$checkUserId &&
        $department !== ''
    ) {

        $accessConditions[] = "
            EXISTS (
                SELECT 1
                FROM z_user_master dept_user
                WHERE dept_user.user_id = l.created_by
                  AND dept_user.department = :department
            )
        ";

        $accessParams['department'] = $department;

    } else {

        $accessConditions[] = "
            (
                l.employee = :candidate
                OR l.created_by = :user_id
            )
        ";

        $accessParams['candidate'] = $candidateId;
        $accessParams['user_id'] = $userId;
    }

    $accessSql = $accessConditions
        ? ' WHERE ' . implode(' AND ', $accessConditions)
        : '';

    // Count all records visible to this user.
    $countStmt = $con->prepare(
        "SELECT COUNT(*) FROM crm_leads l " . $accessSql
    );

    $countStmt->execute($accessParams);
    $total = (int)$countStmt->fetchColumn();

    // Apply search, preserving user permissions.
    $conditions = $accessConditions;
    $params = $accessParams;

    if ($search !== '') {

        $conditions[] = "
            (
                l.client_org LIKE :search_org
                OR l.client_name LIKE :search_client
                OR CAST(l.created_on AS CHAR) LIKE :search_date
                OR EXISTS (
                    SELECT 1 FROM lead_sources ls
                    WHERE ls.id = l.call_source
                    AND ls.name LIKE :search_source
                )
                OR EXISTS (
                    SELECT 1 FROM z_user_master um
                    WHERE um.user_id = l.created_by
                    AND um.full_name LIKE :search_creator
                )
                OR EXISTS (
                    SELECT 1
                    FROM crm_leads_feedback sf
                    WHERE sf.id = (
                        SELECT MAX(sf2.id)
                        FROM crm_leads_feedback sf2
                        WHERE sf2.lead_id = l.id
                    )
                    AND (
                        sf.feedback LIKE :search_feedback
                        OR CAST(sf.feedback_date AS CHAR)
                            LIKE :search_feedback_date
                        OR CAST(sf.followup_date AS CHAR)
                            LIKE :search_followup
                    )
                )
            )
        ";

        $like = '%' . $search . '%';

        $params['search_org'] = $like;
        $params['search_client'] = $like;
        $params['search_date'] = $like;
        $params['search_source'] = $like;
        $params['search_creator'] = $like;
        $params['search_feedback'] = $like;
        $params['search_feedback_date'] = $like;
        $params['search_followup'] = $like;
    }

    $whereSql = $conditions
        ? ' WHERE ' . implode(' AND ', $conditions)
        : '';

    // Count only matching records.
    if ($search === '') {
        $filtered = $total;
    } else {

        $filterStmt = $con->prepare(
            "SELECT COUNT(*) FROM crm_leads l " . $whereSql
        );

        $filterStmt->execute($params);

        $filtered = (int)$filterStmt->fetchColumn();
    }

    // Whitelisted sortable columns.
    $sortColumns = [
        1 => 'l.id',
        2 => 'l.created_on',
        3 => 'l.client_org',
        4 => 'l.client_name'
    ];

    $orderIndex = (int)(
        $_POST['order'][0]['column'] ?? 1
    );

    $orderDirection = strtolower(
        (string)($_POST['order'][0]['dir'] ?? 'desc')
    ) === 'asc' ? 'ASC' : 'DESC';

    $orderColumn = $sortColumns[$orderIndex] ?? 'l.id';

    $orderSql = " ORDER BY $orderColumn $orderDirection";

    if ($orderColumn !== 'l.id') {
        $orderSql .= ', l.id DESC';
    }

    // Fetch only the requested page's lead IDs.
    $pageSql = "
        SELECT l.id
        FROM crm_leads l
        $whereSql
        $orderSql
        LIMIT :page_limit OFFSET :page_offset
    ";

    $pageStmt = $con->prepare($pageSql);

    foreach ($params as $key => $value) {
        $pageStmt->bindValue(':' . $key, $value);
    }

    $pageStmt->bindValue(
        ':page_limit',
        $length,
        PDO::PARAM_INT
    );

    $pageStmt->bindValue(
        ':page_offset',
        $start,
        PDO::PARAM_INT
    );

    $pageStmt->execute();

    $ids = $pageStmt->fetchAll(PDO::FETCH_COLUMN);
    $data = [];

    if (!empty($ids)) {

        $placeholders = implode(
            ',',
            array_fill(0, count($ids), '?')
        );

        // Fetch related information only for these IDs.
        $detailSql = "
            SELECT
                l.id,
                l.created_on,
                l.client_org,
                l.client_name,
                l.status,
                l.moved_to_enquiry,

                s.name AS source_name,
                u.full_name AS created_by_name,

                f.feedback,
                f.feedback_date,
                f.followup_date

            FROM crm_leads l

            LEFT JOIN lead_sources s
                ON s.id = l.call_source

            LEFT JOIN z_user_master u
                ON u.user_id = l.created_by

            LEFT JOIN crm_leads_feedback f
                ON f.id = (
                    SELECT MAX(f2.id)
                    FROM crm_leads_feedback f2
                    WHERE f2.lead_id = l.id
                )

            WHERE l.id IN ($placeholders)
        ";

        $detailStmt = $con->prepare($detailSql);
        $detailStmt->execute($ids);

        $leadsById = [];

        while ($lead = $detailStmt->fetch(PDO::FETCH_ASSOC)) {
            $leadsById[$lead['id']] = $lead;
        }

        foreach ($ids as $index => $leadId) {

            if (!isset($leadsById[$leadId])) {
                continue;
            }

            $lead = $leadsById[$leadId];
            $id = (int)$lead['id'];
            $moved = (int)$lead['moved_to_enquiry'] === 1;

            // Checkbox.
            $checkbox = '';

            if (!$moved) {
                $checkbox =
                    '<input type="checkbox" ' .
                    'class="lead-select-checkbox lead-row-checkbox" ' .
                    'value="' . $id . '">';
            }

            // Status.
            if ($moved) {
                $status =
                    '<span style="color:green;font-weight:bold;">' .
                    'Moved to Enquiry</span>';
            } elseif ((int)$lead['status'] === 1) {
                $status =
                    '<span style="color:green;font-weight:bold;">' .
                    'Active</span>';
            } else {
                $status =
                    '<span style="color:red;font-weight:bold;">' .
                    'Inactive</span>';
            }

            // Action buttons.
            $actions = '<div class="lead-action-buttons">';

            if (!$moved) {
                $actions .=
                    '<button type="button" ' .
                    'class="btn btn-primary btn-sm lead-action-btn" ' .
                    'onclick="moveLead(' . $id . ')">' .
                    '<i class="fa fa-exchange"></i> Move' .
                    '</button>';
            }

            $actions .=
                '<button type="button" ' .
                'class="btn btn-warning btn-sm lead-action-btn" ' .
                'onclick="calls_edit(' . $id . ')">' .
                '<i class="fa fa-edit"></i> Edit' .
                '</button>';

            $actions .=
                '<button type="button" ' .
                'class="btn btn-danger btn-sm lead-action-btn" ' .
                'onclick="deleteLeadFeedback(' . $id . ')">' .
                '<i class="fa fa-trash"></i> Delete Feedback' .
                '</button>';

            $actions .= '</div>';

            $data[] = [
                $checkbox,
                $start + $index + 1,
                leadsEscape($lead['created_on']),
                leadsEscape($lead['client_org']),
                leadsEscape($lead['client_name']),
                leadsEscape($lead['source_name']),
                leadsEscape($lead['feedback']),
                leadsEscape($lead['feedback_date']),
                leadsEscape($lead['followup_date']),
                leadsEscape(
                    $lead['created_by_name'] ?: 'Unknown User'
                ),
                $status,
                $actions
            ];
        }
    }

    leadsJson([
        'draw' => $draw,
        'recordsTotal' => $total,
        'recordsFiltered' => $filtered,
        'data' => $data
    ]);

} catch (Throwable $e) {

    error_log(
        'Aeronero Leads Error: ' . $e->getMessage()
    );

    leadsJson([
        'error' => 'Unable to load leads. Check the PHP error log.'
    ], 500);
}
