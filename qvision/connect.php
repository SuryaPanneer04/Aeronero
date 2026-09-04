<?php

if (!headers_sent()) {
    header("Access-Control-Allow-Origin: *");
}

//define("Title", 'Recruitment');
try {
<<<<<<< Updated upstream
	$con = new pdo ('mysql:host=localhost;dbname=demobluebase_bluebase','root',''); //admin@123
=======
	$con = new pdo ('mysql:host=localhost;dbname=demobluebase_aeronero','root',''); //admin@123
>>>>>>> Stashed changes
} 
catch (Exception $e) 
{
	echo $e->getMessage();
}


$IP = "http://192.168.200.92:8084";

class Database{
  
    // specify your own database credentials
    private $host = "localhost";
<<<<<<< Updated upstream
    private $db_name = "demobluebase_bluebase";
=======
    private $db_name = "demobluebase_aeronero";
>>>>>>> Stashed changes
    private $username = "root";
    private $password = ""; 
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }
        catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
    
?>