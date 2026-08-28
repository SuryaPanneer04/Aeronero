<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid = $_SESSION['candidateid'];
$userrole = $_SESSION['userrole'];
?>
<!DOCTYPE HTML>
<html>
<head>
    <style>
        .right {
            margin-right: 2px;
        }
    </style>
</head>
<body>
<div class="card card-primary">
    <div class="card-header" style="background-color: #f1cc61;">
        <h2 class="card-title"><font size="4"><b>Invoice List</b></font></h2>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SL.No</th>
                    <th>SO Number</th>
                    <th>Company Name</th>
                    <th>Product</th>
                    <th colspan="2"><strong>Action</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $emp_sql = $con->query("SELECT * FROM challan_entry GROUP BY customer_name ORDER BY id DESC");
                $cnt = 1;
                while ($data = $emp_sql->fetch()) { 
                ?>
                <tr>
                    <td><?php echo $cnt; ?>.</td>
                    <td><?php echo htmlspecialchars($data['so_number']); ?></td>
                    <td>
                        <?php  
                        $customer_name = $data['customer_name']; 

                        $clientIdDetails = $con->query("SELECT id, client_id FROM cost_sheet_entry WHERE id = '$customer_name'");
                        $clientId = $clientIdDetails->fetch();

                        if ($clientId) {
                            $client_id = $clientId['client_id'];

                            $orgName = $con->query("SELECT org_name FROM new_client_master WHERE id = '$client_id'");
                            $org = $orgName->fetch();

                            if ($org) {
                                echo htmlspecialchars($org['org_name']);
                            } else {
                                echo "<span style='color:red;'>Organization Not Found</span>";
                            }
                        } else {
                            echo "<span style='color:red;'>Client ID Not Found</span>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        echo htmlspecialchars($data['product_name']);
                        ?>
                    </td>
                    <td>
                        <button class="btn btn-info" name="challan_view" id="challan_view" 
                            onclick="invoice_view(<?php echo $data['id']; ?>)"> View </button> 
                    </td>
                </tr>
                <?php
                    $cnt++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function invoice_view(v) {
    $.ajax({
        type: "POST",
        url: "qvision/Purchase_process/delivery_challan/invoice_send_view.php?id=" + v,
        success: function(data) {
            $("#main_content").html(data);
        }
    });
}

function new_invoice() {
    $.ajax({
        type: "POST",
        url: "qvision/Purchase_process/delivery_challan/challan_add.php",
        success: function(data) {
            $("#main_content").html(data);
        }
    });
} 
</script>

</body>
</html>
