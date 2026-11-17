<?php

require '../../../connect.php';

$date = $_POST['date'] ?? '';
$title = $_POST['title_of_patent'] ?? '';
$applied_by = $_POST['applied_by'] ?? '';
$status = $_POST['status'] ?? '';

$attachments = [];


/*
|--------------------------------------------------------------------------
| EXTERNAL LINKS
|--------------------------------------------------------------------------
| The new form sends links as patent_links[]
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

            $attachments[] = $link;

        }

    }

}


/*
|--------------------------------------------------------------------------
| FILE UPLOAD
|--------------------------------------------------------------------------
|
| Physical folder:
| qvision/BusinessProcess/patents/uploads/
|
| __DIR__ makes sure PHP always uses the correct
| physical folder regardless of the current working directory.
|
*/

$uploadDir = __DIR__ . '/uploads/';

if (!is_dir($uploadDir)) {

    mkdir($uploadDir, 0777, true);

}


/*
|--------------------------------------------------------------------------
| UPLOAD MULTIPLE FILES
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
            $_FILES['patent_files']['error'][$key] ?? UPLOAD_ERR_NO_FILE;


        /*
        | Skip empty file fields.
        */

        if (
            empty($originalName) ||
            $error !== UPLOAD_ERR_OK ||
            !is_uploaded_file($tmp_name)
        ) {

            continue;

        }


        /*
        | Create unique file name.
        */

        $extension =
            pathinfo(
                $originalName,
                PATHINFO_EXTENSION
            );


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
        | Move uploaded file.
        */

        if (
            move_uploaded_file(
                $tmp_name,
                $targetFilePath
            )
        ) {

            /*
            | This is the browser-accessible path.
            |
            | Do NOT store __DIR__ in the database.
            */

            $attachments[] =
                'qvision/BusinessProcess/patents/uploads/'
                . $fileName;

        }

    }

}


/*
|--------------------------------------------------------------------------
| Convert attachments to JSON
|--------------------------------------------------------------------------
*/

$attach_document =
    json_encode(
        $attachments,
        JSON_UNESCAPED_SLASHES
    );


/*
|--------------------------------------------------------------------------
| INSERT
|--------------------------------------------------------------------------
*/

$sql = "
    INSERT INTO patents_master
    (
        date,
        title_of_patent,
        applied_by,
        attach_document,
        status
    )
    VALUES
    (
        :date,
        :title,
        :applied_by,
        :attach_document,
        :status
    )
";


$stmt = $con->prepare($sql);


$stmt->execute([

    ':date' =>
        $date,

    ':title' =>
        $title,

    ':applied_by' =>
        $applied_by,

    ':attach_document' =>
        $attach_document,

    ':status' =>
        $status

]);


echo "Success";

?>