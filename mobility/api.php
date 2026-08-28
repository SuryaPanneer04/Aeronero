<?php

require 'connect.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

function getClaims($con, $id) {
    
    $claims = array();
    
    $sql = "SELECT a.file as file,a.status as status,a.travel_type as travel_type,a.candidate_id as candid_id,a.kms as kms,a.amount as amount,a.customer_name as customer_name,a.purpose as purpose,a.date as date,a.location as visit_loc FROM claim_request a left JOIN staff_master b on (a.candidate_id=b.candid_id) WHERE a.id='$id'";

    $result = $con->query($sql);
    
    if ($result) {
    $claims = $result->fetchAll(PDO::FETCH_ASSOC);
} else {
    
    $errorInfo = $con->errorInfo();
    throw new Exception("Query failed: " . $errorInfo[2]);
}

    return $claims;
}

if (isset($_GET['action']) && $_GET['action'] === 'getClaims') {
$a = new Connect();
$con = $a->db_connect();
// $rolemaster_id=$_POST('roleid');
	$id=$_POST['userid'];
    $claimsData = getClaims($con, $id);

    // Return the data as JSON
    echo json_encode(array("data" => $claimsData));
}

function getAllClaimsData($con) {
    
    $claims = array();
    
    $sql = "SELECT s.emp_name, c.* FROM claim_request AS c LEFT JOIN staff_master AS s ON c.candidate_id = s.candid_id";

    $result = $con->query($sql);
    
    if ($result) {
    $claims = $result->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Handle query error
    $errorInfo = $con->errorInfo();
    throw new Exception("Query failed: " . $errorInfo[2]);
}

    return $claims;
}

if (isset($_GET['action']) && $_GET['action'] === 'getAllClaimsData') {
$a = new Connect();
$con = $a->db_connect();
// $rolemaster_id=$_POST('roleid');
	
    $allclaimsData = getAllClaimsData($con);

    // Return the data as JSON
    echo json_encode(array("data" => $allclaimsData));
}

if ($_GET["action"] == "addClaims") {
    $a = new Connect();
    $con = $a->db_connect();

    // Get the form data
    $date = date('Y-m-d', strtotime($_POST['date']));
    $employeeName = $_POST['candidate_id'];
    $customerName = $_POST['Customer_name'];
    $travel = $_POST['travel'];
    $location = $_POST['Location'];
    $purpose = $_POST['Purpose'];
    $amount = $_POST['amount'];
    $kms = $_POST['kms'];
    $status = 1;

    // Initialize an empty array to store file names
    $fileNames = [];

    // Upload files
  //  foreach ($_FILES['attachfile']['name'] as $key => $fileName) {
        $file_name = $_FILES['attachfile']['name'];
    $tempname1 = $_FILES["attachfile"]["tmp_name"];
		
        //$targetFilePath = $uploadDir . basename($fileName);
		$folder1 = "../images/" . $file_name;
       
    // Insert data into the database
    $sql_query1 = "INSERT INTO claim_request(candidate_id, customer_name, travel_type, location, date, purpose, kms, amount, file, status, created_on) VALUES ('$employeeName', '$customerName', '$travel', '$location', '$date', '$purpose', '$kms', '$amount', '$file_name', '$status', NOW())";

    if ($con->query($sql_query1)) {
        $msg1 = array('status' => 'success', 'message' => 'Claims Added Successfully');
    } else {
        $msg1 = array('status' => 'error', 'message' => 'Failed to insert data into database: ' . $con->error);
    }
	
	 if (move_uploaded_file($tempname1, $folder1)) {
        $msg2 = "file moved successfully";
    } else {
        $msg2 = "Failed to move file";
    }

    // Output the result as JSON
    echo json_encode($msg1);
}





?>