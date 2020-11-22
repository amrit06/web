<?php
session_start();
include_once 'Database.php';
include_once 'Validator.php';
include_once 'Product.php';

$inputs = array("name", "description", "groupid", "colorid", "sizeid", "categoryid", "quantity", "price", "pic");
$args = [];
$args_error = [];

for ($i = 0; $i < sizeof($inputs); $i++) {
    $args[$inputs[$i]] = "";
    $args_error[$inputs[$i]] = "";
}


function validateInputs($args, &$args_error)
{

    $args["name"] = validate_empty($args["name"], $args_error["name"], "Can't be Empty!");
    $args["description"] = validate_empty($args["description"], $args_error["description"], "Can't be Empty!");
    $args["groupid"] = validate_empty($args["groupid"], $args_error["groupid"], "Can't be Empty!");
    $args["colorid"] = validate_empty($args["colorid"], $args_error["colorid"], "Can't be Empty!");
    $args["sizeid"] = validate_empty($args["sizeid"], $args_error["sizeid"], "Can't be Empty!");
    $args["categoryid"] = validate_empty($args["categoryid"], $args_error["categoryid"], "Can't be Empty!");
    $args["quantity"] = validate_empty($args["quantity"], $args_error["quantity"], "Can't be Empty!");
    $args["price"] = validate_empty($args["price"], $args_error["price"], "Can't be Empty!");

    foreach ($args as $k => $v) {
        if ($args[$k] == NULL) {
            return FALSE;
        }
    }
    return TRUE;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SESSION['user'] == "15") {
        
        $args = [];
        foreach ($_POST as $k => $v) {
            $args[$k] = $v;
        }
        
        /*upload image */
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            $args["pic"] = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        } else {
            $args_error["pic"] = "Please upload a Pic!";
        }

        if (validateInputs($args,$args_error)) {
            $db = new Database();
            $connection = $db->connect();
            $product = new Product($connection);
            $result = $product->addProduct($args);
            if($result){
                foreach ($_POST as $k => $v) {
                    $args[$k] = "";
                }
                include("../html/layouts/PopupOK.php");
            }else{
                echo "Error: " . $connection->error;
            }
            $connection->close();
        }
    }
}
