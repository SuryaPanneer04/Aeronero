<?php

require '../../../connect.php';

$id = $_POST['id'] ?? '';
$index = isset($_POST['index'])
    ? (int)$_POST['index']
    : -1;


if (empty($id) || $index < 0) {

    echo "Invalid request";
    exit;

}


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


if (!isset($attachments[$index])) {

    echo "Attachment not found";
    exit;

}


$attachment = $attachments[$index];


/*
|--------------------------------------------------------------------------
| Delete physical file
|--------------------------------------------------------------------------
*/

if (
    !filter_var(
        $attachment,
        FILTER_VALIDATE_URL
    )
) {

    /*
    | Convert:
    | qvision/BusinessProcess/patents/uploads/file.pdf
    |
    | to the physical server path.
    */

    $relativePath = $attachment;


    $projectRoot =
        dirname(
            __DIR__,
            3
        );


    $filePath =
        $projectRoot .
        '/' .
        $relativePath;


    if (file_exists($filePath)) {

        unlink($filePath);

    }

}


/*
|--------------------------------------------------------------------------
| Remove attachment from array
|--------------------------------------------------------------------------
*/

array_splice(
    $attachments,
    $index,
    1
);


/*
|--------------------------------------------------------------------------
| Save updated JSON
|--------------------------------------------------------------------------
*/

$attach_document =
    json_encode(
        $attachments,
        JSON_UNESCAPED_SLASHES
    );


$update = $con->prepare(
    "UPDATE patents_master
     SET attach_document = :attach_document
     WHERE id = :id"
);


$update->execute([

    ':id' =>
        $id,

    ':attach_document' =>
        $attach_document

]);


echo "Success";

?>