<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: JSON');

include_once '../config/Database.php';
include_once '../models/Table.php';

//connect database
$connection = new Database();
$db = $connection->connect();

//get id from the URL
$id = isset($_GET['id']) ? $_GET['id'] : die(); //here

$cashTable = new Table($db);
$stm = $cashTable->readQuery($id);

$counter = 0;
while($row = $stm->fetch()) {
    $response[$counter]['ID'] = $row['ID'];
    $response[$counter]['Date'] = $row['Date'];
    $response[$counter]['Description'] = $row['Description'];
    $response[$counter]['Income'] = $row['Income'];
    $response[$counter]['Expense'] = $row['Expense'];
    $response[$counter]['Balance'] = $row['Balance'];
    $response[$counter]['GST'] = $row['GST'];
    $response[$counter]['Category'] = $row['Category'];
    $response[$counter]['Invoice'] = $row['Invoice'];

    $counter++;
}

  
echo json_encode($response, JSON_PRETTY_PRINT);


?>