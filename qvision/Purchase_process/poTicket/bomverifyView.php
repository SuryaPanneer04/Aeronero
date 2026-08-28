<?php
require '../../../connect.php';
$taskid = $_REQUEST['id'];
$bomId = $_REQUEST['bomId'];
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">

    <style>
/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 400px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 25px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
   
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
 
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>

</head>

<div class="card card-primary ">
    <div id="salary_view" style="font-family:'Times New Roman', Times, serif;width: 500px; height: 400px; position: absolute; left: 305px; top: 118px;"> </div>
    <div class="card-header">
        <h3 class="card-title"><b> BOM Verification </b></h3>
        <a onclick="comp()" style="float: right;color: #fff" data-toggle="modal" class="btn btn-danger">BACK</a>
    </div>
    <!-- /.card-header -->

    <div class="card-body">

        <?php
        $sql = $con->query("Select a.*,e.full_name  from po_ticket a LEFT JOIN z_user_master e ON (a.employee = e.candidate_id) where a.id= '$taskid'");
        $sqls = $sql->fetch();
        $poId = $sqls['id'];
        ?>

        <form class="form-horizontal" method="POST" name="fupForm" enctype="multipart/form-data">
            <table class="table table-bordered">
                <tbody>
                    <input type="hidden" name="taskid" value="<?php echo $taskid; ?>">
                    <input type="hidden" name="csId" value="<?php echo $sqls['cost_sheet_id']; ?>">
                    <tr>
                        <th>SO Number </th>
                        <td>
                            <input class="form-control" value="<?php echo $sqls['so_number']; ?>" name="so_no" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>Cost Sheet No </th>
                        <td><input class="form-control" value="<?php echo $sqls['cost_sheet_no']; ?>" name="cost_sheet_no" readonly></td>
                    </tr>

                    <tr>
                        <th style="width: 15%;">Remark :</th>
                        <td colspan="4">
                            <textarea class="form-control" name="remark" style="height: 120px;" readonly> <?php echo $sqls['po_invoice']; ?> </textarea>
                        </td>
                    </tr>

                    <tr>
                        <th> Assigned Date </th>
                        <td>
                            <input class="form-control" type="text" value="<?php echo date('d-m-Y', strtotime($sqls['created_on'])); ?>" readonly>
                        </td>
                    </tr>

                    <?php

                    $bom_com = $con->query("select `id`,`bom`, `component_remark`,`status`,`reject_remark` from bom_component where po_ticket_id='$poId' ");
                    $bomcomponent = $bom_com->fetch();
                    $verify = $bomcomponent['bom'];

                    ?>

                    <tr>
                        <th> BOM Verification </th>
                        <td>
                            <input class="form-control" type="text" value="<?php if ($verify == 1) {
                                                                                echo  'ADD Component ';
                                                                            } else {
                                                                                echo  'Remove Component';
                                                                            } ?>" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th> components </th>
                        <td>
                            <textarea class="form-control" name="components" readonly> <?php echo $bomcomponent['component_remark']; ?></textarea>
                        </td>
                    </tr>
                    <?php if ($bomcomponent['reject_remark'] != '') { ?>
                    <tr>
                        <th> Reject Remark </th>
                        <td>
                            <textarea class="form-control" name="rr" readonly> <?php echo $bomcomponent['reject_remark']; ?></textarea>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php if ($bomcomponent['status'] == 0) { ?>
                <div class="float-right">
                    <input type="button" name="approve" value="Approve " class="btn btn-success" onclick="approveBom(<?php echo $poId; ?>,<?php echo $bomcomponent['id']; ?>)">
                    <input type="button" class="btn btn-danger" id="save" name="save"  onclick="openForm()"  style="margin: 5px;" value="Reject">
                    <!-- <input type="button" name="reject" class="btn btn-danger" value="Reject" onclick="rejectBom(<?php echo $poId; ?>,<?php echo $bomcomponent['id']; ?>)"> -->
                </div>
            <?php } ?>
        </form>
    </div>
</div>

<div class="form-popup" id="myForm">
		  <form action="" class="form-container">
			<h3>Component Reject Remark</h3>

			<label for="email"><b>Remark</b></label>
			<input type="text" placeholder="Enter Remark" name="reject_remark" id ="reject_remark" required>
          
			<button type="button" class="btn" onclick="rejectBom(<?php echo $poId; ?>,<?php echo $bomcomponent['id']; ?>)">Submit</button>
			<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
		  </form>
		</div>

<script>
    $(document).ready(function() {
        $('#salary_view').hide();
    })

    function approveBom(po, bom) {
        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/poTicket/approveBOM.php?po=" + po + "&bom=" + bom,
            success: function(data) {
                alert('Updated Successfully');
                comp()
            }
        });
    }

    function rejectBom(po, bom) {

        let remark = document.querySelector('#reject_remark').value;
        $.ajax({
            type: "POST",
            url: "qvision/Purchase_process/poTicket/rejectBOM.php?po=" + po + "&bom=" + bom +"&remark="+remark,
            success: function(data) {
                alert('Updated Successfully');
                comp()
            }
        });
    }

    function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>