<?php
require '../../connect.php';
include('../../user.php');
$userid=$_SESSION['userid'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Try to load PHPMailer gracefully to avoid case-sensitivity issues on Linux
if (file_exists('../../PHPMailer/src/Exception.php')) {
    require '../../PHPMailer/src/Exception.php';
    require '../../PHPMailer/src/PHPMailer.php';
    require '../../PHPMailer/src/SMTP.php';
} elseif (file_exists('../../phpmailer/src/Exception.php')) {
    require '../../phpmailer/src/Exception.php';
    require '../../phpmailer/src/PHPMailer.php';
    require '../../phpmailer/src/SMTP.php';
}

//Candidate Details
$first_name = $_REQUEST['first_name'];
$last_name = $_REQUEST['last_name'];
$gender = $_REQUEST['gender'];
$phone = $_REQUEST['phone'];
$a_phone = $_REQUEST['a_phone'];
$mail = $_REQUEST['mail'];
//echo $mail.'maillerrr';
$adharnumber = $_REQUEST['adharnumber'];
$educationalDetails = $_REQUEST['educationalDetails'];
$EmployeeStatus = $_REQUEST['EmployeeStatus'];
$year_of_pass = $_REQUEST['year_of_pass'];
$companyname = $_REQUEST['companyname'];
$no_of_year = $_REQUEST['no_of_year'];

//salary computation data
$m_grossfixed=$_REQUEST['m_grossfixednew'];
$p_grossfixed=$_REQUEST['p_grossfixednew'];
$mbasic=$_REQUEST['mbasicnew'];
$pbasic=$_REQUEST['pbasicnew'];
$mHRA=$_REQUEST['mHRAnew'];
$pHRA=$_REQUEST['pHRAnew'];
$mOtherallowances=$_REQUEST['mOtherallowancesnew'];
$pOtherallowances=$_REQUEST['pOtherallowancesnew'];
$mSiteallowances=$_REQUEST['mSiteallowancesnew'];
$pSiteallowances=$_REQUEST['pSiteallowancesnew'];
$mAdvance=$_REQUEST['mAdvancenew'];
$pAdvance=$_REQUEST['pAdvancenew'];
$mEmployee_PF=$_REQUEST['mEmployee_PFnew'];
$pEmployee_PF=$_REQUEST['pEmployee_PFnew'];
$mEmployee_ESIC=$_REQUEST['mEmployee_ESICnew'];
$pEmployee_ESIC=$_REQUEST['pEmployee_ESICnew'];
$mProfessional_Tax=$_REQUEST['mProfessional_Taxnew'];
$pProfessional_Tax=$_REQUEST['pProfessional_Taxnew'];
$mTDS=$_REQUEST['mTDSnew'];
$pTDS=$_REQUEST['pTDSnew'];
$mClubEE=$_REQUEST['mClubEEnew'];
$pClubEE=$_REQUEST['pClubEEnew'];
$mTotal_Deductions_Employee=$_REQUEST['mTotal_Deductions_Employeenew'];
$pTotal_Deductions_Employee=$_REQUEST['pTotal_Deductions_Employeenew'];
$mnetsalary=$_REQUEST['mnetsalarynew'];
$pnetsalary=$_REQUEST['Pnetsalaryneww'];
$mEmployer_PF=$_REQUEST['mEmployer_PFnew'];
$pEmployer_PF=$_REQUEST['pEmployer_PFnew'];
$mEmployer_ESIC=$_REQUEST['mEmployer_ESICnew'];
$pEmployer_ESIC=$_REQUEST['pEmployer_ESICnew'];
$mClubER=$_REQUEST['mClubERnew'];
$pClubER=$_REQUEST['pClubERnew'];
$mTotal_deduction_Employer=$_REQUEST['mTotal_deduction_Employernew'];
$pTotal_deduction_Employer=$_REQUEST['pTotal_deduction_Employernew'];
$m_fixed=$_REQUEST['m_fixednew'];
$p_fixed=$_REQUEST['p_fixednew'];
$status=1;

$candid_name=$_REQUEST['first_name'].' '.$_REQUEST['last_name'];
$dep_id=$_REQUEST['tech_department'];

$candidate_id=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
$candidateid=$_REQUEST['id'];
$approved_desig=$_REQUEST['desig'];
$approved_ctc=$_REQUEST['ctc'];
$design_mail=$_REQUEST['designation'];
$reporting_person=$_REQUEST['report_person'];

$join_date = isset($_REQUEST['jdate']) ? $_REQUEST['jdate'] : '';
if(!empty($join_date)){
    $date=date_create($join_date);
    $joining_date=date_format($date,"d/m/Y");
} else {
    $joining_date = "";
}

$phone = $_REQUEST['phone'];
//$z_phone = substr($phone, 4);
$password = md5("Welcome@123");

if($EmployeeStatus == 'Fresher'){
$ins=$con->query("UPDATE `candidate_form_details` SET `first_name`='$first_name',`last_name`='$last_name',`gender`='$gender',`phone`='$phone',`alternative_phone`='$a_phone',`mail`='$mail',`adharnumber`='$adharnumber',`educationalDetails`='$educationalDetails',`EmployeeStatus`='$EmployeeStatus',`year_of_pass`='$year_of_pass',`companyname`=null,`no_of_year`=null,`final_designation`='$approved_desig',`approved_ctc`='$approved_ctc',`joining_date`='$join_date',status='19' WHERE id='$candidateid' ");
  
} else{
	$ins=$con->query("UPDATE `candidate_form_details` SET `first_name`='$first_name',`last_name`='$last_name',`gender`='$gender',`phone`='$phone',`alternative_phone`='$a_phone',`mail`='$mail',`adharnumber`='$adharnumber',`educationalDetails`='$educationalDetails',`EmployeeStatus`='$EmployeeStatus',`year_of_pass`=null,`companyname`='$companyname',`no_of_year`='$no_of_year',`final_designation`='$approved_desig',`approved_ctc`='$approved_ctc',`joining_date`='$join_date',status='19' WHERE id='$candidateid' ");

}

//$sal_structure =$con->query("INSERT INTO `joining_detail_sal_structure`(`candid_id`,`fixedgross_month`,`fixedgross_annum`, `basic_month`, `basic_annum`, `HRA_month`, `HRA_annum`, `otherallowances_permonth`, `otherallowances_perannum`, `siteallowance_permonth`, `siteallowance_perannum`, `advancebonus_permonth`, `advancebonus_perannum`, `employee_PF_month`, `employee_PF_annum`, `employee_ESIC_month`, `employee_ESIC_annum`,`professionaltax_permonth`,`professionaltax_perannum`,`tds_permonth`,`tds_perannum`,`clubee_permonth`,`clubee_perannum`, `totaldeduction_employee_permonth`, `totaldeduction_employee_perannum`, `netsalary_month`, `netsalary_annum`, `employer_PF_month`, `employer_PF_annum`, `employer_ESIC_month`, `employer_ESIC_annum`, `cluber_month`, `cluber_annum`, `total_Deductions_Employer_month`, `total_Deductions_Employer_annum`, `fixed_month`, `fixed_annum`, `status`, `created_by`, `created_on`) 
///VALUES ('$candidateid','$m_grossfixed','$p_grossfixed','$mbasic','$pbasic','$mHRA','$pHRA','$mOtherallowances','$pOtherallowances','$mSiteallowances','$pSiteallowances','$mAdvance','$pAdvance','$mEmployee_PF','$pEmployee_PF','$mEmployee_ESIC','$pEmployee_ESIC','$mProfessional_Tax','$pProfessional_Tax','$mTDS','$pTDS','$mClubEE','$pClubEE','$mTotal_Deductions_Employee','$pTotal_Deductions_Employee','$mnetsalary','$pnetsalary','$mEmployer_PF','$pEmployer_PF','$mEmployer_ESIC','$pEmployer_ESIC','$mClubER','$pClubER','$mTotal_deduction_Employer','$pTotal_deduction_Employer','$p_fixed','$m_fixed','$status','$candidate_id',now())");





$sal_structure =$con->query("INSERT INTO `joining_detail_sal_structure`(`id`, `candid_id`, `fixedgross_month`, `fixedgross_annum`, `basic_month`, `basic_annum`, `HRA_month`, `HRA_annum`, `otherallowances_permonth`, `otherallowances_perannum`, `siteallowance_permonth`, `siteallowance_perannum`, `advancebonus_permonth`, `advancebonus_perannum`, `employee_PF_month`, `employee_PF_annum`, `employee_ESIC_month`, `employee_ESIC_annum`, `professionaltax_permonth`, `professionaltax_perannum`, `tds_permonth`, `tds_perannum`, `clubee_permonth`, `clubee_perannum`, `totaldeduction_employee_permonth`, `totaldeduction_employee_perannum`, `netsalary_month`, `netsalary_annum`, `employer_PF_month`, `employer_PF_annum`, `employer_ESIC_month`, `employer_ESIC_annum`, `cluber_month`, `cluber_annum`, `total_Deductions_Employer_month`, `total_Deductions_Employer_annum`, `fixed_month`, `fixed_annum`, `status`, `created_by`, `created_on`) VALUES (NULL,'$candidateid','$m_grossfixed','$p_grossfixed','$mbasic','$pbasic','$mHRA','$pHRA','$mOtherallowances','$pOtherallowances','$mSiteallowances','$pSiteallowances','$mAdvance','$pAdvance','$mEmployee_PF','$pEmployee_PF','$mEmployee_ESIC','$pEmployee_ESIC','$mProfessional_Tax','$pProfessional_Tax','$mTDS','$pTDS','$mClubEE','$pClubEE','$mTotal_Deductions_Employee','$pTotal_Deductions_Employee','$mnetsalary','$pnetsalary','$mEmployer_PF','$pEmployer_PF','$mEmployer_ESIC','$pEmployer_ESIC','$mClubER','$pClubER','$mTotal_deduction_Employer','$pTotal_deduction_Employer','$m_fixed','$p_fixed',1,'$userid',now())");

if(!$sal_structure) {
    file_put_contents('sal_insert_err.txt', "Error: " . print_r($con->errorInfo(), true));
}



$salary_earnings = $con->query("INSERT INTO salary_monthly_earning(candid_id,emp_name,dep_id,design_id,Special_Allowance, LTA,status) VALUES ('$candidateid','$candid_name','$dep_id','$approved_desig','$mOtherallowances','$mSiteallowances','1')");

$user_id = "ANSPL" . $candidateid;
$upd=$con->query("update z_user_master set user_name='$user_id', password='$password', user_group_code='ROLE-013', department='$dep_id' where candidate_id='$candidateid'");


// $ins=$con->query("update candidate_form_details set final_designation='$approved_desig',approved_ctc='$approved_ctc',joining_date='$join_date',status='19' where id='$candidateid'");

if($ins)
{
	echo 1;
}
else
{
	echo 0;
}

$number = floatval($approved_ctc);
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen((string)$no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  $final_res= $result . "rupees  ";
?>

<?php 
  $staff_query= $con->query("select c.*,d.designation_name as position,u.user_name,u.password,u.full_name as fullname from candidate_form_details c left join designation_master d on c.position=d.id join z_user_master u on c.id=u.candidate_id where c.id='$candidateid'"); 
   
   if ($staff_query) {
       $row = $staff_query->fetch();	
       $FULLNAME       = isset($row['fullname']) ? $row['fullname'] : '';
       $SENDMAIL       = isset($row['mail']) ? $row['mail'] : '';
       $position       = isset($row['position']) ? $row['position'] : '';
       $USERNAME       = isset($row['user_name']) ? $row['user_name'] : '';
   } else {
       $FULLNAME       = '';
       $SENDMAIL       = '';
       $position       = '';
       $USERNAME       = '';
   }
   $PASSWORD       = "Welcome@123";
   
   //$iterdate=date('Y-m-d H:i:s', strtotime('interview_date'));
 // echo  $iterdate= date("F j, Y, g:i a", $interview_date);
  //echo "hii".$interview_date;
  
  //$dt = new DateTime($joining_date);
  //$joindate=$dt->format('M j Y');

$mail = new PHPMailer;
$mail->SMTPDebug = 0; 
$mail->Mailer = "smtp";
$mail->IsSMTP(true); 
$mail->Port = 587;
$mail->Host = 'smtp.gmail.com';        
$mail->SMTPAuth = true;                              // Enable SMTP authentication
$mail->Username = 'suryabluebase@gmail.com';
$mail->Password = 'kdhp xnpd kxnr tagx';             // SMTP password
$mail->SMTPSecure = 'tls';                           // Enable encryption
$mail->SMTPOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
		'allow_self_signed' => true,
    ]
];
$mail->From = 'suryabluebase@gmail.com';		//Sets the From email address for the message
$mail->FromName = 'Quadsel Systems Pvt Ltd';
$mail->AddAddress($SENDMAIL, $FULLNAME);		//Adds a "To" address
// $mail->AddCC('ENTER MAIL ID');         //Adds a "CC" address.
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML


	 			
	$mail->Subject = 'Provisional Offer Letter';			//Sets the Subject of the message
	//An HTML or plain text message body

	
	$mail->Body = "<div style='color: #178ae3;'>Dear \r\n".$FULLNAME.""." ,"."\r\n\r\n<br/><br/>";	
	$mail->Body .= "Congratulations! We are pleased to offer you the full-time position of 
                   ". $design_mail ."   at Quadsel  Systems with a start date of ". $joining_date ."
				   Old No.80,New No.118,  Anna Salai,Manikkam Lane,Guindy,Chennai-600 032."."\r\n\r\n<br/><br/>";	
	
	 $mail->Body .= "You will be reporting directly to Mr.". $reporting_person .". The annual starting
                    salary for this position is Rs.".$approved_ctc." /- to be paid on an annual basis.
                    Please find attached the detailed salary computation for your reference.
                    We will provide you with the offer letter soft copy in your presence
                    while joining the organization."."\r\n\r\n<br/><br/>";
	
	$mail->Body .= "As an employee of Quadsel  Systems Pvt Ltd , you are also eligible for our
                    benefits program, which includes medical insurance/Gratuity/Life
                    Insurance/ PF, etc., and other benefits which will be described in more
                    in detail in the employee handbook."."\r\n\r\n<br/><br/>";	
					
	$mail->Body .= "Please confirm your acceptance of this offer by replying back on this
                    mail."."\r\n\r\n<br/><br/>";
					
	$mail->Body .= "We are excited to have you join our team! If you have any questions,
                    please feel free to reach out."."\r\n\r\n<br/><br/>";	
	
    $mail->Body .= "Note: Please Upload the below-listed documents soft copy via the link before
                    joining and carry the hardcopy xerox for the submission,The credentials are given below to login."."\r\n\r\n<br/><br/>";	
	
    $mail->Body .= " * 10/12/Graduation certificates."."\r\n\r\n<br/>"."
                     * Previous Organization experience certificate (Discard if you are fresher)"."\r\n\r\n<br/>"."
                     * Offer letter of your previous Organization. (Discard if you are fresher)"."\r\n\r\n<br/>"."
                     * 3 Months Payslip (Discard if you are fresher)"."\r\n\r\n<br/>"."
                     * Aadhar Card/Pan card/Voter Id."."\r\n\r\n<br/>"."
                     * 3 Passport Size Latest Photocopy."."\r\n\r\n<br/>"."
                     * Driving License"."\r\n\r\n<br/><br/>";	
	
	
	$mail->Body .= "<button class='btn btn-primary'><a href='http://103.180.186.112/qvision/index.php'>Login Portal</a></button>"."\r\n\r\n<br/><br/>";	
	$mail->Body .= "<table class='table table-hover table-bordered'  border=1 style='margin: 15px 0 98px 0px!important;'>   
			<thead style='color:#0033FF;'>					
			<tr style='text-align:center;'>			
			<th style='font-size:15px;'>#</th>
			<th style='font-size:15px;'>User Name</th>
			<th style='font-size:15px;'>Password</th> 
			
			</tr>	
			</thead>"; 
	$mail->Body .="<tr>
				   <td>" . '1'."</td>
				   <td>" . $USERNAME."</td>
				   <td>" . $PASSWORD ."</td> 
				  </tr> </table>"."\r\n\r\n<br/>";
 	
	$mail->Body .= '<table class="table table-bordered" border=1>
