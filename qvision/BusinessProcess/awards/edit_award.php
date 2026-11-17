<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];

$id = $_GET['id'];
$stmt = $con->prepare("SELECT * FROM awards_master WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$res = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<div class="card card-primary">
    <div class="card-header">
        <h3 style="float: left;"><font size="5">EDIT AWARD DETAILS</font></h3>
        <a onclick="back_award()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
    </div>

    <form method="POST" action="">
        <input type="hidden" name="userrole" id="userrole" value="<?php echo $userrole; ?>">
        <input type="hidden" name="id" id="edit_id" value="<?php echo $res['id']; ?>">
        
        <table class="table table-bordered">
            <tr>
                <td>Date</td>
                <td colspan="2"><input type="date" class="form-control" id="date" name="date" value="<?php echo $res['date']; ?>"></td>
            </tr>
            <tr>
                <td>Award Name</td>
                <td colspan="2"><input type="text" class="form-control" id="award_name" name="award_name" value="<?php echo $res['award_name']; ?>"></td>
            </tr>
            <tr>
                <td>Category</td>
                <td colspan="2"><input type="text" class="form-control" id="category" name="category" value="<?php echo $res['category']; ?>"></td>
            </tr>
            <tr>
                <td>Applied by</td>
                <td colspan="2"><input type="text" class="form-control" id="applied_by" name="applied_by" value="<?php echo $res['applied_by']; ?>"></td>
            </tr>
            <tr>
                <td>Deadline</td>
                <td colspan="2"><input type="date" class="form-control" id="deadline" name="deadline" value="<?php echo $res['deadline']; ?>"></td>
            </tr>
            <tr>
                <td>Result</td>
                <td colspan="2"><input type="text" class="form-control" id="result" name="result" value="<?php echo $res['result']; ?>"></td>
            </tr>
        </table>

        <input type="button" name="submit" value="Update" class="btn btn-primary btn-md" style="float:right;position: relative;left: -5px;" onclick="update_award()">
        <br><br>
    </form>
</div>

<script>
    function back_award() {
        $.ajax({
            type: "POST",
            url: "qvision/BusinessProcess/awards/awards_list.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        });
    }

    function update_award() {
        var data = $('form').serialize();
        $.ajax({
            type: "POST",
            data: data,
            url: "qvision/BusinessProcess/awards/award_update.php",
            success: function(response) {
                alert("Updated Successfully");
                $.ajax({
                    type: "POST",
                    url: "qvision/BusinessProcess/awards/awards_list.php",
                    success: function(listData) {
                        $("#main_content").html(listData);
                    }
                });
            }
        });
    }
</script>