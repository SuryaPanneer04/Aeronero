<?php
Session_start();
include '../../../../../connect.php';
//include '../../user.php';
$user_id=$_SESSION['userid'];

?>




<html>
<div  class="card card-primary">
              <div class="card-header" style="background-color:#ff8b3d !important;">
                <h3 class="card-title"><font size="5">House Keeping Sheet</font></h3>
				<!--<input type="button" style="float:right;" class="btn btn-danger" name="back" value="BACK" onclick="attire()">-->
				</input>
              </div>
			  <div class="card-body">
					<form method="POST" name="fupForm" id="fupForm" enctype="multipart/form-data">
					<!-- Post -->
						<table class="table table-bordered">
							<tr>
								 <tr id="dep1">
								<td colspan="3">Date</td>
								<td colspan="3">
									<div id="datetimepicker1"  class="input-append date">
																<div class="input-group" style="width: 161px;">
																
															<input type="date" style="border-top: white;
  border-right: white;
  border-bottom: white;
  border-left: white;" class="add-on form-control" id="to_date" name="to_date" title=" Date" value="<?php
$cur = date('Y-m-d');	
$cur1 = date('Y-m-d', strtotime('-1 day', strtotime($cur)))	;													echo $cur1; ?>">
																	</div>
																
														</div>
								</td>
							 
								</tr>	
 			
								
								
								
						</table>
							<table class="table table-bordered">
							<th ></th><th >Yes / No</th><th >Remarks</th>
							<tr>
								<th >Bathroom Cleaning</th>
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
								<th >Floor Cleaning</th>
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
								<th >Morning - 1</th>
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
								<th >Morning - 2</th>
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
								<th >Afternoon - 1</th>
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
								<tr>
								<th >Afternoon - 2</th>
								<th ><div>
    <input type="radio" id="yes5"
     name="yes5" value="1">
    <label for="yes5">Yes</label>

    <input type="radio" id="no5"
     name="yes5" value="2">
    <label for="no5">No</label>

  </div></th><th ><input style="border-top: white;
  border-right: white;
  border-bottom: white;
  border-left: white;height: 41px;
    width: 246px;" type="text" id="remark5" name="remark5"></th>
								</tr>
								<tr>
								<th >Desk Cleaning</th>
								<th ><div>
    <input type="radio" id="yes6"
     name="yes6" value="1">
    <label for="yes6">Yes</label>

    <input type="radio" id="no6"
     name="yes6" value="2">
    <label for="no6">No</label>

  </div></th><th ><input style="border-top: white;
  border-right: white;
  border-bottom: white;
  border-left: white;height: 41px;
    width: 246px;" type="text" id="remark6" name="remark6"></th>
								</tr>
								
							
							</table>
							</br>
							
								<div id="save" name="save">
							</div>
					</form>
			</div>
        </div>
		<script>
		 $(document).ready(function () {
        $('#to_date').on('change', function () {

            var to_date = this.value;
			 //  var datetimepicker1= document.getElementById('to_date').value;
			//alert(to_date)
      $.ajax({
            type: "POST",
            url: "qvision/Recruitment/project_management/daily_mis/house/submit.php?date="+to_date,
            success: function (data) {
                 $("#save").html(data);
            }
        })
    });
	 });
    function attire_insert()
    {
   var id=0;

    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
    url:"qvision/Recruitment/project_management/daily_mis/house/house_submit.php",	
    success:function(data)
    {      
        alert("Entry Successfull");
		house_form()
		          
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
                url: "qvision/Recruitment/project_management/daily_mis/house/get_designation.php",
				
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
        $('#Department').on('change', function () {

            var department_id = this.value;
           
//alert(department_id);
            $.ajax({
                url: "qvision/Recruitment/project_management/daily_mis/house/find_emp.php",
                type: "GET",
                data: {
                    department_id: department_id
                    
                },
                cache: false,
                success: function (result) {
                    $("#Employee").html(result);

                }
            });
        });
    });
	</script>
	<script>
	function attire()
    {
	attire_form()	
	}
	</script>
	</html>
