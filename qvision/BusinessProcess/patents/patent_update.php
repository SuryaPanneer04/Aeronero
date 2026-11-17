<?php

require '../../../connect.php';

$id = $_POST['id'] ?? '';

if (empty($id)) {

    echo "Invalid Patent ID";
    exit;

}


/*
|--------------------------------------------------------------------------
| GET EXISTING ATTACHMENTS
|--------------------------------------------------------------------------
*/

$stmt = $con->prepare(
    "SELECT attach_document
     FROM patents_master
     WHERE id = :id"
);

$stmt->execute([
    ':id' => $id
]);

$row = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$row) {

    echo "Patent record not found";
    exit;

}


/*
|--------------------------------------------------------------------------
| Decode existing attachments
|--------------------------------------------------------------------------
*/

$attachments = [];


if (!empty($row['attach_document'])) {

    $decoded =
        json_decode(
            $row['attach_document'],
            true
        );


    if (is_array($decoded)) {

        $attachments = $decoded;

    }

}


/*
|--------------------------------------------------------------------------
| ADD NEW EXTERNAL LINKS
|--------------------------------------------------------------------------
|
| New Edit page sends:
|
| patent_links[]
|
*/

if (
    isset($_POST['patent_links']) &&
    is_array($_POST['patent_links'])
) {

    foreach ($_POST['patent_links'] as $link) {

        $link = trim($link);


        if (
            !empty($link) &&
            filter_var($link, FILTER_VALIDATE_URL)
        ) {

            /*
            | Don't add duplicate link.
            */

            if (!in_array($link, $attachments, true)) {

                $attachments[] = $link;

            }

        }

    }

}


/*
|--------------------------------------------------------------------------
| FILE UPLOAD
|--------------------------------------------------------------------------
*/

$uploadDir = __DIR__ . '/uploads/';


if (!is_dir($uploadDir)) {

    mkdir($uploadDir, 0777, true);

}


/*
|--------------------------------------------------------------------------
| ADD NEW FILES
|--------------------------------------------------------------------------
*/

if (
    isset($_FILES['patent_files']) &&
    isset($_FILES['patent_files']['name']) &&
    is_array($_FILES['patent_files']['name'])
) {

    foreach (
        $_FILES['patent_files']['tmp_name']
        as $key => $tmp_name
    ) {

        $originalName =
            $_FILES['patent_files']['name'][$key] ?? '';

        $error =
            $_FILES['patent_files']['error'][$key]
            ?? UPLOAD_ERR_NO_FILE;


        /*
        | Ignore empty file fields.
        */

        if (
            empty($originalName) ||
            $error !== UPLOAD_ERR_OK ||
            !is_uploaded_file($tmp_name)
        ) {

            continue;

        }


        /*
        | Get extension.
        */

        $extension =
            pathinfo(
                $originalName,
                PATHINFO_EXTENSION
            );


        /*
        | Get clean file name.
        */

        $baseName =
            pathinfo(
                $originalName,
                PATHINFO_FILENAME
            );


        $baseName =
            preg_replace(
                '/[^A-Za-z0-9_-]/',
                '_',
                $baseName
            );


        /*
        | Generate unique name.
        */

        $fileName =
            time() .
            '_' .
            uniqid() .
            '_' .
            $baseName;


        if (!empty($extension)) {

            $fileName .= '.' . $extension;

        }


        $targetFilePath =
            $uploadDir . $fileName;


        /*
        | Move file.
        */

        if (
            move_uploaded_file(
                $tmp_name,
                $targetFilePath
            )
        ) {

            /*
            | Save browser-accessible path.
            */

            $attachments[] =
                'qvision/BusinessProcess/patents/uploads/'
                . $fileName;

        }

    }

}


/*
|--------------------------------------------------------------------------
| Convert attachments back to JSON
|--------------------------------------------------------------------------
*/

$attach_document =
    json_encode(
        $attachments,
        JSON_UNESCAPED_SLASHES
    );


/*
|--------------------------------------------------------------------------
| UPDATE DATABASE
|--------------------------------------------------------------------------
*/

$sql = "
    UPDATE patents_master
    SET

        date = :date,

        title_of_patent = :title,

        applied_by = :applied_by,

        attach_document = :attach_document,

        status = :status

    WHERE id = :id
";


$update = $con->prepare($sql);


$update->execute([

    ':id' =>
        $id,

    ':date' =>
        $_POST['date'] ?? '',

    ':title' =>
        $_POST['title_of_patent'] ?? '',

    ':applied_by' =>
        $_POST['applied_by'] ?? '',

    ':attach_document' =>
        $attach_document,

    ':status' =>
        $_POST['status'] ?? ''

]);


echo "Success";

?>