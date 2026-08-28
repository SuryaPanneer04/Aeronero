<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$user_id =$_SESSION['userid'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
		<style>
.card-primary:not(.card-outline)>.card-header{
background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
.btn-dark{
	background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black !important;
}
</style>
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title"><font size="5">Upload Client Excel</font></h3>
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
</div>


<form enctype="multipart/form-data" method="post" action="/qvisionnew/qvision/masters/client_master/file_upload.php"   role="form">

		<div class="control-group">
			
			
	<br>
 <div class="has-feedback">
	  <a href='qvision/masters/client_master/new_client_master.csv' target="_blank" style="color:blue;">Client Templete</a>
		</div>
 
	<div class="form-group">
	  <label>
        <span>File Upload</span>
        <input id="name" type="file" name="sel_file" size="150" placeholder="Your Full Name" />
		<p class="help-block">Only Excel/CSV File Import.</p>
    </label>
</div>
    <button type="submit" class="btn btn-success" name="submit" value="submit">Upload</button>
	<div id="branch">

			</div>
</form>
<script>
function back_ctc()
{
  $.ajax({
    type:"POST",
    url:"qvision/masters/client_master/client_master.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}

</script>





