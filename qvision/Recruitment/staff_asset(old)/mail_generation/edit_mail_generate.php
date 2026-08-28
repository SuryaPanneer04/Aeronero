<?php
require '../../../../connect.php';
$id = $_REQUEST['id'];
$stmt = $con->query("select a.id as emd_id,a.emp_name as emp_id,a.mail_id,b.emp_name as employee, c.emp_name as itPerson from emp_mail_details a LEFT JOIN staff_master b ON a.emp_name = b.candid_id LEFT JOIN staff_master c ON a.IT_person = c.candid_id where a.id='$id'");
$row = $stmt->fetch();
?>

<head>
     <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
     <div class="card-header">
          <i class="fa fa-table"></i> Company E-mail Generation
          <a onclick="backtomail()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"> </i>Back</a>
     </div>

          <form role="form" name="fupname" action="" method="post" enctype="multipart/type">

               <table class="table table-bordered">

                    <tr>
                         <!-- To create Official mail id for this new joinee employee -->
                         <td>Employee Name:</td>
                         <td colspan="2">
                              <input type="text" class="form-control" name="emp_name" value="<?php echo $row['employee']; ?>" readonly>
                         </td>
                    </tr>

                    <tr>
                         <!-- IT Department Employee assigning to create mail id -->
                         <td>IT Person</td>
                         <td colspan="2">
                              <input type="text" class="form-control" name="it_person" value="<?php echo $row['itPerson']; ?>" readonly>
                         </td>
                    </tr>

                    <tr>
                         <!-- Mail with CC to the IT department Employee -->
                         <td>Mail id</td>
                         <td colspan="2">
                              <input type="email" class="form-control" name="mail_cc" id="cc" value="<?php echo $row['mail_id']; ?>">
                         </td>
                    </tr>

               </table>

               <input type="button" name="submit" value="Update" class="btn btn-primary" style="float:right;" onclick="update_mailId(<?php echo $row['emp_id']; ?>, <?php echo $row['emd_id']; ?>)">
          </form>

</div>
</div>

<script>
     function backtomail() {
          mail_generation()
     }

     function update_mailId(v, id) {

          var cc = $('#cc').val();
          $.ajax({
               method: "POST",
               data: "mailCC=" + cc + "&empId=" + v + "&id=" + id,
               url: 'qvision/Recruitment/staff_asset/mail_generation/update_mail_id.php',
               success: function(data) {
                    if (data == 1) {
                         alert("Entry Successfull");
                         mail_generation()
                    } else {
                         alert("Entry Failed");
                         mail_generation()
                    }
               }
          });
     }
</script>