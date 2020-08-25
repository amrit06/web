<?php

class Database {

    private $servername = "localhost";
    private $username = "amrit";
    private $password = "Kentst";
    private $mydb = "Bulli";
    private $conn;
    
    
    public function connect()
    {
        //if conn success return connection else catch error 

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$mydb", "amrit", "Kentst");
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }
  

}

?>
