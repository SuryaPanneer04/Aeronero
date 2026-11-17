<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (
    empty($_SESSION['userid']) ||
    empty($_SESSION['username']) ||
    empty($_POST['pro_id'])
) {
    echo "<script>
        alert('Session expired or Invalid Data. Please login again.');
        window.location.href='../../../index.php';
    </script>";
    exit;
}

require '../../../connect.php';
require '../../../user.php';

$user_id = $_SESSION['userid'];

if (isset($_POST['submit'])) {

    $id = $_POST['pro_id'];

    // Validate employee ID against the logged-in session when available.
    if (
        !empty($_SESSION['candidateid']) &&
        (string)$_SESSION['candidateid'] !== (string)$id
    ) {
        echo "<script>
            alert('Invalid employee details. Please login again.');
            window.location.href='../../../index.php';
        </script>";
        exit;
    }


    // To-do and completed task fields.
    $one = isset($_POST['one1']) ? $_POST['one1'] : '';

    $two = isset($_POST['two2']) ? $_POST['two2'] : '';
    $three = isset($_POST['three3']) ? $_POST['three3'] : '';
    $four = isset($_POST['four4']) ? $_POST['four4'] : '';
    $five = isset($_POST['five5']) ? $_POST['five5'] : '';
    $six = isset($_POST['six6']) ? $_POST['six6'] : '';
    $seven = isset($_POST['seven7']) ? $_POST['seven7'] : '';
    $eight = isset($_POST['eight8']) ? $_POST['eight8'] : '';
    $nine = isset($_POST['nine9']) ? $_POST['nine9'] : '';
    $ten = isset($_POST['ten10']) ? $_POST['ten10'] : '';

    $over_time = isset($_POST['over_time10'])
        ? $_POST['over_time10']
        : '';


    $a_one = isset($_POST['a_one1']) ? $_POST['a_one1'] : '';

    $a_two = isset($_POST['a_two2']) ? $_POST['a_two2'] : '';
    $a_three = isset($_POST['a_three3']) ? $_POST['a_three3'] : '';
    $a_four = isset($_POST['a_four4']) ? $_POST['a_four4'] : '';
    $a_five = isset($_POST['a_five5']) ? $_POST['a_five5'] : '';
    $a_six = isset($_POST['a_six6']) ? $_POST['a_six6'] : '';
    $a_seven = isset($_POST['a_seven7']) ? $_POST['a_seven7'] : '';
    $a_eight = isset($_POST['a_eight8']) ? $_POST['a_eight8'] : '';
    $a_nine = isset($_POST['a_nine9']) ? $_POST['a_nine9'] : '';
    $a_ten = isset($_POST['a_ten10']) ? $_POST['a_ten10'] : '';

    $a_over_time = isset($_POST['a_over_time10'])
        ? $_POST['a_over_time10']
        : '';


    // Multiple project selection - maximum 2 projects per time slot.
    $project_fields = [
        'p_two',
        'p_three',
        'p_four',
        'p_five',
        'p_six',
        'p_seven',
        'p_eight',
        'p_nine',
        'p_ten',
        'p_over_time'
    ];

    $project_data = [];


    // Fetch projects assigned to this employee.
    $assigned_stmt = $con->prepare("
        SELECT pd.project_id
        FROM y_project_employees pe
        JOIN y_project_details pd
            ON pe.project_id = pd.project_id
        WHERE pe.employee_id = ?
    ");

    $assigned_stmt->execute([$id]);

    $assigned_project_ids = array_map(
        'strval',
        $assigned_stmt->fetchAll(PDO::FETCH_COLUMN)
    );


    // Validate selected projects and convert them into JSON.
    foreach ($project_fields as $field) {

        $selected = $_POST[$field] ?? [];

        if (!is_array($selected)) {
            echo "<script>
                alert('Invalid project selection.');
                window.history.back();
            </script>";
            exit;
        }

        // Remove duplicate selections.
        $selected = array_values(
            array_unique(
                array_map('strval', $selected)
            )
        );

        // Maximum 2 projects per timeslot.
        if (count($selected) > 2) {
            echo "<script>
                alert('You can select a maximum of 2 projects per timeslot.');
                window.history.back();
            </script>";
            exit;
        }

        // Validate employee-assigned projects.
        foreach ($selected as $project_id) {
            if ($project_id === 'Others') {
                continue;
            }

            if (!in_array($project_id, $assigned_project_ids, true)) {
                echo "<script>
                    alert('Invalid project selected. Please refresh the page.');
                    window.history.back();
                </script>";
                exit;
            }
        }

        // Save empty selection as [].
        $project_data[$field] = json_encode(
            $selected,
            JSON_UNESCAPED_UNICODE
        );

    }


    $p_two = $project_data['p_two'];
    $p_three = $project_data['p_three'];
    $p_four = $project_data['p_four'];
    $p_five = $project_data['p_five'];
    $p_six = $project_data['p_six'];
    $p_seven = $project_data['p_seven'];
    $p_eight = $project_data['p_eight'];
    $p_nine = $project_data['p_nine'];
    $p_ten = $project_data['p_ten'];
    $p_over_time = $project_data['p_over_time'];


    date_default_timezone_set('Asia/Kolkata');

    $date = isset($_POST['sheet_date'])
        ? $_POST['sheet_date']
        : date('Y-m-d');


    // Check whether timesheet already exists.
    $stmt = $con->prepare("
        SELECT COUNT(*) AS count
        FROM time_sheet
        WHERE staff_id = ?
          AND `date` = ?
    ");

    $stmt->execute([$id, $date]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $count = (int)$row['count'];

    $success = false;


    if ($count == 0) {

        // INSERT new timesheet.
        try {

            $insert_data = [

                'staff_id' => $id,
                'date' => $date,

                'one' => $one,
                'two' => $two,
                'three' => $three,
                'four' => $four,
                'five' => $five,
                'six' => $six,
                'seven' => $seven,
                'eight' => $eight,
                'nine' => $nine,
                'ten' => $ten,
                'over_time' => $over_time,

                'a_one' => $a_one,
                'a_two' => $a_two,
                'a_three' => $a_three,
                'a_four' => $a_four,
                'a_five' => $a_five,
                'a_six' => $a_six,
                'a_seven' => $a_seven,
                'a_eight' => $a_eight,
                'a_nine' => $a_nine,
                'a_ten' => $a_ten,
                'a_over_time' => $a_over_time,

                'p_two' => $p_two,
                'p_three' => $p_three,
                'p_four' => $p_four,
                'p_five' => $p_five,
                'p_six' => $p_six,
                'p_seven' => $p_seven,
                'p_eight' => $p_eight,
                'p_nine' => $p_nine,
                'p_ten' => $p_ten,
                'p_over_time' => $p_over_time

            ];


            $columns = array_keys($insert_data);

            $column_sql = implode(
                ', ',
                array_map(
                    function ($column) {
                        return "`$column`";
                    },
                    $columns
                )
            );

            $placeholder_sql = implode(
                ', ',
                array_map(
                    function ($column) {
                        return ':' . $column;
                    },
                    $columns
                )
            );


            $insert_query = "
                INSERT INTO time_sheet
                (
                    $column_sql,
                    created_on
                )
                VALUES
                (
                    $placeholder_sql,
                    NOW()
                )
            ";


            $insert_stmt = $con->prepare($insert_query);

            $insert_params = [];

            foreach ($insert_data as $column => $value) {
                $insert_params[':' . $column] = $value;
            }

            $insert_sql = $insert_stmt->execute($insert_params);

            if ($insert_sql) {
                $success = true;
            } else {

                echo "<script>
                    alert('Insert Error: Unable to save timesheet.');
                    window.history.back();
                </script>";

                exit;
            }


        } catch (PDOException $e) {

            error_log('Timesheet Insert Error: ' . $e->getMessage());

            echo "<script>
                alert('Insert Error: Please check the database details.');
                window.history.back();
            </script>";

            exit;
        }


    } else {

        // UPDATE existing timesheet.
        try {

            $update_data = [

                'one' => $one,
                'two' => $two,
                'three' => $three,
                'four' => $four,
                'five' => $five,
                'six' => $six,
                'seven' => $seven,
                'eight' => $eight,
                'nine' => $nine,
                'ten' => $ten,
                'over_time' => $over_time,

                'a_one' => $a_one,
                'a_two' => $a_two,
                'a_three' => $a_three,
                'a_four' => $a_four,
                'a_five' => $a_five,
                'a_six' => $a_six,
                'a_seven' => $a_seven,
                'a_eight' => $a_eight,
                'a_nine' => $a_nine,
                'a_ten' => $a_ten,
                'a_over_time' => $a_over_time,

                'p_two' => $p_two,
                'p_three' => $p_three,
                'p_four' => $p_four,
                'p_five' => $p_five,
                'p_six' => $p_six,
                'p_seven' => $p_seven,
                'p_eight' => $p_eight,
                'p_nine' => $p_nine,
                'p_ten' => $p_ten,
                'p_over_time' => $p_over_time

            ];


            $set_parts = [];

            foreach ($update_data as $column => $value) {
                $set_parts[] = "`$column` = :$column";
            }


            $update_query = "
                UPDATE time_sheet
                SET
                    " . implode(', ', $set_parts) . ",
                    modified_on = NOW()
                WHERE staff_id = :staff_id
                  AND `date` = :sheet_date
            ";


            $update_stmt = $con->prepare($update_query);

            $update_params = [];

            foreach ($update_data as $column => $value) {
                $update_params[':' . $column] = $value;
            }

            $update_params[':staff_id'] = $id;
            $update_params[':sheet_date'] = $date;


            $update_sql = $update_stmt->execute($update_params);

            if ($update_sql) {
                $success = true;
            } else {

                echo "<script>
                    alert('Update Error: Unable to update timesheet.');
                    window.history.back();
                </script>";

                exit;
            }


        } catch (PDOException $e) {

            error_log('Timesheet Update Error: ' . $e->getMessage());

            echo "<script>
                alert('Update Error: Please check the database details.');
                window.history.back();
            </script>";

            exit;
        }

    }


    if ($success) {

        echo "<script>
            alert('Time Sheet Updated Successfully');
            window.location.href='../../../index.php';
        </script>";

        exit;

    } else {

        header("location:../../../index.php");
        exit;

    }

}

?>
