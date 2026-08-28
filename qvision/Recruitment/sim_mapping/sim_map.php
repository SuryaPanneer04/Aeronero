<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$user_id =$_SESSION['userid'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
<div class="card-header">
	<i class="fa fa-table"></i> 
	<a onclick=" back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<form enctype="multipart/form-data" name="fupForm" id="fupForm" name="add_name" method="POST" role="form">

	<div class="control-group"><br>
	<div class="has-feedback" style="left: 15px;position: relative;">
		<a href='qvision/Recruitment/sim_mapping/sim_mapping.csv' target="_blank" style="color:blue;">Sim Mapping Template</a>
	</div><br>
	 
	<div class="form-group" style="left: 15px;position: relative;">
		<label>
			<span>File Upload</span>
			<input id="name" type="file" name="sel_file" size="150" placeholder="Your Full Name" />
			<p class="help-block" style="margin-top: 16px;">Only Import Excel/CSV File.</p>
		</label>
	</div>
	<input type="Hidden" name="aname" value="Asset_file" id="aname">
	<input style="left: 15px;position: relative;" type="submit" class="btn btn-success"  name="submit" 
				value="Upload">
</form>
<br>
<script>
function back_ctc()
{
 sim_mapping();
}
</script>
<script>
		 $(document).ready(function(){  
		
		$("form[name='fupForm']").on("submit", function(ev) {
		 ev.preventDefault();
		var formData = new FormData(this);	  
           $.ajax({  
                url: 'qvision/Recruitment/sim_mapping/insert_sim_map.php',
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
				processData: false,
                success:function(data)  
                {  
                    alert('Sim Added Successfully'); 
				  sim_mapping();
                }  
           });  
      });  
	   });
</script>




	


