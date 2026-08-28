<?PHP

header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json, charset=utf-8');

 require '../../../connect.php';
 require '../../../user.php';
  $user_id =$_SESSION['userid'];
  if(!empty($_FILES['file']))
  {
    $path = "uploads/";
    $path = $path . basename( $_FILES['file']['name']);
    $file_name= basename( $_FILES['file']['name']);
    if(move_file($_FILES['file']['tmp_name'], $path)) {
      echo "The file ".  basename( $_FILES['file']['name']). 
      " has been uploaded";
    } else{
        echo "There was an error uploading the file, please try again!";
    }
	  $insert_query=$con->query("INSERT INTO upload_file(file_upload) VALUES ('$file_name')");
	 echo "INSERT INTO upload_file(file_upload) VALUES ('$file_name')";
  }
?>
<!--<!DOCTYPE html>
<html>
<head>
  <title>Upload your files</title>
</head>
<body>
  <form enctype="multipart/form-data" action="po_upload.php" method="POST">
    <p>Upload your file</p>
    <input type="file" name="uploaded_file"></input><br />
    <input type="submit" value="Upload"></input>
  </form>
</body>
</html>-->