<tr> 
	<th colspan="4" style="background: darkgray;"><center>  Components </center></th>
	<th colspan="1" style="background: darkgray;"> <center> Per Month</center></th>
	<th colspan="1" style="background: darkgray;"> <center> Per Annum </center></th>
</tr>
<tr>
	<td colspan="4">Fixed Gross Salary </td>
	<td colspan="1">'.$m_grossfixed.' </td>
	<td colspan="1">'.$p_grossfixed.' </td>
</tr>
<tr>
	<td colspan="4">Basic </td>
	<td colspan="1">'.$mbasic.' </td>
	<td colspan="1">'.$pbasic.' </td>
</tr>

<tr>
	<td colspan="4"> HRA</td>
	<td colspan="1">'.$mHRA.' </td>
	<td colspan="1">'.$pHRA.'</td>
</tr>

<tr>
	<td colspan="4">Other Allowances </td>
	<td colspan="1">'.$mOtherallowances.' </td>
	<td colspan="1">'.$pOtherallowances.' </td>
</tr>
<tr>
	<td colspan="4"> Site Allowances</td>
	<td colspan="1">'.$mSiteallowances.' </td>
	<td colspan="1">'.$pSiteallowances.'</td>
</tr>
<tr>
	<td colspan="4">Advance Bonus </td>
	<td colspan="1">'.$mAdvance.' </td>
	<td colspan="1">'.$pAdvance.' </td>
