<?php

class User
{
    private $connection;
    // may be validation


    function __construct($dbconnection)
    {
        $this->connection = $dbconnection;
    }

    //add users
    function insertIntoUser($args)
    {
        $key = [];
        $values = [];
        foreach ($args as $k => $v) {
            $key[] = "$k";
            if ($k == "password") {
                $v = password_hash($v, PASSWORD_DEFAULT);
            }
            if ($k != "postcode") {
                $values[] = "'$v'";
            } else {
                $values[] = "$v";
            }
        }
        $key = implode(',', $key);
        $values = implode(',', $values);
        
        $query = "INSERT INTO user ($key) VALUES ($values)";
        if ($this->connection->query($query) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // return true if there is already a email
    function userEmailExist($email){
        $query = "SELECT email FROM user WHERE email = '$email'";
        $result = mysqli_query($this->connection, $query);
        if(mysqli_num_rows($result) > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }


    function loginCredentials($email, $password){
        $query = "SELECT id, password from user WHERE email = '$email' ";
        $result = $this->connection->query($query)->fetch_assoc();
        
        if(password_verify( $password, $result['password']) ){
            return $result['id'];
        }else{
            return -1;
        }
    }

}
