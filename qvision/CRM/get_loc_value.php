<?php
include("../../connect.php");

$company_value=$_REQUEST['comval'];
//echo $company_value;


?>

<select name="location" id="location" >
<option value="">Select Location</option>

<?php

		$query =$con->query("SELECT a.id,b.location,a.org_name,a.status,a.flow,b.client_id,b.status FROM new_client_master a left join new_plant_master b on (a.id=b.client_id)where a.org_name='$company_value'");
		
  
		while ($row_fetch = $query->fetch())
		{	
		$company=$row_fetch['location'];
		?>
		   <option  value="<?php echo $company;?>"><?php echo $company;?></option>
		<?php
		}
		?>
	