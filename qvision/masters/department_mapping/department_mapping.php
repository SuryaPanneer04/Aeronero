<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>

<head>
    <!-- Pudhu style file add pannirukom (Department Master la iruka mariye) -->
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">DEPARTMENT MAPPING LIST</font></h3>
        <!-- ADD button style mathirukom -->
        <a onclick="newdepartment_mapping()" style="float: right;" data-toggle="modal" class="btn">ADD</a>
    </div>
    
    <div class="card-body">
        <!-- Table classes and width mathirukom -->
        <table class="table table-striped table-bordered table-hover display nowrap" id="example1" style="width:100%">
            <thead>
                <th>#</th>
                <th>Company Name</th>
                <th>Department Name</th>
                <th>Head Name</th>
                <th>Status</th>
                <th>Tools</th>
            </thead>
            <tbody>
                <?php
                $emp_sql=$con->query(" select *,d.id as dmid,c.companyname as cname,z.dept_name as dname,u.user_name as uname,d.status as dstatus from department_mapping d join z_department_master z on z.id=d.department_id join z_user_master u on u.user_id=d.department_head join company_master c on c.id=d.company_name");
                
                $i=1;
                while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
                {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $emp_res['cname']; ?></td>
                    <td><?php echo $emp_res['dname']; ?></td>
                    <td><?php echo $emp_res['uname']; ?></td>
                    <td>
                        <?php
                        if($emp_res['dstatus']==1)
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
                        <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['dmid']; ?>" onclick="question_edit(<?php echo $emp_res['dmid']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
// DataTables style-ah department master-la iruka mari mathirukom
$(document).ready(function() {
    $('#example1').DataTable( {
        "scrollX": true
    } );
} );
</script>

<script>
    function newdepartment_mapping()
    {
        $.ajax({
            type:"POST",
            url:"qvision/masters/department_mapping/new_department_mapping.php",
            success:function(data){
                $("#main_content").html(data);
            }
        })
    }
    
    function question_edit(v)
    {
        $.ajax({
            type:"POST",
            url:"qvision/masters/department_mapping/edit_department_mapping.php?id="+v,
            success:function(data){
                $("#main_content").html(data);
            }
        })
    }
</script>