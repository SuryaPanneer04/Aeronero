<?php
require '../../connect.php';
$uploadDir = 'Uploads/';
if(isset($_POST['date']) || isset($_POST['candidate_id']))
{
$date = $_REQUEST['date'];
$Employee_name = $_REQUEST['candidate_id'];
$Customer_name = isset($_REQUEST['Customer_name']) ? $_REQUEST['Customer_name'] : '';
$travel = isset($_REQUEST['travel']) ? $_REQUEST['travel'] : '';
$Location = isset($_REQUEST['Location']) ? $_REQUEST['Location'] : '';
$Purpose = isset($_REQUEST['Purpose']) ? $_REQUEST['Purpose'] : '';
$Amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : '';
$kms = isset($_REQUEST['kms']) ? $_REQUEST['kms'] : '';
$filesArr3 = isset($_FILES['attachfile']) ? $_FILES['attachfile'] : array();
$docTitles = isset($_REQUEST['doc_titles']) ? $_REQUEST['doc_titles'] : array();

$status =1;

$uploadedFiles = array();
$firstFileName = '';
                                  
if(!empty($filesArr3['name'])) {
    foreach($filesArr3['name'] as $key=>$val) {  
        if(!empty($val)){
            $fileName = basename($filesArr3['name'][$key]);  
            $targetFilePath = $uploadDir . $fileName;  
            $docTitle = isset($docTitles[$key]) ? $docTitles[$key] : '';
            
            if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)){  
                $uploadedFiles[] = array('file' => $fileName, 'title' => $docTitle);
                if($firstFileName == '') {
                    $firstFileName = $fileName;
                }
            }
        }
    }
}
			
$sql =$con->query("insert into claim_request(candidate_id,customer_name,travel_type,location,date,purpose,kms,amount,file,status,created_on) values('$Employee_name','$Customer_name','$travel','$Location','$date','$Purpose','$kms','$Amount','$firstFileName','$status',now())");

if($sql) {
    $claim_id = $con->lastInsertId();
    foreach($uploadedFiles as $doc) {
        $docName = $doc['file'];
        $docTitle = $doc['title'];
        $con->query("INSERT INTO claim_document (claim_id, document_title, document_name, created_on) VALUES ('$claim_id', '$docTitle', '$docName', NOW())");
    }
}

}
?>