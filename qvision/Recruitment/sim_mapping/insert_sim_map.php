<?php 
require '../../../connect.php';
include("../../../user.php");

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
					
					
					$sim=$data[1];
					$sims=$con->query("select id from sim_master where phone_no='$sim'");
					$sim_ids=$sims->fetch();
					$sim_id=$sim_ids['id'];
					$dept_id=$data[2];									
					$status=date($data[3]);
					
 
				//while
			$ins=$con->query("insert into sim_mapping(`sim_id`, `department_id`, `status`,`created_by`, `created_on`)values('$sim_id','$dept_id','$status','$user_id',now())");	
		
		
								
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