</tr>
<tr>
	<td colspan="4">Employee PF </td>
	<td colspan="1">'.$mEmployee_PF.'</td>
	<td colspan="1">'.$pEmployee_PF.'</td>
</tr>
<tr>
	<td colspan="4">Employee ESIC</td>
	<td colspan="1">'.$mEmployee_ESIC.'</td>
	<td colspan="1">'.$pEmployee_ESIC.'</td>
</tr>
<tr>
	<td colspan="4">Professional Tax</td>
	<td colspan="1">'.$mProfessional_Tax.'</td>
	<td colspan="1">'.$pProfessional_Tax.'</td>
</tr>

<tr>
	<td colspan="4">TDS</td>
	<td colspan="1">'.$mTDS.'</td>
	<td colspan="1">'.$pTDS.'</td>
</tr>
<tr>
	<td colspan="4">Club EE</td>
	<td colspan="1">'.$mClubEE.'</td>
	<td colspan="1">'.$pClubEE.'</td>
</tr>

<tr>
	<td colspan="4">Total Deductions Employee</td>
	<td colspan="1">'.$mTotal_Deductions_Employee.'</td>
	<td colspan="1">'.$pTotal_Deductions_Employee.'</td>
</tr>
<tr>
	<td colspan="4">Net Salary</td>
	<td colspan="1">'.$mnetsalary.'</td>
	<td colspan="1">'.$pnetsalary.'</td>
