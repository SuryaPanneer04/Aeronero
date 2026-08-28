<?php
require '../../../connect.php';
require '../../../user.php';
$userrole=$_SESSION['userrole'];

//$staffid=$_REQUEST['id'];
 $emp_sql=$con->query("SELECT *,s.id as id,s.status as status FROM staff_master s left join z_department_master d on s.dep_id=d.id left join site_master sm on s.site=sm.id left join location_master l on s.location=l.id where s.status=1");
 
 /* echo "select * from candidate_form_details c join staff_master s on c.id=s.candid_id join z_department_master z on z.id=s.dep_id where c.id='$candidateid'"; */
//echo "select * from candidate_form_details  where id='$candidateid'";
$data=$sql->fetch();
?>
<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.btn-danger{
	background-color: rgb(237, 93, 0) !important;
    border-color: rgb(237, 93, 0) !important;
	color:black !important;
}
</style>


<div class="card card-primary">
              <div class="card-header">
                
							  <h3 class="card-title"><font size="5">EMPLOYEE DETAIL</font></h3>
		<input type="button" name="back" style="float: right;" id="back" data-toggle="tab" class="btn btn-danger" value="BACK" onclick="go_back()">
              </div>
			  
			  
		
    <form method="POST" enctype="multipart/form-data">
    
    <table class="table table-bordered">
      
        <!--tr>
        <td>Post Applied for:</td>
        <td colspan="5"><input type="text" class="form-control" id="position" name="position" value="<?php echo $data['position'];?>" readonly ></td>
        </tr-->
        <!--tr>
        <td colspan="6"><center><b>Personal Details</b></center></td>
        </tr-->
        <tr>
        <td>Employee Code</td>
        <td colspan="5"><input type="text" class="form-control" id="candidate_code" name="candidate_code" value="<?php echo $data['prefix_code'].$data['emp_code'];?>" readonly></td>
        </tr>
       <tr>
        <td>Name Of The Employee</td>
        <td colspan="5"><input type="text" class="form-control" id="candidate_name" name="candidate_name" value="<?php echo $data['first_name']." ". $data['last_name'];?>" ></td>
        </tr>
       <tr>
        <td>Department</td>
        <td colspan="5">
		<?php 
		$depid=$data['dep_id'];
		if($depid =='')
		{
			?>
			<select class="form-control" name="department" id="department" >
		<?php 
		
		$dep1=$con->query("select * from z_department_master where id='$depid'");
		$fet=$dep1->fetch();
		?>
	<option value="0">---------</option>
	<?php
	$dep=$con->query("select * from z_department_master");
	while($dep_sql_res=$dep->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
	<?php
	}
	?>
	</select>
			<?php 
		}
		else
		{
			?>
		<select class="form-control" name="department" id="department" >
		<?php 
		
		$dep1=$con->query("select * from z_department_master where id='$depid'");
		$fet=$dep1->fetch();
		?>
	<option value="<?php echo $fet['id']; ?>"><?php echo $fet['dept_name']; ?></option>
	<option value="0">---------</option>
	<?php
	$dep=$con->query("select * from z_department_master");
	while($dep_sql_res=$dep->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
	<?php
	}
	?>
	</select>
<?php 	
		}
		?>
		
		
		
		
		</td>
        </tr>
        <tr>
        <td>Division</td>
        <td colspan="5">
		<!--?php
		$did=$data['department'];
		$sel=$con->query("select * from division_master where dep_id='$did'");
		$val=$sel->fetch();		
		?-->
		<!--input type="text" class="form-control" id="division" name="division" value="<?php echo $val['div_name'];?>" readonly-->
		
		<?php 
		$divid=$data['div_id'];
		if($divid !=0)
		{
			?>
		<select class="form-control" name="division" id="division">
			<?php 
		
		$div1=$con->query("select * from division_master where id='$divid'");
		$divs=$div1->fetch();
		?>
		
	<option value="<?php echo $divs['id']; ?>"><?php echo $divs['div_name']; ?></option>
	<option value="0">---------</option>
	<?php
	$div_sql=$con->query("select * from division_master");
	while($div_sql_res=$div_sql->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['div_name']; ?></option>
	<?php
	}
	?>
	</select>
			<?php 
			
		}
		else
		{
			?>
			<select class="form-control" name="division" id="division">
			<?php 
		
		$div1=$con->query("select * from division_master where id='$divid'");
		$divs=$div1->fetch();
		?>		
	<option value="0">---------</option>
	<?php
	$div_sql=$con->query("select * from division_master");
	while($div_sql_res=$div_sql->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['div_name']; ?></option>
	<?php
	}
	?>
	</select>
			<?php 
		}
		?>
		
		
		</td>
        </tr>
        <tr>
        <td>Designation</td>
		<!--?php
		$did=$data['department'];
		$select=$con->query("select * from designation_master where dep_id='$did'");
		$des=$select->fetch();		
		?-->
        <td colspan="5"><!--input type="text" class="form-control" id="designation" name="designation" value="<?php echo $des['designation_name'];?>" readonly-->
		<?php 
		$desid=$data['design_id'];
		if(!empty($desid))
		{
			?>
			<select class="form-control" name="designation" id="designation">
		<?php 
		
		$des1=$con->query("select * from designation_master where id='$desid'");
		$des=$des1->fetch();
		?>
		
	<option value="<?php echo $des['id']; ?>"><?php echo $des['designation_name']; ?></option>
	<option value="0">---------</option>
	<?php
	$div_sql=$con->query("select * from designation_master");
	while($div_sql_res=$div_sql->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['designation_name']; ?></option>
	<?php
	}
	?>
	</select>
			<?php 
		}
		else{
			?>
			<select class="form-control" name="designation" id="designation">
		<?php 
		
		$des1=$con->query("select * from designation_master where id='$desid'");
		$des=$des1->fetch();
		?>
	
	<option value="0">---------</option>
	<?php
	$div_sql=$con->query("select * from designation_master");
	while($div_sql_res=$div_sql->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['designation_name']; ?></option>
	<?php
	}
	?>
	</select>
			<?php 
		}
		?>
		
		
		</td>
		
        </tr>
      <tr>
	  <td>Reporting Person</td>
	  <td colspan="5"><!--input type="text" class="form-control" id="designation" name="designation" value="<?php echo $des['designation_name'];?>" readonly-->
	  <?php 
	  $reportingper_id=$data['reporting_person'];
	  if(!empty($reportingper_id))
	  {
		  ?>
		  <select class="form-control" name="reporting_to" id="reporting_to">
		<?php
	
	$psel=$con->query("select * from staff_master where id='$reportingper_id'");
	
	$pfet=$psel->fetch(PDO::FETCH_ASSOC);
	$person_name=$pfet['emp_name'];
	?>
	
	<option value="<?php  echo $reportingper_id;?>"><?php echo $person_name; ?></option>
	<option value="0">---------</option>
	<?php
	$div_sql=$con->query("select * from staff_master");
	while($div_sql_res=$div_sql->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['emp_name']; ?></option>
	<?php
	}
	?>
	</select>
		  <?php 
	  }
	  else
	  {
		  ?>
		  <select class="form-control" name="reporting_to" id="reporting_to">
		<?php
	
	$psel=$con->query("select * from staff_master where id='$reportingper_id'");
	$pfet=$psel->fetch(PDO::FETCH_ASSOC);
	$person_name=$pfet['emp_name'];
	?>
	<option value="0">---------</option>
	<?php
	$div_sql=$con->query("select * from staff_master");
	while($div_sql_res=$div_sql->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['emp_name']; ?></option>
	<?php
	}
	?>
	</select>
		  <?php 
	  }
		  ?>
		</td>
		
	  </tr>
	  <?php 
	  if($data['site']=="" and $data['location']=="")
	  {
	  ?>
	   <tr>
	  <td>Site</td>
	  <td colspan="5"><!--input type="text" class="form-control" id="designation" name="designation" value="<?php echo $des['designation_name'];?>" readonly-->
		<select class="form-control" name="site" id="site" onchange="get_location(this.value)">
		<?php
	$site=$data['site'];
	$ssel=$con->query("select * from site_master where id='$site'");
	$sfet=$ssel->fetch(PDO::FETCH_ASSOC);
	$site_name=$sfet['site_name'];
	?>
	
	<option value="<?php  echo $site;?>"><?php echo $site_name; ?></option>
	<option value="0">---------</option>
	<?php
	$site_que=$con->query("select * from site_master");
	while($site_fet=$site_que->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $site_fet['id']; ?>"><?php echo $site_fet['site_name']; ?></option>
	<?php
	}
	?>
	</select></td>
	  </tr>
	  <tr id="location_dis">
	  </tr>
	  <?php
	  }
	  else
	  {
		  ?>
		  <tr>
	  <td>Site</td>
	  <td colspan="5"><!--input type="text" class="form-control" id="designation" name="designation" value="<?php echo $des['designation_name'];?>" readonly-->
		<select class="form-control" name="site" id="site" onchange="get_location(this.value)">
		<?php
	$site=$data['site'];
	$ssel=$con->query("select * from site_master where id='$site'");
	$sfet=$ssel->fetch(PDO::FETCH_ASSOC);
	$site_name=$sfet['site_name'];
	?>
	
	<option value="<?php  echo $site;?>"><?php echo $site_name; ?></option>
	<option value="0">---------</option>
	<?php
	$site_que=$con->query("select * from site_master");
	while($site_fet=$site_que->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $site_fet['id']; ?>"><?php echo $site_fet['site_name']; ?></option>
	<?php
	}
	?>
	</select></td>
	  </tr>
	  <tr id="location_dis">
	  <td>Location</td>
	  <td colspan="5"><!--input type="text" class="form-control" id="designation" name="designation" value="<?php echo $des['designation_name'];?>" readonly-->
		<select class="form-control" name="location" id="location" >
		<?php
	
	$lsel=$con->query("select * from location_master where site_id='$site'");
	$lfet=$lsel->fetch(PDO::FETCH_ASSOC);
	$location_name=$lfet['location'];
	$location=$lfet['id'];
	?>
	
	<option value="<?php  echo $location;?>"><?php echo $location_name; ?></option>
	<?php
	$loca_que=$con->query("select * from location_master where site_id ='$site' and id !='$location'");
	while($loca_fet=$loca_que->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $loca_fet['id']; ?>"><?php echo $loca_fet['location']; ?></option>
	<?php
	}
	?>
	</select>
	</td>
	 </tr>
	
		  <?php
	  }
	  ?>
	  <tr>
	  <td>Head Status</td>
	  <?php 
	  $heads=$data['head_status'];
	  if($heads==0)
	  {
		 ?>
		  <td>
	  
	  <input type="radio" name="head_status" id="no" value="0" checked>
	  <label for="no">no</label>
	  </td>
	  <td>
	  <input type="radio" name="head_status" id="yes" value="1">
	  <label for="no">Yes</label>
	  </td>
<?php		 
	  }
	  elseif($heads==1)

	  {
		  ?>
		   <td>
	  
	  <input type="radio" name="head_status" id="no" value="0">
	  <label for="no">no</label>
	  </td>
	  <td>
	  <input type="radio" name="head_status" id="yes" value="1" checked>
	  <label for="no">Yes</label>
	  </td>
		  <?php
		  
	  }	
