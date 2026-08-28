<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">ASSET MASTER LIST</font></h3>
        <a onclick="add_asset()" style="float: right;" data-toggle="modal" class="btn">ADD</a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover display nowrap" id="example1" style="width:100%">
            <thead>
                <th>#</th>
                <th>Asset Name</th>
                <th>Status</th>
                <th>Tools</th>
            </thead>
            <tbody>
                <?php
                $asset_sql=$con->query("SELECT * FROM assets_master");
                $i=1;
                while($asset_res = $asset_sql->fetch(PDO::FETCH_ASSOC))
                {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $asset_res['name']; ?></td>
                    <td>
                    <?php
                    if(isset($asset_res['status']) && $asset_res['status']==1)
                    {
                        echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
                    }
                    else
                    {
                        echo '<span style="color:red;text-align:center;"><b>Inactive</b></span>';
                    }
                    ?>
                    </td>
                    <td>
                        <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $asset_res['id']; ?>" onclick="edit_asset(<?php echo $asset_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
<script>
$(document).ready(function() {
    $('#example1').DataTable( {
        "scrollX": true
    } );
} );
</script>
<script>
function add_asset()
{
    $.ajax({
        type:"POST",
        url:"qvision/masters/asset_master/new_asset.php",
        success:function(data){
            $("#main_content").html(data);
        }
    })
}

function edit_asset(v)
{
    $.ajax({
        type:"POST",
        url:"qvision/masters/asset_master/edit_asset.php?id="+v,
        success:function(data){
            $("#main_content").html(data);
        }
    })
}
</script>
