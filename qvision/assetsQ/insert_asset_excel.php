<?php 
require '../../connect.php';
include("../../user.php");

$userrole=$_SESSION['userrole'];

$user_id =$_SESSION['userid'];



 if(isset($_POST['aname']))
    {
         //$account_type = $_POST['account_type'];
         $fname = $_FILES['sel_file']['name'];
         echo '<center class=green>Uploaded file name is: '.$fname.'</center> ';
         $chk_ext = explode(".",$fname);

         if(strtolower(end($chk_ext)) == "csv")
         {

             $filename = $_FILES['sel_file']['tmp_name'];
           //echo "aaaa";
            $handle = fopen($filename, "r");
			
             fgetcsv($handle); //skip the reading of the first line from the csv file

            $c = 0;
             while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
             {
//echo"bbbb";
//print_r($data);
                  //  $var = $data[3]; // dd.mm.yy
                 //   $data[3] = implode("-", array_reverse(explode(".", $var))); // converted -> yyy-mm-dd
					
					
					$asset=$data[0];
$asset_type=$data[1];
//$prefix=$data[3];
//$ass_no=$data[4];
 $asset_name=$data[2];
//$get_asset_name=$data[5];

$stmt = $con->query("SELECT * FROM assets_master where name='$asset_name'");
$row = $stmt->fetch();
 $aid = $row['id'];
 $prefix = $row['prefix_code'];
$ass_no= '0001';
$brand=$data[3];
$vendor=$data[4];
$pdate=$data[5];
$serial=$data[6];
$config=$data[7];
$Warranty=$data[8];
$hsn_code=$data[9];
$gst_code=$data[9];
$part_no=$data[11];
//$in_hand=$_REQUEST['in_hand'];
//$new=$_REQUEST['new'];
$asset_value=$data[12];
$invoice_no=$data[14];
$location=$data[13];
$invoice=$data[15];
$status='1';
$created_by=$user_id;
$created_on=date('Y-m-d'); 
$ass = $con->query("select a.id as aid,b.description as des,c.hsn_code as hsn,c.id as hsnid from assets_master a join products_description b on (a.id=b.product_id) join products_hsn c on (a.id=c.product_id) where a.name='$ass_name'");

$assfet=$ass->fetch();
$hsn_codee = $assfet['hsn'];
$hsn_id = $assfet['hsn'];
		if($hsn_code == $hsn_codee){
			$hsn_idd = $assfet['id'];
		}else{
			$hsn_idd1 = $hsn_code;
			$con->query("insert into products_hsn (product_id,hsn_code,status,created_on) values ('$aid','$hsn_idd1','1',now())");
			$gst2 = $con->query("select * from products_hsn where product_id='$aid' order by id desc");
$gstt2 = $gst2->fetch();	
$hsn_idd = $gstt2['id'];
		}		
$gst = $con->query("select * from products_gst where product_id='$aid' and product_hsn='$hsn_id'");
$gstt = $gst->fetch();	
$gst_codee = $gstt['gst_code'];
	if($gst_code == $gst_codee){
			$gst_idd = $gstt['id'];
		}else{
			$gst_idd1 = $hsn_code;
			$gst1 = $con->query("select * from products_hsn where product_id='$aid' order by id desc");
$gstt1 = $gst1->fetch();	
$hsn_iddd = $gstt1['id'];
			$con->query("insert into products_gst (product_id,hsn_code,gst_code,status,created_on) values ('$aid','$hsn_iddd','$gst_idd1','1',now())");
			$gst3 = $con->query("select * from products_gst where product_id='$aid' and product_hsn='$hsn_id'");
$gstt3 = $gst3->fetch();	
$gst_idd = $gstt3['id'];
		}	
				//while
$ins=$con->query("insert into assets_form_detail(`asset`, `asset_type`, `prefix`, `asset_no`, `asset_name`, `brand_name`, `vendor_name`, `p_date`, `Serial_no`, `config`, `warranty`, `hsn_code`, `gst_code`, `part_no`, `asset_value`, `location`,`invoice_no`,`invoice`, `status`, `created_by`, `created_on`)values('$asset','$asset_type','$prefix','$ass_no','$asset_name','$brand','$vendor','$pdate','$serial','$config','$Warranty','$hsn_code','$gst_idd','$part_no','$asset_value','$location','$invoice_no','$fname',1,'$user_id',now())");	
		
		echo "insert into assets_form_detail(`asset`, `asset_type`, `prefix`, `asset_no`, `asset_name`, `brand_name`, `vendor_name`, `p_date`, `Serial_no`, `config`, `warranty`, `hsn_code`, `gst_code`, `part_no`, `asset_value`, `location`,`invoice_no`,`invoice`, `status`, `created_by`, `created_on`)values('$asset','$asset_type','$prefix','$ass_no','$asset_name','$brand','$vendor','$pdate','$serial','$config','$Warranty','$hsn_code','$gst_idd','$part_no','$asset_value','$location','$invoice_no','$fname',1,'$user_id',now())";
			exit;
								
             }			
                 fclose($handle);
                 echo "<center class=green>Successfully Imported</center><br/>";


         }//if->csv
            else
            {
                echo "Invalid File";
            }   
			
    }//submit

    ?>