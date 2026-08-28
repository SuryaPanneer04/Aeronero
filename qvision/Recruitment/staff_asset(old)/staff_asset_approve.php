<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = isset($_SESSION['userrole']) ? $_SESSION['userrole'] : '';
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

// 1. Fetching Main Request & Staff Name
$stmt = $con->query("SELECT s.*, sm.emp_name as master_name 
                     FROM staff_access_request s 
                     LEFT JOIN staff_master sm ON s.staff_id = sm.id 
                     WHERE s.id = '$id'");

$row = ($stmt && $stmt->rowCount() > 0) ? $stmt->fetch(PDO::FETCH_ASSOC) : array();

$sid = isset($row['staff_id']) ? $row['staff_id'] : '';
$staff_name = !empty($row['master_name']) ? $row['master_name'] : (isset($row['emp_name']) ? $row['emp_name'] : '');
$access = isset($row['asset_master_id']) ? $row['asset_master_id'] : '';

// 2. ✅ EXACT MAIL ID FROM STAFF_ASSET_LIST TABLE (As per your DB screenshot)
$mail_stmt = $con->query("SELECT mail_id, cug FROM staff_asset_list WHERE asset_request_id = '$id' AND mail_id IS NOT NULL AND mail_id != '' LIMIT 1");
$mail_row = ($mail_stmt && $mail_stmt->rowCount() > 0) ? $mail_stmt->fetch(PDO::FETCH_ASSOC) : array();
$mail_id = !empty($mail_row['mail_id']) ? $mail_row['mail_id'] : (isset($row['mail_id']) ? $row['mail_id'] : '');

$phone_no = !empty($mail_row['cug']) ? $mail_row['cug'] : (isset($row['phone_no']) ? $row['phone_no'] : '');
$cug_status = isset($row['cug_status']) ? $row['cug_status'] : (!empty($phone_no) ? 'Yes' : 'No');
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
    <div class="card-header">
        <i class="fa fa-table"></i> Allocated Assets
        <a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
    </div>
    <div class="card-body" id="printableArea">
        <form role="form" name="fupname" action="" method="post" enctype="multipart/type">
            <table class="table table-bordered">
                <tr>
                    <td>Employee Name:</td>
                    <td colspan="2">
                        <input type="hidden" name="sid" id="sid" value="<?php echo htmlspecialchars($sid); ?>">
                        <input type="hidden" name="reqid" id="reqid" value="<?php echo htmlspecialchars($id); ?>">
                        <input type="text" name="emp_name" id="emp_name" class="form-control" value="<?php echo htmlspecialchars($staff_name); ?>" readonly>
                    </td>
                </tr>

                <?php
                // 3. ✅ STRICT ASSET FILTER: Only fetching ACTIVE (status=1) assets belonging ONLY to THIS request ID!
                $isel = $con->query("SELECT DISTINCT m.id as id, m.name, COALESCE(a.Serial_no, '-') as Serial_no 
                                     FROM staff_asset_list s 
                                     LEFT JOIN assets_master m ON (s.asset_id = m.id OR s.asset_id = m.name) 
                                     LEFT JOIN assets_form_detail a ON s.asset_id = a.id 
                                     WHERE s.asset_request_id = '$id' AND s.status = 1 AND s.asset_id != 0");
                
                if (!$isel || $isel->rowCount() == 0) {
                    $clean_aids = rtrim(trim($access), ',');
                    if (!empty($clean_aids)) {
                        $isel = $con->query("SELECT id, name, '-' as Serial_no FROM assets_master WHERE id IN ($clean_aids)");
                    }
                }

                if ($isel && $isel->rowCount() > 0) {
                    while ($dfet = $isel->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>	 
                            <td style="font-weight:bold;">Asset Request:</td>
                            <td colspan="2"><?php echo htmlspecialchars($dfet['name']); ?></td>
                        </tr>
                    <?php		 
                    }
                }else {
                    ?>
                        <tr>
                            <td colspan="3" style="text-align:center; color:red;">No active assets found for this request.</td>
                        </tr>
                    <?php
                }
                ?>

                <?php 
                if ($cug_status == 'Yes' && !empty($phone_no)) {
                ?>
                <tr>
                    <td>CUG:</td>
                    <td colspan="2">
                        <input type="hidden" name="cug_sta" id="cug_sta" value="<?php echo htmlspecialchars($cug_status); ?>">
                        <input type="text" class="form-control" name="cug" id="cug" value="<?php echo htmlspecialchars($phone_no); ?>" readonly>
                    </td>
                </tr>
                <?php 
                }
                ?>

                <tr>
                    <td>Mail Id</td>
                    <td colspan="2"><input type="text" name="mail_id" id="mail_id" class="form-control" value="<?php echo htmlspecialchars($mail_id); ?>" readonly></td>
                </tr>
            </table>

            <input type="submit" name="submit" class="btn btn-primary btn-md" value="Approve" style="float:right;">
        </form>
    </div>
</div>

<script>
    function back() {
        staff_asset_approve();
    }

    $(document).ready(function() {  
        $("form[name='fupname']").on("submit", function(ev) {
            ev.preventDefault();
            var formData = new FormData(this);	  
            $.ajax({  
                url: 'qvision/Recruitment/staff_asset/staff_asset_approve_submit.php',
                method: "POST",  
                data: formData, 
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {  
                    alert("Entry Successful!");
                    staff_asset_approve();
                }  
            });  
        });  
    });
</script>