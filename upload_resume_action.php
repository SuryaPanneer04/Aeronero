<?php
session_start();
require "connect.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cand_form_id'])) {
    $cand_form_id = $_POST['cand_form_id'];
    
    $action = isset($_POST['action']) ? $_POST['action'] : 'upload';
    if ($action === 'delete') {
        try {
            // Get resource_id from candidate_form_details
            $stmt1 = $con->prepare("SELECT resource_id FROM candidate_form_details WHERE id = :cand_form_id");
            $stmt1->bindParam(':cand_form_id', $cand_form_id, PDO::PARAM_INT);
            $stmt1->execute();
            $row = $stmt1->fetch(PDO::FETCH_ASSOC);

            if ($row && !empty($row['resource_id'])) {
                $resource_id = $row['resource_id'];

                $stmt2 = $con->prepare("SELECT resume FROM resource_form_detail WHERE id = :resource_id");
                $stmt2->execute([':resource_id' => $resource_id]);
                $resRow = $stmt2->fetch(PDO::FETCH_ASSOC);

                if ($resRow && !empty($resRow['resume'])) {
                    $file_name = $resRow['resume'];
                    $file_path = "qvision/Resource/Resource_form/resume_upload/" . $file_name;

                    if (file_exists($file_path)) {
                        unlink($file_path); 
                    }

                    $stmt3 = $con->prepare("UPDATE resource_form_detail SET resume = NULL WHERE id = :resource_id");
                    $stmt3->bindParam(':resource_id', $resource_id, PDO::PARAM_INT);
                    
                    if ($stmt3->execute()) {
                        echo "success";
                    } else {
                        echo "Failed to clear resume from database.";
                    }
                } else {
                    echo "success";
                }
            } else {
                echo "Candidate Resource ID not found.";
            }
        } catch (PDOException $e) {
            echo "DB Error: " . $e->getMessage();
        }
        exit; 
    }
    if ($action === 'upload' && isset($_FILES['resume_file']) && $_FILES['resume_file']['error'] == 0) {
        
        $file_name = $_FILES['resume_file']['name'];
        $file_tmp = $_FILES['resume_file']['tmp_name'];
        
        $clean_file_name = preg_replace("/[^a-zA-Z0-9.]/", "_", $file_name);
        
        $upload_dir = "qvision/Resource/Resource_form/resume_upload/";
        
        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $destination = $upload_dir . $clean_file_name;
        
        if (move_uploaded_file($file_tmp, $destination)) {
            try {
                $stmt1 = $con->prepare("SELECT * FROM candidate_form_details WHERE id = :cand_form_id");
                $stmt1->bindParam(':cand_form_id', $cand_form_id, PDO::PARAM_INT);
                $stmt1->execute();
                $candData = $stmt1->fetch(PDO::FETCH_ASSOC);
                
                $resource_id = ($candData && !empty($candData['resource_id'])) ? $candData['resource_id'] : null;
                $record_exists = false;

                if ($resource_id) {
                    $checkStmt = $con->prepare("SELECT id FROM resource_form_detail WHERE id = :rid");
                    $checkStmt->execute([':rid' => $resource_id]);
                    if ($checkStmt->rowCount() > 0) {
                        $record_exists = true;
                    }
                }
                
                if ($record_exists) {
                    $stmt2 = $con->prepare("UPDATE resource_form_detail SET resume = :resume_name WHERE id = :resource_id");
                    $stmt2->bindParam(':resume_name', $clean_file_name, PDO::PARAM_STR);
                    $stmt2->bindParam(':resource_id', $resource_id, PDO::PARAM_INT);
                    
                    if ($stmt2->execute()) {
                        echo "success"; 
                    } else {
                        echo "Database update failed.";
                    }
                } else {
                    if ($candData) {
                        $client_org = !empty($candData['company_name']) ? $candData['company_name'] : 'Aeronero';
                        $location = $candData['location'];
                        $position = $candData['position'];
                        $fname = $candData['first_name'];
                        $lname = $candData['last_name'];
                        $gender = $candData['gender'];
                        $mobile = $candData['phone'];
                        $email = $candData['mail'];
                        $current_date = date('Y-m-d');
                        $source = 1;

                        $insertQuery = "INSERT INTO resource_form_detail 
                            (source, client_org_name, location, position, first_name, last_name, gender, mobile, mail, date, resume) 
                            VALUES 
                            (:source, :client_org, :loc, :pos, :fname, :lname, :gender, :mob, :email, :cur_date, :resume_name)";

                        $stmt3 = $con->prepare($insertQuery);
                        $stmt3->bindParam(':source', $source, PDO::PARAM_INT);
                        $stmt3->bindParam(':client_org', $client_org);
                        $stmt3->bindParam(':loc', $location);
                        $stmt3->bindParam(':pos', $position);
                        $stmt3->bindParam(':fname', $fname);
                        $stmt3->bindParam(':lname', $lname);
                        $stmt3->bindParam(':gender', $gender);
                        $stmt3->bindParam(':mob', $mobile);
                        $stmt3->bindParam(':email', $email);
                        $stmt3->bindParam(':cur_date', $current_date);
                        $stmt3->bindParam(':resume_name', $clean_file_name);
                    } else {
                        $stmt3 = $con->prepare("INSERT INTO resource_form_detail (resume) VALUES (:resume_name)");
                        $stmt3->bindParam(':resume_name', $clean_file_name, PDO::PARAM_STR);
                    }
                    
                    if ($stmt3->execute()) {
                        $new_resource_id = $con->lastInsertId();
                        
                        $stmt4 = $con->prepare("UPDATE candidate_form_details SET resource_id = :new_resource_id WHERE id = :cand_form_id");
                        $stmt4->bindParam(':new_resource_id', $new_resource_id, PDO::PARAM_INT);
                        $stmt4->bindParam(':cand_form_id', $cand_form_id, PDO::PARAM_INT);
                        
                        if ($stmt4->execute()) {
                            echo "success";
                        } else {
                            echo "Failed to link new resource to candidate.";
                        }
                    } else {
                        echo "Failed to insert new resource record.";
                    }
                }
            } catch (PDOException $e) {
                echo "DB Error: " . $e->getMessage();
            }
        } else {
            echo "Failed to save the file in the directory.";
        }
    } else if ($action === 'upload') {
        echo "No file selected or upload error occurred.";
    }
} else {
    echo "Invalid Request.";
}
?>