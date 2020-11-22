<?php
session_start();
include_once 'Database.php';
include_once 'User.php';
include_once 'Validator.php';


$inputs = array("firstname", "lastname", "email", "password", "retry_password", "gender", "homeno",
"streetname", "suburb", "state", "postcode");
$args_error = [];
$args = [];

for($i = 0; $i < sizeof($inputs); $i++){
  $args_error[$inputs[$i]] = "";
  $args[$inputs[$i]] = "";
}

function validateInputs($args, &$args_error){
  // patterns
  $name_matcher = "/^[a-zA-Z ]*$/";
  $address_matcher = "/^[a-zA-Z0-9\/ ]*$/";
  $postcode_matcher = "/^[0-9]{4}$/"; //note there is no * symbols 
  $password_matcher = "/^[a-zA-Z0-9\/$!@#%^&* ]*$/";

  //validate inputs
  $args["firstname"] = validate($args["firstname"], $args_error["firstname"], "* Only Characters Allowed", $name_matcher);
  $args["lastname"] = validate($args["lastname"], $args_error["lastname"], "* Only Characters Allowed", $name_matcher);
  $args["email"] = validate_email($args["email"], $args_error["email"]);
  $args["password"] = validate($args["password"], $args_error["password"], "* Only following keyword allowed (a-zA-Z0-9/$!#%&*]*$) ", $password_matcher);
  $args["retry_password"] = compare_password($args["retry_password"], $args["password"], $args_error["retry_password"], "* Password Must Match");
  $args["gender"] = validate($args["gender"], $args_error["gender"], "* Must Choose a Valid Option", $name_matcher);
  $args["homeno"] = validate($args["homeno"], $args_error["homeno"], "* Only following keyword allowed (a-zA-Z0-9 /) ", $address_matcher);
  $args["streetname"] = validate($args["streetname"], $args_error["streetname"], "* Only Characters Allowed", $name_matcher);
  $args["suburb"] = validate($args["suburb"], $args_error["suburb"], "* Only Characters Allowed", $name_matcher);
  $args["state"] = validate($args["state"], $args_error["state"], "* Must Choose a Valid Option", $name_matcher);
  $args["postcode"] = validate($args["postcode"], $args_error["postcode"], "* Postcode only contain 4 integers", $postcode_matcher);
  
  foreach ($args as $k => $v){
    if($args[$k] == NULL){
      return FALSE;
    } 
  }
  return TRUE;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $args = [];
  foreach( $_POST as $k => $v){
    $args[$k] = $v;
  }

  if( validateInputs($args, $args_error) ){  
    $db = new Database();
    $conn = $db->connect();
    $user = new User($conn);
    if( !$user->userEmailExist($args['email']) ) {
      unset($args['retry_password']);
      if ($user->insertIntoUser($args)){
        include('../../html/layouts/Popup.php');
      }
    }else{
      $args_error['email'] = "Email already exists!";
    }
    $conn->close();
  }
}


?>
