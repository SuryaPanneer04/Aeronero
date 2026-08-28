<?php
require '../../connect.php';
$target_dir = 'attendance_files/'; 
date_default_timezone_set("Asia/Kolkata");

if (isset($_POST['Upload'])) {
    if ((!empty($_FILES["file"])) && ($_FILES['file']['error'] == 0)) {

        $file_name = $_FILES['file']['name'];
        $tmp = explode('.', $file_name);
        $file_ext = end($tmp);
        $extensions = array("csv");

        if (in_array($file_ext, $extensions) === false) {
            echo "Extension not allowed, please choose a csv file.";
        } else {
            $file = $_FILES['file']['tmp_name'];
            $handle = fopen($file, "r");
            $heading = true;

            $inserted_count = 0;
            $already_existed = 0;
            $invalid_emp = 0;
            $db_errors = [];

            while (($filesop = fgetcsv($handle)) !== FALSE) {
                // Skip empty rows (Checking Column A)
                if(empty($filesop[0])) { continue; }

                if ($heading) {
                    $heading = false;
                    continue;
                }
                 
                // EXCEL COLUMN MAPPING (Based on your uploaded image)
                $emp_code   = trim($filesop[0]); // Column A: Employee_Code
                $log_date   = trim($filesop[2]); // Column C: In_Log_Date
                $punch_in   = trim($filesop[4]); // Column E: Punch_In
                $punch_out  = trim($filesop[5]); // Column F: Punch_Out
                $status_val = trim($filesop[7]); // Column H: Status

                // Check staff_master using correct emp_code
                $emp_name_sql = "SELECT id,emp_name,emp_code,prefix_code,dep_id,div_id,design_id FROM staff_master WHERE emp_code = '$emp_code' ";
                $emp_name_list = $con->query($emp_name_sql);
                $emp_name_data = $emp_name_list->fetch(PDO::FETCH_ASSOC);
                
                if($emp_name_data) {
                    $emp_name = $emp_name_data['emp_name'];
                    $emp_id = $emp_name_data['id']; // ID from staff_master
                    $emp_code=$emp_name_data['emp_code'];
                    $dep_id = $emp_name_data['dep_id'];
                    $div_id = $emp_name_data['div_id'];
                    $design_id = $emp_name_data['design_id'];
                } else {
                    $emp_name ="Nill";
                    $emp_id ="Nill";
                    $dep_id ="Nill";
                    $div_id ="Nill";
                    $design_id ="Nill";
                }
                
                $formatted_date = date('Y-m-d', strtotime($log_date));	
                
                $datecheck = $con->query("SELECT date FROM daily_attendance WHERE emp_code ='$emp_code' AND date ='$formatted_date'");
                $check_row = $datecheck->rowCount();
                
                if ($check_row == 0) {
                    $nameOfDay = date('l', strtotime($formatted_date));
                    
                    // Working Hours Calculation (Using Corrected Columns)					
                    if ($punch_in == '' && $punch_out == '') {
                        $workingHours = 0;
                    } else if ($punch_out == '') {
                        $workingHours = 9;
                    } else if ($punch_in == '') {
                        $workingHours = 9;
                    } else if($punch_in == '09:00:00' && $punch_out == '18:00:00') {
                        $workingHours = 9;
                    } else {
                        $in = strtotime($punch_in);
                        $out = strtotime($punch_out);
                        $workingHours = ($out - $in) / 3600;
                    }

                    $month = date('m', strtotime($formatted_date)); 
                    $year  = date('Y', strtotime($formatted_date)); 

                    // Working days count (Using Corrected Status Column)
                    if ($status_val == 0) {
                        $worked_days = 0; 
                    } elseif (in_array($status_val, [1, 2, 3, 4])) {
                        $worked_days = 1; 
                    } elseif (in_array($status_val, [5, 6])) {
                        $worked_days = 0.5; 
                    } else {
                        $worked_days = 0;
                    }

                    // Strict Insert Logic
                    if ($emp_id != "Nill") {
                        $candid = $emp_id;
                        
                        // 1. daily_attendance
                        $insert_daily = $con->query("INSERT INTO daily_attendance(candid_id, emp_code, emp_name, date, status, month, year, halfday) VALUES ('$candid', '$emp_code', '$emp_name', '$formatted_date', '$status_val', '$month', '$year', 0)");
                        if(!$insert_daily) { $db_errors[] = implode(",", $con->errorInfo()); }

                        // 2. bb_attendance (For UI Table)
                        $insert_bb = $con->query("INSERT INTO bb_attendance (emp_code, emp_name, dep_id, div_id, design_id, in_log_date, log_day, out_log_date, punch_in_time, punch_out_time, work_hours, status, total_days, working_days) 
                        VALUES ('$emp_id', '$emp_name', '$dep_id', '$div_id', '$design_id', '$formatted_date', '$nameOfDay', '$formatted_date', '$punch_in', '$punch_out', '$workingHours', '$status_val', '1', '$worked_days')");
                        if(!$insert_bb) { $db_errors[] = implode(",", $con->errorInfo()); }

                        if($insert_daily || $insert_bb) {
                            $inserted_count++;
                        }
                    } else {
                        $invalid_emp++; 
                    }
                } else {
                    $already_existed++;
                }
            } // End of While Loop

            // Upload Attedance Files
            $attendanceName = basename($_FILES["file"]["name"]);
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
            
            if(isset($month) && isset($year)){
                $findAttFile = $con->query("select id from attendance_files where month = '$month' && year = '$year' ");
                if($findAttFile->rowCount() == 0){
                    $max_id_query = $con->query("SELECT MAX(id) as max_id FROM attendance_files");
                    $max_id_data = $max_id_query->fetch(PDO::FETCH_ASSOC);
                    $new_id = ($max_id_data['max_id'] == null) ? 1 : $max_id_data['max_id'] + 1;

                    $con->query("INSERT INTO attendance_files (`id`, `month`, `year`, `file_name`) VALUES('$new_id', '$month', '$year', '$attendanceName')");
                } else {
                    $findAtt = $findAttFile->fetch();
                    $id = $findAtt['id'];
                    $con->query("UPDATE attendance_files SET file_name = '$attendanceName' WHERE id = '$id'");
                }
            }

            // Real validation response
            if (!empty($db_errors)) {
                echo "DB Error: " . implode(" | ", $db_errors);
            } elseif ($inserted_count > 0) {
            echo "SUCCESS|" . $month . "|" . $year; 
            } elseif ($already_existed > 0) {
                echo "Already Existed.";
            } elseif ($invalid_emp > 0) {
                echo "Error: Employee Code not found in staff_master table.";
            } else {
                echo "Error: Invalid or Empty Data.";
            }
        }
    } else {
        echo "Error: Please choose a valid file.";
    }
}
?>