<?php
session_start();
include_once 'Database.php';
include_once 'User.php';
include_once 'Validator.php';

$inputs = array("email", "password");
$args = [];
$args_error = [];

for($i = 0; $i < sizeof($inputs); $i++){
    $args[$inputs[$i]] = "";
    $args_error[$inputs[$i]] = "";
}

function validateInputs($args, &$args_error){
    $password_matcher = "/^[a-zA-Z0-9\/$!@#%^&* ]*$/";

    $args["email"] = validate_email($args["email"], $args_error["email"]);
    $args["password"] = validate($args["password"], $args_error["password"], "", $password_matcher);
    
    foreach ($args as $k => $v){
        if($args[$k] == NULL){
          return FALSE;
        } 
      }
    return TRUE;
}


if( $_SERVER["REQUEST_METHOD"] == "POST" ){
    $args = [];
    foreach( $_POST as $k => $v){
        $args[$k] = $v;
    }
    

    if( validateInputs($args, $args_error) ){  
        
        $db = new Database();
        $conn = $db->connect();
        echo $conn->error;
        $user = new User($conn);
        $userId = $user->loginCredentials($args["email"], $args["password"]);
        if( $userId != -1 ) {
            $_SESSION['user'] = $userId;
            header('Location: ../../index.php'); // location from Login page
            exit;
        }else{
            $args_error["password"] = "Email Password Didn't Match Our System!";
            $args["password"] = "";
        }
    }

}


?>