<?php
include("../config.php");

if(!$mysqlit){
die("Connection failed:".mysqli_connect_error());
}



 $sql_query =  "SELECT cm.cost_sheet_no,
                        cm.town_city,
                        cm.client_name,
                        cm.designation,
                        cm.mobile_no1,
                        cm.email_id1,
                        (SELECT dept_name 
                            FROM `z_department_master` 
                            WHERE id = cm.department_id) AS dept_name,
                        (SELECT emp_name 
                            FROM `staff_master` 
                            WHERE id = cm.employee_id) AS emp_name

                    FROM `client_master` AS cm 
                    WHERE cm.id = $clientId";
    
    $res = mysqli_query($con, $sql_query);

    $result["status"] = "false";
    $result["status_message"] = "No Entry Found";
    
    while($row = mysqli_fetch_array($res)){
        $result["clientDetails"] = array("address"=>$row["address"],
                                    "city"=>$row["town_city"],
                                    "clientName"=>$row["client_name"],
                                    "designation"=>$row["designation"],
                                    "mobileNo"=>$row["mobile_no1"],
                                    "email"=>$row["email_id1"],
                                    "deptName"=>$row["dept_name"],
                                    "empName"=>$row["emp_name"]
                                );
    }
	
	
	
$sql_query = "SELECT 
a.id as costsheet_id,
a.status as costsheet_status, 
a.cost_sheet_no as costsheet_no,
a.candid_id as quote_approve_id,
e.quote_no as quote_number,
a.*,b.*,c.*,d.*,e.* 
                
left join new_client_master b on(a.candid_id=b.id)
left join product_services c on(a.business_id=c.id)
left join staff_master d on(a.candid_id=d.candid_id)
left join quote_generate e on(a.cost_sheet_no=e.cost_sheet_no)
				
						/*(SELECT dept_name 
                            FROM `z_department_master` 
                            WHERE id = cm.department_id) AS dept_name,
                       
					   (SELECT emp_name 
                            FROM `staff_master` 
                            WHERE id = cm.employee_id) AS emp_name */

                    FROM cost_sheet_entry a
                    WHERE a.status='2' and a.created_by='$candidateid' and e.quote_no!=' ' 
					group by a.cost_sheet_no order by a.id desc";
    
    $res = mysqli_query($con, $sql_query);

    $result["status"] = "false";
    $result["status_message"] = "No Entry Found";
    
/*     while($row = mysqli_fetch_array($res)){
        $result["clientDetails"] = array("address"=>$row["address"],
                                    "city"=>$row["town_city"],
                                    "clientName"=>$row["client_name"],
                                    "designation"=>$row["designation"],
                                    "mobileNo"=>$row["mobile_no1"],
                                    "email"=>$row["email_id1"],
                                    "deptName"=>$row["dept_name"],
                                    "empName"=>$row["emp_name"]
                                );
    } */


 
 
 


	
echo json_encode($result);

?>