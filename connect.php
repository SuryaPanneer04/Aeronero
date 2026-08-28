<?php

if (!headers_sent()) {
    header("Access-Control-Allow-Origin: *");
}

//define("Title", 'Recruitment');
try {
	$con = new pdo ('mysql:host=localhost;dbname=demobluebase_bluebase','demobluebase_bluebase','Girish@2708'); //admin@123
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $con->query("SET SESSION sql_mode = ''");
} 
catch (Exception $e)  
{
	echo $e->getMessage();
}


$IP = "http://192.168.200.92:8084";

class Database{
  
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "demobluebase_bluebase";
    private $username = "demobluebase_bluebase";
    private $password = "Girish@2708"; 
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;  
         try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
            $this->conn->query("SET SESSION sql_mode = ''");
            $this->conn->exec("set names utf8");
        }
        catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
    
?>