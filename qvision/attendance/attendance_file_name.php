<?php
require('../../connect.php');
?>

<!-- Attendace File for Reference -->

	<form>

<?php 
 $AttfileNames = $con ->query("select month,year,file_name from attendance_files"); 
 while($files_names = $AttfileNames->fetch(PDO::FETCH_ASSOC)){ 
?> 
 <div class="row">
   <div class="col-md-9">
	 <label for="monthYear">Month: <?php echo $files_names['month'].'-'.$files_names['year'];?></label>
	 <label for="filename">==> <a href="qvision/attendance/attendance_files/<?php echo $files_names['file_name']; ?>"> <?php echo $files_names['file_name']; ?> </a>  </label>
   </div>
 </div>

 <?php } ?>

	</form>


<!-- Attendace File for Reference END -->