<?php
require '../../../../connect.php';
$id = $_REQUEST['id'];

$stmt = $con->query("SELECT a.*,b.emp_name FROM `mediclamim_insurance` a left join staff_master b on a.emp_name = b.id WHERE a.`id`='$id'");
$row = $stmt->fetch();
?>

<head>
     <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
     <div class="card-header">
          <i class="fa fa-table"></i> MEDICLAIM INSURANCE EDIT
          <a onclick="backtoMediclaim()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"> </i>Back</a>
     </div>
     <div class="card-body" id="printableArea">
          <form role="form" id="medi_update_form" action="" method="post" enctype="multipart/type">

               <table class="table table-bordered">
                    <tr>


                         <td>Employee Name:</td>
                         <input type="hidden" name="id" id="id" value="<?php echo  $id; ?>">
                         <td colspan="2">
                              <input type="text" class="form-control" name="emp_name" value=" <?php echo $row['emp_name']; ?>" readonly>
                         </td>
                    </tr>


                    <tr>
                         <td>Insurance Name: </td>
                         <td colspan="5"><input type="text" class="form-control" name="insurance_name" id="insurance" value="<?php echo $row['insurance_name']; ?>">
                         </td>
                    </tr>
                    <tr>
                         <td>Insurance Number:</td>
                         <td colspan="5"> <input type="number" class="form-control" id="type" name="insurance_number" value="<?php echo $row['insurance_number']; ?>" required></td>
                    </tr>

                    <tr>
                         <td>Validate From:</td>
                         <td colspan="5"> <input type="date" class="form-control" name="validate_from" value="<?php echo $row['validate_from']; ?>" required></td>
                    </tr>

                    <tr>
                         <td>Validate To:</td>
                         <td colspan="5"> <input type="date" class="form-control" name="validate_to" value="<?php echo $row['validate_to']; ?>" required></td>
                    </tr>

                    <tr>
                         <td>Premium Insurance Policy</td>
                         <td colspan="5"> <input type="text" class="form-control" name="premium_insurance_policy" value="<?php echo $row['premium_insurance_policy']; ?>" required></td>
                    </tr>

                    <tr>
				  <td>Document Upload</td>
				  <td>
					<input type="file" class="form-control" name="resume[]" accept=".doc,.docx,.pdf">
				  </td>

	                 <td style="border-left:none;">

	                <a href="/ssinfo1/qvision/Recruitment/staff_asset/mediclaim_insurance/documentUpload/<?php echo $row['document_approved'];?>" download="<?php echo $row['document_approved']; ?>" ><?php echo $row['document_approved']; ?></a> 

	               <input type="hidden" value="<?php echo $row['document_approved']; ?>" name="Medi_insure_attach" id="attachhh">
	              </td>
			</tr>

               </table>

               <input type="hidden" name="medi_id" id="medi_id" value="<?php echo $row['id'];?>">
		<input type="submit" value="Update" class="btn btn-primary btn-md" style="float:right;">
          </form>
     </div>
</div>
</div>
<script>
     function backtoMediclaim() {
          mediclaim_insurance();
     }


     // function update_insurance(v) {
     //      var data = $('form').serialize();
     //      $.ajax({
     //           type: "POST",
     //           data: data,
     //           url: "qvision/Recruitment/staff_asset/mediclaim_insurance/update_mediclaim.php?id=" + v,
     //           success: function(data) {
     //                if (data == 1) {
     //                     alert("Sucessfully Updated")
     //                     mediclaim_insurance()
     //                } else {
     //                     alert("Updated Failed")
     //                     mediclaim_insurance()
     //                }
     //           }
     //      })
     // }


     $(document).ready(function() {
			$("#medi_update_form").on('submit', function(e) {
				e.preventDefault();
				$.ajax({
					type: 'POST',
                         url: "qvision/Recruitment/staff_asset/mediclaim_insurance/update_mediclaim.php",
					data: new FormData(this),
					contentType: false,
					processData: false,
					success: function(data) {
						if (data == 0) {
							alert("Update Failed");
							mediclaim_insurance();
						} else {
							alert("Update Successfully");
							mediclaim_insurance();
						}
					}
				});
			});
		})
</script>
