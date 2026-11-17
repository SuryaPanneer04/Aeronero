<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);
header('Content-Type: application/json');

require('../connect.php');

$type = $_REQUEST['type'] ?? '';

try {

    if ($type == 'callSource') {

        $query = $con->prepare("SELECT * FROM calls_master");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'status' => 'success',
            'data' => $row
        ]);
        exit;
    }

    if ($type == 'companyName') {

        $query = $con->prepare(
            "SELECT DISTINCT org_name, id AS org_id FROM new_client_master"
        );
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'status' => 'success',
            'data' => $row
        ]);
        exit;
    }

    if ($type == 'companyDetails') {
        $id = $_REQUEST['org_id'] ?? '';

        if (!empty($id)) {
            $query = $con->prepare(
                "select a.id,a.org_name,a.website,b.client_id,b.it_name,b.location,b.state,b.city,b.it_mob1,b.it_mob2,b.it_mail1,it_mail2,b.address from new_client_master a left join new_plant_master b on (a.id=b.client_id)  where a.id = '$id' "
            );
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode([
                'status' => 'success',
                'data' => $row
            ]);
            exit;
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Company Id Not exits'
            ]);
            exit;
        }
    }

    if ($type == 'service') {
        $id = $_REQUEST['serviceId'] ?? '';

        if (!empty($id)) {
            $query = $con->prepare(
                "SELECT * FROM `product_services` where mapping_id='$id' "
            );
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode([
                'status' => 'success',
                'data' => $row
            ]);
            exit;
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Company Id Not exits'
            ]);
            exit;
        }
    }

    if ($type == 'submit') {
        $userId                  = $_POST['userId'] ?? null;
        $call_type               = $_POST['call_type'] ?? null;
        $call_source             = $_POST['call_source'] ?? null;
        $client_type             = $_POST['cilent_type'] ?? null;
        $company_id              = $_POST['company_id'] ?? null;
        $company_name            = $_POST['company_name'] ?? null;
        $client_name             = $_POST['client_name'] ?? null;
        $contact                 = $_POST['contact'] ?? null;
        $whatsapp                = $_POST['whatsapp'] ?? null;
        $email                   = $_POST['email_id'] ?? null;
        $alternative_email       = $_POST['alternative_email_id'] ?? null;
        $address                 = $_POST['address'] ?? null;
        $website                 = $_POST['website'] ?? null;
        $product                 = $_POST['product_service_id'] ?? null;
        $services                = $_POST['selected_product_service'] ?? null;
        $remark                  = $_POST['remark'] ?? null;

        //feedback values
        $feedback                  = $_POST['feedback'] ?? null;
        $feedback_date             = $_POST['feedback_date'] ?? null;
        $follow_up_date            = $_POST['follow_up_date'] ?? null;

        $imageName = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/Aeronero/qvision/CRM/calls/uploads/";
            // $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/Aeronero/CRM/calls/uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $tmpName = $_FILES["image"]['tmp_name'];
            $original = $_FILES['image']['name'];

            //extension
            $ext = pathinfo($original, PATHINFO_EXTENSION);

            $allowed = ['jpg', 'jpeg', 'png', 'webp'];
            if (!in_array(strtolower($ext), $allowed)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid image format'
                ]);
                exit;
            }
            //unique name
            $imageName = 'IMG_' . time() . '_' . rand(1000, 9999) . "." . $ext;

            //move file
            move_uploaded_file($tmpName, $uploadDir . $imageName);
        }

        if ($type === 'submit') {

            $query = $con->prepare("INSERT INTO crm_calls (
            cust_type,
            call_type,
            client_type,
            client_id,
            client_org,
            client_name,
            contact,
            whatsapp,
            email,
            alternative_mail,
            address,
            website,
            Product,
            services,
            image,
            remarks,
            status,
            created_by,
            created_on
        ) VALUES (
            :cust_type,
            :call_type,
            :client_type,
            :client_id,
            :client_org,
            :client_name,
            :contact,
            :whatsapp,
            :email,
            :alternative_mail,
            :address,
            :website,
            :product,
            :services,
            :image,
            :remarks,
            1,
            :created_by,
            CURDATE()
        )
    ");

            $query->execute([
                ':cust_type'        => $call_type,
                ':call_type'        => $call_source,
                ':client_type'      => $client_type,
                ':client_id'        => $company_id,
                ':client_org'       => $company_name,
                ':client_name'      => $client_name,
                ':contact'          => $contact,
                ':whatsapp'         => $whatsapp,
                ':email'            => $email,
                ':alternative_mail' => $alternative_email,
                ':address'          => $address,
                ':website'          => $website,
                ':product'          => $product,
                ':services'         => $services,
                ':image'            => $imageName,
                ':remarks'          => $remark,
                ':created_by'       => $userId,
            ]);

            $calls_id = $con->lastInsertId();

            $sql11 = $con->prepare("
                INSERT INTO crm_calls_feedback
                (
                    calls_id,
                    feedback,
                    feedback_date,
                    date,
                    created_by,
                    created_on
                )
                VALUES
                (
                    :calls_id,
                    :feedback,
                    :feedback_date,
                    :follow_up_date,
                    :created_by,
                    NOW()
                )
            ");

            $sql11->execute([
                ':calls_id'        => $calls_id,
                ':feedback'        => $feedback,
                ':feedback_date'   => $feedback_date,
                ':follow_up_date'  => $follow_up_date,
                ':created_by'      => $userId ?? 1
            ]);


            echo json_encode([
                'status' => 'success',
                'message' => 'Data Inserted Successfully',
            ]);
            exit;
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Company Id Not exists'
        ]);
        exit;
    }

    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request type'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
