<?php 
require '../../config.php';
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
					
					
					$provider_name=$data[1];
					$phone_no=$data[2];									
					$activation_date=date($data[3]);
					$activation_dates=date('Y-m-d',strtotime($activation_date));
					$status=$data[4];
 
				//while
$ins=$con->query("insert into sim_master(`provider_name`, `phone_no`, `activation_date`, `status`,`created_by`, `created_on`)values('$provider_name','$phone_no','$activation_dates','$status','$user_id',now())");	
		
		
								
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