<?php 
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];

$pathname="crm/calls/Calls.csv";


?>
<!DOCTYPE html>
<html>
<div  class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">Calls List</font></h3>
		 <a onclick="call_back()" style="float: right;" data-toggle="modal" class="btn btn-dark">Back</a>
    </div>

    <div class="card-body">
<body>
  <form action="crm/calls/upload_callsubmit.php" method="POST" enctype="multipart/form-data" style="margin-left: 350px;">
	  <tr>
<td><p><a style="color: #3c8dbc;font-weight: 600;" href="<?php echo "$pathname"?>">Download template</a></p></td>

</tr>


        <p> <input type="file" name="file"  class="form-control"/><p>
		<br>
			<tr>
							<td>
							
							<div>
						<input type="hidden" value="csv" name="file" id="file">
						</div>
								</td>
								</tr>
		<br>
	
         <input type="submit" value="Upload" class="btn btn-success" name="importSubmit" style="    margin-left: 99px;
"/>
      </form>
<!--
<form action="upload.php" method="post" enctype="multipart/form-data">
  Select File to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload File" name="submit">
</form>
-->
</body>
</div>
</div>
</html>

<style>
.form-control[type=file]:not(:disabled):not([readonly]) {
    cursor: pointer;
    width: 40%;
}
</style>

<script>

function call_back()
	
	{
		 calls()

	}
</script>