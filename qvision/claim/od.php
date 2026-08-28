<?php
// FORCE CPANEL TO SHOW ERRORS SO WE CAN FIX IT
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../connect.php';
include '../../user.php';

$userrole = $_SESSION['userrole'];

// Silver-bullet to catch the session ID regardless of how the cPanel login script sets it
if (isset($_SESSION['candidateid'])) {
    $candid_id = $_SESSION['candidateid'];
} elseif (isset($_SESSION['candidate_id'])) {
    $candid_id = $_SESSION['candidate_id'];
} else {
    $candid_id = '';
    echo "<h1>CRITICAL ERROR: Session is empty. You must log in again!</h1>";
}

?>
<head>
    <link rel="stylesheet" href="qvision/commonstyle.css">
</head>

<div class="card card-primary">
    <div class="card-header" style="background-color:#ff8b3d;">
        <h3 class="card-title"><font size="5">CLAIM REQUEST</font></h3>
        <a onclick="return add_od()" style="float: right; background-color: #ff8b3d;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i>ADD</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered display nowrap" id="example1" style="width:100%">
            <thead>
                <th>S.No</th>
                <th>Emp Code</th>
                <th>Emp Name</th>
                <th>Date </th>
                <th>Customer Name</th>
                <th>Location</th>
                <th>Purpose</th>
                <th>Status</th>
                <th>Action</th> 
                <th>View</th>
            </thead>
            <tbody>
<?php
try {
    if ($userrole == 'R016') {
        $holiday = $con->query("SELECT a.candidate_id as candidate_id,b.emp_code as emp_code,b.emp_name as emp_name,a.date as date,a.customer_name as customer_name,a.location as c_loc,a.purpose as purpose,a.id as mid,a.location as c_loc,a.status as status FROM claim_request a LEFT JOIN staff_master b on a.candidate_id=b.candid_id where a.status='2' or a.status=1");
        
        if (!$holiday) { die("<tr><td colspan='10'><b>Error in R016 query:</b> " . print_r($con->errorInfo(), true) . "</td></tr>"); }

        $cnt = 1;
        while ($holiday_masterr = $holiday->fetch(PDO::FETCH_ASSOC)) {
            $status = $holiday_masterr['status'];
            ?>
            <tr>
                <td><?php echo $cnt; ?></td>
                <td><?php echo $holiday_masterr['emp_code']; ?></td>
                <td><?php echo $holiday_masterr['emp_name']; ?></td>
                <td><?php echo $holiday_masterr['date']; ?></td>
                <td><?php echo $holiday_masterr['customer_name'];?></td>
                <td><?php echo $holiday_masterr['c_loc']; ?></td>
                <td><?php echo $holiday_masterr['purpose']; ?></td>
                <td>
                    <?php 
                    if($status == '1') { echo '<span style="color:red;text-align:center;"><b>Request Pending</b></span>'; }
                    elseif($status == '2') { echo '<span style="color:brown;text-align:center;"><b>Request Approved by HOD and Waiting for Purchase Approval</b></span>'; }
                    elseif($status == '3') { echo '<span style="color:green;text-align:center;"><b>Request Approved by HOD and Purchase Head</b></span>'; }
                    elseif($status == '4') { echo '<span style="color:green;text-align:center;"><b>Request Rejected</b></span>'; }
                    ?>
                </td>
                <td>
                    <?php if($holiday_masterr['candidate_id'] == 210) { ?>	
                        <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $holiday_masterr['mid']; ?>" onclick="od_edit(<?php echo $holiday_masterr['mid']; ?>)"><i class="fa fa-edit"></i> Edit</button>
                    <?php } else { ?>
                </td>
                <td>				
                        <button class="btn btn-success btn-sm view btn-flat" data-id="<?php echo $holiday_masterr['mid']; ?>" onclick="od_view(<?php echo $holiday_masterr['mid']; ?>)"><i class="fa fa-eye"></i> View</button>
                    <?php } ?>
                </td>
            </tr>
            <?php 
            $cnt++;
        }
    } else {
        $holiday = $con->query("SELECT * FROM `claim_request` where candidate_id='$candid_id' ORDER BY `id` DESC");
        
        if (!$holiday) { die("<tr><td colspan='10'><b>Error in Normal User query:</b> " . print_r($con->errorInfo(), true) . "</td></tr>"); }

        $cnt = 1;
        while ($holiday_masterr = $holiday->fetch(PDO::FETCH_ASSOC)) {
            $status = $holiday_masterr['status'];
            
            $getempdcoe = $con->query("SELECT * FROM `z_user_master` where candidate_id='$candid_id'");
            if (!$getempdcoe) { die("<tr><td colspan='10'><b>Error in z_user_master query:</b> " . print_r($con->errorInfo(), true) . "</td></tr>"); }
            $employiecode = $getempdcoe->fetch(PDO::FETCH_ASSOC);
            
            $showempcode = $con->query("SELECT * FROM `staff_master` where candid_id='$candid_id'");
            if (!$showempcode) { die("<tr><td colspan='10'><b>Error in staff_master query:</b> " . print_r($con->errorInfo(), true) . "</td></tr>"); }
            $showemmmpcode = $showempcode->fetch(PDO::FETCH_ASSOC);
            ?>
            <tr>
                <td><?php echo $cnt; ?></td>
                <td><?php echo isset($showemmmpcode['emp_code']) ? $showemmmpcode['emp_code'] : ''; ?></td>
                <td><?php echo isset($employiecode['full_name']) ? $employiecode['full_name'] : ''; ?></td>
                <td><?php echo $holiday_masterr['date']; ?></td>
                <td><?php echo $holiday_masterr['customer_name'];?></td>
                <td><?php echo $holiday_masterr['location']; ?></td>
                <td><?php echo $holiday_masterr['purpose']; ?></td>
                <td>
                    <?php 
                    if($status == '1') { echo '<span style="color:red;text-align:center;"><b>Request Pending</b></span>'; }
                    elseif($status == '2') { echo '<span style="color:green;text-align:center;"><b>Request Approved by Finance Department</b></span>'; }
                    elseif($status == '3') { echo '<span style="color:green;text-align:center;"><b>Request Approved by HOD and Finance Head</b></span>'; }
                    elseif($status == '4') { echo '<span style="color:red;text-align:center;"><b>Request Rejected</b></span>'; }
                    ?>
                </td>
                <td>
                    <?php if($status == 1) { ?>	
                        <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $holiday_masterr['id']; ?>" onclick="od_edit(<?php echo $holiday_masterr['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
                    <?php } ?>
                </td>
            </tr>
            <?php 
            $cnt++;
        }
    }  
} catch (Exception $e) {
    echo "<tr><td colspan='10'><h2>FATAL PHP ERROR: " . $e->getMessage() . "</h2></td></tr>";
}
?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#example1').DataTable({
        "scrollX": true
    });
});

function add_od() {
    $.ajax({
        type: "POST",
        url:  "qvision/claim/od_add.php",
        success: function (data) {
            $("#main_content").html(data);
        }
    });
}
function od_edit(v) {
    $.ajax({
        type: "POST",
        url: "qvision/claim/od_edit.php?id="+v,
        success: function (data) {
            $("#main_content").html(data);
        }
    });
}
function od_view(v) {
    $.ajax({
        type: "POST",
        url: "qvision/claim/od_view.php?id="+v,
        success: function (data) {
            $("#main_content").html(data);
        }
    });
}
</script>