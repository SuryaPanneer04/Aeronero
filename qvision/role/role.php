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
        <h3 class="card-title"><font size="5">ROLE LIST</font></h3>
        <a onclick="add_role()" style="float: right;" data-toggle="modal" class="btn">ADD</a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover display nowrap" id="example1" style="width:100%">
            <thead>
                <th>#</th>
                <th>Role Code</th>
                <th>Role Name</th>
                <th>Status</th>
                <th>Tools</th>
            </thead>
            <tbody>
                <?php
                $role_sql=$con->query("SELECT * FROM z_role_master");
                $i=1;
                while($role_res = $role_sql->fetch(PDO::FETCH_ASSOC))
                {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $role_res['code']; ?></td>
                    <td><?php echo $role_res['role_name']; ?></td>
                    <td>
                    <?php
                    if($role_res['status']==1)
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
                        <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $role_res['id']; ?>" onclick="role_edit(<?php echo $role_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
function add_role()
{
    $.ajax({
        type:"POST",
        url:"qvision/role/new_role.php",
        success:function(data){
            $("#main_content").html(data);
        }
    })
}

function role_edit(v)
{
    $.ajax({
        type:"POST",
        url:"qvision/role/edit_role.php?id="+v,
        success:function(data){
            $("#main_content").html(data);
        }
    })
}
</script>
