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
								<th ><input type="time" class="form-control" placeholder="From" id="in" name="in"></th>
  <th ><input type="time" class="form-control" placeholder="From" id="out" name="out"></th>
							</table>
							<table class="table table-bordered">
							<h3 class="card-title"><font size="5">Attire Form</font></h3>
							<th ></th><th >Yes / No</th><th >Remarks</th>
							<tr>
								<th >Formally Dressed</th>
								<th ><div>
    <input type="radio" id="yes"
     name="yes" value="1">
    <label for="yes">Yes</label>

    <input type="radio" id="no"
     name="yes" value="2">
    <label for="no">No</label>

  </div></th><th ><input style="border-top: black;
  border-right: black;
  border-bottom: black;
  border-left: black;height: 41px;
    width: 246px;" type="text" id="remark" name="remark"></th>
								</tr>
								<tr>
								<th >Formally Shoes</th>
								<th ><div>
    <input type="radio" id="yes1"
     name="yes1" value="1">
    <label for="yes1">Yes</label>

    <input type="radio" id="no1"
     name="yes1" value="2">
    <label for="no1">No</label>

  </div></th><th ><input style="border-top: black;
  border-right: black;
  border-bottom: black;
  border-left: black;height: 41px;
    width: 246px;" type="text" id="remark1" name="remark1"></th>
								</tr>
								<tr>
								<th >Haricut</th>
								<th ><div>
    <input type="radio" id="yes2"
     name="yes2" value="1">
    <label for="yes2">Yes</label>

    <input type="radio" id="no2"
     name="yes2" value="2">
    <label for="no2">No</label>

  </div></th><th ><input style="border-top: black;
  border-right: black;
  border-bottom: black;
  border-left: black;height: 41px;
    width: 246px;" type="text" id="remark2" name="remark2"></th>
								</tr>
								<tr>
								<th >Id Card</th>
								<th ><div>
    <input type="radio" id="yes3"
     name="yes3" value="1">
    <label for="yes3">Yes</label>

    <input type="radio" id="no3"
     name="yes3" value="2">
    <label for="no3">No</label>

  </div></th><th ><input style="border-top: black;
  border-right: black;
  border-bottom: black;
  border-left: black;height: 41px;
    width: 246px;" type="text" id="remark3" name="remark3"></th>
								</tr>
								<tr>
								<th >Neatly Shaved</th>
								<th ><div>
    <input type="radio" id="yes4"
     name="yes4" value="1">
    <label for="yes4">Yes</label>

    <input type="radio" id="no4"
     name="yes4" value="2">
    <label for="no4">No</label>

  </div></th><th ><input style="border-top: white;
  border-right: white;
  border-bottom: white;
  border-left: white;height: 41px;
    width: 246px;" type="text" id="remark4" name="remark4"></th>
								</tr>
								
							
							</table>
							</br>
						
							
							<div id="save" name="save">
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
            url: "qvision/Recruitment/project_management/daily_mis/attire_form/attire/submit.php?id="+Employee+"&date="+datetimepicker1,
            success: function (data) {
                console.warn("sss:"+data);
               
                 $("#save").html(data);
            }
        })
    });
	 });
	</script>
	
	</html>
