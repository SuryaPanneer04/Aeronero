<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];
?>
<style>
    #page-wrapper {
        margin-left: 117px !important;
    }

    .btn-warning {
        padding-top: 0px !important;
        background-color: #337ab7 !important;
        border-color: #337ab7 !important;
    }

    .btn-success {
        background-color: #5cb85c !important;
        border-color: #5cb85c !important;
    }

    .page-header {
        border-bottom: 3px solid #eee !important;
    }
</style>

<div class="content-wrapper" id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12"></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Staff Asset Master
                    </div>

                    <div class="row" style="margin:10px;">
                        <div class="col-lg-12">
                            <a onclick="add_staff_asset()" style="float: right;" class="btn btn-primary btn-sm btn-flat">
                                <i class="fa fa-plus"></i> ADD
                            </a>
                        </div>
                    </div>

                    <!-- THIS CONTENT DIV IS IMPORTANT -->
                    <div class="panel-body content">
                        <div class="table-responsive">
                            <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Asset</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $emp_sql = $con->query("SELECT * FROM staff_asset_master");
                                    $i = 1;
                                    while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $emp_res['asset']; ?></td>
                                            <td>
                                                <button class="btn btn-success btn-sm btn-flat"
                                                    onclick="staff_asset_edit(<?php echo $emp_res['id']; ?>)">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.content -->

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            responsive: true
        });
    });

    /* Add page load */
    function add_staff_asset() {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset_master/new_staff_asset_master.php",
            success: function(data) {
                $(".content").html(data);
            },
            error: function(xhr, status, error) {
                alert("Add page load error: " + error);
                console.log(xhr.responseText);
            }
        });
    }

    /* Edit page load */
    function staff_asset_edit(id) {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset_master/edit_staff_asset_master.php",
            data: {
                id: id
            },
            success: function(data) {
                $(".content").html(data);
            },
            error: function(xhr, status, error) {
                alert("Edit page load error: " + error);
                console.log(xhr.responseText);
            }
        });
    }

    /* Back button from edit page */
    $(document).off('click', '#btn_back_edit_staff_asset').on('click', '#btn_back_edit_staff_asset', function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset_master/staff_asset_master.php",
            success: function(data) {
                $(".content").html(data);
                // setTimeout(function() {
                //     if ($.fn.DataTable.isDataTable('#example1')) {
                //         $('#example1').DataTable().destroy();
                //     }
                //     $('#example1').DataTable({
                //         responsive: true
                //     });
                // }, 100);
            },
            error: function(xhr, status, error) {
                alert("Back Error: " + error);
                console.log(xhr.responseText);
            }
        });
    });


    /* Back button from Add page */
$(document).off('click', '#btn_back_new_staff_asset').on('click', '#btn_back_new_staff_asset', function(e) {

    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "qvision/Recruitment/staff_asset_master/staff_asset_master.php",
        success: function(data) {
            $(".content").html(data);
        },
        error: function(xhr, status, error) {
            alert("Back Error : " + error);
            console.log(xhr.responseText);
        }
    });

});

    /* Update asset */
    $(document).off('click', '#btn_update_staff_asset').on('click', '#btn_update_staff_asset', function() {
        var data = $('#edit_staff_asset_form').serialize();

        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset_master/update_staff_asset_master.php",
            data: data,
            success: function(response) {
                alert(response);
            },
            error: function(xhr, status, error) {
                alert("Update Error: " + error);
                console.log(xhr.responseText);
            }
        });
    });
</script>