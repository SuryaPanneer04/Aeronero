<?php
	require '../../../connect.php';
?>

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

	<div  class="card card-primary">
    <div class="card-header">
	<div class="col-lg-12">
	<h4>Enquiry REPORT</h4>
	</div>
    <div class="panel-body">
	<form method="GET" name="pf_reports" role="form">

	<div class="row">	
		<div class="col-lg-2">
		<div class="form-group">
			<label>	Date </label>
		</div>
		</div>

		<div class="col-lg-3">
		<div class="form-group">
		    <input type="date" name="candate" id="candate"  required> 
		</div>
		</div>

		<div class="col-lg-1">
		<!-- <div class="form-group">
		   <label> Month </label>
		</div>		
		</div>
		
		<div class="col-lg-3">
		<div class="form-group">
		    <input type="month" name="esicMonth" class="form-control" required>  
		</div>		
		</div> -->
		
		<div class="col-lg-2">
		<div class="form-group">		
		<input  type="button" class="btn btn-default" value="SEARCH" onclick="enquiryview()">
		</div>
		</div>
		
		</div>
	</form>
	</div>
    </div>
  </form>
</div>
</div>
  <!-- /.card-header -->
    <div class="card-body">
      <div id="enquiry_report_view">
      </div>
    </div>
    <!-- /.card-body   style="overflow-x: scroll !important;"-->
  </div>

	
<script>
// function esic_view()
// {
// 	var data = $('form').serialize();
// 	$.ajax({
// 	type: "GET",
// 	url: "qvision/reports/esicreports/response.php",
// 	data: data,
// 	success: function(data)
// 	{
// 	$("#esic_details_view").html(data);		
// 	}				
// 	});	
// }


function enquiryview()
{
	var data = $('form').serialize();
	$.ajax({
	type: "GET",
	url: "qvision/reports/enquiry_report/enquiryreports.php",
	data: data,
	success: function(data)
	{
	$("#enquiry_report_view").html(data);		
	}				
	});	
}
</script>