</tr>
<tr>
	<td colspan="4">Employer PF</td>
	<td colspan="1">'.$mEmployer_PF.'</td>
	<td colspan="1">'.$pEmployer_PF.'</td>
</tr>
<tr>
	<td colspan="4">Employer ESIC</td>
	<td colspan="1">'.$mEmployer_ESIC.'</td>
	<td colspan="1">'.$pEmployer_ESIC.'</td>
</tr>
<tr>
	<td colspan="4">Total Deductions Employer</td>
	<td colspan="1">'.$mTotal_deduction_Employer.'</td>
	<td colspan="1">'.$pTotal_deduction_Employer.'</td>
</tr>

<tr>
	<td colspan="4">Fixed</td>
	<td colspan="1">'.$m_fixed.'</td>
	<td colspan="1">'.$p_fixed.'</td>
</tr>
</table>'.'<br/><br/>';

	
	$mail->Body   .= "Thanks & Regards,"."\r\n\r\n<br/>";
	$mail->Body   .= "HR DEPARTMENT"."\r\n\r\n<br/>"."
	                  Human Resource"."\r\n\r\n<br/>"."
                      Quadsel  Systems Pvt Ltd.,"."\r\n\r\n<br/>"."
					  An ISO 27001:2013 Certified Company| ISO 9001:2015 CERTIFIED"."\r\n\r\n<br/>"."
					  Old No.80,New No.118,  Anna Salai,Manikkam Lane,Guindy,Chennai-600 032."."\r\n\r\n<br/>"."
					  Landline:044 2250 2277 "."\r\n\r\n<br/>"."
					  | enquiry@quadsel.in| URL: www.quadsel.in"."\r\n\r\n<br/></div>";
					
	
	if(!$mail->send()) {
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
	   echo "0";
   } 
    else {
        $message = '<label class="text-success">UserName and PassWord has been send successfully...</label>';
		echo $message;
	   // $update_query = $con->query("update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'");  
		//echo "update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'";
	
	} 
?>