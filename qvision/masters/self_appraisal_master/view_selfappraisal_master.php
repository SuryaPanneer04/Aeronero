<?php
require '../../../connect.php';
include("../../../user.php");
$user_candid = $_SESSION['candidateid'];
$id = $_REQUEST['id'];
$dept_id = $_REQUEST['dept'];
$stmt = $con->prepare("SELECT a.id as aid,b.dept_name FROM self_appraisal_master a LEFT JOIN z_department_master b ON a.dep_name=b.id  where a.id='$id'");

$stmt->execute();
$row = $stmt->fetch();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">

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
</head>

<body>
    <div class="card card-primary">

        <div class="card-header" style="background-color:#ff8b3d !important;">

            <h3 class="card-title">
                <font size="5">EDIT SELF APPRAISAL DETAILS</font>
            </h3>

            <a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
        </div>
        <div class="card-body" id="printableArea">
            <form role="form" method="post" enctype="multipart/type">

                <table class="table table-bordered">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id; ?>">

                    <tr>
                        <td>Department Name</td>
                        <td colspan="5">
                            <input type="text" class="form-control" id="department" name="department" value="<?php echo  $row['dept_name']; ?>" readonly>
                        </td>
                    </tr>

                    <table class="table table-bordered">
                        <h3>
                            <center>Appraisal Questions</center>
                        </h3>
                        <tbody>
                            <?php

                            $sql = $con->query("SELECT a.id as name_id,b.dept_name,a.question FROM self_appraisal_question a LEFT JOIN z_department_master b ON a.dep_name=b.id where a.self_appraisal_id ='$id'");

                            $cnt = 0;
                            while ($rows = $sql->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td><input type="text" class="form-control" id="question_1" name="question<?php echo $cnt; ?>" value="<?php echo  $rows['question']; ?>" readonly></td>
                                </tr>
                            <?php
                                $cnt++;
                            } ?>
                        </tbody>
                    </table>

                </table>
            </form>
        </div>
    </div>

    <script>
        function back() {
            self_appraisal_master();
        }
    </script>
</body>

</html>