<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: JSON');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once '../config/Database.php';
include_once '../models/Table.php';

//connect database
$connection = new Database();
$db = $connection->connect();


$cashTable = new Table($db);

//  get data  
$data = json_decode(file_get_contents("php://input"));
$cashTable->date = $data->date;
$cashTable->description = $data->description;
$cashTable->income = $data->income;
$cashTable->expense = $data->expense;
$cashTable->balance = $data->balance;
$cashTable->gst = $data->gst;
$cashTable->category = $data->category;
$cashTable->invoice = $data->invoice;

$cashTable->addData();
?>