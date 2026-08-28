<?php
require '../../../../connect.php';
include("../../../../user.php");
$userrole = $_SESSION['userrole'];
?>


<head>
	<link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<font size="5">Mediclaim Insurance </font>
		</h3>
		<a onclick="backtoMedi()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"></i>BACK</a>
	</div>



   <form method="POST" id="fupForm" enctype="multipart/form-data"> 
   <input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">


    <table class="table table-bordered">
	<tr>
				<!-- To create Official mail id for this new joinee employee /// Value is candidate id-->
				<td>Employee Name:</td>
				<td colspan="2">
					<select class="form-control" name="emp_name" >
						<option value="0">-- Select Employee Name --</option>
						<?php
						$dep_sql = $con->query("SELECT * FROM staff_master");
						while ($dep_sql_res = $dep_sql->fetch(PDO::FETCH_ASSOC)) {
						?>
							<option value="<?php echo $dep_sql_res['id']; ?>"> <?php echo $dep_sql_res['emp_name']; ?> </option>
						<?php
						}
						?>
					</select>
				</td>
			</tr>   

	    <tr id="external_refer_name">
		    <td>Insurance Name:  </td>
			<td colspan="5"><input type="text" class="form-control" name="insurance_name" id="insurance"  >
			</td>
					</tr>     
	   <tr>
        <td>Insurance Number:</td>
        <td colspan="5"> <input type="number" class="form-control" id="type" name="insurance_number"  required></td>
        </tr>
			
		<tr>
        <td>Validate From:</td>
        <td colspan="5"> <input type="date" class="form-control"  name="validate_from"  required></td>
        </tr>

		<tr>
        <td>Validate To:</td>
        <td colspan="5"> <input type="date" class="form-control"  name="validate_to"  required></td>
        </tr>

		<tr>
        <td>Premium Insurance Policy</td>
        <td colspan="5"> <input type="text" class="form-control"  name="premium_insurance_policy"  required></td>
        </tr>
		<tr>
        <td>Document Approved</td>
        <td colspan="5"> <input type="file" class="form-control" id="resume" name="resume[]" accept=".doc,.docx,.pdf" required></td>
        </tr>

       <tr>  
       <td colspan="6">
	   <input type="submit" class="btn btn-success" name="save"  style="float:right;" value="Save" > </td>
        </tr>
		
        </table>
        <!-- /.post  -->
    </form>
    </div>



<script type="text/javascript">  

function backtoMedi(){
    mediclaim_insurance()
}
 
$(document).ready(function(){
	 $("#fupForm").on('submit', function(e){
        var formData = new FormData(this);    
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'qvision/Recruitment/staff_asset/mediclaim_insurance/submit_mediclaim.php',
            data: formData,
            contentType: false,
            processData:false,
            success: function(data){
       if(data==0)
       { 
         alert("Form Data has not been Submitted");
		 mediclaim_insurance()
        }
       else
      {
        alert("Form Data has been Submitted");
        mediclaim_insurance()
      }
    }   
        });
    });
})

</script>

