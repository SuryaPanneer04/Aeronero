<?php
require '../../../connect.php';
require '../../../user.php';

$id = $_REQUEST['id'] ?? '';

date_default_timezone_set('Asia/Kolkata');
$dateS = date('d-m-Y');

// Fetch timesheet and employee details.
$stmt = $con->prepare("
    SELECT a.*, b.*
    FROM time_sheet a
    LEFT JOIN staff_master b
        ON a.staff_id = b.candid_id
    WHERE a.id = :id
");

$stmt->execute([
    ':id' => $id
]);

$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch project names and project codes.
$project_map = [];

$proj_sql = $con->query("
    SELECT project_id, project_name, project_code
    FROM y_project_details
");

while ($p = $proj_sql->fetch(PDO::FETCH_ASSOC)) {

    $project_label = $p['project_name'];

    if (!empty($p['project_code'])) {
        $project_label .= ' (' . $p['project_code'] . ')';
    }

    $project_map[(string)$p['project_id']] = $project_label;
}

// Convert saved project value into project names.
// Supports JSON arrays, empty JSON arrays, and old single-project records.
function get_project_name($id, $project_map)
{
    if ($id === null || $id === '') {
        return '';
    }

    $selected_projects = json_decode((string)$id, true);

    // If the saved value is not a JSON array, treat it as an old single ID.
    if (!is_array($selected_projects)) {
        $selected_projects = [(string)$id];
    }

    $project_names = [];

    foreach ($selected_projects as $project_id) {

        $project_id = (string)$project_id;

        if ($project_id === 'Others') {
            $project_names[] = 'Others';
        } elseif (isset($project_map[$project_id])) {
            $project_names[] = $project_map[$project_id];
        } else {
            $project_names[] = 'Unknown Project';
        }
    }

    return implode(', ', $project_names);
}

// Safely display values in HTML.
function ts_view_escape($value)
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

if ($row) {

    $one = $row['one'] ?? '';
    $two = $row['two'] ?? '';
    $three = $row['three'] ?? '';
    $four = $row['four'] ?? '';
    $five = $row['five'] ?? '';
    $six = $row['six'] ?? '';
    $seven = $row['seven'] ?? '';
    $eight = $row['eight'] ?? '';
    $nine = $row['nine'] ?? '';
    $ten = $row['ten'] ?? '';
    $over_time = $row['over_time'] ?? '';

    $a_one = $row['a_one'] ?? '';
    $a_two = $row['a_two'] ?? '';
    $a_three = $row['a_three'] ?? '';
    $a_four = $row['a_four'] ?? '';
    $a_five = $row['a_five'] ?? '';
    $a_six = $row['a_six'] ?? '';
    $a_seven = $row['a_seven'] ?? '';
    $a_eight = $row['a_eight'] ?? '';
    $a_nine = $row['a_nine'] ?? '';
    $a_ten = $row['a_ten'] ?? '';
    $a_over_time = $row['a_over_time'] ?? '';

    $p_two = $row['p_two'] ?? '';
    $p_three = $row['p_three'] ?? '';
    $p_four = $row['p_four'] ?? '';
    $p_five = $row['p_five'] ?? '';
    $p_six = $row['p_six'] ?? '';
    $p_seven = $row['p_seven'] ?? '';
    $p_eight = $row['p_eight'] ?? '';
    $p_nine = $row['p_nine'] ?? '';
    $p_ten = $row['p_ten'] ?? '';
    $p_over_time = $row['p_over_time'] ?? '';

    $date = $row['date'] ?? '';
    $emp_name = $row['emp_name'] ?? '';

    $dateS = !empty($date)
        ? date('d-m-Y', strtotime($date))
        : '';

} else {

    $one = '';
    $two = '';
    $three = '';
    $four = '';
    $five = '';
    $six = '';
    $seven = '';
    $eight = '';
    $nine = '';
    $ten = '';
    $over_time = '';

    $a_one = '';
    $a_two = '';
    $a_three = '';
    $a_four = '';
    $a_five = '';
    $a_six = '';
    $a_seven = '';
    $a_eight = '';
    $a_nine = '';
    $a_ten = '';
    $a_over_time = '';

    $p_two = '';
    $p_three = '';
    $p_four = '';
    $p_five = '';
    $p_six = '';
    $p_seven = '';
    $p_eight = '';
    $p_nine = '';
    $p_ten = '';
    $p_over_time = '';

    $date = '';
    $emp_name = '';
    $dateS = '';
}

?>

<form role="form"
      name=""
      action="HRMS/Recruitment/project_management/time_sheet_submit.php"
      method="post"
      enctype="multipart/form-data">

    <div class="card card-primary shadow">

        <div class="card-header d-flex justify-content-between align-items-center">

            <div>
                <h3 class="card-title m-0 d-inline-block">
                    <font size="5">Hourly Time Sheet</font>
                </h3>

                <strong class="ml-3 text-light">
                    <?php echo ts_view_escape($dateS); ?>
                </strong>
            </div>

            <div class="d-flex align-items-center">

                <strong class="mr-2" style="font-size: 1.1rem; color: #fff;">
                    In Time:
                </strong>

                <input type="text"
                       id="one1"
                       class="form-control"
                       style="width: 140px; text-align: center; font-weight: bold;"
                       readonly="readonly"
                       value="<?php echo ts_view_escape($one); ?>">

                <a onclick="daily_mis_report()"
                   class="btn btn-danger btn-sm ml-3 text-white">
                    <i class="fa fa-arrow-left"></i> Back
                </a>

            </div>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered">

                    <tr>
                        <td colspan="3" class="text-center py-3">
                            <h5 class="mb-0 font-weight-bold">
                                <?php echo ts_view_escape($emp_name); ?>
                            </h5>
                        </td>
                    </tr>

                    <tr style="background-color: #f4f6f9;">
                        <th width="20%" class="text-center align-middle">
                            Time & Project
                        </th>
                        <th width="40%" class="text-center align-middle">
                            To-do List
                        </th>
                        <th width="40%" class="text-center align-middle">
                            Task Completed
                        </th>
                    </tr>

                    <tr>
                        <td class="text-center align-middle">
                            <strong>9.30-10.30</strong><br>
                            <span class="badge badge-info mt-1">
                                <?php echo ts_view_escape(get_project_name($p_two, $project_map)); ?>
                            </span>
                        </td>
                        <td>
                            <textarea id="two2" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($two); ?></textarea>
                        </td>
                        <td>
                            <textarea id="a_two2" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($a_two); ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center align-middle">
                            <strong>10.30-11.30</strong><br>
                            <span class="badge badge-info mt-1">
                                <?php echo ts_view_escape(get_project_name($p_three, $project_map)); ?>
                            </span>
                        </td>
                        <td>
                            <textarea id="three3" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($three); ?></textarea>
                        </td>
                        <td>
                            <textarea id="a_three3" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($a_three); ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center align-middle">
                            <strong>11.30-12.30</strong><br>
                            <span class="badge badge-info mt-1">
                                <?php echo ts_view_escape(get_project_name($p_four, $project_map)); ?>
                            </span>
                        </td>
                        <td>
                            <textarea id="four4" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($four); ?></textarea>
                        </td>
                        <td>
                            <textarea id="a_four4" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($a_four); ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center align-middle">
                            <strong>12.30-01.30</strong><br>
                            <span class="badge badge-info mt-1">
                                <?php echo ts_view_escape(get_project_name($p_five, $project_map)); ?>
                            </span>
                        </td>
                        <td>
                            <textarea id="five5" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($five); ?></textarea>
                        </td>
                        <td>
                            <textarea id="a_five5" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($a_five); ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center align-middle">
                            <strong>01.30-02.30</strong><br>
                            <span class="badge badge-info mt-1">
                                <?php echo ts_view_escape(get_project_name($p_six, $project_map)); ?>
                            </span>
                        </td>
                        <td>
                            <textarea id="six6" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($six); ?></textarea>
                        </td>
                        <td>
                            <textarea id="a_six6" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($a_six); ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center align-middle">
                            <strong>02.30-03.30</strong><br>
                            <span class="badge badge-info mt-1">
                                <?php echo ts_view_escape(get_project_name($p_seven, $project_map)); ?>
                            </span>
                        </td>
                        <td>
                            <textarea id="seven7" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($seven); ?></textarea>
                        </td>
                        <td>
                            <textarea id="a_seven7" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($a_seven); ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center align-middle">
                            <strong>03.30-04.30</strong><br>
                            <span class="badge badge-info mt-1">
                                <?php echo ts_view_escape(get_project_name($p_eight, $project_map)); ?>
                            </span>
                        </td>
                        <td>
                            <textarea id="eight8" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($eight); ?></textarea>
                        </td>
                        <td>
                            <textarea id="a_eight8" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($a_eight); ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center align-middle">
                            <strong>04.30-05.30</strong><br>
                            <span class="badge badge-info mt-1">
                                <?php echo ts_view_escape(get_project_name($p_nine, $project_map)); ?>
                            </span>
                        </td>
                        <td>
                            <textarea id="nine9" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($nine); ?></textarea>
                        </td>
                        <td>
                            <textarea id="a_nine9" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($a_nine); ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center align-middle">
                            <strong>05.30-06.30</strong><br>
                            <span class="badge badge-info mt-1">
                                <?php echo ts_view_escape(get_project_name($p_ten, $project_map)); ?>
                            </span>
                        </td>
                        <td>
                            <textarea id="ten10" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($ten); ?></textarea>
                        </td>
                        <td>
                            <textarea id="a_ten10" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($a_ten); ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center align-middle">
                            <strong>Over Time</strong><br>
                            <span class="badge badge-info mt-1">
                                <?php echo ts_view_escape(get_project_name($p_over_time, $project_map)); ?>
                            </span>
                        </td>
                        <td colspan="2">
                            <textarea id="over_time10" class="form-control" style="height:50px" readonly="readonly"><?php echo ts_view_escape($over_time); ?></textarea>
                        </td>
                    </tr>

                </table>
            </div>

        </div>
    </div>
</form>
