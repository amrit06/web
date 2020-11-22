<?php
class Database
{

    private $db;

    public function connect()
    {
        $this->db = mysqli_connect("localhost", "kancha", "Kancha06", "dhaka");
        if (!$this->db) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        return $this->db;
    }

}
