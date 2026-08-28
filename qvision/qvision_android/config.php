<?php
$host = "localhost";
$username = "root";
$password = "qwerty*B@Q2468#";
$database = "ss_info_new";

//Create connection
$mysqlit  = mysqli_connect($host, $username, $password, $database);

//Check connection
if (!$mysqlit) {
    die("Connection failed: " . mysqli_connect_error());
}else{
	//echo "Connected successfully!";
}

?>