else
{
	?>
	
	 <td>
	  
	  <input type="radio" name="head_status" id="no" value="0">
	  <label for="no">no</label>
	  </td>
	  <td>
	  <input type="radio" name="head_status" id="yes" value="1" >
	  <label for="no">Yes</label>
	  </td>
	<?php
}
	  ?>
	 
	  </tr>
	  <?php
 $status=$data['status'];	  
	  if($status==1)
	  {
		  ?>
	  <tr>
	    <td>Status </td>	  
	    <td>	  
	  <input type="radio" name="status" id="status" value="1" checked>
	  <label for="Active">Active</label>
	  </td>
	  <td>
	  <input type="radio" name="status" id="status" value="2" >
	  <label for="Inactive">Inactive</label>
	  </td>
	  </tr>
	  <?php
	  }
	  else
	  {
		 ?>
	  <tr>
	    <td>Status </td>	  
	    <td>	  
	  <input type="radio" name="status" id="status" value="1" >
	  <label for="Active">Active</label>
	  </td>
	  <td>
	  <input type="radio" name="status" id="status" value="2" checked>
	  <label for="Inactive">Inactive</label>
	  </td>
	  </tr>
	  <?php  
	  }
	  ?>
        <!--tr>
        <td>Date of Birth:</td>
        <td colspan="5"><input type="date" class="form-control" id="dob" name="dob" value="<?php echo $data['dob'];?>" readonly></td>
        </tr>
        <tr>
        <td>Address Communication:</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address" value="<?php echo $data['address'];?>" readonly ></td>
        </tr-->
       
        
        
     
        <tr>  
        <td colspan="6">
		<input type="hidden" name="cid" id="cid" value="<?php echo $candidateid;?>">
		<input type="button" class="btn btn-danger" style="float:right;" name="save" id="<?php echo $candidateid; ?>"onclick="staff_update(this.id)" value="Update"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
	
	<script>
	function staff_update(v)
	{		
		var cname=$('#candidate_name').val();
		var ccode=$('#candidate_code').val();
		var deprt=$('#department').val();
		var div=$('#division').val();
		var desig=$('#designation').val();
		var reporing=$('#reporting_to').val();
		var site=$('#site').val();
		var location=$('#location').val();
		var cid=$('#cid').val();		
		var radioValue = $("input[name='head_status']:checked").val();
		var status = $("input[name='status']:checked").val();
		//var fdata=$('#form').serialize();
		 $.ajax({
			type:"GET",
			data: "cname=" + cname +"&ccode=" + ccode +"&deprt=" + deprt +"&div=" + div +"&desig=" + desig +"&cid=" + cid +"&reporting=" +reporing+"&head_status=" +radioValue+"&status="+status+"&site="+site+"&location="+location ,
			url:"qvision/recruitment/staff/staff_update.php",
			success:function(data)
			{
				if(data==0)
				{
					alert("upadted successfully");
					staff_list();
				}
				
			}
					
		 })
		
		}
		
		function go_back()
{
	//alert("back");
	staff_list();
}
	</script>
	
	<script>
	function get_location(v)
	{
		$('#hiddend').hide();
		$.ajax({
			
			type:"GET",
			url:"qvision/recruitment/staff/get_location.php?site="+v,
			success:function(data)
			{
				
				$('#location_dis').html(data);
			}
		})
	}
	function change_location(v)
	{
		$.ajax({
			
			type:"GET",
			url:"qvision/recruitment/staff/change_location.php?site="+v,
			success:function(data)
			{
				$('#location_chng').html(data);
			}
		})
	}
	</script>