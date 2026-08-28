<?php
require '../../../connect.php';
include("../../../user.php");

// Fix: Only start session if not already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userrole = $_SESSION['userrole'] ?? ''; // Prevent Undefined Index Error

// Fetch the total number of clients
$sqlq = $con->query("SELECT COUNT(*) AS total_clients FROM new_client_master");
$row = $sqlq->fetch(PDO::FETCH_ASSOC);
$couq = $row['total_clients'] ?? 0;

if ($couq == 0) {
    $client_code = 'CL0001';
} else {
    // Get the highest ID from new_client_master
    $stmta = $con->prepare("SELECT MAX(ID) AS max_id FROM new_client_master"); 
    $stmta->execute(); 
    $rowa = $stmta->fetch(PDO::FETCH_ASSOC);
    $maxi_id = $rowa['max_id'] ?? 0; // Default to 0 if null

    if ($maxi_id > 0) {
        $stmtc = $con->prepare("SELECT id, client_code FROM new_client_master WHERE id = ?");
        $stmtc->bindParam(1, $maxi_id, PDO::PARAM_INT);
        $stmtc->execute();
        $rowc = $stmtc->fetch(PDO::FETCH_ASSOC);

        if ($rowc) {
            $cus_codes = $rowc['client_code'] ?? '';

            if (!empty($cus_codes) && strlen($cus_codes) >= 6) {
                $find_fi = substr($cus_codes, 0, 2); // First 2 characters (CL)
                $find_si = substr($cus_codes, 2); // Remaining digits

                $final_clno = str_pad((int)$find_si + 1, 4, "0", STR_PAD_LEFT);
                $client_code = $find_fi . $final_clno;
            } else {
                $client_code = 'CL0001'; // Default
            }
        } else {
            $client_code = 'CL0001'; // Default if no valid data found
        }
    } else {
        $client_code = 'CL0001';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Details Form</title>
    <link rel="stylesheet" href="qvision/commonstyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
        .card-primary:not(.card-outline)>.card-header {
            background-color: #f1cc61 !important;
            color: black !important;
        }
        .btn-dark {
            background-color: #ed5d00 !important;
            border-color: #ed5d00 !important;
        }
    </style>
</head>
<body>

<div class="card card-primary">
    <div class="card-header">
        <center><h3 class="card-title"><b>CLIENT DETAILS FORM</b></h3></center>
        <a onclick="back_ctc()" style="float: right;" class="btn btn-danger">Back</a>
    </div>

    <form method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="userrole" id="userrole" value="<?php echo  htmlspecialchars($userrole); ?>">
        <table class="table table-bordered">

            <tr>
                <td>Department</td>
                <td colspan="4">
                    <select class="form-control" id="Department" name="Department">
                        <option value="">Choose Type</option>
                        <?php 
                        $stmt = $con->query("SELECT * FROM z_department_master");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['dept_name']; ?></option>
                        <?php } ?>
                    </select>
                </td>

                <td>Employee</td>
                <td colspan="2">
                    <select class="form-control" name="employee" id="employee" required>
					
					</select>


                      <!-- <select class="form-control" id="Department" name="Department">
                        <option value="">Choose Type</option>
                        <?php 
                        $stmt = $con->query("SELECT * FROM z_department_master");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['dept_name']; ?></option>
                        <?php } ?>
                    </select>
                     -->
                </td>
            </tr>

            <tr>
                <td>Client Code</td>
                <td colspan="4">
                    <input type="text" name="client_code" id="client_code" class="form-control" value="<?php echo htmlspecialchars($client_code); ?>" readonly>
                </td>

                <td>Client Org Name *</td>
                <td colspan="2"><input type="text" class="form-control" id="txt_org_name" name="txt_org_name" placeholder="Enter Client Name" required></td>
            </tr>

            <tr>
                <td>Client Org Type *</td>
                <td colspan="4">
                    <select name="client_type" class="form-control" id="client_type" required>
                        <option value="">Select type</option>
                        <option value="1">PVT</option>
                        <option value="2">LLP</option>
                        <option value="3">PL</option>
                        <option value="4">Proprietorship</option>
                        <option value="5">Partnership</option>
                        <option value="6">Government</option>
                        <option value="7">Education</option>
                    </select>
                </td>

                <td>Website</td>
                <td colspan="4"><input type="text" class="form-control" id="txt_website" name="txt_website" placeholder="Enter Website Name"></td>
            </tr>
        </table>

        <div style="text-align:left;">
            <input type="button" name="save" value="SAVE" onclick="client_insert()" class="btn btn-primary btn-md">
            <br/>
        </div>
    </form>
</div>

<script>
function back_ctc() {
    $.ajax({
        type: "POST",
        url: "qvision/masters/client_master/client_master.php",
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}

// Fetch employees based on selected department
$(document).ready(function() {
    $('#Department').on('change', function() {
        var department_id = this.value;
        $.ajax({
            url: "qvision/masters/client_master/find_emp.php",
            type: "POST",
            data: { department_id: department_id },
            cache: false,
            success: function(result) {
                $("#employee").html(result);
            }
        });
    });
});
/*
function client_insert() {
    var department_id  = document.getElementById("Department").value;
    var employee_id  = document.getElementById("employee").value;
    var org_name  = document.getElementById("txt_org_name").value;
    var org_type  = document.getElementById("client_type").value;
    var website   = document.getElementById("txt_website").value;
    var client_code  = document.getElementById("client_code").value;

    if (org_name === '' || org_type === '') {
        alert("Fill all required fields");
    } else {
        $.ajax({
            type: 'GET',
            data: {
                department_id: department_id,
                employee_id: employee_id,
                org_name: org_name,
                org_type: org_type,
                website: website,
                client_code: client_code
            },
            url: 'qvision/masters/client_master/client_submit.php',
            success: function(result) {
                if (result == '1') {
                    alert("Client Details Added Successfully");
                    client_master();
                } else {
                    alert("Something went wrong!");
                    client_master();
                }
            }
        });
    }
}*/


function client_insert() {
    var department_id  = document.getElementById("Department").value;
    var employee_id  = document.getElementById("employee").value;
    var org_name  = document.getElementById("txt_org_name").value;
    var org_type  = document.getElementById("client_type").value;
    var website   = document.getElementById("txt_website").value;
    var client_code  = document.getElementById("client_code").value;
    var createdby = '<?php echo $_SESSION['userid'] ?? 0; ?>';
    var created_on = '<?php echo date('Y-m-d'); ?>';
    

    if (org_name === '' || org_type === '') {
        alert("Fill all required fields");
    } else {
        $.ajax({
            type: 'GET',
            data: {
                department_id: department_id,
                employee_id: employee_id,
                org_name: org_name,
                org_type: org_type,
                website: website,
                client_code: client_code,
                createdby: createdby,
                created_on: created_on
            },
            url: 'qvision/masters/client_master/client_submit.php',
            success: function(result) {
                console.log("Server Response:", result); // Debugging Line

                if (result.trim() === '1') {
                    alert("Client Details Added Successfully");
                    client_master();
                } else {
                    alert("Something went wrong! Error: " + result);
                }
            },
            error: function(xhr, status, error) {
                alert("AJAX Error: " + error);
            }
        });
    }
}





</script>

</body>
</html>
