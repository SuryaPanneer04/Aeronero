<?php

require '../../../connect.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$index = isset($_POST['index']) ? (int)$_POST['index'] : -1;

if ($id <= 0 || $index < 0) {
    echo "Invalid attachment request.";
    exit;
}


/*
|--------------------------------------------------------------------------
| Get existing attachments
|--------------------------------------------------------------------------
*/

$stmt = $con->prepare("
    SELECT attach_manuscript
    FROM publications_master
    WHERE id = :id
");

$stmt->execute([
    ':id' => $id
]);

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    echo "Publication not found.";
    exit;
}


/*
|--------------------------------------------------------------------------
| Decode attachment JSON
|--------------------------------------------------------------------------
*/

$attachments = [];

if (!empty($row['attach_manuscript'])) {

    $decoded = json_decode(
        $row['attach_manuscript'],
        true
    );

    if (is_array($decoded)) {
        $attachments = $decoded;
    }
}


/*
|--------------------------------------------------------------------------
| Check attachment index
|--------------------------------------------------------------------------
*/

if (!isset($attachments[$index])) {
    echo "Attachment not found.";
    exit;
}


$attachment = $attachments[$index];


/*
|--------------------------------------------------------------------------
| Delete physical file
|--------------------------------------------------------------------------
|
| External links are NOT physical files, so we don't
| try to delete them from the server.
|
*/

if (!filter_var($attachment, FILTER_VALIDATE_URL)) {

    /*
    | The database contains something like:
    |
    | qvision/masters/publications_master/uploads/file.pdf
    |
    | Convert it to the physical server path.
    */

    $projectRoot = dirname(__DIR__, 3);

    $relativePath = ltrim($attachment, '/\\');

    $physicalPath =
        $projectRoot . DIRECTORY_SEPARATOR .
        str_replace(
            ['/', '\\'],
            DIRECTORY_SEPARATOR,
            $relativePath
        );


    /*
    | Delete physical file if it exists.
    */

    if (file_exists($physicalPath)) {

        if (!unlink($physicalPath)) {

            echo "Unable to delete physical file.";
            exit;

        }

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
| Save updated attachment list
|--------------------------------------------------------------------------
*/

$attach_manuscript = json_encode(
    $attachments,
    JSON_UNESCAPED_SLASHES
);


$update = $con->prepare("
    UPDATE publications_master
    SET attach_manuscript = :attach_manuscript
    WHERE id = :id
");


$update->execute([
    ':attach_manuscript' => $attach_manuscript,
    ':id' => $id
]);


echo "Success";

?>