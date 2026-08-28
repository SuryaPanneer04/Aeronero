<?php
	$leave_type=$_REQUEST['id'];
?>
	<td colspan="2">Half/Full day leave</td>
	<td colspan="2">
	<select class="form-control" id="half_full" name="half_full" onchange="date_type();full_leave();">
	<option value=""> Choose Leave Type </option>
	<?php
	if($leave_type!='5'){
		?>
	<option value="0.5">Half Day</option>
	<?php 
	}
	?>
	<option value="1">Full Day</option>
	</td>
	
	<td colspan="2" id="t_date">Date</td>
	<td colspan="2"><input type="date" class="form-control"  id="today_date" name="today_date" ></td>

	
<script>
  function date_type(){
	  var type = $('#half_full').val();
	  
	  if(type==0.5){
		  
		  $('#t_date').show();
		  $('#today_date').show();
	  }
	  else {
		  
		  $('#t_date').hide();
		  $('#today_date').hide();
	  }
  }
  
  
  $(document).ready(function(){
	  
	   $('#t_date').hide();
       $('#today_date').hide();
  })
  
  
 function full_leave(){

var types = $('#half_full').val();

if (types == 1){
	
	 $.ajax({
				url: "Leave_Management/leave_request/full_leave.php",
				success: function (data) 
				{
					$('#full_day').html(data); 
				}
			})
		}
 
 else{
	 
	   $('#fullf_date').hide();
	   $('#from_date').hide();
	   $('#fullt_date').hide();
       $('#to_date').hide();
 }
 }
</script>	