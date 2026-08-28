<?php
Session_start();
require('../connect.php');
$ip=$_SERVER['REMOTE_ADDR'];
$username=$_REQUEST['Inputusername'];
$upassword=$_REQUEST['InputPassword'];
$md5password=md5($upassword);
	$res = $con->query("SELECT ass_emp_id,candidate_id,user_id,department,email_id,password,full_name,user_group_code,profile,consultant_id FROM z_user_master where email_id='$username' and status=1");
	
		echo "SELECT ass_emp_id,candidate_id,user_id,department,email_id,password,full_name,user_group_code,profile,consultant_id FROM z_user_master where email_id='$username' and status=1";
	//echo "SELECT ass_emp_id,candidate_id,user_id,department,email_id,password,full_name,user_group_code,profile FROM z_user_master where email_id='$username' and status=1";
	/* echo "SELECT ass_emp_id,candidate_id,user_id,department,email_id,password,full_name,user_group_code,profile FROM z_user_master where email_id='$username' and status=1"; */
	//echo "SELECT user_id,department,email_id,password,full_name,user_group_code,profile FROM z_user_master where email_id='$username' and status=1";
		//echo "Invalid User name or Password";
		$num_of_rows = $res->rowCount();
	if($num_of_rows>0)
	{
		while($row = $res->fetch(PDO::FETCH_ASSOC))
		{
			$password=$row['password'];
			$email_id=$row['email_id'];
			echo"Invalid User name or Password". strlen($email_id);
		if($password==$md5password)
		{
			$_SESSION['username']=$row['email_id'];
			$_SESSION['fullname']=$row['full_name'];
			$_SESSION['profile']=$row['profile'];
			$_SESSION['userrole']=$row['user_group_code'];
			$_SESSION['department_id']=$row['department'];
			$_SESSION['userid']=$row['user_id'];
			$_SESSION['candidateid']=$row['candidate_id'];
			$_SESSION['consultantid']=$row['consultant_id'];
			$_SESSION['assemp_id']=$row['ass_emp_id'];
			$_SESSION['start'] = time();  
			$_SESSION['expire'] = $_SESSION['start'] + (60*5);
				$home_ins=$con->query("insert into z_log_entry(user_id,email_id,logdate,system_ip,time) values('$user_id','$email_id',now(),'$ip',now())");
			header('Location:../index.php');	
		}
		else
		{
			$home_ins=$con->query("insert into z_log_error(email_id,password,ip_address,date,time) values('$email_id','$upassword','$ip',now(),now())");	?>
	<script>
		alert("Password Does Not Matched..");
		window.location='login.php';
	</script>
			<?php
		}
	} 	 
}
else
{
	$sql=$con->query("select * from interview_schedule_detail where status=1 and email_id='$username' ");
	//echo "select * from interview_schedule_detail where status=1 and email_id='$username' ";
	
	$num_rows = $sql->rowCount();
	if($num_rows >0)
	{
		while($row=$sql->fetch())
		{
			$uname=$row['email_id'];
			$password=$row['password'];
			if($password==$md5password)
			{
				$_SESSION['userrole']=$row['user_role'];
				$_SESSION['username']=$row['email_id'];
				$_SESSION['resource_id']=$row['resource_id'];
				$_SESSION['schedule_id']=$row['id'];
				$_SESSION['start'] = time();  
				$_SESSION['expire'] = $_SESSION['start'] + (60*5);
				header('Location:../index.php');	
			}
			else
			{
				?>
	<script>
		alert("Password Does Not Matched..");
		window.location='login.php';
	</script>
			<?php
			}
			
		}
		
		
	}
	
	
	?>
	<!--script>
	alert("User Name Does Not Matched..");
	window.location='login.php';
	</script-->
	<?php
} 
?>