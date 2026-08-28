<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">USER ROLE MAPPING LIST</font></h3>
        <a onclick="add_role_mapping()" style="float: right;" data-toggle="modal" class="btn">ADD</a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover display nowrap" id="example1" style="width:100%">
            <thead>
                <th>#</th>
                <th>User Name</th>
                <th>Role Name</th>
                <th>Description</th>
                <th>Tools</th>
            </thead>
            <tbody>
                <?php
                $mapping_sql=$con->query("SELECT m.id, u.full_name, r.role_name, m.descriptions 
                                          FROM z_role_mapping m
                                          LEFT JOIN z_user_master u ON m.user_id = u.user_id
                                          LEFT JOIN z_role_master r ON m.code = r.code");
                $i=1;
                while($mapping_res = $mapping_sql->fetch(PDO::FETCH_ASSOC))
                {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $mapping_res['full_name']; ?></td>
                    <td><?php echo $mapping_res['role_name']; ?></td>
                    <td><?php echo $mapping_res['descriptions']; ?></td>
                    <td>
                        <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $mapping_res['id']; ?>" onclick="edit_role_mapping(<?php echo $mapping_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
function add_role_mapping()
{
    $.ajax({
        type:"POST",
        url:"qvision/user_role/new_role.php",
        success:function(data){
            $("#main_content").html(data);
        }
    })
}

function edit_role_mapping(v)
{
    $.ajax({
        type:"POST",
        url:"qvision/user_role/edit_role.php?id="+v,
        success:function(data){
            $("#main_content").html(data);
        }
    })
}
</script>
