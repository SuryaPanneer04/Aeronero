<?php
require '../../../connect.php';

$id = $_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM staff_asset_master WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="container-fluid">
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> STAFF ASSET MASTER EDIT
            <a href="javascript:void(0)"
               id="btn_back_edit_staff_asset"
               style="float: right; color: white; cursor: pointer;"
               class="btn btn-primary">Back</a>
        </div>

        <div class="card-body" id="printableArea">
            <form id="edit_staff_asset_form">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <table class="table table-bordered">
                    <tr>
                        <td>
                            <center>
                                <img src="qvision\images\logo123.jpg" alt="quadsel" style="width:100px;height:50px;">
                            </center>
                        </td>
                        <td colspan="5">
                            <center><b>Bluebase Software Services Private Limited</b></center>
                        </td>
                    </tr>

                    <tr>
                        <td>Asset</td>
                        <td colspan="2">
                            <select class="form-control" name="asset" id="asset">
                                <option value="<?php echo $row['asset']; ?>">
                                    <?php echo $row['asset']; ?>
                                </option>

                                <?php
                                $dep_sql1 = $con->query("SELECT * FROM staff_asset_master");
                                while($dep_sql_res = $dep_sql1->fetch(PDO::FETCH_ASSOC))
                                {
                                    if($dep_sql_res['asset'] != $row['asset'])
                                    {
                                ?>
                                        <option value="<?php echo $dep_sql_res['asset']; ?>">
                                            <?php echo $dep_sql_res['asset']; ?>
                                        </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>

                <input type="button" id="btn_update_staff_asset" name="submit" class="btn btn-primary btn-md" style="float:right;" value="Update">
            </form>
        </div>
    </div>
</div>