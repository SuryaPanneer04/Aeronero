<?php
require '../../connect.php';
require '../../user.php';
$userid = $_SESSION['userid'];
$userrole = $_SESSION['userrole'];
$candidateid = $_SESSION['candidateid'];
?>
<head>
    <link rel="stylesheet" href="qvision/commonstyle.css">
</head>
<style>
.card-primary:not(.card-outline)>.card-header {
    background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header {
    color: black !important;
}
.btn-dark {
    background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
}
.card-primary:not(.card-outline)>.card-header a {
    color: black !important;
}
</style>
<div class="card card-info">
    <div class="card-header" style="background-color:#ff8b3d;">
        <center><h3 class="card-title"><b>Add Claim</b></h3></center>
        <a onclick="back_od()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
    </div>
    <form method="POST" id="fupForm" name="fupForm" action="">
        <table class="table table-bordered">
            <tr>
                <td>Employee Name</td>
                <?php
                $stmts = $con->prepare("SELECT user_id, full_name, candidate_id FROM z_user_master WHERE candidate_id='$candidateid'");
                $stmts->execute();
                $rows = $stmts->fetch();
                $emp_name = $rows['full_name'];
                $candid_id = $rows['candidate_id'];
                ?>
                <td><input type="text" name="Employee_name" value="<?php echo $emp_name; ?>" id="Employee_name" class="form-control" readonly></td>
                <td><input type="hidden" name="candidate_id" value="<?php echo $candid_id; ?>" id="candidate_id" class="form-control" readonly></td>
            </tr>
            <tr>
                <td>Date</td>
                <td colspan="5"><input type="date" class="form-control" id="date" name="date" max="" min=""></td>
            </tr>
            <tr>
                <td>Travel Type</td>
                <td>
                    <select name="travel" id="travel" onchange="travelstatus(this.value)" class="form-control">
                        <option value="">Select Travel Type</option>
                        <?php
                        $emp_sql = $con->query("SELECT * FROM travel_master");
                        while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <option value="<?php echo $emp_res['id']; ?>"><?php echo $emp_res['travel_type']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr id="dep1">
                <td>Kms</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="Enter Kms" id="kms" onChange="kms_cal(this.value)" name="kms"></td>
            </tr>
            <tr>
                <td>Customer Name</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="Enter Customer Name" id="Customer_name" name="Customer_name"></td>
            </tr>
            <tr>
                <td>Location</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="Enter Location" id="Location" name="Location"></td>
            </tr>
            <tr>
                <td>Purpose of Visit</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="Enter Purpose" id="Purpose" name="Purpose"></td>
            </tr>
            <tr>
                <td>Amount</td>
                <td colspan="5"><input type="text" class="form-control" placeholder="Enter Amount" id="amount" name="amount" readonly></td>
            </tr>
            <tr>
                <td>Attach File</td>
                <td colspan="5"><input type="file" class="form-control" id="attachfile_1" name="attachfile[]"></td>
            </tr>
            <tr>
                <td colspan="6"><center><input type="submit" name="submit" class="btn btn-success submitBtn" value="Save"></center></td>
            </tr>
        </table>
    </form>
    <br>
</div>
<script>

$(document).ready(function() {
    $("form[name='fupForm']").on("submit", function(ev) {
        ev.preventDefault();
        if (!validateDate()) {
            alert('Please select a date within the past 30 days and not in the future.');
            return;
        }
        var formData = new FormData(this);
        $.ajax({
            url: 'qvision/claim/insert_od.php',
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                alert('Claim Requested Successfully');
                back_od();
            }
        });
    });
});

function validateDate() {
    var selectedDate = new Date($('#date').val());
    var today = new Date();
    var minDate = new Date(today);
    minDate.setDate(today.getDate() - 30);

    if (selectedDate > today || selectedDate < minDate) {
        return false;
    }
    return true;
}

function back_od() {
    $.ajax({
        type: "POST",
        url: "qvision/claim/od.php",
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}

function travelstatus(value) {
    if (value == '1' || value == '4') {
        document.getElementById('dep1').style.visibility = "visible";
         document.getElementById('amount').setAttribute('readonly', 'readonly');
         alert  
    } else {
        document.getElementById('dep1').style.visibility = "collapse";
         document.getElementById('amount').removeAttribute('readonly');
    }
}



function kms_cal(b) {
    var typeoftravel = document.getElementById('travel').value;
    if (typeoftravel == 1) {
        var a = 2.5;
        var result = a * b;
        document.getElementById("amount").value = result;
    } else if (typeoftravel == 4) {
        var a = 7;
        var result = a * b;
        document.getElementById("amount").value = result;
    }
}

</script>
