<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: JSON');
include_once 'Database.php';
include_once 'User.php';
include_once 'Product.php';

echo "here";
$db = new Database();
$conn = $db->connect();
$p = new Product($conn);
$id = 8;
$p->showProductByQuery(array("id", "name", "price"), array("id = $id"));



/*
$user = new User($db->connect());




 echo "was here";
if($_SERVER["REQUEST_METHOD"] == "GET"){
    
    foreach( $_GET as $k => $v){
        if(!empty($v) && $k != "retry_password"){
            $args[$k] = $v;
        }
    }
    print_r($args);
    $result = $user->insertIntoUser($args);
    
    if($result == TRUE){
        echo "WORKeD!";
    }else{
        echo "not working";
    }
}else{
    echo "no post";
} */

?>