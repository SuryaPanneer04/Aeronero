<?php
require '../../../connect.php';
?>

<!-- script>

function replace_date(e){
	//console.log("Canid id",e.value)
	//console.log("Aplied date",e.getAttribute('data-resdate'))
	//console.log(e.options[e.selectedIndex].getAttribute('data-resdate'))
	repace_joining(new Date(e.options[e.selectedIndex].getAttribute('data-resdate')))
}
</script -->


<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
</style>
<div class="card card-primary">
  <div class="card-header">
  
    <center><h3 class="card-title"><b>NEW JOB DESCRIPTION FORM </b></h3></center>
	<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"></i>Back</a>
  </div>
  
  <form method="POST" enctype="multipart/form-data">
    <table class="table table-bordered">
        
	   <tr>
		    <td>JD Title*</td>
			<td colspan="5">
			<select class="form-control" id="jd_title" name="jd_title" required="true" onchange="">
			<option value="">Choose JD Title</option>
			<?php 
			$stmt = $con->query("SELECT * FROM jobdescription_master where status=1");
			while ($row = $stmt->fetch()) 
			{
			?>
			<option value="<?php echo $row['id']; ?>"> <?php echo $row['tittle']; ?> </option>
			<?php 
			} ?>
			</select>
			</td>
      </tr>
	  <tr>
				<td>Client Org Name*</td>
				<td colspan="2">
				<select class="form-control" id="org_name"  name="org_name"  required="true"  onchange="getcode(value);locationnme(value);"> 						
			<option value="">Choose Org Name</option>
						<?php $stmt3 = $con->query("SELECT id,org_type,org_name FROM new_client_master order by id desc");
						
						while ($row3 = $stmt3->fetch()) {?>
						<option value="<?php echo $row3['org_type'].'-'.$row3['org_name'].'-'.$row3['id']; ?>"> <?php echo $row3['org_name']; ?></option>
						<?php }  ?>
					</select><br>
					<select required aria-required="true" class="form-control" id="location" name="location">
				<option value="">Location</option>
				<option>	<?php $stmt4 = $con->query("SELECT location FROM new_plant_master group by  location order by id desc");
						
						while ($row4 = $stmt4->fetch()) {?>
						<option value="<?php echo $row4['location']; ?>"> <?php echo $row4['location']; ?></option>
						<?php }  ?></option>
			    </select>
				</td>
				<td colspan="2"><input type="text" name="client_code" id="client_code" class="form-control" readonly> </td>
			</tr>
			<div id="product_detail">
			</div>
			<tr>
				
			</tr>
       <!-- <tr id="show_approve">

		</tr>  -->

		<tr id="show_round">

		</tr>
<!-- 
		<tr>
		<td>Location</td>
        <td><input type="text" class="form-control" id="location" name="location" Autocomplete="off"></td>
		</tr> -->
		
		<!-- <tr>
		<td>Shift Timing (9 Hrs) </td>
        <td><input type="number" class="form-control" id="shift_timing" name="shift_timing" Autocomplete="off"></td>
		</tr> -->
		
		<!-- <tr>
		<td>Weekly Off*</td>
		<td colspan="5">
		<select class="form-control" id="weekly_off" name="weekly_off" required="true">
		<option value="">Choose Weekly Off</option>
		<option value="Sunday Off">Sunday Off</option>
						<option value="Saturday & Sunday Off">Saturday & Sunday Off</option>
						<option value="Saturday Half Day & Sunday Off">Saturday Half Day & Sunday Off</option>
						<option value="2nd & 4th Saturday & All Sunday Off">2nd & 4th Saturday & All Sunday Off</option>
						<option value="Weekly One Day Off">Weekly One Day Off</option>
						<option value="Rotational Week Off">Rotational Week Off</option>

		</select>
		</td>
		</tr>
		
		<tr>
		<td>Experience</td>
        <td><input type="number" class="form-control" id="experience" name="experience" Autocomplete="off"></td>
		</tr>
		
		<tr>
		<td>Education Qualification</td>
        <td><input type="text" class="form-control" id="education" name="education" Autocomplete="off"></td>
		</tr>
		
		<tr>
		<td>Certification</td>
        <td><input type="text" class="form-control" id="certificate" name="certificate" Autocomplete="off"></td>
		</tr> -->
		
	
		<!-- <tr>
		<td>Roles & Responsibilities</td>
        <td><textarea class="form-control" id="roles" name="roles"></textarea></td>
		</tr>
		
		
		<tr>
		<td>Skills Required</td>
        <td><textarea class="form-control" id="skills" name="skills"></textarea></td>
		</tr>
		
		<tr>
		<td>Replacement For</td>
        <td colspan="2">
		<select class="form-control" id="replacement" name="replacement">
		<option value="">---Select Employee---</option>
		<option value="new">New</option>

		<?php
$replace = $con->query("SELECT id, emp_name FROM staff_master WHERE status = 1");

