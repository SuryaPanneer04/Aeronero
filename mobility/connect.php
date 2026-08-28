<?php

class Connect {
	

    public function db_connect() {
		try {
		$con = new PDO('mysql:host=localhost;dbname=qvision','root','');
        // Set the PDO error mode to exception
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $con;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
    }
	public function getStatus($status, $message, $data) {
		$result = [];
		array_push($result, array("status"=>$status));
		array_push($result, array("message"=>$message));
		array_push($result, array("data"=>$data));
		
		return json_encode($result);
	}
}

// error_reporting(0);

?>

