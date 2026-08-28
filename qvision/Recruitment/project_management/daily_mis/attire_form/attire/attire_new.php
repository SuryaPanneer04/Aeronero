<?php
Session_start();
include '../../../../../../connect.php';
//include '../../user.php';
$user_id=$_SESSION['userid'];

?>




<html>
<div  class="card card-primary">
              <div class="card-header" style="background-color: #f1cc61; !important">
                <h3 class="card-title"><font size="5">Attendance Form</font></h3>
				<input type="button" style="float:right;" class="btn btn-danger" name="back" value="BACK" onclick="attaire_form()">
				</input>
              </div>
			  <div class="card-body">
					<form method="POST" name="fupForm" id="fupForm" enctype="multipart/form-data">
					<!-- Post -->
						<table class="table table-bordered">
							<tr>
								 <tr id="dep1">
								<td colspan="3">Department</td>
								<td colspan="3">
									<select class="form-control" id="Department" name="Department" >
										<option value=""> Select Department </option>
										<?php
										
										$stmt = $con->query("SELECT * FROM z_department_master ");
										while ($row = $stmt->fetch()) {
											?>
											<option value="<?php echo $row['id']; ?>"> <?php echo $row['dept_name']; ?> </option>
									<?php } ?>
									</select>
								</td>
							  <td>Designation</td>
                <td colspan="5">
                    <select class="form-control" name="Designation" id="Designation" required>



                    </select></td>
					 <td>Employee</td>
                <td colspan="5">
                    <select class="form-control" name="Employee" id="Employee" required>



                    </select></td>
								</tr>	
 			
								
								
								
						</table>
							<table class="table table-bordered">
							 <h3 class="card-title"><font size="5">In / Out Time</font></h3>
							 <th >DATE</th><th >IN</th><th >OUT</th><tr>
							 <th ><div id="datetimepicker1"  class="input-append date">
																<div class="input-group" style="width: 161px;">
																
															<input type="date" style="border-top: white;
  border-right: white;
  border-bottom: white;
  border-left: white;" class="add-on form-control" id="to_date" name="to_date" title=" Date" value="<?php
$cur = date('Y-m-d');	
$cur1 = date('Y-m-d', strtotime('-1 day', strtotime($cur)))	;													echo $cur1; ?>">
																	</div>
																
														</div></th>
								<th><input type="time" class="form-control" placeholder="From" id="in" name="in"></th>
  <th ><input type="time" class="form-control" placeholder="From" id="out" name="out"></th>
							</table>
						
						
							
							<div id="save" name="save">
              <div id="save" name="save">
        <button type="button" class="btn btn-primary" onclick="attire_insert()">Save</button>
    </div>
							</div>
					</form>
			</div>
        </div>
		<script>
    function attire_insert()
    {
   var id=0;

    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
    url:"qvision/Recruitment/project_management/daily_mis/attire_form/attire/attire_submit.php",	
    success:function(data)
    {      
        alert("Entry Successfull");
		attaire_form()
		          
    }       
    });
    }
	
</script>
	
 		
	<script>
			 $(document).ready(function () {
        $('#Department').on('change', function () {

            var department_id = this.value;
//alert(department_id);
            $.ajax({
                url: "qvision/Recruitment/project_management/daily_mis/attire_form/attire/get_designation.php",
				
                type: "GET",
                data: {
                    department_id: department_id
                },
                cache: false,
                success: function (result) {
                    $("#Designation").html(result);

                }
            });
        });
    });
	</script>
	<script>
			 $(document).ready(function () {
        $('#Designation').on('change', function () {

            var Designation = this.value;
		//	alert(Designation)
       var Department= document.getElementById('Department').value;
	  // alert(Department)
           
            $.ajax({
                url: "qvision/Recruitment/project_management/daily_mis/attire_form/attire/find_emp.php",
                type: "GET",
                data: {
                    Designation: Designation,
                    Department: Department
                },
                cache: false,
                success: function (result) {
                    $("#Employee").html(result);

                }
            });
        });
    });
	
	 $(document).ready(function () {
        $('#Employee').on('change', function () {

            var Employee = this.value;
			   var datetimepicker1= document.getElementById('to_date').value;
			//alert(Employee)
      $.ajax({
            type: "POST",
            url: "qvision/Recruitment/project_management/daily_mis/attire_form/attire/attire_new_submit.php?id="+Employee+"&date="+datetimepicker1,
            success: function (data) {
                console.warn("sss:"+data);
               
               //  $("#save").html(data);
            }
        })
    });
	 });
	</script>
	
	</html>
