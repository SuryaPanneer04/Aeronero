<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];

// Get the ID from the URL parameter passed by the edit button
$id = $_GET['id'];

// Fetch the existing data for this specific grant
$stmt = $con->prepare("SELECT * FROM grants_master WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$res = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<div class="card card-primary">
    <div class="card-header">
        <h3 style="float: left;"><font size="5">EDIT GRANT DETAILS</font></h3>
       <button type="button" id="backGrantBtn" class="btn btn-dark" style="float: right;">
    BACK
</button>
    </div>

    <form method="POST" action="">
        <input type="hidden" name="userrole" id="userrole" value="<?php echo $userrole; ?>">
        <!-- Store the ID so it can be passed during the update submission -->
        <input type="hidden" name="id" id="edit_id" value="<?php echo $res['id']; ?>">
        
        <table class="table table-bordered">
            <tr>
                <td>Date</td>
                <td colspan="2"><input type="date" class="form-control" id="date" name="date" value="<?php echo $res['date']; ?>"></td>
            </tr>
            <tr>
                <td>Grant Name</td>
                <td colspan="2"><input type="text" class="form-control" id="grant_name" name="grant_name" value="<?php echo $res['grant_name']; ?>"></td>
            </tr>
            <tr>
                <td>Project Applied</td>
                <td colspan="2"><input type="text" class="form-control" id="project_applied" name="project_applied" value="<?php echo $res['project_applied']; ?>"></td>
            </tr>
            <tr>
                <td>Applied by</td>
                <td colspan="2"><input type="text" class="form-control" id="applied_by" name="applied_by" value="<?php echo $res['applied_by']; ?>"></td>
            </tr>
            <tr>
                <td>Amount</td>
                <td colspan="2"><input type="number" step="0.01" class="form-control" id="amount" name="amount" value="<?php echo $res['amount']; ?>"></td>
            </tr>
            <tr>
                <td>Deadline</td>
                <td colspan="2"><input type="date" class="form-control" id="deadline" name="deadline" value="<?php echo $res['deadline']; ?>"></td>
            </tr>
            <tr>
                <td>Result</td>
                <td colspan="2"><input type="text" class="form-control" id="result" name="result" value="<?php echo $res['result']; ?>"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td colspan="2">
                    <select class="form-control" name="status" id="status">
                        <option value="pending" <?php if($res['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                        <option value="processing" <?php if($res['status'] == 'processing') echo 'selected'; ?>>Processing</option>
                        <option value="completed" <?php if($res['status'] == 'completed') echo 'selected'; ?>>Completed</option>
                    </select>
                </td>
            </tr>
        </table>

        <input type="button" name="submit" value="Update" class="btn btn-primary btn-md" style="float:right;position: relative;left: -5px;" onclick="update_grant()">
        <br><br>
    </form>
</div>

<script>

$(document).on("click", "#backGrantBtn", function(e) {

    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/grants/grants_list.php",

        success: function(data) {
            $("#main_content").html(data);
        },

        error: function(xhr, status, error) {
            console.log("Status:", xhr.status);
            console.log("Error:", error);
            console.log("Response:", xhr.responseText);

            alert("Unable to load Grants List.");
        }
    });

});

</script>
<script>
    function update_grant() {
        var data = $('form').serialize();
        
        $.ajax({
            type: "POST",
            data: data,
            url: "qvision/BusinessProcess/grants/grant_update.php",
            success: function(response) {
                alert("Updated Successfully");
                
                // Try to load the list page
                $.ajax({
                    type: "POST",
                    url: "qvision/BusinessProcess/grants/grants_list.php", 
                    success: function(data) {
                        $("#main_content").html(data);
                    },
                    error: function(xhr, status, error) {
                        // If it fails, this will tell you why
                        alert("Failed to redirect! Error: " + xhr.status + " " + error + ". Please check if the URL path to grants_list.php is exactly correct.");
                    }
                });
            }
        });
    }
</script>