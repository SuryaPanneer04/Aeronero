<?php

class DB_con
{
 function __construct()
 {
//$this->dbh = new pdo ('mysql:host=localhost;dbname=qvision_hrms','root','Best2020Know');

$this->dbh = new pdo ('mysql:host=localhost;dbname=qvision','root','');
//$this->dbh=$con;
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
 }
 public function fetchdata($resource_id)
 {
	 $sql="SELECT d.tittle,r.first_name,r.last_name,r.gender,r.mobile,r.whatsapp,r.mail,r.aadhar_no,r.degree,r.employement_status as employement_status ,r.position,r.year_of_pass,r.company_name,r.year_experience  FROM resource_form_detail r join jobdescription_master d on r.position=d.id where r.id='$resource_id'";
	 
 $result=$this->dbh->query($sql);
 return $result;
 }
 
 public function insert_data($cid,$round_type,$qn,$person,$status)
 {
	 if($qn== " ")
	 {
		$ins="insert into candidate_round_details(candid_id,round_id,person_id) values('$cid','$round_type','$person')";
		$result=$this->dbh->query($sql);
		return $result;
	}
	else
	{
		$ins="insert into candidate_round_details(candid_id,round_id,qn_id) values('$cid','$round_type',$qn)";
	 $result=$this->dbh->query($sql);
		return $result;
	}
	 
 }
 
}
?>