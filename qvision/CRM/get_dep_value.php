<?php
include("../../connect.php");

$depart=$_REQUEST['depart'];

$company_name=$_REQUEST['company_name'];



?>



<?php
/* $stmt = $con->prepare("SELECT COUNT(*) as count FROM time_sheet where staff_id='$id' and date='$date'");
	//echo "SELECT COUNT(*) FROM time_sheet where staff_id='$id' and date='$date'";
	$stmt->execute(); 
     $row = $stmt->fetch();
	 $count=$row['count']; */
	$stmt = $con->prepare("SELECT a.client_department,a.client_id,b.id,b.org_name,COUNT(*) as count FROM enquiry a left join new_client_master b on (a.client_id=b.id) where a.Location='$depart' and b.org_name='$company_name'");
	
	/* echo "SELECT a.client_department,a.client_id,b.id,b.org_name,COUNT(*) as count FROM enquiry a left join new_client_master b on (a.client_id=b.id) where a.Location='$depart' and b.org_name='$company_name'"; */
	     $stmt->execute(); 
		 $row1 = $stmt->fetch();
	      $count=$row1['count'];

		if($count==0)
		{

			?>
		<option value="">Choose Client Department</option>
						<option value="1">IT Department</option>
						<option value="2">Purchase Department</option>
						<option value="3">Finance Department</option>		
						<option value="4">Others</option>		
		<?php	
		}else{
						
		$query =$con->prepare("SELECT a.client_department,a.client_id,b.id,b.org_name FROM enquiry a left join new_client_master b on (a.client_id=b.id) where a.Location='$depart' and b.org_name='$company_name'");
		
	  /* echo "SELECT a.client_department,a.client_id,b.id,b.org_name FROM enquiry a left join new_client_master b on (a.client_id=b.id) where a.Location='$depart' and b.org_name='$company_name'"; */
 
		
//echo "SELECT client_department FROM enquiry where client_department='$depart'";
		$query->execute(); 
		 $row_fetch = $query->fetch();					  

		
		$department_value=$row_fetch['client_department'];

		
		if($department_value==1)
		{ 
	$department="IT Department";
		}elseif($department_value==2)
		{ 
	$department="Purchase Department";
		}elseif($department_value==3)
		{ 
	$department="Finance Department";
		}elseif($department_value==4)
		{
			$department="Others";
		}else{
		$department="";	
		}

		?>
		   <option  value="<?php echo $department;?>"><?php echo $department;?></option>
 	
		<?php	
		}
		?>