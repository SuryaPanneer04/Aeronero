<?php
require '../../../connect.php';
require '../../../user.php';

$userrole = $_SESSION['userrole'];
$candidateid = $_SESSION['candidateid'];

$one = ''; $two = ''; $three = ''; $four = ''; $five = ''; $six = '';
$seven = ''; $eight = ''; $nine = ''; $ten = ''; $over_time = '';

$a_one = ''; $a_two = ''; $a_three = ''; $a_four = ''; $a_five = ''; $a_six = '';
$a_seven = ''; $a_eight = ''; $a_nine = ''; $a_ten = ''; $a_over_time = '';

$p_two = ''; $p_three = ''; $p_four = ''; $p_five = ''; $p_six = '';
$p_seven = ''; $p_eight = ''; $p_nine = ''; $p_ten = ''; $p_over_time = '';

$user_id = $_SESSION['userid'];

date_default_timezone_set('Asia/Kolkata');

$date = isset($_REQUEST['date']) ? $_REQUEST['date'] : date('Y-m-d');

function ts_escape($value)
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

// Fetch existing timesheet.
$stmt = $con->prepare("
    SELECT *
    FROM time_sheet
    WHERE staff_id = :staff_id
      AND `date` = :sheet_date
");

$stmt->execute([
    ':staff_id' => $candidateid,
    ':sheet_date' => $date
]);

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$time_sheet_project_id = '';

if ($row) {

    $one = $row['one'];
    $two = $row['two'];
    $three = $row['three'];
    $four = $row['four'];
    $five = $row['five'];
    $six = $row['six'];
    $seven = $row['seven'];
    $eight = $row['eight'];
    $nine = $row['nine'];
    $ten = $row['ten'];
    $over_time = $row['over_time'];

    $a_one = $row['a_one'];
    $a_two = $row['a_two'];
    $a_three = $row['a_three'];
    $a_four = $row['a_four'];
    $a_five = $row['a_five'];
    $a_six = $row['a_six'];
    $a_seven = $row['a_seven'];
    $a_eight = $row['a_eight'];
    $a_nine = $row['a_nine'];
    $a_ten = $row['a_ten'];
    $a_over_time = $row['a_over_time'];

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

    $time_sheet_project_id = isset($row['project_id'])
        ? $row['project_id']
        : '';
}

// Fetch projects assigned to this employee.
$assigned_projects = $con->prepare("
    SELECT pd.project_id, pd.project_name, pd.project_code
    FROM y_project_employees pe
    JOIN y_project_details pd
        ON pe.project_id = pd.project_id
    WHERE pe.employee_id = ?
");

$assigned_projects->execute([$candidateid]);

$project_list = $assigned_projects->fetchAll(PDO::FETCH_ASSOC);

$has_projects = count($project_list) > 0;


// Convert saved project values into an array.
function get_selected_project_ids($selected_val)
{
    $selected_projects = json_decode((string)$selected_val, true);

    // Support old single-project records.
    if (!is_array($selected_projects)) {

        $selected_projects = (
            $selected_val !== '' && $selected_val !== null
        )
            ? [(string)$selected_val]
            : [];
    }

    return array_map('strval', $selected_projects);
}


// Display checkbox project selection.
function get_project_dropdown($name, $selected_val, $project_list, $has_projects)
{
    if (!$has_projects) {
        return '';
    }

    $selected_projects = get_selected_project_ids($selected_val);

    $html = '
    <div class="project-picker" data-field="' . ts_escape($name) . '">
        <div class="project-checkbox-list">';

    foreach ($project_list as $p) {

        $project_id = (string)$p['project_id'];

        $project_label = $p['project_name'];

        if (!empty($p['project_code'])) {
            $project_label .= ' (' . $p['project_code'] . ')';
        }

        $checked = in_array($project_id, $selected_projects, true)
            ? 'checked'
            : '';

        $html .= '
            <label class="project-option">
                <input type="checkbox"
                       class="project-checkbox"
                       name="' . ts_escape($name) . '[]"
                       value="' . ts_escape($project_id) . '"
                       data-label="' . ts_escape($project_label) . '"
                       ' . $checked . '>

                <span>' . ts_escape($project_label) . '</span>
            </label>';
    }

    $checked_other = in_array('Others', $selected_projects, true)
        ? 'checked'
        : '';

    $html .= '
            <label class="project-option">
                <input type="checkbox"
                       class="project-checkbox"
                       name="' . ts_escape($name) . '[]"
                       value="Others"
                       data-label="Others"
                       ' . $checked_other . '>

                <span>Others</span>
            </label>
        </div>

        <small class="text-muted">
            Select maximum 2 projects
        </small>
    </div>';

    return $html;
}


// Display selected project names as highlighted labels.
function get_project_badges($name, $selected_val, $project_list)
{
    $selected_projects = get_selected_project_ids($selected_val);

    $html = '
    <div class="selected-projects"
         data-badge-field="' . ts_escape($name) . '">';

    foreach ($selected_projects as $selected_id) {

        $project_label = $selected_id;

        foreach ($project_list as $p) {

            if ((string)$p['project_id'] === (string)$selected_id) {

                $project_label = $p['project_name'];

                if (!empty($p['project_code'])) {
                    $project_label .= ' (' . $p['project_code'] . ')';
                }

                break;
            }
        }

        $html .= '
            <span class="project-badge">'
                . ts_escape($project_label) .
            '</span>';
    }

    $html .= '</div>';

    return $html;
}

?>

<style>
/* Keep the timesheet columns and input boxes consistently aligned. */
.timesheet-table {
    width: 100%;
    table-layout: fixed;
    margin-bottom: 0;
}

.timesheet-table th,
.timesheet-table td {
    vertical-align: top;
    padding: 12px;
    overflow-wrap: anywhere;
}

.timesheet-table th {
    vertical-align: middle;
}

.timesheet-table td:first-child {
    vertical-align: middle;
}

.project-picker {
    width: 100%;
    box-sizing: border-box;
    margin-top: 10px;
    padding: 9px;
    border: 1px solid #ced4da;
    border-radius: 6px;
    background: #fff;
    text-align: left;
}

.project-checkbox-list {
    max-height: 125px;
    overflow-y: auto;
}

.project-option {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    padding: 7px;
    margin: 0 0 4px;
    cursor: pointer;
    font-size: 12px;
    line-height: 1.4;
    border-radius: 4px;
    overflow-wrap: anywhere;
}

.project-option:last-child {
    margin-bottom: 0;
}

.project-option input {
    flex: 0 0 auto;
    margin: 2px 0 0;
}

.project-option:has(input:checked) {
    background: #e8f2ff;
    color: #0756a5;
    font-weight: 600;
}

.project-picker small {
    display: block;
    margin-top: 8px;
    font-size: 11px;
}

.task-textarea {
    display: block;
    width: 100%;
    min-width: 0;
    min-height: 110px;
    box-sizing: border-box;
    resize: vertical;
    line-height: 1.5;
}

@media (max-width: 768px) {
    .timesheet-table {
        min-width: 720px;
    }

    .timesheet-table th,
    .timesheet-table td {
        padding: 8px;
    }
}
</style>


<form role="form"
      id="time_sheet_form"
      action="qvision/Recruitment/project_management/time_sheet_submit.php"
      method="post">

    <div class="card card-primary shadow">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="card-title m-0">
                <font size="5">
                    Hourly Time Sheet For

                    <input type="date"
                           class="form-control"
                           style="display:inline-block; width:auto; font-size:1rem; margin-left:10px;"
                           value="<?php echo ts_escape($date); ?>"
                           min="<?php echo date('Y-m-d'); ?>"
                           onchange="reload_timesheet(this.value)">
                </font>
            </h3>

            <input type="hidden"
                   name="sheet_date"
                   value="<?php echo ts_escape($date); ?>">

            <div class="d-flex align-items-center ml-auto">

                <strong class="mr-2"
                        style="font-size:1.1rem; color:#fff;">
                    In Time:
                </strong>

                <input type="text"
                       id="one1"
                       name="one1"
                       class="form-control"
                       style="width:140px; text-align:center; font-weight:bold;"
                       placeholder="e.g. 09:30 AM"
                       value="<?php echo ts_escape($one); ?>">

            </div>

        </div>


        <div class="card-body">

            <table class="table table-bordered timesheet-table">

                <tr>
                    <td colspan="3" class="text-center py-3">

                        <img src="qvision/images/logo123.jpg"
                             alt="logo"
                             style="width:80px; height:auto; margin-bottom:10px;">

                        <br>

                        <h5 class="mb-0 font-weight-bold">
                            Aeronero Solutions Private Limited
                        </h5>

                    </td>
                </tr>


                <tr style="background-color:#f4f6f9;">

                    <th width="<?php echo $has_projects ? '20%' : '15%'; ?>"
                        class="text-center align-middle">

                        <?php echo $has_projects ? 'Time & Project' : 'Time'; ?>

                    </th>

                    <th width="<?php echo $has_projects ? '40%' : '42.5%'; ?>"
                        class="text-center align-middle">
                        To-do List
                    </th>

                    <th width="<?php echo $has_projects ? '40%' : '42.5%'; ?>"
                        class="text-center align-middle">
                        Task Completed
                    </th>

                </tr>


                <tr>

                    <td class="align-middle text-center">

                        <strong>9.30-10.30</strong>

                        <?php
                        echo get_project_dropdown(
                            'p_two',
                            $p_two,
                            $project_list,
                            $has_projects
                        );
                        ?>

                    </td>

                    <td>

                        <textarea id="two2"
                                  name="two2"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($two);
                        ?></textarea>

                    </td>

                    <td>
                        <textarea id="a_two2"
                                  name="a_two2"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($a_two);
                        ?></textarea>
                    </td>

                </tr>


                <tr>

                    <td class="align-middle text-center">

                        <strong>10.30-11.30</strong>

                        <?php
                        echo get_project_dropdown(
                            'p_three',
                            $p_three,
                            $project_list,
                            $has_projects
                        );
                        ?>

                    </td>

                    <td>

                        <textarea id="three3"
                                  name="three3"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($three);
                        ?></textarea>

                    </td>

                    <td>
                        <textarea id="a_three3"
                                  name="a_three3"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($a_three);
                        ?></textarea>
                    </td>

                </tr>


                <tr>

                    <td class="align-middle text-center">

                        <strong>11.30-12.30</strong>

                        <?php
                        echo get_project_dropdown(
                            'p_four',
                            $p_four,
                            $project_list,
                            $has_projects
                        );
                        ?>

                    </td>

                    <td>

                        <textarea id="four4"
                                  name="four4"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($four);
                        ?></textarea>

                    </td>

                    <td>
                        <textarea id="a_four4"
                                  name="a_four4"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($a_four);
                        ?></textarea>
                    </td>

                </tr>


                <tr>

                    <td class="align-middle text-center">

                        <strong>12.30-01.30</strong>

                        <?php
                        echo get_project_dropdown(
                            'p_five',
                            $p_five,
                            $project_list,
                            $has_projects
                        );
                        ?>

                    </td>

                    <td>

                        <textarea id="five5"
                                  name="five5"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($five);
                        ?></textarea>

                    </td>

                    <td>
                        <textarea id="a_five5"
                                  name="a_five5"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($a_five);
                        ?></textarea>
                    </td>

                </tr>


                <tr>

                    <td class="align-middle text-center">

                        <strong>01.30-02.30</strong>

                        <?php
                        echo get_project_dropdown(
                            'p_six',
                            $p_six,
                            $project_list,
                            $has_projects
                        );
                        ?>

                    </td>

                    <td>

                        <textarea id="six6"
                                  name="six6"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($six);
                        ?></textarea>

                    </td>

                    <td>
                        <textarea id="a_six6"
                                  name="a_six6"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($a_six);
                        ?></textarea>
                    </td>

                </tr>


                <tr>

                    <td class="align-middle text-center">

                        <strong>02.30-03.30</strong>

                        <?php
                        echo get_project_dropdown(
                            'p_seven',
                            $p_seven,
                            $project_list,
                            $has_projects
                        );
                        ?>

                    </td>

                    <td>

                        <textarea id="seven7"
                                  name="seven7"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($seven);
                        ?></textarea>

                    </td>

                    <td>
                        <textarea id="a_seven7"
                                  name="a_seven7"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($a_seven);
                        ?></textarea>
                    </td>

                </tr>


                <tr>

                    <td class="align-middle text-center">

                        <strong>03.30-04.30</strong>

                        <?php
                        echo get_project_dropdown(
                            'p_eight',
                            $p_eight,
                            $project_list,
                            $has_projects
                        );
                        ?>

                    </td>

                    <td>

                        <textarea id="eight8"
                                  name="eight8"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($eight);
                        ?></textarea>

                    </td>

                    <td>
                        <textarea id="a_eight8"
                                  name="a_eight8"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($a_eight);
                        ?></textarea>
                    </td>

                </tr>


                <tr>

                    <td class="align-middle text-center">

                        <strong>04.30-05.30</strong>

                        <?php
                        echo get_project_dropdown(
                            'p_nine',
                            $p_nine,
                            $project_list,
                            $has_projects
                        );
                        ?>

                    </td>

                    <td>

                        <textarea id="nine9"
                                  name="nine9"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($nine);
                        ?></textarea>

                    </td>

                    <td>
                        <textarea id="a_nine9"
                                  name="a_nine9"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($a_nine);
                        ?></textarea>
                    </td>

                </tr>


                <tr>

                    <td class="align-middle text-center">

                        <strong>05.30-06.30</strong>

                        <?php
                        echo get_project_dropdown(
                            'p_ten',
                            $p_ten,
                            $project_list,
                            $has_projects
                        );
                        ?>

                    </td>

                    <td>

                        <textarea id="ten10"
                                  name="ten10"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($ten);
                        ?></textarea>

                    </td>

                    <td>
                        <textarea id="a_ten10"
                                  name="a_ten10"
                                  class="form-control task-textarea"><?php
                            echo ts_escape($a_ten);
                        ?></textarea>
                    </td>

                </tr>


                <tr>

                    <td class="align-middle text-center">

                        <strong>Over Time</strong>

                        <?php
                        echo get_project_dropdown(
                            'p_over_time',
                            $p_over_time,
                            $project_list,
                            $has_projects
                        );
                        ?>

                    </td>

                    <td colspan="2">

                        <textarea id="over_time10"
                                  name="over_time10"
                                  class="form-control task-textarea"
                                  placeholder="Enter Actual Over Time Task..."><?php
                            echo ts_escape($over_time);
                        ?></textarea>

                    </td>

                </tr>

            </table>


            <input type="hidden"
                   id="pro_id"
                   name="pro_id"
                   value="<?php echo ts_escape($candidateid); ?>">

            <input type="submit"
                   name="submit"
                   class="btn btn-primary btn-md"
                   style="float:right;"
                   value="Submit">

        </div>

    </div>

</form>


<script>

$(document).ready(function () {

    // Project checkbox selection and highlighted project names.
    $('.project-picker').each(function () {

        var picker = $(this);

        function updateBadges() {

            var field = picker.data('field');

            var badges = $('[data-badge-field="' + field + '"]');

            badges.empty();

            picker.find('.project-checkbox:checked').each(function () {

                var label = $(this).data('label');

                badges.append(
                    $('<span>', {
                        class: 'project-badge',
                        text: label
                    })
                );

            });
        }


        picker.find('.project-checkbox').on('change', function () {

            var checked = picker.find('.project-checkbox:checked');

            if (checked.length > 2) {

                alert('You can select a maximum of 2 projects.');

                $(this).prop('checked', false);
            }

            updateBadges();

        });

        updateBadges();

    });


    // Confirm before submitting.
    $('#time_sheet_form').on('submit', function () {

        return confirm('Are you sure you want to submit this timesheet?');

    });

});


// Reload timesheet when date changes.
function reload_timesheet(d) {

    $.ajax({

        type: "POST",

        url: "qvision/Recruitment/project_management/time_sheet.php",

        data: {
            date: d
        },

        success: function(data) {

            $("#main_content").html(data);

        },

        error: function() {

            alert('Unable to load timesheet. Please try again.');

        }

    });

}

</script>