while ($redis = $replace->fetch()) {
    ?>
    <option value="<?php echo $redis['id']; ?>"><?php echo $redis['emp_name']; ?></option>
<?php
}
?>

		</td>
		<p class="getDate"></p>
        </tr>
		
		<tr>
		<td>Initiate Date*</td>
        <td colspan="2">
		<input type="date" class="form-control" id="date_joining" name="date_joining"  required="true"> </td>
		<p class="getDate"></p>
        </tr>		
		
		<tr>
		<td>Date to be closed*</td>
        <td colspan="2"><input type="date" class="form-control" id="date_close" name="date_close" required="true"></td>
		<p class="getDate"></p>
        </tr>
		
	  <tr>
		<td>CTC PA (In Lakhs)</td>
        <td colspan="2"><input type="number" class="form-control" id="ctc" name="ctc" Autocomplete="off"></td>
		<p class="getDate"></p>
        </tr>
		
	  <tr>
		<td>No Of Position *</td>
        <td colspan="2"><input type="number" class="form-control" id="no_of_postion" name="no_of_postion" Autocomplete="off" required></td>
       </tr> -->
		 
        <tr>  
        <td colspan="6"><input type="button" class="btn btn-success" name="Submit" onclick="jd_form()" style="float:right;" value="Submit"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<script>
//let date_close = document.getElementById("date_close")
//let date_joining = document.getElementById("date_joining")
 //client_code
 function getcode(v)
 {
	//alert(v);
	 $.ajax({
		 type:"get",
		 url:"Qvision/masters/client_master/get_clientcode.php?client="+v,
		 success:function(data)
		 {
			 $('#client_code').val(data)
		 }
		 
	 })
 }
 function locationnme(val) {
  //debugger;
  $.ajax({
    type: "get",
    url: "Qvision/masters/client_master/get_org_location.php?client=" + val,
    success: function (data) {
		var datas=data.split("##");
		var dataln=datas.length;
    //  alert(data);
      var select = $('#location');
      select.empty(); // Clear existing options
      
      // Iterate over the data and create options
      for(var i=0;i<(dataln-1);i++)
	  {
        select.append($('<option value="' + datas[i] + '">' + datas[i] + '</option>'));

	  }
    
    }
  });
}

$(document).ready(function(){

//Joining & closing date 
var mintoday = new Date();
var mindd = mintoday.getDate();
var minmm = mintoday.getMonth()+1; //January is 0 so need to add 1 to make it 1!
var minyyyy = mintoday.getFullYear();
if(mindd<10){
  mindate='0'+mindd
}else{
  mindate=mindd
}
if(minmm<10){
  minmm='0'+minmm
}else{
  minmm=minmm
}	
mintoday = minyyyy+'-'+minmm+'-'+mindate;
// Set Minimum date
document.getElementById("date_joining").setAttribute("min", mintoday);
document.getElementById("date_close").setAttribute("min", mintoday);

})

function back()
	{
		jobdescription_form()
	}

function jd_form()
{
	var field=1;
	var data = $('form').serialize();
	var orgnam=$('org_name').val()
	//r orgnam=$('org_name').val();
	//ert("data:"+orgnam);
	var jd = $('#jd_title').val();
	var week = $('#weekly_off').val();
	var date_j = $('#date_joining').val();
	var date_c = $('#date_close').val();
	var nop = $('#no_of_postion').val();
	
	if(jd=='' ||  week=='' || date_j=='' || date_c=='' || nop == '')
	{
	alert("Enter all required fields");
	}
   else
   {
	$.ajax({
		type:'GET',
		data:"field="+field, data,
		url:'qvision/Resource/jobdescription_form/jd_form_submit.php',
		success:function(data)
		{
			console.warn("data:"+data);
			
			if(data==0)
			{
				alert("Form Data has not been Submitted");
				console.warn("data:"+data);
				jobdescription_form();
			}
			else
			{
			alert("Form Data has been Submitted");
			console.warn("data:"+data);
				jobdescription_form();
			}	
		}       	
	});
   }
}

//function approve_round(){
	//let id = $('#jd_title').val()

	//$.ajax({
		//type:'GET',
		//data:"id="+id,
		//url:"Qvision/resource/jobdescription_form/view_approve.php?id="+id,
		//success:function(data)
		//{
			//$('#show_approve').html(data)
		//}
	///})
//}

$('#jd_title').change(function(){

	let id = $('#jd_title').val()
	$.ajax({
		type:'GET',
		data:"id="+id,
		url:"Qvision/resource/jobdescription_form/view_round.php?id="+id,
		success:function(data)
		{
			$('#show_round').html(data)
		}
	})
}) 



/* function replace_date(datevalue)
{
	var replace = $('#replacement').val();
	console.log(replace);
	let digits = replace.split('.');
	console.log(digits[1]);
} */




// function addDays(date, days) {
    // var result = new Date(date);
    // result.setDate(result.getDate() + days);
    // return result;
// }

// function formatDate(date, month, year) {

// if (date < 10) {
	// mindate = '0' + date
// } else {
	// mindate = date
// }
// if (month < 10) {
	// month = '0' + month
// } else {
	// month = month
// }

// return year + '-' + month + '-' + mindate;

// }



// function repace_joining(dateValue) {
 
//Joining date 
    // mintoday = dateValue.toISOString().split('T')[0]
    // date_joining.setAttribute("min", mintoday);

    // let nextdate = addDays(mintoday, 45)
    // date_joining.setAttribute("max", nextdate.toISOString().split('T')[0]);
	
//Closing date
	// minclose = dateValue.toISOString().split('T')[0]
    // date_close.setAttribute("min", minclose);

    // let closedate = addDays(minclose, 45)
    // date_close.setAttribute("max", closedate.toISOString().split('T')[0]);
// }

</script>









