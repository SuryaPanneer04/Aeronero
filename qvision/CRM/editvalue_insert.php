<?php
require '../../connect.php';
require '../../user.php';

$candidateid=$_SESSION['candidateid'];
$user_id =$_SESSION['userid'];

$clientidd = $_REQUEST['clientidd'];
    //$enquiry_id=$_REQUEST['enquiry_id'];
    $cusid = $_REQUEST['cus_id'];
   /// $feedbacks = $_REQUEST['feedback'];
    //$dates = $_REQUEST['date'];

    // Your other form fields
    $cus_code = $_REQUEST['cus_code'];
    $client_code = $_REQUEST['client_code'];
    $txt_org_name = $_REQUEST['txt_org_name'];
    $client_type = $_REQUEST['client_type'];
    $txt_website = $_REQUEST['txt_website'];
    $Location = $_REQUEST['Location'];


  /*  $statename_get = $_REQUEST['statename'];
   
$qra=$con->prepare("SELECT id,statename FROM states where statename ='$statename_get'"); 

    $qra->execute(); 
    $qrya = $qra->fetch();
$statename=$qrya['id'];



$city_1_get = $_REQUEST['city_name'];

$qrc=$con->prepare("SELECT id,city_name FROM cities where city_name ='$city_1_get'"); 

					$qrc->execute(); 
					$qryc = $qrc->fetch();

$city_1=$qeyc['id'];*/


    $txt_gst_no = $_REQUEST['txt_gst_no'];
    $txt_pan_no_1 = $_REQUEST['txt_pan_no_1'];
    $txt_address_1 = $_REQUEST['txt_address_1'];
    //$txt_client_name = $_REQUEST['txt_client_name'];
    //$txt_client_desig = $_REQUEST['txt_client_desig'];
    $txt_mobile1 = $_REQUEST['txt_mobile1'];
    $txt_mobile2 = $_REQUEST['txt_mobile2'];
    $txt_mail_id1 = $_REQUEST['txt_mail_id1'];
    $txt_mail_id2 = $_REQUEST['txt_mail_id2'];
    $txt_area_1 = $_REQUEST['txt_area_1'];
    $txt_pincode_1 = $_REQUEST['txt_pincode_1'];
    $txt_client_name_1 = $_REQUEST['txt_client_name_1'];
    $txt_client_desig_1 = $_REQUEST['txt_client_desig_1'];
    $txt_mobileone_1 = $_REQUEST['txt_mobileone_1'];
    $txt_mobiletwo_1 = $_REQUEST['txt_mobiletwo_1'];
    $txt_mail_idone_1 = $_REQUEST['txt_mail_idone_1'];
    $txt_mail_idtwo_1 = $_REQUEST['txt_mail_idtwo_1'];
    $txt_landno_1 = $_REQUEST['txt_landno_1'];
    $pur_name_1 = $_REQUEST['pur_name_1'];
    $pur_designation_1 = $_REQUEST['pur_designation_1'];
    $pur_contact_1 = $_REQUEST['pur_contact_1'];
    $pur_mail_1 = $_REQUEST['pur_mail_1'];
    $fin_name_1 = $_REQUEST['fin_name_1'];
    $fin_designation_1 = $_REQUEST['fin_designation_1'];
    $fin_contact_1 = $_REQUEST['fin_contact_1'];
    $fin_mail_1 = $_REQUEST['fin_mail_1'];
    $Product = $_REQUEST['Product'];
    $services = $_REQUEST['services'];
    $sale_person = $_REQUEST['sale_person'];

  
    $sql=$con->query("UPDATE `new_plant_master` SET  `mobile1`='$txt_mobile1',`mobile2`='$txt_mobile2',`email1`='$txt_mail_id1',`email2`='$txt_mail_id2',`location`='$Location',`gst_no`='$txt_gst_no',`pan_no`='$txt_pan_no_1',`address`='$txt_address_1',`area`='$txt_area_1',`pincode`='$txt_pincode_1',`it_name`='$txt_client_name_1',`it_designation`='$txt_client_desig_1',`it_mob1`='$txt_mobileone_1',`it_mob2`='$txt_mobiletwo_1',`it_mail1`='$txt_mail_idone_1',`it_mail2`='$txt_mail_idtwo_1',`it_landno`='$txt_landno_1',`pur_name`='$pur_name_1',`pur_designation`='$pur_designation_1',`pur_contact`='$pur_contact_1',`pur_mail`='$pur_mail_1',`fin_name`='$fin_name_1',`fin_designation`='$fin_designation_1',`fin_contact`='$fin_contact_1',`fin_mail`='$fin_mail_1',`modified_by`='$candidateid',`modified_on`=now() WHERE client_id='$clientidd'");

   $sql2=$con->query("UPDATE `new_client_master` SET `website`='$txt_website',`modified_by`='$candidateid',`modified_on`=now() WHERE id='$clientidd'");

  // $enqsql=$con->query("UPDATE `enquiry` SET status='3' WHERE id='$enquiry_id'");
  
if($sql)
{
echo 0;
}

?>
