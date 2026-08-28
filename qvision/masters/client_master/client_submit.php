<?php
/*
require '../../../connect.php';
Session_start();

?>
<?php




$user_id =$_SESSION['userid'];


	
	 $department_id = $_REQUEST['department_id'];
	 $employee_id   = $_REQUEST['employee_id'];
	 $org_name      = $_REQUEST['org_name'];
	 $org_type      = $_REQUEST['org_type'];
	 $website       = $_REQUEST['website'];
	 $client_code   = $_REQUEST['client_code'];


	 $stmte=$con->prepare("SELECT id as enqury_id FROM enquiry where `enquiry_code` LIKE 'N%' and Company_name='$org_name' order by id desc"); 
					$stmte->execute(); 
					$rowe = $stmte->fetch();
	
$enqid=$rowe['enqury_id'];

	$insert_sql=$con->query("insert into new_client_master(client_code,department_id,employee_id,enquiry_id,org_name,org_type,website,status,flow,created_by,created_on)
	values('$client_code','$department_id','$employee_id','$enqid','$org_name','$org_type','$website','2','2','$user_id',NOW())");
	
	if($insert_sql)
	{
		
		echo "1";
		
	}else{
	echo "2";
	}
	*/
?>

<?php
require '../../../connect.php';

try {
    // Fetch GET parameters
    $department_id = $_GET['department_id'] ?? null;
    $employee_id = $_GET['employee_id'] ?? null;
    $org_name = $_GET['org_name'] ?? null;
    $org_type = $_GET['org_type'] ?? null;
    $website = $_GET['website'] ?? null;
    $client_code = $_GET['client_code'] ?? null;
    $createdby = $_GET['createdby'] ?? null;
    $created_on = $_GET['created_on'] ?? null;

    // Validate required fields
    if (!$department_id || !$employee_id || !$org_name || !$org_type || !$client_code) {
        echo "Error: Missing required fields";
        exit;
    }

    // Insert query
    $stmt = $con->prepare("INSERT INTO new_client_master (department_id, employee_id, client_code, org_name, org_type, website, status, flow, created_by, created_on) VALUES (?, ?, ?, ?, ?, ?, '2', '2', ?, ?)");
    $createdon=date('Y-m-d');

    // print_r($stmt);
    // die();
    
    $stmt->bindParam(1, $department_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $employee_id, PDO::PARAM_INT);
    $stmt->bindParam(3, $client_code, PDO::PARAM_STR);
    $stmt->bindParam(4, $org_name, PDO::PARAM_STR);
    $stmt->bindParam(5, $org_type, PDO::PARAM_INT);
    $stmt->bindParam(6, $website, PDO::PARAM_STR);
    $stmt->bindParam(7, $createdby, PDO::PARAM_INT);
    $stmt->bindParam(8, $createdon, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "1"; // Success
    } else {
        echo "Error: Database insert failed";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage(); // Show error message
}
?>



